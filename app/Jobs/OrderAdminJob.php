<?php

namespace App\Jobs;

use App\Interfaces\OrderMailingInterface;
use App\Mail\OrderAdminMail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param Order $order
     * @param OrderMailingInterface $mailer
     */
    public function __construct(protected Order $order, protected OrderMailingInterface $mailer)
    {

    }

    /**
     * @return void
     */
    public function handle(): void
    {
        try {
            $this->mailer->send(new OrderAdminMail($this->order));
        } catch (\Exception $e) {
            info('OrderUserJob: error-2: ' . $e->getMessage());
        }
    }
}
