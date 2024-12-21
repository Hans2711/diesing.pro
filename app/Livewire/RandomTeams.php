<?php

namespace App\Livewire;

use Livewire\Component;

class RandomTeams extends Component
{
    public $players = [];
    public $teams = [];
    public $numberOfTeams = 2;

    public function newPlayer()
    {
        $this->players[] = "";
    }

    public function updatePlayerName($name, $key)
    {
        $key = intval($key);
        $this->players[$key] = $name;

        session(["teams-players" => $this->players]);
    }

    public function deletePlayer($key)
    {
        $key = intval($key);
        unset($this->players[$key]);
        $this->teams = [];

        session(["teams-players" => $this->players]);
        session(["teams-teams" => $this->teams]);
    }

    public function updateNumberOfTeams($number)
    {
        $this->numberOfTeams = $number;
        session(["teams-number-of-teams" => $this->numberOfTeams]);
    }

    public function generateTeams()
    {
        $playersLeft = count($this->players);
        $players = $this->players;

        $this->teams = [];

        for ($i = 0; $i < $this->numberOfTeams; $i++) {
            $this->teams[$i] = [];

            $playersInTeam = floor($playersLeft / ($this->numberOfTeams - $i));
            while ($playersInTeam > 0) {
                $player = array_rand($players);
                $this->teams[$i][] = $players[$player];
                unset($players[$player]);
                $playersInTeam--;
                $playersLeft--;
            }
        }
        shuffle($this->teams);

        session(["teams-teams" => $this->teams]);
    }

    public function mount()
    {
        $this->players = session("teams-players", []);
        $this->teams = session("teams-teams", []);
        $this->numberOfTeams = session("teams-number-of-teams", 2);
    }

    public function render()
    {
        return view("livewire.random-teams");
    }
}
