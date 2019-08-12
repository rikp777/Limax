<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'name' => 'Aangemaakt',
                'description' => 'Aangemaakt',
                'color' => 'lightgreen'
            ],
            [
                'name' => 'Transport',
                'description' => 'Transport',
                'color' => 'yellow'
            ],
            [
                'name' => 'Ontvangen',
                'description' => 'Ontvangen',
                'color' => 'green'
            ],
            [
                'name' => 'Koeling',
                'description' => 'Koeling',
                'color' => 'green'
            ],
            [
                'name' => 'Productie',
                'description' => 'Productie',
                'color' => 'Orange'
            ],
            [
                'name' => 'Verwerkt',
                'description' => 'Verwerkt',
                'color' => 'darkgreen'
            ],
            [
                'name' => 'Actief',
                'description' => 'Actief',
                'color' => 'green'
            ],
            [
                'name' => 'Inactief',
                'description' => 'Inactief',
                'color' => 'Red'
            ],
            [
                'name' => 'Prognose',
                'description' => 'Prognose',
                'color' => 'Blue'
            ],
            [
                'name' => 'Definitief',
                'description' => 'Definitief',
                'color' => 'Green'
            ],
        ];
        Status::insert($statuses);
    }
}
