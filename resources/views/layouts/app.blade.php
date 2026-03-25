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
            'private morocco tours | exclusive morocco travel experiences | Morocco Quest';

        $metaDescription =
            trim($__env->yieldContent('description')) ?:
            'private morocco tours, private tour morocco, small group tours morocco, exclusive morocco travel experiences, vip morocco tours, morocco travel.';

        $metaKeywords =
            trim($__env->yieldContent('keywords')) ?:
            'morocco private tours, private morocco tours, private morocco tour, private tours morocco, private tour morocco, small group tours morocco, morocco small group tours, exclusive morocco travel experiences, vip morocco tours, morocco luxury travel, luxury travel morocco, morocco travel insurance, morocco travel agent, what is the best time to travel to morocco, morocco travel visa requirements';
    @endphp


    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}" />
    <meta name="keywords" content="{{ $metaKeywords }}" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="google-site-verification" content="FT8pL55esPmKkEfXDLPA6ZAZtsS8M8xQS_euP4lcXVk" />
    <meta name="msvalidate.01" content="27E449107B43D56EE655E22CCA5378A6" />
    <meta name="seobility" content="3e84be663a440d957975fd49dc5ee255">

    <link rel="canonical" href="{{ url()->current() }}" />

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

    <!-- Open Graph -->
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $metaTitle }}" />
    <meta property="og:description" content="{{ $metaDescription }}" />
    <meta property="og:image" content="{{ asset('assets/img/ait-benhaddou-morocco-travel-hero-banner.webp') }}" />
    <meta property="og:site_name" content="Morocco Quest" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@MoroccoQuest" />
    <meta name="twitter:title" content="{{ $metaTitle }}" />
    <meta name="twitter:description" content="{{ $metaDescription }}" />
    <meta name="twitter:image" content="{{ asset('assets/img/ait-benhaddou-morocco-travel-hero-banner.webp') }}" />

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

    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollToPlugin.min.js') }}"></script>
    <script src="{{ asset('assets/js/SplitText.min.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
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
