<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable implements ShouldQueue, ShouldBeUnique
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data, ?string $locale = null)
    {
        $this->data = $data;
        $this->locale = $locale ?? app()->getLocale();

        $this->replyTo(
            $data["email"] ?? "info@diesing.pro",
            $data["name"] ?? "Diesing.pro"
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(subject: "Kontaktanfrage");
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: "contact.email",
            with: [
                "name" => $this->data["name"],
                "firma" => $this->data["firma"],
                "email" => $this->data["email"],
                "tel" => $this->data["tel"],
                "user_msg" => $this->data["user_message"],
                "locale" => $this->locale,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Generate a unique identifier hash based on the $data array.
     */
    public function uniqueId(): string
    {
        return md5(serialize($this->data));
    }

    /**
     * Set how long the uniqueness should be enforced (in seconds).
     */
    public function uniqueFor(): int
    {
        return 300; // 5 minutes
    }
}

