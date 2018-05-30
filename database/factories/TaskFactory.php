<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Task::class, function (Faker $faker) {
    return [
        'name'=>$faker->streetName,
        'priority'=>$faker->randomElement(['not_defined','low','medium','high','urgent']),
        'billable'=>$faker->numberBetween(0,1),
        'price_per_hour'=>$faker->numberBetween(5,50)
    ];
});
