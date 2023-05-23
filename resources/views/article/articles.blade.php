@extends('layout.layout')

@section('content')
    <main class="news-articles">
        <div class="section-tab">
            <div class="wrapper content">
                <div class="tab-title">

                </div>
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
                                            <a href="{{ LaravelLocalization::localizeUrl('/article/' . $post['id']) }}">
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
                            <div class="item">
                                <div class="item_left">
                                    <div class="data section-media-info">
                                        <div class="choose-media-section">
                                            <h3>Ընտրել մեդիան</h3>
                                            <div class="media-scrol-bar scrollbar" id="style-4">

                                                <div class="scroll-bar-all scrol-bar-item">
                                                    <p>Բոլորը</p>
                                                </div>
                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/168-img.png" alt="">
                                                    </div>
                                                    <p>168.am</p>
                                                </div>

                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/1-aliq.png" alt="">
                                                    </div>
                                                    <p>1in.am</p>
                                                </div>

                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/1aliq-2.png" alt="">
                                                    </div>
                                                    <p>1tv.am</p>
                                                </div>

                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/24news.png" alt="">
                                                    </div>
                                                    <p>24news.am</p>
                                                </div>

                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/4news.png" alt="">
                                                    </div>
                                                    <p>4news.am</p>
                                                </div>

                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/1-aliq.png" alt="">
                                                    </div>
                                                    <p>1in.am</p>
                                                </div>

                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/1aliq-2.png" alt="">
                                                    </div>
                                                    <p>1tv.am</p>
                                                </div>

                                                <div class="scrol-bar-item">
                                                    <div class="scroll-bar-item-img">
                                                        <img src="assets/images/24news.png" alt="">
                                                    </div>
                                                    <p>24news.am</p>
                                                </div>
                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/168-img.png" alt="">
                                                    </div>
                                                    <p>168.am</p>
                                                </div>


                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/1-aliq.png" alt="">
                                                    </div>
                                                    <p>1in.am</p>
                                                </div>

                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/1aliq-2.png" alt="">
                                                    </div>
                                                    <p>1tv.am</p>
                                                </div>

                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/24news.png" alt="">
                                                    </div>
                                                    <p>24news.am</p>
                                                </div>

                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/4news.png" alt="">
                                                    </div>
                                                    <p>4news.am</p>
                                                </div>

                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/1-aliq.png" alt="">
                                                    </div>
                                                    <p>1in.am</p>
                                                </div>

                                                <div class="scrol-bar-item">
                                                    <div class="scrol-bar-item-img">
                                                        <img src="assets/images/1aliq-2.png" alt="">
                                                    </div>
                                                    <p>1tv.am</p>
                                                </div>

                                                <div class="scrol-bar-item">
                                                    <div class="scroll-bar-item-img">
                                                        <img src="assets/images/24news.png" alt="">
                                                    </div>
                                                    <p>24news.am</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-list-section">
                                            @foreach($posts as $post)
                                                <div class="media-list-item">
                                                    <div class="media-list-item-img">
                                                        <a href="{{ LaravelLocalization::localizeUrl('/article/' . $post['id']) }}">
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
