<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

/**
 * Full-page HTML cache for anonymous GET traffic on selected routes.
 *
 * Why: TTFB on shared hosting is ~1s and it is the largest single component
 * of the homepage LCP (measured via Lighthouse LCP breakdown: ~988ms TTFB).
 * Serving the rendered HTML from the file cache skips DB queries and Blade
 * rendering for repeat requests.
 *
 * Safety:
 * - Only caches the response BODY. Cookies/headers are attached fresh per
 *   visitor by the surrounding session middleware, so nothing session-bound
 *   leaks between visitors.
 * - The cached body does contain a stale CSRF token (footer newsletter form);
 *   partials/footer.blade.php refreshes _token inputs client-side via the
 *   csrf.refresh endpoint after DOMContentLoaded.
 * - Bypasses for authenticated users, non-GET, and any query string.
 * - Bypasses whenever the session carries flashed state (success/error
 *   messages, validation errors, old() input — see hasFlashedState()): every
 *   form on the site (newsletter, tour/activity inquiry, contact, B2B leads)
 *   redirects back() to wherever the visitor was, which can be the homepage.
 *   Without this check, a visitor's one-time flash message (and the
 *   generate_lead analytics event gated on it) could be cached and served
 *   to the NEXT anonymous visitor instead of shown once to the submitter —
 *   fixed 2026-08-17, found while wiring up GA4 event tracking.
 * - Cleared by `php artisan cache:clear` (already part of the deploy routine),
 *   or expires on its own after TTL_SECONDS.
 */
class CacheGuestPage
{
    // 6h: long enough that real visitors (and PSI tests) usually hit a warm
    // cache on this low-traffic site. Deploys already run cache:clear, and
    // Filament content edits show up after expiry at the latest.
    private const TTL_SECONDS = 21600;

    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->isMethod('GET')
            || count($request->query()) > 0
            || $request->user()
            || $this->hasFlashedState($request)) {
            return $next($request);
        }

        $key = 'page-cache:' . sha1($request->path());

        $html = Cache::get($key);
        if (is_string($html)) {
            return response($html, 200)
                ->header('Content-Type', 'text/html; charset=UTF-8')
                ->header('X-Page-Cache', 'hit');
        }

        $response = $next($request);

        if ($response->getStatusCode() === 200
            && str_contains((string) $response->headers->get('Content-Type'), 'text/html')
            && is_string($response->getContent())) {
            Cache::put($key, $response->getContent(), self::TTL_SECONDS);
        }

        $response->headers->set('X-Page-Cache', 'miss');

        return $response;
    }

    /**
     * True when this visitor's session carries one-time form state that the
     * page may render: flash messages, validation errors, or old() input.
     *
     * A failed form redirects back() with withErrors()->withInput(); the
     * next GET renders old('name'/'email'/'phone') into the form. That
     * render must never be read from, or written to, the shared cache, or
     * one visitor's personal data is served to everyone (found 2026-09-28).
     * Any key flashed by the previous request is treated as visitor-specific.
     */
    private function hasFlashedState(Request $request): bool
    {
        $session = $request->session();

        return $session->has('success')
            || $session->has('error')
            || $session->has('errors')
            || $session->has('_old_input')
            || ! empty($session->get('_flash.old', []));
    }
}
