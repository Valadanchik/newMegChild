@extends('layout.layout')

@section('content')
    <main class="news-articles">
        <div class="section-tab">
            <div class="wrapper content">
                <div class="tabs_wrap">
                    <ul>
                        <li data-tabs="article" class="article-li">Հոդվածներ</li>
                        <li data-tabs="media" class="media-li">Մեդիա</li>
                    </ul>

                </div>
                <div class="article-tab">
                    <div class="tab-items-article">
                        <div class="item_wrap articles-wrapper open">
                            <div class="articles-list">
                                @foreach($posts as $post)
                                    <div class="articles-list-item">
                                        <div class="articles-list-item-img">
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

                        <div class="item_wrap media-wrapper">


                            <div class="media-title">
                                <div class="filter-media-title">
                                    <h1>Մեդիա</h1>
                                </div>
                                <div class="media-filter-icon">
                                    <div class="filter-img">
                                        <img src="{{ URL::to('images/svg/mi_filter.svg') }}" alt="">
                                    </div>
                                    <h3>Ֆիլտրել</h3>
                                </div>

                            </div>
                            <div class="item">
                                <div class="item_left">
                                    <div class="data section-media-info">
                                        <div class="choose-media-section">
                                            <h3>Ընտրել մեդիան</h3>
                                            <div class="media-scrol-bar scrollbar" id="style-4">
                                                <div class="scroll-bar-all scrol-bar-item">
                                                    <p>Բոլորը</p>
                                                </div>
                                                @foreach($postCategories as $postCategory)
                                                    <div class="scrol-bar-item">
                                                        <div class="scrol-bar-item-img">
                                                            <img src="{{ URL::to($postCategory['image']) }}" alt="">
                                                        </div>
                                                        <a href="{{ LaravelLocalization::localizeUrl('/media/' . $postCategory['id']) }}">
                                                            <p>{{ $postCategory['title_' . app()->getLocale()] }}</p>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="media-list-section">
                                            @foreach($posts as $post)
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
                </div>
            </div>
        </div>
    </main>
@endsection
