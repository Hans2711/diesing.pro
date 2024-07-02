<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Utilities\SessionUtility;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PrivateController extends Controller
{
    //
    //
    public function index() {
        return view('private.index', [
            'isAuthenticated' => SessionUtility::privateAreaAuthenticated()
        ]);
    }

    public function ReceiveForm(Request $request) {
        $password = $request->input('password');

        if ($password == env('PRIVATE_PASSWORD')) {
            SessionUtility::privateAreaAuthenticate();
        }

        return view('private.index', [
            'isAuthenticated' => SessionUtility::privateAreaAuthenticated()
        ]);
    }

    public function notes() {
        $notes = Note::all();

        return view('private.notes', ['notes' => $notes]);
    }

    public function getNote($id) {
        $note = Note::find($id);
        if (!$note) {
            $note = new Note();
        }
        return response()->json($note->toArray());
    }

    public function updateNote($id, Request $request) {
        $note = Note::find($id);
        $isNew = false;

        if (!$note) {
            $note = new Note();
            $isNew = true;
        }

        if (!empty($request->input('name'))) {
            if ($isNew)
                $note->save();

            $note->name = $request->input('name');
            $slug = str_replace(' ', '-', strtolower($request->input('name'))) . '-' . $note->id;
            $note->slug = $slug;
        }
        if (!empty($request->input('content'))) {
            $note->content = $request->input('content');
        }
        if (!empty($request->input('share')) || $request->input('share') === "0") {
            $note->share = (int)$request->input('share');
        }
        if (!empty($request->input('enable-password')) || $request->input('enable-password') === "0") {
            $note->enable_password = (int)$request->input('enable-password');
        }
        if (!empty($request->input('password')) || (!empty($request->input('write-password')) && $request->input('write-password') == 1)) {
            $note->password = $request->input('password') ?? '';
        }

        $note->save();

        return response()->json($note->toArray());
    }

    public function PublicNote($slug) {
        $note = Note::where('slug', $slug)->where('share', 1)->first();
        if (!$note) {
            return redirect('/privater-bereich');
        }
        $headers = ['Content-type'=>'text/plain'];
        return response($note->content, 200)->withHeaders($headers);
    }

    public function deleteNote($id) {
        $note = Note::find($id);
        $note->delete();
        return response()->json(1);
    }

    public function redirector() {
        return view('private.redirector');
    }
}
