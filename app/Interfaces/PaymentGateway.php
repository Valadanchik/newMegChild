<?php

namespace App\Interfaces;

use App\Models\Order;
use Illuminate\Http\Request;

interface PaymentGateway
{

    public function makePayment(Order $order);

    public function handleCallback(Request $request);
}
