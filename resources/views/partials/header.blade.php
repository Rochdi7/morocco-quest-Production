{{-- resources/views/partials/header.blade.php --}}

<!--================= Mobile Menu =================-->
<div class="vs-menu-wrapper">
    <div class="vs-menu-area text-center">
        <div class="mobile-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/img/logo-bg-wide-white.webp') }}" alt="Morocco Quest" class="logo"
                    width="240" height="77">
            </a>


            <button class="vs-menu-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg></button>
        </div>
        <div class="vs-mobile-menu">
            <ul>
                <li class="menu-item-has-children">
                    <a href="{{ route('tours.multi_day') }}">Multi-Day Tours</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('tours.type', 'Garden Tours') }}">Garden Tours</a></li>
                        <li><a href="{{ route('tours.type', 'Art Tours') }}">Art Tours</a></li>
                        <li><a href="{{ route('tours.type', 'Classical Tours') }}">Classical Tours</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="{{ route('activity-categories.index') }}">One-Day Tours</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('activities.byCategory', 'city-tours') }}">City Tours</a></li>
                        <li><a href="{{ route('activities.byCategory', 'day-trips') }}">Day Trips</a></li>
                        <li><a href="{{ route('activities.byCategory', 'local-experiences') }}">Local Experiences</a>
                        </li>
                        <li><a href="{{ route('activities.byCategory', 'outdoor-activities') }}">Outdoor Activities</a>
                        </li>
                        <li><a href="{{ route('activities.byCategory', 'wellness-experiences') }}">Wellness</a></li>
                        <li><a href="{{ route('activities.byCategory', 'food-culinary-tours') }}">Food & Culinary
                                Tours</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/blog') }}">Blog</a>
                </li>
                <li>
                    <a href="{{ route('dmc.marrakech') }}">DMC</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="#">Info Hub</a>
                    <ul class="sub-menu">
                        <li><a href="{{ url('/about') }}">About Us</a></li>
                        <li><a href="{{ url('/faq') }}">FAQ</a></li>
                        <li><a href="{{ url('/terms-and-conditions') }}">Terms & Conditions</a></li>
                        <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/contact') }}">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ================= Popup Search Box ================= -->
<div class="popup-search-box">
    <button class="searchClose">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-x-icon lucide-x">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
        </svg>
    </button>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" class="border-theme" name="query" placeholder="What are you looking for"
            aria-label="Search input">
        <button type="submit" aria-label="Submit search">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-search-icon lucide-search">
                <path d="m21 21-4.34-4.34" />
                <circle cx="11" cy="11" r="8" />
            </svg>
        </button>
    </form>
</div>

<!-- ================= Sticky Navbar ================= -->
<div id="navbars" class="header-sticky navbars">
    <div class="container custom-container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto col-lg-2">
                <button class="vs-menu-toggle d-inline-block d-lg-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-menu-icon lucide-menu">
                        <path d="M4 12h16" />
                        <path d="M4 18h16" />
                        <path d="M4 6h16" />
                    </svg>
                </button>
                <div class="logo d-none d-lg-block">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/img/logo-bg-wide-white.webp') }}" alt="Morocco Quest" class="logo"
                            width="240" height="77">
                    </a>


                </div>
            </div>

            <div class="col-xl-auto col-lg-auto col-sm-3 d-none d-sm-block">
                <nav class="main-menu d-none d-lg-block">
                    <ul>
                        <li class="menu-item-has-children">
                            <a href="{{ route('tours.multi_day') }}">Multi-Day Tours</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('tours.type', 'Garden Tours') }}">Garden Tours</a></li>
                                <li><a href="{{ route('tours.type', 'Art Tours') }}">Art Tours</a></li>
                                <li><a href="{{ route('tours.type', 'Classical Tours') }}">Classical Tours</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('activity-categories.index') }}">One-Day Tours</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('activities.byCategory', 'city-tours') }}">City Tours</a></li>
                                <li><a href="{{ route('activities.byCategory', 'day-trips') }}">Day Trips</a></li>
                                <li><a href="{{ route('activities.byCategory', 'local-experiences') }}">Local
                                        Experiences</a></li>
                                <li><a href="{{ route('activities.byCategory', 'outdoor-activities') }}">Outdoor
                                        Activities</a></li>
                                <li><a
                                        href="{{ route('activities.byCategory', 'wellness-experiences') }}">Wellness</a>
                                </li>
                                <li><a href="{{ route('activities.byCategory', 'food-culinary-tours') }}">Food &
                                        Culinary Tours</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li><a href="{{ route('dmc.marrakech') }}">DMC</a></li>
                        <li class="menu-item-has-children">
                            <a href="#">Info Hub</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('faq') }}">FAQ</a></li>
                                <li><a href="{{ route('terms.conditions') }}">Terms & Conditions</a></li>
                                <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('contact.show') }}">Contact</a></li>
                    </ul>
                </nav>
                <div class="logo d-lg-none">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/img/logo-bg-wide-white.webp') }}" alt="Morocco Quest"
                            class="logo" width="240" height="77">
                    </a>


                </div>
            </div>

            <div class="col-xl-3 col-md-auto col-auto">
                <div class="header-wc style2">
                    <button class="wc-link2 searchBoxTggler text-title-color" aria-label="Open Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
                            fill="none">
                            <path
                                d="M20.4174 16.6954L17.2213 13.4773C19.3155 10.0703 18.8936 5.54217 15.9593 2.58766C12.5328 -0.862552 6.9769 -0.862552 3.55037 2.58766C0.123835 6.03787 0.123835 11.6322 3.55037 15.0824C6.5354 18.088 11.1341 18.4736 14.5333 16.2469L17.7019 19.4335C18.4521 20.1888 19.6711 20.1888 20.4213 19.4335C21.1675 18.6781 21.1675 17.4507 20.4174 16.6954ZM5.711 12.9029C3.48395 10.6604 3.48395 7.00959 5.711 4.76715C7.93805 2.52471 11.5638 2.52471 13.7909 4.76715C16.018 7.00959 16.018 10.6604 13.7909 12.9029C11.5638 15.1453 7.93805 15.1453 5.711 12.9029Z"
                                fill="#F6F5F5" />
                        </svg>
                    </button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="39" viewBox="0 0 6 39"
                        fill="none">
                        <rect x="5" width="1" height="39" fill="#D9D9D9" fill-opacity="0.7" />
                        <rect y="9" width="1" height="20" fill="#D9D9D9" fill-opacity="0.7" />
                    </svg>
                    <div class="logo d-none d-sm-block">
                        <a href="{{ route('contact.show') }}#plan" class="vs-btn style8">
                            <span>let’s plan</span>
                        </a>
                    </div>
                    <div class="logo d-sm-none">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/img/logo-bg-wide-white.webp') }}" alt="Morocco Quest"
                                class="logo" width="240" height="77">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--================= Header Area =================-->
<header class="vs-header layout1">
    <div class="sticky-wrapper position-relative">
        <div class="header-top-wrap">
            <div class="container custom-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-top">
                            <div class="row g-3 justify-content-between align-items-center">
                                <div class="col-md-6 d-none d-md-block">
                                    <div class="contact-info">
                                        <ul class="custom-ul">
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-phone-icon lucide-phone">
                                                    <path
                                                        d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                                                </svg>
                                                <a href="tel:+212654069718">+212654069718</a>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="4" height="22"
                                                    viewBox="0 0 4 22" fill="none">
                                                    <line x1="0.75" y1="2.774e-08" x2="0.749999"
                                                        y2="21.6114" stroke="white" stroke-opacity="0.3"
                                                        stroke-width="1.5" />
                                                    <line x1="3.5" y1="3.92926" x2="3.5"
                                                        y2="17.682" stroke="white" stroke-opacity="0.3" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-mail-icon lucide-mail">
                                                    <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                                                    <rect x="2" y="4" width="20" height="16" rx="2" />
                                                </svg>
                                                <a href="mailto:sales@morocco-quest.com">sales@morocco-quest.com</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="social-share">
                                        <span class="info-share">Follow on:</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="4" height="22"
                                            viewBox="0 0 4 22" fill="none">
                                            <line x1="0.75" y1="2.774e-08" x2="0.749999" y2="21.6114"
                                                stroke="white" stroke-opacity="0.3" stroke-width="1.5" />
                                            <line x1="3.5" y1="3.92941" x2="3.5" y2="17.6821"
                                                stroke="white" stroke-opacity="0.3" />
                                        </svg>
                                        <ul class="custom-ul">
                                            <li><a href="https://x.com/mounirakajia" target="_blank"
                                                    rel="noopener noreferrer" aria-label="Follow on X">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="lucide lucide-twitter-icon lucide-twitter">
                                                        <path
                                                            d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
                                                    </svg>
                                                </a></li>
                                            <li><a href="https://www.facebook.com/codesommetagency/" target="_blank"
                                                    rel="noopener noreferrer" aria-label="Follow on Facebook">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="lucide lucide-facebook-icon lucide-facebook">
                                                        <path
                                                            d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                                    </svg>
                                                </a></li>
                                            <li><a href="https://www.instagram.com/moroccoquestdmc/" target="_blank"
                                                    rel="noopener noreferrer" aria-label="Follow on Instagram">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="lucide lucide-instagram-icon lucide-instagram">
                                                        <rect width="20" height="20" x="2" y="2"
                                                            rx="5" ry="5" />
                                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                                        <line x1="17.5" x2="17.51" y1="6.5"
                                                            y2="6.5" />
                                                    </svg>
                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container custom-container">
            <div class="row justify-content-between align-items-center">
                <div class="col-xl-3 col-lg-auto">
                    <div class="header-logo d-flex justify-content-between align-items-center">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo-bg-wide.webp') }}"
                                alt="Morocco Quest" class="logo" width="240" height="77"></a>
                        <div class="d-flex align-items-center gap-3">
                            <button class="wc-link2 searchBoxTggler d-lg-none" aria-label="Open Search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
                                    viewBox="0 0 21 20" fill="none" aria-hidden="true">
                                    <path
                                        d="M20.4174 16.6954L17.2213 13.4773C19.3155 10.0703 18.8936 5.54217 15.9593 2.58766C12.5328 -0.862552 6.9769 -0.862552 3.55037 2.58766C0.123835 6.03787 0.123835 11.6322 3.55037 15.0824C6.5354 18.088 11.1341 18.4736 14.5333 16.2469L17.7019 19.4335C18.4521 20.1888 19.6711 20.1888 20.4213 19.4335C21.1675 18.6781 21.1675 17.4507 20.4174 16.6954ZM5.711 12.9029C3.48395 10.6604 3.48395 7.00959 5.711 4.76715C7.93805 2.52471 11.5638 2.52471 13.7909 4.76715C16.018 7.00959 16.018 10.6604 13.7909 12.9029C11.5638 15.1453 7.93805 15.1453 5.711 12.9029Z"
                                        fill="#F6F5F5" />
                                </svg>
                            </button>
                            <button class="vs-menu-toggle d-inline-block d-lg-none" aria-label="Open Mobile Menu">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-menu-icon lucide-menu">
                                    <path d="M4 12h16" />
                                    <path d="M4 18h16" />
                                    <path d="M4 6h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-auto d-none d-lg-flex justify-content-end gap-md-4 gap-xl-5">
                    <nav class="main-menu menu-style1 d-none d-lg-block">
                        <ul class="d-flex justify-content-center align-items-center">
                            <li class="menu-item-has-children">
                                <a href="{{ route('tours.multi_day') }}">Multi-Day Tours</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('tours.type', 'Garden Tours') }}">Garden Tours</a></li>
                                    <li><a href="{{ route('tours.type', 'Art Tours') }}">Art Tours</a></li>
                                    <li><a href="{{ route('tours.type', 'Classical Tours') }}">Classical Tours</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('activity-categories.index') }}">One-Day Tours</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('activities.byCategory', 'city-tours') }}">City Tours</a>
                                    </li>
                                    <li><a href="{{ route('activities.byCategory', 'day-trips') }}">Day Trips</a></li>
                                    <li><a href="{{ route('activities.byCategory', 'local-experiences') }}">Local
                                            Experiences</a></li>
                                    <li><a href="{{ route('activities.byCategory', 'outdoor-activities') }}">Outdoor
                                            Activities</a></li>
                                    <li><a
                                            href="{{ route('activities.byCategory', 'wellness-experiences') }}">Wellness</a>
                                    </li>
                                    <li><a href="{{ route('activities.byCategory', 'food-culinary-tours') }}">Food &
                                            Culinary Tours</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ url('/blog') }}">Blog</a>
                            </li>
                            <li>
                                <a href="{{ route('dmc.marrakech') }}">DMC</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Info Hub</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('/about') }}">About Us</a></li>
                                    <li><a href="{{ url('/faq') }}">FAQ</a></li>
                                    <li><a href="{{ url('/terms-and-conditions') }}">Terms & Conditions</a></li>
                                    <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ url('/contact') }}">Contact</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="header-wc style2">
                        <button class="wc-link2 searchBoxTggler" aria-label="Open Search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
                                viewBox="0 0 21 20" fill="none" aria-hidden="true">
                                <path
                                    d="M20.4174 16.6954L17.2213 13.4773C19.3155 10.0703 18.8936 5.54217 15.9593 2.58766C12.5328 -0.862552 6.9769 -0.862552 3.55037 2.58766C0.123835 6.03787 0.123835 11.6322 3.55037 15.0824C6.5354 18.088 11.1341 18.4736 14.5333 16.2469L17.7019 19.4335C18.4521 20.1888 19.6711 20.1888 20.4213 19.4335C21.1675 18.6781 21.1675 17.4507 20.4174 16.6954ZM5.711 12.9029C3.48395 10.6604 3.48395 7.00959 5.711 4.76715C7.93805 2.52471 11.5638 2.52471 13.7909 4.76715C16.018 7.00959 16.018 10.6604 13.7909 12.9029C11.5638 15.1453 7.93805 15.1453 5.711 12.9029Z"
                                    fill="#F6F5F5" />
                            </svg>
                        </button>
                        <svg xmlns="http://www.w3.org/2000/svg" width="6" height="39" viewBox="0 0 6 39"
                            fill="none" aria-hidden="true">
                            <rect x="5" width="1" height="39" fill="#D9D9D9" fill-opacity="0.7" />
                            <rect y="9" width="1" height="20" fill="#D9D9D9" fill-opacity="0.7" />
                        </svg>
                        <a href="{{ url('/contact') }}#plan" class="vs-btn style8">
                            <span>let’s plan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--================= Header Area end =================-->

<style>
    .vs-blog-box .blog-share .share-list li {
        margin-right: 10px;
    }

    .vs-blog-box .blog-share .share-list {
        background: whitesmoke
    }

    .vs-mobile-menu ul .vs-item-has-children>a .vs-mean-expand::before {
        content: "\f63b";
        /* Unicode for Bootstrap Icons 'dash' */
        font-family: "bootstrap-icons";
        font-weight: normal;
        font-style: normal;
        display: inline-block;
        font-size: 1rem;
        /* Adjust size if needed */
    }

    .vs-mobile-menu ul .vs-item-has-children>a .vs-mean-expand::before {
        content: "\f4fe";
        /* Bootstrap Icons: plus */
        font-family: "bootstrap-icons";
        font-style: normal;
        font-weight: normal;
        display: inline-block;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .vs-mobile-menu ul .vs-item-has-children.open>a .vs-mean-expand::before {
        content: "\f63b";
        /* Bootstrap Icons: dash (minus) */
    }

    .vs-mobile-menu ul li a::before {
        content: "\f285";
        /* bi-chevron-right */
        font-family: "bootstrap-icons";
        font-style: normal;
        font-weight: normal;
        display: inline-block;
        margin-right: 10px;
        position: relative;
        font-size: 1rem;
    }

    .custom-ul .lucide-phone,
    .custom-ul .lucide-mail {
        stroke: #bb5e2a;
    }

    .main-menu ul.sub-menu li a::before {
        content: "\f285";
        /* Bootstrap Icons: chevron-right */
        font-family: "bootstrap-icons";
        font-style: normal;
        font-weight: normal;
        display: inline-block;
        font-size: 1rem;
        margin-right: 10px;
        position: relative;
    }

    .share-list .pinterest i {
        position: relative;
        top: -9px;
        /* Adjust value as needed */
</style>
