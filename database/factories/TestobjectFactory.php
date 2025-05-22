<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Testobject;
use App\Models\User;

/**
 * @extends Factory<Testobject>
 */
class TestobjectFactory extends Factory
{
    protected $model = Testobject::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2),
            'url' => $this->faker->url(),
            'delete_after' => 86400,
            'user' => User::factory(),
        ];
    }
}
