<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Project::class, function (Faker $faker) {
    return [
        'name'=>$faker->streetName,
        'status'=>$faker->randomElement(['ongoing','in_progress','finished','declined']),
        'estimation'=>$faker->numberBetween(0,500)
    ];
});
