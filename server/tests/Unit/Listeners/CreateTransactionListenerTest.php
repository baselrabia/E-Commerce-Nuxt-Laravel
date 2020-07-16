<?php

namespace Tests\Unit\Listeners;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Events\Order\OrderPaid;
use App\Models\Order;
use App\Listeners\Order\CreateTransaction;

class CreateTransactionListenerTest extends TestCase
{
    public function test_it_marks_order_as_payment_failed()
    {
        $event = new OrderPaid(
            $order = factory(Order::class)->create([
                'user_id' => factory(User::class)->create()->id
            ])
        );

        $listener = new CreateTransaction();

        $listener->handle($event);
      
        $this->assertDatabaseHas('transactions', [
            'order_id' => $order->id,
            'total' =>$order->total()->amount()
        ]);
    }

}
