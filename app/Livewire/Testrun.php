<?php

namespace App\Livewire;

use App\Models\Testinstance;
use Livewire\Component;

class Testrun extends Component
{
    public $testrun;

    public $diffInstanceOne;
    public $diffInstanceTwo;

    public $diffContent;
    public $renderName = 'Inline';
    public $detailLevel = 'line';

    public function createInstance() {
        $testInstance = new Testinstance();
        $testInstance->testrun_id = $this->testrun->id;
        $testInstance->save();
        session()->flash('message', 'Instance created successfully.');
    }

    public function diff() {
        $options = ['detailLevel' => $this->detailLevel];
        $this->diffContent = $this->diffInstanceOne->diff($this->diffInstanceTwo, $this->renderName, [], $options);
        session()->flash('diff', 'Executed');
    }

    public function addToDiff($id) {
        $testInstance = Testinstance::find($id);

        if (!empty($testInstance)) {
            if (empty($this->diffInstanceOne)) {
                $this->diffInstanceOne = $testInstance;
            } else {
                if ($this->diffInstanceOne != $testInstance) {
                    $this->diffInstanceTwo = $testInstance;
                }
            }
        }
        session()->flash('message', 'Instance added to diff successfully.');
    }

    public function deleteInstance($id) {
        Testinstance::destroy($id);
        session()->flash('message', 'Instance deleted successfully.');
    }

    public function render()
    {
        return view('livewire.testrun');
    }
}
