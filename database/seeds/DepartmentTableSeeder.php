<?php

use Illuminate\Database\Seeder;
use App\Department;
use App\User;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Department::class, 10)->create();


        $departments = Department::all();
        User::where('id', '>', '2')->each(function ($user) use ($departments) {
            $user->departments()->attach(
                $departments->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}
