@extends('layout.layout')

@section('content')
    <main class="news-articles">
        <section class="book-page-item-banner content">
            <div class="book-page-item-banner-img">
                <img src="{{ URL::to('storage/' . $book['main_image']) }}" alt="">
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
                    <a href="">Գնել</a>
                </div>
                <div class="book-item-desc">
                    <h4>Բովանդակություն</h4>
                    <p>{{ $book['text_' . app()->getLocale()] }}</p>
                </div>
            </div>
        </section>

        <section class="book-page-item-full-information content">
            <div class="book-page-item-additional-information">
                <h2>Լրացուցիչ տեղեկություն</h2>
                <div class="book-page-item-additional-information-list">
                    <div class="additional-information-list-item">
                        <span>Օրիգինալ անուն</span>
                        <svg height="1" viewBox="0 0 139 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0.5" y1="0.5" x2="138.5" y2="0.5" stroke="#444444" stroke-linecap="round"
                                  stroke-dasharray="4 4"/>
                        </svg>
                        <span>{{ $book['title_' . app()->getLocale()]  }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>Կատեգորիա</p>
                        <svg width="175" height="1" viewBox="0 0 175 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0.5" y1="0.5" x2="174.5" y2="0.5" stroke="#444444" stroke-linecap="round"
                                  stroke-dasharray="4 4"/>
                        </svg>
                        <span>{{ $book->category->age }} տարեկաններ</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>ISBN</p>
                        <svg width="258" height="1" viewBox="0 0 258 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0.5" y1="0.5" x2="257.5" y2="0.5" stroke="#444444" stroke-linecap="round"
                                  stroke-dasharray="4 4"/>
                        </svg>
                        <span>{{ $book['isbn']  }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>Հրատարակության տարին</p>
                        <svg width="173" height="1" viewBox="0 0 173 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0.5" y1="0.5" x2="172.5" y2="0.5" stroke="#444444" stroke-linecap="round"
                                  stroke-dasharray="4 4"/>
                        </svg>
                        <span>{{ $book['published_date']  }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>էջերի քանակ</p>
                        <svg width="301" height="1" viewBox="0 0 301 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0.5" y1="0.5" x2="300.5" y2="0.5" stroke="#444444" stroke-linecap="round"
                                  stroke-dasharray="4 4"/>
                        </svg>
                        <span>{{ $book['page_count']  }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>Չափս</p>
                        <svg width="248" height="1" viewBox="0 0 248 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0.5" y1="0.5" x2="247.5" y2="0.5" stroke="#444444" stroke-linecap="round"
                                  stroke-dasharray="4 4"/>
                        </svg>
                        <span>{{ $book['book_size_' . app()->getLocale()]  }}</span>
                    </div>
                </div>
            </div>

            <svg width="1" class="svg-additional-information" height="516" viewBox="0 0 1 516" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <line x1="0.5" x2="0.5" y2="516" stroke="#F36F21"/>
            </svg>

            <div class="book-page-item-after">
                <h2>Հեղինակներ</h2>
                @foreach($book->authors as $key => $author)
                    <div>
                        <div class="book-page-item-after-img">
                            <img src="{{ URL::to('storage/' . $author['image']) }}" alt="">
                        </div>
                        <p>{{ $author['about_' . app()->getLocale()] }}</p>
                    </div>
                @endforeach
            </div>

            <svg width="1" class="svg-additional-information" height="516" viewBox="0 0 1 516" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <line x1="0.5" x2="0.5" y2="516" stroke="#F36F21"/>
            </svg>

            <div class="book-page-item-book-trailer">
                <h2>Գրքի թրեյլեր</h2>
                <div class="book-page-item-book-trailer-video">
                    <iframe src="https://www.youtube.com/embed/cGmLS5KL7yw" title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                </div>
            </div>
        </section>
    </main>
@endsection
