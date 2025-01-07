<?php

namespace App\Livewire;

use App\Models\Redirect;
use Livewire\Component;

class Redirects extends Component
{
    public $redirects;
    public $selectedRedirect = [
        "id" => null,
        "name" => "",
        "target" => "",
        "code" => 301,
    ];

    public function addRedirect()
    {
        $redirect = Redirect::create([
            "name" => "New Redirect",
            "target" => "https://example.com",
            "code" => 301,
        ]);

        $this->selectedRedirect = $redirect->toArray();

        $this->mount();
    }

    public function deleteRedirect($id)
    {
        if (empty($id)) {
            return;
        }

        $redirect = Redirect::find($id);

        $redirect->delete();
        $this->mount();
    }

    public function editRedirect($id)
    {
        if (empty($id)) {
            return;
        }

        $redirect = Redirect::find($id);

        if ($redirect) {
            $this->selectedRedirect = $redirect->toArray();
        }
    }

    public function updateRedirect()
    {
        $this->validate([
            "selectedRedirect.name" => "required|string|max:255",
            "selectedRedirect.target" => "required|url",
            "selectedRedirect.code" => "required|integer|in:301,302,307",
        ]);

        $redirect = Redirect::find($this->selectedRedirect["id"]);

        if ($redirect) {
            $redirect->workRedirect();
            $redirect->update($this->selectedRedirect);
        }

        $this->cancelEdit();
        $this->mount();
    }

    public function cancelEdit()
    {
        $this->selectedRedirect = [
            "id" => null,
            "name" => "",
            "target" => "",
            "code" => 301,
        ];
    }

    public function render()
    {
        return view("livewire.redirects");
    }

    public function mount()
    {
        $this->redirects = Redirect::orderBy("created_at", "desc")->get();
    }
}
