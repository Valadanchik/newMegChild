<?php

namespace App\Services\Frontend;

use App\Models\Books;
use App\Models\Country;
use App\Models\Order;
use App\Models\Region;

use Illuminate\Http\Request;

class OrderService
{

    public function getRegions()
    {
        return Region::where('status', true)->orderBy('order')->get();
    }

    public function getCountries()
    {
        return Country::where('status', true)->orderBy('order')->get();
    }

    public function getCartProducts()
    {
        $sessionProductsId = array_keys(session()->get('cart'));

        return Books::with(['authors' => function ($query) {
            $query->select('authors.id', 'authors.name_hy', 'authors.name_en');
        }, 'translators' => function ($query) {
            $query->select('translators.id', 'translators.name_hy', 'translators.name_en');
        }])
            ->whereIn('id', $sessionProductsId)
            ->get();
    }

    public function create(Request $request)
    {
        return Order::create($request->except(['_token','terms']));
    }

    public function createOrderBook(Order $order)
    {
        $order->load('region');

        $cart = session()->get('cart');
        $total_price = 0;
        $coupon_price = 0;
        if ($cart && is_array($cart)) {
            foreach ($cart as $book_id => $quantity) {

                $book = Books::where('id', $book_id)->where('status', true)->first();

                if ($book) {
                    $total_price += $book->price * $quantity;

                    $book->save();
                    $order->books()->attach($book->id, ['quantity' => $quantity, 'price' => $book->price, 'status' => Order::STATUS_NEW]);
                } else {
                    info('variation' . $book . 'not found');
                }
            }
        }

        $order->update([
            'total_price' => $total_price,
            'total_price_with_discount' => $coupon_price
        ]);
    }

}
