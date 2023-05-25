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
        document.querySelector('.loader-container').style.display = 'none';
    };

    xhr.send(data);
});


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



/////////////////count///////////////

// let min = document.querySelector('.min');
// let del = document.querySelector('.del')
// let plus = document.querySelector('.shopping-cart-products-count-item-plus');
// let count = document.querySelector('.count-shop')
// let shoppingCart = document.querySelectorAll('.shopping-cart-products-item')
// let countValue = 1
// console.log(shoppingCart)
//
//
// console.log(countValue)
// count.innerHTML =countValue
// min.addEventListener('click', (e)=>{
//
//     if(countValue === 1){
//         count.innerHTML= countValue
//         min.classList.add ('min-none')
//     } else if(countValue >= 1  ){
//         count.innerHTML= --countValue
//     }
//
// })
//
// plus.addEventListener('click', (e)=>{
//     if(countValue >= 1){
//         count.innerHTML= ++countValue
//         min.classList.remove( 'min-none')
//     }
//     if(countValue === 0){
//         count.innerHTML= ++countValue
//     }
//
// })



//////////////////////////shoping cart validacia//////////////////////////////

let form_shopping_cart = document.querySelector('.form-shopping-cart')

const firstName = document.getElementById('shopping-cart-firs-name');
const lastName = document.getElementById('last-name');
const home = document.getElementById('home');
const apartment = document.getElementById('apartment');
const city = document.getElementById('city');
const postCode = document.getElementById('post-code');
const tell = document.getElementById('home-tell')
const emailShop = document.getElementById('email-shop');
const reviewSoppingCart = document.getElementById('review-sopping-cart')
const accept2 = document.getElementById('accept-sopping-cart')
const acceptContent2 = getComputedStyle(accept2, "::before");
const country = document.getElementById('country')


console.log(accept2)



form_shopping_cart?.addEventListener('submit', e => {
    e.preventDefault();
    checkInputsShoppingCart();
});

function checkInputsShoppingCart() {
    // trim to remove the whitespaces
    const firstNameValue = firstName.value.trim();
    const lastNameValue = lastName.value.trim();
    const homeValue = home.value.trim();
    const apartmentValue = apartment.value.trim();
    const cityValue = city.value.trim();
    const postCodeValue = postCode.value.trim();
    const tellValue = tell.value.trim();
    const emailShopValue = emailShop.value.trim();
    const reviewSoppingCartValue = reviewSoppingCart?.value?.trim();





    if(firstNameValue ===''){
        setErrorForShopping(firstName, 'Name cannot be blank');
    } else {
        setSuccessForShopping(firstName);
    }

    if(lastNameValue ===''){
        setErrorForShopping(lastName, 'Name cannot be blank');
    } else {
        setSuccessForShopping(lastName);
    }

    if(homeValue ===''){
        setErrorForShopping(home, 'Name cannot be blank');
    } else {
        setSuccessForShopping(home);
    }

    if(apartmentValue ===''){
        setErrorForShopping(apartment, 'Name cannot be blank');
    } else {
        setSuccessForShopping(apartment);
    }

    if(cityValue ===''){
        setErrorForShopping(city, 'Name cannot be blank');
    } else {
        setSuccessForShopping(city);
    }

    if(postCodeValue ===''){
        setErrorForShopping(postCode, 'Name cannot be blank');
    } else {
        setSuccessForShopping(postCode);
    }

    if(tellValue ===''){
        setErrorForShopping(tell, 'Name cannot be blank');
    } else {
        setSuccessForShopping(tell);
    }


    if(emailShopValue === '') {
        setErrorForShopping(emailShop, 'Email cannot be blank');
    } else if (!isEmailShop(emailShopValue)) {
        setErrorForShopping(emailShop, 'Not a valid email');
    } else {
        setSuccessForShopping(emailShop);
    }

    if(reviewSoppingCartValue === '' || reviewSoppingCartValue.length < 10 ){
        setErrorForShopping(reviewSoppingCart, 'Name cannot be blank');
    }   else {
        setSuccessForShopping(reviewSoppingCart);
    }

    if(acceptContent2.content == "none"){
        setErrorForShopping(accept2, 'Cannot be checked');
    }else {
        console.log('sssss')
        setSuccessForShopping(accept2);
    }
    if(country.value == 'Ընտրեք երկիրը *'){
        setErrorForShopping(country, 'Name cannot be blank');
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




/*________________validacia_____________*/

const form = document.querySelector('.forms');

const name = document.getElementById('firs-name');
const email = document.getElementById('email');
const accept = document.getElementById('accept')
const acceptContent = getComputedStyle(accept, "::before");
const review = document.getElementById('review')




form?.addEventListener('submit', e => {
    e.preventDefault();
    checkInputs();
});


function checkInputs() {
    // trim to remove the whitespaces
    const emailValue = email.value.trim();
    const nameValue = name.value.trim();
    const reviewValue = name.value.trim();


    if(emailValue === '') {
        setErrorFor(email, 'Email cannot be blank');
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Not a valid email');
    } else {
        setSuccessFor(email);
    }

    if(nameValue ===''){
        setErrorFor(name, 'Name cannot be blank');
    } else {
        setSuccessFor(name);
    }


    if(acceptContent.content == "none"){
        setErrorFor(accept, 'Cannot be checked');
    }else {
        setSuccessFor(accept);
    }

    if(reviewValue ==='' && reviewValue.length < 10 ){
        setErrorFor(review, 'Name cannot be blank');
    }   else {
        setSuccessFor(review);
    }

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



