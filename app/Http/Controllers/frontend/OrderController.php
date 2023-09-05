<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Services\Frontend\OrderService;
use App\Services\Frontend\PaymentService;
use App\Services\Frontend\ShopService;

use Psr\Container\NotFoundExceptionInterface;

class OrderController extends Controller
{
    /**
     * @param OrderService $orderService
     * @param ShopService $shopService
     */
    public function __construct(protected OrderService $orderService, protected ShopService $shopService)
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
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

    /**
     * @param $orderModel
     * @return mixed
     */
    public static function getOrderWithProducts($orderModel): mixed
    {
        return $orderModel::with(['country',
            'books' => function ($query) {
                $query->where('product_type', 'book');
            },
            'accessors' => function ($query) {
                $query->where('product_type', 'accessor');
            }])
            ->orderBy('id', 'DESC')->first();
    }

}
