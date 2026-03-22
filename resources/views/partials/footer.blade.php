{{-- resources/views/partials/footer.blade.php --}}

<!-- ================= Footer Start ================= -->
<footer
  class="vs-footer-style1"
  data-bg-src="{{ asset('assets/img/footer/footer-style1-bg.png') }}"
>
  <div class="footer-top space-top">
    <div class="container">
      <div class="row gx-4">
        <div class="col-12">
          <div
            class="footer-cta bg-third-theme-color fade-anim"
            data-bg-src="{{ asset('assets/img/footer/footer-cta-bg.png') }}"
          >
            <div class="row g-4 align-items-center">
              <div class="col-lg-8">
                <div class="cta-contact-items">
                  <div class="contact-item">
                    <span class="icon">
                      <i class="fa-light fa-location-dot"></i>
                    </span>
                    <div class="info">
                      <h5 class="info-title text-white-color">Location</h5>
                      {{-- Update with actual address --}}
                      <p>Your Morocco Quest Address, City, Country</p>
                    </div>
                  </div>
                  <div class="contact-item">
                    <span class="icon">
                      <i class="fa-sharp fa-light fa-phone-rotary"></i>
                    </span>
                    <div class="info">
                      <h5 class="info-title text-white-color">
                        Contact Us
                      </h5>
                      <p>
                        <a href="mailto:contact@morocco-quest.com">contact@morocco-quest.com</a>
                        <a href="tel:+212654069718">+212654069718</a> {{-- Use actual contact number --}}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="col-lg-4 d-flex justify-content-center justify-content-lg-end btn-trigger btn-bounce"
              >
                <a href="{{ url('/contact') }}#booking" class="vs-btn style6"> {{-- Link to contact/booking --}}
                  <span>booking now</span>
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
            <a href="{{ url('/') }}" class="logo">
              <img src="{{ asset('assets/img/logo-bg.png') }}" alt="logo" />
            </a>
            <div class="social-media">
              <ul class="custom-ul">
                {{-- Add actual social links --}}
                <li> <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a> </li>
                <li> <a href="https://x.com/" target="_blank"><i class="fa-brands fa-x-twitter"></i></a> </li>
                <li> <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a> </li>
                <li> <a href="https://www.youtube.com/" target="_blank"><i class="fa-brands fa-youtube"></i></a> </li>
              </ul>
            </div>

            <p class="mt-4 mb-3 text-color-5">
              Stay connected for future updates.
            </p>
            <div class="newsletter">
              {{-- Update form action to a newsletter subscription route --}}
              <form action="#" method="POST" class="w100">
                @csrf {{-- Add CSRF token for POST requests --}}
                <input
                  type="email"
                  name="email" {{-- Added name --}}
                  class="form-control"
                  placeholder="Enter Email Address"
                  required {{-- Added required --}}
                />
                <button type="submit" class="text-uppercase text-color-5">
                  <i class="fa-solid fa-angles-right"></i>
                  <span>Subscribe now</span>
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-xl-4 order-md-3 order-lg-2">
          <div class="footer-widgets">
            <h5 class="widgets-title text-white-color text-capitalize">
              Useful Links
            </h5>
            <div class="row gx-xl-2 g-2">
              <div class="col-md-6">
                <div class="footer-links">
                  <ul class="custom-ul">
                    {{-- Update hrefs to actual routes/URLs --}}
                    <li> <a href="{{ url('/contact') }}#help"> <i class="fa-solid fa-angles-right"></i> Help center </a> </li>
                    <li> <a href="{{ url('/about') }}"> <i class="fa-solid fa-angles-right"></i> About Us </a> </li>
                    <li> <a href="{{ url('/contact') }}"> <i class="fa-solid fa-angles-right"></i> Contact Us </a> </li>
                    <li> <a href="#"> <i class="fa-solid fa-angles-right"></i> Become A Guide </a> </li> {{-- Link? --}}
                    <li> <a href="{{ url('/blog') }}"> <i class="fa-solid fa-angles-right"></i> Blog </a> </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-6">
                <div class="footer-links">
                  <ul class="custom-ul">
                    {{-- Update hrefs to actual routes/URLs --}}
                    <li> <a href="#"> <i class="fa-solid fa-angles-right"></i> Guide of the Year </a> </li> {{-- Link? --}}
                    <li> <a href="#"> <i class="fa-solid fa-angles-right"></i> Guide registration </a> </li> {{-- Link? --}}
                    <li> <a href="#"> <i class="fa-solid fa-angles-right"></i> Creators </a> </li> {{-- Link? --}}
                    <li> <a href="#"> <i class="fa-solid fa-angles-right"></i> Travel agents & advisors </a> </li> {{-- Link? --}}
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 col-xl-3 order-md-2 order-lg-3">
          <div class="footer-widgets">
            <h5 class="widgets-title text-white-color text-capitalize">
              Instagram
            </h5>
            <div class="instagram">
              {{-- These should ideally be dynamic, but using assets for now --}}
              <a href="https://www.instagram.com/" target="_blank"> <img src="{{ asset('assets/img/instagram-post/instagram-1.png') }}" alt="instagram-1" class="w-100"/> </a>
              <a href="https://www.instagram.com/" target="_blank"> <img src="{{ asset('assets/img/instagram-post/instagram-2.png') }}" alt="instagram-2" class="w-100"/> </a>
              <a href="https://www.instagram.com/" target="_blank"> <img src="{{ asset('assets/img/instagram-post/instagram-3.png') }}" alt="instagram-3" class="w-100"/> </a>
              <a href="https://www.instagram.com/" target="_blank"> <img src="{{ asset('assets/img/instagram-post/instagram-4.png') }}" alt="instagram-4" class="w-100"/> </a>
              <a href="https://www.instagram.com/" target="_blank"> <img src="{{ asset('assets/img/instagram-post/instagram-5.png') }}" alt="instagram-5" class="w-100"/> </a>
              <a href="https://www.instagram.com/" target="_blank"> <img src="{{ asset('assets/img/instagram-post/instagram-6.png') }}" alt="instagram-6" class="w-100"/> </a>
            </div>
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
            {{-- Use dynamic year and your site name --}}
            © {{ date('Y') }}
            <a
              href="{{ url('/') }}"
              title="Morocco Quest"
              class="text-theme-color"
              >Morocco Quest</a
            >, All Rights Reserved.
          </p>
        </div>
        <div class="col-md-6 order-1 order-md-2">
          <div class="footer-menu">
            <ul
              class="custom-ul justify-content-center justify-content-md-end"
            >
              {{-- Update links --}}
              <li><a href="{{ url('/about') }}">About Us</a></li>
              <li><a href="{{ url('/faq') }}">Faq’s</a></li>
              <li><a href="#">Team</a></li> {{-- Link? --}}
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- ================= Footer End ================= -->

<!-- Scroll To Top Button -->
<a href="#" class="scrollToTop scroll-btn"><i class="far fa-arrow-up"></i></a>