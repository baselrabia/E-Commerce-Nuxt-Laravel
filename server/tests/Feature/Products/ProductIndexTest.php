<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductIndexTest extends TestCase
{
 
    public function test_it_shows_collection_of_Products()
    {
        $product = factory(Product::class)->create();

        $this->json('GET', 'api/products')
            ->assertJsonFragment([
                'id'  => $product->id
             ]);
    
    }

    public function test_it_Paginated_data()
    {

        $this->json('GET', 'api/products')
            ->assertJsonStructure([
                'links',
                'meta'

            ]);
    }
}
