<?php

namespace App\Livewire;

use App\Mail\ContactEmail;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public $recepientConfig = [
        "hp" => [
            "email" => "hp@diesing.pro",
            "name" => "Hans Peter (HP) Diesing",
        ],
        "detlef" => [
            "email" => "detlef.diesing@icloud.com",
            "name" => "Detlef Diesing",
        ],
    ];

    public $name;
    public $firma;
    public $email;
    public $tel;
    public $message;
    public $recepient;

    protected $rules = [
        "name" => "required|min:3",
        "firma" => "nullable|max:255",
        "email" => "required|email",
        "tel" => 'required|regex:/^\+?[0-9\s\-]+$/',
        "message" => "required|min:10",
        "recepient" => "required|in:hp,detlef",
    ];

    public function submit()
    {
        $validatedData = $this->validate();

        Mail::to($this->recepientConfig[$this->recepient]["email"])
            ->bcc("info@diesing.pro")
            ->queue(
                new ContactEmail([
                    "name" => $this->name,
                    "firma" => $this->firma,
                    "email" => $this->email,
                    "tel" => $this->tel,
                    "user_message" => $this->message,
                ])
            );

        $this->reset();

        session()->flash("status", __("text.message-sent"));
    }

    public function render()
    {
        return view("livewire.contact-form");
    }
}
