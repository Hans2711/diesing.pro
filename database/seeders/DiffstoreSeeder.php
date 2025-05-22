<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Diffstore;

class DiffstoreSeeder extends Seeder
{
    public function run(): void
    {
        Diffstore::factory()->count(2)->create();
    }
}
