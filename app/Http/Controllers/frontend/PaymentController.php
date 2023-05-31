<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use App\Services\Frontend\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
//    protected $paymentService = null;

    public function __construct(protected PaymentService $paymentService)
    {
//        $this->paymentService = $paymentService;
    }

    public function success()
    {
        return view('payments.order_success');
    }

    public function fail()
    {
        return view('payments.fail');
    }

    public function idramCallback(Request $request)
    {
        return $this->paymentService->idramCallback($request);
    }

    public function telcellCallback(Request $request)
    {
        return $this->paymentService->telcellCallback($request);
    }

    public function telcellRedirect(Request $request)
    {
        return $this->paymentService->telcellRedirect($request);
    }

    public function arcaCallback(Requet $request)
    {
        $this->paymentService->arcaCallback($request);
    }
}
