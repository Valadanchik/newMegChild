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






