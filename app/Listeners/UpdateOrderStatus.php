<?php

namespace App\Listeners;

use App\Events\OrderPayment;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateOrderStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param OrderPayment $event
     * @return void
     */
    public function handle(OrderPayment $event)
    {
        $event->order->status = $event->status;
        $orderBooks = $event->order->books;
        $orderAccessors = $event->order->accessors;
        Order::updateOrderProductsPivotStatus($orderBooks, $event->status);
        Order::updateOrderProductsPivotStatus($orderAccessors, $event->status);

        $event->order->save();
    }
}
