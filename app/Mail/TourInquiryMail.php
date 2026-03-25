<?php

namespace App\Mail;

use App\Models\Tour;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class TourInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $formData;
    public Tour $tour;

    /**
     * Create a new message instance.
     *
     * @param array $formData The validated form data from the inquiry form
     * @param Tour  $tour     The tour that was inquired about
     */
    public function __construct(array $formData, Tour $tour)
    {
        $this->formData = $formData;
        $this->tour = $tour;
    }

    /**
     * Define the email envelope.
     */
    public function envelope(): Envelope
    {
        $senderName  = $this->formData['name'] ?? 'Visitor';
        $senderEmail = $this->formData['email'] ?? 'noreply@example.com';

        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')), // from your domain
            replyTo: [new Address($senderEmail, $senderName)], // replies go to the traveler
            subject: 'Tour Inquiry: ' . $this->tour->title . ' (from ' . $senderName . ')'
        );
    }

    /**
     * Define the email content view.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.tours.inquiry',
            with: [
                'formData' => $this->formData,
                'tour' => $this->tour,
            ]
        );
    }

    /**
     * Optional: Define attachments (none for now).
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Optional: Legacy support for older Laravel versions.
     */
    public function build()
    {
        $visitorName  = $this->formData['name'] ?? 'Visitor';
        $visitorEmail = $this->formData['email'] ?? 'noreply@example.com';

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($visitorEmail, $visitorName)
            ->subject('Tour Inquiry: ' . $this->tour->title . ' (from ' . $visitorName . ')')
            ->markdown('emails.tours.inquiry')
            ->with([
                'formData' => $this->formData,
                'tour' => $this->tour,
            ]);
    }
}
