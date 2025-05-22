<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Timetrack;
use App\Models\User;

/**
 * @extends Factory<Timetrack>
 */
class TimetrackFactory extends Factory
{
    protected $model = Timetrack::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(2),
            'times' => json_encode([]),
            'user' => User::factory(),
        ];
    }
}
