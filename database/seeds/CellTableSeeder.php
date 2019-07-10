<?php

use Illuminate\Database\Seeder;
use App\Cell;

class CellTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cells = [
            [
                'number' => 1,
                'description' => 'Rik',
                'farmer_id' => 1
            ],
            [
                'name' => 1,
                'description' => 'Peeters',
                'farmer_id' => 1
            ]
        ];
        Cell::insert($cells);
    }
}
