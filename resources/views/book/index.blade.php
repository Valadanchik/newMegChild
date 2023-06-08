@extends('layout.layout')
@section('title', $book['title_' . app()->getLocale()])
@section('content')
    <main class="news-articles">
        <section class="book-page-item-banner content">
            <div class="book-page-item-banner-img single-item">
                <img src="{{ URL::to('storage/' . $book['main_image']) }}" alt="">
                @foreach($book->images as $img)
                <img src="{{ URL::to('storage/'.$img->image) }}" alt="">
                @endforeach
            </div>
            <div class="book-page-item-banner-info">
                <h2>{{ $book['title_' . app()->getLocale()]  }}</h2>
                <p>Հեղինակ`
                    @foreach($book->authors as $key => $author)
                        {{ $author['name_' . app()->getLocale()] }} {{ $key < count($book->authors) - 1 ? ',' : '' }}
                    @endforeach
                </p>
                <div class="book-page-item-param-and-icon">
                    <div class="book-page-item-description-param">
                        <div class="book-page-item-description-param-group">
                            <p>Խումբ</p>
                            <div class="book-page-item-group-desc-img">
                                <img src="{{ URL::to('/images/' . $book->category->name_en . '.png') }}" alt="">
                            </div>
                        </div>
                        <div class="book-page-item-description-age">
                            <p>Տարիք</p>
                            <span>{{ $book->category->age }}</span>
                        </div>
                        <div class="book-page-item-description-word-count">
                            <p>Բառաքանակ</p>
                            <span>{{ $book['word_count'] }}</span>
                        </div>
                        <div class="book-page-item-description-font-size">
                            <p>Տառաչափ</p>
                            <span>{{ $book['font_size'] }}</span>
                        </div>
                    </div>
                    <div class="article-itm-page-banner-desc-icon">
                        <span>Տարածել:</span>
                        @include('components.social')
                    </div>
                </div>
                <h3>
                    {{ $book['price'] }}֏
                </h3>
                <div class="book-page-item-btn">
{{--                    <a class="add-to-cart" href="{{ LaravelLocalization::localizeUrl('add-to-cart') }}">Գնել</a>--}}
                    @if($book['in_stock'])
                        <a id="add-to-cart" href="#">Գնել</a>
                    @else
                        <div style="color:red; margin: 20px">Առկա Չէ</div>
                    @endif

                    <input id="add-to-cart-url" type="hidden" value="{{ route('addToCart') }}">
                    <input id="checkout-router" type="hidden" value="{{ route('order') }}">
                    <input id="product-id" type="hidden" value="{{ $book['id'] }}">
                    <input id="quantity" type="hidden" value="1" name="number">

                </div>
                <div class="book-item-desc">
                    <h4>Բովանդակություն</h4>
                    <p>{{ $book['text_' . app()->getLocale()] }}</p>
                    <div class="l_more">
                        <button class="learn-more-btn">Կարդալ ավելին</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="book-page-item-full-information content  accordion-container">
            <div class="book-page-item-additional-information  accordion">
                <h2 class="accordion-title">Լրացուցիչ տեղեկություն</h2>
                <div class="book-page-item-additional-information-list  accordion-text" >
                    <div class="additional-information-list-item">
                        <p>Օրիգինալ անուն</p>
                        <div class="additional-information-list-item-img">
                            <img src="{{ URL::to('/images/Line2.png') }}" alt="line">
                        </div>
                        <span >{{ $book['title_' . app()->getLocale()]  }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>Կատեգորիա</p>
                        <div class="additional-information-list-item-img">
                            <img src="{{ URL::to('/images/Line2.png') }}" alt="line">
                        </div>
                        <span>{{ $book->category->age }} տարեկաններ</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>ISBN</p>
                        <div class="additional-information-list-item-img">
                            <img src="{{ URL::to('/images/Line2.png') }}" alt="line">
                        </div>
                        <span>{{ $book['isbn']  }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>Հրատարակության տարին</p>
                        <div class="additional-information-list-item-img">
                            <img src="{{ URL::to('/images/Line2.png') }}" alt="line">
                        </div>
                        <span>{{ $book['published_date']  }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>էջերի քանակ</p>
                        <div class="additional-information-list-item-img">
                            <img src="{{ URL::to('/images/Line2.png') }}" alt="line">
                        </div>
                        <span>{{ $book['page_count']  }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>Չափս</p>
                        <div class="additional-information-list-item-img">
                            <img src="{{ URL::to('/images/Line2.png') }}" alt="line">
                        </div>
                        <span>{{ $book['book_size_' . app()->getLocale()]  }}</span>
                    </div>
                </div>

                <button class="accordion-toggle">
                    <img src="{{ URL::to('/images/svg/arrow-down-circle.svg') }}" alt="arrow down">
                </button>
            </div>
            <div class="book-page-item-after  accordion">
                <h2  class="faq-title">Հեղինակներ</h2>
                @foreach($book->authors as $key => $author)
                    <div class="accordion-text">
                        <div class="book-page-item-after-img">
                            <img src="{{ URL::to('storage/' . $author['image']) }}" alt="">
                        </div>
                        <p>{{ $author['about_' . app()->getLocale()] }}</p>
                    </div>
                @endforeach
                <button class="accordion-toggle">
                    <img src="{{ URL::to('/images/svg/arrow-down-circle.svg') }}" alt="arrow down">
                </button>
            </div>
            <div class="book-page-item-book-trailer  accordion">
                <h2 class="accordion-title">Գրքի թրեյլեր</h2>
                <div class="book-page-item-book-trailer-video  accordion-text">
                    <iframe src="https://www.youtube.com/embed/cGmLS5KL7yw" title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                </div>
                <button class="accordion-toggle">
                    <img src="{{ URL::to('/images/svg/arrow-down-circle.svg') }}" alt="arrow down">
                </button>
            </div>
        </section>
    </main>
@endsection

