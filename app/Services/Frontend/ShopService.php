<?php

namespace App\Services\Frontend;

use App\Models\Books;
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
    public static function getCartTotalPrice($couponDiscount = false, $booksId = [], $total_price = 0): float|int
    {
        $cart = session()->get('cart');

        if ($cart && is_array($cart)) {

            $sessionProductsId = array_keys($cart);
            $cartBooksId = count($booksId) ? $booksId : $sessionProductsId;
            $books = Books::whereIn('id', $cartBooksId)->where('status', true)->get();

            foreach ($books as $book) {
                if ($couponDiscount) {
                    $total_price += ($book->price - $couponDiscount) * $cart[$book->id];
                } else {
                    $total_price += $book->price * $cart[$book->id];
                }
            }
        }

        session()->put('total_price', $total_price);

        return $total_price;
    }
}
