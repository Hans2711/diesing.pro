<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class CvController extends Controller
{
    public function index()
    {
        return view('cv.index');
    }

    public function single($idOrIdentifier)
    {
        $user = User::find($idOrIdentifier);

        // If not found by ID, try email, username, or name
        if (!$user) {
            $user = User::where('email', $idOrIdentifier)
                ->orWhere('username', $idOrIdentifier)
                ->orWhere('name', 'like', '%' . $idOrIdentifier . '%')
                ->first();
        }

        if (!$user) {
            abort(404, 'User not found.');
        }

        $cv = $user->cv()->first();

        if (!$cv) {
            abort(404, 'CV not found.');
        }

        return view('cv.single', ['cv' => $cv, 'user' => $user]);
    }


    public function print($idOrIdentifier)
    {
        $user = User::find($idOrIdentifier);

        if (!$user) {
            $user = User::where('email', $idOrIdentifier)
                ->orWhere('username', $idOrIdentifier)
                ->orWhere('name', 'like', '%' . $idOrIdentifier . '%')
                ->first();
        }

        if (!$user) {
            abort(404, 'User not found.');
        }

        $cv = $user->cv()->first();

        if (!$cv) {
            abort(404, 'CV not found.');
        }

        $pdf = Pdf::loadView('cv.print', ['cv' => $cv, 'user' => $user]);
        return $pdf->download('diesing-cv (' . date('d.m.Y') . ').pdf');
    }
}
