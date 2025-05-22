<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FileReference;

class FileReferenceSeeder extends Seeder
{
    public function run(): void
    {
        FileReference::factory()->count(2)->create();
    }
}
