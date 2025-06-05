<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mailable;
    public $recipient;

    public function __construct($recipient, Mailable $mailable)
    {
        $this->recipient = $recipient;
        $this->mailable = $mailable;
    }

    public function handle()
    {
        Mail::to($this->recipient)->send($this->mailable);
    }

    public function uniqueId(): string
    {
        return md5($this->recipient . serialize($this->mailable->getData()));
    }

    public function uniqueFor(): int
    {
        return 300;
    }
}
