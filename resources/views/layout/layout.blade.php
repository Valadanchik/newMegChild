<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">


    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <meta name="keywords" content="newmage, երազ, գիրք, հրատարակչություն, մատենաշարը">
    <meta name="description" content="Newmag հրատարակչությունը և «Սոմնիում» ընկերությունների խմբի «Երազ Փրոջեքթսը» համատեղ նախաձեռնել են «Երազ» մատենաշարը:">
    <meta name="viewport" content="width=device-width">

    <meta property="og:local" content="en_En">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Newmage Երազ">
    <meta property="og:description" content="Newmag հրատարակչությունը և «Սոմնիում» ընկերությունների խմբի «Երազ Փրոջեքթսը» համատեղ նախաձեռնել են «Երազ» մատենաշարը։">
    <meta property="og:image" content="{{ URL::to('images/newmag-meta-img.png') }}">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="newmage Երազ">

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="Newmage Երազ"/>
    <meta name="twitter:title" content="Newmage Երազ">
    <meta name="twitter:description" content="Newmag հրատարակչությունը և «Սոմնիում» ընկերությունների խմբի «Երազ Փրոջեքթսը» համատեղ նախաձեռնել են «Երազ» մատենաշարը։"/>
    <meta name="twitter:image:src" content="{{ URL::to('images/newmag-meta-img.png') }}"/>
    <meta name="twitter:domain" content=""/>

    <title>newmag Երազ</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::to('images/svg/favicon.svg') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/media.css') }}">

</head>
<body class="body">

@include('layout.header')

@yield('content')

@include('layout.footer')

<script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>
