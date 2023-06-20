<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;

class SubscriptionController extends Controller
{

    /**
     * @param SubscriptionRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(SubscriptionRequest $request)
    {
        try {
            Subscription::create(['email' => $request->subscribe_email]);
            return redirect((url()->previous() . '#footer'))->with('success_subscribe', __('messages.success_subscribe'));
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
