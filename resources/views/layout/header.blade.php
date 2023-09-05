<header>
    <div class="header content">
        <div class="header-logo">
            <a href="{{ LaravelLocalization::localizeUrl('/') }}">
                <img src="{{ URL::to('/images/svg/logo.svg') }}" alt="logo images">
            </a>
        </div>
        <div class="header-menu">
            <nav class="nav">
                <ul class="header-menu-list">
                    <li class="menu-about-us {{ isRouteActive('about') ? 'active-menu-underline' : '' }}">{{ __('header.about_us') }}
                        <ul class="menu-drop-down">
                            <li>
                                <a href="{{ LaravelLocalization::localizeUrl('/about') }}"
                                   class="{{ isRouteActive('about') ? 'active-menu-underline' : '' }}">{{ __('header.about_directory') }}</a>
                            </li>
                            <li>
                                <a href="{{ LaravelLocalization::localizeUrl('/contact-us') }}">{{ __('header.contact_us') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="book-menu-drop-down">
                        <a href="{{ LaravelLocalization::localizeUrl('/books') }}"
                           class="{{ isRouteActive('books') ? 'active-menu-underline' : '' }}">{{ __('header.books') }}
                            ...</a>
                        <ul  class="menu-drop-down books-drop-down">
                            @foreach(\App\Models\Categories::where('type', \App\Models\Categories::TYPE_BOOK)->get() as $category)
                                <li>
                                    <a href="{{ LaravelLocalization::localizeUrl('/category/' . $category['name_en']) }}">{{ $category['name_' . app()->getLocale()] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="{{ LaravelLocalization::localizeUrl('/accessors') }}"
                           class="{{ isRouteActive('accessors') ? 'active-menu-underline' : '' }}">{{ __('header.accessors') }}</a>
                    </li>
                    <li>
                        <a href="{{ LaravelLocalization::localizeUrl('/authors') }}"
                           class="{{ isRouteActive('authors') ? 'active-menu-underline' : '' }}">{{ __('header.authors') }}</a>
                    </li>
                    <li>
                        <a href="{{ LaravelLocalization::localizeUrl('/translators') }}"
                           class="{{ isRouteActive('translators') ? 'active-menu-underline' : '' }}">{{ __('header.translators') }}</a>
                    </li>
                    <li class="menu-drop-down-articles">
                        {{ __('header.articles') }}
                        <ul class="drop-down-articles">
                            <li><a href="{{ LaravelLocalization::localizeUrl('/articles') }}"
                                   class="{{ isRouteActive('articles') ? 'active-menu-underline' : '' }}">{{ __('header.news') }}</a>
                            </li>
                            <li>
                                <a href="{{ LaravelLocalization::localizeUrl('/media-articles') }}">{{ __('header.media') }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="burger-menu-and-icons">
            <div class="header-icon">
                <div class="header-icon-serch search">
                    <img src="{{ URL::to('/images/svg/search-logo.svg') }}" alt="search logo">
                </div>
                <div class="header-icon-img">
                    <img src="{{ URL::to('/images/Line%202.png') }}" alt="line">
                </div>
                <div class="header-icon-shop">
                    @if(session()->get('cart'))
                        <sub>{{ count(session()->get('cart')) }}</sub>
                    @endif
                    <a href="{{ route('order') }}">
                        <img src="{{ URL::to('/images/svg/shopping-cart.svg') }}" alt="sopping cart logo">
                    </a>
                </div>
                <div class="header-icon-img-left ">
                    <img src="{{ URL::to('/images/Line%202.png') }}" alt="line">
                </div>
{{--                <div class="header-icon-img">--}}
{{--                    <img src="{{ URL::to('/images/Line%202.png') }}" alt="line">--}}
{{--                </div>--}}
{{--                <div class="header-icon-leng">
                    <p>
                        @if(LaravelLocalization::getCurrentLocale() == 'en')
                            <a rel="alternate" hreflang="hy"
                               href="{{ LaravelLocalization::getLocalizedURL('hy', null, [], true) }}">HY</a>
                        @else
                            <a rel="alternate" hreflang="en"
                               href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">EN</a>
                        @endif
                    </p>
                </div>--}}
            </div>
            <div id="nav-icon1">
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>
        @include('components.search')
    </div>
</header>
@include('components.loader')
