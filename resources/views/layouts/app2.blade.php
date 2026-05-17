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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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


    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap">

    <!-- Load both fonts with display=swap to prevent blocking -->
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Rubik:wght@400;700&display=swap"
        rel="stylesheet" media="all" onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Rubik:wght@400;700&display=swap"
            rel="stylesheet">
    </noscript>

    <!-- === Individual Plugin Styles === -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_style.css') }}">

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

    @stack('scripts')
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WVCGDJ98" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>
