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
                    <p class="book-pr">5800
                        <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_196_122)">
                                <path d="M9.04588 6.05376C9.04588 5.40952 9.04588 4.9951 9.04588 4.99291C9.03811 3.75883 8.53153 2.6334 7.72114 1.82474C6.90577 1.00782 5.76869 0.499361 4.52296 0.500001C3.27719 0.499407 2.14002 1.00786 1.32474 1.82479C0.507819 2.64002 -0.000638795 3.77719 6.02335e-07 5.02305H2.02716C2.02762 4.33054 2.30489 3.71306 2.75813 3.25813C3.21297 2.80489 3.83045 2.52767 4.52296 2.52707C5.21538 2.52767 5.83281 2.80489 6.28774 3.25813C6.73318 3.70521 7.0088 4.30944 7.01853 4.98743C7.01871 4.9993 7.01871 13.5 7.01871 13.5H9.04601C9.04601 13.4965 9.04601 12.46 9.04601 11.1122L9.04588 6.05376Z"
                                      fill="#444444"/>
                                <path d="M7.02041 6.05371H4.88281V8.09764H7.02032" fill="#444444"/>
                                <path d="M11.1845 6.05371H9.04688V8.09764H11.1844" fill="#444444"/>
                                <path d="M11.1845 9.06812H9.04688V11.1121H11.1844" fill="#444444"/>
                                <path d="M7.02036 9.06812H4.88281V11.1121H7.02027" fill="#444444"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_196_122">
                                    <rect width="11.1836" height="13" fill="white" transform="translate(0 0.5)"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </p>
                    <!--                    <span>Պահեստում չկա</span>-->
                </div>
                <div class="book-btn">
                    <button>Գնել</button>
                </div>
            </div>

        </div>
    </section>
</main>
