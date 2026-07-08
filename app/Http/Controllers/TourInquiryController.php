<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Mail\TourInquiryMail;
use App\Rules\Recaptcha;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TourInquiryController extends Controller
{
    /**
     * Handle the tour inquiry form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tour          $tour (Route model binding)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Tour $tour)
    {
        // 1. Validate form data
        $validatedData = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'phone'           => 'required|string|max:25',
            'nationality'     => 'required|string|max:100',
            'arrival_date'    => 'required|date|after_or_equal:today',
            'duration_days'   => 'required|integer|min:1',
            'adults'          => 'required|integer|min:1',
            'children'        => 'nullable|integer|min:0',
            'inquiry_message' => 'required|string|min:10|max:5000',
            'g-recaptcha-response' => ['required', new Recaptcha],
        ]);

        // Add useful context to the data array (optional)
        $validatedData['tour_title'] = $tour->title;
        $validatedData['tour_url'] = route('tours.show', $tour);

        try {
            $adminEmail = config('mail.from.address');

            if (!$adminEmail || !filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
                Log::error('Tour Inquiry: Invalid MAIL_FROM_ADDRESS in .env');
                return back()->with('error', 'Inquiry could not be sent due to a server configuration issue.')->withInput();
            }

            // Send email using Mailable
            Mail::to($adminEmail)->send(new TourInquiryMail($validatedData, $tour));

            return back()->with('success', 'Your inquiry about "' . $tour->title . '" has been sent successfully. We will contact you shortly!');
        } catch (\Exception $e) {
            Log::error('Tour Inquiry Mail Failed [Tour ID: ' . $tour->id . ']: ' . $e->getMessage());
            Log::debug($e);

            return back()->with('error', 'Sorry, something went wrong while sending your inquiry. Please try again later.')->withInput();
        }
    }
}
