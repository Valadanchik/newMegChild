<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderAdminMail extends Mailable
{
    use Queueable, SerializesModels;

//    public $order;

    public function __construct(public Order $order)
    {
//        $this->order = $order;
    }

    public function build()
    {
        return $this->view('emails.order-admin', [
            'order' => $this->order,
        ]);
    }
}
