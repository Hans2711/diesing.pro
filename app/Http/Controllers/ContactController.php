<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    //

    public function form()
    {
        return view("contact.form");
    }

    public function submit(Request $request)
    {
        $name = $request->input("name");
        $firma = $request->input("firma");
        $email = $request->input("email");
        $tel = $request->input("tel");
        $message = $request->input("message");

        Mail::to("hans.diesing@netigo.de")->send(
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
            "message" => "Nachricht wurde versendet.",
        ]);
    }
}
