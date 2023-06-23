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

    public function getCartProducts(): \Illuminate\Database\Eloquent\Collection|array
    {
        $sessionProductsId = array_keys(session()->get('cart'));

        return Books::with(['authors' => function ($query) {
            $query->select('authors.id', 'authors.name_hy', 'authors.name_en');
        }, 'translators' => function ($query) {
            $query->select('translators.id', 'translators.name_hy', 'translators.name_en');
        }])
            ->whereIn('id', $sessionProductsId)
            ->where('status',true )
            ->where('in_stock', '>', 0)
            ->get();
    }

    public function create(Request $request)
    {
        return Order::create($request->except(['_token','terms']));
    }

    /**
     * @param Order $order
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function createOrderBook(Order $order)
    {
        $order->load('region');

        $cart = session()->get('cart');
        $total_price = 0;
        if ($cart && is_array($cart)) {

            $sessionProductsId = array_keys(session()->get('cart'));
            $books = Books::whereIn('id', $sessionProductsId)->where('status', true)->get();
            foreach ($books as $book) {
                $total_price += $book->price * $cart[$book->id];

                $book->save();
                $order->books()->attach($book->id, ['quantity' => $cart[$book->id], 'price' => $book->price, 'status' => Order::STATUS_NEW]);
            }
        }

        $order->update([
            'total_price' => $total_price,
        ]);
    }

}
