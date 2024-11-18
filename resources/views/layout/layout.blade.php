<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="keywords" content="{{ __('layout.og_keywords') }} ">
    <meta name="description" content="{{ __('layout.og_description') }}">
    <meta name="viewport" content="width=device-width">

    <meta property="og:local" content="en_En">
    <meta property="og:type" content="{{ __('layout.article') }}">
    <meta property="og:title" content="Newmage Երազ">
    <meta property="og:description" content="{{ __('layout.og_description') }}">
    <meta property="og:image" content="{{ URL::to('images/newmag-meta-img.png') }}">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="newmage Երազ">
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="Newmage Երազ"/>
    <meta name="twitter:title" content="Newmage Երազ">
    <meta name="twitter:description" content="{{ __('layout.og_description') }}"/>
    <meta name="twitter:image:src" content="{{ URL::to('images/newmag-meta-img.png') }}"/>
    <meta name="twitter:domain" content=""/>

    <title>@yield('title','newmag Երազ')</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::to('images/svg/favicon.svg') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css"
          integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css"
          integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="{{ asset('/css/app.css?v=1.3') }}">
    <link rel="stylesheet" href="{{ asset('/css/media.css?v=1.2') }}">
    <style>
        header {
            top: 50px !important
        }

        .header-mobile {
            top: 50px !important
        }

        .main-content {
            padding-top: 116px !important
        }

        .festival_top {
            position: fixed;
            z-index: 95000;
            background-color: black;
            width: 100%;
            left: 0;
            top: 0;
            right: 0;
            height: 50px;
            -webkit-transition: .3s;
            -o-transition: .3s;
            transition: .3s
        }

        .black_friday_top {
            background: #000;
            border-bottom: 3px solid #fff
        }

        .festival_title a {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            z-index: 15
        }

        .festival_top:hover {
            background-color: #e3caca;
            color: #000
        }

        .festival_top:hover .marquee .first span {
            -webkit-text-stroke: 2px #000
        }

        .festival_top {
            width: 100%;
            font-weight: 900;
            color: #fff
        }

        .nav__bg-wrapper {
            position: absolute;
            left: 0;
            top: 38px;
            visibility: hidden;
            opacity: 0;
            -webkit-transition: 0s;
            -o-transition: 0s;
            transition: 0s;
            will-change: opacity
        }

        .nav__bg-wrapper.is-visible {
            visibility: visible;
            opacity: 1
        }

        .nav__bg {
            width: 200px;
            height: 138px;
            background: #000;
            -webkit-transform-origin: left top;
            -ms-transform-origin: left top;
            transform-origin: left top;
            will-change: transform;
            padding: 10px
        }

        .nav__bg.is-animatable {
            -webkit-transition: .3s;
            -o-transition: .3s;
            transition: .3s
        }

        .nav__bg img {
            width: 100%;
            max-width: 100%;
            height: auto
        }

        .hover-reveal {
            position: fixed;
            width: 200px;
            height: 150px;
            top: 0;
            left: 0;
            pointer-events: none;
            opacity: 0;
            z-index: 20000;
            background: #000;
        }

        .hover-reveal__inner, .hover-reveal__img {
            width: 96%;
            height: 100%;
            position: relative;
            z-index: 1000;
            padding-left: 4px;
        }

        .hover-reveal__deco {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-color: #181314
        }

        .hover-reveal__img {
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            /*padding: 10px;*/
            background-origin: content-box
        }

        @-webkit-keyframes marqueeOne {
            0% {
                -webkit-transform: translate3d(var(--move-initial), 0, 0);
                transform: translate3d(var(--move-initial), 0, 0)
            }
            100% {
                -webkit-transform: translate3d(var(--move-final), 0, 0);
                transform: translate3d(var(--move-final), 0, 0)
            }
        }

        @keyframes marqueeOne {
            0% {
                -webkit-transform: translate3d(var(--move-initial), 0, 0);
                transform: translate3d(var(--move-initial), 0, 0)
            }
            100% {
                -webkit-transform: translate3d(var(--move-final), 0, 0);
                transform: translate3d(var(--move-final), 0, 0)
            }
        }

        @-webkit-keyframes marqueeTwo {
            0% {
                -webkit-transform: translate3d(var(--move-final), 0, 0);
                transform: translate3d(var(--move-final), 0, 0)
            }
            100% {
                -webkit-transform: translate3d(var(--move-initial), 0, 0);
                transform: translate3d(var(--move-initial), 0, 0)
            }
        }

        @keyframes marqueeTwo {
            0% {
                -webkit-transform: translate3d(var(--move-final), 0, 0);
                transform: translate3d(var(--move-final), 0, 0)
            }
            100% {
                -webkit-transform: translate3d(var(--move-initial), 0, 0);
                transform: translate3d(var(--move-initial), 0, 0)
            }
        }

        .festival_top .container {
            width: 100%;
            height: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            place-items: center;
            max-width: 100%;
            padding-left: 0;
            padding-right: 0
        }

        .festival_top .marquee {
            position: relative;
            overflow: hidden;
            width: 100%;
            --offset: 20vw;
            --move-initial: calc(-25% + var(--offset));
            /* --move-final: calc(-50% + var(--offset)); */
        }

        .festival_top .marquee__inner {
            width: -webkit-fit-content;
            width: -moz-fit-content;
            width: fit-content;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            position: relative;
            white-space: nowrap;
        }

        .festival_top .marquee__inner span {
            font-size: 24px;
            padding: 0 2vw;
            text-transform: uppercase
        }

        .festival_top .marquee .first {
            -webkit-transform: translate3d(var(--move-initial), 0, 0);
            transform: translate3d(var(--move-initial), 0, 0);
            -webkit-animation: marqueeOne 10s linear alternate-reverse infinite;
            animation: marqueeOne 10s linear alternate-reverse infinite
        }

        .festival_top .marquee .first span {
            -webkit-text-stroke: 1px #fff;
            -webkit-text-fill-color: transparent;
            -webkit-transition: .3s;
            -o-transition: .3s;
            transition: .3s
        }

        @media (min-width: 1024px) {
            .festival_top .marquee .first span {
                -webkit-text-stroke: 1px #fff
            }
        }

        .festival_top .marquee .second {
            -webkit-transform: translate3d(var(--move-initial), 0, 0);
            transform: translate3d(var(--move-initial), 0, 0);
            -webkit-animation: marqueeTwo 10s linear alternate-reverse infinite;
            animation: marqueeTwo 10s linear alternate-reverse infinite
        }

        @media all and (max-width: 1050px) {
            .main-content {
                padding-top: 95px !important
            }
        }

        @media all and (max-width: 768px) {
            .main-content {
                margin-top: 94px !important;
                padding-top: 0 !important
            }
        }
    </style>

</head>
<body class="body filter-body">
<div class="festival_top" data-img="">
    <div class="container">
        <div class="marquee">
            <div class="marquee__inner second">
                <?php
                for($i = 0; $i < 10; $i++) {
                    echo '<span>BLACK FRIDAY -50%</span>';
                }
                ?>
            </div>
        </div>
        <div class="nav__bg-wrapper">
            <div class="grid-sizer"></div>
        </div>
    </div>
</div>
@include('layout.header')

@yield('content')

@include('layout.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('/js/main-jquery.js?v=1.0') }}"></script>
<script src="{{ asset('/js/main.js?v=1.1') }}"></script>
<script>
    const mapNumber = (X, A, B, C, D) => (X - A) * (D - C) / (B - A) + C;
    const getMousePos = (e) => {
        let posx = 0;
        let posy = 0;
        if (!e) e = window.event;
        if (e.pageX || e.pageY) {
            posx = e.pageX;
            posy = e.pageY;
        } else if (e.clientX || e.clientY) {
            posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
        }
        return {x: posx, y: posy}
    }
    const getRandomFloat = (min, max) => (Math.random() * (max - min) + min).toFixed(2);

    class HoverImgFx1 {
        constructor(el) {
            this.DOM = {el: el};
            this.DOM.reveal = document.createElement('div');
            this.DOM.reveal.className = 'hover-reveal';
            this.DOM.reveal.innerHTML = `<div class="hover-reveal__inner"><div class="hover-reveal__img" style="background-image:url(${this.DOM.el.dataset.img})"></div></div>`;
            this.DOM.el.appendChild(this.DOM.reveal);
            this.DOM.revealInner = this.DOM.reveal.querySelector('.hover-reveal__inner');
            this.DOM.revealInner.style.overflow = 'hidden';
            this.DOM.revealImg = this.DOM.revealInner.querySelector('.hover-reveal__img');
            this.initEvents();
        }

        initEvents() {
            this.positionElement = (ev) => {
                const mousePos = getMousePos(ev);
                const docScrolls = {
                    left: document.body.scrollLeft + document.documentElement.scrollLeft,
                    top: document.body.scrollTop + document.documentElement.scrollTop
                };
                this.DOM.reveal.style.top = `${mousePos.y + 20 - docScrolls.top}px`;
                this.DOM.reveal.style.left = `${mousePos.x + 20 - docScrolls.left}px`;
            };
            this.mouseenterFn = (ev) => {
                this.positionElement(ev);
                this.showImage();
            };
            this.mousemoveFn = ev => requestAnimationFrame(() => {
                this.positionElement(ev);
            });
            this.mouseleaveFn = () => {
                this.hideImage();
            };
            this.DOM.el.addEventListener('mouseenter', this.mouseenterFn);
            this.DOM.el.addEventListener('mousemove', this.mousemoveFn);
            this.DOM.el.addEventListener('mouseleave', this.mouseleaveFn);
        }

        showImage() {
            TweenMax.killTweensOf(this.DOM.revealInner);
            TweenMax.killTweensOf(this.DOM.revealImg);
            this.tl = new TimelineMax({
                onStart: () => {
                    this.DOM.reveal.style.opacity = 1;
                    TweenMax.set(this.DOM.el, {zIndex: 95000});
                }
            }).add('begin').add(new TweenMax(this.DOM.revealInner, 0.2, {
                ease: Sine.easeOut,
                startAt: {x: '-100%'},
                x: '0%'
            }), 'begin').add(new TweenMax(this.DOM.revealImg, 0.2, {
                ease: Sine.easeOut,
                startAt: {x: '100%'},
                x: '0%'
            }), 'begin');
        }

        hideImage() {
            TweenMax.killTweensOf(this.DOM.revealInner);
            TweenMax.killTweensOf(this.DOM.revealImg);
            this.tl = new TimelineMax({
                onStart: () => {
                    TweenMax.set(this.DOM.el, {zIndex: 999});
                }, onComplete: () => {
                    TweenMax.set(this.DOM.el, {zIndex: ''});
                    TweenMax.set(this.DOM.reveal, {opacity: 0});
                }
            }).add('begin').add(new TweenMax(this.DOM.revealInner, 0.2, {
                ease: Sine.easeOut,
                x: '100%'
            }), 'begin').add(new TweenMax(this.DOM.revealImg, 0.2, {ease: Sine.easeOut, x: '-100%'}), 'begin');
        }
    }

    [...document.querySelectorAll('.festival_top')].forEach(link => new HoverImgFx1(link));

</script>
</body>
</html>
