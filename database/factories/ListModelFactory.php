<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ListModel;
use App\Models\Cv;

/**
 * @extends Factory<ListModel>
 */
class ListModelFactory extends Factory
{
    protected $model = ListModel::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(),
            'cv' => Cv::factory(),
            'sort_order' => $this->faker->numberBetween(0, 10),
            'column' => $this->faker->numberBetween(1, 2),
            'pagebreak' => $this->faker->numberBetween(0, 1),
        ];
    }
}
