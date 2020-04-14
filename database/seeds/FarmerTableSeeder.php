<?php

use App\Article;
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
                'uid' => 'de1dba64-0f65-4945-91fc-f9fc5602ef77',
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
                'uid' => 'f9521d68-3e23-40c2-a5ed-acb00732ef0b',
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


        $articles = Article::all();
        Farmer::where('id', '>', '0')->each(function ($farmer) use ($articles) {
            $farmer->articles()->attach(
                $articles->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}
