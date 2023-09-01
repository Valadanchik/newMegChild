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
//        dd($request->all());
        $request->only(['quantity', 'product',]);

        $this->shopService->addToCart($request);

        return response()->json([
            'success' => true,
            'cartProductsCount' => $this->shopService->getCartProductsCount(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function updateCart(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->only(['quantity', 'variation']);

        $this->shopService->updateCart($request);

        if ($request->coupon && CouponController::checkCouponIsValid($request->coupon)) {
            $getTotalPrice = CouponController::checkCoupon($request, true);
        } else {
            $getTotalPrice = ShopService::getCartTotalPrice() ;
        }

       return $this->returnTotalPriceResponse($getTotalPrice);
    }

    /**
     * @param $getTotalPrice
     * @param $coupon
     * @param bool $success
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function returnTotalPriceResponse($getTotalPrice, $coupon = null, bool $success = true, string $message = ''): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'total_price' => $getTotalPrice,
            'coupon' => $coupon,
            'success' => $success,
            'message' => $message,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function removeFromCart(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->only(['book_id']);

        $this->shopService->removeFromCart($request);

        return response()->json([
            'success' => true,
            'cartProductsCount' => $this->shopService->getCartProductsCount(),
        ]);
    }

}
