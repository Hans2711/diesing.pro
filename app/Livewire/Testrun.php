<?php

namespace App\Livewire;

use App\Models\Testinstance;
use Livewire\Component;

class Testrun extends Component
{
    public $testrun;

    public function createInstance() {
        $testInstance = new Testinstance();
        $testInstance->testrun_id = $this->testrun->id;
        $testInstance->save();
    }

    public function deleteInstance($id) {
        Testinstance::destroy($id);
    }

    public function render()
    {
        return view('livewire.testrun');
    }
}
