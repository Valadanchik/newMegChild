@extends('layout.layout')
@section('title', 'posts')
@section('content')
    <main class="news-articles">
        <div class="wrapper content">
            <div class="tabs_wrap">
                <ul>
                    <li data-tabs="article" class="article-li">
                        <a href="{{ LaravelLocalization::localizeUrl('/articles') }}">{{ __('messages.articles') }}</a>
                    </li>
                    <li data-tabs="media">
                        <a href="{{ LaravelLocalization::localizeUrl('/media-articles') }}">{{ __('messages.media') }}</a>
                    </li>
                </ul>
            </div>
            <div class="tab-items-article">
                <div class="articles-list">
                    @foreach($posts as $post)
                        <a href="{{ LaravelLocalization::localizeUrl('/article/' . $post['slug']) }}">
                            <div class="articles-list-item">
                                <div class="articles-list-item-img">
                                    <img src="{{ URL::to('storage/' . $post['image']) }}" alt="">
                                </div>
                                <p>{{ $post['title_' . app()->getLocale()] }}</p>
                                <span>{{ $post['created_at'] }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
