@extends('layout.layout')
@section('title', 'books')
@section('content')
    <main class="news-articles">
        <section class="books content">
            @if(count($accessors))
                <div class="books-info-item">
                    @foreach($accessors as $index => $accessor)
                        <div class="book-item">
                            <a href="{{ LaravelLocalization::localizeUrl('/accessor/' . $accessor['slug']) }}">
                            <div class="book-item-images">
                                <div class="book-item-img-logo"></div>
                                <div class="book-item-img-book">
                                        <img width="270px" src="{{ URL::to('storage/' . $accessor['main_image']) }}" alt="">
                                </div>
                            </div>
                            <h3>{{ $accessor['title_' . app()->getLocale()]  }}</h3>

                            </a>
                            <div class="book-price">
                                <p class="book-pr">{{ $accessor['price']  }} ֏ </p>
                            </div>
                            <div class="book-btn">
                                <a href="{{ LaravelLocalization::localizeUrl('/accessor/' . $accessor['slug']) }}">
                                    {{ __('messages.buy') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="not-found">
                    <div class="not-found-img">
                        <img src="{{ URL::to('/images/girl.png') }}" alt="girl images">
                    </div>
                    <p>{{ __('messages.empty_accessors') }}</p>
                </div>
            @endif
        </section>
    </main>
@endsection
