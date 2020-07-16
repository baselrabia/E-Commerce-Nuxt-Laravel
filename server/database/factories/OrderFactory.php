<?php

use Faker\Generator as Faker;
use App\Models\Order;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'address_id' => factory(\App\Models\Address::class)->create()->id,
        'shipping_method_id' => factory(\App\Models\ShippingMethod::class)->create()->id,
        'paymentMethod' => factory(\App\Models\PaymentMethod::class)->create([
            'user_id' => factory(\App\Models\User::class)->create()->id
        ])->id,
        'subtotal' => 5000
    ];
});
