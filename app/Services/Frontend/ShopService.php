<?php

namespace App\Services\Frontend;

use App\Models\Books;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Gender;
use App\Models\Sort;
use App\Models\Style;
use App\Models\Variation;
use Illuminate\Http\Request;

class ShopService
{

    public function addToCart(Request $request)
    {
        $prod = [
            $request->product => $request->quantity,
        ];
        $cart = session()->get('cart');


        if (!$cart) {
            session()->put('cart', $prod);
        } else {
            if (isset($cart[$request->product])) {
                $cart[$request->product] += $request->quantity;
            } else {
                $cart[$request->product] = $request->quantity;
            }
            session()->put('cart', $cart);
        }
//        dd(session()->get('cart'));
    }

    public function getCartProductsCount()
    {
        $cart = session()->get('cart');
        $total_count = 0;
        if ($cart && is_array($cart)) {
            $total_count = count($cart);
        }
        return $total_count;
    }


    public function updateCart(Request $request)
    {
        $cart = session()->get('cart');
//        dump($request->all());
//        dump($cart);

        if ($cart && is_array($cart)) {
            if (isset($cart[$request->book_id])) {
                $cart[$request->book_id] = $request->quantity;
//                dump($cart);
                session()->put('cart', $cart);

            }
//            dump($cart);
        }
//        dd(session()->get('cart'));

    }

    public function removeFromCart(Request $request): void
    {
        $cart = session()->get('cart');
        if (isset($cart[$request->book_id])) {
            unset($cart[$request->book_id]);
            session()->put('cart', $cart);
        }
    }

    public function getCartTotalPrice()
    {
        $cart = session()->get('cart');

//        dump($cart);
        $total_price = 0;
        if ($cart && is_array($cart)) {

            $sessionProductsId = array_keys(session()->get('cart'));
            $books = Books::whereIn('id', $sessionProductsId)->where('status', true)->get();

            foreach ($books as $book) {
                $total_price += $book->price * $cart[$book->id];
            }
        }

        return $total_price;

    }
}
