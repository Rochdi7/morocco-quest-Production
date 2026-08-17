@extends('layouts.app')
@section('title', 'Morocco Tours & Sahara Desert Trips | Morocco Quest')

@section('description',
    'Morocco Quest offers private morocco tours & sahara desert tours from Marrakech. Book small group or luxury guided tour packages with a top-rated local agency.')

@section('page_description',
    'Morocco Quest offers private morocco tours, sahara desert tours from Marrakech, luxury & small group trips. Book your guided morocco tour package with a top-rated local agency.')

@section('keywords',
    'morocco tours, private morocco tours, morocco tour package, sahara desert tours morocco, morocco desert tours from marrakech, small group tours morocco, luxury morocco tours, morocco guided tours')

{{-- WebSite + TravelAgency schema are emitted globally by layouts/app.blade.php — no page-level duplicate needed here.
     Homepage previously also emitted a hidden-only FAQPage schema with no matching visible content; removed per
     "structured data must represent visible content" — the same 5 Q&As remain live and visible on /faq. --}}


@section('content')
    <main class="main">
        <section class="z-index-common hero-layout1 overflow-clip hero-home-bg">
            <figcaption class="visually-hidden" lang="en" aria-hidden="true">
                A panoramic view of Aït Benhaddou, a UNESCO World Heritage site in Morocco, with its iconic kasbahs under
                desert sunlight, showcasing private morocco tours and exclusive travel experiences.
            </figcaption>

            <div class="container-fluid p-xl-0">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-xxl-7">
                        <div class="hero-content text-center">
                            <img class="fade-anim" alt="Sun icon for private morocco tours"
                                src="/assets/img/icons/hero-sun.png" width="92" height="50" data-delay="0.70">


                            <div class="title-area text-center">
                                <span class="sec-subtitle mb-0 fade-anim" data-delay="0.75" data-direction="bottom"
                                    style="color: white !important;">
                                    Private Tours Tailored to Your Needs
                                </span>

                                {{-- <h1 class="sec-title text-white-color fade-anim" data-delay="0.76" data-direction="top">
                        Find Your Unforgettable <br class="d-none d-xxl-block"> Holiday in Morocco
                    </h1> --}}
                                <h1 class="sec-title text-white-color fade-anim hero-home-title" data-delay="0.76" data-direction="top">
                                    Morocco Tours & Private Sahara Desert <br class="d-none d-xxl-block">
                                    Trips from Marrakech
                                </h1>
                                <style>
                                    .hero-home-title { font-size: 48px; line-height: 1.25; }
                                    @media (max-width: 991px) { .hero-home-title { font-size: 36px; } }
                                    @media (max-width: 575px) { .hero-home-title { font-size: 28px; } }
                                    .hero-home-bg { background-image: url('{{ asset('assets/img/ait-benhaddou-morocco-travel-hero-banner-mobile.webp') }}'); background-size: cover; background-position: center; }
                                    @media (min-width: 768px) { .hero-home-bg { background-image: url('{{ asset('assets/img/ait-benhaddou-morocco-travel-hero-banner-desktop.webp') }}'); } }
                                </style>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="max-width: 1200px; margin: 0 auto;" class="search-box fade-anim" data-delay="0.77"
                data-direction="top">
                <form action="{{ route('search.bar') }}" method="GET" class="align-items-center">
                    <div class="form-group ps-0 position-relative">
                        <label for="select-division" class="form-label d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-map-pin-icon">
                                <path
                                    d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            Destination or Activity
                        </label>
                        <select id="select-division" name="place" class="form-select custom-select pe-5" required>
                            <option value="" disabled {{ !request('place') ? 'selected' : '' }} hidden>
                                Select Division
                            </option>
                            @isset($locations)
                                @foreach ($locations as $locationName)
                                    <option value="{{ $locationName }}"
                                        {{ request('place') == $locationName ? 'selected' : '' }}>
                                        {{ $locationName }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-down-icon"
                            style="position: absolute; right: 25px; bottom: 12px; pointer-events: none;">
                            <path d="M12 5v14" />
                            <path d="m19 12-7 7-7-7" />
                        </svg>
                    </div>

                    <div class="form-group position-relative">
                        <label for="search-date" class="form-label d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-calendar-days-icon">
                                <path d="M8 2v4" />
                                <path d="M16 2v4" />
                                <rect width="18" height="18" x="3" y="4" rx="2" />
                                <path d="M3 10h18" />
                                <path d="M8 14h.01" />
                                <path d="M12 14h.01" />
                                <path d="M16 14h.01" />
                                <path d="M8 18h.01" />
                                <path d="M12 18h.01" />
                                <path d="M16 18h.01" />
                            </svg>
                            Date
                        </label>
                        <input type="text" id="search-date" name="searchDate" class="form-select custom-select pe-5"
                            placeholder="Date from" value="{{ request('searchDate') }}" readonly>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-down-icon"
                            style="position: absolute; right: 25px; bottom: 12px; pointer-events: none;">
                            <path d="M12 5v14" />
                            <path d="m19 12-7 7-7-7" />
                        </svg>
                    </div>

                    <style>
                        .lucide-arrow-down-icon {
                            width: 18px;
                            height: 18px;
                            position: absolute;
                            right: 24px;
                            bottom: 5px;
                            pointer-events: none;
                            opacity: 0.85;
                        }
                    </style>

                    <div class="form-group position-relative">
                        <label for="guest-dropdown" class="form-label d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-map-pinned-icon">
                                <path
                                    d="M18 8c0 3.613-3.869 7.429-5.393 8.795a1 1 0 0 1-1.214 0C9.87 15.429 6 11.613 6 8a6 6 0 0 1 12 0" />
                                <circle cx="12" cy="8" r="2" />
                                <path
                                    d="M8.714 14h-3.71a1 1 0 0 0-.948.683l-2.004 6A1 1 0 0 0 3 22h18a1 1 0 0 0 .948-1.316l-2-6a1 1 0 0 0-.949-.684h-3.712" />
                            </svg>
                            Guest
                        </label>
                        <select id="guest-dropdown" name="guests" class="form-select custom-select pe-5" required>
                            <option value="" disabled {{ !request('guests') ? 'selected' : '' }} hidden>
                                Select Guests
                            </option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('guests') == $i ? 'selected' : '' }}>
                                    {{ $i }} Guest{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-down-icon"
                            style="position: absolute; right: 25px; bottom: 12px; pointer-events: none;">
                            <path d="M12 5v14" />
                            <path d="m19 12-7 7-7-7" />
                        </svg>
                    </div>

                    <div class="form-group pe-0">
                        <button type="submit" class="vs-btn style4 w-100">
                            Search Tours
                        </button>
                    </div>
                </form>
            </div>

        </section>

        @if (isset($topTours) && $topTours->count() > 0)
            <section class="vs-tour-package space">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-6 col-lg-6 col-xxl-5">
                            <div class="title-area text-center text-md-start">
                                <span class="sec-subtitle fade-anim" data-direction="bottom">Explore Our Featured
                                    Private Tours</span>
                                <h2 class="sec-title fade-anim" data-direction="top">
                                    Small Group Tours Morocco
                                </h2>
                                <p class="fade-anim" data-direction="top">
                                    Private and small group tours across Marrakech, the Atlas Mountains and the Sahara
                                    Desert — tailor-made itineraries with a maximum of 8 travelers, led by
                                    English-speaking local guides.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xxl-5">
                            <div
                                class="swiper-arrow2 tour-packages-navigation justify-content-center justify-content-md-end">
                                <button class="tour-packages-next" aria-label="Next Tour Slide">
                                    <svg width="9" height="18" viewBox="0 0 9 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path
                                            d="M8.08984 16.92L1.56984 10.4C0.799843 9.62996 0.799843 8.36996 1.56984 7.59996L8.08984 1.07996"
                                            stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button class="tour-packages-prev btn-right" aria-label="Previous Tour Slide">
                                    <svg width="9" height="18" viewBox="0 0 9 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path
                                            d="M0.910156 16.92L7.43016 10.4C8.20016 9.62996 8.20016 8.36996 7.43016 7.59996L0.910156 1.07996"
                                            stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>

                        </div>
                        <div class="col-12 mt-30 mt-md-0 fade-anim" data-direction="right">
                            <div class="swiper tour-package-slider">
                                <div class="swiper-wrapper">
                                    @foreach ($topTours as $tour)
                                        <div class="swiper-slide">
                                            <div class="tour-package-box bg-white-color">
                                                <div class="tour-package-thumb">
                                                    @if ($tour->is_popular)
                                                        <span class="badge-tour-label">Popular</span>
                                                    @endif

                                                    @php
                                                        $tourImageUrl = $tour->first_image_url;
                                                    @endphp

                                                    @if ($tourImageUrl)
                                                        @php $tourSrcset = \App\Support\ResponsiveImage::srcset($tourImageUrl); @endphp
                                                        {{-- Slides 3+ are offscreen in the swiper — lazy them so they
                                                             stop competing with the hero for slow-4G bandwidth. --}}
                                                        <img src="{{ $tourImageUrl }}" alt="{{ $tour->title }}"
                                                            width="450" height="340"
                                                            @if ($loop->index >= 2) loading="lazy" @endif
                                                            @if ($tourSrcset) srcset="{{ $tourSrcset }}"
                                                            sizes="(max-width: 767px) 100vw, (max-width: 1199px) 50vw, 33vw" @endif>
                                                    @endif
                                                </div>
                                                <div class="tour-package-content">
                                                    <p class="title line-clamp-2">
                                                        <a
                                                            href="{{ route('tours.show', ['slug' => $tour->slug]) }}">{{ $tour->title }}</a>
                                                    </p>


                                                    <div class="pricing-container">
                                                        <div class="package-info">
                                                            <span class="package-location">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                    height="14" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-map-pin-icon lucide-map-pin">
                                                                    <path
                                                                        d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                                                    <circle cx="12" cy="10" r="3" />
                                                                </svg>
                                                                {{ $tour->location ?? ($tour->departure ?? 'Various Locations') }}
                                                            </span>
                                                            <span class="package-time">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                    height="14" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-clock-icon lucide-clock">
                                                                    <path d="M12 6v6l4 2" />
                                                                    <circle cx="12" cy="12" r="10" />
                                                                </svg>
                                                                @php
                                                                    $durationText = 'N/A';
                                                                    if (
                                                                        !empty($tour->duration_days) &&
                                                                        is_numeric($tour->duration_days)
                                                                    ) {
                                                                        $days = (int) $tour->duration_days;
                                                                        $durationText =
                                                                            $days . ' ' . Str::plural('Day', $days);
                                                                    }
                                                                @endphp
                                                                {{ $durationText }}
                                                            </span>
                                                        </div>

                                                        <div class="price-info">
                                                            @if (!empty($tour->discount) && $tour->discount > 0)
                                                                <span class="price-off text-white-color ff-poppins">
                                                                    {{ $tour->discount }}% OFF
                                                                </span>
                                                            @endif
                                                            <div class="price">
                                                                <span class="fs-14 ff-rubik"
                                                                    style="font-weight:700;">Price on request</span>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <a href="{{ route('tours.show', ['slug' => $tour->slug]) }}"
                                                        class="vs-btn style7 w-100">Explore Tour Details <span class="visually-hidden">for {{ $tour->title }}</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if (Route::has('tours.index'))
                                <div class="text-center mt-50">
                                    <a href="{{ route('destinations.index') }}" class="vs-btn style4">
                                        <span>View All Private Morocco Tours</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section class="vs-destination-style1 bg-third-theme-12 overflow-hidden space"
            data-bg-src="{{ asset('assets/img/bg/destination.png') }}">
            <img class="des-icon-1 animate-parachute" src="{{ asset('assets/img/icons/destination-icon-1.png') }}"
                alt="Hot air balloon icon" loading="lazy">
            <img class="des-icon-2 animate-tree" src="{{ asset('assets/img/icons/destination-icon-2.png') }}"
                alt="Palm tree icon" loading="lazy">
            <div class="container">
                <div class="row">
                    <div class="col-lg-auto mx-auto">
                        <div class="title-area text-center">
                            <span class="sec-subtitle fade-anim" data-direction="bottom">
                                Discover Authentic Experiences
                            </span>
                            <h2 class="sec-title fade-anim" data-direction="top">
                                Private Tours Morocco & Exclusive Journeys
                            </h2>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @isset($featuredActivities)
                            @if ($featuredActivities->count() > 0)
                                <div class="destination-box-wrapper">
                                    @foreach ($featuredActivities->take(4) as $activity)
                                        @php
                                            $activityImageUrl = $activity->first_image_url;
                                        @endphp
                                        <a href="{{ route('activities.show', $activity->slug) }}"
                                            class="destination-box d-block text-decoration-none @if ($loop->first) active @endif">
                                            <div class="destination-thumb">
                                                @if ($activity->is_popular)
                                                    <span class="badge-activity-popular">Popular</span>
                                                @endif
                                                @php $activitySrcset = \App\Support\ResponsiveImage::srcset($activityImageUrl); @endphp
                                                <img src="{{ $activityImageUrl }}"
                                                    alt="{{ $activity->title ?? 'Private Morocco Tour Experience' }}"
                                                    class="w-100" loading="lazy" width="410" height="500"
                                                    @if ($activitySrcset) srcset="{{ $activitySrcset }}"
                                                    sizes="(max-width: 767px) 100vw, (max-width: 1199px) 50vw, 25vw" @endif>
                                            </div>
                                            <div class="destination-content">
                                                <div class="info">
                                                    <p class="text-white text-capitalize mb-1"
                                                        style="white-space: normal; word-break: break-word;">
                                                        {{ $activity->title ?? 'Private Morocco Tour' }}
                                                    </p>

                                                    @php
                                                        $subtitle =
                                                            $activity->category->name ??
                                                            (Str::limit($activity->short_description, 30) ??
                                                                'Exclusive Travel Experiences');
                                                    @endphp
                                                    <span class="text-theme-color d-block">{{ $subtitle }}</span>
                                                </div>
                                                <span class="icon bg-theme-color text-white-color"
                                                    aria-label="View {{ $activity->title ?? 'Activity' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-person-standing-icon lucide-person-standing">
                                                        <circle cx="12" cy="5" r="1" />
                                                        <path d="m9 20 3-6 3 6" />
                                                        <path d="m6 8 6 2 6-2" />
                                                        <path d="M12 10v4" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>

                                @if (Route::has('activities.index'))
                                    <div class="text-center mt-50 btn-trigger btn-bounce">
                                        <a href="{{ route('activity-categories.index') }}" class="vs-btn style4">
                                            <span>View More Luxury Morocco Tours</span>
                                        </a>
                                    </div>
                                @endif
                            @else
                                <p class="text-center lead mt-4 text-white">No featured private morocco tours available at the
                                    moment.</p>
                            @endif
                        @else
                            <p class="text-center lead mt-4 text-white">Could not load private tours morocco.</p>
                        @endisset
                    </div>
                </div>
            </div>
        </section>

        <div class="vs-destination-gallery-style1 overflow-hidden">
            <div class="row destination-gallery g-0">
                <div class="col-lg-6 p-0">
                    <figure class="destination-gallery-box h-100">
                        <img src="{{ asset('assets/img/agafay-desert-luxury-camp-camel-trek-morocco-960.webp') }}"
                            srcset="{{ asset('assets/img/agafay-desert-luxury-camp-camel-trek-morocco-480.webp') }} 480w,
                            {{ asset('assets/img/agafay-desert-luxury-camp-camel-trek-morocco-960.webp') }} 960w"
                            sizes="(max-width: 600px) 480px, 960px" alt="private morocco tour experience"
                            title="private tours morocco" class="w-100 h-100 object-fit-cover" loading="lazy"
                            width="960" height="1080" itemprop="image">

                        <div class="icon-box">
                            <a href="{{ asset('assets/img/agafay-desert-luxury-camp-camel-trek-morocco.webp') }}"
                                title="private tours morocco" class="gallery-thumb">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-eye-icon lucide-eye">
                                    <path
                                        d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </a>
                        </div>

                        <figcaption class="content">
                            <span class="fw-bold">Agafay Desert</span><br>
                            Private Morocco Tours & Exclusive Experiences
                        </figcaption>

                        <figcaption class="visually-hidden" lang="en" aria-hidden="true">
                            <span class="fw-bold">Caption:</span> private tours morocco<br>
                            <span class="fw-bold">Description:</span>
                            Experience small group tours morocco in the Agafay Desert near Marrakech, featuring exclusive
                            morocco travel experiences,
                            private accommodation options, and vip morocco tours.
                        </figcaption>


                    </figure>
                </div>

                <div class="col-lg-6">
                    <div class="row g-0">
                        <div class="col-sm-6 p-0">
                            <div class="destination-gallery-box h-100">
                                <img src="{{ asset('assets/img/moroccan_traditional_mechoui_evening_firepit-1200.webp') }}"
                                    srcset="{{ asset('assets/img/moroccan_traditional_mechoui_evening_firepit-600.webp') }} 600w,
                                    {{ asset('assets/img/moroccan_traditional_mechoui_evening_firepit-1200.webp') }} 1200w"
                                    sizes="(max-width: 600px) 600px, 1200px"
                                    alt="small group tours morocco" title="exclusive morocco travel experiences"
                                    class="w-100 h-100 object-fit-cover" loading="lazy" width="600" height="540">

                                <div class="icon-box">
                                    <a href="{{ asset('assets/img/moroccan_traditional_mechoui_evening_firepit.webp') }}"
                                        title="exclusive morocco travel experiences" class="gallery-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-eye-icon lucide-eye">
                                            <path
                                                d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg> </a>
                                </div>

                                <span class="content">Small Group Tours Morocco & Cultural Experiences</span>


                                <figcaption class="visually-hidden" lang="en" aria-hidden="true">
                                    <span class="fw-bold">Caption:</span> small group tours morocco<br>
                                    <span class="fw-bold">Description:</span>
                                    A traditional Moroccan Mechoui dinner prepared during private morocco tours,
                                    offered as part of exclusive morocco travel experiences and vip morocco tours.
                                </figcaption>

                            </div>
                        </div>

                        <div class="col-sm-6 p-0">
                            <div class="destination-gallery-box h-100">
                                <img src="{{ asset('assets/img/moroccan_pastries_hospitality_serving.webp') }}"
                                    alt="vip morocco tours" title="exclusive experiences"
                                    class="w-100 h-100 object-fit-cover" loading="lazy" width="600" height="540">

                                <div class="icon-box">
                                    <a href="{{ asset('assets/img/moroccan_pastries_hospitality_serving.webp') }}"
                                        title="vip morocco tours" class="gallery-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-eye-icon lucide-eye">
                                            <path
                                                d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg> </a>
                                </div>

                                <span class="content">Private Tours Morocco</span>


                                <figcaption class="visually-hidden" lang="en" aria-hidden="true">
                                    <span class="fw-bold">Caption:</span> private morocco tours<br>
                                    <span class="fw-bold">Description:</span>
                                    Moroccan hospitality showcased through traditional pastries,
                                    a signature experience of vip morocco tours and exclusive morocco travel experiences.
                                </figcaption>

                            </div>
                        </div>

                        <div class="col-sm-6 p-0">
                            <div class="destination-gallery-box h-100">
                                <img src="{{ asset('assets/img/gnawa_musician_morocco_local_encounter-1200.webp') }}"
                                    srcset="{{ asset('assets/img/gnawa_musician_morocco_local_encounter-600.webp') }} 600w,
                                    {{ asset('assets/img/gnawa_musician_morocco_local_encounter-1200.webp') }} 1200w"
                                    sizes="(max-width: 600px) 600px, 1200px"
                                    alt="private tour morocco" title="authentic moroccan music"
                                    class="w-100 h-100 object-fit-cover" loading="lazy" width="600" height="540">

                                <div class="icon-box">
                                    <a href="{{ asset('assets/img/gnawa_musician_morocco_local_encounter.webp') }}"
                                        title="private tour morocco" class="gallery-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-eye-icon lucide-eye">
                                            <path
                                                d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg> </a>
                                </div>

                                <span class="content">Private Morocco Tours & Local Culture</span>

                                <figcaption class="visually-hidden" lang="en" aria-hidden="true">
                                    <span class="fw-bold">Caption:</span> private tour morocco<br>
                                    <span class="fw-bold">Description:</span>
                                    An authentic Gnawa music performance experienced on private morocco tours,
                                    included in small group tours morocco and exclusive morocco travel experiences.
                                </figcaption>

                            </div>
                        </div>

                        <div class="col-sm-6 p-0">
                            <div class="destination-gallery-box h-100">
                                <img src="{{ asset('assets/img/souk_experience_morocco_cultural_discoveries-1200.webp') }}"
                                    srcset="{{ asset('assets/img/souk_experience_morocco_cultural_discoveries-600.webp') }} 600w,
                                    {{ asset('assets/img/souk_experience_morocco_cultural_discoveries-1200.webp') }} 1200w"
                                    sizes="(max-width: 600px) 600px, 1200px"
                                    alt="morocco travel agent guided souk" title="moroccan cultural markets"
                                    class="w-100 h-100 object-fit-cover" loading="lazy" width="600" height="540">

                                <div class="icon-box">
                                    <a href="{{ asset('assets/img/souk_experience_morocco_cultural_discoveries.webp') }}"
                                        title="morocco cultural souk experience" class="gallery-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-eye-icon lucide-eye">
                                            <path
                                                d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg> </a>
                                </div>

                                <span class="content">Moroccan Souks & Private Tours</span>
                                <figcaption class="visually-hidden" lang="en" aria-hidden="true">
                                    <span class="fw-bold">Caption:</span> morocco travel agent souk tours<br>
                                    <span class="fw-bold">Description:</span>
                                    Explore vibrant Moroccan souks as part of private tours morocco experiences,
                                    curated by an expert morocco travel agent specializing in private morocco tours.
                                </figcaption>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="vs-feature-style1 position-relative bg-theme-color">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-7 mt-md-0">
                        <h3
                            class="feature-expert text-white-color ff-rubik fw-bold text-center text-md-start char-animation">
                            Ready for Your Private Morocco Tour?
                        </h3>

                    </div>
                    <div
                        class="col-md-5 mt-md-0 d-flex justify-content-center justify-content-md-end btn-trigger btn-bounce">
                        <a class="vs-btn style-4 bg-second-theme-color" href="{{ route('contact.show') }}#plan">
                            Let's Plan Your Trip
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--================= Services Area end =================-->
        <style>
            .bg-second-theme-color {
                background-color: var(--second-theme-color);
            }
        </style>
        <div class="vs-services-style1 space bg-second-theme-color">
            <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="Decorative cloud icon"
                class="vs-services-style1-icon-1 animate-parachute" width="97" height="47">
            <img src="{{ asset('assets/img/icons/ballon.png') }}" alt="Decorative hot air balloon icon"
                class="vs-services-style1-icon-2 animate-parachute"width="45" height="60">
            <div class="container">
                <div class="row g-4 align-items-end">
                    <div class="col-md-6 text-center text-md-start">
                        <div class="row">
                            <div class="col-12 col-xl-11">
                                <div class="title-area text-center text-md-start">
                                    <span class="sec-subtitle fade-anim" data-direction="bottom">Our Services</span>
                                    <h2 class="sec-title text-white-color fade-anim" data-direction="top">
                                        Why Choose Morocco Quest for Private Tours?
                                    </h2>
                                </div>
                                <a class="vs-btn style-4 fade-anim" data-direction="top"
                                    href="{{ route('destinations.index') }}">View All Services</a>
                            </div>
                        </div>

                        <div class="row g-4 pt-120">
                            <div class="col-lg-6 fade-anim">
                                <a href="#support-popup" class="popup-inline text-decoration-none"
                                    aria-label="Learn more about 24/7 support">
                                    <div class="vs-services-box-style1">
                                        <figure class="services-thumb">
                                            <img src="{{ asset('assets/img/morocco-desert-adventure-support.webp') }}"
                                                alt="24/7 support for private morocco tours" class="w-100"
                                                width="300" height="200">
                                        </figure>
                                        <div class="services-content">
                                            <div class="services-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="104" height="81"
                                                    viewBox="0 0 104 81" fill="none">
                                                    <path
                                                        d="M89.0195 24.7886L89.9354 26.6204C92.908 32.5655 97.7287 37.3862 103.674 40.3587H89.0195V24.7886Z"
                                                        fill="white" />
                                                    <path
                                                        d="M14.8281 24.7886L13.9122 26.6204C10.9397 32.5655 6.11901 37.3862 0.173851 40.3587H14.8281V24.7886Z"
                                                        fill="white" />
                                                    <circle cx="40.1642" cy="40.1642" r="36.1642"
                                                        transform="matrix(1 0 0 -1 11.7588 80.3286)" fill="white"
                                                        stroke="white" stroke-width="8" />
                                                    <circle cx="53.1844" cy="40.452" r="30.9969" fill="currentColor"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-dasharray="3 3" />
                                                    <path
                                                        d="M63.4074 41.097C64.0732 41.097 64.7131 40.9046 65.2774 40.5259C66.2128 39.8936 66.8621 38.7466 66.8873 37.5539C66.9164 36.9476 66.8873 36.3054 66.7988 35.5899C66.7489 35.1805 66.3883 34.8634 65.9237 34.9095C65.1296 35.0117 64.3158 35.3886 63.6374 35.9788C63.6055 35.7147 63.5632 35.4526 63.5107 35.1926C64.2634 34.8198 64.8452 34.2211 65.1461 33.4738C65.5821 32.4277 65.4454 31.1357 64.788 30.1017C64.4222 29.5252 64.0282 28.996 63.6181 28.5272C63.3333 28.2026 62.8416 28.169 62.5155 28.4539C61.8084 29.0717 61.3319 29.9681 61.1372 31.054C60.9612 32.0962 61.0981 32.975 61.4919 33.9272C63.1284 37.8152 61.6255 42.2608 58.221 44.4323C57.98 44.5827 57.7896 44.7906 57.6592 45.0326H54.3349V41.8382L57.087 43.2671C57.356 43.4061 57.6732 43.3761 57.9071 43.2052C58.1468 43.0311 58.2675 42.7372 58.2187 42.4447L57.5658 38.5166L60.4026 35.7226C60.6134 35.5149 60.6889 35.2056 60.5973 34.9246C60.5057 34.6428 60.2628 34.4367 59.9704 34.3924L56.0516 33.8023L54.2655 29.8536C54.012 29.2932 53.0941 29.2932 52.8406 29.8536L51.0545 33.8023L47.1356 34.3925C46.8432 34.4368 46.6003 34.643 46.5087 34.9248C46.4171 35.2058 46.4927 35.515 46.7034 35.7227L49.5402 38.5168L48.8874 42.4448C48.8385 42.7373 48.9591 43.0313 49.1989 43.2054C49.4387 43.3795 49.7548 43.4032 50.019 43.2673L52.7711 41.8383V45.0327H49.4223C49.1327 44.5473 48.6903 44.3272 48.2759 44.0033C46.0797 42.2272 44.967 39.6693 44.967 37.2133C44.967 34.0911 46.4084 33.5954 45.9819 31.0449C45.7872 29.9674 45.3114 29.0717 44.6051 28.454C44.2821 28.1699 43.7857 28.202 43.5024 28.5273C43.0893 28.9992 42.6953 29.5291 42.3326 30.1011C41.6752 31.135 41.5369 32.427 41.9699 33.4655C42.2739 34.2197 42.8571 34.82 43.6105 35.1932C43.5579 35.4533 43.5158 35.7156 43.4838 35.9799C42.8032 35.3887 41.9754 35.0117 41.1821 34.9095C40.976 34.8874 40.7667 34.9401 40.6026 35.0684C40.4384 35.1959 40.3315 35.3845 40.307 35.5907C40.2192 36.307 40.191 36.9499 40.2177 37.541C40.2505 38.7772 40.9229 39.9272 41.85 40.532C42.3929 40.9062 43.0351 41.0978 43.7063 41.0978C43.8628 41.0978 44.0218 41.0789 44.1807 41.0579C44.2797 41.2995 44.3788 41.5405 44.4957 41.7739C43.7922 41.683 42.9123 41.7052 42.0508 42.1325C41.6534 42.3296 41.5024 42.8133 41.7056 43.1978C41.9798 43.7193 42.3066 44.3218 42.6952 44.8479C43.3576 45.8148 44.447 46.4798 45.7336 46.4798C46.512 46.4798 47.2603 46.1815 47.8777 45.6461C47.9735 45.7145 48.0635 45.7817 48.0794 45.8147V51.2882H47.2975C46.8653 51.2882 46.5156 51.638 46.5156 52.0702C46.5156 52.5024 46.8653 52.8521 47.2975 52.8521H59.8084C60.2406 52.8521 60.5904 52.5024 60.5904 52.0702C60.5904 51.638 60.2406 51.2882 59.8084 51.2882H59.0265V45.8987C59.0359 45.8502 59.0563 45.8047 59.0563 45.7543C59.1173 45.7153 59.17 45.6675 59.2299 45.6275C60.8568 47.0626 63.1599 46.6219 64.4435 44.8525C64.8103 44.2942 65.1681 43.7628 65.4446 43.1626C65.6218 42.7786 65.4607 42.3227 65.0811 42.1348C64.3675 41.7814 63.5574 41.6776 62.622 41.7924C62.7432 41.5518 62.8627 41.3101 62.9644 41.0599C63.1128 41.0785 63.2611 41.097 63.4074 41.097ZM55.1169 49.7243H51.9891C51.5569 49.7243 51.2072 49.3745 51.2072 48.9423C51.2072 48.5101 51.5569 48.1604 51.9891 48.1604H55.1169C55.5491 48.1604 55.8988 48.5101 55.8988 48.9423C55.8988 49.3745 55.5491 49.7243 55.1169 49.7243Z"
                                                        fill="white" />
                                                </svg>
                                            </div>
                                            <div class="services-content-inner">
                                                <h3 class="services-title">
                                                    <a href="#support-popup" class="popup-link">Support 24/7</a>
                                                </h3>

                                                <p class="fs-16 fw-medium">
                                                    Round-the-clock assistance for a worry-free trip.
                                                </p>
                                                <div class="d-flex justify-content-center">
                                                    <a href="#support-popup" class="vs-btn style4 popup-link">
                                                        <span style="font-size: 12px">Get Support for Your Private
                                                            Tour</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                            height="14" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-arrow-right-icon lucide-arrow-right">
                                                            <path d="M5 12h14" />
                                                            <path d="m12 5 7 7-7 7" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-lg-6 fade-anim">
                                <div class="vs-services-box-style1">
                                    <figure class="services-thumb">
                                        <img src="{{ asset('assets/img/morocco-train-station-al-boraq-travel.webp') }}"
                                            alt="Fast booking for travel on Morocco's Al Boraq high-speed train"
                                            class="w-100" width="300" height="200">
                                    </figure>
                                    <div class="services-content">
                                        <div class="services-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="104" height="81"
                                                viewBox="0 0 104 81" fill="none">
                                                <path
                                                    d="M89.0195 24.7886L89.9354 26.6204C92.908 32.5655 97.7287 37.3862 103.674 40.3587H89.0195V24.7886Z"
                                                    fill="white" />
                                                <path
                                                    d="M14.8281 24.7886L13.9122 26.6204C10.9397 32.5655 6.11901 37.3862 0.173851 40.3587H14.8281V24.7886Z"
                                                    fill="white" />
                                                <circle cx="40.1642" cy="40.1642" r="36.1642"
                                                    transform="matrix(1 0 0 -1 11.7588 80.3286)" fill="white"
                                                    stroke="white" stroke-width="8" />
                                                <circle cx="53.1844" cy="40.452" r="30.9969" fill="currentColor"
                                                    stroke="currentColor" stroke-width="1.5" stroke-dasharray="3 3" />
                                                <path
                                                    d="M63.4074 41.097C64.0732 41.097 64.7131 40.9046 65.2774 40.5259C66.2128 39.8936 66.8621 38.7466 66.8873 37.5539C66.9164 36.9476 66.8873 36.3054 66.7988 35.5899C66.7489 35.1805 66.3883 34.8634 65.9237 34.9095C65.1296 35.0117 64.3158 35.3886 63.6374 35.9788C63.6055 35.7147 63.5632 35.4526 63.5107 35.1926C64.2634 34.8198 64.8452 34.2211 65.1461 33.4738C65.5821 32.4277 65.4454 31.1357 64.788 30.1017C64.4222 29.5252 64.0282 28.996 63.6181 28.5272C63.3333 28.2026 62.8416 28.169 62.5155 28.4539C61.8084 29.0717 61.3319 29.9681 61.1372 31.054C60.9612 32.0962 61.0981 32.975 61.4919 33.9272C63.1284 37.8152 61.6255 42.2608 58.221 44.4323C57.98 44.5827 57.7896 44.7906 57.6592 45.0326H54.3349V41.8382L57.087 43.2671C57.356 43.4061 57.6732 43.3761 57.9071 43.2052C58.1468 43.0311 58.2675 42.7372 58.2187 42.4447L57.5658 38.5166L60.4026 35.7226C60.6134 35.5149 60.6889 35.2056 60.5973 34.9246C60.5057 34.6428 60.2628 34.4367 59.9704 34.3924L56.0516 33.8023L54.2655 29.8536C54.012 29.2932 53.0941 29.2932 52.8406 29.8536L51.0545 33.8023L47.1356 34.3925C46.8432 34.4368 46.6003 34.643 46.5087 34.9248C46.4171 35.2058 46.4927 35.515 46.7034 35.7227L49.5402 38.5168L48.8874 42.4448C48.8385 42.7373 48.9591 43.0313 49.1989 43.2054C49.4387 43.3795 49.7548 43.4032 50.019 43.2673L52.7711 41.8383V45.0327H49.4223C49.1327 44.5473 48.6903 44.3272 48.2759 44.0033C46.0797 42.2272 44.967 39.6693 44.967 37.2133C44.967 34.0911 46.4084 33.5954 45.9819 31.0449C45.7872 29.9674 45.3114 29.0717 44.6051 28.454C44.2821 28.1699 43.7857 28.202 43.5024 28.5273C43.0893 28.9992 42.6953 29.5291 42.3326 30.1011C41.6752 31.135 41.5369 32.427 41.9699 33.4655C42.2739 34.2197 42.8571 34.82 43.6105 35.1932C43.5579 35.4533 43.5158 35.7156 43.4838 35.9799C42.8032 35.3887 41.9754 35.0117 41.1821 34.9095C40.976 34.8874 40.7667 34.9401 40.6026 35.0684C40.4384 35.1959 40.3315 35.3845 40.307 35.5907C40.2192 36.307 40.191 36.9499 40.2177 37.541C40.2505 38.7772 40.9229 39.9272 41.85 40.532C42.3929 40.9062 43.0351 41.0978 43.7063 41.0978C43.8628 41.0978 44.0218 41.0789 44.1807 41.0579C44.2797 41.2995 44.3788 41.5405 44.4957 41.7739C43.7922 41.683 42.9123 41.7052 42.0508 42.1325C41.6534 42.3296 41.5024 42.8133 41.7056 43.1978C41.9798 43.7193 42.3066 44.3218 42.6952 44.8479C43.3576 45.8148 44.447 46.4798 45.7336 46.4798C46.512 46.4798 47.2603 46.1815 47.8777 45.6461C47.9735 45.7145 48.0635 45.7817 48.0794 45.8147V51.2882H47.2975C46.8653 51.2882 46.5156 51.638 46.5156 52.0702C46.5156 52.5024 46.8653 52.8521 47.2975 52.8521H59.8084C60.2406 52.8521 60.5904 52.5024 60.5904 52.0702C60.5904 51.638 60.2406 51.2882 59.8084 51.2882H59.0265V45.8987C59.0359 45.8502 59.0563 45.8047 59.0563 45.7543C59.1173 45.7153 59.17 45.6675 59.2299 45.6275C60.8568 47.0626 63.1599 46.6219 64.4435 44.8525C64.8103 44.2942 65.1681 43.7628 65.4446 43.1626C65.6218 42.7786 65.4607 42.3227 65.0811 42.1348C64.3675 41.7814 63.5574 41.6776 62.622 41.7924C62.7432 41.5518 62.8627 41.3101 62.9644 41.0599C63.1128 41.0785 63.2611 41.097 63.4074 41.097ZM55.1169 49.7243H51.9891C51.5569 49.7243 51.2072 49.3745 51.2072 48.9423C51.2072 48.5101 51.5569 48.1604 51.9891 48.1604H55.1169C55.5491 48.1604 55.8988 48.5101 55.8988 48.9423C55.8988 49.3745 55.5491 49.7243 55.1169 49.7243Z"
                                                    fill="white" />
                                            </svg>
                                        </div>
                                        <div class="services-content-inner">
                                            <h3 class="services-title">
                                                <a href="#fast-booking-popup" class="popup-link">Fast Booking</a>
                                            </h3>
                                            <p class="fs-16 fw-medium">
                                                Easy booking for private tours morocco and vip experiences.
                                            </p>
                                            <div class="d-flex justify-content-center">
                                                <a href="#fast-booking-popup" class="vs-btn style4 popup-link">
                                                    <span style="font-size: 12px">Book Your Private Morocco Tour</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-arrow-right-icon lucide-arrow-right">
                                                        <path d="M5 12h14" />
                                                        <path d="m12 5 7 7-7 7" />
                                                    </svg>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row g-4">
                            <div class="col-lg-6 fade-anim">
                                <div class="vs-services-box-style1">
                                    <figure class="services-thumb">
                                        <img src="{{ asset('assets/img/morocco-sahara-desert-view-camels.webp') }}"
                                            alt="Scenic view of camels in the Sahara Desert, Morocco" class="w-100"
                                            width="300" height="200">
                                    </figure>
                                    <div class="services-content">
                                        <div class="services-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="104" height="81"
                                                viewBox="0 0 104 81" fill="none">
                                                <path
                                                    d="M89.0195 24.7886L89.9354 26.6204C92.908 32.5655 97.7287 37.3862 103.674 40.3587H89.0195V24.7886Z"
                                                    fill="white" />
                                                <path
                                                    d="M14.8281 24.7886L13.9122 26.6204C10.9397 32.5655 6.11901 37.3862 0.173851 40.3587H14.8281V24.7886Z"
                                                    fill="white" />
                                                <circle cx="40.1642" cy="40.1642" r="36.1642"
                                                    transform="matrix(1 0 0 -1 11.7588 80.3286)" fill="white"
                                                    stroke="white" stroke-width="8" />
                                                <circle cx="53.1844" cy="40.452" r="30.9969" fill="currentColor"
                                                    stroke="currentColor" stroke-width="1.5" stroke-dasharray="3 3" />
                                                <path
                                                    d="M63.4074 41.097C64.0732 41.097 64.7131 40.9046 65.2774 40.5259C66.2128 39.8936 66.8621 38.7466 66.8873 37.5539C66.9164 36.9476 66.8873 36.3054 66.7988 35.5899C66.7489 35.1805 66.3883 34.8634 65.9237 34.9095C65.1296 35.0117 64.3158 35.3886 63.6374 35.9788C63.6055 35.7147 63.5632 35.4526 63.5107 35.1926C64.2634 34.8198 64.8452 34.2211 65.1461 33.4738C65.5821 32.4277 65.4454 31.1357 64.788 30.1017C64.4222 29.5252 64.0282 28.996 63.6181 28.5272C63.3333 28.2026 62.8416 28.169 62.5155 28.4539C61.8084 29.0717 61.3319 29.9681 61.1372 31.054C60.9612 32.0962 61.0981 32.975 61.4919 33.9272C63.1284 37.8152 61.6255 42.2608 58.221 44.4323C57.98 44.5827 57.7896 44.7906 57.6592 45.0326H54.3349V41.8382L57.087 43.2671C57.356 43.4061 57.6732 43.3761 57.9071 43.2052C58.1468 43.0311 58.2675 42.7372 58.2187 42.4447L57.5658 38.5166L60.4026 35.7226C60.6134 35.5149 60.6889 35.2056 60.5973 34.9246C60.5057 34.6428 60.2628 34.4367 59.9704 34.3924L56.0516 33.8023L54.2655 29.8536C54.012 29.2932 53.0941 29.2932 52.8406 29.8536L51.0545 33.8023L47.1356 34.3925C46.8432 34.4368 46.6003 34.643 46.5087 34.9248C46.4171 35.2058 46.4927 35.515 46.7034 35.7227L49.5402 38.5168L48.8874 42.4448C48.8385 42.7373 48.9591 43.0313 49.1989 43.2054C49.4387 43.3795 49.7548 43.4032 50.019 43.2673L52.7711 41.8383V45.0327H49.4223C49.1327 44.5473 48.6903 44.3272 48.2759 44.0033C46.0797 42.2272 44.967 39.6693 44.967 37.2133C44.967 34.0911 46.4084 33.5954 45.9819 31.0449C45.7872 29.9674 45.3114 29.0717 44.6051 28.454C44.2821 28.1699 43.7857 28.202 43.5024 28.5273C43.0893 28.9992 42.6953 29.5291 42.3326 30.1011C41.6752 31.135 41.5369 32.427 41.9699 33.4655C42.2739 34.2197 42.8571 34.82 43.6105 35.1932C43.5579 35.4533 43.5158 35.7156 43.4838 35.9799C42.8032 35.3887 41.9754 35.0117 41.1821 34.9095C40.976 34.8874 40.7667 34.9401 40.6026 35.0684C40.4384 35.1959 40.3315 35.3845 40.307 35.5907C40.2192 36.307 40.191 36.9499 40.2177 37.541C40.2505 38.7772 40.9229 39.9272 41.85 40.532C42.3929 40.9062 43.0351 41.0978 43.7063 41.0978C43.8628 41.0978 44.0218 41.0789 44.1807 41.0579C44.2797 41.2995 44.3788 41.5405 44.4957 41.7739C43.7922 41.683 42.9123 41.7052 42.0508 42.1325C41.6534 42.3296 41.5024 42.8133 41.7056 43.1978C41.9798 43.7193 42.3066 44.3218 42.6952 44.8479C43.3576 45.8148 44.447 46.4798 45.7336 46.4798C46.512 46.4798 47.2603 46.1815 47.8777 45.6461C47.9735 45.7145 48.0635 45.7817 48.0794 45.8147V51.2882H47.2975C46.8653 51.2882 46.5156 51.638 46.5156 52.0702C46.5156 52.5024 46.8653 52.8521 47.2975 52.8521H59.8084C60.2406 52.8521 60.5904 52.5024 60.5904 52.0702C60.5904 51.638 60.2406 51.2882 59.8084 51.2882H59.0265V45.8987C59.0359 45.8502 59.0563 45.8047 59.0563 45.7543C59.1173 45.7153 59.17 45.6675 59.2299 45.6275C60.8568 47.0626 63.1599 46.6219 64.4435 44.8525C64.8103 44.2942 65.1681 43.7628 65.4446 43.1626C65.6218 42.7786 65.4607 42.3227 65.0811 42.1348C64.3675 41.7814 63.5574 41.6776 62.622 41.7924C62.7432 41.5518 62.8627 41.3101 62.9644 41.0599C63.1128 41.0785 63.2611 41.097 63.4074 41.097ZM55.1169 49.7243H51.9891C51.5569 49.7243 51.2072 49.3745 51.2072 48.9423C51.2072 48.5101 51.5569 48.1604 51.9891 48.1604H55.1169C55.5491 48.1604 55.8988 48.5101 55.8988 48.9423C55.8988 49.3745 55.5491 49.7243 55.1169 49.7243Z"
                                                    fill="white" />
                                            </svg>
                                        </div>
                                        <div class="services-content-inner">
                                            <h3 class="services-title">
                                                <a href="#adventures-popup" class="popup-link">Adventures</a>
                                            </h3>
                                            <p class="fs-16 fw-medium">
                                                Thrilling experiences for small group tours morocco adventurers.
                                            </p>
                                            <div class="d-flex justify-content-center">
                                                <a href="#adventures-popup" class="vs-btn style4 popup-link">
                                                    <span style="font-size: 12px">Discover Private Tour Adventures</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-arrow-right-icon lucide-arrow-right">
                                                        <path d="M5 12h14" />
                                                        <path d="m12 5 7 7-7 7" />
                                                    </svg> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 fade-anim">
                                <div class="vs-services-box-style1">
                                    <figure class="services-thumb">
                                        <img src="{{ asset('assets/img/morocco-ocean-view-travel-guide.webp') }}"
                                            alt="Expert travel guide service overlooking the Moroccan ocean"
                                            class="w-100" width="300" height="200">
                                    </figure>
                                    <div class="services-content">
                                        <div class="services-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="104" height="81"
                                                viewBox="0 0 104 81" fill="none">
                                                <path
                                                    d="M89.0195 24.7886L89.9354 26.6204C92.908 32.5655 97.7287 37.3862 103.674 40.3587H89.0195V24.7886Z"
                                                    fill="white" />
                                                <path
                                                    d="M14.8281 24.7886L13.9122 26.6204C10.9397 32.5655 6.11901 37.3862 0.173851 40.3587H14.8281V24.7886Z"
                                                    fill="white" />
                                                <circle cx="40.1642" cy="40.1642" r="36.1642"
                                                    transform="matrix(1 0 0 -1 11.7588 80.3286)" fill="white"
                                                    stroke="white" stroke-width="8" />
                                                <circle cx="53.1844" cy="40.452" r="30.9969" fill="currentColor"
                                                    stroke="currentColor" stroke-width="1.5" stroke-dasharray="3 3" />
                                                <path
                                                    d="M63.4074 41.097C64.0732 41.097 64.7131 40.9046 65.2774 40.5259C66.2128 39.8936 66.8621 38.7466 66.8873 37.5539C66.9164 36.9476 66.8873 36.3054 66.7988 35.5899C66.7489 35.1805 66.3883 34.8634 65.9237 34.9095C65.1296 35.0117 64.3158 35.3886 63.6374 35.9788C63.6055 35.7147 63.5632 35.4526 63.5107 35.1926C64.2634 34.8198 64.8452 34.2211 65.1461 33.4738C65.5821 32.4277 65.4454 31.1357 64.788 30.1017C64.4222 29.5252 64.0282 28.996 63.6181 28.5272C63.3333 28.2026 62.8416 28.169 62.5155 28.4539C61.8084 29.0717 61.3319 29.9681 61.1372 31.054C60.9612 32.0962 61.0981 32.975 61.4919 33.9272C63.1284 37.8152 61.6255 42.2608 58.221 44.4323C57.98 44.5827 57.7896 44.7906 57.6592 45.0326H54.3349V41.8382L57.087 43.2671C57.356 43.4061 57.6732 43.3761 57.9071 43.2052C58.1468 43.0311 58.2675 42.7372 58.2187 42.4447L57.5658 38.5166L60.4026 35.7226C60.6134 35.5149 60.6889 35.2056 60.5973 34.9246C60.5057 34.6428 60.2628 34.4367 59.9704 34.3924L56.0516 33.8023L54.2655 29.8536C54.012 29.2932 53.0941 29.2932 52.8406 29.8536L51.0545 33.8023L47.1356 34.3925C46.8432 34.4368 46.6003 34.643 46.5087 34.9248C46.4171 35.2058 46.4927 35.515 46.7034 35.7227L49.5402 38.5168L48.8874 42.4448C48.8385 42.7373 48.9591 43.0313 49.1989 43.2054C49.4387 43.3795 49.7548 43.4032 50.019 43.2673L52.7711 41.8383V45.0327H49.4223C49.1327 44.5473 48.6903 44.3272 48.2759 44.0033C46.0797 42.2272 44.967 39.6693 44.967 37.2133C44.967 34.0911 46.4084 33.5954 45.9819 31.0449C45.7872 29.9674 45.3114 29.0717 44.6051 28.454C44.2821 28.1699 43.7857 28.202 43.5024 28.5273C43.0893 28.9992 42.6953 29.5291 42.3326 30.1011C41.6752 31.135 41.5369 32.427 41.9699 33.4655C42.2739 34.2197 42.8571 34.82 43.6105 35.1932C43.5579 35.4533 43.5158 35.7156 43.4838 35.9799C42.8032 35.3887 41.9754 35.0117 41.1821 34.9095C40.976 34.8874 40.7667 34.9401 40.6026 35.0684C40.4384 35.1959 40.3315 35.3845 40.307 35.5907C40.2192 36.307 40.191 36.9499 40.2177 37.541C40.2505 38.7772 40.9229 39.9272 41.85 40.532C42.3929 40.9062 43.0351 41.0978 43.7063 41.0978C43.8628 41.0978 44.0218 41.0789 44.1807 41.0579C44.2797 41.2995 44.3788 41.5405 44.4957 41.7739C43.7922 41.683 42.9123 41.7052 42.0508 42.1325C41.6534 42.3296 41.5024 42.8133 41.7056 43.1978C41.9798 43.7193 42.3066 44.3218 42.6952 44.8479C43.3576 45.8148 44.447 46.4798 45.7336 46.4798C46.512 46.4798 47.2603 46.1815 47.8777 45.6461C47.9735 45.7145 48.0635 45.7817 48.0794 45.8147V51.2882H47.2975C46.8653 51.2882 46.5156 51.638 46.5156 52.0702C46.5156 52.5024 46.8653 52.8521 47.2975 52.8521H59.8084C60.2406 52.8521 60.5904 52.5024 60.5904 52.0702C60.5904 51.638 60.2406 51.2882 59.8084 51.2882H59.0265V45.8987C59.0359 45.8502 59.0563 45.8047 59.0563 45.7543C59.1173 45.7153 59.17 45.6675 59.2299 45.6275C60.8568 47.0626 63.1599 46.6219 64.4435 44.8525C64.8103 44.2942 65.1681 43.7628 65.4446 43.1626C65.6218 42.7786 65.4607 42.3227 65.0811 42.1348C64.3675 41.7814 63.5574 41.6776 62.622 41.7924C62.7432 41.5518 62.8627 41.3101 62.9644 41.0599C63.1128 41.0785 63.2611 41.097 63.4074 41.097ZM55.1169 49.7243H51.9891C51.5569 49.7243 51.2072 49.3745 51.2072 48.9423C51.2072 48.5101 51.5569 48.1604 51.9891 48.1604H55.1169C55.5491 48.1604 55.8988 48.5101 55.8988 48.9423C55.8988 49.3745 55.5491 49.7243 55.1169 49.7243Z"
                                                    fill="white" />
                                            </svg>
                                        </div>
                                        <div class="services-content-inner">
                                            <h3 class="services-title">
                                                <a href="#travel-guide-popup" class="popup-link">Travel Guide</a>
                                            </h3>
                                            <p class="fs-16 fw-medium">
                                                Expert guides for private morocco tours and exclusive experiences.
                                            </p>
                                            <div class="d-flex justify-content-center">
                                                <a href="#travel-guide-popup" class="vs-btn style4 popup-link">
                                                    <span style="font-size: 12px">Meet Our Private Tour Guides</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-arrow-right-icon lucide-arrow-right">
                                                        <path d="M5 12h14" />
                                                        <path d="m12 5 7 7-7 7" />
                                                    </svg> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 fade-anim">
                                <div class="vs-services-box-style1 v2">
                                    <div class="title-area text-center text-md-start">
                                        <span class="sec-subtitle text-white-color">Client Feedback</span>
                                        <h4 class="sec-title text-white-color">
                                            What Our Travelers Say
                                        </h4>
                                    </div>
                                    <div class="services-content d-flex align-items-center gap-3">
                                        <img src="{{ asset('assets/img/services/vs-services-box-style1-v2-avatars.png') }}"
                                            alt="Happy traveler avatars" loading="lazy" width="168" height="40">
                                        {{-- <div class="services-info">
                                            <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
                                            <div class="elfsight-app-dfd79e86-3367-44ba-b7dd-dc11c1bf0838"
                                                data-elfsight-app-lazy></div>
                                        </div> --}}
                                    </div>
                                    <img src="{{ asset('assets/img/icons/eiffel-tower.png') }}"
                                        alt="Decorative Eiffel Tower icon" class="eiffel-tower" loading="lazy"
                                        width="81" height="184">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!--================= Services Area end =================-->
        <!--================= Awards Area start =================-->
        <section class="awards-style1 space" data-bg-src="{{ asset('assets/img/awards/awards-style1-bg.png') }}">
            <img class="awards-icon-1" src="{{ asset('assets/img/icons/award-icon-1.png') }}"
                alt="Decorative award laurel icon" width="70" height="115">
            <img class="awards-icon-2 move-item" src="{{ asset('assets/img/icons/award-icon-2.png') }}"
                alt="Decorative award ribbon icon" width="55" height="85">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-6 col-lg-6 col-xxl-5">
                        <div class="title-area text-center text-md-start">
                            <span class="sec-subtitle fade-anim" data-direction="top">Recognized Excellence</span>
                            <h2 class="sec-title fade-anim" data-direction="bottom">
                                Awards for Private Morocco Tours
                            </h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5 col-xxl-5">
                        <div class="google-reviewed overflow-hidden w-100" style="max-width: 450px;">
                            <div class="left bg-white-color d-flex align-items-center gap-2 p-2">
                                <img src="{{ asset('assets/img/icons/awards-google.png') }}" alt="Google logo"
                                    style="max-width: 50px;" width="50" height="50">
                                <div class="info">
                                    <strong class="d-block">Google</strong>
                                    <span class="d-block fs-xxs text-uppercase">Reviewed by</span>
                                </div>
                            </div>
                            <div class="right p-2 mt-2 rounded">
                                {{-- <div class="rating d-flex align-items-baseline gap-2">
                                    <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
                                    <div class="elfsight-app-4c95300d-32af-4251-bfa1-17c5c4a7d911" data-elfsight-app-lazy>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-2 g-lg-4 award-box-style1__row">
                    <div class="line-Shape"></div>
                    <div class="col-md-6 col-lg-4 fade-anim" data-delay="0.30" data-direction="right">
                        <div class="award-box-style1">
                            <div class="award-box-style1-wrapper">
                                <figure class="award-box-icon small-award-icon">
                                    <img src="{{ asset('assets/img/partner/tripadvisor-logo.svg') }}"
                                        alt="Tripadvisor Travellers' Choice Award Logo" class="award-logo"
                                        width="240" height="220">
                                </figure>
                                <div
                                    class="award-box-header d-flex align-items-end justify-content-between gap-xl-4 text-center">
                                    <img src="{{ asset('assets/img/awards/award-box-left-wings.png') }}"
                                        alt="Decorative award wings" width="50" height="30">
                                    <h3 class="text-capitalize ff-rubik fw-semibold">
                                        TripAdvisor Travellers' Choice
                                    </h3>

                                    <img src="{{ asset('assets/img/awards/award-box-right-wings.png') }}"
                                        alt="Decorative award wings" width="50" height="30">
                                </div>
                                <div class="award-box-body text-center">
                                    <span class="text-third-theme-color bg-white-color">Tripadvisor</span>
                                </div>
                                <div class="award-box-footer text-capitalize text-center">
                                    <p class="line1">
                                        Received <strong>2022</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 fade-anim" data-delay="0.45" data-direction="right">
                        <div class="award-box-style1">
                            <div class="award-box-style1-wrapper">
                                <figure class="award-box-icon small-award-icon">
                                    <img src="{{ asset('assets/img/partner/tui-cruises-logo.svg') }}"
                                        alt="Tui Cruises Sustainability Award Logo" class="award-logo" width="240"
                                        height="220">
                                </figure>
                                <div
                                    class="award-box-header d-flex align-items-end justify-content-between gap-xl-4 text-center">
                                    <img src="{{ asset('assets/img/awards/award-box-left-wings.png') }}"
                                        alt="Decorative award wings" width="50" height="30">
                                    <h3 class="text-capitalize ff-rubik fw-semibold">
                                        Tui Sustainability Award
                                    </h3>
                                    <img src="{{ asset('assets/img/awards/award-box-right-wings.png') }}"
                                        alt="Decorative award wings" width="50" height="30">
                                </div>
                                <div class="award-box-body text-center">
                                    <span class="text-third-theme-color bg-white-color">Tui Cruises</span>
                                </div>
                                <div class="award-box-footer text-capitalize text-center">
                                    <p class="line1">
                                        Received <strong>2024</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 fade-anim" data-delay="0.60" data-direction="right">
                        <div class="award-box-style1">
                            <div class="award-box-style1-wrapper">
                                <figure class="award-box-icon text-center">
                                    <img src="{{ asset('assets/img/partner/iagto-logo.svg') }}"
                                        alt="IAGTO Supplier's Award Logo" width="140" height="220">
                                </figure>
                                <div
                                    class="award-box-header d-flex align-items-end justify-content-between gap-xl-4 text-center">
                                    <img src="{{ asset('assets/img/awards/award-box-left-wings.png') }}"
                                        alt="Decorative award wings" width="50" height="30">
                                    <h3 class="text-capitalize ff-rubik fw-semibold">
                                        IAGTO Supplier's Awards
                                    </h3>
                                    <img src="{{ asset('assets/img/awards/award-box-right-wings.png') }}"
                                        alt="Decorative award wings" width="50" height="30">
                                </div>
                                <div class="award-box-body text-center">
                                    <span class="text-third-theme-color bg-white-color">I A G T O</span>
                                </div>
                                <div class="award-box-footer text-capitalize text-center">
                                    <p class="line1">
                                        Received <strong>2025</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================= Awards Area end =================-->

        <section class="blog-style1 space-top space-extra-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-auto mx-auto">
                        <div class="title-area text-center">
                            <span class="sec-subtitle fade-anim" data-direction="bottom">Travel Tips & Guides</span>
                            <h2 class="sec-title fade-anim" data-direction="top">Morocco Travel Guide & Insights</h2>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse ($latestPosts as $post)
                        <div class="col-md-6 col-lg-4 move-anim">
                            <div class="vs-blog-box style1">
                                <figure class="blog-thumb">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        @php $postSrcset = \App\Support\ResponsiveImage::srcset($post->featured_image_url); @endphp
                                        <img src="{{ $post->featured_image_url }}" loading="lazy"
                                            alt="{{ $post->title }}" class="w-100" width="410" height="275"
                                            @if ($postSrcset) srcset="{{ $postSrcset }}"
                                            sizes="(max-width: 767px) 100vw, (max-width: 1199px) 50vw, 33vw" @endif>
                                    </a>
                                </figure>

                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <ul class="custom-ul">
                                            <li>
                                                <a href="#"><i class="fa fa-user-circle"></i> by
                                                    {{ $post->written_by }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('blog.show', $post->slug) }}#comments">
                                                    <i class="fa fa-comments"></i>
                                                    {{ $post->comments_count }} comments
                                                </a>
                                            </li>
                                            <li class="date">
                                                <div class="vs-blog-date">
                                                    <span class="date-number">{{ $post->created_day }}</span>
                                                    <span class="date-month">{{ $post->created_month }}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <p class="blog-title line-clamp-2">
                                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                    </p>

                                    <div class="blog-footer">
                                        <a href="{{ route('blog.show', $post->slug) }}" class="vs-btn style4">
                                            <span>Read Full Post <span class="visually-hidden">— {{ $post->title }}</span></span>
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                        <ul class="custom-ul blog-share">
                                            <li>
                                                <i class="fa fa-share-alt"></i>
                                                <ul class="custom-ul share-list">
                                                    <li>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}"
                                                            class="facebook" target="_blank" rel="nofollow noopener noreferrer"
                                                            aria-label="Share on Facebook">
                                                            <i class="fa-brands fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}"
                                                            class="twitter" target="_blank" rel="nofollow noopener noreferrer"
                                                            aria-label="Share on Twitter">
                                                            <i class="fa-brands fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(route('blog.show', $post->slug)) }}&media={{ urlencode($post->featured_image_url) }}&description={{ urlencode($post->title) }}"
                                                            class="pinterest" target="_blank" rel="nofollow noopener noreferrer"
                                                            aria-label="Share on Pinterest">
                                                            <i class="fa-brands fa-pinterest-p"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://www.instagram.com/?url={{ urlencode(route('blog.show', $post->slug)) }}"
                                                            class="instagram" target="_blank" rel="nofollow noopener noreferrer"
                                                            aria-label="Share on Instagram">
                                                            <i class="fa-brands fa-instagram"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://www.tiktok.com/upload?url={{ urlencode(route('blog.show', $post->slug)) }}"
                                                            class="tiktok" target="_blank" rel="nofollow noopener noreferrer"
                                                            aria-label="Share on TikTok">
                                                            <i class="fa-brands fa-tiktok"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center lead">No recent blog posts found.</p>
                        </div>
                    @endforelse
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="swiper partner-slider space-top custom-swiper"
                            style="max-width: 1200px; margin: 0 auto;">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="{{ asset('assets/img/partner/paypal.webp') }}" alt="PayPal"
                                        class="mono-logo" loading="lazy" width="200" height="50">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('assets/img/partner/nationalgeographic.webp') }}"
                                        alt="National Geographic" class="mono-logo" loading="lazy" width="200"
                                        height="50">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('assets/img/partner/visitemorocco.webp') }}" alt="Visit Morocco"
                                        class="mono-logo" loading="lazy" width="200" height="50">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('assets/img/partner/condenast.webp') }}" alt="Condé Nast"
                                        class="mono-logo" loading="lazy" width="200" height="50">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('assets/img/partner/onmt.webp') }}" alt="ONMT"
                                        class="mono-logo" loading="lazy" width="200" height="50">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- Magnific Popup is loaded once by the layout (deferred). A second CDN copy
             here executed before jQuery (defer runs in document order) and threw
             "TypeError: a is not a function" — removed. --}}

        <!-- Initialization Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof jQuery !== 'undefined' && $.fn.magnificPopup && $('.popup-inline').length > 0) {
                    $('.popup-inline').magnificPopup({
                        type: 'inline',
                        midClick: true,
                        removalDelay: 300,
                        mainClass: 'mfp-fade'
                    });
                }
            });
        </script>


    </main>
    <style>.popup-heading{color:#000;font-size:1.5rem;font-weight:700;line-height:1.3;margin-bottom:.75rem}</style>
    <!-- 🔒 Support Modal Popup -->
    <div id="support-popup" class="mfp-hide service-popup">
        <div class="popup-inner">
            <div class="popup-image">
                <img src="{{ asset('assets/img/morocco-desert-adventure-support.webp') }}"
                    alt="24/7 Support for Private Tours">
            </div>
            <div class="popup-content">
                <p class="popup-heading">24/7 Support for Private Morocco Tours</p>
                <p>
                    Our dedicated team supports travelers booking private tours morocco, small group tours morocco,
                    and exclusive morocco travel experiences. We are available 24/7 to assist with vip morocco tours,
                    private tour planning, and morocco travel insurance inquiries.
                </p>
            </div>
        </div>
    </div>

    <!-- 🌍 Adventures Modal Popup -->
    <div id="adventures-popup" class="mfp-hide service-popup">
        <div class="popup-inner">
            <div class="popup-image">
                <img src="{{ asset('assets/img/morocco-sahara-desert-view-camels.webp') }}"
                    alt="Adventures for Private Tours">
            </div>
            <div class="popup-content">
                <p class="popup-heading">Private Morocco Tours Adventures</p>
                <p>
                    Experience unforgettable adventures through private tours morocco itineraries,
                    small group tours morocco, and exclusive morocco travel experiences.
                    Our private morocco tour packages combine comfort, authentic culture, and premium desert adventures.
                </p>
            </div>
        </div>
    </div>

    <!-- 🧭 Travel Guide Modal Popup -->
    <div id="travel-guide-popup" class="mfp-hide service-popup">
        <div class="popup-inner">
            <div class="popup-image">
                <img src="{{ asset('assets/img/morocco-ocean-view-travel-guide.webp') }}" alt="Expert Travel Guide">
            </div>
            <div class="popup-content">
                <p class="popup-heading">Expert Morocco Travel Agent Guides</p>
                <p>
                    Discover Morocco with experienced professionals specializing in private morocco tours,
                    small group tours morocco, and exclusive morocco travel experiences.
                    Our expert guides ensure premium service across cities, deserts, and cultural destinations.
                </p>
            </div>
        </div>
    </div>

    <!-- ⚡ Fast Booking Modal Popup -->
    <div id="fast-booking-popup" class="mfp-hide service-popup">
        <div class="popup-inner">
            <div class="popup-image">
                <img src="{{ asset('assets/img/morocco-train-station-al-boraq-travel.webp') }}"
                    alt="Fast Booking System">
            </div>
            <div class="popup-content">
                <p class="popup-heading">Fast Booking for Private Morocco Tours</p>
                <p>
                    Easily book private tours morocco, vip morocco tours, small group tours morocco,
                    and exclusive morocco travel experiences through our secure booking system.
                    Enjoy seamless booking from planning with our expert morocco travel agent to departure.
                </p>
            </div>
        </div>
    </div>



    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            if (typeof jQuery !== "undefined" && $('.popup-link').length > 0) {
                $('.popup-link').magnificPopup({
                    type: 'inline',
                    midClick: true,
                    removalDelay: 300,
                    mainClass: 'mfp-fade'
                });
            }
        });
    </script>


    <style>
        html {
            scroll-behavior: smooth;
        }

        /* --- A11y boosters (activate only via JS) --- */

        /* Adds a very subtle dark overlay under text, barely visible */
        .a11y-boost-overlay {
            position: relative;
        }

        .a11y-boost-overlay::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .08);
            /* ~8% darken, visually tiny */
            pointer-events: none;
            z-index: 0;
        }

        /* Keep text above the tiny overlay */
        .a11y-boost-overlay>* {
            position: relative;
            z-index: 1;
        }

        /* In the footer, make links inherit the surrounding text color (no brand override) */
        .footer-bottom.bg-third-theme-color.a11y-boost-overlay a.text-theme-color {
            color: inherit;
            /* inherits the footer’s text color */
        }

        .footer-bottom.bg-third-theme-color a.text-theme-color:hover {
            color: #bb5e2a !important;
            text-decoration: none !important;
        }

        /* Optional: for hero/logo text sitting on images, use a slightly stronger overlay ONLY if needed */
        .a11y-boost-overlay-hero::before {
            background: rgba(0, 0, 0, .20);
            /* still subtle; only added when contrast actually fails */
        }

        /* icons with wrong ratio: fix height only, keep your widths */
        .awards-icon-1 {
            /* actual 119x240  => 119/240 */
            aspect-ratio: 119 / 240;
            height: auto !important;
            object-fit: contain;
        }

        .awards-icon-2 {
            /* actual 85x85 => square */
            aspect-ratio: 1 / 1;
            height: auto !important;
            object-fit: contain;
        }

        .vs-services-style1-icon-1 {
            /* cloud actual 103x70 => 103/70 */
            aspect-ratio: 103 / 70;
            height: auto !important;
            object-fit: contain;
        }

        .vs-services-style1-icon-2 {
            /* balloon actual 79x85 => 79/85 */
            aspect-ratio: 79 / 85;
            height: auto !important;
            object-fit: contain;
        }
    </style>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // WCAG Luminance/Contrast helpers
            function srgbToLin(c) {
                c /= 255;
                return (c <= 0.03928) ? c / 12.92 : Math.pow((c + 0.055) / 1.055, 2.4);
            }

            function relLum(rgb) {
                const [r, g, b] = rgb;
                const R = srgbToLin(r),
                    G = srgbToLin(g),
                    B = srgbToLin(b);
                return 0.2126 * R + 0.7152 * G + 0.0722 * B;
            }

            function parseColor(str) {
                // expects rgb(a) or hex; fall back to white
                const ctx = document.createElement('canvas').getContext('2d');
                ctx.fillStyle = str;
                const computed = ctx.fillStyle; // normalized
                // now get as rgb
                const div = document.createElement('div');
                div.style.color = computed;
                document.body.appendChild(div);
                const rgb = getComputedStyle(div).color.match(/\d+/g).map(Number);
                document.body.removeChild(div);
                return rgb.slice(0, 3);
            }

            function contrastRatio(fgRGB, bgRGB) {
                const L1 = relLum(fgRGB),
                    L2 = relLum(bgRGB);
                const lighter = Math.max(L1, L2),
                    darker = Math.min(L1, L2);
                return (lighter + 0.05) / (darker + 0.05);
            }

            // Compute solid background color (walk up until a non-transparent bg is found)
            function getEffectiveBgRGB(el) {
                let node = el;
                while (node && node !== document.documentElement) {
                    const cs = getComputedStyle(node);
                    const bg = cs.backgroundColor;
                    if (bg && bg !== 'rgba(0, 0, 0, 0)' && bg !== 'transparent') {
                        const m = bg.match(/\d+/g);
                        if (m && m.length >= 3) return m.slice(0, 3).map(Number);
                    }
                    node = node.parentElement;
                }
                return [255, 255, 255]; // default white
            }

            // Targets reported by Lighthouse
            const targets = [
                // Footer bar
                {
                    sel: '.footer-bottom.bg-third-theme-color',
                    type: 'footer'
                },
                // Brand links on light backgrounds
                {
                    sel: 'a.text-decoration-underline.text-theme-color',
                    type: 'brandLink'
                },
                // Site/brand title on hero (adjust selector to your hero container if needed)
                {
                    sel: '.hero-banner .site-branding a, .hero-banner .hero-title',
                    type: 'hero'
                }
            ];

            targets.forEach(t => {
                document.querySelectorAll(t.sel).forEach(el => {
                    const cs = getComputedStyle(el);
                    const fg = parseColor(cs.color);
                    const bg = getEffectiveBgRGB(el);

                    let ratio = contrastRatio(fg, bg);

                    // Only intervene if it actually fails (AA normal text: 4.5:1; headings often 3:1—but Lighthouse usually expects 4.5 unless large text)
                    if (ratio < 4.5) {
                        // Add minimal overlay only to the container (not changing your colors)
                        let container = el;
                        // Prefer a known container: footer bar or hero wrapper
                        if (t.type === 'footer') container = el.closest(
                            '.footer-bottom.bg-third-theme-color') || el;
                        if (t.type === 'hero') container = el.closest('.hero-banner') || el;

                        if (container) {
                            container.classList.add('a11y-boost-overlay');
                            if (t.type === 'hero') container.classList.add(
                                'a11y-boost-overlay-hero');
                        }

                        // Re-evaluate quickly assuming ~8–20% darkening under text
                        // (This is just to keep the script idempotent; real improvement comes from the overlay)
                    }
                });
            });
        });
    </script>

 --}}

@endsection
