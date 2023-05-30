<?php

namespace App\Observers;

use App\Models\Books;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(): void
    {
        try {
            Books::changeInStockAfterOrder();
        } catch (\Exception  $e) {
             echo $e->getMessage();
        }
    }

}
