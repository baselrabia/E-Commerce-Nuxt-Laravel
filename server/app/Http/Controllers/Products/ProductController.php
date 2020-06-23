<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Scoping\Scopes\CategoryScope;

class ProductController extends Controller
{
    public function index(){

        $products = Product::with(['variations.type','variations.stock','variations.product'])->withScopes($this->scopes())->paginate(10);

        return ProductResource::collection($products);


    }
    protected function scopes()
    {
        return [
            'category' => new CategoryScope
        ];
    }

    public function show(Product $product)
    {
        $product->load(['variations.type','variations.stock','variations.product']);
        return new  ProductResource($product);
    }


}
