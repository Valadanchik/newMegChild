@extends('layout.layout')

@section('content')
    <main class="news-articles">
        <section class="authors-page">
            <div class="authors-section content">
                <div class="authors-section-title">
                    <h2>Հեղինակներ</h2>
                </div>
                <div class="authors-boxes">
                    @foreach($translators as $translator)
                        <div>
                            <div>
                                <img src="{{ URL::to('storage/' . $translator['image']) }}" alt="">
                            </div>
                            <span> {{ $translator['name_' . app()->getLocale()] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
