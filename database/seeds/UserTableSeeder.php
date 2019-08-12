<?php

use Illuminate\Database\Seeder;
Use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'test',
                'insert_name' => null,
                'last_name' => 'admin',
                'email' => 'admin@limax.nl',
                'photo' => 'noimg.png',
                'password' => Hash::make('password')
            ],
            [
                'first_name' => 'test',
                'insert_name' => null,
                'last_name' => 'moderator',
                'email' => 'moderator@limax.nl',
                'photo' => 'noimg.png',
                'password' => Hash::make('password')
            ]
        ];
        User::insert($users);


        factory(User::class, 10)->create();
    }
}
