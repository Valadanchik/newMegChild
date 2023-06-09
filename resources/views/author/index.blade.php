@extends('layout.layout')
@section('title', $author['name_' . app()->getLocale()])
@section('content')
    <main class="news-articles">
        <section class="author-single-page content">
            <div class="author-single-page-back-btn">
                <span>{{ __('messages.authors') }} / </span>
                <span class="au-sing-active">
                    <a href="#">{{ $author['name_' . app()->getLocale()] }}</a>
                </span>
            </div>
            <div class="author-single-page-info">
                <div class="author-single-page-info-img">
                    <img src="{{ URL::to('storage/' . $author['image']) }}" alt="author images">
                </div>
                <div class="author-single-page-info-desc">
                    <h2>{{ $author['name_' . app()->getLocale()] }}</h2>
                    <p>{{ $author['about_' . app()->getLocale()] }}</p>
                </div>
            </div>
        </section>
        @if(!empty($author->books ))
            <section class="content author-single-page-books-section">
                <h2>{{ __('messages.books') }}</h2>
                <div class="books-info-item">
                    @foreach($author->books as $book)
                        <div class="book-item">
                            <div class="book-item-images">
                                <div class="book-item-img-logo">
                                    <img src="{{ URL::to('images/reade-more-img-logo-green.png') }}" alt="">
                                </div>
                                <div class="book-item-img-book">
                                    <a href="{{ LaravelLocalization::localizeUrl('/book/' . $book['slug']) }}">
                                        <img width="270px" src="{{ URL::to('storage/' . $book['main_image']) }}" alt="">
                                    </a>
                                </div>
                            </div>
                            <h3>{{ $book['title_' . app()->getLocale()]  }}</h3>
                            <p>
                                @foreach($book->authors as $key => $author)
                                    {{ $author['name_' . app()->getLocale()] }} {{ $key < count($book->authors) - 1 ? ',' : '' }}
                                @endforeach
                            </p>
                            <div class="book-price">
                                <p class="book-pr">{{ $book['price']  }} ֏ </p>
                            </div>
                            <div class="book-btn">
                                <a href="{{ LaravelLocalization::localizeUrl('/book/' . $book['slug']) }}">
                                    {{ __('messages.buy') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </main>
@endsection
