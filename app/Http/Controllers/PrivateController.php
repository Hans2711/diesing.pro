<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Utilities\SessionUtility;
use Illuminate\Http\Request;

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

        if (!$note) {
            $note = new Note();
        }

        if (!empty($request->input('name'))) {
            $note->name = $request->input('name');
        }
        if (!empty($request->input('content'))) {
            $note->content = $request->input('content');
        }

        $note->save();

        return response()->json($note->toArray());
    }

    public function deleteNote($id) {
        $note = Note::find($id);
        $note->delete();
        return response()->json(1);
    }
}
