<?php

namespace App\Livewire;

use App\Mail\ContactEmail;
use App\Mail\ContactConfirmationEmail;
use App\Jobs\SendEmail;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public $name;
    public $firma;
    public $email;
    public $tel;
    public $message;
    public $recepient;

    public $users;

    protected $rules = [
        "name" => "required|min:3",
        "firma" => "nullable|max:255",
        "email" => "required|email",
        "tel" => 'required|regex:/^[0-9\s\-\+\(\)]+$/',
        "message" => "required|min:10",
        "recepient" => "required|min:5",
    ];

    public function mount()
    {
        $this->users = User::all();
    }

    public function submit()
    {
        $validatedData = $this->validate();

        SendEmail::dispatch(
            $this->recepient,
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
