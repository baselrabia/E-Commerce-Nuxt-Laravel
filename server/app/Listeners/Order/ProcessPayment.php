<?php

namespace App\Listeners\Order;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Cart\Payments\Gateway;
use App\Events\Order\OrderCreated;
use App\Exceptions\PaymentFailedException;
use App\Events\Order\OrderPaymentFailed;
use App\Events\Order\OrderPaid;

class ProcessPayment implements ShouldQueue
{
    protected $gateway;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;

        try {
            $this->gateway->withUser($order->user)
                ->getCustomer()
                ->charge($order->paymentMethod, $order->total()->amount());

            event(new OrderPaid($order));

        } catch (PaymentFailedException $e) {
            event(new OrderPaymentFailed($order));
        }
       
    }
}
