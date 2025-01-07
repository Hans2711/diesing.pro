<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    protected $recepientConfig = [
        "hp" => [
            "email" => "hp@diesing.pro",
            "name" => "Hans Peter (HP) Diesing",
        ],
        "detlef" => [
            "email" => "detlef.diesing@icloud.com",
            "name" => "Detlef Diesing",
        ],
    ];

    public function form()
    {
        return view("contact.form", [
            "recepients" => $this->recepientConfig,
        ]);
    }

    public function submit(Request $request)
    {
        $name = $request->input("name");
        $firma = $request->input("firma");
        $email = $request->input("email");
        $tel = $request->input("tel");
        $message = $request->input("message");
        $recepient = $request->input("recepient");

        if (!array_key_exists($recepient, $this->recepientConfig)) {
            return new JsonResponse([
                "success" => false,
                "message" => "Recepient not found.",
            ]);
        }

        Mail::to($this->recepientConfig[$recepient]["email"])
            ->bcc("info@diesing.pro")
            ->send(
                new ContactEmail([
                    "name" => $name,
                    "firma" => $firma,
                    "email" => $email,
                    "tel" => $tel,
                    "user_message" => $message,
                ])
            );

        return new JsonResponse([
            "success" => true,
            "message" => __("text.message-sent"),
        ]);
    }
}
