<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactConfirmationEmail extends Mailable implements ShouldQueue, ShouldBeUnique
{
    use Queueable, SerializesModels;

    protected $name;

    public function __construct(string $name, ?string $locale = null)
    {
        $this->name = $name;
        $this->locale = $locale ?? app()->getLocale();

        $this->replyTo('info@diesing.pro', 'Diesing.pro');
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

    /**
     * Generate a unique identifier hash based on the $data array.
     */
    public function uniqueId(): string
    {
        return md5(serialize($this->name));
    }

    /**
     * Set how long the uniqueness should be enforced (in seconds).
     */
    public function uniqueFor(): int
    {
        return 50; // 1 minute
    }
}
