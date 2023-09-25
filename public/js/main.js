/*////////////articles-filter cloud effect//////////////*/

let tabs = document.querySelectorAll(".tabs_wrap ul li");
let articleWrapper = document.querySelector(".articles-wrapper");
let mediaWrapper = document.querySelector(".media-wrapper");
let tabsUl = document.querySelector(".tabs_wrap ul");

tabs.forEach((tab) => {
    tab.addEventListener("click", () => {

        let tabval = tab.getAttribute("data-tabs");

        if (tabval == "article") {
            tabsUl.classList.remove('right');
            articleWrapper.classList.add('open');
            mediaWrapper.classList.remove('open');
        } else if (tabval == "media") {
            tabsUl.classList.add('right');
            articleWrapper.classList.remove('open');
            mediaWrapper.classList.add('open');
        }
    })
})

document.getElementById('add-to-cart')?.addEventListener('click', function (event) {
    event.preventDefault()
    document.querySelector('.loader-container').style.display = 'flex';
    var xhr = new XMLHttpRequest();
    xhr.open('POST', document.getElementById('add-to-cart-url').value);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");

    var checkoutRouterUrl = document.getElementById('checkout-router').value;
    var product_type = document.getElementById('product-type').value;
    var product = document.getElementById('product-id').value;
    var quantity = document.getElementById('quantity').value;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var data = JSON.stringify({_token: csrfToken, quantity: quantity, product: product, product_type: product_type});

    xhr.onload = function () {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            // var count = data.cartProductsCount;
            window.location.href = checkoutRouterUrl;
        }
    };

    xhr.onerror = function () {
        // Handle error
    };

    xhr.onloadend = function () {
        // document.querySelector('.loader-container').style.display = 'none';
    };

    xhr.send(data);
});

// document.querySelectorAll('.remove-product-from-card').forEach(element => element.addEventListener('click', event => {
//
//     var xhr = new XMLHttpRequest();
//     xhr.open('POST', document.getElementById('remove-from-cart-url').value);
//     xhr.setRequestHeader('Content-Type', 'application/json');
//     xhr.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");
//     var bookId = event.target.getAttribute("data-book-id");
//     var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
//     var data = JSON.stringify({ _token: csrfToken, book_id: bookId });
//
//     xhr.onload = function () {
//         if (xhr.status === 200) {
//             var data = JSON.parse(xhr.responseText);
//             // window.location.reload();
//         }
//
//     };
//
//     xhr.onerror = function () {
//         // Handle error
//     };
//
//     xhr.onloadend = function () {
//         document.querySelector('.loader-container').style.display = 'none';
//     };
//
//     xhr.send(data);
// }));

// _______________/menu-active_______________________

let menu_link = document?.querySelectorAll('.menu-link');

menu_link.forEach((item) => {
    item.addEventListener('click', activeMenuItem);
})

function activeMenuItem(e) {
    menu_link?.forEach(el => {
        el.classList.remove('active-menu-underline')
    })
    e.target.classList.add('active-menu-underline')

}

function updateCartProductCount(quantity, productId, productType) {

    document.querySelector('.loader-container').style.display = 'flex';

    let totalPriceElement = document.querySelector('.total-price');
    let totalPriceToPayElement = document.querySelector('.total-price-to-pay');
    let couponCallBackMessage = document.querySelector('.couponCallBackMessage');
    // let totalPrice = parseInt(totalPriceElement.innerHTML);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', document.getElementById('change-cart-product-count').value);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");

    // var product = document.getElementById('product-id').value;
    var coupon_name = document.getElementById('couponName').value;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var data = JSON.stringify({_token: csrfToken, quantity: quantity, product_id: productId, productType: productType, coupon: coupon_name});

    xhr.onload = function () {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            if (data.success) {
                totalPriceElement.innerHTML = data.total_price;
                totalPriceToPayElement.innerHTML = data.total_price;
                couponCallBackMessage.innerHTML = data.message;
            } else {
                couponCallBackMessage.innerHTML = data.message;
            }


        }
    };

    xhr.onerror = function () {
        // Handle error
    };

    xhr.onloadend = function () {
        document.querySelector('.loader-container').style.display = 'none';
    };

    xhr.send(data);
}


/////////////////count///////////////
let min = document.querySelectorAll('.shopping-cart-products-count-item-min');
let plus = document.querySelectorAll('.shopping-cart-products-count-item-plus');
let deleteBtn = document.querySelectorAll('.shopping-cart-products-count-close-icon');

min?.forEach((item) => {
    item.addEventListener('click', (event) => {
        let dataItem = event.currentTarget.dataset.item;
        let productType = event.currentTarget.dataset.productType;
        let countElement = document.getElementById('count-shop-' + dataItem);
        let minBtn = document.querySelector(`.min-count-${dataItem} img`);
        let productId = parseInt(event.currentTarget.dataset.product);
        if (parseInt(countElement.value) > 2) {
            countElement.value = parseInt(countElement.value) - 1;
            updateCartProductCount(countElement.value, productId, productType)

            // totalPriceElement.innerHTML = totalPrice - itemPrice;
            // payPriceElement.innerHTML = parseInt(payPriceElement.innerHTML) - itemPrice;
        } else {
            countElement.value = parseInt(countElement.value) - 1;
            updateCartProductCount(countElement.value, productId, productType)

            // totalPriceElement.innerHTML = totalPrice - itemPrice;
            // payPriceElement.innerHTML = parseInt(payPriceElement.innerHTML) - itemPrice;
            event.currentTarget.classList.add('min-none');
            minBtn.src = "/images/svg/shopping-cart-min-img.svg";
        }

    })
});

plus?.forEach((item) => {
    item?.addEventListener('click', (event) => {

        let payPriceElement = document.querySelector('.all-result-payable-to span span');
        let totalPriceElement = document.querySelector('.all-result-total span span');
        let totalPrice = parseInt(totalPriceElement.innerHTML);
        let dataItem = event.currentTarget.dataset.item;
        let itemPrice = parseInt(event.currentTarget.dataset.price);
        let maxCount = parseInt(event.currentTarget.dataset.max);
        let productType = event.currentTarget.dataset.productType;
        let countElement = document.getElementById('count-shop-' + dataItem);
        let productId = parseInt(event.currentTarget.dataset.product);
        let minBtn = document.querySelector(`.min-count-${dataItem}`);

        if (parseInt(countElement.value) < maxCount) {
            countElement.value = parseInt(countElement.value) + 1;
            updateCartProductCount(countElement.value, productId, productType)
            minBtn.querySelector('img').src = "/images/svg/minus-circle.svg";
            minBtn.classList.remove('min-none');
        }
    })
});

deleteBtn?.forEach((item) => {
    item.addEventListener('click', (event) => {
        let dataItem = event.currentTarget.dataset.item;
        let itemPrice = parseInt(event.currentTarget.dataset.price);
        let rowItemElement = document.getElementById('shopping-cart-products-item-' + dataItem);
        let productType = event.target.getAttribute("data-product-type");
        let rowItemCountElement = document.getElementById('count-shop-' + dataItem);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', document.getElementById('remove-from-cart-url').value);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");
        var productId = event.target.getAttribute("data-product-id");
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var data = JSON.stringify({_token: csrfToken, product_id: productId, product_type: productType});

        xhr.onload = function () {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                let payPriceElement = document.querySelector('.all-result-payable-to span span');
                let totalPriceElement = document.querySelector('.all-result-total span span');
                let totalPrice = parseInt(totalPriceElement.innerHTML);
                let payPrice = parseInt(totalPriceElement.innerHTML);
                totalPriceElement.innerHTML = totalPrice - parseInt(rowItemCountElement.value) * itemPrice;
                payPriceElement.innerHTML = payPrice - parseInt(rowItemCountElement.value) * itemPrice;
                rowItemElement.remove();

            }
        };

        xhr.onerror = function () {
            // Handle error
        };

        xhr.onloadend = function () {
            document.querySelector('.loader-container').style.display = 'none';
        };
        xhr.send(data);
    })
});

// ____________hamburger menu____________

let nav = document.querySelector('.header-menu ')
let nav_icon1 = document.querySelector('#nav-icon1');
let modal = document.querySelector('.modal')
let body = document.querySelector('.body')

nav_icon1?.addEventListener("click", menuOpen)

function menuOpen() {

    nav.classList.toggle('menu-show')
    nav_icon1.classList.toggle('open')
    modal.classList.toggle('modal-open')
    body.classList.toggle('body-open')
}

modal?.addEventListener('click', modalClose)

function modalClose() {
    modal.classList.remove('modal-open')
    nav_icon1.classList.remove('open')
    nav.classList.remove('menu-show')
    body.classList.remove('body-open')

}

//////////////////////////shoping cart validacia//////////////////////////////

let form_shopping_cart = document.querySelector('.form-shopping-cart')
const firstName = document.getElementById('shopping-cart-firs-name');
const lastName = document.getElementById('last-name');
const home = document.getElementById('home');
//const apartment = document.getElementById('apartment');
const city = document.getElementById('city');
const postCode = document.getElementById('post-code');
const tell = document.getElementById('home-tell')
const emailShop = document.getElementById('email-shop');
//const reviewSoppingCart = document.getElementById('review-sopping-cart');
const accept2 = document.getElementById('accept-sopping-cart');
let acceptContent2

if (accept2) {
    acceptContent2 = getComputedStyle(accept2, "::before");
}

const country = document.getElementById('country');

form_shopping_cart?.addEventListener('submit', e => {

    if (!checkInputsShoppingCart()) {
        return e.preventDefault();
    }
});

function checkInputsShoppingCart() {
    const firstNameValue = firstName.value.trim();
    const lastNameValue = lastName.value.trim();
    const homeValue = home.value.trim();
    const cityValue = city.value.trim();
    const postCodeValue = postCode.value.trim();
    const tellValue = tell.value.trim();
    const emailShopValue = emailShop.value.trim();
    const errors = {}

    if (firstNameValue === '') {
        errors['firstName'] = true
        setErrorForShopping(firstName, document.getElementById('required_name').value);
    } else {
        setSuccessForShopping(firstName);
    }

    if (lastNameValue === '') {
        errors['lastName'] = true
        setErrorForShopping(lastName, document.getElementById('required_last_name').value);
    } else {
        setSuccessForShopping(lastName);
    }

    if (homeValue === '') {
        errors['home'] = true
        setErrorForShopping(home, document.getElementById('required_street').value);
    } else {
        setSuccessForShopping(home);
    }

    if (cityValue === '') {
        errors['city'] = true
        setErrorForShopping(city, document.getElementById('required_city').value);
    } else {
        setSuccessForShopping(city);
    }

    if (postCodeValue === '') {
        errors['postCode'] = true
        setErrorForShopping(postCode, document.getElementById('required_post_code').value);
    } else {
        setSuccessForShopping(postCode);
    }

    if (tellValue === '') {
        errors['tell'] = true
        setErrorForShopping(tell, document.getElementById('required_phone').value);
    } else {
        setSuccessForShopping(tell);
    }

    if (emailShopValue === '') {
        errors['emailShop'] = true
        setErrorForShopping(emailShop, document.getElementById('required_email').value);
    } else if (!isEmailShop(emailShopValue)) {
        setErrorForShopping(emailShop, document.getElementById('required_email_wrong').value);
    } else {
        setSuccessForShopping(emailShop);
    }

    if (acceptContent2.content === "none") {
        errors['accept2'] = true
        setErrorForShopping(accept2, document.getElementById('required_terms').value);
    } else {
        setSuccessForShopping(accept2);
    }
    if (!country.value) {
        errors['country'] = true
        setErrorForShopping(country, document.getElementById('required_country').value);
    } else {
        setSuccessForShopping(country);
    }
    return !Object.keys(errors).length
}

function setErrorForShopping(input, message) {
    const formControl1 = input.parentElement;
    const small1 = formControl1.querySelector('small');
    formControl1.classList.add("error");
    formControl1.classList.remove('success');
    small1.innerText = message;
}

function setSuccessForShopping(input) {
    const formControl1 = input.parentElement;
    formControl1.classList.add('success');
    formControl1.classList.remove("error")
}

function isEmailShop(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}


let searchBtn = document.querySelector('.search');
let searchSection = document.querySelector(".search-section");
let closePopup = document.querySelector('.close-popup-img img')
let closeModal = document.querySelector('.modal')
let book_info = document.querySelector('#booksContainer')
// let search_input = document.querySelector('#search-input').value;

searchBtn?.addEventListener('click', () => {
    searchSection.classList.toggle("open")
    body.classList.toggle('body-open')
    modal.classList.toggle('modal-open')
    book_info.classList.remove('d-none')
})

closePopup?.addEventListener('click', () => {
    searchSection.classList.remove("open")
    modal.classList.remove('modal-open')
    body.classList.remove('body-open')
    book_info.classList.add('d-none')
    book_info.innerHTML = ''


})
closeModal?.addEventListener('click', () => {
    searchSection.classList.remove("open")
})


/*////////////////////Accordion//////////////////////*/

const buttons = document.querySelectorAll(".accordion-toggle");

buttons.forEach((button) => {
    button.addEventListener("click", () =>
        button.parentElement.classList.toggle("active")
    );
});


/*//////////////filter///////////////*/

const media_filter_icon = document.querySelector('.media-filter-icon img')
const choose_media_section = document.querySelector('.choose-media-section')
let modal_filter = document.querySelector('.modal')
let filter_body = document.querySelector('.filter-body')

media_filter_icon?.addEventListener("click", filterOpen)

function filterOpen() {
    choose_media_section.classList.toggle('filter-show')
    media_filter_icon.classList.toggle('open')
    modal_filter.classList.toggle('filter-modal-open')
    filter_body.classList.toggle('body-open')
}

modal_filter?.addEventListener('click', filterModalClose)

function filterModalClose() {
    modal_filter.classList.remove('filter-modal-open')
    media_filter_icon?.classList.remove('open')
    choose_media_section?.classList.remove('filter-show')
    filter_body?.classList.remove('body-open')
}

/*////////////////filter-book-page/////////////*/

const filter_book_list = document.querySelectorAll('.filtering-book-page-list li a')

filter_book_list?.forEach((item) => {
    item.addEventListener('click', (e) => {
        let is_checked = document.querySelectorAll('.is-checked')
        is_checked.forEach((item) => {
            item.classList.remove('is-checked')
        })
        item.classList.add('is-checked')
    })
})

const books_filter_icon = document.querySelector('.books-filter-img')
const filtering_book_page_list = document.querySelector('.filtering-book-page-list')


books_filter_icon?.addEventListener("click", filterBookOpen)

function filterBookOpen() {
    filtering_book_page_list.classList.toggle('filter-book_show')
    books_filter_icon?.classList.toggle('open')
    modal_filter?.classList.toggle('filter-modal-open')
    filter_body?.classList.toggle('body-open')
}

modal?.addEventListener('click', filterBookModalClose)

function filterBookModalClose() {
    modal_filter?.classList.remove('filter-modal-open')
    books_filter_icon?.classList.remove('open')
    filtering_book_page_list?.classList.remove('filter-book_show')
    filter_body?.classList.remove('body-open')

}

/*/////////////////////////Learn more///////////////////////////*/
const l_more = document.querySelector('.l_more')
const height_text = document.querySelector('.book-item-desc p')?.offsetHeight
const l_more_button = document.querySelector('.learn-more-btn')

if (height_text >= 120) {
    l_more?.classList.add('learn-more')
} else if (l_more_button) {
    l_more_button.style.display = 'none';
}

const learn_more_btn = document.querySelector('.learn-more-btn');
const learn_more_div = document.querySelector('.learn-more');
const text = document.querySelector('.book-item-desc p')

learn_more_btn?.addEventListener('click', () => {
    learn_more_div.className = 'learn-more-none'
    text.style.overflow = "inherit"
    text.style.display = "inherit"
})

/*________________validacia_____________*/

const form = document.querySelector('.forms');
const name = document.getElementById('firs-name');
const email = document.getElementById('email');
const review = document.getElementById('review')
const accept = document.getElementById('accept')
let acceptContent
if (accept) {
    acceptContent = getComputedStyle(accept, "::before");
}

form?.addEventListener('submit', e => {
    if (!checkInputs()) {

        return e.preventDefault();
    }
});


function checkInputs() {
    // trim to remove the whitespaces
    const emailValue = email.value.trim();
    const nameValue = name.value.trim();
    const reviewValue = name.value.trim();
    const errorsForm = {}

    if (nameValue === '') {
        errorsForm['name'] = true
        setErrorFor(name, document.getElementById('required_name').value);
    } else {
        setSuccessFor(name);
    }

    if (emailValue === '') {
        errorsForm['email'] = true
        setErrorFor(email, document.getElementById('required_email').value);
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, document.getElementById('required_email_wrong').value);
    } else {
        setSuccessFor(email);
    }

    if (acceptContent.content == "none") {
        errorsForm['accept'] = true
        setErrorFor(accept, document.getElementById('required_terms').value);
    } else {
        setSuccessFor(accept);
    }

    if (reviewValue === '' && reviewValue.length < 10) {
        errorsForm['review'] = true
        setErrorFor(review, document.getElementById('required_review').value);
    } else {
        setSuccessFor(review);
    }
    return !Object.keys(errorsForm).length
}

function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    formControl.classList.add("error");
    formControl.classList.remove('success');
    small.innerText = message;
}

function setSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.classList.add('success');
    formControl.classList.remove("error")
}

function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}


/*/////////////////// cloud popup ///////////////*/

let cloud_modal = document.querySelector('.cloud-modal ');
let cloud_modal_text = document.querySelector('.cloud-modal-text ');
let modal_filter1 = document.querySelector('.modal')
let filter_body1 = document.querySelector('.filter-body')
let book_page_reviews_info = document.querySelectorAll('.book-page-reviews-item p')
console.log(book_page_reviews_info)

book_page_reviews_info.forEach((item) => {

    if (item.offsetHeight > 84) {
        item.addEventListener('click', () => {
            let text = item.innerHTML
            cloud_modal_text.innerHTML = text
            cloud_modal.style.display = 'block'
            cloud_modal.style.cursor = 'unset'
            modal_filter1.classList.toggle('filter-modal-open')
            filter_body1.classList.toggle('body-open')
        })
    } else if (item.offsetHeight < 85) {
        item.style.cursor = 'unset'
    }
})

modal_filter1.addEventListener('click', () => {
    cloud_modal.style.display = 'none'

})


//////////////menu-mobile/////////////////////

let about_us = document.querySelector('.menu-about-us')
let book_menu_drop_down = document.querySelector('.book-arrow')

let menu_item = document.querySelectorAll('.menu-drop-down')
let book_item = document.querySelector('.books-drop-down')

let article_menu_drop_down = document.querySelector('.menu-drop-down-articles')
let article_item = document.querySelector('.drop-down-articles')


about_us.addEventListener('click', () =>{
    menu_item.forEach((item) => {
        item.classList.toggle('clickOpen')
    })
})

book_menu_drop_down.addEventListener('click', () => {
    book_item.classList.toggle('clickOpen')
})

article_menu_drop_down.addEventListener('click', () => {
    article_item.classList.toggle('clickOpen')
})


//shiping-price

let selectElement = document.getElementById('country');
let totalPrice = document.querySelector('.total-price-to-pay');
let shipPrice = document.querySelector('.ship-price');
let madeUpShipPrice = 0;
let overallPrice = 0;

selectElement.addEventListener('change', function () {
    let selectedOption = selectElement.options[selectElement.selectedIndex];
    let shippingPrice = parseFloat(selectedOption.getAttribute('data-shipping-price'));
    let translate = document.getElementById('required_price').value

    if (!isNaN(shippingPrice) && shippingPrice >= 0) {
        let totalPriceValue = parseFloat(totalPrice.textContent);
        overallPrice = totalPriceValue - madeUpShipPrice + shippingPrice;
        madeUpShipPrice = shippingPrice;
        shipPrice.innerHTML = shippingPrice + ' ֏' ;
        totalPrice.textContent = overallPrice;
    }
    if (shippingPrice === 0) {
        shipPrice.innerHTML = translate;
    }
});
