@extends('layout.layout')
@section('title', $book['title_' . app()->getLocale()])
@section('description', $book['description_' . app()->getLocale()])
@section('keywords', $book['keywords_' . app()->getLocale()])
@section('ogimage', URL::to('storage/' . $book['main_image']))
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
                <p>{{ __('messages.author') }}`
                    @foreach($book->authors as $key => $author)
                        {{ $author['name_' . app()->getLocale()] }} {{ $key < count($book->authors) - 1 ? ',' : '' }}
                    @endforeach
                </p>
                <div class="book-page-item-param-and-icon">
                    <div class="book-page-item-description-param">
                        <div class="book-page-item-description-param-group">
                            <p>{{ __('messages.group') }}</p>
                            <div class="book-page-item-group-desc-img">
                                <img src="{{ URL::to('/images/' . $book->category->name_en . '.png') }}" alt="">
                            </div>
                        </div>
                        <div class="book-page-item-description-age">
                            <p>{{ __('messages.age') }}</p>
                            <span>{{ $book->category->age }}</span>
                        </div>
                        <div class="book-page-item-description-word-count">
                            <p>{{ __('messages.word_count') }}</p>
                            <span>{{ $book['word_count'] }}</span>
                        </div>
                        <div class="book-page-item-description-font-size">
                            <p>{{ __('messages.font_size') }}</p>
                            <span>{{ $book['font_size'] }}</span>
                        </div>
                    </div>
                    <div class="article-itm-page-banner-desc-icon">
                        <span>{{ __('messages.share') }}:</span>
                        @include('components.social')
                    </div>
                </div>
                <h3>
                    {{ $book['price'] }}֏
                </h3>
                <div class="book-page-item-btn">
                    {{--                    <a class="add-to-cart" href="{{ LaravelLocalization::localizeUrl('add-to-cart') }}">Գնել</a>--}}
                    @if($book['in_stock'])
                        <a id="add-to-cart" href="#">{{ __('messages.buy') }}</a>
                    @else
                        <div style="color:red; margin: 20px">{{ __('messages.not_available') }}</div>
                    @endif

                    <input id="add-to-cart-url" type="hidden" value="{{ route('addToCart') }}">
                    <input id="checkout-router" type="hidden" value="{{ route('order') }}">
                    <input id="product-id" type="hidden" value="{{ $book['id'] }}">
                    <input id="quantity" type="hidden" value="1" name="number">

                </div>
                <div class="book-item-desc">
                    <h4>{{ __('messages.contents') }}</h4>
                    <p>{{ $book['text_' . app()->getLocale()] }}</p>
                    <div class="l_more">
                        <button class="learn-more-btn">{{ __('messages.read_more') }}</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="book-page-item-full-information content  accordion-container">
            <div class="book-page-item-additional-information  accordion">
                <h2 class="accordion-title">{{ __('messages.additional_information') }}</h2>
                <div class="book-page-item-additional-information-list  accordion-text">
                    <div class="additional-information-list-item">
                        <p>{{ __('messages.original_name') }}</p>
                        <div class="additional-information-list-item-img">
                            <img src="{{ URL::to('/images/Line2.png') }}" alt="line">
                        </div>
                        <span>{{ $book['title_' . app()->getLocale()]  }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p></p>
                        <div class="additional-information-list-item-img">
                            <img src="{{ URL::to('/images/Line2.png') }}" alt="line">
                        </div>
                        <span>{{ $book->category->age }} {{ __('messages.years') }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>ISBN</p>
                        <div class="additional-information-list-item-img">
                            <img src="{{ URL::to('/images/Line2.png') }}" alt="line">
                        </div>
                        <span>{{ $book['isbn']  }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>{{ __('messages.published_date') }}</p>
                        <div class="additional-information-list-item-img">
                            <img src="{{ URL::to('/images/Line2.png') }}" alt="line">
                        </div>
                        <span>{{ $book['published_date']  }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>{{ __('messages.page_count') }}</p>
                        <div class="additional-information-list-item-img">
                            <img src="{{ URL::to('/images/Line2.png') }}" alt="line">
                        </div>
                        <span>{{ $book['page_count']  }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>{{ __('messages.size') }}</p>
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

            <svg width="1" class="svg-additional-information" height="516" viewBox="0 0 1 516" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <line x1="0.5" x2="0.5" y2="516" stroke="#F36F21"/>
            </svg>

            <div class="book-page-item-after  accordion">
                <h2 class="faq-title">{{ __('messages.authors') }}</h2>
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

            <svg width="1" class="svg-additional-information" height="516" viewBox="0 0 1 516" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <line x1="0.5" x2="0.5" y2="516" stroke="#F36F21"/>
            </svg>

            <div class="book-page-item-book-trailer  accordion">
                <h2 class="accordion-title">{{ __('messages.book_trailer') }}</h2>
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


        <section class="book-page-reviews content">
            <h2>Կարծիքներ</h2>
            <div class="book-page-reviews-boxes">
                @foreach($book->comments as $comment)
                    <div class="book-page-reviews-item">
                        <p>{{ $comment->comment }}</p>
                        <span>{{ $comment->full_name }}</span>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="book-page-leave-review">
            <div class="book-page-leave-review-form"></div>
        </section>
        <section id="message-sent-successfully" class="book-page-leave-review">
            <h2 class="book-page-leave-review-title">Թողնել կարծիք</h2>
            <div class="book-page-leave-review-form content">
                <form action="{{ route('book.comment') }}" method="POST" class="forms review-form">
                    @csrf
                    <div class=" form-control form-first-name">
                        <input type="text" id="firs-name" name="full_name" placeholder="Անուն Ազգանուն*" required>
                        <small></small>
                    </div>

                    <div class="form-control form-email">
                        <input type="text" id="email" name="email" placeholder="Էլեկտրոնային հասցե*" required>
                        <small></small>
                    </div>

                    <div class=" form-control review">
                        <textarea class="accept-input" id="review" name="comment" placeholder="Կարծիք*" type="checkbox" required></textarea>
                        <small></small>
                    </div>

                    <div class=" form-control accept">
                        <input class="accept-input" name="terms" type="checkbox" required>
                        <span id="accept">Կարդացել և համաձայնվում եմ ոգտագործման պայմանների հետ</span>
                        <small></small>
                    </div>
                    <div class="form-btn">
                        <button>Ուղարկել</button>
{{--                        <button>{{ __('checkout.Ուղարկել') }}</button>--}}
                    </div>

                    <div class=" form-control accept">
                        @if(session('send_successfully_message'))
                            <div style="color: green" class="required--success"> {{ session('send_successfully_message') }}</div>
                        @endif

                        @if(session('send_comment_wrong_message'))
                            <div style="color: red" class="required--error"> {{ session('send_comment_wrong_message') }}</div>
                        @endif
                    </div>
                </form>

            </div>

        </section>


        <section class="reade-more content">
            <h2>Կարդացեք նաև</h2>
            <div class="reade-more-info-item">
                @foreach($otherBooks as $index => $book)
                    <div class="reade-more-item">
                        <div class="reade-more-item-images">
                            <div class="reade-more-item-img-logo">
                                <img src="{{ URL::to('images/reade-more-img-logo-green.png') }}" alt="">
                            </div>
                            <div class="reade-more-item-img-book">
                                <a href="{{ LaravelLocalization::localizeUrl('/book/' . $book['slug']) }}">
                                    <img width="270px" src="{{ URL::to('storage/' . $book['main_image']) }}" alt="">
                                </a>
                            </div>
                        </div>
                        <h3>{{ $book['title_' . app()->getLocale()] }}</h3>
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

            <div class="reade-more-see-more">
                <a href="{{ LaravelLocalization::localizeUrl('/books') }}">Տեսնել բոլորը</a>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 17L18 12L13 7" stroke="black" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M6 17L11 12L6 7" stroke="black" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>
        </section>
    </main>
@endsection

