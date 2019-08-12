<?php

use Illuminate\Database\Seeder;
use App\ArticleGroup;

class ArticleGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articleGroups = [
            [
                'name' => 'Wit',
                'description' => 'Wit',
            ],
            [
                'name' => 'Kastanje',
                'description' => 'Kastanje',
            ],
            [
                'name' => 'Shiitake',
                'description' => 'Shiitake',
            ],
            [
                'name' => 'Oesterzwam',
                'description' => 'Oesterzwam',
            ],
            [
            'name' => 'Portabella',
            'description' => 'Portabella',
            ]
        ];

        ArticleGroup::insert($articleGroups);
    }
}
