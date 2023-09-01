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

    public function __construct(protected Order $order)
    {

    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $mailGroup = [
            env('EMAIL_NEW_MAG_CHILD'),
            env('EMAIL_NEW_MAG_INFO'),
            env('EMAIL_NEW_MAG_DAVID'),
            env('EMAIL_NEW_MAG_HOVO_QOCH'),
            env('EMAIL_NEW_MAG_BOOKS'),
        ];
        try {
            Mail::to($mailGroup)->send(new OrderAdminMail($this->order));
        } catch (\Exception $e) {
            info('OrderUserJob: error-2: ' . $e->getMessage());
        }
    }
}
