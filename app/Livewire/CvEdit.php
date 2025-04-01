<?php

namespace App\Livewire;

use App\Models\Cv;
use App\Models\ListModel; // Import ListModel
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CvEdit extends Component
{
    public $cv;

    public $name = '';
    public $birthday = '';
    public $nationality = '';
    public $address = '';
    public $phone = '';
    public $email = '';
    public $parents = '';
    public $siblings = '';

    // List data
    public $lists = []; // Store dynamic list items

    // Save or create the CV
    public function save() {
        // Check if there is already a CV associated with the user
        if ($this->cv) {
            // If CV exists, update the existing CV
            $this->cv->update([
                'name' => $this->name,
                'birthday' => $this->birthday,
                'nationality' => $this->nationality,
                'address' => $this->address,
                'phone' => $this->phone,
                'email' => $this->email,
                'parents' => $this->parents,
                'siblings' => $this->siblings,
            ]);
        } else {
            // If no CV exists, create a new one
            $this->cv = Cv::create([
                'name' => $this->name,
                'birthday' => $this->birthday,
                'nationality' => $this->nationality,
                'address' => $this->address,
                'phone' => $this->phone,
                'email' => $this->email,
                'parents' => $this->parents,
                'siblings' => $this->siblings,
            ]);

            // Associate the newly created CV with the user
            Auth::user()->cv()->associate($this->cv);
            Auth::user()->save();
        }

        // Save lists if any
        $this->saveLists();

        session()->flash('status', 'CV saved successfully!');
    }

    // Save, update, or delete list data to/from the database
    public function saveLists() {
        // First, delete any lists that are no longer in the $lists array
        $existingLists = ListModel::where('cv', $this->cv->id)->get(); // Get all lists for this CV

        // Loop through existing lists and check if they are still in the $lists array
        foreach ($existingLists as $existingList) {
            $listInForm = collect($this->lists)->firstWhere('id', $existingList->id);

            // If the list is not in the form data anymore, delete it
            if (!$listInForm) {
                $existingList->delete();
            }
        }

        // Now, handle the lists in the form (add or update)
        foreach ($this->lists as $index => $list) {
            // Check if the list exists (by its id or a new entry)
            $existingList = ListModel::where('cv', $this->cv->id)
                ->where('id', $list['id'] ?? null) // If 'id' is set, it means it should be updated
                ->first();

            if ($existingList) {
                // If the list exists, update it
                $existingList->update([
                    'title' => $list['title'],
                    'content' => $list['content'],
                ]);
            } else {
                // If no list exists, create a new one
                ListModel::create([
                    'title' => $list['title'],
                    'content' => $list['content'],
                    'cv' => $this->cv->id, // Associate with the CV
                ]);
            }
        }
    }

    // Add a new list entry
    public function addList() {
        $this->lists[] = ['title' => '', 'content' => '']; // Add a new empty list entry
    }

    // Remove a list entry
    public function removeList($index) {
        array_splice($this->lists, $index, 1); // Remove the item at the given index
    }

    // Mount the component and load the current CV if it exists
    public function mount() {
        $this->cv = Auth::user()->cv()->first(); // Load the CV associated with the authenticated user

        // If there is a CV, populate the form fields
        if ($this->cv) {
            $this->name = $this->cv->name;
            $this->birthday = $this->cv->birthday;
            $this->nationality = $this->cv->nationality;
            $this->address = $this->cv->address;
            $this->phone = $this->cv->phone;
            $this->email = $this->cv->email;
            $this->parents = $this->cv->parents;
            $this->siblings = $this->cv->siblings;

            // Load existing lists for this CV
            $this->lists = $this->cv->lists->toArray();
        }
    }

    // Render the component view
    public function render()
    {
        return view('livewire.cv-edit');
    }
}
