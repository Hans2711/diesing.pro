<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Testrun;

class Testobject extends Component
{
    public $testobject;

    public function createRun() {
        $testrun = new Testrun();
        $testrun->testobject_id = $this->testobject->id;

        $testrun->save();
    }

    public function deleteRun($id) {
        Testrun::destroy($id);
    }

    public function render()
    {
        return view('livewire.testobject');
    }
}
