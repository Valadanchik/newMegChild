@extends('layout.layout')
@section('title', 'books')
@section('content')
    <main class="news-articles">
        <section class="books content">
            <div class="filtering-book-page">
                <ul class="filtering-book-page-list">
                    <li class="{{ $slug === null ? 'is-checked' : '' }}"><a
                            href="{{ LaravelLocalization::localizeUrl('/books') }}">{{ __('messages.all') }}</a></li>
                    @foreach($categories as $category)
                        <li class="{{ $slug == $category['name_en'] ? 'is-checked' : '' }}">
                            <a href="{{ LaravelLocalization::localizeUrl('/category/' . $category['name_en']) }}">{{ $category['name_' . app()->getLocale()] }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="books-filter">
                    <div class="books-filter-img">
                        <img src="{{ URL::to('images/svg/mi_filter.svg') }}" alt="filter logo">
                    </div>
                    <p>Ֆիլտրել</p>
                </div>
            </div>
            @if(count($books))
                <div class="books-info-item">
                    @foreach($books as $index => $book)
                        <div class="book-item">
                            <a href="{{ LaravelLocalization::localizeUrl('/book/' . $book['slug']) }}">
                            <div class="book-item-images">
                                <div class="book-item-img-logo">
                                    <img src="{{ URL::to('images/reade-more-img-logo-' . $book->category->name_en. '.png') }}" alt="">
                                </div>
                                <div class="book-item-img-book">
                                        <img width="270px" src="{{ URL::to('storage/' . $book['main_image']) }}" alt="">
                                </div>
                            </div>
                            <h3>{{ $book['title_' . app()->getLocale()]  }}</h3>
                            <p>
                                @foreach($book->authors as $key => $author)
                                    {{ $author['name_' . app()->getLocale()] }} {{ $key < count($book->authors) - 1 ? ',' : '' }}
                                @endforeach
                            </p>
                            </a>
                            <div class="book-price">
                                <p class="book-pr">{{ $book['price']  }} ֏ </p>
                                @if($book['old_price'])
                                    <p class="book-old-pr">{{ $book['old_price']  }} ֏</p>
                                @endif
                            </div>
                            <div class="book-btn">
                                <a href="{{ LaravelLocalization::localizeUrl('/book/' . $book['slug']) }}">
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
                    <p>{{ __('messages.empty_book') }}</p>
                </div>
            @endif
        </section>
    </main>
@endsection
