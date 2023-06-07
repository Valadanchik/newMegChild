@extends('layout.layout')

@section('content')
    <main class="news-articles">
        <section class="authors-page">
            <div class="authors-section content">
                <div class="translators-section-title">
                    <h2>Թարգմանիչներ</h2>
                </div>
                <div class="authors-boxes">
                    @foreach($translators as $translator)
                        <div>
                            <div>
                                <a href="{{ LaravelLocalization::localizeUrl('/translator/' . $translator['slug']) }}">
                                    <img src="{{ URL::to('storage/' . $translator['image']) }}" alt="">
                                </a>
                            </div>
                            <span> {{ $translator['name_' . app()->getLocale()] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
