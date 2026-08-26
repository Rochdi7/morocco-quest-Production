<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Support\LeadRecorder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Beacon endpoint for WhatsApp / phone click tracking.
 *
 * Called from the floating WhatsApp button and the header phone link via
 * navigator.sendBeacon (fetch fallback), so the click is recorded without
 * navigating away, reloading, or delaying the wa.me / tel: handoff.
 *
 * CSRF is excluded (see VerifyCsrfToken $except): the pages carrying these
 * links are served from the guest page-cache with a stale token, and the
 * endpoint writes nothing an attacker could exploit — worst case it inserts
 * a click row. Abuse is bounded by the `throttle` middleware on the route
 * and by the whitelist of accepted types.
 */
class LeadClickController extends Controller
{
    /** Only these click types may be recorded from the browser. */
    private const ALLOWED = [
        Lead::TYPE_WHATSAPP_CLICK,
        Lead::TYPE_PHONE_CLICK,
    ];

    public function store(Request $request): Response
    {
        $data = $request->validate([
            'type'   => 'required|string|in:' . implode(',', self::ALLOWED),
            'source' => 'nullable|string|max:191',
        ]);

        LeadRecorder::record($request, [
            'type'   => $data['type'],
            'source' => $data['source'] ?? null,
            // Clicks originate on the page the visitor is reading, but the
            // beacon POSTs to /track/click — record the real page instead.
            'page_url' => $request->headers->get('referer'),
        ]);

        return response()->noContent();
    }
}
