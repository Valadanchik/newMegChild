<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Order\CreateRequest;
use App\Models\Books;

use App\Services\Front\PaymentService;


class OrderController extends Controller
{
    protected $orderService = null;

    public function index()
    {

//        dd(array_keys(session()->get('cart')));

        $sessionProductsId = array_keys(session()->get('cart'));

        $cardBooks = Books::with(['authors' => function ($query) {
            $query->select('authors.id', 'authors.name_hy', 'authors.name_en');
        }, 'translators' => function ($query) {
            $query->select('translators.id', 'translators.name_hy', 'translators.name_en');
        }])
            ->whereIn('id', $sessionProductsId)
            ->get();

//        dd($cardBooks);



//        $getBooks = Books::
//
//
//        dd(session()->get('cart'));

//        $regions = $this->orderService->getRegions();
//        $countries = $this->orderService->getCountries();

//        $orders = $this->orderService->getOrders();




        return view('checkout.checkout', compact('cardBooks'));
    }


}
