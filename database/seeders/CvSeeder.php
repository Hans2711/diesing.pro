<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cv;
use App\Models\ListModel;

class CvSeeder extends Seeder
{
    public function run(): void
    {
        Cv::factory()->count(2)
            ->create()
            ->each(function (Cv $cv) {
                ListModel::factory()->count(3)->create(['cv' => $cv->id]);
            });
    }
}
