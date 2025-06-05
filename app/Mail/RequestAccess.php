<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestAccess extends Mailable
{
    use Queueable, SerializesModels;

    protected User $user;
    protected string $permission;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $permission, ?string $locale = null)
    {
        $this->user = $user;
        $this->permission = $permission;
        $this->locale = $locale ?? app()->getLocale();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(subject: "Access Request");
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'accounts.email.request-access',
            with: [
                'user' => $this->user,
                'permission' => $this->permission,
                'locale' => $this->locale,
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

}

