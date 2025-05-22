<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FileReference;

/**
 * @extends Factory<FileReference>
 */
class FileReferenceFactory extends Factory
{
    protected $model = FileReference::class;

    public function definition(): array
    {
        return [
            'path' => $this->faker->filePath(),
            'model' => 'Portfolio',
            'foreign_id' => 1,
        ];
    }
}
