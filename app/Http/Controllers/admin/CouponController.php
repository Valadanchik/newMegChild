<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Models\Books;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::get();

        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Books::where('status', Books::ACTIVE)->get();

        if ($books->isEmpty()) {
            abort(404, 'There is no book to create coupon');
        }

        return view('admin.coupon.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {
        try {
            if ($request->book_id !== Coupon::ALL_BOOKS) {
                $request->merge(['book_id' => json_encode($request->book_id)]);
            }
            $couponData = $request->except(['_token', '_method']);
            Coupon::create($couponData);

            return redirect()->back()->with('success', 'Coupon created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Coupon not created');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $books = Books::where('status', Books::ACTIVE)->get();

        $allBooks = false;
        if ($coupon->book_id !== Coupon::ALL_BOOKS) {
            $booksForSelected = json_decode($coupon->book_id);
        } else {
            $allBooks = true;
            $booksForSelected = [];
        }

        return view('admin.coupon.edit', compact('coupon', 'books', 'booksForSelected', 'allBooks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
            if ($request->book_id !== Coupon::ALL_BOOKS) {
                $request->merge(['book_id' => json_encode($request->book_id)]);
            }
            $couponData = $request->except(['_token', '_method']);
            $coupon->update($couponData);

            return redirect()->back()->with('success', 'Coupon updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Coupon not updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();

            return redirect()->back()->with('success', 'Coupon deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Coupon not deleted');
        }
    }
}
