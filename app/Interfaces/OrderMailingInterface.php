<?php

namespace App\Interfaces;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;

interface OrderMailingInterface
{
    public function send(Mailable $mail): void;
}
