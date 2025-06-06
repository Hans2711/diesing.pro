<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * All email jobs should be pushed to the dedicated queue.
     *
     * @var string
     */
    public string $queue = 'email';

    public $mailable;
    public $from;
    public $recipient;

    /**
     * Create a new job instance.
     */
    public function __construct($recipient, Mailable $mailable, $from = null)
    {
        $this->recipient = $recipient;
        $this->mailable = $mailable;
        $this->from= $from;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if (!empty($this->from)) {
            $this->mailable->from($this->from);
        }
        Mail::to($this->recipient)->send($this->mailable);
    }

    /**
     * Unique identifier for „ShouldBeUnique“.
     */
    public function uniqueId(): string
    {
        return md5($this->recipient . serialize($this->mailable));
    }

    /**
     * Gültigkeit der Einzigartigkeit (in Sekunden).
     */
    public function uniqueFor(): int
    {
        return 300;
    }
}
