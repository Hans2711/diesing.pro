<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function form()
    {
        return view("contact.form");
    }
}
