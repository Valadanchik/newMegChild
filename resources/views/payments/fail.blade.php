@extends('layout.layout')

@section('content')
    <main class="news-articles">
        <div class="payment-fail">
            <img src="{{asset('/images/payment-fail.png')}}" alt="Success">
            <h2>ERROR</h2>
            <p>Payment failed</p>
        </div>
    </main>
@endsection
