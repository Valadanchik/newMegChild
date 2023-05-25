@extends('layout.layout')

@section('content')
    <main class="news-articles content">
        <section class="shopping-cart-block">
            <div class="shopping-cart-block-title">
                <h2>Զամբյուղ</h2>
            </div>

            <form action="" class="shopping-cart form-shopping-cart" >

                <div class="shopping-cart-products-buy" style="margin-right: 20px">
                    <div class="shopping-cart-products-buy-items">
                        @foreach($cardBooks as $card)
                            <div class="shopping-cart-products-item">

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
                                        <div class="shopping-cart-products-count-item-min">
                                            <img src="{{ URL::to('/images/svg/shopping-cart-min-img.svg') }}" alt="min img">
                                        </div>
                                        <p>1</p>
                                        <div class="shopping-cart-products-count-item-min">
                                            <img src="{{ URL::to('/images/svg/shopping-cart-plus-img.svg') }}" alt="plus img">
                                        </div>
                                    </div>
                                    <span>Հասանելի է {{ $card['in_stock'] }} հատ</span>
                                </div>
                                <div class="shopping-cart-products-item-price">
                                    <p>{{ $card['price'] }} ֏</p>
                                </div>
                                <div class="shopping-cart-products-count-close-icon">
                                    <img src="{{ URL::to('/images/svg/close.svg') }}" alt="close">
                                </div>
                            </div>
                        @endforeach
                        <div class="shopping-cart-buttons">
                            <div class="shopping-cart-code-input">
                                <input type="text" placeholder="Կոդը" value="code"/>
                            </div>
                            <div class="shopping-cart-promo-code-btn">
                                <a href="">Կիրառել արժեկտրոնը</a>
                            </div>
                        </div>

                    </div>

                    <div class="shopping-cart-payment-details">
                        <div class="shopping-cart-payment-details-title">
                            <h2>Վճարման տվյալները</h2>
                        </div>
                        <div class="shopping-cart-payment-details-form">
                            <div class="forms shopping-cart-forms">


                                <div class="form-shopping-cart-name-lastName">
                                    <div class=" form-control form-shopping-cart-first-name">
                                        <input class="accept-input" type="text" id="shopping-cart-firs-name" placeholder="Անուն*">
                                        <small></small>
                                    </div>
                                    <div class=" form-control form-shopping-cart-last-name">
                                        <input  class="accept-input"  type="text" id="last-name" placeholder="Ազգանուն*">
                                        <small></small>
                                    </div>

                                </div>

                                <div class=" form-control form-shopping-cart-company">
                                    <input  class="accept-input"  type="text" id="company" placeholder="Ընկերության անվանումը (ըստ ընտրության) ">
                                    <small></small>
                                </div>

                                <div class=" form-control form-shopping-cart-count">
                                    <select id="country">
                                        <option hidden>Ընտրեք երկիրը *</option>
                                        <option>aaaa</option>
                                        <option>bbbb</option>
                                        <option>cccc</option>
                                        <option>dddd</option>
                                    </select>
                                    <small></small>
                                </div>


                                <div class="form-home-address-oll">

                                    <div class=" form-control form-shopping-cart-home">
                                        <input type="text" id="home" placeholder="Տան համար և փողոց *">
                                        <small></small>
                                    </div>

                                    <div class=" form-control form-shopping-cart-apartment">
                                        <input type="text" id="apartment" placeholder="Բնակարան, կացարան և ալն․․․">
                                        <small></small>
                                    </div>

                                    <div class=" form-control form-shopping-cart-city">
                                        <input type="text" id="city" placeholder="Քաղաք/Վարչական շրջան *">
                                        <small></small>
                                    </div>

                                    <div class=" form-control form-post-code">
                                        <input type="number" id="post-code" placeholder="Փոստային կոդ *">
                                        <small></small>
                                    </div>

                                    <div class=" form-control form-shopping-cart-home-tell">
                                        <input type="number" id="home-tell" placeholder="Հեռախոս *">
                                        <small></small>
                                    </div>

                                    <div class="form-control form-shopping-cart-email">
                                        <input type="text" id="email-shop" placeholder="Էլեկտրոնային հասցե*">
                                        <small></small>
                                    </div>


                                </div>

                                <div class=" form-control form-shopping-cart-review">
                <textarea class="accept-input" id="review-sopping-cart"
                          placeholder="Ձեր պատվերի մասին նշումներ, օրինակ, հատուկ նշումներ առաքման համար *"
                          type="checkbox"></textarea>
                                    <small></small>
                                </div>
                                <div class="form-text-info">
                                    <p>Ձեր անձնական տվյալները կօգտագորշվեն ձեր պատվերը մշակոլու համար և այլ նպատակներով,
                                        որոնք նկարագրված են մեր
                                        <span>Գիրք պատվիրելու պայմանները</span>-ում։</p>
                                </div>


                                <div class=" form-control accept" >
                                    <input class="accept-input"   type="checkbox">
                                    <span id="accept-sopping-cart">Կարդացել և համաձայնվում եմ ոգտագործման պայմանների հետ</span>
                                    <small></small>
                                </div>


                                <!--            <div class="form-btn">-->
                                <!--              <button>Ուղարկել</button>-->
                                <!--            </div>-->
                            </div>
                        </div>


                    </div>

                </div>

                <div class="payment-cart">
                    <div class="other-services">
                        <div class="other-services-title">
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
                        </div>
                        <div class="your-order">
                            <div class="your-order-title">
                                <h2>Ձեր պատվերը</h2>
                            </div>
                            <p>Վճարման եղանակ</p>
                            <div class="your-order-radio">

                                <div class="packaging-none">
                                    <input type="radio" id="arca" class="my-radio" name="contact">
                                    <label for="arca">
                                        <img src="{{ URL::to('images/svg/arca.svg') }}" alt="arca logo">
                                    </label>
                                </div>
                                <div class="packaging-standart">
                                    <input type="radio" id="idram" class="my-radio" name="contact">
                                    <label for="idram">
                                        <img src="{{ URL::to('images/svg/idram.svg') }}" alt="idram logo">
                                    </label>
                                </div>
                                <div class="packaging-premium">
                                    <input type="radio" id="telcell" class="my-radio" name="contact">
                                    <label for="telcell">
                                        <img src="{{ URL::to('images/svg/telcell.svg') }}" alt="telcell logo">
                                    </label>
                                </div>

                                <div class="packaging-premium">
                                    <input type="radio" id="fcf" class="my-radio" name="contact">
                                    <label for="fcf">
                                        <img src="{{ URL::to('images/svg/fcf.svg') }}" alt="fcf logo">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="oll-result">
                            <div class="oll-result-total">
                                <p>Ընդամենը՝</p>
                                <span>4800 ֏</span>
                            </div>
                            <div class="oll-result-premium-packaging">
                                <p>Պրեմիում Փաթեթավորում՝</p>
                                <span>1000 ֏</span>
                            </div>
                            <div class="oll-result-shipment">
                                <p>Առաքում՝</p>
                                <span>Անվճար</span>
                            </div>
                            <div class="oll-result-payable-to">
                                <p>Վճարման ենթակա՝</p>
                                <span>14400֏</span>
                            </div>
                        </div>
                        <div class="payment-cart-btn">
                            <button>Անցնել վճարման</button>
                        </div>


                    </div>
                </div>
            </form>


        </section>
    </main>
@endsection


