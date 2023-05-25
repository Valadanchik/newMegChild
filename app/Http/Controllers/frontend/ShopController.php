<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\ShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShopController extends Controller
{
    protected $shopService = null;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }



    public function addToCart(Request $request)
    {
        $request->only(['quantity', 'product',]);

        $this->shopService->addToCart($request);

        return response()->json([
            'success' => true,
            'cartProductsCount' => $this->shopService->getCartProductsCount(),
        ]);
    }


}
