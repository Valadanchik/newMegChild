@extends('layout.layout')
@section('title', 'media')
@section('content')
    <main class="news-articles">
        <div class="wrapper content">
            <div class="tabs_wrap">
                <ul>
                    <li data-tabs="article">
                        <a href="{{ LaravelLocalization::localizeUrl('/articles') }}">Հոդվածներ</a>
                    </li>
                    <li data-tabs="media" class="media-li">
                        <a href="{{ LaravelLocalization::localizeUrl('/media-articles') }}">Մեդիա</a>
                    </li>
                </ul>
            </div>
            <div class="tab-items-article">
                <div class="item">
                    <div class="item_left">
                        <div class="data section-media-info">
                            <div class="choose-media-section">
                                <h3>Ընտրել մեդիան</h3>
                                <div class="media-scrol-bar scrollbar" id="style-4">
                                    <div class="scroll-bar-all scrol-bar-item">
                                        <p><a href="{{ LaravelLocalization::localizeUrl('/media-articles') }}">Բոլորը</a></p>
                                    </div>
                                    @foreach($postCategories as $postCategory)
                                        <div class="scrol-bar-item">
                                            <div class="scrol-bar-item-img">
                                                <img src="{{ URL::to($postCategory['image']) }}" alt="">
                                            </div>
                                            <a href="{{ LaravelLocalization::localizeUrl('/medias/' . $postCategory['slug']) }}">
                                                <p>{{ $postCategory['title_' . app()->getLocale()] }}</p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="media-list-section">
                                @foreach($mediaPosts as $post)
                                    <div class="media-list-item">
                                        <div class="media-list-item-img">
                                            <a href="{{ LaravelLocalization::localizeUrl('/article/' . $post['slug']) }}">
                                                <img src="{{ URL::to('storage/' . $post['image']) }}" alt="">
                                            </a>
                                        </div>
                                        <p>{{ $post['title_' . app()->getLocale()] }}</p>
                                        <span>{{ $post['created_at'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
