<header>
    <div class="header content">
        <div id="nav-icon1">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="header-logo">
            <a href="{{ LaravelLocalization::localizeUrl('/') }}">
                <img src="{{ URL::to('/images/svg/logo.svg') }}" alt="logo images">
            </a>
        </div>

        <div class="header-menu">
            <nav class="nav">
                <ul class="header-menu-list">
                    <li class="menu-about-us {{ isRouteActive('about') ? 'active-menu-underline' : '' }}">Մատենաշարի մասին
                        <ul class="menu-drop-down">
                            <li><a href="{{ LaravelLocalization::localizeUrl('/about') }}" class="{{ isRouteActive('about') ? 'active-menu-underline' : '' }}">Մատենաշարի մասին</a></li>
                            <li><a href="#">Կապ</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ LaravelLocalization::localizeUrl('/books') }}" class="{{ isRouteActive('books') ? 'active-menu-underline' : '' }}">Գրքեր...</a></li>
                    <li><a href="{{ LaravelLocalization::localizeUrl('/authors') }}" class="{{ isRouteActive('authors') ? 'active-menu-underline' : '' }}">Հեղինակներ</a></li>
                    <li><a href="{{ LaravelLocalization::localizeUrl('/translators') }}" class="{{ isRouteActive('translators') ? 'active-menu-underline' : '' }}">Թարգմանիչներ</a></li>
                    <li><a href="{{ LaravelLocalization::localizeUrl('/articles') }}" class="{{ isRouteActive('articles') ? 'active-menu-underline' : '' }}">Հոդվածներ</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-icon">
            <div class="header-icon-serch">
                <svg  viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.8643 19C16.2825 19 19.8643 15.4183 19.8643 11C19.8643 6.58172 16.2825 3 11.8643 3C7.44598 3 3.86426 6.58172 3.86426 11C3.86426 15.4183 7.44598 19 11.8643 19Z"
                          stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21.8646 21L17.5146 16.65" stroke="black" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="header-icon-img">
                <img src="{{ URL::to('/') }}/images/Line%202.png" alt="line">
            </div>

            <div class="header-icon-shop">
                <svg  viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.84164 8.84C1.88186 8.33881 2.10939 7.87115 2.47891 7.53017C2.84843 7.18918 3.33283 6.9999 3.83564 7H15.8936C16.3964 6.9999 16.8808 7.18918 17.2504 7.53017C17.6199 7.87115 17.8474 8.33881 17.8876 8.84L18.6906 18.84C18.7127 19.1152 18.6776 19.392 18.5875 19.6529C18.4973 19.9139 18.3542 20.1533 18.1669 20.3562C17.9797 20.5592 17.7525 20.7211 17.4997 20.8319C17.2468 20.9427 16.9737 20.9999 16.6976 21H3.03164C2.75556 20.9999 2.48249 20.9427 2.22962 20.8319C1.97674 20.7211 1.74955 20.5592 1.56233 20.3562C1.37512 20.1533 1.23194 19.9139 1.14181 19.6529C1.05168 19.392 1.01655 19.1152 1.03864 18.84L1.84164 8.84Z"
                          stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13.8643 10V5C13.8643 3.93913 13.4428 2.92172 12.6927 2.17157C11.9425 1.42143 10.9251 1 9.86426 1C8.80339 1 7.78598 1.42143 7.03583 2.17157C6.28569 2.92172 5.86426 3.93913 5.86426 5V10"
                          stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="header-icon-img">
                <img src="{{ URL::to('/images/Line%202.png') }}" alt="line">
            </div>
            <div class="header-icon-leng">
                <p>EN</p>
            </div>


        </div>
    </div>

</header>
@include('components.loader')
