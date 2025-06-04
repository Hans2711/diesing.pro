<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactConfirmationEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $name;
    protected $locale;

    public function __construct(string $name, ?string $locale = null)
    {
        $this->name = $name;
        $this->locale = $locale ?? app()->getLocale();

        $this->replyTo(
            $data["email"] ?? "info@diesing.pro",
            $data["name"] ?? "Diesing.pro"
        );
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: __("text.contact-confirmation-subject", [], $this->locale));
    }

    public function content(): Content
    {
        return new Content(
            view: 'contact.confirmation',
            with: [
                'name' => $this->name,
                'locale' => $this->locale,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
