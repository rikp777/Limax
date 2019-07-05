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
                'name' => 'Scheduler',
                'description' => 'Scheduler',
                'color' => 'Blue'
            ],
            [
                'name' => 'Farmer',
                'description' => 'Farmer',
                'color' => 'Green',
            ],
            [
                'name' => 'Other',
                'description' => 'Other',
                'color' => 'Gray',
            ],
        ];
        Role::insert($roles);


        // Make RelationsShips
        User::findOrFail(1)->roles()->sync( [ 1, 2 ] );
        User::findOrFail(2)->roles()->sync( [ 2 ] );

        $roles = Role::where('id', '>', '2')->get();
        User::where('id', '>', '2')->each(function ($user) use ($roles) {
            $user->roles()->attach(
                $roles->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}
