<?php

namespace App\Livewire;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notes extends Component
{
    public $notes;
    public Note $selectedNote;

    public function updateNoteName($name)
    {
        $this->selectedNote->name = $name;
        $this->selectedNote->slug = preg_replace(
            "/\s+/",
            "-",
            strtolower($name)
        );
        $this->selectedNote->save();

        $this->notes = Auth::user()->notes;
    }

    public function updateNoteContent($content)
    {
        $this->selectedNote->content = $content;
        $this->selectedNote->save();
    }

    public function updateSelectedNote($id)
    {
        foreach ($this->notes as $note) {
            if ($note->id == $id) {
                $this->selectedNote = $note;
                session(["selectedNote" => $note->id]);
                break;
            }
        }
    }

    public function updateShare($value)
    {
        $this->selectedNote->share = $value ? 1 : 0;
        $this->selectedNote->save();
    }

    public function deleteNote()
    {
        $this->selectedNote->delete();
        $this->notes = Auth::user()->notes;
        $this->selectedNote = $this->notes->first();
    }

    public function addNote()
    {
        $note = new Note();
        $note->user = Auth::user()->id;
        $note->save();

        $this->notes = Auth::user()->notes;
        $this->selectedNote = $note;

        session(["selectedNote" => $note->id]);
    }

    public function render()
    {
        return view("livewire.notes");
    }

    public function mount()
    {
        $this->notes = Auth::user()->notes;
        if (empty($this->notes)) {
            $note = new Note();
            $note->save();
            $this->notes = Note::all();
        }

        if (session()->has("selectedNote")) {
            $this->selectedNote =
                Note::find(session("selectedNote")) ?? $this->notes->first();
        } else {
            $this->selectedNote = $this->notes->first()
                ? $this->notes->first()
                : new Note();
        }
    }
}
