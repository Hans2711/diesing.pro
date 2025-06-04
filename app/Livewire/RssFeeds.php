<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RssFeed;
use Illuminate\Support\Facades\Auth;

class RssFeeds extends Component
{
    public $feeds;
    public $selectedFeed = [
        'id' => null,
        'url' => '',
    ];

    public function mount()
    {
        $this->feeds = Auth::user()->rssFeeds()->orderBy('created_at', 'desc')->get();
    }

    public function addFeed()
    {
        $feed = RssFeed::create([
            'url' => 'https://example.com/feed.xml',
            'user' => Auth::user()->id,
        ]);

        $this->selectedFeed = $feed->toArray();
        $this->mount();
    }

    public function deleteFeed($id)
    {
        if (!$id) return;
        $feed = RssFeed::find($id);
        if ($feed) $feed->delete();
        $this->cancelEdit();
        $this->mount();
    }

    public function editFeed($id)
    {
        $feed = RssFeed::find($id);
        if ($feed) {
            $this->selectedFeed = $feed->toArray();
        }
    }

    public function updateFeed()
    {
        $this->validate([
            'selectedFeed.url' => 'required|url',
        ]);

        $feed = RssFeed::find($this->selectedFeed['id']);
        if ($feed) {
            $feed->update(['url' => $this->selectedFeed['url']]);
        }
        $this->cancelEdit();
        $this->mount();
    }

    public function cancelEdit()
    {
        $this->selectedFeed = ['id' => null, 'url' => ''];
    }

    public function render()
    {
        return view('livewire.rss-feeds');
    }
}
