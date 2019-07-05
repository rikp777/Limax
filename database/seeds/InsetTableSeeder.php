<?php

use Illuminate\Database\Seeder;
use App\Inset;

class InsetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insets = [
            [
                'name' => 'CH052',
                'description' => 'CH052',
                'amount' => 770,
                'code' => 'ID0010XX',
                'color' => 'styro'
            ],
            [
                'name' => 'CH050',
                'description' => 'CH050',
                'amount' => 770,
                'code' => 'ID0011XX',
                'color' => 'blauw'
            ],
            [
                'name' => 'CH051',
                'description' => 'CH051',
                'amount' => 770,
                'code' => 'ID0012XX',
                'color' => 'groen'
            ]
        ];

        Inset::insert($insets);
    }
}
