@extends('layout.layout')
@section('title', 'books')
@section('content')
    <main class="news-articles">
        <section class="books content">
            <div class="filtering-book-page">
                <ul class="filtering-book-page-list">
                    <li class="{{ $slug === null ? 'is-checked' : '' }}"><a href="{{ LaravelLocalization::localizeUrl('/books') }}">Ամբողջը</a></li>
                    @foreach($categories as $category)
                        <li class="{{ $slug == $category['name_en'] ? 'is-checked' : '' }}">
                            <a href="{{ LaravelLocalization::localizeUrl('/category/' . $category['name_en']) }}">{{ $category['name_' . app()->getLocale()] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="books-info-item">
                @foreach($books as $index => $book)
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
                                Գնել
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
