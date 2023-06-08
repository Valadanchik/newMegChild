@extends('layout.layout')
@section('title', $post['title_' . app()->getLocale()])
@section('content')
    <main class="news-articles">
        <section class="article-itm-page-banner content">
            <div class="article-item-page-back-btn">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 13L1 7L7 1" stroke="#6D6E72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <a href="{{ LaravelLocalization::localizeUrl('/articles/') }}">Հոդվածներ</a>
            </div>

            <div class="article-itm-page-banner-info">
                <div class="article-itm-page-banner-info-desc">
                    <div class="article-itm-page-banner-desc-title-and-data">
                        <h2>{{ $post['title_' . app()->getLocale()] }}</h2>
                        <p>{{ $post['created_at'] }}</p>
                    </div>

                    <div class="article-itm-page-banner-desc-icon">
                        <span>Տարածել:</span>
                        @include('components.social')
                    </div>
                </div>
                <div class="article-itm-page-banner-info-img">
                     <img src="{{ URL::to('storage/' . $post['image']) }}" alt="">
                </div>
            </div>
        </section>
        <br>
        <section class="article-itm-page-info-and-video content">
            <div class="article-info-and-video-description">
                <div class="article-info-and-video-desc-article">
                    <svg width="6" height="92" viewBox="0 0 6 92" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 6C0 2.68629 2.68629 0 6 0V92C2.68629 92 0 89.3137 0 86V6Z" fill="#8F52A1"/>
                    </svg>
                    <span>{!! $post['description_' . app()->getLocale()] !!}</span>
                </div>
                {!! $post['text_' . app()->getLocale()] !!}
            </div>
        </section>
        <br><br>
        <section class="articles">
            <div class="article-section content">
                <div class="other-article-section-title">
                    <h2>Այլ հոդվածներ</h2>
                </div>

                <div class="article-boxes">
                    @foreach($otherPosts as $otherPost)
                        <div class="article-box-item">
                            <div class="article-box-item-img">
                                <a href="{{ LaravelLocalization::localizeUrl('/article/' . $otherPost['slug']) }}">
                                    <img src="{{ URL::to('storage/' . $post['image']) }}" alt="">
                                </a>
                            </div>
                            <div class="article-box-item-desc">
                                <p>{{ $otherPost['title_' . app()->getLocale()] }}</p>
                                <span>{{ $otherPost['created_at'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="article-btn">
                    <a href="{{ LaravelLocalization::localizeUrl('/articles') }}"> Տեսնել բոլորը
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 17L18 12L13 7" stroke="black" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M6 17L11 12L6 7" stroke="black" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection
