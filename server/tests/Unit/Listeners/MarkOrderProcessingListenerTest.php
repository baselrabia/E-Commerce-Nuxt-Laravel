<?php

namespace Tests\Unit\Listeners;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Events\Order\OrderPaid;
use App\Models\Order;
use App\Listeners\Order\MarkOrderProcessing;

class MarkOrderProcessingListenerTest extends TestCase
{
    public function test_it_marks_order_as_Processing()
    {
        $event = new OrderPaid(
            $order = factory(Order::class)->create([
                'user_id' => factory(User::class)->create()->id
            ])
        );

        $listener = new MarkOrderProcessing();

        $listener->handle($event);
      
        $this->assertEquals($order->frech()->status, Order::PAYMENT_PROCESSING);
    }
}
