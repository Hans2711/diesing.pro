<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends Factory<Note>
 */
class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition(): array
    {
        $name = $this->faker->sentence(3);
        return [
            'name' => $name,
            'content' => $this->faker->paragraph(),
            'share' => 1,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->randomNumber(),
            'enable_password' => 0,
            'password' => '',
            'user' => User::factory(),
        ];
    }
}
