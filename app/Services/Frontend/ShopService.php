<?php

namespace App\Services\Frontend;

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

    public function getCartProductsCount() {
        $cart = session()->get('cart');
        $total_count = 0;
        if ($cart && is_array($cart)) {
            $total_count =  count($cart);
        }
        return $total_count;
    }


    public function updateCart(Request $request)
    {
        $cart = session()->get('cart');
        if ($cart && is_array($cart)) {
            if (isset($cart[$request->variation])) {
                $cart[$request->variation] = $request->quantity;
            }
            session()->put('cart', $cart);
        }
    }

    public function removeFromCart(Request $request)
    {
        if (isset($request->remove_all)) {
            session()->forget('cart');
        } else {
            $cart = session()->get('cart');
            if (isset($cart[$request->variation])) {
                unset($cart[$request->variation]);
                session()->put('cart', $cart);
            }
        }
    }

    public function getCartTotalCount()
    {
        $cart = session()->get('cart');
        $total_price = 0;
        $coupon_price = 0;
        if ($cart && is_array($cart)) {
            $coupons = $this->getCoupons();

            foreach ($cart as $variation => $quantity) {
                $product = Variation::where('id', $variation)->where('status', true)->first();
                if ($product) {

                    $total_price += $product->actual_price * $quantity;
                    $coupon_price += ($product->actual_price * $quantity);
                    foreach ($coupons as $coupon) {
                        if ($coupon->type === Coupon::COUPON_TYPE_INDIVIDUAL_PERCENT && $coupon->products->contains($product->product_id)) {
                            $coupon_price -= ($product->actual_price * $quantity * $coupon->discount / 100);
                        } elseif ($coupon->type === Coupon::COUPON_TYPE_INDIVIDUAL_AMOUNT && $coupon->products->contains($product->product_id)) {
                            $coupon_price -= $coupon->discount;
                        }
                    }
                }
            }
            if ($total_price > 0) {
                foreach ($coupons as $coupon) {
                    if ($coupon->type === Coupon::COUPON_TYPE_GENERAL_PERCENT) {
                        $coupon_price -= ($total_price * $coupon->discount / 100);
                    } elseif ($coupon->type === Coupon::COUPON_TYPE_GENERAL_AMOUNT) {
                        $coupon_price -= $coupon->discount;
                    }
                }
            }
        }

        return [
            'totalPrice' => $total_price,
            'couponPrice' => $coupon_price,
        ];
    }
}
