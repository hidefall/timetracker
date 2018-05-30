<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\TimeFrame::class, function (Faker $faker) {
    return [
        'description'=>$faker->realText(150),
        'timer_started'=>$faker->unixTime,
        'timer_finished'=>$faker->unixTime,
        'billable'=>$faker->numberBetween(0,1),
        'price_per_hour'=>$faker->numberBetween(5,50)
    ];
});
