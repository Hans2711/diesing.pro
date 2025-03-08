<?php

namespace App\Livewire;

use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Session;
use Livewire\Component;
use Livewire\Attributes\On;

class PortfolioEdit extends Component
{
    public $portfolios;

    public $activePortfolio = null;
    public $name = "";
    public $url = "";
    public $description = "";

    public function mount()
    {
        $this->portfolios = Portfolio::where("user", Auth::id())->get();
    }

    public function addPortfolio()
    {
        $portfolio = new Portfolio();
        $portfolio->user = Auth::id();
        $portfolio->save();

        $this->portfolios->push($portfolio);

        $this->activePortfolio = $portfolio;
        $this->triggerEdit();
    }

    public function editPortfolio($id)
    {
        $portfolio = Portfolio::find($id);
        $this->activePortfolio = $portfolio;
        $this->triggerEdit();
    }

    public function deletePortfolio($id)
    {
        $portfolio = Portfolio::find($id);
        if ($portfolio) {
            $portfolio->delete();
            $this->mount();
        }
    }

    public function edit()
    {
        $this->activePortfolio->name = $this->name;
        $this->activePortfolio->url = $this->url;
        $this->activePortfolio->save();

        session()->flash("status", __("text.saved"));
    }

    public function cancelEdit()
    {
        $this->activePortfolio = null;
        $this->triggerEdit();
    }

    #[On("desc-changed")]
    public function descChanged($content)
    {
        $this->description = $content;
        $this->activePortfolio->description = $content;
        $this->activePortfolio->save();
    }

    private function triggerEdit()
    {
        $this->name = $this->activePortfolio->name ?? "";
        $this->url = $this->activePortfolio->url ?? "";
        $this->description = $this->activePortfolio->description ?? "";
    }

    public function render()
    {
        return view("livewire.portfolio-edit");
    }
}
