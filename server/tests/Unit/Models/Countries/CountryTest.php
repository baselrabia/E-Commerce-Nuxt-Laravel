<?php

namespace Tests\Unit\Models\Countries;

use App\Models\Country;
use App\Models\ShippingMethod;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryTest extends TestCase
{
    public function test_it_has_Many_shipping_methods()
    {
        $country = factory(Country::class)->create();

        $country->shippingMethods()->attach(
            factory(ShippingMethod::class)->create()
        );

        $this->assertInstanceOf(ShippingMethod::class, $country->shippingMethods->first());
    }
}
