<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Client::class, function (Faker $faker) {
    return [
        'name'=>$faker->company,
        'contact_firstname'=>$faker->firstName,
        'contact_lastname'=>$faker->lastName,
        'phone'=>$faker->phoneNumber,
        'email'=>$faker->email,
        'address'=>$faker->address,
        'notes'=>$faker->realText(200)
    ];
});
