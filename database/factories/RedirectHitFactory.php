<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RedirectHit;
use App\Models\Redirect;

/**
 * @extends Factory<RedirectHit>
 */
class RedirectHitFactory extends Factory
{
    protected $model = RedirectHit::class;

    public function definition(): array
    {
        return [
            'ip' => $this->faker->ipv4(),
            'geo' => $this->faker->country(),
            'agent' => $this->faker->userAgent(),
            'redirect' => Redirect::factory(),
        ];
    }
}
