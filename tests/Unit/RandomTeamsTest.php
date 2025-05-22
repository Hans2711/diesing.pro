<?php

namespace Tests\Unit;

use App\Livewire\RandomTeams;
use Tests\TestCase;
class RandomTeamsTest extends TestCase
{
    public function test_generate_teams_creates_expected_teams(): void
    {
        $component = new RandomTeams();
        $component->players = ['Alice', 'Bob', 'Charlie', 'Dave', 'Eve', 'Frank'];
        $component->numberOfTeams = 3;

        $component->generateTeams();

        // Assert there are exactly 3 teams
        $this->assertCount(3, $component->teams);

        // Collect all players from the generated teams
        $allPlayers = [];
        foreach ($component->teams as $team) {
            $allPlayers = array_merge($allPlayers, $team);
        }

        // Each player should appear exactly once
        $this->assertCount(count($component->players), $allPlayers);
        $counts = array_count_values($allPlayers);
        foreach ($component->players as $player) {
            $this->assertSame(1, $counts[$player] ?? 0, "Player {$player} should appear once");
        }
    }
}
