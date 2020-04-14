<?php

use Illuminate\Database\Seeder;
Use App\PalletLabel;

class PalletlabelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $palletLabels = [
            [
                'crop_date' => '2019-08-14',
                'article_amount' => '160',
                'note' => 'seeded label',
                'pallet_label_farmer_id' => '1',
                'cell_number' => '1',
                'cell_description' => 'seeded label',
                'harvest_cycle' => '1',
                'harvest_cycle_day' => '1',
                'user_id' => '2',
                'farmer_id' => '1',
                'cultivation_cycle_id' => 1,
                'pallet_type_id' => 1,
                'status_id' => 1,
                'cell_id' => 1,
                'article_id' => 2,
                'made_by' => "gods of the application"
            ],
            [
                'crop_date' => '2019-08-17',
                'article_amount' => '170',
                'note' => 'seeded label2',
                'pallet_label_farmer_id' => '1',
                'cell_number' => '2',
                'cell_description' => 'seeded label2',
                'harvest_cycle' => '1',
                'harvest_cycle_day' => '1',
                'user_id' => '1',
                'farmer_id' => '2',
                'cultivation_cycle_id' => 1,
                'pallet_type_id' => 1,
                'status_id' => 1,
                'cell_id' => 2,
                'article_id' => 1,
                'made_by' => "gods of the application"
            ],
            [
                'crop_date' => '2019-08-17',
                'article_amount' => '150',
                'note' => 'seeded label4',
                'pallet_label_farmer_id' => '1',
                'cell_number' => '2',
                'cell_description' => 'seeded label4',
                'harvest_cycle' => '1',
                'harvest_cycle_day' => '1',
                'user_id' => '1',
                'farmer_id' => '2',
                'cultivation_cycle_id' => 1,
                'pallet_type_id' => 1,
                'status_id' => 2,
                'cell_id' => 2,
                'article_id' => 1,
                'made_by' => "gods of the application"
            ],
            [
                'crop_date' => '2019-08-17',
                'article_amount' => '180',
                'note' => 'seeded label3',
                'pallet_label_farmer_id' => '1',
                'cell_number' => '2',
                'cell_description' => 'seeded label3',
                'harvest_cycle' => '1',
                'harvest_cycle_day' => '1',
                'user_id' => '1',
                'farmer_id' => '1',
                'cultivation_cycle_id' => 1,
                'pallet_type_id' => 1,
                'status_id' => 2,
                'cell_id' => 2,
                'article_id' => 1,
                'made_by' => "gods of the application"
            ],
        ];
        PalletLabel::insert($palletLabels);
    }
}
