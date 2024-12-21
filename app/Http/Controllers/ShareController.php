<?php

namespace App\Http\Controllers;

use App\Events\TestDelivery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    //
    //
    public function index(Request $request) {
        if (!$request->session()->has('random_id')) {
            $request->session()->put('random_id', Str::random(8));
        }
        return view("share.index");
    }

    public function test() {
        broadcast(new TestDelivery('Hi'));
        return "Event has been sent!";
    }
}
