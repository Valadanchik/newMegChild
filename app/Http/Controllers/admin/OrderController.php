<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with(['country',
            'books' => function ($query) {
                $query->where('product_type', 'book');
            },
            'accessors' => function ($query) {
                $query->where('product_type', 'accessor');
            }])
            ->orderBy('id', 'DESC')
            ->findOrFail($id);

        return view('admin.order.show', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

}
