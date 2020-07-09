<?php

use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address_1' => $faker->streetAddress,
        'city' => $faker->city,
        'postal_code' => $faker->postcode,
        'country_id' => factory(\App\Models\Country::class),
        'user_id' => factory(\App\Models\User::class)
    ];
});
