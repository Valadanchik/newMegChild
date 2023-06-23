/*/////////SLIDER//////////////*/
$(document).ready(function () {
    $('.single-item').slick({
        dots: true,
        prevArrow: ('<svg class="slick-prev" width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
            '<path d="M7 13L1 7L7 1" stroke="#8F52A1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>\n' +
            '</svg>'),
        nextArrow: ('<svg class="slick-next" width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
            '<path d="M1 13L7 7L1 1" stroke="#8F52A1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>\n' +
            '</svg>'),
    });


    $('#useCoupon').on('click', function (event) {

        $('.loader-container').css('display', 'flex');
        let couponName = $('#couponName').val();
        let url = $('#couponRouterName').val();
        let totalPriceElement = document.querySelector('.total-price');
        let totalPriceToPayElement = document.querySelector('.total-price-to-pay');


        console.log(url + couponName);

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    coupon: couponName
                }),
                success: function (data) {
                    console.log(data);

                    totalPriceElement.innerHTML = data.total_price;
                    totalPriceToPayElement.innerHTML = data.total_price;
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error(errorThrown);
                },
                complete: function () {
                    $('.loader-container').hide();
                }
            });
    });




/*/////////SLIDER//////////////*/

/*SEARCH FUNCTIONALITY*/
    $('#search-input').on('keyup', function (event) {
        if (event.target.value.length > 2) {
            $('.loader-container').show();

            $.ajax({
                url: $('#search-route-name').val(),
                type: 'POST',
                dataType: 'json',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    search: event.target.value
                }),
                success: function (data) {
                    htmlFilter(data);
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error(errorThrown);
                },
                complete: function () {
                    $('.loader-container').hide();
                }
            });
        } else if(event.target.value.length <= 2){
            $("#booksContainer").html('');
        }
    });



});

function htmlFilter(books) {
    let bookUrl = $("#book-url").val();
    let bookImageUrl = $("#book-image-url").val();
    let locale = $("#locale").val();
    let bookItemLogo = $("#book-item-logo").val();
    let booksInfoItem = ''
    let bookNotFoundImage = $("#book-not-found-image").val();
    let search_error_result = $("#search_error_result").val();

    if (books.length === 0) {
         booksInfoItem = $('<div class="search-not-found-section"></div>');
        let searchNotFound = ''
        searchNotFound +=
            `<div class="search-not-found-info">
               <div class="search-not-found-img">
                <img width="270px" src="${bookNotFoundImage}" alt="">
               </div>
               <p>${search_error_result}</p>
             </div>`
        booksInfoItem.append(searchNotFound);
    } else {
        booksInfoItem = $('<div class="books-info-item-search ov-auto p-68"></div>');
        books.forEach((book, index) => {

            let searchData = '';
            searchData +=
                `<div class="book-item d-block">
                <div class="book-item-images">
                    <div class="book-item-img-logo">
                        <img src="${bookItemLogo}" alt="">
                    </div>
                    <div class="book-item-img-book">
                        <a href="${bookUrl + '/' + book.slug}">
                            <img width="270px" src="${bookImageUrl + '/' + book.main_image}" alt="">
                        </a>
                    </div>
                </div>
                <h3>
                    ${book['title_' + locale]}
                </h3>
                <p>
                    ${book.authors.map((author) => author['name_' + locale])}
                </p>
                <div class="book-price">
                    <p class="book-pr">${book.price} ֏</p>
                </div>
                <div class="book-btn">
                    <a href="${bookUrl + '/' + book.slug}">
                        Գնել
                    </a>
                </div>
            </div>`;

            booksInfoItem.append(searchData);
        })
    }
    $("#booksContainer").html(booksInfoItem);
    inputVal = ''
}

/*SEARCH FUNCTIONALITY*/
