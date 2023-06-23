<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Services\Frontend\ShopService;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function __construct(protected ShopService $shopService)
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function checkCoupon(Request $request)
    {
        $userCoupon = $request->coupon;
        $coupon = Coupon::where('code', $userCoupon)->where('quantity', '>', 0)->first();

        if ($coupon) {

            if ($coupon->type === Coupon::SINGLE_BOOK) {
                $total_price = self::singleCouponFunction($coupon);
            } else if ($coupon->type === Coupon::EACH_BOOKS) {
                $total_price = self::allBooksCouponFunction($coupon);
            }


            return response()->json([
                'success' => true,
                'coupon' => $coupon,
                'total_price' => $total_price,
            ]);
        }
        return response()->json([
            'success' => false,
        ]);
    }

    /**
     * @param $couponModel
     * @return \Closure|mixed|object|null
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function singleCouponFunction($couponModel)
    {
        $total_price = session()->get('total_price');
        return $total_price - $couponModel->price;
    }

    /**
     * @param $couponModel
     * @return float|int
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function allBooksCouponFunction($couponModel)
    {
        $total_price = 0;
        if ($couponModel->book_id === Coupon::ALL_BOOKS) {
            $total_price = ShopService::getCartTotalPrice($couponModel->price);
        } else {

            $sessionProductsId = array_keys(session()->get('cart'));
            $couponProductsId = json_decode($couponModel->book_id);

            $checkProductsHasCouponIds = [];
            $productsIdWithoutCouponIds = [];
            foreach ($sessionProductsId as $value) {
                if (in_array($value, $couponProductsId)) {
                    $checkProductsHasCouponIds[] = $value;
                } else {
                    $productsIdWithoutCouponIds[] = $value;
                }
            }

            if (count($checkProductsHasCouponIds)) {
                $total_price = ShopService::getCartTotalPrice($couponModel->price, $checkProductsHasCouponIds, $total_price);
            }

            if (count($productsIdWithoutCouponIds)) {
                $total_price = ShopService::getCartTotalPrice(false, $productsIdWithoutCouponIds, $total_price);
            }
        }

        return $total_price;
    }

}
