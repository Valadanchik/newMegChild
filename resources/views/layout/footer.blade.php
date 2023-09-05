<footer>
    <div id="footer" class="footer content">
        <div>
            <div class="footer-logo">
                <img src="{{ URL::to('/images/svg/footer-logo.svg') }}" alt="logo">
            </div>
            <div class="footer-menu">
                <a href="{{ LaravelLocalization::localizeUrl('/about') }}">{{ __('header.about_us') }}</a>
                <a href="{{ LaravelLocalization::localizeUrl('/authors') }}">{{ __('header.authors') }}</a>
                <a href="{{ LaravelLocalization::localizeUrl('/books') }}">{{ __('header.books') }}...</a>
                <a href="{{ LaravelLocalization::localizeUrl('/translators') }}">{{ __('header.translators') }}</a>
                <a href="{{ LaravelLocalization::localizeUrl('/articles') }}">{{ __('header.articles') }}</a>
                <a href="{{ LaravelLocalization::localizeUrl('/accessors') }}" class="{{ isRouteActive('accessors') ? 'active-menu-underline' : '' }}">{{ __('header.accessors') }}</a>
            </div>
        </div>
        <div class="footer-icon-input">
            <div class="footer-icons">
                <div class="faccebook-logo" style="width:28px ; height:28px">
                    <a href='{{ Cache::get('settings')['fb_link'] }}' target="_blank">
                        <img src="{{ URL::to('images/svg/facebook-logo.svg') }}" alt="facebook logo" style="width:100%">
                    </a>
                </div>
                <div class="twitter-logo" style="width:28px ; height:28px">
                    <a href="{{ Cache::get('settings')['twitter_link'] }}" target="_blank">
                        <img src="{{ URL::to('images/svg/twitter-logo.svg') }}" alt="twitter logo" style="width:100%">
                    </a>
                </div>
                <div class="linkedin-logo" style="width:28px ; height:28px">
                    <a href="{{ Cache::get('settings')['linkedin_link'] }}" target="_blank">
                        <img src="{{ URL::to('images/svg/linkedin-logo.svg') }}" alt="linkedin logo" style="width:100%">
                    </a>
                </div>
                <div class="instagrem-logo" style="width:28px ; height:28px">
                    <a href="{{ Cache::get('settings')['instagram_link'] }}" target="_blank">
                        <img src="{{ URL::to('images/svg/instagram-logo.svg') }}" alt="instagram logo"
                             style="width:100%">
                    </a>
                </div>
                <div class="youtube-logo" style="width:28px ; height:28px">
                    <a href="{{ Cache::get('settings')['youtube_link'] }}" target="_blank">
                        <img src="{{ URL::to('images/svg/youtube-logo.svg') }}" alt="youtube logo" style="width:100%">
                    </a>
                </div>
            </div>
            <a href="https://www.google.com/maps/search/%D4%B1%D6%80%D5%B7%D5%A1%D5%AF%D5%B8%D6%82%D5%B6%D5%B5%D5%A1%D5%B6%D5%AE+4,+%D4%B5%D6%80%D6%87%D5%A1%D5%B6+0023/@40.170156,44.5078003,16.25z"
               target="_blank" class="footer-address">{{ Cache::get('settings')['address'] }}</a>

            <form action="{{ route('subscription.store') }}" method="POST" class="footer-form">
                @csrf
                <div class="footer-form-box">
                    <input type="email" name="subscribe_email" placeholder="{{ __('header.subscribe') }}">
                    <button>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z"
                                stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 6L12 13L2 6" stroke="black" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                @if(session('success_subscribe'))
                    <div style="color: green">
                        {{ session('success_subscribe') }}
                    </div>
                @endif
                @error('subscribe_email')
                <div style="color: red" class="required--error">{{ $message }}</div>
                @enderror
            </form>
        </div>
        <div class="footer-price">
            <div class="footer-money">
                <div class="footer-money-visa"><img src="{{ URL::to('/images/visa.png') }}" alt="visa"></div>
                <div class="footer-money-master"><img src="{{ URL::to('/images/master.png') }}" alt="master"></div>
                <div class="footer-money-telcell"><img src="{{ URL::to('/images/telcell.png') }}" alt="telcell"></div>
                <div class="footer-money-idram"><img src="{{ URL::to('/images/idram.png') }}" alt="idram"></div>
            </div>
            <div class="footer-book">
                <a href="https://newmag.am/terms" target="_blank">{{ __('header.book_ordering_conditions') }}</a>
                <a href="https://newmag.am/advertising" target="_blank">{{ __('header.advertising_and_services') }}</a>
                <a href="https://future-systems.am/">{{ __('header.site') }}` Future Systems</a>
            </div>
        </div>
    </div>
    <div class="footer-newmag content">
        <p>Newmag © 2011-2023</p>
    </div>
</footer>
<div class="modal "></div>
