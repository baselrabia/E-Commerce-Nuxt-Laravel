<?php

namespace App\Events\Order;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Order;

class OrderPaymentFailed
{
    use Dispatchable, SerializesModels;

    /**
     * [$order description]
     * @var [type]
     */
    public $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
         $this->order = $order;
    }


  
}
