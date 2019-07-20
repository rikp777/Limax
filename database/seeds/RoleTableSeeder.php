<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Admin',
                'description' => 'God',
                'color' => 'Red',
            ],
            [
                'name' => 'Moderator',
                'description' => 'Semi god',
                'color' => 'Orange',
            ],
            [
                'name' => 'Farmer',
                'description' => 'Farmer',
                'color' => 'Green',
            ],
            [
                'name' => 'Scheduler',
                'description' => 'Scheduler',
                'color' => 'Blue'
            ],
            [
                'name' => 'Other',
                'description' => 'Other',
                'color' => 'Grap',
            ],
        ];
        Role::insert($roles);
    }
}
