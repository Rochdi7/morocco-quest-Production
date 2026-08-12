{{-- resources/views/partials/footer.blade.php --}}
<style>
.footer-logo-img{width:auto;height:120px}
@media(max-width:767px){.footer-logo-img{height:45px}}
</style>

<!-- ================= Footer Start ================= -->
<footer class="vs-footer-style1" data-bg-src="{{ asset('assets/img/footer/footer-style1-bg.png') }}">
    <div class="footer-top space-top">
        <div class="container">
            <div class="row gx-4">
                <div class="col-12">
                    <div class="footer-cta bg-third-theme-color fade-anim"
                        data-bg-src="{{ asset('assets/img/footer/footer-cta-bg.png') }}">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-8">
                                <div class="cta-contact-items">
                                    <div class="contact-item">
                                        <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-map-pin-icon lucide-map-pin">
                                                <path
                                                    d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                                <circle cx="12" cy="10" r="3" />
                                            </svg></span>
                                        <div class="info">
                                            <h3 class="info-title text-white-color">Location</h3>
                                            <p>Khalid Ibn Al Walid Street, Gueliz, Marrakech, 40000, Morocco</p>
                                        </div>
                                    </div>
                                    <div class="contact-item">
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-phone-icon lucide-phone">
                                                <path
                                                    d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                                            </svg>
                                        </span>
                                        <div class="info">
                                            <h3 class="info-title text-white-color">Contact Us</h3>
                                            <p>
                                                <a href="mailto:sales@morocco-quest.com"
                                                    aria-label="Email Morocco Quest at sales@morocco-quest.com">sales@morocco-quest.com</a>
                                                <a href="tel:+212654069718"
                                                    aria-label="Call Morocco Quest at +212654069718">+212654069718</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-lg-4 d-flex justify-content-center justify-content-lg-end btn-trigger btn-bounce">
                                <a href="{{ url('/contact') }}#booking" class="vs-btn style6">
                                    <span>Book Your Tour Now</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-center space-extra">
        <div class="container">
            <div class="row gx-4 gy-4 gx-xl-2 justify-content-between">
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="footer-widgets">
                        <a href="{{ url('/') }}" class="logo-footer">
                            <img src="{{ asset('assets/img/logo-bg-wide-white.webp') }}"
                                alt="Morocco Quest Homepage Logo" class="footer-logo-img" loading="lazy"
                                width="300" height="120">
                        </a>
                        <div class="social-media">
                            <ul class="custom-ul">
                                <li><a href="https://www.facebook.com/profile.php?id=61578772746041" target="_blank"
                                        rel="nofollow noopener noreferrer" aria-label="Follow Morocco Quest on Facebook">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-facebook-icon lucide-facebook">
                                            <path
                                                d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                        </svg>
                                    </a></li>
                                <li><a href="https://x.com/mounirakajia" target="_blank" rel="nofollow noopener noreferrer"
                                        aria-label="Follow Morocco Quest on X (Twitter)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-twitter-icon lucide-twitter">
                                            <path
                                                d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
                                        </svg></a></li>
                                <li><a href="https://www.instagram.com/moroccoquestdmc/" target="_blank"
                                        rel="nofollow noopener noreferrer" aria-label="Follow Morocco Quest on Instagram">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-instagram-icon lucide-instagram">
                                            <rect width="20" height="20" x="2" y="2" rx="5"
                                                ry="5" />
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                                        </svg>
                                    </a></li>
                            </ul>
                        </div>
                        <p class="mt-4 mb-3 text-color-5">
                            Stay connected for future updates & offers.
                        </p>
                        <div class="newsletter">
                            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="w100">
                                @csrf
                                @if (config('recaptcha.enabled') && config('recaptcha.site_key'))
                                    <div class="g-recaptcha mb-2" data-sitekey="{{ config('recaptcha.site_key') }}"></div>
                                @endif
                                <input type="email" name="email" class="form-control"
                                    placeholder="Enter Email Address" required aria-label="Newsletter Email Input">
                                <button type="submit" class="text-uppercase text-color-5"
                                    aria-label="Subscribe to Newsletter">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevrons-right-icon lucide-chevrons-right">
                                        <path d="m6 17 5-5-5-5" />
                                        <path d="m13 17 5-5-5-5" />
                                    </svg>
                                    <span>Subscribe now</span>
                                </button>
                            </form>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                @if (session('success'))
                                    Toastify({
                                        text: "{{ session('success') }}",
                                        duration: 4000,
                                        gravity: "top",
                                        position: "right",
                                        backgroundColor: "#4caf50",
                                        stopOnFocus: true
                                    }).showToast();
                                @endif
                                @if ($errors->any())
                                    Toastify({
                                        text: "{{ $errors->first() }}",
                                        duration: 4000,
                                        gravity: "top",
                                        position: "right",
                                        backgroundColor: "#f44336",
                                        stopOnFocus: true
                                    }).showToast();
                                @endif
                            });
                        </script>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4 order-md-3 order-lg-2">
                    <div class="footer-widgets">
                        <h3 class="widgets-title text-white-color text-capitalize">Useful Links</h3>
                        <div class="row gx-xl-2 g-2">
                            <div class="col-md-6">
                                <div class="footer-links">
                                    <ul class="custom-ul">
                                        <li>
                                            <a href="https://www.acces-maroc.ma" target="_blank"
                                                rel="noopener noreferrer nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-chevrons-right-icon lucide-chevrons-right">
                                                    <path d="m6 17 5-5-5-5" />
                                                    <path d="m13 17 5-5-5-5" />
                                                </svg>
                                                Morocco e-Visa
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://visaguide.world/africa/morocco-visa/" target="_blank"
                                                rel="noopener noreferrer nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-chevrons-right-icon lucide-chevrons-right">
                                                    <path d="m6 17 5-5-5-5" />
                                                    <path d="m13 17 5-5-5-5" />
                                                </svg>
                                                Visa Requirements
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.xe.com/currencyconverter/" target="_blank"
                                                rel="noopener noreferrer nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-chevrons-right-icon lucide-chevrons-right">
                                                    <path d="m6 17 5-5-5-5" />
                                                    <path d="m13 17 5-5-5-5" />
                                                </svg>
                                                Currency Converter
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.accuweather.com/en/ma/morocco-weather"
                                                target="_blank" rel="noopener noreferrer nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-chevrons-right-icon lucide-chevrons-right">
                                                    <path d="m6 17 5-5-5-5" />
                                                    <path d="m13 17 5-5-5-5" />
                                                </svg>
                                                Weather Forecast
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.thebrokebackpacker.com/what-to-pack-for-morocco/"
                                                target="_blank" rel="noopener noreferrer nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-chevrons-right-icon lucide-chevrons-right">
                                                    <path d="m6 17 5-5-5-5" />
                                                    <path d="m13 17 5-5-5-5" />
                                                </svg>
                                                Packing Guide
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="footer-links">
                                    <ul class="custom-ul">
                                        <li>
                                            <a href="https://www.travelinsurance.com/" target="_blank"
                                                rel="noopener noreferrer nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-chevrons-right-icon lucide-chevrons-right">
                                                    <path d="m6 17 5-5-5-5" />
                                                    <path d="m13 17 5-5-5-5" />
                                                </svg>
                                                Travel Insurance
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.iatatravelcentre.com/world.php" target="_blank"
                                                rel="noopener noreferrer nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-chevrons-right-icon lucide-chevrons-right">
                                                    <path d="m6 17 5-5-5-5" />
                                                    <path d="m13 17 5-5-5-5" />
                                                </svg>
                                                COVID-19 Info
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.who.int/countries/mar/" target="_blank"
                                                rel="noopener noreferrer nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-chevrons-right-icon lucide-chevrons-right">
                                                    <path d="m6 17 5-5-5-5" />
                                                    <path d="m13 17 5-5-5-5" />
                                                </svg>
                                                Travel Health
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.intrepidtravel.com/adventures/morocco-travel-tips/"
                                                target="_blank" rel="noopener noreferrer nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-chevrons-right-icon lucide-chevrons-right">
                                                    <path d="m6 17 5-5-5-5" />
                                                    <path d="m13 17 5-5-5-5" />
                                                </svg>
                                                Travel Tips
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.power-plugs-sockets.com/morocco/" target="_blank"
                                                rel="noopener noreferrer nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-chevrons-right-icon lucide-chevrons-right">
                                                    <path d="m6 17 5-5-5-5" />
                                                    <path d="m13 17 5-5-5-5" />
                                                </svg>
                                                Electrical Plugs
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3 order-md-2 order-lg-3">
                    <div class="footer-widgets">
                        <h3 class="widgets-title text-white-color text-capitalize">Instagram Feed</h3>
                        <div class="instagram">
                            <a href="https://www.instagram.com/moroccoquestdmc/" target="_blank"
                                rel="nofollow noopener noreferrer" aria-label="View Morocco Desert Camp"
                                class="instagram-post">
                                <img src="{{ asset('assets/img/Desert-Camp-Morocco-Sunset-View-Lanterns-Palm-Trees.webp') }}"
                                    alt="Desert Camp Morocco Sunset View Lanterns Palm Trees"
                                    class="w-100 instagram-1" loading="lazy" width="150" height="150">
                            </a>
                            <a href="https://www.instagram.com/moroccoquestdmc/" target="_blank"
                                rel="nofollow noopener noreferrer" aria-label="View Luxury Dinner Setup Morocco"
                                class="instagram-post">
                                <img src="{{ asset('assets/img/Luxury-Dinner-Setup-Wedding-Morocco-Outdoor-Event.webp') }}"
                                    alt="Luxury Dinner Setup Wedding Morocco Outdoor Event" class="w-100 instagram-2"
                                    loading="lazy" width="150" height="150">
                            </a>
                            <a href="https://www.instagram.com/moroccoquestdmc/" target="_blank"
                                rel="nofollow noopener noreferrer" aria-label="View Moroccan Gate Fes Tourists"
                                class="instagram-post">
                                <img src="{{ asset('assets/img/Moroccan-Gate-Fes-Tourists-Decorative-Architecture.webp') }}"
                                    alt="Moroccan Gate Fes Tourists Decorative Architecture" class="w-100 instagram-3"
                                    loading="lazy" width="150" height="150">
                            </a>
                            <a href="https://www.instagram.com/moroccoquestdmc/" target="_blank"
                                rel="nofollow noopener noreferrer" aria-label="View Moroccan Palace Restaurant"
                                class="instagram-post">
                                <img src="{{ asset('assets/img/Moroccan-Palace-Restaurant-Elegant-Dining-Setup.webp') }}"
                                    alt="Moroccan Palace Restaurant Elegant Dining Setup" class="w-100 instagram-4"
                                    loading="lazy" width="150" height="150">
                            </a>
                            <a href="https://www.instagram.com/moroccoquestdmc/" target="_blank"
                                rel="nofollow noopener noreferrer" aria-label="View Moroccan Riad Pool Night View"
                                class="instagram-post">
                                <img src="{{ asset('assets/img/Moroccan-Riad-Pool-Night-View-Arch-Design.webp') }}"
                                    alt="Moroccan Riad Pool Night View Arch Design" class="w-100 instagram-5"
                                    loading="lazy" width="150" height="150">
                            </a>
                            <a href="https://www.instagram.com/moroccoquestdmc/" target="_blank"
                                rel="nofollow noopener noreferrer" aria-label="View Traditional Moroccan Dining Event"
                                class="instagram-post">
                                <img src="{{ asset('assets/img/Traditional-Moroccan-Dining-Event-Outdoor-Lanterns.webp') }}"
                                    alt="Traditional Moroccan Dining Event Outdoor Lanterns" class="w-100 instagram-6"
                                    loading="lazy" width="150" height="150">
                            </a>
                        </div>
                        <style>
                            .instagram a::before {
                                position: absolute;
                                content: "";
                                left: 5px;
                                top: 5px;
                                right: 5px;
                                bottom: 5px;
                                opacity: 0;
                                border-radius: 10px;
                                background: rgba(12, 66, 73, 0.4);
                                z-index: 2;
                                transition: all 0.3s;
                            }

                            .instagram a:hover::before {
                                opacity: 1;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom bg-third-theme-color">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-2 order-md-1">
                    <p class="footer-copyright text-center text-md-start">
                        © {{ date('Y') }} Morocco Quest — All rights reserved.<br>
                        Développé par
                        <a href="https://codesommet.com/" target="_blank" rel="noopener noreferrer"
                            class="text-theme-color text-decoration-underline">
                            CodeSommet Studio
                        </a>
                    </p>

                </div>

                <div class="col-md-6 order-1 order-md-2">
                    <div class="footer-menu">
                        <ul class="custom-ul justify-content-center justify-content-md-end">
                            <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms.conditions') }}">Terms</a></li>
                            <li><a href="{{ route('cookie.policy') }}">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    logo-footer {
        max-width: 100%;
        height: auto;
        object-fit: contain;
        margin: 0 auto;
        display: block;
    }

    @media (min-width: 1400px) {
        logo-footer {
            max-width: 500px;
            max-height: 80px;
            margin-bottom: 50px;

        }
    }

    @media (min-width: 1920px) {
        logo-footer {
            max-width: 500px;
            max-height: 80px;
            margin-bottom: 50px;

        }
    }
</style>
<!-- ================= Footer End ================= -->

<!-- Scroll To Top Button -->
<a href="#" class="scrollToTop scroll-btn" aria-label="Scroll back to top of page">
    <div class="icon-arrow-up">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="19" x2="12" y2="5" />
            <polyline points="5 12 12 5 19 12" />
        </svg>
    </div>
</a>

<style>
    .scrollToTop {
        position: fixed;
        bottom: 20px;
        right: 20px;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: all 0.4s ease;
        z-index: 999999 !important;
        /* <-- FIX */
    }


    .scrollToTop.active {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .scroll-btn .icon-arrow-up {
        display: inline-block;
        background-color: var(--theme-color);
        color: var(--white-color);
        text-align: center;
        font-size: 16px;
        width: var(--btn-size, 50px);
        height: var(--btn-size, 50px);
        line-height: var(--btn-size, 50px);
        z-index: 2;
        border-radius: inherit;
        position: relative;
        transition: all ease 0.8s;
    }

    .scroll-btn .icon-arrow-up svg {
        width: 18px;
        height: 18px;
        stroke: #fff;
        stroke-width: 2.5;
        stroke-linecap: round;
        stroke-linejoin: round;
        fill: none;
        display: block;
    }

    .scroll-btn .icon-arrow-up {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .scroll-btn::before {
        content: "";
        position: absolute;
        left: var(--extra-shape, -6px);
        top: var(--extra-shape, -6px);
        right: var(--extra-shape, -6px);
        bottom: var(--extra-shape, -6px);
        background-color: rgba(0, 0, 0, 0);
        border-radius: inherit;
        z-index: 1;
        border: 2px dashed var(--theme-color);
        animation: spin 13s infinite linear;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const scrollBtn = document.querySelector(".scrollToTop");

        function toggleScrollBtn() {
            if (window.scrollY > 100) {
                scrollBtn.classList.add("active");
            } else {
                scrollBtn.classList.remove("active");
            }
        }

        window.addEventListener("scroll", toggleScrollBtn);

        scrollBtn.addEventListener("click", function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Run once in case user loads page not at top
        toggleScrollBtn();
    });
</script>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/212654069718?text=Hello%2C%20I%20come%20from%20Morocco%20Quest%20and%20I%20am%20interested%20in%20your%20services."
    class="floating-whatsapp" target="_blank" aria-label="Chat on WhatsApp" data-gtm="whatsapp-button">

    <div class="icon-whatsapp">
        <i class="bi bi-whatsapp"></i>
    </div>
</a>


<style>
    /* WhatsApp Floating Button */
    .floating-whatsapp {
        position: fixed;
        bottom: 90px;
        /* Above scroll-to-top button */
        right: 20px;
        z-index: 999999 !important;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: all 0.4s ease;
    }

    .floating-whatsapp.active {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .icon-whatsapp {
        background-color: #25D366;
        /* WhatsApp Green */
        color: #fff;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        z-index: 2;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        transition: all 0.3s ease;
    }

    .icon-whatsapp:hover {
        transform: scale(1.08);
        background-color: #25D366;
    }

    /* Animated dashed border */
    .floating-whatsapp::before {
        content: "";
        position: absolute;
        left: -6px;
        top: -6px;
        right: -6px;
        bottom: -6px;
        border: 2px dashed #25D366;
        border-radius: 50%;
        animation: spin 13s linear infinite;
        z-index: 1;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    /* Force Bootstrap WhatsApp Icon Color */
    .floating-whatsapp .bi-whatsapp,
    .icon-whatsapp .bi-whatsapp {
        color: #fff !important;
        font-size: 28px !important;
        line-height: 1 !important;
    }

    @media (max-width: 767px) {
        .icon-whatsapp {
            width: 45px;
            height: 45px;
            font-size: 22px;
        }

        .floating-whatsapp::before {
            left: -4px;
            top: -4px;
            right: -4px;
            bottom: -4px;
            border-width: 2px;
        }

        .floating-whatsapp .bi-whatsapp {
            font-size: 22px !important;
        }

        /* Move up slightly so it doesn't overlap text */
        .floating-whatsapp {
            bottom: 80px;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const whatsappBtn = document.querySelector(".floating-whatsapp");

        function toggleWhatsAppBtn() {
            if (window.scrollY > 100) {
                whatsappBtn.classList.add("active");
            } else {
                whatsappBtn.classList.remove("active");
            }
        }

        window.addEventListener("scroll", toggleWhatsAppBtn);

        toggleWhatsAppBtn(); // Run on page load
    });
</script>

{{-- Google reCAPTCHA v2 (Checkbox) — lazy-loaded only when a ".g-recaptcha"
     widget actually approaches the viewport or its form is focused, instead
     of unconditionally on every page load. The widget only appears on pages
     with a form (footer newsletter, contact), so most page views never need
     the ~1MB api.js payload at all. Only emitted when configured, so nothing
     changes when keys are absent. --}}
@if (config('recaptcha.enabled') && config('recaptcha.site_key'))
    <script>
        (function () {
            var loaded = false;
            function loadRecaptcha() {
                if (loaded) return;
                loaded = true;
                var s = document.createElement('script');
                s.src = 'https://www.google.com/recaptcha/api.js';
                s.async = true;
                s.defer = true;
                document.head.appendChild(s);
            }
            document.addEventListener('DOMContentLoaded', function () {
                var widgets = document.querySelectorAll('.g-recaptcha');
                if (!widgets.length) return;

                if ('IntersectionObserver' in window) {
                    var observer = new IntersectionObserver(function (entries) {
                        entries.forEach(function (entry) {
                            if (entry.isIntersecting) {
                                loadRecaptcha();
                                observer.disconnect();
                            }
                        });
                    }, { rootMargin: '200px' });
                    widgets.forEach(function (w) { observer.observe(w); });
                } else {
                    loadRecaptcha();
                }

                widgets.forEach(function (w) {
                    var form = w.closest('form');
                    if (form) {
                        form.addEventListener('focusin', loadRecaptcha, { once: true });
                    }
                });
            });
        })();
    </script>
@endif
