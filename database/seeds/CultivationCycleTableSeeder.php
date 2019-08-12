<?php

use Illuminate\Database\Seeder;
Use App\CultivationCycle;

class CultivationCycleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cultivationCycles = [
            [
                'cell_description' => 'test cell 1',
                'fill_date' => '2019-08-12',
                'cell_id' => 1,
                'farmer_id' => '1',
                'article_group_id' => '1'
            ],
            [
                'cell_description' => 'test cell 2',
                'fill_date' => '2019-08-16',
                'cell_id' => 2,
                'farmer_id' => '2',
                'article_group_id' => '2'
            ],
        ];
        CultivationCycle::insert($cultivationCycles);
    }
}
