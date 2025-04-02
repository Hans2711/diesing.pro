<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CvController extends Controller
{
    public function index()
    {
        return view('cv.index');
    }

    public function single($id) {
        $cv = User::find($id)->cv()->first();
        /* dd($cv->lists()->get()); */

        return view('cv.single', ['cv' => $cv]);
    }
}
