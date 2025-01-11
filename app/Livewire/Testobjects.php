<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Testobject;
use Illuminate\Support\Facades\Auth;

class Testobjects extends Component
{
    public $name;
    public $url;
    public $testobjects;
    public $testobject;

    public function mount()
    {
        $this->testobjects = Testobject::where("user", Auth::user()->id)
            ->orderBy("created_at", "desc")
            ->get();
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->name = "";
        $this->url = "";
        $this->testobject = null;
    }

    public function createObject()
    {
        if (empty($this->name) || empty($this->url)) {
            session()->flash("error", "Both name and URL are required.");
            return;
        }

        Testobject::create([
            "name" => $this->name,
            "url" => $this->url,
            "user" => Auth::user()->id,
        ]);

        session()->flash("message", "Testobject created successfully.");

        $this->mount();
        $this->resetInputFields();
    }

    public function deleteObject($id)
    {
        $testobject = Testobject::find($id);

        if ($testobject) {
            foreach ($testobject->testruns as $a) {
                foreach ($a->testinstances as $b) {
                    $b->delete();
                }
                $a->delete();
            }
            $testobject->delete();
            session()->flash("message", "Testobject deleted successfully.");
            $this->mount();
        } else {
            session()->flash("error", "Testobject not found.");
        }
    }

    public function editObject($id)
    {
        $testobject = Testobject::find($id);

        if ($testobject) {
            $this->testobject = $testobject;
            $this->name = $testobject->name;
            $this->url = $testobject->url;
        } else {
            session()->flash("error", "Testobject not found.");
        }
    }

    public function updateObject()
    {
        if (!$this->testobject) {
            session()->flash("error", "No Testobject selected for updating.");
            return;
        }

        if (empty($this->name) || empty($this->url)) {
            session()->flash("error", "Both name and URL are required.");
            return;
        }

        $this->testobject->update([
            "name" => $this->name,
            "url" => $this->url,
        ]);

        session()->flash("message", "Testobject updated successfully.");

        $this->mount();
        $this->resetInputFields();
    }

    public function render()
    {
        return view("livewire.testobjects", [
            "testobjects" => $this->testobjects,
        ]);
    }
}
