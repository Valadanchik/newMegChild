@extends('layout.layout')

@section('content')
    <main>
        <section class="banner">
            <div class="banner-info content">
                @foreach($data['categories'] as $category)
                    <div class="banner-img">
                        <a href="{{ LaravelLocalization::localizeUrl('/category/' . $category['name_en']) }}">
                            <img src="{{ URL::to('/images/' . $category['name_en'] . '.png') }}" alt="logo filter">
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        @foreach($data['books'] as $index => $book)
            <section class="{{ $book->category->name_en }}-color">
                <div style="{{ $index % 2 === 1 ? "flex-direction: row-reverse;" : "flex-direction: row;" }}"
                     class="book-section content">
                    <div class="color-info ">
                        <div class="orange-info-img">
                            <a href="{{ LaravelLocalization::localizeUrl('/book/' . $book['slug']) }}">
                                <img src="{{ URL::to('storage/' . $book['main_image']) }}" alt="image book">
                            </a>
                        </div>
                    </div>
                    <div class="color-info-description">
                        <h2>{{ $book['title_' . app()->getLocale()]  }}</h2>
                        <p class="color-info-description-after">Հեղինակ`
                            @foreach($book->authors as $key => $author)
                                {{ $author['name_' . app()->getLocale()] }} {{ $key < count($book->authors) - 1 ? ',' : '' }}
                            @endforeach
                        </p>
                        <p class="color-info-description-translate">Հայերեն թարգմանություն`
                            @foreach($book->translators as $key => $translator)
                                {{ $translator['name_' . app()->getLocale()] }} {{ $key < count($book->translators) - 1 ? ',' : '' }}
                            @endforeach
                        </p>
                        <div class="color-info-description-param">
                            <div class="description-param-group">
                                <p>Խումբ</p>
                                <div class="description-param-group-img">
                                    <a href="#"> <img src="{{ URL::to('/images/white-category.png') }}" alt=""></a>
                                </div>
                            </div>
                            <div class="color-info-description-age">
                                <p>Տարիք</p>
                                <span>{{ $book->category->age }}</span>
                            </div>
                            <div class="color-info-description-word-count">
                                <p>Բառաքանակ</p>
                                <span>{{ $book['word_count'] }}</span>
                            </div>
                            <div class="color-info-description-font-size">
                                <p>Տառաչափ</p>
                                <span>{{ $book['font_size']  }}</span>
                            </div>
                        </div>
                        <div class="color-info-description-btn">
                            <a href="{{ LaravelLocalization::localizeUrl('/book/' . $book['slug']) }}">Իմանալ ավելին</a>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach

        @if(count($data['posts']))
            <section class="articles">
                <div class="article-section content">
                    <div class="article-section-title">
                        <h2>Հոդվածներ</h2>
                    </div>

                    <div class="article-boxes">
                        @foreach($data['posts'] as $post)
                            <div class="article-box-item">
                                <div class="article-box-item-img">
                                    <a href="#">
                                        <img src="{{ URL::to('storage/' . $post['image']) }}" alt="">
                                    </a>
                                </div>
                                <div class="article-box-item-desc">
                                    <h3>{{ $post['title_' . app()->getLocale()] }}</h3>
                                    <span>{{ $post['created_at'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="article-btn">
                        <a href="{{ LaravelLocalization::localizeUrl('/articles/') }}"> Տեսնել բոլորը
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 17L18 12L13 7" stroke="black" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M6 17L11 12L6 7" stroke="black" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        @if($data['lastParentBook'])
            <section class="parent">
                <div class="parent-section content">
                    <div class="parent-section-img">
                        <a href="#">
                            <img src="{{ URL::to('storage/' . $data['lastParentBook']['main_image']) }}" alt="">
                        </a>
                    </div>
                    <div class="color-info-description">
                        <h2>{{ $data['lastParentBook']['title_' . app()->getLocale()]  }}</h2>
                        <p class="color-info-description-after">Հեղինակ`
                            @foreach($book->authors as $key => $author)
                                {{ $author['name_' . app()->getLocale()] }} {{ $key < count($book->authors) - 1 ? ',' : '' }}
                            @endforeach
                        </p>
                        <p class="color-info-description-translate">Հայերեն թարգմանություն`
                            @foreach($book->translators as $key => $translator)
                                {{ $translator['name_' . app()->getLocale()] }} {{ $key < count($book->translators) - 1 ? ',' : '' }}
                            @endforeach
                        </p>
                        <div class="color-info-description-param">
                            <div class="description-param-group">
                                <p>Խումբ</p>
                                <div class="description-param-group-img">
                                    <img src="{{ URL::to('/images/white-category.png') }}" alt="">
                                </div>
                            </div>
                            <div class="color-info-description-age">
                                <p>Տարիք</p>
                                <span>{{ $data['lastParentBook']->category->age }}</span>
                            </div>
                            <div class="color-info-description-word-count">
                                <p>Բառաքանակ</p>
                                <span>{{ $data['lastParentBook']['word_count'] }}</span>
                            </div>
                            <div class="color-info-description-font-size">
                                <p>Տառաչափ</p>
                                <span>{{ $data['lastParentBook']['font_size']  }}</span>
                            </div>
                        </div>
                        <div class="color-info-description-btn">
                            <a href="{{ LaravelLocalization::localizeUrl('/book/' . $book['slug']) }}">Իմանալ ավելին</a>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if(count($data['authors']))
            <section class="authors">
                <div class="authors-section content">
                    <div class="authors-section-title">
                        <h2>Հեղինակներ</h2>
                    </div>
                    <div class="authors-boxes">
                        @foreach($data['authors'] as $author)
                            <div>
                                <div class="authors-boxes-img">
                                    <a href="#">
                                        <img src="{{ URL::to('storage/'. $author['image']) }}" alt="Jeff Qinni">
                                    </a>
                                </div>
                                <span>{{ $author['name_' . app()->getLocale()] }} </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="article-btn">
                        <a href="{{ LaravelLocalization::localizeUrl('/authors') }}">Տեսնել բոլորը</a>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 17L18 12L13 7" stroke="black" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M6 17L11 12L6 7" stroke="black" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
