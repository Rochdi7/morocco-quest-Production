<?php

namespace App\Rules;

use App\Services\RecaptchaService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Reusable validation rule for Google reCAPTCHA v2 (Checkbox).
 *
 * Usage in any controller:
 *
 *     $request->validate([
 *         // ...existing rules...
 *         'g-recaptcha-response' => ['required', new \App\Rules\Recaptcha],
 *     ]);
 *
 * Because it plugs into the normal validator:
 *   - On failure with a normal request, Laravel redirects back()->withInput()
 *     with the error in $errors — no form data is lost.
 *   - On failure with an AJAX/JSON request, Laravel returns HTTP 422 with the
 *     message under the "g-recaptcha-response" key.
 */
class Recaptcha implements ValidationRule
{
    public function __construct(
        protected ?RecaptchaService $service = null,
    ) {
        // Allow `new Recaptcha` without arguments in blade/controllers while
        // still supporting injection/mocking in tests.
        $this->service ??= app(RecaptchaService::class);
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $token = is_string($value) ? $value : null;

        if (! $this->service->verify($token, request()->ip())) {
            $fail(config('recaptcha.error_message', 'Please confirm you are not a robot.'));
        }
    }
}
