<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cv;

/**
 * @extends Factory<Cv>
 */
class CvFactory extends Factory
{
    protected $model = Cv::class;

    public function definition(): array
    {
        return [
            'fields' => '{}',
        ];
    }
}
