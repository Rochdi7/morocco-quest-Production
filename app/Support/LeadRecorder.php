<?php

namespace App\Support;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Writes a row to `leads` for any inbound signal (form submit or click) and
 * enriches it with visitor context.
 *
 * Saving must never break the user-facing flow: every call is wrapped so a DB
 * failure is logged and swallowed — the inquiry email still goes out, and the
 * click beacon still returns 204.
 */
class LeadRecorder
{
    public static function record(Request $request, array $attributes): ?Lead
    {
        try {
            return Lead::create(array_merge(
                ['status' => 'new'],
                self::visitorContext($request),
                array_filter($attributes, fn ($v) => $v !== null && $v !== ''),
            ));
        } catch (\Throwable $e) {
            Log::error('Lead save failed: ' . $e->getMessage(), [
                'type' => $attributes['type'] ?? null,
            ]);

            return null;
        }
    }

    /**
     * IP, parsed browser/platform/device, and page context.
     */
    public static function visitorContext(Request $request): array
    {
        $agent = (string) $request->userAgent();

        return [
            'ip_address' => self::clientIp($request),
            'browser'    => self::browser($agent),
            'platform'   => self::platform($agent),
            'device'     => self::device($agent),
            'user_agent' => Str::limit($agent, 1000, ''),
            'page_url'   => Str::limit((string) $request->fullUrl(), 1000, ''),
            'referrer'   => Str::limit((string) $request->headers->get('referer'), 1000, '') ?: null,
        ];
    }

    /**
     * The site sits behind shared hosting / Cloudflare, so REMOTE_ADDR is
     * often the proxy. Prefer the forwarded headers when present, and take
     * the first (original client) entry of X-Forwarded-For.
     */
    private static function clientIp(Request $request): ?string
    {
        $candidates = [
            $request->headers->get('CF-Connecting-IP'),
            Str::before((string) $request->headers->get('X-Forwarded-For'), ','),
            $request->ip(),
        ];

        foreach ($candidates as $ip) {
            $ip = trim((string) $ip);
            if ($ip !== '' && filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }

        return null;
    }

    private static function browser(string $agent): string
    {
        // Order matters: Edge/Opera/Samsung UAs also contain "Chrome",
        // and Chrome's UA contains "Safari".
        $map = [
            'Edge'              => '/Edg(e|A|iOS)?\//i',
            'Opera'             => '/OPR\/|Opera/i',
            'Samsung Internet'  => '/SamsungBrowser/i',
            'Chrome'            => '/Chrome|CriOS/i',
            'Firefox'           => '/Firefox|FxiOS/i',
            'Safari'            => '/Safari/i',
            'Internet Explorer' => '/MSIE|Trident/i',
        ];

        foreach ($map as $name => $pattern) {
            if (preg_match($pattern, $agent)) {
                return $name;
            }
        }

        return $agent === '' ? 'Unknown' : 'Other';
    }

    private static function platform(string $agent): string
    {
        $map = [
            'Windows' => '/Windows NT/i',
            'Android' => '/Android/i',
            'iOS'     => '/iPhone|iPad|iPod/i',
            'macOS'   => '/Macintosh|Mac OS X/i',
            'Linux'   => '/Linux/i',
        ];

        foreach ($map as $name => $pattern) {
            if (preg_match($pattern, $agent)) {
                return $name;
            }
        }

        return 'Unknown';
    }

    private static function device(string $agent): string
    {
        if (preg_match('/iPad|Tablet/i', $agent)) {
            return 'Tablet';
        }

        if (preg_match('/Mobi|Android|iPhone|iPod/i', $agent)) {
            return 'Mobile';
        }

        return 'Desktop';
    }
}
