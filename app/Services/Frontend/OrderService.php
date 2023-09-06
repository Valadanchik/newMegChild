<?php

namespace App\Services\Frontend;

use App\Models\Accessor;
use App\Models\Books;
use App\Models\Categories;
use App\Models\Country;
use App\Models\Order;
use App\Models\Region;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class OrderService
{
    use GeneralTrait;

    public function getRegions()
    {
        return Region::where('status', true)->orderBy('order')->get();
    }

    public function getCountries()
    {
        return Country::where('status', true)->orderBy('order')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|array
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getCartProducts(): \Illuminate\Database\Eloquent\Collection|array
    {
        return self::separateProductsSessionIDAndGetProducts(session()->get('cart'));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function create(Request $request): mixed
    {
        $request->request->add(['total_price' => session()->get('total_price')]);
        $order = Order::create($request->except(['_token', 'terms']));
        $this->createOrderProducts($order);

        return $order;
    }

    /**
     * @param Order $order
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function createOrderProducts(Order $order)
    {
        $order->load('region');
        $cart = session()->get('cart');
        $total_price = 0;

        if ($cart && is_array($cart)) {

            $products = self::separateProductsSessionIDAndGetProducts($cart);


            foreach ($products as $product) {
                $total_price += $product->price * $cart[$product->category->type . '-' . $product->id]['product_count'];

                $product->save();

                if ($product->category->type === Categories::TYPE_BOOK) {
                    $order->books()->attach($product->id,
                        [
                            'quantity' => $cart[$product->category->type . '-' . $product->id]['product_id'],
                            'price' => $product->price,
                            'status' => Order::STATUS_NEW,
                            'product_type' => Categories::TYPE_BOOK
                        ]);
                } else if ($product->category->type === Categories::TYPE_ACCESSOR) {
                    $order->accessors()->attach($product->id,
                        [
                            'quantity' => $cart[$product->category->type . '-' . $product->id]['product_id'],
                            'price' => $product->price,
                            'status' => Order::STATUS_NEW,
                            'product_type' => Categories::TYPE_ACCESSOR
                        ]);
                }
            }
        }

        $order->update([
            'total_price' => $total_price,
        ]);
    }

}
