<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')"/>
    <link href="{{ asset("css/bootstrap/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{asset("css/style.css")}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.png')}}">

    <meta property="og:title" content="@yield('title','Title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:url" content="{{ url('/')  }}">
    <meta property="og:site_name" content="@yield('title','Title')">
    <meta name="twitter:description" content="@yield('description')">
    <meta name="twitter:title" content="@yield('title','Title')">

    <meta property="og:image" content="{{ asset('favicon.png')}}">
    <meta name="twitter:image" content="{{ asset('favicon.png')}}">
    <meta name="twitter:card" content="summary_large_image">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            @if ($errors->any() && !\Request::is('stripe'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{{ session('success') }}</li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@yield("content")
<!-- JQUERY -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</body>
</html>
