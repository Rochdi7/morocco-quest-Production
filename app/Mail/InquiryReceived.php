<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class InquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public array $inquiryData;
    public string $emailSubject;

    /**
     * Create a new message instance.
     *
     * @param array $inquiryData
     * @param string $emailSubject
     */
    public function __construct(array $inquiryData, string $emailSubject)
    {
        $this->inquiryData = $inquiryData;
        $this->emailSubject = $emailSubject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $visitorName = $this->inquiryData['name'] ?? 'Visitor';
        $visitorEmail = $this->inquiryData['email'] ?? 'noreply@example.com';

        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')), // ✅ ton domaine
            replyTo: [
                new Address($visitorEmail, $visitorName) // ✅ réponses au visiteur
            ],
            subject: $this->emailSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.inquiries.general',
            with: [
                'data' => $this->inquiryData,
            ],
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
     * Build method for compatibility with older Laravel versions.
     */
    public function build()
    {
        $visitorName = $this->inquiryData['name'] ?? 'Visitor';
        $visitorEmail = $this->inquiryData['email'] ?? 'noreply@example.com';

        return $this->from(config('mail.from.address'), config('mail.from.name')) // ✅ ton domaine
            ->replyTo($visitorEmail, $visitorName) // ✅ réponse au visiteur
            ->subject($this->emailSubject)
            ->markdown('emails.inquiries.general')
            ->with([
                'data' => $this->inquiryData,
            ]);
    }
}
