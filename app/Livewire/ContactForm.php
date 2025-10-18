<?php

namespace App\Livewire;

use App\Mail\ContactEmail;
use App\Mail\ContactConfirmationEmail;
use App\Jobs\SendEmail;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $firma;
    public $email;
    public $tel;
    public $message;
    public $recipient;

    public array $recipients = [];

    protected $rules = [
        "name" => "required|min:3",
        "firma" => "nullable|max:255",
        "email" => "required|email",
        "tel" => 'required|regex:/^[0-9\s\-\+\(\)]+$/',
        "message" => "required|min:10",
        "recipient" => "required|min:5",
    ];

    public function mount($recipient = null)
    {
        $this->recipients = config('contact.recipients', []);

        $emails = collect($this->recipients)->pluck('email');

        if ($recipient && $emails->contains($recipient)) {
            $this->recipient = $recipient;
        } elseif (!$this->recipient && $emails->isNotEmpty()) {
            $this->recipient = $emails->first();
        }
    }

    public function submit()
    {
        $validatedData = $this->validate();

        SendEmail::dispatch(
            $this->recipient,
            new ContactEmail(
                $this->name,
                $this->firma,
                $this->email,
                $this->tel,
                $this->message,
                app()->getLocale(),
            )
        );

        SendEmail::dispatch(
            $this->email,
            new ContactConfirmationEmail($this->name, app()->getLocale())
        );

        $this->reset();
        $this->mount();

        session()->flash("status", __("text.message-sent"));
    }

    public function render()
    {
        return view("livewire.contact-form");
    }
}
