<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use App\Http\Requests\OrderStoreRequest;
use App\Services\Frontend\OrderService;
use App\Services\Frontend\PaymentService;

class OrderController extends Controller
{
//    protected OrderService $orderService;

    public function __construct(protected OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $cardBooks = [];
        if (session()->get('cart')) {
            $regions = $this->orderService->getRegions();
            $countries = $this->orderService->getCountries();
            $cardBooks = $this->orderService->getCartProducts();
            $data = compact('cardBooks', 'regions', 'countries');
        } else {
            $data = compact('cardBooks');
        }

        return view('checkout.checkout', $data);
    }


    public function create(OrderStoreRequest $request)
    {
        $order = $this->orderService->create($request);
        $this->orderService->createOrderBook($order);
//        $payment_service = new PaymentService();
//        return $payment_service->makePayment($order);
        return redirect()->route('order.success');
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function success(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('payments.order_success');
    }

    /**
     * @return \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application\
     */
    public function fail(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('payments.fail');
    }

}
