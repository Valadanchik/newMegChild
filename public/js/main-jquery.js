/*/////////SLIDER//////////////*/

$('.single-item').slick({
    dots: true,
    prevArrow: ('<svg class="slick-prev" width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
        '<path d="M7 13L1 7L7 1" stroke="#8F52A1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>\n' +
        '</svg>'),
    nextArrow: ('<svg class="slick-next" width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
        '<path d="M1 13L7 7L1 1" stroke="#8F52A1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>\n' +
        '</svg>'),
});

/*/////////SLIDER//////////////*/

/*SEARCH FUNCTIONALITY*/
$(document).ready(function () {
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
        } else {
            $("#booksContainer").html('');
        }
    });
});

function htmlFilter(data) {
    let bookUrl = $("#book-url").val();
    let bookImageUrl = $("#book-image-url").val();
    let locale = $("#locale").val();
    let bookItemLogo = $("#book-item-logo").val();
    let booksInfoItem = $('<div class="books-info-item"></div>');

    data.books.forEach((book, index) => {
        let searchData = '';
        searchData +=
            `<div class="book-item">
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
    $("#booksContainer").html(booksInfoItem);
}
/*SEARCH FUNCTIONALITY*/
