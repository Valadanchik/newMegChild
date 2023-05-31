@extends('layout.layout')

@section('content')
    <main class="news-articles">
        <div class="payment-success">
            <img src="{{asset('images/svg/payment-success.svg')}}" alt="Success">
            <h2>Thank you</h2>
            <p>Order has been placed successfully</p>
        </div>
    </main>
@endsection
