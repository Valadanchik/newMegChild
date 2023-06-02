let tabs = document.querySelectorAll(".tabs_wrap ul li");
let articleWrapper = document.querySelector(".articles-wrapper");
let mediaWrapper = document.querySelector(".media-wrapper");
let tabsUl = document.querySelector(".tabs_wrap ul");

tabs.forEach((tab)=>{
    tab.addEventListener("click", ()=>{

        let tabval = tab.getAttribute("data-tabs");

        if(tabval == "article"){
            tabsUl.classList.remove('right');
            articleWrapper.classList.add('open');
            mediaWrapper.classList.remove('open');
        }
        else if(tabval == "media"){
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
    var product = document.getElementById('product-id').value;
    var quantity = document.getElementById('quantity').value;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var data = JSON.stringify({ _token: csrfToken, quantity: quantity, product: product });

    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(xhr.responseText);
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
//             console.log(xhr.responseText);
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
//
//
//     console.log(bookId);
// }));


// ___________________class row-reverse____________________

let book_boxes = document.querySelectorAll('.book-box')

book_boxes.forEach((item, index)=>{
    if(index % 2 === 1){
        item.classList.add('revers')
    }
})
// _______________/menu-acti_______________________

let menu_link = document.querySelectorAll('.menu-link');

menu_link.forEach((item)=>{
    item.addEventListener('click', activMenuItem);
})

function activMenuItem (e){
    menu_link.forEach(el => {
        el.classList.remove('active-menu-underline')
    })
    e.target.classList.add('active-menu-underline')

}

function updateCartProductCount (quantity, productId){

    document.querySelector('.loader-container').style.display = 'flex';

    let totalPriceElement = document.querySelector('.total-price');
    let totalPriceToPayElement = document.querySelector('.total-price-to-pay');
    // let totalPrice = parseInt(totalPriceElement.innerHTML);

    var xhr = new XMLHttpRequest();
        xhr.open('POST', document.getElementById('change-cart-product-count').value);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");

        var product = document.getElementById('product-id').value;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var data = JSON.stringify({ _token: csrfToken, quantity: quantity, book_id: productId });

        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                var data = JSON.parse(xhr.responseText);
                console.log(data);
                totalPriceElement.innerHTML = data.total_price;
                totalPriceToPayElement.innerHTML = data.total_price;
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

min?.forEach((item) =>{
    item.addEventListener('click', (event)=>{
        let payPriceElement = document.querySelector('.all-result-payable-to span span');
        let totalPriceElement = document.querySelector('.all-result-total span span');
        let totalPrice = parseInt(totalPriceElement.innerHTML);
        let dataItem = parseInt(event.currentTarget.dataset.item);
        let itemPrice = parseInt(event.currentTarget.dataset.price);
        let countElement = document.getElementById('count-shop-' + dataItem);
        let minBtn = document.querySelector(`.min-count-${dataItem} img`);
        let productId = parseInt(event.currentTarget.dataset.product);

        console.log(minBtn);
        if(parseInt(countElement.value) > 2) {
            countElement.value = parseInt(countElement.value) - 1;
            updateCartProductCount(countElement.value, productId)

            totalPriceElement.innerHTML = totalPrice - itemPrice;
            payPriceElement.innerHTML = parseInt(payPriceElement.innerHTML) - itemPrice;
        } else {
            countElement.value = parseInt(countElement.value) - 1;
            updateCartProductCount(countElement.value, productId)

            totalPriceElement.innerHTML = totalPrice - itemPrice;
            payPriceElement.innerHTML = parseInt(payPriceElement.innerHTML) - itemPrice;
            event.currentTarget.classList.add('min-none');
            minBtn.src = "/images/svg/shopping-cart-min-img.svg";
        }

    })
});

plus?.forEach((item) =>{
    item.addEventListener('click', (event)=>{

        let payPriceElement = document.querySelector('.all-result-payable-to span span');
        let totalPriceElement = document.querySelector('.all-result-total span span');
        let totalPrice = parseInt(totalPriceElement.innerHTML);
        let dataItem = parseInt(event.currentTarget.dataset.item);
        let itemPrice = parseInt(event.currentTarget.dataset.price);
        let maxCount = parseInt(event.currentTarget.dataset.max);
        let countElement = document.getElementById('count-shop-' + dataItem);
        let productId = parseInt(event.currentTarget.dataset.product);


        let minBtn = document.querySelector(`.min-count-${dataItem}`);

            if(parseInt(countElement.value) < maxCount) {
            countElement.value = parseInt(countElement.value) + 1;
            updateCartProductCount(countElement.value, productId)
            totalPriceElement.innerHTML = totalPrice +  itemPrice;
            payPriceElement.innerHTML = parseInt(payPriceElement.innerHTML) +  itemPrice;
            minBtn.querySelector('img').src = "/images/svg/minus-circle.svg";
            minBtn.classList.remove('min-none');
        }

    })
});

deleteBtn?.forEach((item) =>{
    item.addEventListener('click', (event)=>{

        let dataItem = parseInt(event.currentTarget.dataset.item);
        let itemPrice = parseInt(event.currentTarget.dataset.price);
        let rowItemElement = document.getElementById('shopping-cart-products-item-' + dataItem);
        let rowItemCountElement = document.getElementById('count-shop-' + dataItem);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', document.getElementById('remove-from-cart-url').value);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");
        var bookId = event.target.getAttribute("data-book-id");
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var data = JSON.stringify({ _token: csrfToken, book_id: bookId });

        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                var data = JSON.parse(xhr.responseText);
                // window.location.reload();
                let payPriceElement = document.querySelector('.all-result-payable-to span span');
                let totalPriceElement = document.querySelector('.all-result-total span span');
                let totalPrice = parseInt(totalPriceElement.innerHTML);
                let payPrice = parseInt(totalPriceElement.innerHTML);
                totalPriceElement.innerHTML = totalPrice - parseInt(rowItemCountElement.value) * itemPrice;
                payPriceElement.innerHTML = payPrice - parseInt(rowItemCountElement.value) * itemPrice;
                rowItemElement.remove();
            } };

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

nav_icon1.addEventListener("click", menuOpen)

function menuOpen(){

    nav.classList.toggle('menu-show')
    nav_icon1.classList.toggle('open')
    modal.classList.toggle('modal-open')
    body.classList.toggle('body-open')
}

modal?.addEventListener('click' , modalClose)

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

if(accept2){
    acceptContent2 = getComputedStyle(accept2, "::before");
}

const country = document.getElementById('country');

form_shopping_cart?.addEventListener('submit', e => {
    e.preventDefault();
    checkInputsShoppingCart();
});

function checkInputsShoppingCart() {
    // trim to remove the whitespaces
    const firstNameValue = firstName.value.trim();
    const lastNameValue = lastName.value.trim();
    const homeValue = home.value.trim();
    // const apartmentValue = apartment.value.trim();
    const cityValue = city.value.trim();
    const postCodeValue = postCode.value.trim();
    const tellValue = tell.value.trim();
    const emailShopValue = emailShop.value.trim();
    //const reviewSoppingCartValue = reviewSoppingCart?.value?.trim();

    if(firstNameValue ===''){
        setErrorForShopping(firstName, 'Գրեք Ձեր անունը');
    } else {
        setSuccessForShopping(firstName);
    }

    if(lastNameValue ===''){
        setErrorForShopping(lastName, 'Գրեք Ձեր ազգանունը');
    } else {
        setSuccessForShopping(lastName);
    }

    if(homeValue ===''){
        setErrorForShopping(home, 'Գրեք Ձեր փողոցը');
    } else {
        setSuccessForShopping(home);
    }

    // if(apartmentValue ===''){
    //     setErrorForShopping(apartment, 'Name cannot be blank');
    // } else {
    //     setSuccessForShopping(apartment);
    // }

    if(cityValue ===''){
        setErrorForShopping(city, 'Գրեք Ձեր քաղաքը');
    } else {
        setSuccessForShopping(city);
    }

    if(postCodeValue ===''){
        setErrorForShopping(postCode, 'Գրեք Ձեր փոստային կոդը');
    } else {
        setSuccessForShopping(postCode);
    }

    if(tellValue ===''){
        setErrorForShopping(tell, 'Գրեք Ձեր հեռախոսահամարը');
    } else {
        setSuccessForShopping(tell);
    }

    if(emailShopValue === '') {
        setErrorForShopping(emailShop, 'Գրեք Ձեր էլ.հասցեն');
    } else if (!isEmailShop(emailShopValue)) {
        setErrorForShopping(emailShop, 'էլ․հասցեն ճիծտ չէ');
    } else {
        setSuccessForShopping(emailShop);
    }

    // if(reviewSoppingCartValue === '' || reviewSoppingCartValue.length < 10 ){
    //     setErrorForShopping(reviewSoppingCart, 'Դաշտը լրացված չէ');
    // }   else {
    //     setSuccessForShopping(reviewSoppingCart);
    // }

    if(acceptContent2.content === "none"){
        setErrorForShopping(accept2, 'Կարդացեք և համաձայնվեք օգտագործման պայմանների հետ');
    }else {
        setSuccessForShopping(accept2);
    }
    if(!country.value){
        setErrorForShopping(country, 'Նշեք երկիրը');
    } else {
        setSuccessForShopping(country);
    }
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



//
// /*________________validacia_____________*/
//
// const form = document.querySelector('.forms');
//
// const name = document.getElementById('firs-name');
// const email = document.getElementById('email');
// const accept = document.getElementById('accept')
// const acceptContent = getComputedStyle(accept, "::before");
// const review = document.getElementById('review')
//
//
//
//
// form?.addEventListener('submit', e => {
//     e.preventDefault();
//     checkInputs();
// });
//
//
// function checkInputs() {
//     // trim to remove the whitespaces
//     const emailValue = email.value.trim();
//     const nameValue = name.value.trim();
//     const reviewValue = name.value.trim();
//
//
//     if(emailValue === '') {
//         setErrorFor(email, 'Email cannot be blank');
//     } else if (!isEmail(emailValue)) {
//         setErrorFor(email, 'Not a valid email');
//     } else {
//         setSuccessFor(email);
//     }
//
//     if(nameValue ===''){
//         setErrorFor(name, 'Name cannot be blank');
//     } else {
//         setSuccessFor(name);
//     }
//
//
//     if(acceptContent.content == "none"){
//         setErrorFor(accept, 'Cannot be checked');
//     }else {
//         setSuccessFor(accept);
//     }
//
//     if(reviewValue ==='' && reviewValue.length < 10 ){
//         setErrorFor(review, 'Name cannot be blank');
//     }   else {
//         setSuccessFor(review);
//     }
//
// }
//
//
// function setErrorFor(input, message) {
//     const formControl = input.parentElement;
//     const small = formControl.querySelector('small');
//     formControl.classList.add("error");
//     formControl.classList.remove('success');
//     small.innerText = message;
// }
//
// function setSuccessFor(input) {
//     const formControl = input.parentElement;
//     formControl.classList.add('success');
//     formControl.classList.remove("error")
// }
//
// function isEmail(email) {
//     return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
// }
//

let searchBtn = document.querySelector('.search');
let searchSection = document.querySelector(".search-section");
let closePopup = document.querySelector('.close-popup-img')
let closeModal = document.querySelector('.modal')

searchBtn?.addEventListener('click', ()=>{
    searchSection.classList.toggle("open")
    body.classList.toggle('body-open')
    modal.classList.toggle('modal-open')
})

closePopup?.addEventListener('click', ()=>{
    searchSection.classList.remove("open")
    modal.classList.remove('modal-open')
    body.classList.remove('body-open')

})
closeModal?.addEventListener('click', ()=>{
    searchSection.classList.remove("open")
})
