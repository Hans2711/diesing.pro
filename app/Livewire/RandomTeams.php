<?php

namespace App\Livewire;

use Livewire\Component;

class RandomTeams extends Component
{
    public $players = [];
    public $numberOfPlayers = 0;
    public $teams = [];
    public $numberOfTeams = 2;
    public $teamsLocked = false;
    public $games = [];

    public function newPlayer()
    {
        if ($this->teamsLocked) {
            return;
        }

        $this->players[] = "";
    }

    public function updatePlayerName($name, $key)
    {
        if ($this->teamsLocked) {
            return;
        }

        $key = intval($key);
        $this->players[$key] = $name;

        session(["teams-players" => $this->players]);
    }

    public function deletePlayer($key)
    {
        if ($this->teamsLocked) {
            return;
        }

        if (empty($key) && $key !== 0) {
            return;
        }

        $key = intval($key);
        unset($this->players[$key]);
        $this->teams = [];

        session(["teams-players" => $this->players]);
        session(["teams-teams" => $this->teams]);
    }

    public function updateNumberOfTeams($number)
    {
        if ($this->teamsLocked) {
            return;
        }

        $this->numberOfTeams = $number;
        session(["teams-number-of-teams" => $this->numberOfTeams]);
    }

    public function generateTeams()
    {
        if ($this->teamsLocked) {
            return;
        }

        $playersLeft = count($this->players);
        $players = $this->players;

        $this->teams = [];

        for ($i = 0; $i < $this->numberOfTeams; $i++) {
            $this->teams[$i] = [
                'name' => __('text.team-name') . ' ' . ($i + 1),
                'players' => [],
            ];

            $playersInTeam = floor($playersLeft / ($this->numberOfTeams - $i));
            while ($playersInTeam > 0) {
                $player = array_rand($players);
                $this->teams[$i]['players'][] = $players[$player];
                unset($players[$player]);
                $playersInTeam--;
                $playersLeft--;
            }
        }
        shuffle($this->teams);

        session(["teams-teams" => $this->teams]);
    }

    public function updateTeamName($name, $index)
    {
        if ($this->teamsLocked) {
            return;
        }

        $index = intval($index);
        if (!isset($this->teams[$index])) {
            return;
        }

        $this->teams[$index]['name'] = $name;
        session(["teams-teams" => $this->teams]);
    }

    public function lockTeams()
    {
        if ($this->teamsLocked || empty($this->teams)) {
            return;
        }

        $gameTeams = [];
        foreach ($this->teams as $team) {
            $gameTeams[] = [
                'name' => $team['name'],
                'players' => $team['players'],
                'wins' => 0,
            ];
        }
        $this->games[] = ['teams' => $gameTeams];

        $this->teamsLocked = true;
        session([
            'teams-games' => $this->games,
            'teams-locked' => $this->teamsLocked,
        ]);
    }

    public function unlockTeams()
    {
        $this->teamsLocked = false;
        session(['teams-locked' => $this->teamsLocked]);
    }

    public function updateWins($index, $delta)
    {
        if (!$this->teamsLocked) {
            return;
        }

        $gameIndex = count($this->games) - 1;
        if ($gameIndex < 0 || !isset($this->games[$gameIndex]['teams'][$index])) {
            return;
        }

        $wins = $this->games[$gameIndex]['teams'][$index]['wins'] + $delta;
        if ($wins < 0) {
            $wins = 0;
        }
        $this->games[$gameIndex]['teams'][$index]['wins'] = $wins;

        session(['teams-games' => $this->games]);
    }

    public function mount()
    {
        $this->players = session("teams-players", []);
        $this->teams = session("teams-teams", []);
        $this->numberOfTeams = session("teams-number-of-teams", 2);
        $this->teamsLocked = session('teams-locked', false);
        $this->games = session('teams-games', []);
    }

    public function render()
    {
        $this->numberOfPlayers = count($this->players);
        return view("livewire.random-teams");
    }
}
