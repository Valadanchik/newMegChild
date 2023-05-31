@extends('layout.layout')

@section('content')
    <main class="news-articles content">
        <section class="shopping-cart-block">
            <div class="shopping-cart-block-title">
                <h2>Զամբյուղ</h2>
            </div>

{{--            {{ dd(session()->get('cart')) }}--}}
            @if(count($cardBooks))
                <form action="{{route('order.create')}}" method="POST" class="shopping-cart form-shopping-cart">
                    @csrf
                    <div class="shopping-cart-products-buy" style="margin-right: 20px">
                        <div class="shopping-cart-products-buy-items">
                            @foreach($cardBooks as $card_key => $card)
                                <div id="shopping-cart-products-item-{{$card_key}}" class="shopping-cart-products-item">

                                    <div class="shopping-cart-products-item-img">
                                        <img src="{{ URL::to('storage/' . $card['main_image']) }}" alt="">
                                    </div>

                                    <div class="shopping-cart-products-item-desc">
                                        <h3 class="color-info-description-after">
                                            {{ $card['title_' . app()->getLocale()] }}
                                        </h3>
                                        <p class="color-info-description-translate">
                                            @foreach($card->authors as $key => $author)
                                                {{ $author['name_' . app()->getLocale()] }} {{ $key < count($card->authors) - 1 ? ',' : '' }}
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="shopping-cart-products-item-count">
                                        <div class="shopping-cart-products-item-count-img">
                                            <div data-product="{{ $card['id'] }}" data-price="{{ $card['price'] }}" data-item="{{$card_key}}" class="shopping-cart-products-count-item-min  min-none min-count-{{$card_key}}">
                                                <img class="min" src="{{ URL::to('/images/svg/shopping-cart-min-img.svg') }}"
                                                     alt="min img" data-id="min-1">
                                            </div>
                                            <input type="number" class="count-shop" id="count-shop-{{$card_key}}" value="{{ session()->get('cart')[$card['id']] }}">
                                            <div data-product="{{ $card['id'] }}" data-max="{{ $card['in_stock'] }}" data-price="{{ $card['price'] }}" data-item="{{$card_key}}" class="shopping-cart-products-count-item-plus">
                                                <img src="{{ URL::to('/images/svg/shopping-cart-plus-img.svg') }}"
                                                     alt="plus img">
                                            </div>
                                        </div>
                                        <span>Հասանելի է {{ $card['in_stock'] }} հատ</span>
                                    </div>



                                    <div class="shopping-cart-products-item-price">
                                        <p>{{ $card['price'] }} ֏</p>
                                    </div>

                                    <div data-price="{{ $card['price'] }}" data-item="{{$card_key}}"  class="shopping-cart-products-count-close-icon">
                                        <img src="{{ URL::to('/images/svg/close.svg') }}" class="remove-product-from-card" alt="close" data-book-id="{{ $card['id'] }}">
                                    </div>
                                </div>
                                <input id="product-id" type="hidden" value="{{ $card['id'] }}">
                                <input id="quantity" type="hidden" value="{{ session()->get('cart')[$card['id']] }}" name="number">

                            @endforeach

                                <input id="remove-from-cart-url" type="hidden" value="{{ route('removeFromCart') }}">
                                <input id="change-cart-product-count" type="hidden" value="{{ route('updateCart') }}">


{{--                                {{ dd(session()->get('cart')) }}--}}

                            {{--                            <div class="shopping-cart-buttons">
                                                            <div class="shopping-cart-code-input">
                                                                <input type="text" placeholder="Կոդը" value="code"/>
                                                            </div>
                                                            <div class="shopping-cart-promo-code-btn">
                                                                <a href="">Կիրառել արժեկտրոնը</a>
                                                            </div>
                                                        </div>--}}

                        </div>


                        <div class="">
                            @if(session('product_is_not_in_stock'))
                                <div style="color: red" class="required--error"> {{ session('product_is_not_in_stock') }}</div>
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
                                                   placeholder="Անուն*"
                                                   name="name"
                                                   value="{{old('name')}}">
                                            <small></small>
                                            @error('name')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class=" form-control form-shopping-cart-last-name">
                                            <input class="accept-input" type="text" id="last-name"
                                                   placeholder="Ազգանուն*"
                                                   name="lastname"
                                                   value="{{old('lastname')}}">
                                            <small></small>
                                            @error('lastname')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class=" form-control form-shopping-cart-company">
                                        <input class="accept-input" type="text" id="company"
                                               placeholder="Ընկերության անվանումը (ըստ ընտրության) "
                                               name="company"
                                               value="{{old('company')}}">
                                        <small></small>
                                        @error('company')
                                        <div style="color: red" class="required--error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-control form-shopping-cart-count">
                                        <select name="country_id" id="country">
                                            @foreach($countries as $country)
                                                <option
                                                    value="{{$country->id}}"
                                                    @if(old('country_id') == $country->id) selected @endif>
                                                    {{$country->{'name_'.app()->getLocale()} }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small></small>
                                        @error('country_id')
                                        <div style="color: red" class="required--error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{--                               <div class="form-control form-shopping-cart-count">
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
                                        <div class=" form-control form-shopping-cart-home">
                                            <input name="street" value="{{old('street')}}" type="text" id="home" placeholder="Տան համար և փողոց *">
                                            <small></small>
                                            @error('street')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class=" form-control form-shopping-cart-apartment">
                                            <input name="house" value="{{old('house')}}" type="text" id="apartment" placeholder="Բնակարան, կացարան և ալն․․․">
                                            <small></small>
                                            @error('house')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class=" form-control form-shopping-cart-city">
                                            <input name="region" value="{{old('region')}}" type="text" id="city" placeholder="Քաղաք/Վարչական շրջան *">
                                            <small></small>
                                            @error('region')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class=" form-control form-post-code">
                                            <input type="text" value="{{old('postal_code')}}" name="postal_code" id="post-code" placeholder="Փոստային կոդ *">
                                            <small></small>
                                            @error('postal_code')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class=" form-control form-shopping-cart-home-tell">
                                            <input type="text" value="{{old('phone')}}" name="phone" id="home-tell" placeholder="Հեռախոս *">
                                            <small></small>
                                            @error('phone')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-control form-shopping-cart-email">
                                            <input name="email" value="{{old('email')}}" type="text" id="email-shop" placeholder="Էլեկտրոնային հասցե*">
                                            <small></small>
                                            @error('email')
                                            <div style="color: red" class="required--error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class=" form-control form-shopping-cart-review " >
                                        <textarea name="order_text" value="{{old('order_text')}}" class="accept-input" id="review-sopping-cart"
                                                  placeholder="Ձեր պատվերի մասին նշումներ, օրինակ, հատուկ նշումներ առաքման համար *"
                                                  type="checkbox"></textarea>
                                        <small></small>
                                        @error('order_text')
                                        <div style="color: red" class="required--error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text-info">
                                        <p>Ձեր անձնական տվյալները կօգտագորշվեն ձեր պատվերը մշակոլու համար և այլ
                                            նպատակներով,
                                            որոնք նկարագրված են մեր
                                            <span>Գիրք պատվիրելու պայմանները</span>-ում։
                                        </p>
                                    </div>

                                    <div class="form-control accept">
                                        <input name="terms" class="accept-input" type="checkbox" value=" value="{{old('terms')}}"">
                                        <span id="accept-sopping-cart">Կարդացել և համաձայնվում եմ ոգտագործման պայմանների հետ</span>
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
                            {{--                            <div class="other-services-title">
                                                            <h2>Այլ ծառայություններ</h2>
                                                        </div>
                                                        <p>Փաթեթավորում</p>

                                                        <div class="ackaging">

                                                            <div class="packaging-none">
                                                                <input type="radio" id="no" class="my-radio" name="contact">
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
                                                        </div>--}}
                            <div class="your-order">
                                <div class="your-order-title">
                                    <h2>Ձեր պատվերը</h2>
                                </div>
                                <p>Վճարման եղանակ</p>
                                <div class="your-order-radio">

                                    {{--<div class="packaging-none">
                                        <input type="radio" id="arca" class="my-radio" name="payment_method"
                                               value="{{\App\Models\Order::PAYMENT_METHOD_BANK}}"
                                               @if(old('payment_method') == \App\Models\Order::PAYMENT_METHOD_BANK) checked @endif
                                        >
                                        <label for="arca">
                                            <img src="{{ URL::to('images/svg/arca.svg') }}" alt="arca logo">
                                        </label>
                                    </div>
--}}
                                    <div class="packaging-standart">
                                        <input type="radio" id="idram" name="payment_method"  class="my-radio"
                                               value="{{\App\Models\Order::PAYMENT_METHOD_IDRAM}}"
                                               @if(old('payment_method') == \App\Models\Order::PAYMENT_METHOD_IDRAM) checked @endif>

                                        <label for="idram">
                                            <img src="{{ URL::to('images/svg/idram.svg') }}" alt="idram logo">
                                        </label>
                                    </div>
                                    {{--<div class="packaging-premium">
                                        <input type="radio" id="telcell" name="payment_method" class="my-radio"
                                               value="{{\App\Models\Order::PAYMENT_METHOD_IDRAM}}"
                                               @if(old('payment_method') == \App\Models\Order::PAYMENT_METHOD_IDRAM) checked @endif>
                                        <label for="telcell">
                                            <img src="{{ URL::to('images/svg/telcell.svg') }}" alt="telcell logo">
                                        </label>
                                    </div>--}}
                                </div>
                            </div>
                            <div class="all-result">
                                <div class="all-result-total">
                                    <p>Ընդամենը՝</p>
                                    <span><span class="total-price">{{$cardProductsTotalPrice}}</span> ֏</span>
                                </div>
                                {{--                                <div class="all-result-premium-packaging">
                                                                    <p>Պրեմիում Փաթեթավորում՝</p>
                                                                    <span>1000 ֏</span>
                                                                </div>--}}
                                <div class="all-result-shipment">
                                    <p>Առաքում՝</p>
                                    <span>Անվճար</span>
                                </div>
                                <div class="all-result-payable-to">
                                    <p>Վճարման ենթակա՝</p>
                                    <span><span class="total-price-to-pay">{{$cardProductsTotalPrice}}</span> ֏</span>
                                </div>
                            </div>
                            <div class="payment-cart-btn">
                                <button>Անցնել վճարման</button>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <p>cart empty</p>
            @endif
        </section>
    </main>
@endsection


