@extends('layout.layout')
@section('title', $accessor['title_' . app()->getLocale()])
@section('description', $accessor['description_' . app()->getLocale()])
@section('keywords', $accessor['keywords_' . app()->getLocale()])
@section('ogimage', URL::to('storage/' . $accessor['main_image']))
@section('content')
    <main class="accessor-index news-articles">
        <section class="book-page-item-banner content">
            <div class="book-page-item-banner-img single-item">
                <img src="{{ URL::to('storage/' . $accessor['main_image']) }}" alt="">
                @foreach($accessor->images as $img)
                    <img src="{{ URL::to('storage/'.$img->image) }}" alt="">
                @endforeach
            </div>
            <div class="book-page-item-banner-info">
                <h2>{{ $accessor['title_' . app()->getLocale()]  }}</h2>

                <div class="book-page-item-param-and-icon">
                    <div class="book-page-item-description-param">
                        <div class="book-page-item-description-age">
                            <p>{{ __('messages.age') }}</p>
                            <span>{{ $accessor->category->age }}</span>
                        </div>
                    </div>
                    <div class="article-itm-page-banner-desc-icon">
                        <span>{{ __('messages.share') }}:</span>
                        @include('components.social')
                    </div>
                </div>
                <h3>
                    {{ $accessor['price'] }}֏
                </h3>
                <div class="book-page-item-btn">
                    {{--                    <a class="add-to-cart" href="{{ LaravelLocalization::localizeUrl('add-to-cart') }}">Գնել</a>--}}
                    @if($accessor['in_stock'])
                        <a id="add-to-cart" href="#">{{ __('messages.buy') }}</a>
                    @else
                        <div style="color:red; margin: 20px">{{ __('messages.not_available') }}</div>
                    @endif
                    <input id="add-to-cart-url" type="hidden" value="{{ route('addToCart') }}">
                    <input id="checkout-router" type="hidden" value="{{ route('order') }}">
                    <input id="product-id" type="hidden" value="{{ $accessor['id'] }}">
                    <input id="product-type" type="hidden" value="{{ $accessor->category->type }}">
                    <input id="quantity" type="hidden" value="1" name="number">
                </div>
                <div class="book-item-desc">
                    <h4>{{ __('messages.contents') }}</h4>
                    <span>{{ $accessor['description_' . app()->getLocale()] }}</span>
                    <p>{{ $accessor['text_' . app()->getLocale()] }}</p>
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
                        <span>{{ $accessor['title_' . app()->getLocale()]  }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>{{ __('messages.category') }}</p>
                        <div class="additional-information-list-item-img">
                            <img src="{{ URL::to('/images/Line2.png') }}" alt="line">
                        </div>
                        <span>{{ $accessor->category->age }}</span>
                    </div>
                    <div class="additional-information-list-item">
                        <p>ISBN</p>
                        <div class="additional-information-list-item-img">
                            <img src="{{ URL::to('/images/Line2.png') }}" alt="line">
                        </div>
                        <span>{{ $accessor['isbn']  }}</span>
                    </div>

                </div>
                <button class="accordion-toggle">
                    <img src="{{ URL::to('/images/svg/arrow-down-circle.svg') }}" alt="arrow down">
                </button>
            </div>
        </section>

        @if(count($accessor->comments) > 0)
            <section class="book-page-reviews content">
                <h2>{{ __('messages.comments') }}</h2>
                <div class="book-page-reviews-boxes multiple-items">
                    @foreach($accessor->comments as $comment)
                        <div class="book-page-reviews-item">
                            <p>{{ $comment->comment }}</p>
                            <span>{{ $comment->full_name }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="cloud-modal">
                    <p class="cloud-modal-text"></p>
                </div>
            </section>
        @endif

        <section class="book-page-leave-review">
            <div class="book-page-leave-review-form"></div>
        </section>
        <section id="message-sent-successfully" class="book-page-leave-review">
            <h2 class="book-page-leave-review-title">{{ __('messages.add_comment') }}</h2>
            <div class="book-page-leave-review-form content">
                <form action="{{ route('book.comment') }}" method="POST" class="forms review-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $accessor->id }}">
                    <input type="hidden" name="product_type" value="{{ $accessor->category->type }}">
                    <div class=" form-control form-first-name">
                        <input type="text" id="firs-name" name="full_name"
                               placeholder="{{ __('messages.full_name') }} *">
                        <small></small>
                        <input id="required_name" type="hidden" value="{{ __('validation.required_name') }}">
                        @error('name')
                        <div style="color: red" class="required--error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-control form-email">
                        <input type="text" id="email" name="email" placeholder="{{ __('messages.email') }} *">
                        <input id="required_email" type="hidden" value="{{ __('validation.required_email') }}">
                        <small></small>
                        @error('email')
                        <div style="color: red" class="required--error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class=" form-control review">
                        <textarea class="accept-input" id="review" name="comment"
                                  placeholder="{{ __('messages.comment') }}*" type="checkbox"></textarea>
                        <small></small>
                        <input id="required_review" type="hidden" value="{{ __('validation.required_review') }}">
                        @error('name')
                        <div style="color: red" class="required--error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class=" form-control accept">
                        <input class="accept-input" name="terms" type="checkbox" id="accept_id">
                        <label id="accept" for="accept_id"> <?php echo e(__('messages.terms')); ?></label>
                        <input id="required_terms" type="hidden" value="{{ __('validation.required_terms') }}">
                        <small></small>
                        @error('terms')
                        <div style="color: red" class="required--error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-btn">
                        <button>{{ __('messages.send') }}</button>
                    </div>

                    <div
                        class="form-control accept @if(session()->has('send_successfully_message') || session()->has('send_comment_wrong_message')) message-success @endif">

                        @if(session('send_successfully_message'))
                            <div class="required--success"> {{ session('send_successfully_message') }}</div>
                        @endif

                        @if(session('send_comment_wrong_message'))
                            <div class="required--error"> {{ session('send_comment_wrong_message') }}</div>
                        @endif
                    </div>
                </form>
            </div>
        </section>

        @if(count($otherAccessors))
            <section class="reade-more content">
                <h2 class="{{"reade-more-title-".app()->getLocale()}}">{{ __('messages.accessors') }}</h2>
                <div class="reade-more-info-item">
                    @foreach($otherAccessors as $index => $accessor)
                        <div class="reade-more-item">
                            <div class="reade-more-item-images">
                                <div class="reade-more-item-img-book">
                                    <a href="{{ LaravelLocalization::localizeUrl('/accessor/' . $accessor['slug']) }}">
                                        <img width="270px" src="{{ URL::to('storage/' . $accessor['main_image']) }}"
                                             alt="">
                                    </a>
                                </div>
                            </div>
                            <h3>
                                <a href="{{ LaravelLocalization::localizeUrl('/accessor/' . $accessor['slug']) }}">{{ $accessor['title_' . app()->getLocale()] }}</a>
                            </h3>

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

                <div class="reade-more-see-more">
                    <a href="{{ LaravelLocalization::localizeUrl('/accessors') }}">{{ __('messages.see_more') }}</a>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 17L18 12L13 7" stroke="black" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M6 17L11 12L6 7" stroke="black" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </div>
            </section>
        @endif

    </main>
@endsection

