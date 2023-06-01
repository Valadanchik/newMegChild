<?php

namespace App\Listeners;

use App\Events\OrderPayment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
     * Handle the event.
     */
    public function handle(OrderPayment $event): void
    {
        $event->order->status = $event->status;
        $orderProducts = $event->order->books;
        foreach ($orderProducts as $orderProduct) {
            $event->order->books()->updateExistingPivot($orderProduct->id, [
                'status' => $event->status,
            ]);
        }
        $event->order->save();
    }
}
