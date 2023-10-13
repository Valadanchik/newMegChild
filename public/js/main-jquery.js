/*/////////SLIDER//////////////*/
$(document).ready(function () {
    $('.single-item').slick({
        dots: false,
        prevArrow: ('<svg  class="slick-prev"  viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
            '<g clip-path="url(#clip0_720_14)">\n' +
            '<g filter="url(#filter0_b_720_14)">\n' +
            '<path d="M0 18C0 8.05887 8.05887 0 18 0C27.9411 0 36 8.05887 36 18C36 27.9411 27.9411 36 18 36C8.05887 36 0 27.9411 0 18Z" fill="white" fill-opacity="0.4"/>\n' +
            '</g>\n' +
            '<path d="M21 24L15 18L21 12" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>\n' +
            '</g>\n' +
            '<defs>\n' +
            '<filter id="filter0_b_720_14" x="-5.91667" y="-5.91667" width="47.8333" height="47.8333" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">\n' +
            '<feFlood flood-opacity="0" result="BackgroundImageFix"/>\n' +
            '<feGaussianBlur in="BackgroundImageFix" stdDeviation="2.95833"/>\n' +
            '<feComposite in2="SourceAlpha" operator="in" result="effect1_backgroundBlur_720_14"/>\n' +
            '<feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_720_14" result="shape"/>\n' +
            '</filter>\n' +
            '<clipPath id="clip0_720_14">\n' +
            '<rect width="36" height="36" fill="white" transform="matrix(0 -1 -1 0 36 36)"/>\n' +
            '</clipPath>\n' +
            '</defs>\n' +
            '</svg>\n'),
        nextArrow: ( '<svg  class="slick-next"  viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
            '<g clip-path="url(#clip0_720_9)">\n' +
            '<g filter="url(#filter0_b_720_9)">\n' +
            '<path d="M36 18C36 8.05887 27.9411 0 18 0C8.05887 0 0 8.05887 0 18C0 27.9411 8.05887 36 18 36C27.9411 36 36 27.9411 36 18Z" fill="white" fill-opacity="0.4"/>\n' +
            '</g>\n' +
            '<path d="M15 24L21 18L15 12" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>\n' +
            '</g>\n' +
            '<defs>\n' +
            '<filter id="filter0_b_720_9" x="-5.91667" y="-5.91667" width="47.8333" height="47.8333" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">\n' +
            '<feFlood flood-opacity="0" result="BackgroundImageFix"/>\n' +
            '<feGaussianBlur in="BackgroundImageFix" stdDeviation="2.95833"/>\n' +
            '<feComposite in2="SourceAlpha" operator="in" result="effect1_backgroundBlur_720_9"/>\n' +
            '<feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_720_9" result="shape"/>\n' +
            '</filter>\n' +
            '<clipPath id="clip0_720_9">\n' +
            '<rect width="36" height="36" fill="white" transform="matrix(0 -1 1 0 0 36)"/>\n' +
            '</clipPath>\n' +
            '</defs>\n' +
            '</svg>\n'),
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    prevArrow: ('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="slick-prev-img" viewBox="0 0 24 24" fill="none">\n' +
                        '<path d="M15 18L9 12L15 6" stroke="#8F52A1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>\n' +
                        '</svg>\n'),
                    nextArrow: ( '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="slick-next-img" viewBox="0 0 24 24" fill="none">\n' +
                        '<path d="M9 18L15 12L9 6" stroke="#8F52A1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>\n' +
                        '</svg>'),
                }
            }]
    });

});

/*/////////SLIDER//////////////*/
$(document).ready(function () {
if ($('.book-page-reviews-item').length >= 4) {
    $('.multiple-items').slick({
        slidesToShow: 4,
        dots: true,
        slidesToScroll: 1,
        autoplay: false,
        // autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1600,
                settings: {
                    arrows: false,
                    // centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    arrows: false,
                    // centerMode: true,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 900,
                settings: {
                    arrows: false,
                    // centerMode: true,
                    slidesToShow: 1
                }
            }
        ]
    });
}
});
/*/////////SLIDER//////////////*/

$('#useCoupon').on('click', function (event) {
    event.preventDefault();
    let couponName = $('#couponName').val();

    if (!couponName.length) return

    $('.loader-container').css('display', 'flex');
    let url = $('#couponRouterName').val();
    let totalPriceElement = document.querySelector('.total-price');
    let totalPriceToPayElement = document.querySelector('.total-price-to-pay');

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
            totalPriceElement.innerHTML = data.total_price;
            totalPriceToPayElement.innerHTML = data.total_price;
            $('.couponCallBackMessage').html(data.message);
        },
        error: function (xhr, textStatus, errorThrown) {
            console.error(errorThrown);
        },
        complete: function () {
            $('.loader-container').hide();
        }
    });
});


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
    } else if (event.target.value.length <= 2) {
        $("#booksContainer").html('');
    }
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
                        <img src="${bookItemLogo + book.category_name + '.png'}" alt="">
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
