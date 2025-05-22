<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Redirect;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends Factory<Redirect>
 */
class RedirectFactory extends Factory
{
    protected $model = Redirect::class;

    public function definition(): array
    {
        $name = $this->faker->sentence(2);
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->randomNumber(),
            'target' => $this->faker->url(),
            'code' => '302',
            'user' => User::factory(),
        ];
    }
}
