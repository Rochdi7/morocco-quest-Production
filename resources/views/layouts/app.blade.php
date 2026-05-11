<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WVCGDJ98');
    </script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    @php
        $metaTitle =
            trim($__env->yieldContent('title')) ?:
            'Morocco Private Tours | Marrakech Desert Tours & Sahara Desert Tour from Marrakech - Morocco Quest';

        $metaDescription =
            trim($__env->yieldContent('description')) ?:
            'Morocco private tours and marrakech desert tours. Sahara desert tour from marrakech, luxury desert tours marrakech, and private tours in morocco. Best morocco private tour company.';

        $metaKeywords =
            trim($__env->yieldContent('keywords')) ?:
            'morocco private tours, marrakech desert tours, sahara desert tour from marrakech, luxury desert tours marrakech, private tours in morocco, best morocco private tour company, sahara desert tours morocco, desert tours marrakech, marrakech desert tour, fes to marrakech desert tour';
    @endphp


    <title>{!! $metaTitle !!}</title>
    <meta name="description" content="{!! $metaDescription !!}" />
    <meta name="keywords" content="{!! $metaKeywords !!}" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="google-site-verification" content="FT8pL55esPmKkEfXDLPA6ZAZtsS8M8xQS_euP4lcXVk" />
    <meta name="msvalidate.01" content="27E449107B43D56EE655E22CCA5378A6" />
    <meta name="seobility" content="3e84be663a440d957975fd49dc5ee255">

    <link rel="canonical" href="{{ url()->current() }}" />

    {{-- Open Graph + Twitter --}}
    <meta property="og:site_name" content="Morocco Quest" />
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:title" content="{{ $metaTitle }}" />
    <meta property="og:description" content="{{ $metaDescription }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="@yield('og_image', asset('assets/img/logo-bg.png'))" />
    <meta property="og:locale" content="en_US" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $metaTitle }}" />
    <meta name="twitter:description" content="{{ $metaDescription }}" />
    <meta name="twitter:image" content="@yield('og_image', asset('assets/img/logo-bg.png'))" />

    {{-- Global TravelAgency JSON-LD --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'TravelAgency',
        'name' => 'Morocco Quest',
        'description' => 'Best morocco private tour company. Marrakech desert tours, sahara desert tour from marrakech, luxury desert tours marrakech, and private tours in morocco.',
        'url' => url('/'),
        'logo' => asset('assets/img/logo-bg.png'),
        'image' => asset('assets/img/logo-bg.png'),
        'areaServed' => ['@type' => 'Country', 'name' => 'Morocco'],
        'knowsAbout' => [
            'morocco private tours',
            'marrakech desert tours',
            'sahara desert tour from marrakech',
            'luxury desert tours marrakech',
            'private tours in morocco',
        ],
    ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>

    @stack('jsonld')

    <!-- Favicons (paths aligned to your /assets/img/favicons directory) -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/favicons/favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">

    <!-- Apple touch icon (declare actual file path to avoid iOS probing /apple-touch-icon.png 404) -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
    <!-- (Optional fallback) If you want to satisfy bots that insist on /apple-touch-icon.png at root, add this alias in .htaccess or copy the file to web root. -->

    <!-- PWA / Manifests (declare both since you have both files) -->
    <link rel="manifest" href="{{ asset('assets/img/favicons/site.webmanifest') }}">
    <meta name="msapplication-config" content="{{ asset('assets/img/favicons/browserconfig.xml') }}">
    <!-- Some tools also look for manifest.json; since you have it, declare it explicitly -->
    <link rel="alternate" type="application/manifest+json" href="{{ asset('assets/img/favicons/manifest.json') }}">

    <!-- Theme / PWA -->
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-title" content="MoroccoQuest">
    <meta name="application-name" content="MoroccoQuest">

    <meta name="twitter:site" content="@MoroccoQuest" />

    <!-- Preconnect & Preload -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin />
    <link rel="preload" as="image" href="{{ asset('assets/img/ait-benhaddou-morocco-travel-hero-banner.webp') }}"
        fetchpriority="high" />

    <!-- Fonts and Icons (unchanged as requested) -->
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Rubik:wght@400;700&display=swap"
        rel="stylesheet" media="all" onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Rubik:wght@400;700&display=swap"
            rel="stylesheet">
    </noscript>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_style.css') }}">
    @stack('head')
    @stack('styles')
    @yield('structured_data')
    <script src="https://analytics.ahrefs.com/analytics.js" data-key="xwuEnsY343hnWPzgNhmhgw" async></script>
</head>



<body class="vs-body">
    <div class="preloader">
        <button class="vs-btn preloaderCls">Cancel Preloader</button>
        <div class="preloader-inner">
            <img src="{{ asset('assets/img/logo-white.bg.webp') }}" alt="Morocco Quest Logo Preloader"
                style="max-height: 350px; max-width: 550px;" />
            <span class="loader"></span>
        </div>
    </div>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/moment.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/daterangepicker.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/wow.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/gsap.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/ScrollTrigger.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/ScrollToPlugin.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/SplitText.min.js') }}" defer></script>

    <script src="{{ asset('assets/js/main.js') }}" defer></script>
    <script>
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        document.addEventListener('keydown', function(e) {
            if (
                e.keyCode === 123 || // F12
                (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J' || e.key === 'C')) ||
                (e.ctrlKey && e.key === 'u') // Ctrl+U
            ) {
                e.preventDefault();
            }
        });

        document.addEventListener('copy', function(e) {
            e.preventDefault();
        });
        document.addEventListener('cut', function(e) {
            e.preventDefault();
        });
        document.addEventListener('paste', function(e) {
            e.preventDefault();
        });
        document.addEventListener('selectstart', function(e) {
            e.preventDefault();
        });
    </script>

    <!-- Google tag (gtag.js) for G-YK31305QT6 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YK31305QT6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-YK31305QT6');
    </script>
    <script>
        var ahrefs_analytics_script = document.createElement('script');
        ahrefs_analytics_script.async = true;
        ahrefs_analytics_script.src = 'https://analytics.ahrefs.com/analytics.js';
        ahrefs_analytics_script.setAttribute('data-key', 'xwuEnsY343hnWPzgNhmhgw');
        document.getElementsByTagName('head')[0].appendChild(ahrefs_analytics_script);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Division
            var divisionBtn = document.getElementById('select-division-button');
            if (divisionBtn && !divisionBtn.hasAttribute('aria-label') && !divisionBtn.hasAttribute(
                    'aria-labelledby')) {
                divisionBtn.setAttribute('aria-label', 'Select division');
            }

            // Guests
            var guestBtn = document.getElementById('guest-dropdown-button');
            if (guestBtn && !guestBtn.hasAttribute('aria-label') && !guestBtn.hasAttribute('aria-labelledby')) {
                guestBtn.setAttribute('aria-label', 'Select guests');
            }
        });
    </script>



    @stack('scripts')

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WVCGDJ98" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>



</html>
