<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/media.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="body">

@include('layout.header')

@yield('content')

@include('layout.footer')

<script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>
