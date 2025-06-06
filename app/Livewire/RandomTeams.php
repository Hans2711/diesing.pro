<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\TeamsState;
use Livewire\Attributes\On;

class RandomTeams extends Component
{
    public $players = [];
    public $numberOfPlayers = 0;
    public $teams = [];
    public $numberOfTeams = 2;
    public $teamsLocked = false;
    public $games = [];

    private function getState(): array
    {
        return [
            'players' => $this->players,
            'teams' => $this->teams,
            'numberOfTeams' => $this->numberOfTeams,
            'teamsLocked' => $this->teamsLocked,
            'games' => $this->games,
        ];
    }

    private function persistState(): void
    {
        if (Auth::check()) {
            TeamsState::updateOrCreate(
                ['user' => Auth::id()],
                [
                    'players' => $this->players,
                    'teams' => $this->teams,
                    'number_of_teams' => $this->numberOfTeams,
                    'teams_locked' => $this->teamsLocked,
                    'games' => $this->games,
                ]
            );
        } else {
            $this->dispatch('random-teams-save', $this->getState());
        }
    }

    #[On('loadState')]
    public function loadState($data): void
    {
        $this->players = $data['players'] ?? [];
        $this->teams = $data['teams'] ?? [];
        $this->numberOfTeams = $data['numberOfTeams'] ?? 2;
        $this->teamsLocked = $data['teamsLocked'] ?? false;
        $this->games = $data['games'] ?? [];
    }

    public function newPlayer()
    {
        if ($this->teamsLocked) {
            return;
        }

        $this->players[] = "";
        $this->persistState();
    }

    public function updatePlayerName($name, $key)
    {
        if ($this->teamsLocked) {
            return;
        }

        $key = intval($key);
        $this->players[$key] = $name;

        session(["teams-players" => $this->players]);
        $this->persistState();
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
        $this->persistState();
    }

    public function updateNumberOfTeams($number)
    {
        if ($this->teamsLocked) {
            return;
        }

        $this->numberOfTeams = $number;
        session(["teams-number-of-teams" => $this->numberOfTeams]);
        $this->persistState();
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
        $this->persistState();
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
        $this->persistState();
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
        $this->persistState();
    }

    public function unlockTeams()
    {
        $this->teamsLocked = false;
        session(['teams-locked' => $this->teamsLocked]);
        $this->persistState();
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
        $this->persistState();
    }

    public function newGame()
    {
        if (!$this->teamsLocked || empty($this->teams)) {
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

        session(['teams-games' => $this->games]);
    }

    public function removeGame($index)
    {
        if (!isset($this->games[$index])) {
            return;
        }

        unset($this->games[$index]);
        $this->games = array_values($this->games);

        session(['teams-games' => $this->games]);
    }

    public function mount()
    {
        if (Auth::check()) {
            $state = TeamsState::firstOrCreate(
                ['user' => Auth::id()],
                ['players' => [], 'teams' => [], 'number_of_teams' => 2, 'teams_locked' => false, 'games' => []]
            );
            $this->players = $state->players ?? [];
            $this->teams = $state->teams ?? [];
            $this->numberOfTeams = $state->number_of_teams ?? 2;
            $this->teamsLocked = $state->teams_locked ?? false;
            $this->games = $state->games ?? [];
        } else {
            $this->players = session("teams-players", []);
            $this->teams = session("teams-teams", []);
            $this->numberOfTeams = session("teams-number-of-teams", 2);
            $this->teamsLocked = session('teams-locked', false);
            $this->games = session('teams-games', []);
            $this->dispatch('random-teams-request-state');
        }
    }

    public function render()
    {
        $this->numberOfPlayers = count($this->players);
        return view("livewire.random-teams");
    }
}
