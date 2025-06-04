<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RssFeedNotification extends Mailable implements ShouldQueue, ShouldBeUnique
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'New RSS Feed Item');
    }

    public function content(): Content
    {
        return new Content(
            view: 'rss.email.new-item',
            with: [
                'url' => $this->data['url'],
                'title' => $this->data['title'],
                'description' => $this->data['description'] ?? '',
                'link' => $this->data['link'] ?? '',
                'pubDate' => $this->data['pubDate'] ?? '',
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }

    public function uniqueId(): string
    {
        return md5(serialize($this->data));
    }

    public function uniqueFor(): int
    {
        return 300;
    }
}
