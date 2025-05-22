<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ListModel;

class ListModelSeeder extends Seeder
{
    public function run(): void
    {
        ListModel::factory()->count(5)->create();
    }
}
