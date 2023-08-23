@extends('layout.layout')
@section('title', 'translators')
@section('content')
    <main class="news-articles">
        <section class="authors-page">
            <div class="authors-section content">
                <div class="{{"translators-section-title-".app()->getLocale()}}">
                    <h1>{{ __('messages.translators') }}</h1>
                </div>
                <div class="authors-boxes">
                    @foreach($translators as $translator)
                        <div>
                            <a href="{{ LaravelLocalization::localizeUrl('/translator/' . $translator['slug']) }}">
                                <img src="{{ URL::to('storage/' . $translator['image']) }}" alt="">
                            </a>
                            <span> {{ $translator['name_' . app()->getLocale()] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
