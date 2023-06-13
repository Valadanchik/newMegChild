@extends('layout.layout')
@section('title', 'contact-us')
@section('content')
<main class="news-articles">
    <section class="contacts-page content">
        <h2>{{ __('contact.feedback') }}</h2>
        <div class="contacts-page-info">
            <div class="contacts-page-info-decsription">
                <p> <span>{{ __('contact.dream') }}</span> {{ __('contact.dream_description') }}</p>
            </div>
            <div class="new-book-or-translation-desc">
                <h3>{{ __('contact.new_book_or_translate') }}</h3>
                <p>{!! __('contact.new_book_or_translate_text') !!}
                </p>
                <ol>
                    <li>{{ __('contact.your_offer_book_name') }}</li>
                    <li>{{ __('contact.about_books') }}</li>
                </ol>
            </div>
            <div class="contact-page-sale-desc">
                <h3>{{ __('contact.sale') }}</h3>
                <p>{!! __('contact.sale_text') !!}</p>
            </div>

            <div class="contact-page-work-desc">
                <h3>{{ __('contact.work') }}</h3>
                <p>{!! __('contact.work_text') !!}</p>
            </div>

            <div class="contact-page-partnership-desc">
                <h3>{{ __('contact.partnership') }}</h3>
                <p>
                    {!! __('contact.partnership_text') !!}
                </p>
            </div>

            <div class="contact-page-sponsorship-desc">
                <h3>{{ __('contact.sponsorship') }}</h3>
                <p>
                    {!! __('contact.sponsorship_text') !!}
                </p>
            </div>
        </div>
    </section>
</main>
@endsection
