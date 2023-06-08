<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <!-- Sidenav Heading (Addons)-->
                <div class="sidenav-menu-heading">Dashboard</div>
                <!-- Sidenav Link (Charts)-->
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboard
                </a>

                <div class="sidenav-menu-heading">Books</div>
                <!-- Sidenav Link (Charts)-->
                <a class="nav-link" href="{{ route('books.index') }}">
                    <div class="nav-link-icon"><i data-feather="book"></i></div>
                    Books
                </a>
                <a class="nav-link" href="{{ route('authors.index') }}">
                    <div class="nav-link-icon"><i data-feather="users"></i></div>
                    Authors
                </a>
                <a class="nav-link" href="{{ route('translators.index') }}">
                    <div class="nav-link-icon"><i data-feather="user"></i></div>
                    Translators
                </a>
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <div class="nav-link-icon"><i data-feather="list"></i></div>
                    Categories
                </a>

                <div class="sidenav-menu-heading">Posts</div>
                <!-- Sidenav Link (Charts)-->
                <a class="nav-link" href="{{ route('posts.index') }}">
                    <div class="nav-link-icon"><i data-feather="edit"></i></div>
                    Posts
                </a>
                <a class="nav-link" href="{{ route('medias.index') }}">
                    <div class="nav-link-icon"><i data-feather="edit"></i></div>
                    Medias
                </a>
                <div class="sidenav-menu-heading">Finance</div>
                <!-- Sidenav Link (Charts)-->
                <a class="nav-link" href="{{ route('orders.index') }}">
                    <div class="nav-link-icon"><i data-feather="shopping-cart"></i></div>
                    Orders
                </a>

                <div class="sidenav-menu-heading">Settings</div>
                <!-- Sidenav Link (Charts)-->
{{--                <a class="nav-link" href="">--}}
{{--                    <div class="nav-link-icon"><i data-feather="settings"></i></div>--}}
{{--                    Settings--}}
{{--                </a>--}}
                <a class="nav-link" href="{{ route('logout') }}">
                    <div class="nav-link-icon"><i data-feather="log-out"></i></div>
                    Logout
                </a>
            </div>
        </div>
    </nav>
</div>
