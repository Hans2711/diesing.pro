<?php

namespace App\Http\Controllers;

use App\Models\Testinstance;
use App\Models\Testobject;
use App\Models\Testrun;
use App\Utilities\SessionUtility;
use Illuminate\Http\Request;

class TesterController extends Controller
{
    //
    public function index() {
        return view('tester.index');
    }

    public function auth(Request $request) {
        if ($request->method() == 'POST') {
            $password = $request->input("password");

            if ($password == env("TESTER_PASSWORD")) {
                SessionUtility::testerAuthenticate();
                return redirect(
                    $request->input("return_url") ?? "/tester"
                );
            } else {
                session()->flash('message', 'Wrong Password');
            }
        }
        return view('tester.auth');
    }

    public function testobject($id) {
        $testobject = Testobject::find($id);
        return view('tester.testobject', ['testobject' => $testobject]);
    }

    public function testrun($id) {
        $testrun = Testrun::find($id);
        return view('tester.testrun', ['testrun' => $testrun]);
    }

    public function instance($id) {
        $instance = Testinstance::find($id);
        return view('tester.instance', ['instance' => $instance]);
    }

    public function fetchInstance($id) {
        $instance = Testinstance::find($id);
        $instance->fetch();
        return redirect('/tester/testrun/' . $instance->testrun_id);
    }
}
