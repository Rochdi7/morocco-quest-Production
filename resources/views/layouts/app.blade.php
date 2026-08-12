<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google Tag Manager (deferred to idle to protect LCP) -->
    <script>
        (function () {
            function loadGTM() {
                var w = window, d = document, s = 'script', l = 'dataLayer', i = 'GTM-WVCGDJ98';
                w[l] = w[l] || [];
                w[l].push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            }
            if ('requestIdleCallback' in window) {
                requestIdleCallback(loadGTM, { timeout: 3000 });
            } else {
                setTimeout(loadGTM, 2500);
            }
        })();
    </script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    @php
        // Bridge: prefer @section() values, then controller-passed $metaTitle/$metaDescription/$metaKeywords, then defaults.
        $sectionTitle = trim($__env->yieldContent('title'));
        $sectionDesc  = trim($__env->yieldContent('description'));
        $sectionKw    = trim($__env->yieldContent('keywords'));

        $metaTitle = $sectionTitle
            ?: (isset($metaTitle) && $metaTitle ? $metaTitle :
                'Morocco Tours & Private Sahara Desert Trips from Marrakech | Morocco Quest');

        $metaDescription = $sectionDesc
            ?: (isset($metaDescription) && $metaDescription ? $metaDescription :
                'Morocco Quest offers private morocco tours, sahara desert tours from Marrakech, luxury & small group trips. Book your guided morocco tour package with a top-rated local agency.');

        $metaKeywords = $sectionKw
            ?: (isset($metaKeywords) && $metaKeywords ? $metaKeywords :
                'morocco tours, private morocco tours, morocco tour package, sahara desert tours morocco, morocco desert tours from marrakech, small group tours morocco, luxury morocco tours, morocco guided tours');
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

    {{-- Global WebSite JSON-LD --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => url('/') . '#website',
        'url' => url('/'),
        'name' => 'Morocco Quest',
        'inLanguage' => 'en',
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => url('/search') . '?q={search_term_string}',
            'query-input' => 'required name=search_term_string',
        ],
    ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>

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
            'latitude' => '31.6343547',
            'longitude' => '-8.00426',
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
            'https://www.facebook.com/profile.php?id=61578772746041',
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

    {{-- jsdelivr preconnect removed: nothing on this layout loads from it anymore
         (bootstrap-icons are self-hosted) — PSI flagged it as an unused preconnect. --}}

    {{-- LCP hero preload — responsive variants so mobile doesn't fetch the desktop asset --}}
    <link rel="preload" as="image"
          href="{{ asset('assets/img/ait-benhaddou-morocco-travel-hero-banner-mobile.webp') }}"
          media="(max-width: 767px)"
          fetchpriority="high" />
    <link rel="preload" as="image"
          href="{{ asset('assets/img/ait-benhaddou-morocco-travel-hero-banner-desktop.webp') }}"
          media="(min-width: 768px)"
          fetchpriority="high" />

    {{-- Preload the two latin woff2 files that the inline @font-face uses below.
         Saves a round-trip — the browser starts the font fetch as soon as the
         preload tag is parsed, instead of waiting for first @font-face match. --}}
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="{{ asset('assets/fonts/rubik-v31-latin-400.woff2') }}">
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="{{ asset('assets/fonts/rubik-v31-latin-700.woff2') }}">
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="{{ asset('assets/fonts/abril-fatface-v25-latin-400.woff2') }}">

    {{-- Self-hosted Google Fonts (latin subset only).
         Eliminates the 750ms render-block to fonts.googleapis.com and the
         chained 2x woff2 fetches on the critical path. --}}
    <style>
        @font-face{font-family:'Abril Fatface';font-style:normal;font-weight:400;font-display:swap;src:url('{{ asset('assets/fonts/abril-fatface-v25-latin-400.woff2') }}') format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
        @font-face{font-family:'Rubik';font-style:normal;font-weight:400;font-display:swap;src:url('{{ asset('assets/fonts/rubik-v31-latin-400.woff2') }}') format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
        @font-face{font-family:'Rubik';font-style:normal;font-weight:700;font-display:swap;src:url('{{ asset('assets/fonts/rubik-v31-latin-700.woff2') }}') format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
    </style>

    {{-- Bootstrap Icons: self-hosted, deferred (icons only appear in nav/footer, not above the fold).
         Self-hosting removes the CDN round-trip and lets us control font-display. --}}
    <link rel="preload" as="style" href="{{ asset('assets/plugins/bootstrap-icons/bootstrap-icons.min.css') }}"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-icons/bootstrap-icons.min.css') }}">
    </noscript>

    {{-- Critical CSS (render-blocking — needed for first paint).
         Purged copies (unused rules stripped, ~57% smaller combined).
         Originals live at assets/plugins/ + assets/css/ — regenerate after
         adding new views/classes:  npx purgecss --config purgecss.config.js
         (or the scratch runner; see purgecss.config.js at project root). --}}
    {{-- purged-home = scoped to this layout's 3 views (home, index,
         category-details) + header/footer — ~40% smaller than the sitewide
         purge. Regenerate with the purge-home runner when those views change. --}}
    <link rel="stylesheet" href="{{ asset('assets/css/purged-home/bootstrap.min.css') }}?v={{ filemtime(public_path('assets/css/purged-home/bootstrap.min.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/purged-home/style.min.css') }}?v={{ filemtime(public_path('assets/css/purged-home/style.min.css')) }}">

    {{-- Inline above-the-fold rules: paints something usable before the
         deferred CSS finishes. Tiny (<1KB), zero visual regression because
         it only sets what the existing CSS would set anyway. --}}
    <style>
        html{scroll-behavior:smooth}
        body{margin:0;font-family:'Rubik',Arial,Helvetica,sans-serif;background:#fff;color:#1a1a1a;-webkit-font-smoothing:antialiased}
        .preloader{position:fixed;inset:0;background:#181613;z-index:9999}
        .preloader-inner{position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);text-align:center;display:flex;flex-direction:column;align-items:center;justify-content:center}
        .preloader-inner img{display:block;margin:0 auto 10px auto}
        img{max-width:100%;height:auto}
        .visually-hidden{position:absolute!important;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
        /* Reserve hero height so layout doesn't shift before style.min.css applies */
        .hero-layout1{min-height:560px;background-size:cover;background-position:center}
        @media (max-width:991.98px){.hero-layout1{min-height:480px}}
        /* Mobile: scale down hero breadcrumb title on all pages */
        @media (max-width:767px){
            .breadcrumb-title{font-size:1.5rem;line-height:1.3}
            .breadcrumb-subtitle{font-size:.9rem}
        }
    </style>

    {{-- Non-critical CSS (deferred — used by sliders, popups, datepickers, animations) --}}
    @php
        $deferredCss = [
            'assets/plugins/animate.min.css',
            'assets/plugins/jquery-ui.min.css',
            'assets/plugins/magnific-popup.min.css',
            'assets/plugins/odometer.css',
            'assets/plugins/swiper-bundle.min.css',
            'assets/plugins/daterangepicker.css',
            'assets/css/home.css',
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

    @stack('head')
    @stack('styles')
    @yield('structured_data')
    {{-- Ahrefs analytics loads once at end of body (was duplicated here). --}}
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
    <script>
        // Deterministic preloader reveal for slow networks. main.js keeps the
        // original 800ms-after-load timing on fast connections; this timer
        // starts at HTML parse and caps the wait at 2.6s. CLS-safe: fading an
        // overlay (opacity) and the hero entrance keyframes (transform/opacity)
        // are both excluded from layout-shift scoring. Idempotent with main.js.
        (function () {
            setTimeout(function () {
                var p = document.querySelector('.preloader');
                if (p && p.style.display !== 'none') {
                    p.style.transition = 'opacity .5s';
                    p.style.opacity = '0';
                    setTimeout(function () { p.style.display = 'none'; }, 550);
                }
                var h = document.querySelector('.vs-hero');
                if (h) h.classList.add('animate-elements');
                // 1500ms from script exec — inline scripts wait for pending
                // stylesheets, so this countdown starts at CSS-ready. The
                // preloaded hero image lands well within this window.
            }, 1500);
        })();
    </script>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}" defer></script>
    {{-- Slim jquery-ui: selectmenu + slider only (the two widgets main.js uses).
         50KB vs the 89KB full build. Full build stays at assets/js/jquery-ui.min.js
         as rollback; rebuild via the build-jqueryui runner (see project memory). --}}
    <script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}" defer></script>
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

    {{-- Minified build of assets/js/main.js — regenerate after editing the source:
         npx terser assets/js/main.js --compress --mangle --output assets/js/main.min.js --}}
    <script src="{{ asset('assets/js/main.min.js') }}" defer></script>
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

    {{-- GA4 (G-YK31305QT6) is loaded BY the GTM container (GTM-WVCGDJ98) — the
         standalone gtag.js loader that used to live here downloaded the same
         160KB script a second time and double-fired page views. If GA4 data
         ever stops, re-check that the GA4 config tag still exists in GTM. --}}
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
