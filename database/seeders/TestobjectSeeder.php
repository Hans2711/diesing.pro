<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testobject;
use App\Models\Testrun;
use App\Models\Testinstance;

class TestobjectSeeder extends Seeder
{
    public function run(): void
    {
        Testobject::factory()->count(2)->create()->each(function (Testobject $object) {
            Testrun::factory()->count(2)->create(['testobject_id' => $object->id])->each(function (Testrun $run) {
                Testinstance::factory()->count(2)->create(['testrun_id' => $run->id]);
            });
        });
    }
}
