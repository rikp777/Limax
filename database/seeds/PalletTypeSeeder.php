<?php

use Illuminate\Database\Seeder;
use App\PalletType;

class PalletTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $palletType = [
            [
                'name' => 'Plastic',
                'description' => 'Plastic',
                'weight' => 23000,
                'price' => 70
            ],
            [
                'name' => 'Euro',
                'description' => 'Euro',
                'weight' => 25000,
                'price' => 8.60
            ],
            [
                'name' => 'DPA',
                'description' => 'DPA',
                'weight' => 15000,
                'price' => 9
            ],
        ];

        PalletType::insert($palletType);
    }
}
