<?php

use Illuminate\Database\Seeder;
use App\SortType;

class SortTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sortTypes = [
            [
                'name' => 'Fijn',
                'description' => 'Fijn',
            ],
            [
                'name' => 'Middel',
                'description' => 'Middel',
            ],
            [
                'name' => 'Reuze',
                'description' => 'Reuze',
            ],
            [
                'name' => 'Industrie',
                'description' => 'Industrie',
            ],
        ];
        SortType::insert($sortTypes);
    }
}
