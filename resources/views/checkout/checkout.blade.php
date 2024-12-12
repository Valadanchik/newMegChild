@extends('layout.layout')
@section('title', 'checkout')
@section('content')
    <main class="news-articles">
        <section class="shopping-cart-block content">
            <div class="shopping-cart-block-title">
                <h2>{{ __('checkout.cart') }}</h2>
            </div>
            @if(count($cardProducts))
                <form action="{{route('order.create')}}" method="POST" class="shopping-cart form-shopping-cart">
                    @csrf
                    <div class="shopping-cart-products-buy" style="margin-right: 20px">
                        <div class="shopping-cart-products-buy-items">
                            @if(isset($cardProducts['books']))
                                @foreach($cardProducts['books'] as $card_b_key => $book)
                                <div id="shopping-cart-products-item-{{ $book->category->type . '-' . $book['id']}}" class="shopping-cart-products-item">
                                   <div class="shopping-cart-products-item-img">
                                        <img src="{{ URL::to('storage/' . $book['main_image']) }}" alt="">
                                    </div>
                                    <div class="shopping-cart-products-item-desc">
                                        <h3 class="color-info-description-after">
                                            {{ $book['title_' . app()->getLocale()] }}
                                        </h3>
                                        <p class="color-info-description-translate">
                                            @foreach($book->authors as $key => $author)
                                                {{ $author['name_' . app()->getLocale()] }} {{ $key < count($book->authors) - 1 ? ',' : '' }}
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="shopping-cart-products-item-count">
                                        <div class="shopping-cart-products-item-count-img">
                                            <div data-product="{{ $book['id'] }}"
                                                 data-product-type="{{ $book->category->type }}"
                                                 data-price="{{ $book['price'] }}"
                                                 data-item="{{ $book->category->type . '-' . $book['id'] }}"
                                                 class="shopping-cart-products-count-item-min @if(session()->get('cart')[$book->category->type . '-' . $book['id']]['product_count'] == 1) min-none @endif min-count-{{ $book->category->type . '-' . $book['id'] }}">
                                                <img class="min"
                                                     src="{{ URL::to('/images/svg/shopping-cart-min-img.svg') }}"
                                                     alt="min img" data-id="min-1">
                                            </div>
                                            <input type="number" class="count-shop" id="count-shop-{{$book->category->type}}-{{$book['id']}}"
                                                   value="{{ session()->get('cart')[$book->category->type . '-' . $book['id']]['product_count'] }}">
                                            <div data-product="{{ $book['id'] }}"
                                                 data-product-type="{{ $book->category->type }}"
                                                 data-max="{{ $book['in_stock'] }}"
                                                 data-price="{{ $book['price'] }}" data-item="{{ $book->category->type . '-' . $book['id'] }}"
                                                 class="shopping-cart-products-count-item-plus">
                                                <img src="{{ URL::to('/images/svg/plus-circle.svg') }}"
                                                     alt="plus img">
                                            </div>
                                        </div>
                                        <span>{{ __('checkout.in_stock') }} {{ $book['in_stock'] }} {{ __('checkout.pcs') }}</span>
                                    </div>
                                    <div class="shopping-cart-products-item-price">
                                        <p>{{ $book['price'] }} ֏</p>
                                    </div>
                                    <div data-price="{{ $book['price'] }}" data-item="{{ $book->category->type . '-' . $book['id'] }}" data-product-type="{{ $book->category->type }}"
                                         class="shopping-cart-products-count-close-icon">
                                        <img src="{{ URL::to('/images/svg/close.svg') }}"
                                             class="remove-product-from-card" alt="close"
                                             data-product-id="{{ $book['id'] }}" data-product-type="{{ $book->category->type }}">
                                    </div>
                                </div>
                                <input id="product-id" type="hidden" value="{{ $book['id'] }}">
                                <input id="product-type" type="hidden" value="{{ $book->category->type  }}">
                                <input id="quantity" type="hidden" value="{{ session()->get('cart')[$book->category->type . '-' . $book['id']]['product_count'] }}"
                                       name="number">
                            @endforeach
                            @endif

                            @if(isset($cardProducts['accessors']))
                                @foreach($cardProducts['accessors'] as $card_a_key => $accessor)
                                <div id="shopping-cart-products-item-{{ $accessor->category->type . '-' . $accessor['id'] }}" class="shopping-cart-products-item">
                                   <div class="shopping-cart-products-item-img">
                                        <img src="{{ URL::to('storage/' . $accessor['main_image']) }}" alt="">
                                    </div>
                                    <div class="shopping-cart-products-item-desc">
                                        <h3 class="color-info-description-after">
                                            {{ $accessor['title_' . app()->getLocale()] }}
                                        </h3>
                                    </div>
                                    <div class="shopping-cart-products-item-count">
                                        <div class="shopping-cart-products-item-count-img">
                                            <div data-product="{{ $accessor['id'] }}"
                                                 data-product-type="{{ $accessor->category->type }}"
                                                 data-price="{{ $accessor['price'] }}"
                                                 data-item="{{$accessor->category->type . '-' . $accessor['id']}}"
                                                 class="shopping-cart-products-count-item-min @if(session()->get('cart')[$accessor->category->type . '-' . $accessor['id']]['product_count'] == 1) min-none @endif min-count-{{ $accessor->category->type . '-' . $accessor['id'] }}">
                                                <img class="min"
                                                     src="{{ URL::to('/images/svg/shopping-cart-min-img.svg') }}"
                                                     alt="min img" data-id="min-1">
                                            </div>
                                            <input type="number" class="count-shop" id="count-shop-{{$accessor->category->type}}-{{$accessor['id']}}"
                                                   value="{{ session()->get('cart')[$accessor->category->type . '-' . $accessor['id']]['product_count'] }}">
                                            <div data-product="{{ $accessor['id'] }}"
                                                 data-product-type="{{ $accessor->category->type }}"
                                                 data-max="{{ $accessor['in_stock'] }}"
                                                 data-price="{{ $accessor['price'] }}" data-item="{{ $accessor->category->type . '-' . $accessor['id'] }}"
                                                 class="shopping-cart-products-count-item-plus">
                                                <img src="{{ URL::to('/images/svg/plus-circle.svg') }}"
                                                     alt="plus img">
                                            </div>
                                        </div>
                                        <span>{{ __('checkout.in_stock') }} {{ $accessor['in_stock'] }} {{ __('checkout.pcs') }}</span>
                                    </div>
                                    <div class="shopping-cart-products-item-price">
                                        <p>{{ $accessor['price'] }} ֏</p>
                                    </div>
                                    <div data-price="{{ $accessor['price'] }}" data-item="{{ $accessor->category->type . '-' . $accessor['id'] }}" data-product-type="{{ $accessor->category->type }}"
                                         class="shopping-cart-products-count-close-icon">
                                        <img src="{{ URL::to('/images/svg/close.svg') }}"
                                             class="remove-product-from-card" alt="close"
                                             data-product-id="{{ $accessor['id'] }}" data-product-type="{{ $accessor->category->type }}">
                                    </div>
                                </div>
                                <input id="product-id" type="hidden" value="{{ $accessor['id'] }}">
                                <input id="product-type" type="hidden" value="{{ $accessor->category->type  }}">
                                <input id="quantity" type="hidden" value="{{ session()->get('cart')[$accessor->category->type . '-' . $accessor['id']]['product_count'] }}"
                                       name="number">
                            @endforeach
                            @endif
                            <input id="remove-from-cart-url" type="hidden" value="{{ route('removeFromCart') }}">
                            <input id="change-cart-product-count" type="hidden" value="{{ route('updateCart') }}">
                            <div class="shopping-cart-buttons">
                                <div>
                                    <span class="couponCallBackMessage"></span>
                                </div>
                                <div class="shopping-cart-code-input">
                                    <label>
                                        <input id="couponName" type="text" placeholder="Կոդը" value=""/>
                                        <input id="couponRouterName" type="hidden" value="{{ route('coupon.check') }}"/>
                                    </label>
                                </div>
                                <div class="shopping-cart-promo-code-btn">
                                    <button id="useCoupon">Կիրառել արժեկտրոնը</button>
                                </div>
                            </div>
                        </div>
                        <div>
                            @if(session('product_is_not_in_stock'))
                                <div style="color: red"
                                     class="required--error"> {{ session('product_is_not_in_stock') }}</div>
                            @endif
                        </div>

                        <div class="shopping-cart-payment-details">
                            <div class="shopping-cart-payment-details-title">
                                <h2>Վճարման տվյալները</h2>
                            </div>
                            <div class="shopping-cart-payment-details-form">
                                <div class="forms shopping-cart-forms">
                                    <div class="form-shopping-cart-name-lastName">
                                        <div class=" form-control form-shopping-cart-first-name">
                                            <label for="shopping-cart-firs-name"></label>
                                            <input class="accept-input"
                                                   type="text"
                                                   id="shopping-cart-firs-name"
                                                   placeholder="{{ __('checkout.first_name') }} *"
                                                   name="name"
                                                   value="{{old('name')}}">
                                            <small></small>
                                            <input id="required_name" type="hidden"
                                                   value="{{ __('validation.required_name') }}">
                                            @error('name')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class=" form-control form-shopping-cart-last-name">
                                            <input class="accept-input" type="text" id="last-name"
                                                   placeholder="{{ __('checkout.last_name') }}*"
                                                   name="lastname"
                                                   value="{{old('lastname')}}">
                                            <input id="required_last_name" type="hidden"
                                                   value="{{ __('validation.required_last_name') }}">
                                            <small></small>
                                            @error('lastname')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class=" form-control form-shopping-cart-company">
                                        <input class="accept-input" type="text" id="company"
                                               placeholder="{{ __('checkout.company_name') }}"
                                               name="company"
                                               value="{{old('company')}}">
                                        <small></small>
                                        @error('company')
                                        <div style="color: red" class="required--error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-control form-shopping-cart-count">
                                        <select name="country_id" id="country">
                                            <option value="" hidden>{{ __('checkout.select_country') }}*</option>
                                            @foreach($countries as $country)
                                                <option
                                                    data-shipping-price="{{$country->shipping_price}}"
                                                    value="{{$country->id}}"
                                                    @if(old('country_id') == $country->id) selected @endif>
                                                    {{$country->{'name_'.app()->getLocale()} }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input id="required_country" type="hidden"
                                               value="{{ __('validation.required_country') }}">
                                        <small></small>
                                        @error('country_id')
                                        <div style="color: red" class="required--error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{--<div class="form-control form-shopping-cart-count">
                                         <select name="region_id" id="region">
                                             @foreach($regions as $region)
                                                 <option
                                                     value="{{$region->id}}"
                                                     @if(old('region_id') == $region->id) selected @endif>
                                                     {{$region->{'name_'.app()->getLocale()} }}
                                                 </option>
                                             @endforeach
                                         </select>
                                         <small></small>
                                         @error('region_id')
                                             <div style="color: red" class="required--error">{{ $message }}</div>
                                         @enderror
                                     </div>--}}
                                    <div class="form-home-address-oll">
                                        <div class=" form-control form-shopping-cart-city">
                                            <input name="region" value="{{old('region')}}" type="text" id="city"
                                                   placeholder="{{ __('checkout.city') }} *">
                                            <input id="required_city" type="hidden"
                                                   value="{{ __('validation.required_city') }}">
                                            <small></small>
                                            @error('region')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class=" form-control form-shopping-cart-home">
                                            <input name="street" value="{{old('street')}}" type="text" id="home"
                                                   placeholder="{{ __('checkout.house_and_street') }} *">
                                            <input id="required_street" type="hidden"
                                                   value="{{ __('validation.required_street') }}">
                                            <small></small>
                                            @error('street')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class=" form-control form-shopping-cart-apartment">
                                            <input name="house" value="{{old('house')}}" type="text" id="apartment"
                                                   placeholder="{{ __('checkout.apartment') }}․․․">
                                            <small></small>
                                            @error('house')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class=" form-control form-post-code">
                                            <input type="text" value="{{old('postal_code')}}" name="postal_code"
                                                   id="post-code" placeholder="{{ __('checkout.post_code') }} *">
                                            <input id="required_post_code" type="hidden"
                                                   value="{{ __('validation.required_post_code') }}">
                                            <small></small>
                                            @error('postal_code')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class=" form-control form-shopping-cart-home-tell">
                                            <input type="text" value="{{old('phone')}}" name="phone" id="home-tell"
                                                   placeholder="{{ __('checkout.phone') }} *">
                                            <input id="required_phone" type="hidden"
                                                   value="{{ __('validation.required_phone') }}">
                                            <small></small>
                                            @error('phone')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-control form-shopping-cart-email">
                                            <input name="email" value="{{old('email')}}" type="text" id="email-shop"
                                                   placeholder="{{ __('checkout.email') }} *">
                                            <input id="required_email" type="hidden"
                                                   value="{{ __('validation.required_email') }}">
                                            <small></small>
                                            @error('email')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class=" form-control form-shopping-cart-review ">
                                        <textarea name="order_text" value="{{old('order_text')}}" class="accept-input"
                                                  id="review-sopping-cart"
                                                  placeholder="{{ __('checkout.shipping_info') }}"
                                                  type="checkbox"></textarea>
                                        <small></small>
                                        @error('order_text')
                                        <div style="color: red" class="required--error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text-info">
                                        <p>{!! __('checkout.checkout_text') !!}</p>
                                    </div>

                                    <div class="form-control accept">
                                        <input name="terms" id="accept_label" class="accept-input"  type="checkbox"
                                               value=" value="{{old('terms')}}"">
                                        <label id="accept-sopping-cart" for="accept_label">{{ __('checkout.agree') }}</label>
                                        <input id="required_terms" type="hidden"
                                               value="{{ __('validation.required_terms') }}">
                                        <small></small>
                                        @error('terms')
                                        <div style="color: red" class="required--error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="payment-cart">
                        <div class="other-services">
                            {{--<div>
                                <div class="other-services-title">
                                    <h2>Այլ ծառայություններ</h2>
                                </div>
                                <p>Փաթեթավորում</p>

                                <div class="packaging">
                                    <div class="packaging-none">
                                        <input type="radio" id="no" class="my-radio" name="contact" checked>
                                        <label for="no">Հարկավոր չէ</label>
                                    </div>
                                    <div class="packaging-standart">
                                        <input type="radio" id="st" class="my-radio" name="contact">
                                        <label for="st">Ստանդարտ</label>
                                    </div>
                                    <div class="packaging-premium">
                                        <input type="radio" id="pr" class="my-radio" name="contact">
                                        <label for="pr">Պրեմիում</label>
                                    </div>
                                </div>
                            </div>--}}
                            <div class="your-order">
                                <div class="your-order-title">
                                    <h2>{{ __('checkout.your_order') }}</h2>
                                </div>
                                <p>{{ __('checkout.payment_method') }}</p>
                                <div class="your-order-radio">
                                    <div class="packaging-standart">
                                        <input type="radio" id="idram" name="payment_method" class="my-radio"
                                               value="{{\App\Models\Order::PAYMENT_METHOD_IDRAM}}"
                                               @if(!old('payment_method') || old('payment_method') == \App\Models\Order::PAYMENT_METHOD_IDRAM) checked @endif>

                                        <label for="idram">
                                            <img src="{{ URL::to('images/svg/idram.svg') }}" alt="idram logo">
                                        </label>
                                    </div>

                                    <div class="packaging-premium">
                                        <input type="radio" id="telcell" name="payment_method" class="my-radio"
                                               value="{{\App\Models\Order::PAYMENT_METHOD_TELCELL}}"
                                               @if(old('payment_method') == \App\Models\Order::PAYMENT_METHOD_TELCELL) checked @endif>
                                        <label for="telcell">
                                            <img src="{{ URL::to('images/Telcell-Wallet_Logo.png') }}" alt="telcell logo" style="width:61px">
                                        </label>
                                    </div>


                                    <div class="packaging-standart">
                                        <input type="radio" id="bank" name="payment_method" class="my-radio"
                                               value="{{\App\Models\Order::PAYMENT_METHOD_BANK}}"
                                               @if(!old('payment_method') || old('payment_method') == \App\Models\Order::PAYMENT_METHOD_BANK) checked @endif>

                                        <label for="bank">
                                            <img src="{{ URL::to('images/svg/arca.svg') }}" alt="bank logo">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="all-result">
                                <div class="all-result-total">
                                    <p>{{ __('checkout.total') }}՝</p>
                                    <span><span class="total-price">{{$cardProductsTotalPrice}}</span> ֏</span>
                                </div>
                                {{--                                <div class="all-result-premium-packaging">
                                                                    <p>Պրեմիում Փաթեթավորում՝</p>
                                                                    <span>1000 ֏</span>
                                                                </div>--}}
                                <div class="all-result-shipment">
                                    <p>{{ __('checkout.shipping') }} ՝</p>
                                    <span class="ship-price">{{ __('checkout.free') }} </span>
                                </div>
                                <input id="required_price" type="hidden" value="{{ __('validation.required_price') }}">
                                <div class="all-result-payable-to">
                                    <p>{{ __('checkout.payable') }}՝</p>
                                    <span><span class="total-price-to-pay">{{$cardProductsTotalPrice}}</span> ֏</span>
                                </div>
                                <small class="all_errors">{{__('checkout.all_errors')}}</small>
                            </div>
                            <div class="payment-cart-btn">
                                <button>{{ __('checkout.go_to_checkout') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <p>{{ __('checkout.empty_cart') }}</p>
            @endif
        </section>
    </main>
@endsection
