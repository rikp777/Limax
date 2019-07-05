<?php

use Illuminate\Database\Seeder;
use App\Cask;

class CaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $casks = [
            'code' => 'EYSHDLS',
            'name' => 'BlaBla',
            'description' => 'BlaBla'
        ];

        Cask::insert($casks);
    }
}
