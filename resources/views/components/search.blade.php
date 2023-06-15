<div class="search-section ">

    <div class="popup-search-input">
        <div class="content">
            <div class="close-popup-img ">
                <img src="{{ URL::to('/images/svg/close-popup.svg') }}" alt="close">
            </div>
        </div>
        <div>
            <form class="search-box">
                <button style="background: none; border: none; padding: 0">
                    <span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20.9984 21L16.6484 16.65" stroke="black" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>
                <input type="search" name="search" placeholder="Որոնել" id="search-input" value="">
                <input type="hidden" id="search-route-name" value="{{ route("books.search") }}">
                <input type="hidden" id="book-url" value="{{ LaravelLocalization::localizeUrl('/book/') }}">
                <input type="hidden" id="book-image-url" value="{{ URL::to('storage/') }}">
                <input type="hidden" id="locale" value="{{ app()->getLocale() }}">
                <input type="hidden" id="book-item-logo" value="{{ URL::to('images/reade-more-img-logo-green.png') }}">
                <input type="hidden" id="book-not-found-image" value="{{ URL::to('images/crying-girl.png') }}">
                <input type="hidden" id="search_error_result" value="{{ __('messages.search_error_result') }}">
            </form>
            <div id="booksContainer"  ></div>
{{--            <div id="searchNotFound" ></div>--}}
        </div>
    </div>
</div>
