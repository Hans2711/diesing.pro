<?php

namespace App\Livewire;

use App\Models\Cv;
use App\Models\ListModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CvEdit extends Component
{
    public $cv;
    public $fields = [];
    public $lists = [];

    #[On("content-updated")]
    public function contentUpdated($content, $index)
    {
        $countIndex = 0;
        foreach ($this->lists as $listIndex => $list) {
            foreach ($list['items'] as $itemIndex => $item) {
                if ($countIndex == $index) {
                    $this->lists[$listIndex]['items'][$itemIndex]['content'] = $content;
                    break 2;
                }
                $countIndex++;
            }
        }

    }



    public function mount()
    {
        $this->cv = Auth::user()->cv()->first();

        if ($this->cv) {
            $this->fields = json_decode($this->cv->fields, true) ?? [];

            // Load lists with title and items
            $this->lists = $this->cv->lists->map(function ($list) {
                return [
                    'id' => $list->id,
                    'title' => $list->title,
                    'items' => json_decode($list->content, true) ?? []
                ];
            })->toArray();
        }
    }

    public function save()
    {
        if ($this->cv) {
            $this->cv->update([
                'fields' => json_encode($this->fields),
            ]);
        } else {
            $this->cv = Cv::create([
                'fields' => json_encode($this->fields),
            ]);

            Auth::user()->cv()->associate($this->cv);
            Auth::user()->save();
        }

        $this->saveLists();
        session()->flash('status', 'CV saved successfully!');
    }

    public function saveLists()
    {
        $existingLists = ListModel::where('cv', $this->cv->id)->get();

        foreach ($existingLists as $existingList) {
            $listInForm = collect($this->lists)->firstWhere('id', $existingList->id);
            if (!$listInForm) {
                $existingList->delete();
            }
        }

        foreach ($this->lists as $index => $list) {
            $existingList = ListModel::where('cv', $this->cv->id)
                ->where('id', $list['id'] ?? null)
                ->first();

            if ($existingList) {
                $existingList->update([
                    'title' => $list['title'],
                    'content' => json_encode($list['items']),
                ]);
            } else {
                ListModel::create([
                    'title' => $list['title'],
                    'content' => json_encode($list['items']),
                    'cv' => $this->cv->id,
                ]);
            }
        }
    }

    public function addField()
    {
        $this->fields[] = ['title' => '', 'content' => ''];
    }

    public function removeField($index)
    {
        array_splice($this->fields, $index, 1);
    }

    public function addList()
    {
        $this->lists[] = ['id' => null, 'title' => '', 'items' => [['title' => '', 'content' => '']]];
    }

    public function removeList($index)
    {
        array_splice($this->lists, $index, 1);
    }

    public function addListItem($listIndex)
    {
        $this->lists[$listIndex]['items'][] = ['title' => '', 'content' => ''];
    }

    public function removeListItem($listIndex, $itemIndex)
    {
        array_splice($this->lists[$listIndex]['items'], $itemIndex, 1);
    }

    public function render()
    {
        return view('livewire.cv-edit');
    }
}
