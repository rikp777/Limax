<?php

use Illuminate\Database\Seeder;
Use App\Farmer;

class FarmerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $farmers = [
            [
                'name' => 'Rik farming house',
                'street' => 'Irenestraat',
                'house_number' => 4,
                'place' => 'panningen',
                'zip_code' => '5981XL',
                'country' => 'Netherlands',
                'province' => 'Limburg',
                'email' => 'rikpeeters11@hotmail.com',
                'phone' => '0613312009',
                'fax' => '0234023948270',
                'fairproduce_number' => '101010101',
                'ggn' => '101010101',
                'skal' => '101010101',
                'milieu' => '101010101',
                'article_group' => 1,
            ]
        ];
        Farmer::insert($farmers);
    }
}
