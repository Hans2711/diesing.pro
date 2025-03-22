<?php

namespace App\Livewire;

use App\Models\Diffstore;
use App\Models\Testinstance;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

class Testrun extends Component
{
    public $testrun;

    public $diffInstanceOne;
    public $diffInstanceTwo;

    public $diffContent;
    public $renderName = "Inline";
    public $detailLevel = "line";

    public function updateName($name) {
        $this->testrun->name = $name;
        $this->testrun->save();
    }

    public function createInstance()
    {
        $testInstance = new Testinstance();
        $testInstance->testrun_id = $this->testrun->id;
        $testInstance->save();
        session()->flash("message", "Instance created successfully.");
    }

    public function fetchInstance($id)
    {
        $testInstance = Testinstance::find($id);

        if (!empty($testInstance)) {
            $testInstance->fetch();
            session()->flash("message", "Fetch completed successfully.");
        }
    }

    public function diff()
    {
        $options = ["detailLevel" => $this->detailLevel];
        $this->diffContent = $this->diffInstanceOne->diff(
            $this->diffInstanceTwo,
            $this->renderName,
            [],
            $options
        );

        $diffUrl = url(
            Config::get("app.locale") .
                "/tester/diff/" .
                $this->diffInstanceOne->id .
                "/" .
                $this->diffInstanceTwo->id .
                ($this->renderName != "Inline"
                    ? "?renderName=" . $this->renderName
                    : "") .
                ($this->detailLevel != "line"
                    ? ($this->renderName != "Inline" ? "&" : "?") .
                        "detailLevel=" .
                        $this->detailLevel
                    : "")
        );

        if (!empty($this->diffContent)) {
            $diffObj = Diffstore::where("key", $diffUrl)->first();

            if (empty($diffObj)) {
                $diffObj = new Diffstore();
                $diffObj->key = $diffUrl;
                $diffObj->html = $this->diffContent;
                $diffObj->save();
            }
        }

        session()->flash("diff", $diffUrl);
    }

    public function addToDiff($id)
    {
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
        session()->flash("message", "Instance added to diff successfully.");
    }

    public function deleteInstance($id)
    {
        Testinstance::destroy($id);
        session()->flash("message", "Instance deleted successfully.");
    }

    public function render()
    {
        return view("livewire.testrun");
    }
}
