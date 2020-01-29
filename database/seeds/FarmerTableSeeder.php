<?php

use Illuminate\Database\Seeder;
Use App\Farmer;
use Illuminate\Support\Str;

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
                'uid' => Str::uuid()->toString(),
                'name' => 'Riks farming house',
                'street' => 'Irenestraat',
                'house_number' => 4,
                'place' => 'panningen',
                'zip_code' => '5981XL',
                'country' => 'Netherlands',
                'province' => 'Limburg',
                'email' => 'rikpeeters11@hotmail.com',
                'phone' => '0613312009',
                'fax' => '0234023948270',
                'preference_article_group_id' => 1,
                'contact_person_user_id' => 1,
            ],
            [
                'uid' => Str::uuid()->toString(),
                'name' => 'Toms farming house',
                'street' => 'Binnenhof',
                'house_number' => 9,
                'place' => 'Oostrum',
                'zip_code' => '5807BV',
                'country' => 'Netherlands',
                'province' => 'Limburg',
                'email' => 'tom@limax.nl',
                'phone' => '00000',
                'fax' => '00000',
                'preference_article_group_id' => 2,
                'contact_person_user_id' => 2,
            ]
        ];
        Farmer::insert($farmers);
    }
}
