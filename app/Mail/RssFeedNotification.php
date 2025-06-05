<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RssFeedNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected string $url;
    protected string $title;
    protected ?string $description;
    protected ?string $link;
    protected ?string $pubDate;

    public function __construct(
        string $url,
        string $title,
        ?string $description = '',
        ?string $link = '',
        ?string $pubDate = '',
        ?string $locale = null
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
        $this->pubDate = $pubDate;
        $this->locale = $locale ?? app()->getLocale();
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
                'url' => $this->url,
                'title' => $this->title,
                'description' => $this->description ?? '',
                'link' => $this->link ?? '',
                'pubDate' => $this->pubDate ?? '',
                'locale' => $this->locale,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }

}
