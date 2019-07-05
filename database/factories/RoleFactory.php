<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Role;
use Faker\Generator as Faker;




$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->jobTitle,
        'description' => $faker->sentence,
        'color' => $faker->unique()->colorName,
    ];
});
