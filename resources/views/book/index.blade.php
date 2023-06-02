@extends('layout.layout')

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
                    {{ $book['price'] }}
                    <svg width="21" height="24" viewBox="0 0 21 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_186_2501)">
                            <path
                                d="M16.4517 10.1005C16.4517 8.92882 16.4517 8.17512 16.4517 8.17113C16.4375 5.92671 15.5162 3.8799 14.0424 2.4092C12.5595 0.923476 10.4915 -0.00125332 8.22588 -9.04573e-05C5.9602 -0.00117026 3.89204 0.923559 2.4093 2.40929C0.923567 3.89194 -0.00116177 5.9601 1.09546e-06 8.22595H3.68679C3.68762 6.96648 4.19189 5.84348 5.0162 5.0161C5.84341 4.1918 6.96641 3.68761 8.22588 3.68653C9.48518 3.68761 10.6081 4.1918 11.4355 5.0161C12.2456 5.8292 12.7469 6.92811 12.7645 8.16116C12.7649 8.18276 12.7649 23.6429 12.7649 23.6429H16.4519C16.4519 23.6366 16.4519 21.7515 16.4519 19.3003L16.4517 10.1005Z"
                                fill="#444444"/>
                            <path d="M12.7665 10.1006H8.87891V13.8179H12.7664" fill="#444444"/>
                            <path d="M20.3408 10.1006H16.4531V13.8179H20.3406" fill="#444444"/>
                            <path d="M20.3408 15.5829H16.4531V19.3003H20.3406" fill="#444444"/>
                            <path d="M12.7665 15.5826H8.87891V19.2999H12.7663" fill="#444444"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_186_2501">
                                <rect width="20.3395" height="23.643" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
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
                </div>
            </div>
        </section>

        <section class="book-page-item-full-information content  accordion-container">
            <div class="book-page-item-additional-information  accordion">
                <h2 class=" accordion-title">Լրացուցիչ տեղեկություն</h2>
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

                <button class=" accordion-toggle">
                    h
                </button>
            </div>

            <svg width="1" class="svg-additional-information" height="516" viewBox="0 0 1 516" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <line x1="0.5" x2="0.5" y2="516" stroke="#F36F21"/>
            </svg>

            <div class="book-page-item-after  accordion">
                <h2  class="faq-title">Հեղինակներ</h2>
                @foreach($book->authors as $key => $author)
                    <div class=" accordion-text">
                        <div class="book-page-item-after-img">
                            <img src="{{ URL::to('storage/' . $author['image']) }}" alt="">
                        </div>
                        <p>{{ $author['about_' . app()->getLocale()] }}</p>
                    </div>
                @endforeach
                <button class="accordion-toggle">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="#F36F21" stroke="#F36F21" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 8V16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 12H16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </button>
            </div>

            <svg width="1" class="svg-additional-information" height="516" viewBox="0 0 1 516" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <line x1="0.5" x2="0.5" y2="516" stroke="#F36F21"/>
            </svg>

            <div class="book-page-item-book-trailer  accordion">
                <h2 class=" accordion-title">Գրքի թրեյլեր</h2>
                <div class="book-page-item-book-trailer-video  accordion-text">
                    <iframe src="https://www.youtube.com/embed/cGmLS5KL7yw" title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                </div>
                <button class=" accordion-toggle">
                    v
                </button>
            </div>
        </section>
    </main>
@endsection

