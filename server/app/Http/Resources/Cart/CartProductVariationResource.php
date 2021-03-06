<?php

namespace App\Http\Resources\Cart;

use App\Cart\Money;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductVariationResource;
use App\Http\Resources\ProductIndexResource;

class CartProductVariationResource extends ProductVariationResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { 
        return array_merge(parent::toArray($request),[
            'product' => new ProductIndexResource($this->product),
            'quantity' => $this->pivot->quantity,
            'total' =>  $this->getTotal()->formatted(),
        
        ]);
    }

    /**
     * @return Money
     */
    protected function getTotal(): Money
    {
        $total = new Money($this->pivot->quantity * $this->price->amount());
        return $total;
    }
}
