<?php

use Illuminate\Database\Seeder;
Use App\CultivationCycleFlight;

class CultivationCycleFlightTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cultivationCycleFlights = [
            [
                'date' => '2019-08-26',
                'cultivation_cycle_id' => 1
            ],
            [
                'date' => '2019-08-30',
                'cultivation_cycle_id' => 2,
            ],
        ];
        CultivationCycleFlight::insert($cultivationCycleFlights);
    }
}
