@extends('layout.layout')

{{--@section('content')--}}

<main class="news-articles">
    <section class="author-single-page content">
        <div class="author-single-page-back-btn">
            <span>Հեղինակներ / </span>
            <span class="au-sing-active"><a href="#">Սոնա Բաբաջանյան</a></span>
        </div>
        <div class="author-single-page-info">
            <div class="author-single-page-info-img">
                <img src="{{ URL::to('/images/Sona.png') }}" alt="author images">
            </div>
            <div class="author-single-page-info-desc">
                <h2>Սոնա Բաբաջանյան</h2>
                <p>Սոնա Բաբաջանյանը (ծնվ. 1965) ավստրալաբնակ հայ նկարիչ է և գեղարվեստական գրականության թարգմանիչ: Ավստրալիայում, Ռուսաստանում և Հայաստանում հրատարակված բազմաթիվ գրքերի ձևավորող է, որոնց շարքում՝ Քորալ Վասի՝ ավստրալացի մանուկների սիրելի և բեսթսելլեր դարձած «Բարի գիշեր, Պոսում» պատկերագիրքը (Koala Books, Scholastic, 2011): «Բաց դռների օրը կամ Մուշի անհավանական արկածները» Սոնայի առաջին գիրքն է, որտեղ հանդես է գալիս ոչ միայն որպես նկարազարդող, այլև որպես հեղինակ։ Նա հյուսել է մի հմայիչ պատմություն, որը պատանի ընթերցողներին կտանի զարմանալի արկածներով լի կախարդական ճամփորդության:</p>
            </div>
        </div>
    </section>

    <section class="content author-single-page-books-section">
        <h2>Գրքեր</h2>
        <div class="author-single-page-books">
            <div class="author-single-page-book-item">
                <div class="author-single-page-book-item-images">
                    <div class="book-item-img-logo">
                        <img src="assets/images/reade-more-img-logo-green.png" alt="">
                    </div>
                    <div class="book-item-img-book">
                        <img src="{{ URL::to('/images/Mush.png') }}" alt="">
                    </div>
                </div>
                <h3>Մանյունյան, Տայի հոբելյանն ու այլ տագնապներ [Գիրք 3]</h3>
                <p>Նարինե Աբգարյան</p>
                <div class="book-price-authot-single-page">
                    <p class="book-pr">5800 ֏ </p>
                    <!--                    <span>Պահեստում չկա</span>-->
                </div>
                <div class="book-btn">
                    <button>Գնել</button>
                </div>
            </div>

        </div>
    </section>
</main>
