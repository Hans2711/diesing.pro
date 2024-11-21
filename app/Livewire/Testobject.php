<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Testrun;

class Testobject extends Component
{
    public $testobject;
    public $deleteAfter;
    public $deleteAfterOptions = [
        "86400" => '1 Day',
        "604800" => '7 Days',
        "2629800" => '1 Month',
        "0" => 'Never',
    ];

    public function updateDeleteAfter($deleteAfter) {
        $this->deleteAfter = $deleteAfter;
        $this->testobject->delete_after = $deleteAfter;
        $this->testobject->save();
    }

    public function createRun() {
        $testrun = new Testrun();
        $testrun->testobject_id = $this->testobject->id;
        $testrun->save();
        session()->flash('message', 'Testrun created successfully.');
    }

    public function deleteRun($id) {
        foreach ($this->testobject->testruns as $a) {
            if ($a->id == $id) {
                foreach ($a->testinstances as $b) {
                    $b->delete();
                }
            }
        }

        Testrun::destroy($id);
        $this->testobject = \App\Models\Testobject::find($this->testobject->id);
        session()->flash('message', 'Testrun deleted successfully.');
    }

    public function render()
    {
        return view('livewire.testobject');
    }
}
