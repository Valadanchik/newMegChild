<div class="search-section ">

    <div class="popup-search-input content">
        <div class="close-popup-img">
            <img src="{{ URL::to('/images/svg/close-popup.svg') }}" alt="close">
        </div>

        <form class="search-box">
            <button style="background: none; border: none; padding: 0"><span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                             <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                   stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                             <path d="M20.9984 21L16.6484 16.65" stroke="black" stroke-width="2" stroke-linecap="round"
                                   stroke-linejoin="round"/>
                              </svg>
                        </span>
            </button>
            <input type="search" name="search" placeholder="Որոնել" id="search-input" value="">
            <input type="hidden" name="search" id="search-route-name" value="{{ route("books.search") }}">
        </form>

        <div id="booksContainer"></div>

    </div>



</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $('#search-input').on('keyup', function(event) {
        $.ajax({
            url: $('#search-route-name').val(),
            type: 'POST',
            dataType: 'json',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({ _token: $('meta[name="csrf-token"]').attr('content'), search: event.target.value }),
            success: function(data) {

                console.log(data);

            },
            error: function(xhr, textStatus, errorThrown) {
                console.error(errorThrown);
            },
            complete: function() {
                // $('.loader-container').hide();
            }
        });
    });
</script>
