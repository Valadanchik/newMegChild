<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Frontend\PaymentService;
use App\Jobs\OrderAdminJob;
use App\Jobs\OrderUserJob;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->whereIn('status', [Order::STATUS_FAILED, Order::STATUS_COMPLETED])->get();
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

    public function notifyUser(Order $order)
    {
        OrderUserJob::dispatch($order);

        return redirect()->back()->with('success', 'User has been notified successfully');
    }

    public function notifyAdmin(Order $order)
    {
        $paymentService = new PaymentService();
        $paymentService->send_telegram_message($order);
        OrderAdminJob::dispatch($order);

        return redirect()->back()->with('success', 'Admin has been notified successfully');
    }

}
