<?php

use App\Department;
use App\Role;
use Illuminate\Database\Seeder;
Use App\User;
use Illuminate\Support\Facades\Hash;
use App\Farmer;
use Illuminate\Support\Str;

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
                'uid' => Str::uuid()->toString(),
                'first_name' => 'Rik',
                'insert_name' => null,
                'last_name' => 'Peeters',
                'email' => 'rikpeeters11@hotmail.com',
                'photo' => 'https://microhealth.com/assets/images/illustrations/personal-user-illustration-@2x.png',
                'password' => Hash::make('password')
            ],
            [
                'uid' => Str::uuid()->toString(),
                'first_name' => 'Tom',
                'insert_name' => 'van',
                'last_name' => 'Vegchel',
                'email' => 'tom@limax.nl',
                'photo' => 'https://microhealth.com/assets/images/illustrations/personal-user-illustration-@2x.png',
                'password' => Hash::make('password')
            ],
            [
                'uid' => Str::uuid()->toString(),
                'first_name' => 'test',
                'insert_name' => null,
                'last_name' => 'admin',
                'email' => 'admin@limax.nl',
                'photo' => 'https://microhealth.com/assets/images/illustrations/personal-user-illustration-@2x.png',
                'password' => Hash::make('password')
            ],
            [
                'uid' => Str::uuid()->toString(),
                'first_name' => 'test',
                'insert_name' => null,
                'last_name' => 'moderator',
                'email' => 'moderator@limax.nl',
                'photo' => 'https://microhealth.com/assets/images/illustrations/personal-user-illustration-@2x.png',
                'password' => Hash::make('password')
            ],
            [
                'uid' => Str::uuid()->toString(),
                'first_name' => 'test',
                'insert_name' => null,
                'last_name' => 'farmer',
                'email' => 'farmer@limax.nl',
                'photo' => 'https://microhealth.com/assets/images/illustrations/personal-user-illustration-@2x.png',
                'password' => Hash::make('password')
            ]
        ];

        User::insert($users);

        factory(User::class, 30)->create();


        // Make RelationsShips
        User::findOrFail(1)->roles()->sync( [ 1 ] );
        User::findOrFail(2)->roles()->sync( [ 2 ] );
        User::findOrFail(3)->roles()->sync( [ 1 ] );
        User::findOrFail(4)->roles()->sync( [ 2 ] );
        User::findOrFail(5)->roles()->sync( [ 3 ] );

        $roles = Role::where('id', '>', '2')->get();
        User::where('id', '>', '5')->each(function ($user) use ($roles) {
            $user->roles()->attach(
                $roles->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
        $departments = Department::all();
        User::where('id', '>', '0')->each(function ($user) use ($departments) {
            $user->departments()->attach(
                $departments->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}
