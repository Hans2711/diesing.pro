<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Testobject;

class Testobjects extends Component
{
    public $name;
    public $url;
    public $testobjects;
    public $testobject; // Holds the selected Testobject for updating

    /**
     * Mount the component and initialize properties.
     */
    public function mount()
    {
        $this->testobjects = Testobject::all();
        $this->resetInputFields(); // Reset form inputs
    }

    /**
     * Reset form input fields.
     */
    public function resetInputFields()
    {
        $this->name = '';
        $this->url = '';
        $this->testobject = null;
    }

    /**
     * Create a new Testobject.
     */
    public function createObject()
    {
        if (empty($this->name) || empty($this->url)) {
            session()->flash('error', 'Both name and URL are required.');
            return;
        }

        Testobject::create([
            'name' => $this->name,
            'url' => $this->url,
        ]);

        session()->flash('message', 'Testobject created successfully.');

        $this->testobjects = Testobject::all(); // Refresh the list
        $this->resetInputFields(); // Clear the form
    }

    /**
     * Delete an existing Testobject.
     */
    public function deleteObject($id)
    {
        $testobject = Testobject::find($id);

        if ($testobject) {
            $testobject->delete();
            session()->flash('message', 'Testobject deleted successfully.');
            $this->testobjects = Testobject::all(); // Refresh the list
        } else {
            session()->flash('error', 'Testobject not found.');
        }
    }

    /**
     * Prepare an object for editing.
     */
    public function editObject($id)
    {
        $testobject = Testobject::find($id);

        if ($testobject) {
            $this->testobject = $testobject;
            $this->name = $testobject->name;
            $this->url = $testobject->url;
        } else {
            session()->flash('error', 'Testobject not found.');
        }
    }

    /**
     * Update the selected Testobject.
     */
    public function updateObject()
    {
        if (!$this->testobject) {
            session()->flash('error', 'No Testobject selected for updating.');
            return;
        }

        if (empty($this->name) || empty($this->url)) {
            session()->flash('error', 'Both name and URL are required.');
            return;
        }

        $this->testobject->update([
            'name' => $this->name,
            'url' => $this->url,
        ]);

        session()->flash('message', 'Testobject updated successfully.');

        $this->testobjects = Testobject::all(); // Refresh the list
        $this->resetInputFields(); // Clear the form
    }

    /**
     * Render the Livewire view.
     */
    public function render()
    {
        return view('livewire.testobjects', [
            'testobjects' => $this->testobjects,
        ]);
    }
}
