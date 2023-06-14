<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'country_id' => 'required|integer|exists:countries,id',
//            'region_id' => 'required|integer|exists:regions,id',
            'region' => 'required|string',
            'street' => 'required|string',
//            'house' => 'string',
            'postal_code' => 'required|string',
            'order_text' => 'nullable|string',
            'terms' => 'required',
            'payment_method' => 'required|in:' . implode(',', Order::PAYMENT_METHODS),
        ];
    }

    public function messages(): array
    {
        $messages = [
            'en' => [
                'payment.in' => 'The selected payment is invalid.',
                'terms.required' => 'You must agree to the terms and conditions.',
            ],
            'hy' => [
                'payment.in' => 'Ընտրված վճարման եղանակը անվավեր է:',
                'terms.required' => 'Դուք պետք է համաձայնեք դրույթների և պայմանների հետ:',
            ]
        ];

        return $messages[app()->getLocale()];
    }
}
