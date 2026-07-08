@extends('layouts.app2')

@section('title', $title ?? 'Contact Morocco Quest | Book Morocco Tours & Sahara Trips')
@section('description', $description ?? 'Contact Morocco Quest to book morocco tours, sahara desert tours from Marrakech, morocco day trips and private morocco tours. Reply within 24h.')
@section('keywords', $keywords ?? 'contact morocco quest, book morocco tour, morocco tour inquiry, morocco travel agency contact, marrakech tour booking, email morocco tour operator')
@section('og_image', asset('assets/img/moroccan-travel-expert-contact-page-riad-setting.webp'))


@push('jsonld')
@php
    $contactSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'TravelAgency',
        'name' => 'Morocco Quest',
        'url' => url()->current(),
        'image' => asset('assets/img/moroccan-travel-expert-contact-page-riad-setting.webp'),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Khalid Ibn Al Walid Street',
            'addressLocality' => 'Marrakech',
            'postalCode' => '40000',
            'addressCountry' => 'MA',
        ],
        'telephone' => '+212654069718',
        'email' => 'sales@morocco-quest.com',
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'telephone' => '+212654069718',
            'contactType' => 'Customer Service',
            'availableLanguage' => ['English', 'French', 'Spanish'],
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode($contactSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Contact', 'item' => url()->current()],
    ],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush


@section('content')

    {{-- Breadcrumb Section --}}
    <section class="vs-breadcrumb"
        data-bg-src="{{ asset('assets/img/moroccan-travel-expert-contact-page-riad-setting.webp') }}" {{-- Ensure background
        image is optimized --}}>
        {{-- Decorative Images: Added loading="lazy" --}}
        <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="Decorative cloud icon"
            class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" {{-- Added Lazy Loading --}} {{-- width="X"
            height="Y" --}}
            {{-- Recommended: Add dimensions --}} />
        <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="Decorative hot air balloon icon"
            class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" {{-- Added Lazy Loading --}} {{-- width="X"
            height="Y" --}}
            {{-- Recommended: Add dimensions --}} />
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        {{-- H1: Main heading for the page --}}
                        <h1 class="breadcrumb-title">Contact Us</h1>

                        <figcaption class="image-caption" style="font-size: medium; color: white;">
                            We’re here to help you craft your perfect Moroccan journey — reach out anytime.
                        </figcaption>

                        <p class="visually-hidden">
                            Reach out to our Morocco travel experts for personalized service and authentic cultural
                            experiences. Whether you’re planning a trip or need assistance, we’re here to guide you every
                            step of the way.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Contact Section --}}
    {{-- Schema.org TravelAgency/ContactPage data added via JSON-LD in head --}}
    <section class="vs-contact space">
        <div class="container">
            <div class="row g-4 gx-xl-5 overflow-hidden">
                {{-- Contact Info Column --}}
                <div class="col-lg-5">
                    <div class="title-area text-start mb-2">
                        <span class="sec-subtitle style-2">Contact Us</span>
                        {{-- H2: Section Heading --}}
                        <h2 class="sec-title">Get in touch with us</h2>
                    </div>
                    <div class="vs-contact-info mt-3 mb-2">
                        {{-- !! IMPORTANT: Replace ALL placeholders below with your ACTUAL business details !! --}}
                        <p>
                            <span class="text-theme-color fw-bold">Address:</span>
                            Khalid Ibn Al Walid Street, Gueliz, Marrakech, 40000, Morocco
                        </p>
                        <div class="vs-contact-list">
                            <div class="contact-item">
                                <span class="icon">
                                    <i class="fa-solid fa-phone-volume"></i>
                                </span>
                                <div class="info">
                                    {{-- H6: Sub-heading for contact type --}}
                                    <h6 class="info-title">Customer Service:</h6>
                                    <p>
                                        {{-- Use tel: links for phone numbers --}}
                                        <a href="tel:+212654069718"
                                            aria-label="Call Morocco Quest Customer Service at +212 654 069 718">+212 654
                                            069 718</a>
                                    </p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <span class="icon">
                                    <i class="fa-light fa-envelope"></i>
                                </span>
                                <div class="info">
                                    <h6 class="info-title">Email Us:</h6>
                                    <p>
                                        {{-- Use mailto: link for email --}}
                                        <a href="mailto:sales@morocco-quest.com"
                                            aria-label="Email Morocco Quest at sales@morocco-quest.com">sales@morocco-quest.com</a>

                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="social-follow">
                            <span>Follow Us:</span>
                            <ul class="custom-ul">
                                {{-- !! IMPORTANT: Replace # or placeholder URLs with your actual social media profile URLs
                                !! --}}
                                <li>
                                    <a href="https://x.com/mounirakajiamounirakajia" target="_blank"
                                        rel="noopener noreferrer" aria-label="Follow Morocco Quest on X (Twitter)">
                                        <i class="fa-brands fa-x-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/moroccoquestdmc/" target="_blank"
                                        rel="noopener noreferrer" aria-label="Follow Morocco Quest on Instagram">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://www.facebook.com/profile.php?id=61578772746041" target="_blank"
                                        rel="noopener noreferrer" aria-label="Follow Morocco Quest on Facebook">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                </li>
                                {{-- Add other relevant social links (e.g., Pinterest, YouTube) --}}
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- Contact Form Column --}}
                <div class="col-lg-7">
                    {{-- Session messages for form submission feedback --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- Display validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h4 class="alert-heading">Please fix the following errors:</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Contact Form --}}
                    {{-- Ensure 'contact.submit' route exists and handles POST requests --}}
                    <form action="{{ route('contact.submit') ?? '#' }}" method="POST" class="form-style1" novalidate>
                        {{--
                        Added novalidate --}}
                        @csrf
                        <div class="row">
                            {{-- Form fields with validation error handling and accessibility attributes --}}
                            <div class="col-md-6 form-group">
                                <input name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Full Name*"
                                    value="{{ old('name') }}" required autocomplete="name" aria-label="Full Name"
                                    aria-required="true" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email Address*"
                                    value="{{ old('email') }}" required autocomplete="email" aria-label="Email Address"
                                    aria-required="true" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="nationality" type="text"
                                    class="form-control @error('nationality') is-invalid @enderror"
                                    placeholder="Nationality*" value="{{ old('nationality') }}" required
                                    autocomplete="country-name" aria-label="Nationality" aria-required="true" />
                                @error('nationality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="phone" type="tel"
                                    class="form-control @error('phone') is-invalid @enderror" placeholder="Phone Number*"
                                    value="{{ old('phone') }}" required autocomplete="tel" aria-label="Phone Number"
                                    aria-required="true" />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group position-relative">
                                <input name="arrival_date" id="arrival-date" type="text"
                                    class="form-control @error('arrival_date') is-invalid @enderror"
                                    placeholder="Departure Date*" value="{{ old('arrival_date') }}" required
                                    aria-label="Planned Departure Date" aria-required="true" readonly />
                                @error('arrival_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <input name="duration_days" type="number" min="1"
                                    class="form-control @error('duration_days') is-invalid @enderror"
                                    placeholder="Trip Duration (Days)*" value="{{ old('duration_days') }}" required
                                    aria-label="Trip Duration in Days" aria-required="true" />
                                @error('duration_days')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="adults" type="number" min="1"
                                    class="form-control @error('adults') is-invalid @enderror"
                                    placeholder="Number of Adults (>12)*" value="{{ old('adults') }}" required
                                    aria-label="Number of Adults (Over 12)" aria-required="true" />
                                @error('adults')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="children" type="number" min="0"
                                    class="form-control @error('children') is-invalid @enderror"
                                    placeholder="Number of Children (2-11)" value="{{ old('children') ?? 0 }}"
                                    aria-label="Number of Children (2-11)" /> {{-- Default to 0 --}}
                                @error('children')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 form-group">
                                <textarea name="travel_ideas" class="form-control @error('travel_ideas') is-invalid @enderror"
                                    placeholder="Tell us about your travel ideas (e.g., interests, places, pace, special occasions)" rows="4"
                                    aria-label="Your Travel Ideas">{{ old('travel_ideas') }}</textarea>
                                @error('travel_ideas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 form-group mt-3 mb-0">
                                <button class="vs-btn" type="submit" aria-label="Send Your Inquiry">Send
                                    Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Google Map Embed --}}
    <div class="map-layout1">
        {{-- !! IMPORTANT: Replace src with your actual Google Maps embed URL !! --}}
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1698.483758054788!2d-8.006390022145526!3d31.634739777419167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdafedfdb4388433%3A0x5a825fb19436e82d!2sColored%20Morocco%20Tours%20%26%20Travel!5e0!3m2!1sen!2sma!4v1746733040408!5m2!1sen!2sma"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#arrival-date", {
                dateFormat: "Y-m-d", // Display format to the user
                minDate: "today", // Disable past dates
                locale: "en" // Force English
            });
        });
    </script>
@endsection
