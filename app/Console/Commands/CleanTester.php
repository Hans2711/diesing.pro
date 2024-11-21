<?php

namespace App\Console\Commands;

use App\Models\Testobject;
use App\Models\Diffstore;
use Illuminate\Console\Command;

class CleanTester extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tester:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $testobjects = Testobject::all();

        foreach ($testobjects as $testobject) {
            if ($testobject->delete_after > 0) {
                foreach ($testobject->testruns as $testrun) {
                    if ($testrun->shouldDeleted()) {
                        foreach ($testrun->testinstances as $instance) {
                            $instance->delete();
                        }
                        $testrun->delete();
                    }
                }
            }
        }

        $diffstore = Diffstore::all();
        foreach ($diffstore as $store) {
            if ($store->shouldDeleted()) {
                $store->delete();
            }
        }
    }
}
