<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Redirect;
use App\Utilities\FingerprintUtility;
use App\Utilities\SessionUtility;
use Egulias\EmailValidator\Warning\EmailTooLong;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class PrivateController extends Controller
{
    //
    //
    public function index()
    {
        return view("private.index", [
            "isAuthenticated" => SessionUtility::privateAreaAuthenticated(),
        ]);
    }

    public function FingerprintCheck(Request $request)
    {
        $fingerprintCheck = FingerprintUtility::checkFingerprint(
            $request->input("fingerprint")
        );
        if ($fingerprintCheck) {
            SessionUtility::privateAreaAuthenticate();
        }
        return response()->json($fingerprintCheck ? 1 : 0);
    }

    public function auth(Request $request)
    {
        $password = $request->input("password");

        if ($password == env("PRIVATE_PASSWORD")) {
            SessionUtility::privateAreaAuthenticate();

            if (!empty($request->input("fingerprint"))) {
                FingerprintUtility::enableFingerprint(
                    $request->input("fingerprint")
                );
            }

            return redirect(
                $request->input("return_url") ??
                    "/" . App::getLocale() . "/" . __("url.private-area")
            );
        }

        return view("private.index", [
            "isAuthenticated" => SessionUtility::privateAreaAuthenticated(),
        ]);
    }

    public function notes()
    {
        $notes = Note::all();
        return view("private.notes", ["notes" => $notes]);
    }

    public function PublicNote($slug, Request $request)
    {
        $note = Note::where("slug", $slug)->where("share", 1)->first();
        if (!$note) {
            return redirect(
                $request->input("return_url") ??
                    "/" . App::getLocale() . "/" . __("url.private-area")
            );
        }

        if ($note->enable_password) {
            if (SessionUtility::privateAreaAuthenticated()) {
                $headers = ["Content-type" => "text/plain"];
                return response($note->content, 200)->withHeaders($headers);
            } else {
                if (
                    $request->cookie("private_note_" . $slug) == $note->password
                ) {
                    $headers = ["Content-type" => "text/plain"];
                    return response($note->content, 200)->withHeaders($headers);
                }
                if ($request->method() == "POST") {
                    if ($request->input("password") == $note->password) {
                        $headers = ["Content-type" => "text/plain"];
                        return response($note->content, 200)
                            ->withHeaders($headers)
                            ->withCookie(
                                "private_note_" . $slug,
                                $note->password
                            );
                    } else {
                        return view("private.public-password-form", [
                            "slug" => $slug,
                            "error" => "Das Passwort ist falsch.",
                        ]);
                    }
                }
                return view("private.public-password-form", ["slug" => $slug]);
            }
        } else {
            $headers = ["Content-type" => "text/plain"];
            return response($note->content, 200)->withHeaders($headers);
        }
    }

    public function redirector()
    {
        $redirects = Redirect::query()->orderBy("id", "desc")->get();

        return view("private.redirector", ["redirects" => $redirects]);
    }

    public function Redirect($slug)
    {
        $redirect = Redirect::where("slug", $slug)->first();
        if ($redirect) {
            return redirect($redirect->target, $redirect->code);
        }
    }

    public function files()
    {
        return view("private.files");
    }
}
