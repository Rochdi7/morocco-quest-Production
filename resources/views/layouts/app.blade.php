{{-- resources/views/app.blade.php --}}
<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}"> {{-- Use Laravel's locale --}}

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title', 'Morocco Quest')</title> {{-- Dynamic Title --}}
    <meta name="author" content="https://is.gd/a33FWT" />
    {{-- Consider making description/keywords dynamic per page using @yield --}}
    <meta name="description" content="@yield('description', 'Morocco Quest - Your adventure starts here. Explore multi-day and one-day tours across Morocco.')" />
    <meta name="keywords" content="@yield('keywords', 'Morocco, Quest, Tours, Travel, Marrakech, Fes, Desert, Atlas Mountains, Day Trips, Multi-day Tours')" />
    <meta name="robots" content="INDEX,FOLLOW" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/img/favicons/apple-icon-57x57.png') }}" />
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/img/favicons/apple-icon-60x60.png') }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/favicons/apple-icon-72x72.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/favicons/apple-icon-76x76.png') }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/favicons/apple-icon-114x114.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/favicons/apple-icon-120x120.png') }}" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/img/favicons/apple-icon-144x144.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/img/favicons/apple-icon-152x152.png') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-icon-180x180.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicons/favicon-96x96.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/ms-icon-144x144.png') }}" />
    <meta name="theme-color" content="#fff" />

    <!--================= Google Fonts =================-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    {{-- Included the specific fonts from home.html --}}
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet" />

    <!--================= All CSS File =================-->
    <!-- plugins -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}" />
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    {{-- Stack for page-specific styles if needed --}}
    @stack('styles')
</head>

<body class="vs-body">
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!--================= Preloader =================-->
    <div class="preloader">
      <button class="vs-btn preloaderCls">Cancel Preloader</button>
      <div class="preloader-inner">
        <img src="{{ asset('assets/img/logo-bg.png') }}" alt="logo" />
        <span class="loader"></span>
      </div>
    </div>

    {{-- Include Header Partial --}}
    @include('partials.header')

    {{-- Main Content Area - Yielded from specific views --}}
    @yield('content')

    {{-- Include Footer Partial --}}
    @include('partials.footer')

    <!--================= All Js File ================= -->
    <!-- Jquery -->
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <!-- Jquery UI -->
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <!-- Moment JS (often for date pickers) -->
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <!-- Daterangepicker -->
    <script src="{{ asset('assets/js/daterangepicker.min.js') }}"></script>
    <!-- Swiper Slider -->
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- WOW.js Animation -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Image Loaded Jquery -->
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- Gsap -->
    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <!-- ScrollTrigger -->
    <script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
    <!-- ScrollToPlugin -->
    <script src="{{ asset('assets/js/ScrollToPlugin.min.js') }}"></script>
    <!-- SplitText -->
    <script src="{{ asset('assets/js/SplitText.min.js') }}"></script>

    <!-- Main Js File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- Stack for page-specific scripts if needed --}}
    @stack('scripts')
</body>
</html>