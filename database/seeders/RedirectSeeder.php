<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Redirect;
use App\Models\RedirectHit;

class RedirectSeeder extends Seeder
{
    public function run(): void
    {
        Redirect::factory()->count(3)->create()->each(function (Redirect $redirect) {
            RedirectHit::factory()->count(2)->create(['redirect' => $redirect->id]);
        });
    }
}
