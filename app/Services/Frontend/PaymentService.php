<?php

namespace App\Services\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Events\OrderPayment;

class PaymentService
{
    public ?string $lang = null; // EDP_LANGUAGE for idram

    public function __construct()
    {
        $this->lang = app()->getLocale() === 'hy' ? 'am' : app()->getLocale();
    }

    public function makePayment(Order $order)
    {
        $amount = $order->total_price;
        $payment_method = $order->payment_method;

        return match ((int)$payment_method) {
            Order::PAYMENT_METHOD_IDRAM => $this->idramPayment($amount, $order->order_payment_id),
            Order::PAYMENT_METHOD_TELCELL => $this->telcellPayment($amount, $order->order_payment_id),
            Order::PAYMENT_METHOD_BANK => $this->arcaPayment($amount, $order->order_payment_id)
        };
    }


    protected function idramPayment($amount, $order_id)
    {
        $data_idram = [];
        $data_idram['url'] = env('IDRAM_URL');
        $data_idram['EDP_LANGUAGE'] = mb_strtoupper($this->lang);
        $data_idram['EDP_REC_ACCOUNT'] = env('IDRAM_EDP_REC_ACCOUNT');
        $data_idram['EDP_DESCRIPTION'] = 'Վճարում կատարե՛ք idram-ով';
        $data_idram['EDP_AMOUNT'] = $amount;
        $data_idram['EDP_BILL_NO'] = $order_id;

        return view('payments.idram_redirection', compact('data_idram'));
    }

    public function idramCallback(Request $request)
    {
        if ($request->has(['EDP_PRECHECK', 'EDP_BILL_NO', 'EDP_REC_ACCOUNT', 'EDP_AMOUNT']) &&
            $request->EDP_PRECHECK == "YES" &&
            $request->EDP_REC_ACCOUNT == env('IDRAM_EDP_REC_ACCOUNT') &&
            Order::where('order_payment_id', $request->EDP_BILL_NO)->exists()) {

            echo "OK";
        }

        if ($request->has(['EDP_PAYER_ACCOUNT', 'EDP_BILL_NO', 'EDP_REC_ACCOUNT', 'EDP_AMOUNT', 'EDP_TRANS_ID', 'EDP_CHECKSUM'])) {

            $checksum = $this->getIdramChecksum(
                $request->EDP_AMOUNT,
                $request->EDP_BILL_NO,
                $request->EDP_PAYER_ACCOUNT,
                $request->EDP_TRANS_ID,
                $request->EDP_TRANS_DATE);

            $order = Order::where('order_payment_id', $request->EDP_BILL_NO)->firstOrFail();

            $order->payment_callback = json_encode($request->all());

            if (strtoupper($request->EDP_CHECKSUM) == strtoupper($checksum) &&
                $order->total_price == $request->EDP_AMOUNT) {

                event(new OrderPayment(true, $order, Order::STATUS_COMPLETED));
                echo "OK";
            } else {
                event(new OrderPayment(false, $order, Order::STATUS_FAILED));
            }
        }
    }

    protected function getIdramChecksum($endAmount, $endBillNo, $endPayerAccount, $endTransId, $endTransDate)
    {
        $txtToHash =
            env('IDRAM_EDP_REC_ACCOUNT') . ":" .
            $endAmount . ":" .
            env('IDRAM_SECRET_KEY') . ":" .
            $endBillNo . ":" .
            $endPayerAccount . ":" .
            $endTransId . ":" .
            $endTransDate;
        return md5($txtToHash);
    }

    protected function telcellPayment($amount, $order_id)
    {
        $data_telcell = [];
        $data_telcell['url'] = env('TELCELL_URL');
        $data_telcell['issuer'] = env('TELCELL_MERCHANT_ID');
        $data_telcell['action'] = 'PostInvoice'; # always PostInvoice
        $data_telcell['currency'] = "֏"; # always ֏
        $data_telcell['price'] = $amount;
        $data_telcell['product'] = base64_encode('Վճարումն իրականացրե՛ք Telcell Wallet-ով: Խնդրում ենք նկատի ունենալ՝ վճարումն իրականացվելու է հայկական դրամով:');  # description always in base64
        $data_telcell['issuer_id'] = base64_encode($order_id); # order id always in base64
        $data_telcell['valid_days'] = 1; # Число дней, в течении которых счёт действителен.
        $data_telcell['lang'] = $this->lang;
        $data_telcell['security_code'] = $this->getTelcellSecurityCode(
            env('TELCELL_KEY'),
            $data_telcell['issuer'],
            $data_telcell['currency'],
            $data_telcell['price'],

            $data_telcell['product'],
            $data_telcell['issuer_id'],
            $data_telcell['valid_days']
        );

        return view('payments.telcell_redirection', compact('data_telcell'));
    }

    public function telcellCallback(Request $request)
    {
        if (!$request->has(['buyer', 'checksum', 'invoice', 'issuer_id', 'payment_id', 'currency', 'sum', 'time', 'status'])) {
            abort(404);
        }

        $order = Order::where('order_payment_id', $request->issuer_id)->firstOrFail();

        $checksum = $this->getTelcellChecksum(
            $request->invoice,
            $request->issuer_id,
            $request->payment_id,
            $request->currency,
            $request->sum,
            $request->time,
            $request->status
        );

        if ($request->checksum != $checksum) {
            $order->payment_callback = 'telcell checksum failed';
            event(new OrderPayment(false, $order, Order::STATUS_FAILED));

            abort(404);
        }

        $order->payment_callback = json_encode($request->all());

        if ($request->status == 'PAID') {

            event(new OrderPayment(true, $order, Order::STATUS_COMPLETED));
        } else {

            event(new OrderPayment(false, $order, Order::STATUS_FAILED));
        }
    }

    public function telcellRedirect(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (!$request->has('order')) {
            abort(404);
        }

        $order = Order::where('order_payment_id', $request->order)->firstOrFail();

        if ($order->status == Order::STATUS_COMPLETED) {

            return redirect()->route('payment.success');
        } else {

            return redirect()->route('payment.fail');
        }
    }

    protected function getTelcellChecksum($invoice, $issuerId, $paymentId, $currency, $sum, $time, $status)
    {
        return hash('md5',
            env('TELCELL_KEY') .
            $invoice .
            $issuerId .
            $paymentId .
            $currency .
            $sum .
            $time .
            $status
        );
    }

    protected function getTelcellSecurityCode($shop_key, $issuer, $currency, $price, $product, $issuer_id, $valid_days): string
    {
        return hash('md5', $shop_key . $issuer . $currency . $price . $product . $issuer_id . $valid_days);
    }

    public function arcaPayment($amount, $order_id)
    {
        $url = 'https://ipay.arca.am/payment/rest/register.do';
        $data = [
            'userName' => '34540336_api',
            'password' => '$newmag2018$',
            'orderNumber' => $order_id,
            'jsonParams' => '{"FORCE_3DS2":"true"}',
            'amount' => 1,
            'currency' => '051',
            'returnUrl' => route('payment.arca_callback'),
            'description' => '', // TODO: add description if needed
            'language' => 'hy',
        ];

        $req = Http::post($url, $data);

        $response = $req->json();

        if ($response['errorCode'] == 0) {

            return redirect()->away($response['formUrl']);
        } else {

            //TODO: add error to order
            dd($response);
        }
    }

    public function arcaCallback(Request $request)
    {
        dd($request->all());
    }
}
