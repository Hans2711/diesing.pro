<?php

namespace App\Livewire;

use Livewire\Component;

class TestobjectDiff extends Component
{
    public $testobject;
    public $diff;
    public $instanceCount = 0;

    public $instanceOne = 1;
    public $instanceTwo = 0;

    public function mount() {
        $html = "";
        foreach ($this->testobject->testruns as $run) {
            if ($run->testinstances->count() > $this->instanceCount) {
                $this->instanceCount = $run->testinstances->count();
            }

            if (
                $run->testinstances->count() >= 2 &&
                    isset($run->testinstances[$this->instanceOne]) &&
                    isset($run->testinstances[$this->instanceTwo])
            ) {
                $a = $run->testinstances[$this->instanceOne];
                $b = $run->testinstances[$this->instanceTwo];
                $html .= "<h3>" . e($run->name) . "</h3>";
                $html .= $a->diff($b, "Inline");
            }
        }
        $this->diff = $html;
    }

    public function render()
    {
        return view('livewire.testobject-diff');
    }
}
