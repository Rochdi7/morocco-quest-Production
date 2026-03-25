<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $formData;

    public function __construct(array $formData)
    {
        $this->formData = $formData;
    }

    public function envelope(): Envelope
    {
        $senderName = $this->formData['name'] ?? 'Visitor';
        $senderEmail = $this->formData['email'] ?? 'noreply@example.com';

        return new Envelope(
            replyTo: [
                new Address($senderEmail, $senderName)
            ],
            subject: 'Morocco Quest Contact Form Submission - ' . $senderName,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact.form',
        );
    }

    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name')) // ✅ FIXED LINE
            ->replyTo($this->formData['email'], $this->formData['name'])
            ->subject('Morocco Quest Contact Form Submission - ' . ($this->formData['name'] ?? 'Visitor'))
            ->markdown('emails.contact.form')
            ->with([
                'formData' => $this->formData,
            ]);
    }
    
}
