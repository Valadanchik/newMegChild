<?php

namespace App\Services\Frontend;

use App\Models\Coupon;

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

    public function getCartProductsCount() {
        $cart = session()->get('cart');
        $total_count = 0;
        if ($cart && is_array($cart)) {
            $total_count =  count($cart);
        }
        return $total_count;
    }


}
