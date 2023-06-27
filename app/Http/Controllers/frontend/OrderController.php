<?php

namespace App\Http\Controllers\frontend;

use App\Events\CouponQuantity;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Services\Frontend\OrderService;
use App\Services\Frontend\PaymentService;
use App\Services\Frontend\ShopService;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class OrderController extends Controller
{
//    protected OrderService $orderService;

    public function __construct(protected OrderService $orderService, protected ShopService $shopService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
//        dd(session()->get('coupon'));

        $cardBooks = [];
        if (session()->get('cart')) {
            $regions = $this->orderService->getRegions();
            $countries = $this->orderService->getCountries();
            $cardBooks = $this->orderService->getCartProducts();
            $cardProductsTotalPrice = $this->shopService->getCartTotalPrice();
            $data = compact('cardBooks', 'regions', 'countries', 'cardProductsTotalPrice');
        } else {
            $data = compact('cardBooks');
        }

        return view('checkout.checkout', $data);
    }

    /**
     * @return bool
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function checkIsProductsAvailable(): bool
    {
        $cardBooks = $this->orderService->getCartProducts();
        $sessionProductsId = array_keys(session()->get('cart'));
        return (count($sessionProductsId) === count($cardBooks));
    }

    /**
     * @param OrderStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(OrderStoreRequest $request)
    {
        try {
            if (!$this->checkIsProductsAvailable()) {
                return redirect()->route('order')->with('product_is_not_in_stock', __('checkout.product_is_not_in_stock'));
            }
        } catch (NotFoundExceptionInterface $e) {
            return redirect()->route('order')->with('product_is_not_in_stock', __('checkout.product_is_not_in_stock'));
        }

        $order = $this->orderService->create($request);
        $payment_service = new PaymentService();

        return $payment_service->makePayment($order);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function success(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('payments.order_success');
    }

    /**
     * @return \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application\
     */
    public function fail(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('payments.fail');
    }

}
