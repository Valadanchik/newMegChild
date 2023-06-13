@extends('layout.layout')

@section('content')
    <main class="news-articles">
        <div class="payment-success">
            <img src="{{asset('images/svg/payment-success.svg')}}" alt="Success">
            <h2>{{ __('messages.thank_you') }}</h2>
            <p>{{ __('messages.order_success') }}</p>
        </div>
    </main>
@endsection
