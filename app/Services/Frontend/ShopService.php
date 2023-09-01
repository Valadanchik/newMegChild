<?php

namespace App\Services\Frontend;

use App\Models\Accessor;
use App\Models\Books;
use App\Models\Coupon;
use Illuminate\Http\Request;

class ShopService
{

    /**
     * @param Request $request
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function addToCart(Request $request): void
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
    }

    /**
     * @return int
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getCartProductsCount(): int
    {
        $cart = session()->get('cart');
        $total_count = 0;
        if ($cart && is_array($cart)) {
            $total_count = count($cart);
        }
        return $total_count;
    }

    /**
     * @param Request $request
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function updateCart(Request $request): void
    {
        $cart = session()->get('cart');

        if ($cart && is_array($cart)) {
            if (isset($cart[$request->book_id])) {
                $cart[$request->book_id] = $request->quantity;
                session()->put('cart', $cart);
            }
        }
    }

    /**
     * @param Request $request
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function removeFromCart(Request $request): void
    {
        $cart = session()->get('cart');
        if (isset($cart[$request->book_id])) {
            unset($cart[$request->book_id]);
            session()->put('cart', $cart);
        }
    }

    /**
     * @return float|int
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function getCartTotalPrice($couponDiscount = false, $productsId = [], $total_price = 0, $couponType = null): float|int
    {
        $cart = session()->get('cart');
        if ($cart && is_array($cart)) {

            $sessionProductsId = array_keys($cart);

            if ($productsId === Coupon::ALL_BOOKS) {
                $productsId = $sessionProductsId;
            }

            $cartProductsId = count($productsId) ? $productsId : $sessionProductsId;
            $books = Books::whereIn('id', $cartProductsId)->where('status', true)->get();
            $accessors = Accessor::whereIn('id', $cartProductsId)->where('status', true)->get();
            $products = $books->merge($accessors);

            foreach ($products as $product) {
                if ($couponDiscount && $couponType === Coupon::EACH_BOOKS) {
                    $total_price += ($product->price - $couponDiscount) * $cart[$product->id];
                } else {
                    $total_price += $product->price * $cart[$product->id];
                }
            }

            if ($couponType === Coupon::SINGLE_BOOK && $couponDiscount) {
                $total_price = $total_price - ($couponDiscount * count($productsId));
            }
        }

        session()->put('total_price', $total_price);

        return $total_price;
    }
}
