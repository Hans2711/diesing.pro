<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Portfolio;
use App\Models\User;

/**
 * @extends Factory<Portfolio>
 */
class PortfolioFactory extends Factory
{
    protected $model = Portfolio::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2),
            'url' => $this->faker->url(),
            'description' => $this->faker->paragraph(),
            'user' => User::factory(),
        ];
    }
}
