<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Profile::class, function (Faker $faker) {
    return [
        'firstname'=>$faker->firstName,
        'lastname'=>$faker->lastName,
        'phone'=>$faker->phoneNumber,
        'address'=>$faker->address
    ];
});
