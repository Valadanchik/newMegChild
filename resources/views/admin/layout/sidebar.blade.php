<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <!-- Sidenav Heading (Addons)-->
                <div class="sidenav-menu-heading">Dashboard</div>
                <!-- Sidenav Link (Charts)-->
                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('fs-admin/dashboard') }}">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboard
                </a>

                @can('isAdmin')
                    <div class="sidenav-menu-heading">Books</div>
                    <!-- Sidenav Link (Charts)-->
                    <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('fs-admin/books') }}">
                        <div class="nav-link-icon"><i data-feather="book"></i></div>
                        Books
                    </a>
                    <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('fs-admin/comment/index') }}">
                        <div class="nav-link-icon"><i data-feather="book"></i></div>
                        Book Comments
                    </a>
                    <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('fs-admin/authors') }}">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Authors
                    </a>
                    <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('fs-admin/subscriptions') }}">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Subscriptions
                    </a>
                    <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('fs-admin/translators') }}">
                        <div class="nav-link-icon"><i data-feather="user"></i></div>
                        Translators
                    </a>
                    <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('fs-admin/categories') }}">
                        <div class="nav-link-icon"><i data-feather="list"></i></div>
                        Categories
                    </a>
                    <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('fs-admin/users') }}">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Users
                    </a>
                @endcan

                <div class="sidenav-menu-heading">Posts</div>
                <!-- Sidenav Link (Charts)-->
                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('fs-admin/posts') }}">
                    <div class="nav-link-icon"><i data-feather="edit"></i></div>
                    Posts
                </a>
                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('fs-admin/medias') }}">
                    <div class="nav-link-icon"><i data-feather="edit"></i></div>
                    Medias
                </a>

                @can('isAdmin')
                    <div class="sidenav-menu-heading">Finance</div>
                    <!-- Sidenav Link (Charts)-->
                    <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('fs-admin/orders') }}">
                        <div class="nav-link-icon"><i data-feather="shopping-cart"></i></div>
                        Orders
                    </a>
                @endcan
                <div class="sidenav-menu-heading">Settings</div>
                <!-- Sidenav Link (Charts)-->
                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('fs-admin/settings') }}">
                    <div class="nav-link-icon"><i data-feather="settings"></i></div>
                    Settings
                </a>
                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('fs-admin/logout') }}">
                    <div class="nav-link-icon"><i data-feather="log-out"></i></div>
                    Logout
                </a>
            </div>
        </div>
    </nav>
</div>
