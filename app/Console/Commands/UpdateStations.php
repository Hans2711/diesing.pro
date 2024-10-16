<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Utilities\TransportUtility;

class UpdateStations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-stations';

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
        //
        //
        $transportUtility = new TransportUtility();
        $stations = $transportUtility->getAllStations();

        foreach ($stations as $station) {
            $stationModel = \App\Models\Station::find($station["id"]);
            if (!$stationModel) {
                $stationModel = new \App\Models\Station();
                $stationModel->id = $station["id"];
                $stationModel->name = $station['name'];
                $stationModel->data = json_encode($station);
            }
            $stationModel->name = $station["name"];
            $stationModel->data = json_encode($station);
            $stationModel->save();
        }
    }
}
