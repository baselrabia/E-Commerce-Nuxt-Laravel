<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderPaid;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;

class MarkOrderProcessing
{
    /**
     * Handle the event.
     *
     * @param  OrderPaid  $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        $event->order->update([
            'status' => Order::PROCESSING
        ]);
    }
}
