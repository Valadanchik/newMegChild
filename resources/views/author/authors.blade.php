@extends('layout.layout')
@section('title', 'authors')
@section('content')
    <main class="news-articles">
        <section class="authors-page">
            <div class="authors-section content">
                <div class="{{"authors-section-title-".app()->getLocale()}}">
                    <h1>{{ __('messages.authors') }}</h1>
                </div>
                <div class="authors-boxes">
                    @foreach($authors as $author)
                        <div>
                            <a href="{{ LaravelLocalization::localizeUrl('/author/' . $author['slug']) }}">
                                <img src="{{ URL::to('storage/' . $author['image']) }}" alt="">
                            </a>
                            <span> {{ $author['name_' . app()->getLocale()] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
