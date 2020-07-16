<?php

namespace Tests\Unit\Listeners;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Events\Order\OrderPaymentFailed;
use App\Models\Order;
use App\Listeners\Order\MarkOrderPaymentFailed;

class MarkOrderFailedListenerTest extends TestCase
{
    public function test_it_marks_order_as_payment_failed()
    {
        $event = new OrderPaymentFailed(
            $order = factory(Order::class)->create([
                'user_id' => factory(User::class)->create()->id
            ])
        );

        $listener = new MarkOrderPaymentFailed();

        $listener->handle($event);
      
        $this->assertEquals($order->frech()->status, Order::PAYMENT_FAILED);
    }
}
