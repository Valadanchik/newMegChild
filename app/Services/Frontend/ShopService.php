<?php

namespace App\Services\Frontend;

use App\Models\Accessor;
use App\Models\Books;
use App\Models\Categories;
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
            $request->product_type . '-' . $request->product => [
                'product_type' => $request->product_type,
                'product_id' => $request->product,
                'product_count' => $request->quantity,
            ]
        ];
        $cart = session()->get('cart');

        if (!$cart) {
            session()->put('cart', $prod);
        } else {
            if (isset($cart[$request->product])) {
                $cart[$request->product_type . '-' . $request->product]['product_id'] = $request->product;
                $cart[$request->product_type . '-' . $request->product]['product_count'] += $request->quantity;
                $cart[$request->product_type . '-' . $request->product]['product_type'] = $request->product_type;
            } else {
                $cart[$request->product_type . '-' . $request->product]['product_id'] = $request->product;
                $cart[$request->product_type . '-' . $request->product]['product_count'] = $request->quantity;
                $cart[$request->product_type . '-' . $request->product]['product_type'] = $request->product_type;
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
            if (isset($cart[$request->productType . '-' . $request->product_id])) {
                $cart[$request->productType . '-' . $request->product_id]['product_id'] = $request->product_id;
                $cart[$request->productType . '-' . $request->product_id]['product_count'] = $request->quantity;
                $cart[$request->productType . '-' . $request->product_id]['product_type'] = $request->productType;

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

        if (isset($cart[$request->product_type . '-' . $request->product_id])) {
            unset($cart[$request->product_type . '-' . $request->product_id]);
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

            $sessionBookId = [];
            $sessionAccessorId = [];

            foreach ($cart as $key => $cartValue) {
                match ($cartValue['product_type']) {
                    Categories::TYPE_BOOK => $sessionBookId[] = $cartValue['product_id'],
                    Categories::TYPE_ACCESSOR => $sessionAccessorId[] = $cartValue['product_id'],
                };
            }

            $sessionProductsId = array_merge($sessionBookId, $sessionAccessorId);

            if ($productsId === Coupon::ALL_BOOKS) {
                $productsId = $sessionProductsId;
            }

//            $cartProductsId = count($productsId) ? $productsId : $sessionProductsId;
            $books = null;
            $accessors = null;
            if (!empty($sessionBookId)) {
                $books = Books::whereIn('id', $sessionBookId)->where('status', true)
                    ->with('category')->get();
            }
            if (!empty($sessionAccessorId)) {
                $accessors = Accessor::whereIn('id', $sessionAccessorId)->where('status', true)
                    ->with('category')->get();
            }

            if ($books && $accessors) {
                $products = $books->merge($accessors);
            } elseif ($books) {
                $products = $books;
            } elseif ($accessors) {
                $products = $accessors;
            } else {
                $products = [];
            }

            foreach ($products as $product) {
                if ($couponDiscount && $couponType === Coupon::EACH_BOOKS) {
                    $total_price += ($product->price - $couponDiscount) * $cart[$product->id];
                } else {
                    $total_price += $product->price * $cart[$product->category->type . '-' . $product->id]['product_count'];
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
