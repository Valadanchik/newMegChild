<?php

namespace App\Observers;

use App\Models\Books;
use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(): void
    {
//        try {
//            Books::changeInStockAfterOrder();
//        } catch (\Exception  $e) {
//            echo $e->getMessage();
//        }
    }

    /**
     * @param Order $order
     * @return void
     */
    public function updated(Order $order): void
    {
        if ($order->status === Order::STATUS_COMPLETED) {
            try {
                Books::changeInStockAfterOrder();
            } catch (\Exception  $e) {
                echo $e->getMessage();
            }
        }
    }

}
