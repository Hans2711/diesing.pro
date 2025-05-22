<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Testrun;
use App\Models\Testobject;

/**
 * @extends Factory<Testrun>
 */
class TestrunFactory extends Factory
{
    protected $model = Testrun::class;

    public function definition(): array
    {
        return [
            'testobject_id' => Testobject::factory(),
            'name' => $this->faker->sentence(2),
        ];
    }
}
