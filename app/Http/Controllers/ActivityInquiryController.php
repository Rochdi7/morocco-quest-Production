<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Mail\ActivityInquiryMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ActivityInquiryController extends Controller
{
    public function store(Request $request, Activity $activity)
    {
        $validatedData = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'nationality'     => 'required|string|max:100',
            'phone'           => 'required|string|max:25',
            'arrival_date'    => 'nullable|date|after_or_equal:today',
            'duration_days'   => 'nullable|integer|min:1',
            'adults'          => 'required|integer|min:1',
            'children'        => 'nullable|integer|min:0',
            'inquiry_message' => 'required|string|min:10|max:5000',
        ]);

        $validatedData['activity_title']   = $activity->title;
        $validatedData['activity_url']     = route('activities.show', $activity);
        $validatedData['overview_excerpt'] = Str::limit(strip_tags($activity->overview), 350);

        // Make sure related data is available in email
        $activity->load(['images', 'itineraryDays']);

        try {
            $adminEmail = config('mail.from.address');

            if (!$adminEmail || filter_var($adminEmail, FILTER_VALIDATE_EMAIL) === false) {
                Log::error('Admin email (MAIL_FROM_ADDRESS) is not configured properly for Activity Inquiry.');
                return back()->with('error', 'Inquiry could not be sent due to a server configuration issue.')->withInput();
            }

            Mail::to($adminEmail)->send(new ActivityInquiryMail($validatedData, $activity));

            return back()->with('success', 'Your inquiry about "' . $activity->title . '" has been sent successfully! We will contact you soon.');

        } catch (\Exception $e) {
            Log::error('Activity Inquiry mail sending failed for activity ' . $activity->id . ': ' . $e->getMessage());
            Log::error($e);

            return back()->with('error', 'Sorry, there was an issue sending your inquiry. Please try again later.')->withInput();
        }
    }
}
