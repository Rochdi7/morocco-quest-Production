@extends('layouts.app2')

@section('title', $title ?? 'Privacy Policy | Morocco Quest')
@section('description',
    $description ??
    'Privacy Policy for Morocco Quest. How we handle your data when you browse and
    book morocco tours.')
@section('keywords', $keywords ?? 'morocco quest, morocco tours, privacy policy')
{{-- @section('structured_data')
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="Privacy Policy | Morocco Quest" />
    <meta property="og:description" content="Learn how Morocco Quest collects, uses, and protects your personal data when you visit our website or book a tour." />
    <meta property="og:image" content="{{ asset('assets/img/privacy-policy.webp') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Privacy Policy | Morocco Quest" />
    <meta name="twitter:description" content="Learn how Morocco Quest collects, uses, and protects your personal data when you visit our website or book a tour." />
    <meta name="twitter:image" content="{{ asset('assets/img/privacy-policy.webp') }}" />

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Privacy Policy",
      "url": "{{ url()->current() }}",
      "description": "This privacy policy explains how Morocco Quest collects, uses, shares, and protects your information. It covers personal data when browsing or booking tours on our website.",
      "publisher": {
        "@type": "Organization",
        "name": "Morocco Quest",
        "url": "{{ url('/') }}",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ asset('assets/img/logo-bg-wide.webp') }}"
        }
      },
      "mainEntity": {
        "@type": "Organization",
        "name": "Morocco Quest",
        "contactPoint": {
          "@type": "ContactPoint",
          "contactType": "Customer Service",
          "email": "info@morocco-quest.com",
          "telephone": "+212 654 069 718",
          "areaServed": "MA",
          "availableLanguage": ["English", "French", "Spanish"]
        }
      }
    }
    </script>
@endsection --}}


@section('content')
    <main>
        <!-- Hero Section -->
        <section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/luxury-desert-bubble-suite-morocco.webp') }}">
            <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="Decorative cloud icon"
                class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
            <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="Decorative hot air balloon icon"
                class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h1 class="breadcrumb-title">Privacy Policy</h1>
                            <figcaption class="image-caption" style="color: white; font-size: medium;">
                                Learn how we protect your privacy and manage your personal information.
                            </figcaption>

                            <p class="visually-hidden">
                                At Morocco Quest, your privacy is our priority. We are committed to protecting your personal
                                information while delivering a seamless travel experience. This policy explains how we
                                collect, use, and safeguard your data during bookings and excursions. Your details are
                                securely stored and never shared without consent, except when legally required. If you have
                                any questions about our privacy practices, feel free to contact us at any time.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Privacy Policy Section -->
        <section class="terms-conditions">
            <div class="container my-5">
                <div class="row">
                    <div class="text-center">
                        <h2>PRIVACY POLICY</h2>
                        <p style="text-align: center; text-align: justify;">
                            At Morocco Quest, your privacy is our priority. We are committed to protecting your personal
                            information while delivering a seamless travel experience. This policy explains how we collect,
                            use, and safeguard your data during bookings and excursions. Your details are securely stored
                            and never shared without consent, except when legally required. If you have any questions about
                            our privacy practices, feel free to contact us at any time.
                        </p>

                    </div>
                    <div class="col-12">


                        <h2>Who Operates This Website</h2>
                        <p>
                            This website (morocco-quest.com) is operated by Morocco Quest, a Marrakech-based tour operator
                            and Destination Management Company. For any privacy question, contact us using the details at
                            the bottom of this page.
                        </p>

                        <h2>Information You Provide to Us</h2>
                        <p>
                            When you use our contact form, tour or activity inquiry forms, or newsletter signup, we collect
                            the information you submit — typically your name, email address, phone number, nationality,
                            travel dates, group size, and any details about your trip you choose to share. We use this
                            information to respond to your inquiry, prepare a quote, and process any booking you confirm
                            with us. We do not require you to create an account to browse the site, request a quote, or
                            contact us.
                        </p>

                        <h2>Technical and Server Data</h2>
                        <p>
                            Like most websites, our server automatically logs standard technical information when you visit
                            — such as your IP address, browser type, device type, and the pages you request. This
                            information is used for security, troubleshooting, and to keep the site running reliably.
                        </p>

                        <h2>Cookies and Similar Technologies</h2>
                        <p>
                            This website uses a small number of cookies required for it to function correctly, including a
                            session cookie that keeps you signed into your current browsing session and a CSRF-protection
                            cookie that helps prevent forged form submissions. These are strictly necessary and cannot be
                            disabled without breaking core functionality such as submitting a form.
                        </p>
                        <p>
                            We also use Google Tag Manager and Google Analytics to understand how visitors use the site
                            (pages viewed, general location, device type) so we can improve it. These tools may set their
                            own cookies. You can control or block analytics cookies through your browser settings, or by
                            using Google's opt-out tools. See our <a href="{{ route('cookie.policy') }}">Cookie Policy</a>
                            for more detail on the specific cookies in use.
                        </p>

                        <h2>Forms and reCAPTCHA</h2>
                        <p>
                            Our contact, inquiry, and newsletter forms are protected by Google reCAPTCHA to reduce spam and
                            automated abuse. reCAPTCHA may collect hardware and software information, such as device and
                            application data, and send this data to Google for analysis. Use of reCAPTCHA is subject to
                            Google's own
                            <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">Privacy
                                Policy</a> and
                            <a href="https://policies.google.com/terms" target="_blank" rel="noopener noreferrer">Terms of
                                Service</a>.
                        </p>

                        <h2>Google Maps</h2>
                        <p>
                            Our <a href="{{ route('contact.show') }}">Contact page</a> embeds a Google Maps location so you
                            can find us. Loading this embed may allow Google to set its own cookies and collect data
                            according to Google's privacy policy, independent of this website.
                        </p>

                        <h2>WhatsApp and External Messaging Links</h2>
                        <p>
                            Some pages link directly to WhatsApp so you can message our team. If you use these links, your
                            conversation takes place on WhatsApp's platform and is subject to WhatsApp's own privacy policy
                            and terms, not this one.
                        </p>

                        <h2>Who We Share Your Data With</h2>
                        <p>
                            We do not sell your personal information. We share inquiry and booking details only with the
                            service providers necessary to deliver your trip (for example, local guides, drivers,
                            accommodation and desert camp partners) and with our email delivery and analytics providers, who
                            process data on our behalf. We may also disclose information where required by law.
                        </p>

                        <h2>Data Retention</h2>
                        <p>
                            We keep inquiry and booking information for as long as reasonably necessary to respond to your
                            request, deliver a confirmed trip, and meet our accounting and legal obligations. We do not
                            operate a fixed automatic deletion schedule; if you would like us to delete your information
                            sooner, contact us and we will do so unless we are required to keep it for a legitimate business
                            or legal reason.
                        </p>

                        <h2>Data Security</h2>
                        <p>
                            We take reasonable technical and organisational measures to protect the information you share
                            with us. No method of transmission or storage over the internet is completely secure, and we
                            cannot guarantee absolute security.
                        </p>

                        <h2>International Data Processing</h2>
                        <p>
                            We are based in Morocco and work with international travellers and, where relevant, service
                            providers and tools located outside Morocco (such as Google's analytics and reCAPTCHA
                            infrastructure). Where your information is processed outside your home country, it remains
                            subject to this policy.
                        </p>

                        <h2>Your Rights</h2>
                        <p>
                            Depending on where you live, you may have the right to ask what personal information we hold
                            about you, request a copy of it, ask us to correct inaccurate information, or ask us to delete
                            it. To exercise any of these rights, contact us using the details below.
                        </p>

                        <h2>Children's Privacy</h2>
                        <p>
                            This website and our services are intended for adults arranging travel, including on behalf of
                            children travelling with them. We do not knowingly collect personal information directly from
                            children.
                        </p>

                        <h2>External Links</h2>
                        <p>
                            Our site may link to external websites, including social media profiles and travel review sites.
                            We are not responsible for the privacy practices or content of external websites.
                        </p>

                        <h2>Changes to This Policy</h2>
                        <p>
                            We may update this policy from time to time to reflect changes to our website or legal
                            requirements. The "Last updated" date below shows when this page was last revised.
                        </p>

                        <h2>Contact Us</h2>
                        <p>
                            For any question about this privacy policy or your personal data, contact us through:
                        </p>
                        <ul class="mb-4">
                            <li><strong>Email:</strong> <a href="mailto:sales@morocco-quest.com">sales@morocco-quest.com</a>
                            </li>
                            <li><strong>Phone:</strong> <a href="tel:+212654069718">+212 654 069 718</a></li>
                            <li><strong>Address:</strong> Khalid Ibn Al Walid Street, Gueliz, Marrakech, 40000, Morocco</li>
                        </ul>
                        <p class="mb-5">
                            <em>Last updated: {{ now()->format('F j, Y') }}</em>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <style>
        h2 {
            font-size: 30px
        }

        h2 {
            margin-top: 15px;
            margin-bottom: 6px;
        }

        p {
            text-align: justify;
        }
    </style>
@endsection
