<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = [
            [
                'excel_code' => 'KF0011NL',
                'inset_gram' => '250',
                'inset_limit' => '6',
                'pallet_limit' => '170',
                'origin' => 'NL',
                'pallet_type_id' => 1,
                'cask_id' => 1,
                'inset_id' => 1,
                'status_id' => 1,
                'article_group_id' => 1,
                'sort_type_id' => 1,
            ],
            [
                'excel_code' => 'KF0010NL',
                'inset_gram' => '250',
                'inset_limit' => '6',
                'pallet_limit' => '170',
                'origin' => 'NL',
                'pallet_type_id' => 1,
                'cask_id' => 1,
                'inset_id' => 1,
                'status_id' => 1,
                'article_group_id' => 1,
                'sort_type_id' => 1,
            ],
        ];

        Article::insert($articles);

//        $articleOne = 1;
//        Article::findOrFail($articleOne)->palletType()->attach(1);
//        Article::findOrFail($articleOne)->cask()->attach(1);
//        Article::findOrFail($articleOne)->inset()->attach(1);
//        Article::findOrFail($articleOne)->status()->attach(1);
//        Article::findOrFail($articleOne)->articleGroup()->attach(1);
//        Article::findOrFail($articleOne)->sortType()->attach(1);
    }
}
