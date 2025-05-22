<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Testinstance;
use App\Models\Testrun;

/**
 * @extends Factory<Testinstance>
 */
class TestinstanceFactory extends Factory
{
    protected $model = Testinstance::class;

    public function definition(): array
    {
        return [
            'html' => '<p>' . $this->faker->paragraph() . '</p>',
            'headers' => json_encode(['Content-Type' => 'text/html']),
            'testrun_id' => Testrun::factory(),
        ];
    }
}
