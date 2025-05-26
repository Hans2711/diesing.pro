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
    public $renderName = 'Inline';
    public $detailLevel = 'line';

    public function mount()
    {
        $this->generateDiff();
    }

    public function updated($name)
    {
        if (in_array($name, ['instanceOne', 'instanceTwo', 'renderName', 'detailLevel'])) {
            $this->generateDiff();
        }
    }

    protected function generateDiff()
    {
        $this->instanceCount = 0;
        $html = '';
        foreach ($this->testobject->testruns as $run) {
            if ($run->testinstances->count() > $this->instanceCount) {
                $this->instanceCount = $run->testinstances->count();
            }

            if (
                $run->testinstances->count() > max($this->instanceOne, $this->instanceTwo) &&
                isset($run->testinstances[$this->instanceOne]) &&
                isset($run->testinstances[$this->instanceTwo])
            ) {
                $a = $run->testinstances[$this->instanceOne];
                $b = $run->testinstances[$this->instanceTwo];
                $html .= '<h3>' . e($run->name) . ' (' . $run->testinstances->count() . ')</h3>';
                $html .= $a->diff($b, $this->renderName, [], ['detailLevel' => $this->detailLevel]);
            } else {
                $html .= '<h3>' . e($run->name) . ' (' . $run->testinstances->count() . ')</h3>';
            }
        }

        $this->diff = $html;
    }

    public function render()
    {
        return view('livewire.testobject-diff');
    }
}
