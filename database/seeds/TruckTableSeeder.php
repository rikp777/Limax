<?php

use Illuminate\Database\Seeder;
use App\Truck;

class TruckTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $truck = [
            [
                'license_plate' => '89-TSF-3',
                'status_id' => 1,
                'user_id' => 3
            ],
            [
                'license_plate' => '32-VWG-4',
                'status_id' => 1,
                'user_id' => 5
            ]
        ];
        Truck::insert($truck);
    }
}
