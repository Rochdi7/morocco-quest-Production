@extends('layouts.app2')

@section('title', $title ?? 'Cookie Policy | Morocco Quest')
@section('description', $description ?? 'Cookie Policy for the Morocco Quest website and our morocco tours booking platform.')
@section('keywords', $keywords ?? 'morocco quest, morocco tours, cookie policy')

<link rel="canonical" href="{{ url()->current() }}">
<meta property="og:title" content="Cookie Policy | Morocco Quest" />
<meta property="og:description"
    content="Learn how Morocco Quest uses cookies to improve your browsing experience and analyze website traffic." />
<meta property="og:image" content="{{ asset('assets/img/cookie-policy.webp') }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:type" content="website" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="Cookie Policy | Morocco Quest" />
<meta name="twitter:description"
    content="Learn how Morocco Quest uses cookies to improve your browsing experience and analyze website traffic." />
<meta name="twitter:image" content="{{ asset('assets/img/cookie-policy.webp') }}" />

{{-- <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Cookie Policy",
      "url": "{{ url()->current() }}",
      "description": "Our cookie policy explains how Morocco Quest uses cookies and similar technologies to analyze website usage, enhance user experience, and support functionality.",
      "publisher": {
        "@type": "Organization",
        "name": "Morocco Quest",
        "url": "{{ url('/') }}",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ asset('assets/img/logo-bg-wide.webp') }}"
        }
      }
    }
    </script> --}}


@section('content')
    <main>
        <!-- Hero Section -->
        <section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/moroccan-traditional-dinner-event.webp') }}">
            <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="Decorative cloud icon"
                class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
            <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="Decorative hot air balloon icon"
                class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h1 class="breadcrumb-title">Our Cookie Policy</h1>
                            <figcaption class="image-caption" style="color: white; font-size: medium; ">
                                Learn how we use cookies to improve your experience and ensure better services.
                            </figcaption>

                            <p class="visually-hidden">
                                This image represents a traditional Moroccan dinner event in a beautifully decorated outdoor
                                setting with lanterns and cultural ambiance. Our Cookie Policy explains how we use cookies
                                to improve your navigation experience and ensure better service delivery.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cookie Policy Section -->
        <section class="terms-conditions">
            <div class="container my-5">
                <div class="row">
                    <div class="text-center">
                        <h2>COOKIE POLICY</h2>
                        <p style="text-align: center;">
                            This policy explains the cookies actually used on this website, why we use them, and how you can
                            control them.
                        </p>
                    </div>
                    <div class="col-12" style="margin-top: 20px;">


                        <h2>What are cookies and why do we use them?</h2>
                        <p>
                            A cookie is a small text file that our site sends to your device while you are browsing, and
                            your browser stores for later use. Cookies help websites function correctly and, where enabled,
                            help us understand how visitors use the site. A cookie cannot give us access to your device or
                            files.
                        </p>
                        <h2 style="margin-top: 20px;">What cookies do we use?</h2>
                        <p>
                            We use a small number of cookies, set either directly by this website or by the third-party
                            services listed below. Third-party cookies are subject to that provider's own cookie policy:
                        </p>
                        <ul style="margin-top: 6px; list-style-type: disc; padding-left: 20px;">
                            <li class="cookie-list"><a href="https://policies.google.com/technologies/cookies"
                                    target="_blank">Google Cookie Policy</a> (Google Analytics, Google Tag Manager,
                                Google Maps, reCAPTCHA)</li>
                        </ul>


                        <p>We use two categories of cookies on this website:</p>

                        <h6>Necessary Cookies</h6>
                        <p>
                            Essential cookies our website needs to function — including a session cookie that keeps your
                            browsing session working correctly, and a CSRF-protection cookie that helps prevent forged form
                            submissions when you use our contact, inquiry, or newsletter forms. These cannot be disabled
                            without breaking core site functionality such as submitting a form.
                        </p>

                        <h6>Analytics Cookies</h6>
                        <p>
                            We use Google Tag Manager and Google Analytics to understand how visitors use the site — for
                            example, which pages are viewed and how much time is spent on them — so we can improve it.
                            Google reCAPTCHA, used on our forms to reduce spam, may also set cookies as part of its
                            operation. We do not currently run advertising or remarketing cookies (such as Facebook/Meta
                            Pixel or Google Ads conversion tracking) on this website.
                        </p>

                        <h6>How can you control cookies?</h6>
                        <p>
                            Most browsers let you view, delete, and block cookies through their settings. You can browse
                            most of this website with cookies blocked, though some functionality — such as submitting a
                            form — depends on the necessary cookies described above and may not work correctly without
                            them. You can also opt out of Google Analytics tracking using
                            <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">Google's
                                Analytics opt-out browser add-on</a>.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        h2 {
            font-size: 30px;
        }

        .cookie-list {
            color: #bb5e2a;
            text-decoration: underline;
        }

        h6 {
            margin-top: 15px;
            margin-bottom: 6px;
        }

        p {
            text-align: justify;
        }
    </style>
@endsection
