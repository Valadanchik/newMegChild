<?php

namespace App\Jobs;

use App\Mail\OrderAdminMail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct(int $order_id)
    {
        $this->order = Order::where('id', $order_id)->with('variations', 'variations.product', 'variations.images')->first();
    }

    public function handle()
    {
        try {
            Mail::to(env('EMAIL_NEW_MAG_CHILD'))->send(new OrderAdminMail($this->order));
        } catch (\Exception $e) {
            info('OrderAdminJob: error-2: ' . $e->getMessage());
        }
    }
}
