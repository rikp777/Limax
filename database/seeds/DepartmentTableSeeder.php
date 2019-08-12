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

    }
}
