{{-- resources/views/partials/header2.blade.php --}}

<!--=================
    Mobile Menu
================= -->
<div class="vs-menu-wrapper">
  <div class="vs-menu-area text-center">
    <div class="mobile-logo">
      {{-- Use route() for home link, asset() for image --}}
      <a href="{{ route('home') }}">
          <img src="{{ asset('assets/img/logo.svg') }}" alt="Tripix Logo" class="logo"/>
      </a>
      <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
    </div>
    <div class="vs-mobile-menu">
        {{-- Mobile menu links - keep static for now or replace with dynamic logic later --}}
      <ul>
        <li class="menu-item-has-children">
          <a href="#">Home</a>
          <ul class="sub-menu">
            <li><a href="{{ route('home') }}">Home 1</a></li> {{-- Example route --}}
            <li><a href="#">Home 2</a></li> {{-- Placeholder --}}
            <li><a href="#">Home 3</a></li> {{-- Placeholder --}}
          </ul>
        </li>
        <li class="menu-item-has-children">
          <a href="#">Destinations</a> {{-- Use route('tours.index') if applicable --}}
          <ul class="sub-menu">
            <li><a href="#">Destinations</a></li>
            <li><a href="#">Destination Details</a></li>
          </ul>
        </li>
        <li class="menu-item-has-children mega-menu-wrap">
          <a href="javascript:void(0)">Pages</a>
          <ul class="mega-menu">
            <li>
              <a href="javascript:void(0)">Page List 1</a>
              <ul>
                <li><a href="{{ route('home') }}">Home 1</a></li>
                <li><a href="#">Home 2</a></li>
                <li><a href="#">Home 3</a></li>
                <li><a href="#">About</a></li>
              </ul>
            </li>
            <li>
              <a href="javascript:void(0)">Page List 2</a>
              <ul>
                <li><a href="#">Faq's</a></li>
                <li><a href="#">Activities</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Blog Details</a></li>
              </ul>
            </li>
            <li>
              <a href="javascript:void(0)">Page List 3</a>
              <ul>
                <li><a href="#">Trips</a></li>
                <li><a href="#">Destinations</a></li>
                <li><a href="#">Destination Details</a></li>
                <li><a href="#">404 Error</a></li>
              </ul>
            </li>
            <li>
              <a href="javascript:void(0)">Page List 4</a>
              <ul>
                <li><a href="#">Contact Us</a></li> {{-- Use route('contact') if defined --}}
              </ul>
            </li>
          </ul>
        </li>
        <li class="menu-item-has-children">
          <a href="#">Blog</a> {{-- Use route('blog.index') if applicable --}}
          <ul class="sub-menu">
            <li><a href="#">Blog</a></li>
            <li><a href="#">Blog Details</a></li>
          </ul>
        </li>
        <li class="menu-item-has-children">
          <a href="#">Faq's</a> {{-- Use route('faq') if defined --}}
        </li>
        <li>
          <a href="#">Contact</a> {{-- Use route('contact') if defined --}}
        </li>
      </ul>
    </div>
  </div>
</div>

<!-- =================
    Popup Search Box
================= -->
<div class="popup-search-box">
  <button class="searchClose"><i class="fal fa-times"></i></button>
  {{-- Use route for search action if you have one --}}
  <form action="#" method="GET"> {{-- Example search route --}}
    <input
      type="text"
      name="query" {{-- Added name attribute for form submission --}}
      class="border-theme"
      placeholder="What are you looking for"
      required {{-- Added required --}}
    />
    <button type="submit"><i class="fal fa-search"></i></button>
  </form>
</div>

{{-- This 'sticky navbar' seems redundant if the main header below is sticky. Check your theme's logic. --}}
{{-- Keeping it structurally for now. --}}
<!-- =================
    Sticky Navbar (Might be integrated with header below in theme logic)
================= -->
<div id="navbars" class="header-sticky navbars">
    <div class="container custom-container">
      <div class="row justify-content-between align-items-center">
        <div class="col-auto col-lg-2">
          <button class="vs-menu-toggle d-inline-block d-lg-none">
            <i class="fal fa-bars"></i>
          </button>
          <div class="logo d-none d-lg-block">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="Tripix Logo" class="logo"/>
            </a>
          </div>
        </div>
        <div class="col-xl-auto col-lg-auto col-sm-3 d-none d-sm-block">
          <nav class="main-menu d-none d-lg-block">
              {{-- Desktop Menu Links (Repeated - keep static for now) --}}
            <ul>
              <li class="menu-item-has-children">
                <a href="{{ route('home') }}">Home</a>
                <ul class="sub-menu">
                  <li><a href="{{ route('home') }}">Home 1</a></li>
                  <li><a href="#">Home 2</a></li>
                  <li><a href="#">Home 3</a></li>
                </ul>
              </li>
              <li class="menu-item-has-children">
                <a href="#">Destinations</a>
                <ul class="sub-menu">
                  <li><a href="#">Destinations</a></li>
                  <li><a href="#">Destination Details</a></li>
                </ul>
              </li>
              <li class="menu-item-has-children mega-menu-wrap">
                <a href="javascript:void(0)">Pages</a>
                <ul class="mega-menu">
                  <li>
                    <a href="#">Page List 1</a>
                    <ul>
                      <li><a href="{{ route('home') }}">Home 1</a></li>
                      <li><a href="#">Home 2</a></li>
                      <li><a href="#">Home 3</a></li>
                      <li><a href="#">About</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="#">Page List 2</a>
                    <ul>
                      <li><a href="#">Faq's</a></li>
                      <li><a href="#">Activities</a></li>
                      <li><a href="#">Blog</a></li>
                      <li><a href="#">Blog Details</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="#">Page List 3</a>
                    <ul>
                      <li><a href="#">Trip</a></li>
                      <li><a href="#">Destinations</a></li>
                      <li><a href="#">Destination Details</a></li>
                      <li><a href="#">404 Error</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="#">Page List 4</a>
                    <ul>
                      <li><a href="#">Contact Us</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="menu-item-has-children">
                <a href="#">blog</a>
                <ul class="sub-menu">
                  <li><a href="#">blog</a></li>
                  <li><a href="#">Blog Details</a></li>
                </ul>
              </li>
              <li class="menu-item-has-children">
                <a href="#">Faq's</a>
              </li>
              <li>
                <a href="#">Contact</a>
              </li>
            </ul>
          </nav>
          <div class="logo d-lg-none">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="Tripix Logo" class="logo"/>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-md-auto col-auto">
          <div class="header-wc style2">
            <button class="wc-link2 searchBoxTggler text-title-color">
              {{-- SVG Icon --}}
              <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                  <path d="M20.4174 16.6954L17.2213 13.4773C19.3155 10.0703 18.8936 5.54217 15.9593 2.58766C12.5328 -0.862552 6.9769 -0.862552 3.55037 2.58766C0.123835 6.03787 0.123835 11.6322 3.55037 15.0824C6.5354 18.088 11.1341 18.4736 14.5333 16.2469L17.7019 19.4335C18.4521 20.1888 19.6711 20.1888 20.4213 19.4335C21.1675 18.6781 21.1675 17.4507 20.4174 16.6954ZM5.711 12.9029C3.48395 10.6604 3.48395 7.00959 5.711 4.76715C7.93805 2.52471 11.5638 2.52471 13.7909 4.76715C16.018 7.00959 16.018 10.6604 13.7909 12.9029C11.5638 15.1453 7.93805 15.1453 5.711 12.9029Z" fill="#F6F5F5"></path>
              </svg>
            </button>
            {{-- SVG Divider --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="6" height="39" viewBox="0 0 6 39" fill="none">
              <rect x="5" width="1" height="39" fill="#D9D9D9" fill-opacity="0.7"></rect>
              <rect y="9" width="1" height="20" fill="#D9D9D9" fill-opacity="0.7"></rect>
            </svg>
            <div class="logo d-none d-sm-block">
              {{-- Use route() if you have a specific "plan" route --}}
              <a href="{{ route('contact') }}" class="vs-btn style10"> {{-- Example: link to contact --}}
                <span>let’s plan</span>
              </a>
            </div>
            <div class="logo d-sm-none">
              <a href="{{ route('home') }}">
                  <img src="{{ asset('assets/img/logo.svg') }}" alt="Tripix Logo" class="logo"/>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<!--================= Header Area =================-->
<header class="vs-header layout2">
  <!-- Main Menu Area -->
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
                        {{-- Add dynamic contact info from settings/config later if needed --}}
                        <a href="tel:+13334568890">+1 333.456.8890</a>
                      </li>
                      <li>
                        {{-- SVG Divider --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="4" height="22" viewBox="0 0 4 22" fill="none">
                           <line x1="0.75" y1="2.774e-08" x2="0.749999" y2="21.6114" stroke="white" stroke-opacity="0.3" stroke-width="1.5"/>
                           <line x1="3.5" y1="3.92926" x2="3.5" y2="17.682" stroke="white" stroke-opacity="0.3"/>
                        </svg>
                      </li>
                      <li>
                        <i class="fa-solid fa-envelope"></i>
                        <a href="mailto:info@example.com">info@example.com</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="social-share">
                    <span class="info-share">Follow on:</span>
                     {{-- SVG Divider --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="4" height="22" viewBox="0 0 4 22" fill="none">
                       <line x1="0.75" y1="2.774e-08" x2="0.749999" y2="21.6114" stroke="white" stroke-opacity="0.3" stroke-width="1.5"/>
                       <line x1="3.5" y1="3.92941" x2="3.5" y2="17.6821" stroke="white" stroke-opacity="0.3"/>
                    </svg>
                    <ul class="custom-ul">
                      {{-- Add dynamic social links later if needed --}}
                      <li><a href="https://x.com/" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
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
              <a href="{{ route('home') }}">
                  <img src="{{ asset('assets/img/logo-v2.svg') }}" alt="Tripix Logo V2" class="logo"/>
              </a>
              <div class="d-flex align-items-center gap-3">
                <button class="wc-link2 searchBoxTggler d-lg-none">
                    {{-- SVG Icon --}}
                   <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                      <path d="M20.4174 16.6954L17.2213 13.4773C19.3155 10.0703 18.8936 5.54217 15.9593 2.58766C12.5328 -0.862552 6.9769 -0.862552 3.55037 2.58766C0.123835 6.03787 0.123835 11.6322 3.55037 15.0824C6.5354 18.088 11.1341 18.4736 14.5333 16.2469L17.7019 19.4335C18.4521 20.1888 19.6711 20.1888 20.4213 19.4335C21.1675 18.6781 21.1675 17.4507 20.4174 16.6954ZM5.711 12.9029C3.48395 10.6604 3.48395 7.00959 5.711 4.76715C7.93805 2.52471 11.5638 2.52471 13.7909 4.76715C16.018 7.00959 16.018 10.6604 13.7909 12.9029C11.5638 15.1453 7.93805 15.1453 5.711 12.9029Z" fill="#141414"></path>
                   </svg>
                </button>
                <button class="vs-menu-toggle style2 d-inline-block d-lg-none">
                  <i class="fal fa-bars"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="col-xl-9 col-lg-auto d-none d-lg-flex justify-content-end gap-md-4 gap-xl-5">
            <nav class="main-menu menu-style1 v2 d-none d-lg-block">
                {{-- Desktop Menu (Repeated structure - keep static or make dynamic) --}}
              <ul class="d-flex justify-content-center align-items-center">
                <li class="menu-item-has-children">
                  <a href="{{ route('home') }}">Home</a>
                  <ul class="sub-menu">
                    <li><a href="{{ route('home') }}">Home 1</a></li>
                    <li><a href="#">Home 2</a></li>
                    <li><a href="#">Home 3</a></li>
                  </ul>
                </li>
                <li class="menu-item-has-children">
                  <a href="#">Destinations</a> {{-- Use route('tours.index') if applicable --}}
                  <ul class="sub-menu">
                    <li><a href="#">Destinations</a></li>
                    <li><a href="#">Destination Details</a></li>
                  </ul>
                </li>
                <li class="menu-item-has-children mega-menu-wrap">
                  <a href="javascript:void(0)">Pages</a>
                  <ul class="mega-menu">
                    <li>
                      <a href="#">Page List 1</a>
                      <ul>
                        <li><a href="{{ route('home') }}">Home 1</a></li>
                        <li><a href="#">Home 2</a></li>
                        <li><a href="#">Home 3</a></li>
                        <li><a href="#">About</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="#">Page List 2</a>
                      <ul>
                        <li><a href="#">Faq's</a></li>
                        <li><a href="#">Activities</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Blog Details</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="#">Page List 3</a>
                      <ul>
                        <li><a href="#">Trips</a></li>
                        <li><a href="#">Destinations</a></li>
                        <li><a href="#">Destination Details</a></li>
                        <li><a href="#">404 Error</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="#">Page List 4</a>
                      <ul>
                        <li><a href="#">Contact Us</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class="menu-item-has-children">
                  <a href="#">blog</a> {{-- Use route('blog.index') if applicable --}}
                  <ul class="sub-menu">
                    <li><a href="#">blog</a></li>
                    <li><a href="#">blog details</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#">Faq’s</a> {{-- Use route('faq') if defined --}}
                </li>
                <li>
                  <a href="#">Contact</a> {{-- Use route('contact') if defined --}}
                </li>
              </ul>
            </nav>
            <div class="header-wc style2">
              <button class="wc-link2 searchBoxTggler">
                  {{-- SVG Icon --}}
                 <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none" class="text-title-color">
                    <path d="M20.4174 16.6954L17.2213 13.4773C19.3155 10.0703 18.8936 5.54217 15.9593 2.58766C12.5328 -0.862552 6.9769 -0.862552 3.55037 2.58766C0.123835 6.03787 0.123835 11.6322 3.55037 15.0824C6.5354 18.088 11.1341 18.4736 14.5333 16.2469L17.7019 19.4335C18.4521 20.1888 19.6711 20.1888 20.4213 19.4335C21.1675 18.6781 21.1675 17.4507 20.4174 16.6954ZM5.711 12.9029C3.48395 10.6604 3.48395 7.00959 5.711 4.76715C7.93805 2.52471 11.5638 2.52471 13.7909 4.76715C16.018 7.00959 16.018 10.6604 13.7909 12.9029C11.5638 15.1453 7.93805 15.1453 5.711 12.9029Z" fill="currentColor"/>
                 </svg>
              </button>
               {{-- SVG Divider --}}
              <svg xmlns="http://www.w3.org/2000/svg" width="6" height="39" viewBox="0 0 6 39" fill="none">
                <rect x="5" width="1" height="39" fill="#9A9696" fill-opacity="0.7"/>
                <rect y="9" width="1" height="20" fill="#9A9696" fill-opacity="0.7"/>
              </svg>
               {{-- Link button - update href/route as needed --}}
              <a href="#" class="vs-btn style8"> {{-- Placeholder link --}}
                <span>let’s plan</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!--================= Header Area end =================-->

{{-- The <main class="main"> tag should be opened in your main layout file BEFORE including this header --}}
{{-- and closed in your main layout file AFTER @yield('content') --}}

{{-- The Preloader also likely belongs in the main layout file, outside the header partial --}}
{{-- <div class="preloader"> ... </div> should be moved to layouts/app.blade.php --}}