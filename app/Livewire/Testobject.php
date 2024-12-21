<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Testrun;

class Testobject extends Component
{
    public $testobject;
    public $deleteAfter;
    public $deleteAfterOptions;

    public function mount()
    {
        $this->deleteAfterOptions = [
            "86400" => __("text.1-day"),
            "604800" => __("text.7-days"),
            "2629800" => __("text.1-month"),
            "0" => __("text.never"),
        ];
    }

    public function updateDeleteAfter($deleteAfter)
    {
        $this->deleteAfter = $deleteAfter;
        $this->testobject->delete_after = $deleteAfter;
        $this->testobject->save();
    }

    public function createRun()
    {
        $testrun = new Testrun();
        $testrun->testobject_id = $this->testobject->id;
        $testrun->save();
        session()->flash("message", "Testrun created successfully.");
    }

    public function deleteRun($id)
    {
        foreach ($this->testobject->testruns as $a) {
            if ($a->id == $id) {
                foreach ($a->testinstances as $b) {
                    $b->delete();
                }
            }
        }

        Testrun::destroy($id);
        $this->testobject = \App\Models\Testobject::find($this->testobject->id);
        session()->flash("message", "Testrun deleted successfully.");
    }

    public function render()
    {
        return view("livewire.testobject");
    }
}
