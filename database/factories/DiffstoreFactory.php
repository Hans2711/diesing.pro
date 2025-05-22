<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Diffstore;

/**
 * @extends Factory<Diffstore>
 */
class DiffstoreFactory extends Factory
{
    protected $model = Diffstore::class;

    public function definition(): array
    {
        return [
            'key' => $this->faker->uuid(),
            'html' => '<p>' . $this->faker->sentence() . '</p>',
        ];
    }
}
