<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $name;
    protected ?string $firma;
    protected string $email;
    protected string $tel;
    protected string $userMessage;

    /**
     * Create a new message instance.
     */
    public function __construct(
        string $name,
        ?string $firma,
        string $email,
        string $tel,
        string $userMessage,
        ?string $locale = null
    ) {
        $this->name = $name;
        $this->firma = $firma;
        $this->email = $email;
        $this->tel = $tel;
        $this->userMessage = $userMessage;
        $this->locale = $locale ?? app()->getLocale();

        $this->replyTo(
            $this->email ?? 'info@diesing.pro',
            $this->name ?? 'Diesing.pro'
        );
        $this->subject = 'Kontaktanfrage';
        if (!empty($this->name)) {
            $this->subject .= ' (' . $this->name . ')';
        }

        logger()->info('ContactEmail created');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        logger()->info('ContactEmail content method called');
        return new Content(
            view: 'contact.email',
            with: [
                'name' => $this->name,
                'firma' => $this->firma,
                'email' => $this->email,
                'tel' => $this->tel,
                'user_msg' => $this->userMessage,
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

