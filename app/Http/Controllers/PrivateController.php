<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Redirect;
use App\Utilities\SessionUtility;
use Egulias\EmailValidator\Warning\EmailTooLong;
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
            return redirect($request->input('return_url') ?? '/privater-bereich');
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

    public function PublicNote($slug, Request $request) {
        $note = Note::where('slug', $slug)->where('share', 1)->first();
        if (!$note) {
            return redirect('/privater-bereich');
        }

        if ($note->enable_password) {
            if (SessionUtility::privateAreaAuthenticated()) {
                $headers = ['Content-type'=>'text/plain'];
                return response($note->content, 200)->withHeaders($headers);
            } else {
                if ($request->cookie('private_note_' . $slug) == $note->password) {
                    $headers = ['Content-type'=>'text/plain'];
                    return response($note->content, 200)->withHeaders($headers);
                }
                if ($request->method() == "POST") {
                    if ($request->input('password') == $note->password) {
                        $headers = ['Content-type'=>'text/plain'];
                        return response($note->content, 200)->withHeaders($headers)->withCookie('private_note_' . $slug, $note->password);
                    } else {
                        return view('private.public-password-form', ['slug' => $slug, 'error' => 'Das Passwort ist falsch.']);
                    }
                }
                return view('private.public-password-form', ['slug' => $slug]);
            }
        } else {
            $headers = ['Content-type'=>'text/plain'];
            return response($note->content, 200)->withHeaders($headers);
        }
    }

    public function deleteNote($id) {
        $note = Note::find($id);
        $note->delete();
        return response()->json(1);
    }

    public function redirector() {
        $redirects = Redirect::all();

        return view('private.redirector', ['redirects' => $redirects]);
    }

    public function deleteRedirect(Request $request) {
        $id = $request->input('id');

        $redirect = Redirect::where('id', $id)->first();

        if (!empty($redirect)) {
            $redirect->delete();
            return response()->json(1);
        }

        return response()->json(0);
    }

    public function pushRedirect(Request $request) {
        $id = $request->input('id');
        $name = $request->input('name');
        $target = $request->input('target');
        $code = $request->input('code');

        if (empty($id)) {
            $redirect = new Redirect();
            if (!empty($name)) {
                $redirect->name = $name;
            }
            if (!empty($target)) {
                $redirect->target = $target;
            }
            if (!empty($code)) {
                $redirect->code = $code;
            }
            
            $redirect->workRedirect();
            $redirect->save();

            return response()->json($redirect->toArray());
        } else {
            $redirect = Redirect::where('id', $id)->first();

            if (empty($redirect)) {
                $redirect = new Redirect();
            }

            if (!empty($name)) {
                $redirect->name = $name;
            }
            if (!empty($target)) {
                $redirect->target = $target;
            }
            if (!empty($code)) {
                $redirect->code = $code;
            }

            $redirect->workRedirect();
            $redirect->save();
            return response()->json($redirect->toArray());
        }
    }
}
