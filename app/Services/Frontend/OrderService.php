<?php

namespace App\Services\Frontend;

use App\Models\Accessor;
use App\Models\Books;
use App\Models\Categories;
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

    /**
     * @param $sessionProductsId
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBookProducts($sessionProductsId)
    {
        return Books::with(['authors' => function ($query) {
            $query->select('authors.id', 'authors.name_hy', 'authors.name_en');
        }, 'translators' => function ($query) {
            $query->select('translators.id', 'translators.name_hy', 'translators.name_en');
        }, 'category'])
            ->whereIn('id', $sessionProductsId)
            ->where('in_stock', '>', 0)
            ->where('status', Books::ACTIVE)
            ->get();
    }

    /**
     * @param $sessionProductsId
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAccessorsProducts($sessionProductsId): \Illuminate\Database\Eloquent\Collection|array
    {
        return Accessor::with('category')
            ->whereIn('id', $sessionProductsId)
            ->where('in_stock', '>', 0)
            ->where('status', Accessor::ACTIVE)
            ->get();
    }

    public function getCartProducts(): \Illuminate\Database\Eloquent\Collection|array
    {
        $sessionProductsId = array_keys(session()->get('cart'));
        $getBookProducts = $this->getBookProducts($sessionProductsId);
        $getAccessorProducts = $this->getAccessorsProducts($sessionProductsId);

        return $getBookProducts->merge($getAccessorProducts);
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
            $sessionProductsId = array_keys(session()->get('cart'));
            $books = Books::whereIn('id', $sessionProductsId)->where('status', true)->with('category')->get();
            $accessors = Accessor::whereIn('id', $sessionProductsId)->where('status', true)->with('category')->get();
            $products = $books->merge($accessors);

            foreach ($products as $product) {
                $total_price += $product->price * $cart[$product->id];

                $product->save();

                if($product->category->type === Categories::TYPE_BOOK) {
                    $order->books()->attach($product->id, ['quantity' => $cart[$product->id], 'price' => $product->price, 'status' => Order::STATUS_NEW]);
                } else if ($product->category->type === Categories::TYPE_ACCESSOR) {
                    $order->accessors()->attach($product->id, ['quantity' => $cart[$product->id], 'price' => $product->price, 'status' => Order::STATUS_NEW]);
                }
            }
        }

        $order->update([
            'total_price' => $total_price,
        ]);
    }

}
