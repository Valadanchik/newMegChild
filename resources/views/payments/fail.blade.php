@extends('layout.layout')

@section('content')
    <main class="news-articles">
        <div class="payment-fail">
            <img src="{{asset('/images/payment-fail.png')}}" alt="Success">
            <h2>{{ __('messages.error') }}</h2>
            <p>{{ __('messages.payment_failed') }}</p>
        </div>
    </main>
@endsection
