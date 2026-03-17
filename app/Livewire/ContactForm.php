<?php

namespace App\Livewire;

use App\Mail\ContactEmail;
use App\Mail\ContactConfirmationEmail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $firma;
    public $email;
    public $tel;
    public $message;

    protected $rules = [
        "name" => "required|min:3",
        "firma" => "nullable|max:255",
        "email" => "required|email",
        "tel" => 'required|regex:/^[0-9\s\-\+\(\)]+$/',
        "message" => "required|min:10",
    ];

    public function submit()
    {
        $validatedData = $this->validate();

        try {
            // Send email to admin
            Mail::to(config('mail.admin_email'))->send(
                new ContactEmail(
                    $this->name,
                    $this->firma,
                    $this->email,
                    $this->tel,
                    $this->message,
                    app()->getLocale(),
                )
            );

            // Send confirmation email to user
            Mail::to($this->email)->send(
                new ContactConfirmationEmail($this->name, app()->getLocale())
            );

            $this->reset();

            session()->flash("status", __("text.message-sent"));
        } catch (\Exception $e) {
            logger()->error('Contact form email failed: ' . $e->getMessage());
            $this->addError('email_send', __('text.email-send-failed'));
        }
    }

    public function render()
    {
        return view("livewire.contact-form");
    }
}
