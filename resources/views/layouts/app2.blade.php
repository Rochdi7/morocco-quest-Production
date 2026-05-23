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
    <meta name="google-site-verification" content="FT8pL55esPmKkEfXDLPA6ZAZtsS8M8xQS_euP4lcXVk" />
    <meta name="author" content="Morocco Quest Team" />
    <meta name="msvalidate.01" content="27E449107B43D56EE655E22CCA5378A6" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    {{--
        DO NOT add <meta name="description">, <meta name="keywords">,
        <meta name="robots"> or <link rel="canonical"> here.
        They are emitted by {!! SEOMeta::generate() !!} below.
        Controllers populate them via SEOMeta::setDescription / setKeywords /
        setCanonical, and config/seotools.php provides defaults.
        Duplicating them here causes the "Multiple meta description tags"
        Ahrefs issue (https://...). Use SEOMeta facade in the controller instead.
    --}}

    {{-- Global TravelAgency JSON-LD --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'TravelAgency',
        '@id' => url('/') . '#organization',
        'name' => 'Morocco Quest',
        'alternateName' => 'Morocco Quest Tours & Travel',
        'description' => 'Morocco Quest is a licensed Moroccan travel agency offering private morocco tours, sahara desert tours from Marrakech, luxury desert camps, small group tours, and tailor-made morocco tour packages.',
        'url' => url('/'),
        'logo' => asset('assets/img/logo-bg-wide.webp'),
        'image' => asset('assets/img/ait-benhaddou-morocco-travel-hero-banner.webp'),
        'priceRange' => '$$-$$$',
        'telephone' => '+212-654-069-718',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Marrakech',
            'addressRegion' => 'Marrakech-Safi',
            'addressCountry' => 'MA',
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => '31.6295',
            'longitude' => '-7.9811',
        ],
        'areaServed' => [
            ['@type' => 'Country', 'name' => 'Morocco'],
            ['@type' => 'City', 'name' => 'Marrakech'],
            ['@type' => 'City', 'name' => 'Fes'],
            ['@type' => 'City', 'name' => 'Casablanca'],
            ['@type' => 'Place', 'name' => 'Sahara Desert'],
            ['@type' => 'Place', 'name' => 'Merzouga'],
        ],
        'knowsAbout' => [
            'morocco tours',
            'private morocco tours',
            'sahara desert tours morocco',
            'morocco desert tours from marrakech',
            'morocco tour package',
            'small group tours morocco',
            'luxury morocco tours',
            'morocco guided tours',
        ],
        'sameAs' => [
            'https://www.facebook.com/codesommetagency/',
            'https://www.instagram.com/moroccoquestdmc/',
            'https://www.tripadvisor.com/Attraction_Review-g293734-d33367694-Reviews-Morocco_Quest_Dmc-Marrakech_Marrakech_Safi.html',
        ],
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'telephone' => '+212-654-069-718',
            'contactType' => 'customer service',
            'areaServed' => ['MA', 'US', 'EU', 'UK'],
            'availableLanguage' => ['English', 'French', 'Spanish'],
        ],
    ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>

    @stack('jsonld')

    <!-- Favicons & App Icons (Updated 13/08/2025) -->
    <link rel="apple-touch-icon" sizes="57x57"
        href="{{ asset('assets/img/favicons/apple-touch-icon-57x57.png?v=2') }}">
    <link rel="apple-touch-icon" sizes="60x60"
        href="{{ asset('assets/img/favicons/apple-touch-icon-60x60.png?v=2') }}">
    <link rel="apple-touch-icon" sizes="72x72"
        href="{{ asset('assets/img/favicons/apple-touch-icon-72x72.png?v=2') }}">
    <link rel="apple-touch-icon" sizes="76x76"
        href="{{ asset('assets/img/favicons/apple-touch-icon-76x76.png?v=2') }}">
    <link rel="apple-touch-icon" sizes="114x114"
        href="{{ asset('assets/img/favicons/apple-touch-icon-114x114.png?v=2') }}">
    <link rel="apple-touch-icon" sizes="120x120"
        href="{{ asset('assets/img/favicons/apple-touch-icon-120x120.png?v=2') }}">
    <link rel="apple-touch-icon" sizes="144x144"
        href="{{ asset('assets/img/favicons/apple-touch-icon-144x144.png?v=2') }}">
    <link rel="apple-touch-icon" sizes="152x152"
        href="{{ asset('assets/img/favicons/apple-touch-icon-152x152.png?v=2') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicons/apple-touch-icon.png?v=2') }}">

    <!-- Standard PNG favicons -->
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('assets/img/favicons/favicon-16x16.png?v=2') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('assets/img/favicons/favicon-32x32.png?v=2') }}">
    <link rel="icon" type="image/png" sizes="48x48"
        href="{{ asset('assets/img/favicons/favicon-48x48.png?v=2') }}">
    <link rel="icon" type="image/png" sizes="96x96"
        href="{{ asset('assets/img/favicons/favicon-96x96.png?v=2') }}">
    <link rel="icon" type="image/png" sizes="128x128"
        href="{{ asset('assets/img/favicons/favicon-128.png?v=2') }}">
    <link rel="icon" type="image/png" sizes="196x196"
        href="{{ asset('assets/img/favicons/favicon-196x196.png?v=2') }}">

    <!-- SVG & ICO -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/favicons/favicon.svg?v=2') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicons/favicon.ico?v=2') }}">

    <!-- Web App Icons -->
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('assets/img/favicons/web-app-manifest-192x192.png?v=2') }}">
    <link rel="icon" type="image/png" sizes="512x512"
        href="{{ asset('assets/img/favicons/web-app-manifest-512x512.png?v=2') }}">

    <!-- Microsoft Tiles -->
    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/mstile-144x144.png?v=2') }}">
    <meta name="msapplication-square70x70logo" content="{{ asset('assets/img/favicons/mstile-70x70.png?v=2') }}">
    <meta name="msapplication-square150x150logo" content="{{ asset('assets/img/favicons/mstile-150x150.png?v=2') }}">
    <meta name="msapplication-wide310x150logo" content="{{ asset('assets/img/favicons/mstile-310x150.png?v=2') }}">
    <meta name="msapplication-square310x310logo" content="{{ asset('assets/img/favicons/mstile-310x310.png?v=2') }}">


    <!-- Manifest -->
    <link rel="manifest" href="/assets/img/favicons/site.webmanifest?v=2">

    <!-- Theme Colors -->
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-title" content="MoroccoQuest">
    <meta name="application-name" content="MoroccoQuest">

    <!-- SEO -->
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}" />

    {{-- ✅ SEO TOOLS (dynamic — emits title, description, keywords, robots,
         canonical, og:*, twitter:*, JSON-LD with per-page values from the
         controller and config/seotools.php defaults) --}}
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    {{--
        DO NOT add static <meta name="twitter:*"> here.
        Twitter::generate() above already emits twitter:card, twitter:site,
        twitter:title, twitter:description, and twitter:image — values come
        from config/seotools.php twitter.defaults and from any
        Twitter::setX(...) calls in controllers. Adding them here creates
        the "Multiple meta description tags / duplicate twitter tags" issue.
    --}}

    <!-- Preconnect to CDNs we still hit -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin />
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin />

    {{-- Preload latin woff2 (same files used by inline @font-face below). --}}
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="{{ asset('assets/fonts/rubik-v31-latin-400.woff2') }}">
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="{{ asset('assets/fonts/abril-fatface-v25-latin-400.woff2') }}">

    {{-- Self-hosted Google Fonts (latin subset only). Eliminates the 750ms
         render-block to fonts.googleapis.com and the chained 2x woff2 fetches. --}}
    <style>
        @font-face{font-family:'Abril Fatface';font-style:normal;font-weight:400;font-display:swap;src:url('{{ asset('assets/fonts/abril-fatface-v25-latin-400.woff2') }}') format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
        @font-face{font-family:'Rubik';font-style:normal;font-weight:400;font-display:swap;src:url('{{ asset('assets/fonts/rubik-v31-latin-400.woff2') }}') format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
        @font-face{font-family:'Rubik';font-style:normal;font-weight:700;font-display:swap;src:url('{{ asset('assets/fonts/rubik-v31-latin-700.woff2') }}') format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
    </style>

    {{-- Critical CSS (render-blocking — needed for first paint) --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">

    {{-- Font Awesome from cdnjs: deferred (was render-blocking). Local
         assets/plugins/fontawesome.min.css is left out of the list because its
         font files reference ../webfonts/ which doesn't exist on disk — the
         cdnjs copy is the one that actually delivers the icon glyphs. --}}
    <link rel="preload" as="style"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </noscript>

    {{-- Other non-critical CSS, also deferred --}}
    @php
        $deferredCss = [
            'assets/plugins/animate.min.css',
            'assets/plugins/jquery-ui.min.css',
            'assets/plugins/magnific-popup.min.css',
            'assets/plugins/odometer.css',
            'assets/plugins/swiper-bundle.min.css',
            'assets/plugins/daterangepicker.css',
            'assets/css/home.css',
            'assets/css/about.css',
            'assets/css/new_style.css',
        ];
    @endphp
    @foreach ($deferredCss as $css)
        <link rel="preload" as="style" href="{{ asset($css) }}" onload="this.onload=null;this.rel='stylesheet'">
    @endforeach
    <noscript>
        @foreach ($deferredCss as $css)
            <link rel="stylesheet" href="{{ asset($css) }}">
        @endforeach
    </noscript>

    {{-- Inline above-the-fold rules to paint before deferred CSS loads --}}
    <style>
        html{scroll-behavior:smooth}
        body{margin:0;font-family:'Rubik',Arial,Helvetica,sans-serif;background:#fff;color:#1a1a1a;-webkit-font-smoothing:antialiased}
        .preloader{position:fixed;inset:0;background:#181613;z-index:9999}
        .preloader-inner{position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);text-align:center;display:flex;flex-direction:column;align-items:center;justify-content:center}
        .preloader-inner img{display:block;margin:0 auto 10px auto}
        img{max-width:100%;height:auto}
        .visually-hidden{position:absolute!important;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
    </style>

    @stack('styles')


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

    @include('partials.header2')

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
        // Disable right-click context menu
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // Disable certain key combinations
        document.addEventListener('keydown', function(e) {
            // F12, Ctrl+Shift+I/J/C, Ctrl+U
            if (
                e.keyCode === 123 || // F12
                (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J' || e.key === 'C')) ||
                // Ctrl+Shift+I/J/C
                (e.ctrlKey && e.key === 'u') // Ctrl+U
            ) {
                e.preventDefault();
            }
        });

        // Disable text selection and copy
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
        document.addEventListener('DOMContentLoaded', function() {
            const fallbackSrc = @json(asset('assets/img/placeholder-image.webp'));

            document.querySelectorAll('img').forEach(function(img) {
                img.addEventListener('error', function handleImageError() {
                    if (img.dataset.fallbackApplied === '1') {
                        return;
                    }

                    img.dataset.fallbackApplied = '1';
                    img.src = fallbackSrc;
                });
            });
        });
    </script>

    @stack('scripts')
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WVCGDJ98" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>
