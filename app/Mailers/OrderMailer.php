<?php

namespace App\Mailers;

use App\Interfaces\OrderMailingInterface;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class OrderMailer implements OrderMailingInterface
{
    public function send(Mailable $mail): void
    {
        Mail::to(env('EMAIL_NEW_MAG_CHILD'))->send($mail);
    }
}
