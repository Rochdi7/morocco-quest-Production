<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class ContactController extends Controller
{
    public function index()
    {
        $title = 'Contact Morocco Quest | Book Morocco Private Tours';
        $description = 'Contact Morocco Quest to book morocco private tours, marrakech desert tours, or a sahara desert tour from marrakech. Private tours in morocco tailored to you.';
        $keywords = ['morocco private tours', 'marrakech desert tours', 'sahara desert tour from marrakech', 'private tours in morocco', 'best morocco private tour company'];

        $url = url()->current();

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::addKeyword($keywords);
        SEOMeta::setCanonical($url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl($url);

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('ContactPage');

        return view('contact');
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
        ]);

        try {
            $adminEmail = config('mail.from.address', 'contact@morocco-quest.com');

            if (!$adminEmail || !filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
                Log::error('Admin email (MAIL_FROM_ADDRESS) is not configured properly. Value: ' . $adminEmail);
                return back()->with('error', 'Message could not be sent due to a server configuration issue.')->withInput();
            }

            Mail::to($adminEmail)->send(new ContactFormMail($validatedData));

            return back()->with('success', 'Your message has been sent successfully! We will get back to you soon.');
        } catch (\Exception $e) {
            Log::error('Contact form mail sending failed: ' . $e->getMessage());
            return back()->with('error', 'Sorry, there was an issue sending your message. Please try again later.')->withInput();
        }
    }
}
