<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\ShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShopController extends Controller
{
//    protected $shopService = null;

    public function __construct(protected ShopService $shopService)
    {
//        $this->shopService = $shopService;
    }

//    public function cart()
//    {
//        $cart = $this->shopService->getVariations();
//
//        return view('front.shop.cart', compact( 'cart'));
//    }

    public function addToCart(Request $request)
    {
        $request->only(['quantity', 'product',]);

        $this->shopService->addToCart($request);

        return response()->json([
            'success' => true,
            'cartProductsCount' => $this->shopService->getCartProductsCount(),
        ]);
    }

    public function updateCart(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->only([
            'quantity',
            'variation',
        ]);
        $this->shopService->updateCart($request);
//        $this->shopService->getCartTotalPrice();

        return response()->json([
            'success' => true,
            'total_price' => $this->shopService->getCartTotalPrice(),
        ]);
    }

    public function removeFromCart(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->only(['book_id']);

        $this->shopService->removeFromCart($request);

        return response()->json([
            'success' => true,
            'cartProductsCount' => $this->shopService->getCartProductsCount(),
        ]);
    }

    public function getCartTotalCount()
    {
        return response()->json([
            'success' => true,
//            'total_price' => $this->shopService->getCartTotalCount(),
        ]);
    }

}
