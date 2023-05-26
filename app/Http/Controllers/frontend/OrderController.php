<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use App\Http\Requests\OrderStoreRequest;
use App\Services\Frontend\OrderService;
use App\Services\Frontend\PaymentService;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
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


    }

}
