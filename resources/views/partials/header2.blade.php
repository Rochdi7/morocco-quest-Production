{{-- resources/views/partials/header2.blade.php --}}

<!--================= Mobile Menu =================-->
<div class="vs-menu-wrapper">
    <div class="vs-menu-area text-center">
        <div class="mobile-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/img/logo-bg-wide-white.webp') }}" alt="Morocco Quest" class="logo"
                    loading="lazy" width="240" height="96">
            </a>
            <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
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
                    <a href="{{ route('experiences.index') }}">One-Day Tours</a>
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
                <li class="menu-item-has-children">
                    <a href="{{ route('dmc.marrakech') }}">DMC</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('dmc.marrakech') }}">DMC Marrakech</a></li>
                        <li><a href="{{ route('meetings-conventions.management') }}">Meetings & Conventions Management</a></li>
                        <li><a href="{{ route('team-building.marrakech') }}">Team Building & Incentive Travel</a></li>
                        <li><a href="{{ route('events-production.morocco') }}">Events Production & Communication</a></li>
                        <li><a href="{{ route('congress-organization.morocco') }}">Professional Congress Organization</a></li>
                        <li><a href="{{ route('destination-management.company') }}">Destination Management Company</a></li>
                        <li><a href="{{ route('sustainable-events.morocco') }}">Sustainable Events</a></li>
                        <li><a href="{{ route('360-solutions.morocco') }}">360° Event & Travel Solutions</a></li>
                    </ul>
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

<div class="popup-search-box">
    <button class="searchClose"><i class="fal fa-times"></i></button>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" class="border-theme" placeholder="What are you looking for" required
            aria-label="Search input">
        <button type="submit" aria-label="Submit search"><i class="fal fa-search"></i></button>
    </form>
</div>

{{-- This 'sticky navbar' might be integrated with the header below in some theme JS logic. --}}
{{-- Kept structurally, but menu items updated. --}}
<!-- ================= Sticky Navbar ================= -->
<div id="navbars" class="header-sticky navbars">
    <div class="container custom-container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto col-lg-2">
                <button class="vs-menu-toggle d-inline-block d-lg-none">
                    <i class="fal fa-bars"></i>
                </button>
                <div class="logo d-none d-lg-block">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/img/logo-bg-wide-white.webp') }}" alt="Morocco Quest"
                            class="logo" />
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
                            <a href="{{ route('experiences.index') }}">One-Day Tours</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('activities.byCategory', 'city-tours') }}">City Tours</a></li>
                                <li><a href="{{ route('activities.byCategory', 'day-trips') }}">Day Trips</a></li>
                                <li><a href="{{ route('activities.byCategory', 'local-experiences') }}">Local
                                        Experiences</a></li>
                                <li><a href="{{ route('activities.byCategory', 'outdoor-activities') }}">Outdoor
                                        Activities</a></li>
                                <li><a href="{{ route('activities.byCategory', 'wellness-experiences') }}">Wellness</a>
                                </li>
                                <li><a href="{{ route('activities.byCategory', 'food-culinary-tours') }}">Food &
                                        Culinary Tours</a></li>
                            </ul>
                        </li>

                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('dmc.marrakech') }}">DMC</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('dmc.marrakech') }}">DMC Marrakech</a></li>
                                <li><a href="{{ route('meetings-conventions.management') }}">Meetings & Conventions Management</a></li>
                                <li><a href="{{ route('team-building.marrakech') }}">Team Building & Incentive Travel</a></li>
                                <li><a href="{{ route('events-production.morocco') }}">Events Production & Communication</a></li>
                                <li><a href="{{ route('congress-organization.morocco') }}">Professional Congress Organization</a></li>
                                <li><a href="{{ route('destination-management.company') }}">Destination Management Company</a></li>
                                <li><a href="{{ route('sustainable-events.morocco') }}">Sustainable Events</a></li>
                                <li><a href="{{ route('360-solutions.morocco') }}">360° Event & Travel Solutions</a></li>
                            </ul>
                        </li>

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
                            class="logo" />
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
                                class="logo" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--================= Header Area =================-->
<header class="vs-header layout2">
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
                                                <i class="fa-solid fa-phone-volume"></i>
                                                <a href="tel:+212654069718">+212654069718</a>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="4" height="22"
                                                    viewBox="0 0 4 22" fill="none" aria-hidden="true">
                                                    <line x1="0.75" y1="2.774e-08" x2="0.749999"
                                                        y2="21.6114" stroke="white" stroke-opacity="0.3"
                                                        stroke-width="1.5" />
                                                    <line x1="3.5" y1="3.92926" x2="3.5"
                                                        y2="17.682" stroke="white" stroke-opacity="0.3" />
                                                </svg>
                                            </li>
                                            <li>
                                                <i class="fa-solid fa-envelope"></i>
                                                <a href="mailto:sales@morocco-quest.com">sales@morocco-quest.com</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="social-share">
                                        <span class="info-share">Follow on:</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="4" height="22"
                                            viewBox="0 0 4 22" fill="none" aria-hidden="true">
                                            <line x1="0.75" y1="2.774e-08" x2="0.749999" y2="21.6114"
                                                stroke="white" stroke-opacity="0.3" stroke-width="1.5" />
                                            <line x1="3.5" y1="3.92941" x2="3.5" y2="17.6821"
                                                stroke="white" stroke-opacity="0.3" />
                                        </svg>
                                        <ul class="custom-ul">
                                            <li><a href="https://x.com/mounirakajia" target="_blank"
                                                    rel="noopener noreferrer" aria-label="Follow on X"><i
                                                        class="fa-brands fa-x-twitter"></i></a></li>
                                            <li><a href="https://www.facebook.com/profile.php?id=61578772746041" target="_blank"
                                                    rel="noopener noreferrer" aria-label="Follow on Facebook"><i
                                                        class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="https://www.instagram.com/moroccoquestdmc/" target="_blank"
                                                    rel="noopener noreferrer" aria-label="Follow on Instagram"><i
                                                        class="fa-brands fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container custom-container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-3 col-lg-auto">
                        <div class="header-logo d-flex justify-content-between align-items-center">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('assets/img/logo-bg-wide.webp') }}" alt="Morocco Quest"
                                    class="logo" width="240" height="96">
                            </a>
                            <div class="d-flex align-items-center gap-3">
                                <button class="wc-link2 searchBoxTggler d-lg-none" aria-label="Open Search">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
                                        viewBox="0 0 21 20" fill="none" aria-hidden="true">
                                        <path
                                            d="M20.4174 16.6954L17.2213 13.4773C19.3155 10.0703 18.8936 5.54217 15.9593 2.58766C12.5328 -0.862552 6.9769 -0.862552 3.55037 2.58766C0.123835 6.03787 0.123835 11.6322 3.55037 15.0824C6.5354 18.088 11.1341 18.4736 14.5333 16.2469L17.7019 19.4335C18.4521 20.1888 19.6711 20.1888 20.4213 19.4335C21.1675 18.6781 21.1675 17.4507 20.4174 16.6954ZM5.711 12.9029C3.48395 10.6604 3.48395 7.00959 5.711 4.76715C7.93805 2.52471 11.5638 2.52471 13.7909 4.76715C16.018 7.00959 16.018 10.6604 13.7909 12.9029C11.5638 15.1453 7.93805 15.1453 5.711 12.9029Z"
                                            fill="#141414" />
                                    </svg>
                                </button>
                                <button class="vs-menu-toggle style2 d-inline-block d-lg-none"
                                    aria-label="Open Mobile Menu">
                                    <i class="fal fa-bars"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-auto d-none d-lg-flex justify-content-end gap-md-4 gap-xl-5">
                        <nav class="main-menu menu-style1 v2 d-none d-lg-block">
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
                                    <a href="{{ route('experiences.index') }}">One-Day Tours</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('activities.byCategory', 'city-tours') }}">City
                                                Tours</a></li>
                                        <li><a href="{{ route('activities.byCategory', 'day-trips') }}">Day Trips</a>
                                        </li>
                                        <li><a href="{{ route('activities.byCategory', 'local-experiences') }}">Local
                                                Experiences</a></li>
                                        <li><a href="{{ route('activities.byCategory', 'outdoor-activities') }}">Outdoor
                                                Activities</a></li>
                                        <li><a
                                                href="{{ route('activities.byCategory', 'wellness-experiences') }}">Wellness</a>
                                        </li>
                                        <li><a href="{{ route('activities.byCategory', 'food-culinary-tours') }}">Food
                                                & Culinary Tours</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ url('/blog') }}">Blog</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="{{ route('dmc.marrakech') }}">DMC</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('dmc.marrakech') }}">DMC Marrakech</a></li>
                                        <li><a href="{{ route('meetings-conventions.management') }}">Meetings & Conventions Management</a></li>
                                        <li><a href="{{ route('team-building.marrakech') }}">Team Building & Incentive Travel</a></li>
                                        <li><a href="{{ route('events-production.morocco') }}">Events Production & Communication</a></li>
                                        <li><a href="{{ route('congress-organization.morocco') }}">Professional Congress Organization</a></li>
                                        <li><a href="{{ route('destination-management.company') }}">Destination Management Company</a></li>
                                        <li><a href="{{ route('sustainable-events.morocco') }}">Sustainable Events</a></li>
                                        <li><a href="{{ route('360-solutions.morocco') }}">360° Event & Travel Solutions</a></li>
                                    </ul>
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
                                    viewBox="0 0 21 20" fill="none" class="text-title-color" aria-hidden="true">
                                    <path
                                        d="M20.4174 16.6954L17.2213 13.4773C19.3155 10.0703 18.8936 5.54217 15.9593 2.58766C12.5328 -0.862552 6.9769 -0.862552 3.55037 2.58766C0.123835 6.03787 0.123835 11.6322 3.55037 15.0824C6.5354 18.088 11.1341 18.4736 14.5333 16.2469L17.7019 19.4335C18.4521 20.1888 19.6711 20.1888 20.4213 19.4335C21.1675 18.6781 21.1675 17.4507 20.4174 16.6954ZM5.711 12.9029C3.48395 10.6604 3.48395 7.00959 5.711 4.76715C7.93805 2.52471 11.5638 2.52471 13.7909 4.76715C16.018 7.00959 16.018 10.6604 13.7909 12.9029C11.5638 15.1453 7.93805 15.1453 5.711 12.9029Z"
                                        fill="currentColor" />
                                </svg>
                            </button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="6" height="39" viewBox="0 0 6 39"
                                fill="none" aria-hidden="true">
                                <rect x="5" width="1" height="39" fill="#9A9696" fill-opacity="0.7" />
                                <rect y="9" width="1" height="20" fill="#9A9696" fill-opacity="0.7" />
                            </svg>
                            <a href="{{ url('/contact') }}#plan" class="vs-btn style8">
                                <span>let’s plan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

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
