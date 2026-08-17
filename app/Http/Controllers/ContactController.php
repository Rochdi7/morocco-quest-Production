<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use App\Rules\Recaptcha;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class ContactController extends Controller
{
    public function index()
    {
        $title       = 'Contact Morocco Quest | Book Morocco Tours & Sahara Trips';
        $description = 'Contact Morocco Quest to book morocco tours, sahara desert tours from Marrakech, morocco day trips and private morocco tours. Reply within 24h.';
        $keywords    = ['morocco tours', 'morocco tour agency', 'morocco tour company', 'private morocco tours', 'morocco tour package', 'contact morocco tour operator'];

        $url = url()->current();

        SEOMeta::setTitle($title, false);
        SEOMeta::setDescription($description);
        SEOMeta::addKeyword($keywords);
        SEOMeta::setCanonical($url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl($url);

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('ContactPage');

        return view('contact', [
            'title' => $title,
            'description' => $description,
            'keywords' => implode(', ', $keywords),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'nationality'   => 'required|string|max:100',
            'phone'         => 'required|string|max:25',
            'arrival_date'  => 'required|date|after_or_equal:today',
            'duration_days' => 'required|integer|min:1',
            'adults'        => 'required|integer|min:1',
            'children'      => 'nullable|integer|min:0',
            'travel_ideas'  => 'nullable|string|max:5000',
            'g-recaptcha-response' => ['required', new Recaptcha],
        ]);

        try {
            $adminEmail = config('mail.from.address', 'sales@morocco-quest.com');

            if (!$adminEmail || !filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
                Log::error('Admin email (MAIL_FROM_ADDRESS) is not configured properly. Value: ' . $adminEmail);
                return back()->with('error', 'Message could not be sent due to a server configuration issue.')->withInput();
            }

            Mail::to($adminEmail)->send(new ContactFormMail($validatedData));

            // page_source: a hidden input on each form identifying its origin
            // page (contact, dmc-marrakech, etc.) — this endpoint is shared by
            // 9 different pages/forms with no other server-side way to tell
            // them apart. Falls back to 'contact' if the field is missing.
            return back()
                ->with('success', 'Your message has been sent successfully! We will get back to you soon.')
                ->with('form_type', 'contact_inquiry')
                ->with('lead_source', $request->input('page_source', 'contact'));
        } catch (\Exception $e) {
            Log::error('Contact form mail sending failed: ' . $e->getMessage());
            return back()->with('error', 'Sorry, there was an issue sending your message. Please try again later.')->withInput();
        }
    }
}
