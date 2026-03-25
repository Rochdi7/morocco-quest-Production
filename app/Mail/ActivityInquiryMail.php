<?php

namespace App\Mail;

use App\Models\Activity;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class ActivityInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $formData;
    public Activity $activity;

    /**
     * Create a new message instance.
     *
     * @param array $formData The validated form data
     * @param Activity $activity The activity being inquired about
     */
    public function __construct(array $formData, Activity $activity)
    {
        $this->formData = $formData;
        $this->activity = $activity;
    }

    /**
     * Get the message envelope (Laravel 9+).
     */
    public function envelope(): Envelope
    {
        $visitorName = $this->formData['name'] ?? 'Visitor';
        $visitorEmail = $this->formData['email'] ?? 'noreply@example.com';

        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')), // ✅ your domain sender
            replyTo: [
                new Address($visitorEmail, $visitorName) // ✅ replies go to visitor
            ],
            subject: 'Activity Inquiry: ' . $this->activity->title . ' (from ' . $visitorName . ')',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.activities.inquiry', // ✅ use full HTML Blade view
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Build the message (for compatibility with older Laravel versions).
     */
    public function build()
    {
        $visitorName = $this->formData['name'] ?? 'Visitor';
        $visitorEmail = $this->formData['email'] ?? 'noreply@example.com';

        return $this->from(config('mail.from.address'), config('mail.from.name')) // ✅ sender
            ->replyTo($visitorEmail, $visitorName) // ✅ reply goes to visitor
            ->subject('Activity Inquiry: ' . $this->activity->title . ' (from ' . $visitorName . ')')
            ->view('emails.activities.inquiry') // ✅ switched from markdown to HTML view
            ->with([
                'formData' => $this->formData,
                'activity' => $this->activity
            ]);
    }
}
