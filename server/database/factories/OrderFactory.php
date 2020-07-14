<?php

use Faker\Generator as Faker;
use App\Models\Order;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'address_id' => factory(\App\Models\Address::class),
        'shipping_method_id' => factory(\App\Models\ShippingMethod::class),
        'subtotal' => 5000
    ];
});
