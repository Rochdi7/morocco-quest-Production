<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Server-side verification for Google reCAPTCHA v2 (Checkbox).
 *
 * Controllers never talk to Google directly — they depend on this service
 * (or, more commonly, on the App\Rules\Recaptcha validation rule which wraps
 * it). The service always returns a clean boolean and never throws, so a
 * Google outage degrades gracefully into a normal "captcha failed" response
 * rather than a 500 error.
 */
class RecaptchaService
{
    /**
     * Verify a reCAPTCHA response token against Google.
     *
     * @param  string|null  $token  The "g-recaptcha-response" value from the form.
     * @param  string|null  $ip     The end-user IP (optional but recommended).
     * @return bool  True when the human check passes (or verification is disabled).
     */
    public function verify(?string $token, ?string $ip = null): bool
    {
        // If reCAPTCHA is disabled or not configured, do not block submissions.
        // This keeps local/testing environments usable and acts as a safety
        // valve if keys are ever removed in production.
        if (! $this->isEnabled()) {
            return true;
        }

        // A missing/empty token means the checkbox was never solved (or the
        // field was stripped by a bot). Fail closed.
        if (empty($token)) {
            return false;
        }

        try {
            $response = Http::asForm()
                ->timeout(config('recaptcha.timeout', 5))
                ->retry(2, 200, throw: false)
                ->post(config('recaptcha.verify_url'), [
                    'secret'   => config('recaptcha.secret_key'),
                    'response' => $token,
                    'remoteip' => $ip,
                ]);
        } catch (Throwable $e) {
            // Network failure / timeout / DNS error, etc.
            Log::warning('reCAPTCHA verification request failed (network).', [
                'message' => $e->getMessage(),
            ]);

            return false;
        }

        if ($response->failed()) {
            Log::warning('reCAPTCHA verification returned a non-2xx status.', [
                'status' => $response->status(),
            ]);

            return false;
        }

        $body = $response->json();

        if (! is_array($body)) {
            Log::warning('reCAPTCHA verification returned an unexpected body.', [
                'body' => $response->body(),
            ]);

            return false;
        }

        $success = (bool) ($body['success'] ?? false);

        if (! $success) {
            // Log the specific reason. Common codes:
            //  - missing-input-secret / invalid-input-secret  (config problem)
            //  - missing-input-response / invalid-input-response
            //  - timeout-or-duplicate  (replay / expired token)
            //  - bad-request
            Log::warning('reCAPTCHA verification rejected the token.', [
                'error-codes' => $body['error-codes'] ?? [],
                'hostname'    => $body['hostname'] ?? null,
            ]);

            return false;
        }

        // Optional hardening: ensure the token was solved on our own hostname
        // to blunt cross-site token replay. Only enforced when explicitly
        // enabled AND Google actually reports a hostname.
        if (config('recaptcha.verify_hostname') && ! $this->hostnameMatches($body['hostname'] ?? null)) {
            Log::warning('reCAPTCHA hostname mismatch.', [
                'google_hostname' => $body['hostname'] ?? null,
                'request_host'    => request()->getHost(),
            ]);

            return false;
        }

        return true;
    }

    /**
     * Whether verification should run at all.
     */
    public function isEnabled(): bool
    {
        return (bool) config('recaptcha.enabled', true)
            && ! empty(config('recaptcha.secret_key'))
            && ! empty(config('recaptcha.site_key'));
    }

    /**
     * Compare Google's reported hostname to the current request host.
     */
    protected function hostnameMatches(?string $googleHostname): bool
    {
        if (empty($googleHostname)) {
            // Google omits the hostname when "Domain Verification" is off.
            // Treat as a pass so we don't block legitimate users; the success
            // flag has already been validated above.
            return true;
        }

        return strcasecmp($googleHostname, request()->getHost()) === 0;
    }
}
