    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Sidenav Toggle Button-->
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="{{ route('admin.index') }}">Newmag Admin Dashboard</a>
        <!-- Navbar Search Input-->
        <!-- * * Note: * * Visible only on and above the lg breakpoint-->
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ms-auto">
            <!-- Messages Dropdown-->
            <!-- User Dropdown-->
{{--            <div class="header-icon-leng p-3 mt-3">
                <p>
                    @if(LaravelLocalization::getCurrentLocale() == 'en')
                        <a class="dropdown-item" rel="alternate" hreflang="hy" href="{{ LaravelLocalization::getLocalizedURL('hy', null, [], true) }}">HY</a>
                    @else
                        <a class="dropdown-item" rel="alternate" hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">EN</a>
                    @endif
                </p>
            </div>--}}
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="img-fluid" src="{{ URL::to('/images/svg/logo.svg') }}" /></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="{{ URL::to('/images/svg/logo.svg') }}" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name">Newmag Admin</div>
                            <div class="dropdown-user-details-email">{{ Auth::user()->email }}</div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
