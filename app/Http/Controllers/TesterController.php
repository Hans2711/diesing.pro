<?php

namespace App\Http\Controllers;

use App\Models\Testinstance;
use App\Models\Testobject;
use App\Models\Testrun;
use Illuminate\Http\Request;

class TesterController extends Controller
{
    //
    public function index() {
        return view('tester.index');
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
