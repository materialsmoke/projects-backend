<?php

use App\Project;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Project::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->company
    ];
});
