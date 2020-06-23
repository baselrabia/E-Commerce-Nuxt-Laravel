<?php

namespace Tests\Unit\Products;

use App\Cart\Money;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use App\Models\Stock;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductVariationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_has_one_variation_type()
    {

        $variation = factory(ProductVariation::class)->create();

        $this->assertInstanceOf(ProductVariationType::class, $variation->type);
    }

    public function test_it_belongs_to_a_product()
    {

        $variation = factory(ProductVariation::class)->create();

        $this->assertInstanceOf(Product::class, $variation->product);
    }


    public function test_it_returns_money_instance_for_price()
    {

        $variation = factory(ProductVariation::class)->create();


        $this->assertInstanceOf(Money::class,  $variation->price);
    }

    public function test_it_returns_formattted_price()
    {

        $variation = factory(ProductVariation::class)->create([
            'price' => 1000
        ]);


        $this->assertEquals($variation->formattedprice, '$10.00');
    }

    public function test_it_returns_product_price_if_null()
    {

        $product = factory(Product::class)->create([
            'price' => 1000
        ]);

        $variation = factory(ProductVariation::class)->create([
            'price' => null,
            'product_id' => $product->id
        ]);

        $this->assertEquals($variation->formattedprice, $product->formattedprice);

    }


    public function test_check_variation_price_different_to_product()
    {

        $product = factory(Product::class)->create([
            'price' => 1000
        ]);

        $variation = factory(ProductVariation::class)->create([
            'price' => 2000,
            'product_id' => $product->id
        ]);

        $this->assertTrue($variation->priceVaries());
    }

    public function test_it_has_many_stocks()
    {

        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertInstanceOf(Stock::class,  $variation->stocks->first());
    }

    public function test_it_has_stock_variation()
    {

        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertInstanceOf(ProductVariation::class,  $variation->stocks->first());
    }
      public function test_it_has_stock_count_pivot_within_stock_information()
    {

        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 5 
            ])
        );

        $this->assertEquals($variation->stocks->first()->pivot->stock , $quantity  );
    }

    public function test_it_has_in_stock_pivot_within_stock_information()
    {

        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertTrue($variation->stocks->first()->pivot->in_stock );
    }

    public function test_it_has_in_stock_pivot_within_variation()
    {

        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertTrue($variation->in_stock );
    }

     public function test_it_has_stock_count_pivot_within_variation()
    {

        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 5 
            ])
        );

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 5 
            ])
        );

        $this->assertEquals($variation->stockCount() , 10  );
    }
}
