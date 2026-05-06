{{-- resources/views/home.blade.php --}}

@extends('layouts/app') {{-- Use the app.blade.php layout --}}

@section('title', 'Morocco Private Tours | Marrakech Desert Tours & Sahara - Morocco Quest')
@section('description', 'Morocco private tours and marrakech desert tours. Sahara desert tour from marrakech, luxury desert tours marrakech, and private tours in morocco. Best morocco private tour company.')
@section('keywords', 'morocco private tours, private morocco tours, marrakech desert tours, desert tours marrakech, sahara desert tour from marrakech, luxury desert tours marrakech, sahara desert tours morocco, private tours in morocco, best morocco private tour company, private tour morocco')

@push('jsonld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Morocco Quest",
  "url": "{{ url('/') }}",
  "description": "Morocco private tours, marrakech desert tours, sahara desert tour from marrakech, luxury desert tours marrakech, and private tours in morocco.",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{{ url('/tours/search') }}?query={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Marrakech Desert Tours and Morocco Private Tours",
  "description": "Marrakech desert tours, sahara desert tour from marrakech, luxury desert tours marrakech, and private tours in morocco.",
  "itemListElement": [
    {"@type":"ListItem","position":1,"name":"morocco private tours","url":"{{ url('/tours') }}"},
    {"@type":"ListItem","position":2,"name":"marrakech desert tours","url":"{{ url('/tours') }}"},
    {"@type":"ListItem","position":3,"name":"sahara desert tour from marrakech","url":"{{ url('/tours') }}"},
    {"@type":"ListItem","position":4,"name":"luxury desert tours marrakech","url":"{{ url('/tours') }}"},
    {"@type":"ListItem","position":5,"name":"private tours in morocco","url":"{{ url('/tours') }}"},
    {"@type":"ListItem","position":6,"name":"best morocco private tour company","url":"{{ url('/about') }}"}
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "What are the best Marrakech desert tours?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Our most popular marrakech desert tours include the sahara desert tour from marrakech to Merzouga (3 to 4 days), luxury desert tours marrakech with private camp at Erg Chebbi, and the morocco desert tours from marrakech that combine the Atlas Mountains with the dunes."
      }
    },
    {
      "@type": "Question",
      "name": "Do you offer private tours in Morocco?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. All our morocco private tours include a private vehicle, English-speaking driver, and tailor-made itineraries. We are recognized as one of the best morocco private tour company options for couples, families, and small groups."
      }
    },
    {
      "@type": "Question",
      "name": "How long is a sahara desert tour from Marrakech?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "A sahara desert tour from marrakech typically takes 3 days for Merzouga round trip, or 4 days for a deeper desert experience. We also offer luxury sahara desert tour from marrakech with premium camps."
      }
    },
    {
      "@type": "Question",
      "name": "Which is the best morocco itinerary?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "The best morocco itinerary depends on your time. The most popular is morocco itinerary one week (best 7 day morocco itinerary) covering Marrakech and the Sahara. For longer trips we recommend a morocco 14 day itinerary including imperial cities and the desert."
      }
    }
  ]
}
</script>
@endpush

@section('content') {{-- Define the content section --}}

    <!-- ================= Main Section Wrapper ================= -->
    {{-- The <main> tag might already be in your app.blade.php. If so, remove it from here. --}}
        {{-- If app.blade.php does NOT have <main>, keep it here. --}}
            <main class="main">
                {{-- Header is included in app.blade.php --}}

                <!--================= Hero Area =================-->
                <section class="z-index-common hero-layout1 overflow-clip"
                    data-bg-src="{{ asset('assets/img/hero/hero.jpg') }}" {{-- Use asset helper --}}>
                    <div class="container-fluid p-xl-0">
                        <div class="row justify-content-center">
                            <div class="col-xl-10 col-xxl-7">
                                <div class="hero-content text-center">
                                    <img class="fade-anim" data-delay="0.70"
                                        src="{{ asset('assets/img/icons/hero-sun.png') }}" {{-- Use asset helper --}}
                                        alt="icon" />
                                    <div class="title-area text-center">
                                        <span class="sec-subtitle mb-0 fade-anim" data-delay="0.75"
                                            data-direction="bottom">Crafted for your requests!</span>
                                        <h1 class="sec-title text-white-color fade-anim"
                                            style="font-size: 69px; font-family: 'Amatic SC', sans-serif;" ; {{-- Keep
                                            inline style if needed --}} data-delay="0.76" data-direction="top">
                                            Find your holiday <br class="d-none d-xxl-block" />
                                            with us
                                        </h1>
                                    </div>
                                    <div class="search-box fade-anim" data-delay="0.77" data-direction="top">
                                        {{-- Update form action to your search results route --}}
                                        <form action="#" method="GET" class="align-items-center">
                                            {{-- Example Route --}}
                                            <!-- Tour Type Field -->
                                            <div class="form-group ps-0">
                                                <label for="select-tour-type" {{-- Changed id/for --}}
                                                    class="form-label d-flex align-items-center">
                                                    <i class="fa-sharp fa-light fa-location-dot me-2"></i>
                                                    Tours
                                                </label>
                                                <select id="select-tour-type" {{-- Changed id --}} name="tour_type" {{-- Use
                                                    a descriptive name --}} class="form-select">
                                                    <option value="" disabled selected hidden> Select Tour </option>
                                                    {{-- Consider populating these options dynamically if they come from DB
                                                    --}}
                                                    <option value="garden-tours" {{ old('tour_type') == 'garden-tours' ? 'selected' : '' }}>Garden Tours</option>
                                                    <option value="art-tours" {{ old('tour_type') == 'art-tours' ? 'selected' : '' }}>Art Tours</option>
                                                    <option value="classical-tours" {{ old('tour_type') == 'classical-tours' ? 'selected' : '' }}>Classical Tours</option>
                                                    <option value="city-tours" {{ old('tour_type') == 'city-tours' ? 'selected' : '' }}>City Tours</option>
                                                    <option value="day-trips" {{ old('tour_type') == 'day-trips' ? 'selected' : '' }}>Day Trips</option>
                                                    <option value="local-experiences" {{ old('tour_type') == 'local-experiences' ? 'selected' : '' }}>Local
                                                        Experiences</option>
                                                    <option value="outdoor-activities" {{ old('tour_type') == 'outdoor-activities' ? 'selected' : '' }}>Outdoor
                                                        Activities</option>
                                                </select>
                                            </div>

                                            <!-- Date Field -->
                                            <div class="form-group">
                                                <label for="search-date" class="form-label d-flex align-items-center">
                                                    <i class="fa-regular fa-calendar-days me-2"></i>
                                                    Date
                                                </label>
                                                <input type="text" id="search-date" {{-- JS datepicker likely targets this
                                                    ID --}} name="date_range" {{-- Use a descriptive name --}}
                                                    class="form-select" {{-- Keep class if datepicker targets it --}}
                                                    placeholder="Select Date Range" readonly {{-- Usually set by datepicker
                                                    --}} value="{{ old('date_range') }}" {{-- Retain value on validation
                                                    fail --}} />
                                            </div>
                                            <!-- Guest Field -->
                                            <div class="form-group">
                                                <label for="guest-dropdown" class="form-label d-flex align-items-center">
                                                    <i class="fa-regular fa-user-hoodie me-2"></i> Guest
                                                </label>
                                                <select id="guest-dropdown" name="guests" {{-- Use a descriptive name --}}
                                                    class="form-select">
                                                    {{-- Consider setting a default or using old() --}}
                                                    <option value="1" {{ old('guests', 2) == 1 ? 'selected' : '' }}>1 Guest
                                                    </option> {{-- Example using old() with default --}}
                                                    <option value="2" {{ old('guests', 2) == 2 ? 'selected' : '' }}>2 Guests
                                                    </option>
                                                    <option value="3" {{ old('guests', 2) == 3 ? 'selected' : '' }}>3 Guests
                                                    </option>
                                                    <option value="4" {{ old('guests', 2) == 4 ? 'selected' : '' }}>4 Guests
                                                    </option>
                                                    <option value="5" {{ old('guests', 2) == 5 ? 'selected' : '' }}>5+ Guests
                                                    </option>
                                                </select>
                                            </div>
                                            <!-- Submit Button -->
                                            <div class="form-group pe-0">
                                                <button type="submit" class="vs-btn style4 w-100">
                                                    Search
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--================= Hero Area end =================-->

               <!--================= Top Tours Area start (Adapted from Destination) =================-->
<section class="vs-destination-style1 bg-third-theme-12 overflow-hidden space"
    data-bg-src="{{ asset('assets/img/bg/destination.png') }}"> {{-- Use asset --}}
    {{-- Static Decorative Icons --}}
    <img class="des-icon-1 animate-parachute" src="{{ asset('assets/img/icons/destination-icon-1.png') }}" alt="icon" />
    <img class="des-icon-2 animate-tree" src="{{ asset('assets/img/icons/destination-icon-2.png') }}" alt="icon" />

    <div class="container">
        <div class="row">
            <div class="col-lg-auto mx-auto">
                {{-- Section Title --}}
                <div class="title-area text-center">
                    <span class="sec-subtitle fade-anim" data-direction="top">Top Selections</span>
                    <h2 class="sec-title move-anim">Discover Top Tours</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{-- Check if $topTours collection exists and is not empty --}}
                @isset($topTours)
                    @if($topTours->count() > 0)
                        <div class="destination-box-wrapper">
                            {{-- Loop through the $topTours collection from the controller --}}
                            @foreach ($topTours as $tour)
                                {{-- Apply 'active' class to the first item in the loop --}}
                                <div class="destination-box @if($loop->first) active @endif">
                                    <div class="destination-thumb">
                                        {{-- Dynamic Image --}}
                                        <img src="{{ asset($tour->images->isNotEmpty() ? $tour->images->first()->image : 'assets/img/destination/destination-1-1.png') }}"
     alt="{{ $tour->title ?? 'Top Tour Image' }}"
     class="w-100" />
                                    </div>
                                    <div class="destination-content">
                                        <div class="info">
                                            <h4 class="text-white text-capitalize">
                                                {{-- Dynamic Link (check slug & route) --}}
                                                @if($tour->slug && Route::has('tours.show'))
                                                    <a href="{{ route('tours.show', $tour->slug) }}">
                                                        {{ $tour->title ?? 'View Tour' }} {{-- Dynamic Title --}}
                                                    </a>
                                                @else
                                                    {{ $tour->title ?? 'View Tour' }} {{-- Display title without link --}}
                                                @endif
                                            </h4>
                                            {{-- Dynamic Subtitle (e.g., using tour_type field, add fallback) --}}
                                            @if($tour->tour_type)
                                                <span class="text-theme-color d-block">{{ $tour->tour_type }}</span>
                                            @endif
                                            {{-- Alternative: <span class="text-theme-color d-block">{{ $tour->short_description ?? 'Exciting Adventure' }}</span> --}}
                                        </div>
                                        {{-- Dynamic Icon Link (check slug & route) --}}
                                         @if($tour->slug && Route::has('tours.show'))
                                            <a href="{{ route('tours.show', $tour->slug) }}" class="icon bg-theme-color text-white-color">
                                                <i class="fa-solid fa-location-dot"></i> {{-- Or use a different icon like fa-eye --}}
                                            </a>
                                        @else
                                            {{-- Optional: Show icon without link --}}
                                            {{-- <span class="icon bg-theme-color text-white-color"><i class="fa-solid fa-location-dot"></i></span> --}}
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            {{-- End loop --}}
                        </div>

                        {{-- Button to view all tours --}}
                        <div class="text-center mt-50 btn-trigger btn-bounce">
                            <a href="{{ route('tours.index') }}" class="vs-btn style4">
                                <span>view more tours</span>
                            </a>
                        </div>
                    @else
                         {{-- Message if no top tours are found --}}
                         <p class="text-center lead mt-4">No featured tours available at the moment.</p>
                    @endif
                @else
                     {{-- Message if $topTours variable wasn't passed --}}
                     <p class="text-center lead mt-4">Could not load top tours.</p>
                @endisset
            </div>
        </div>
    </div>
</section>
<!--================= Top Tours Area end =================-->

<!--================= Tour Package Area start =================-->
{{-- Ensure $featuredActivities is passed from your controller --}}
@if(isset($featuredActivities) && $featuredActivities->count() > 0)
<section class="vs-tour-package space">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            {{-- Title Area --}}
            <div class="col-md-6 col-lg-6 col-xxl-5">
                <div class="title-area text-center text-md-start">
                    <span class="sec-subtitle fade-anim" data-direction="bottom">Featured Activities</span>
                    <h2 class="sec-title fade-anim" data-direction="top">
                        Multi-Day Adventures
                    </h2>
                </div>
            </div>
            {{-- Swiper Navigation Controls --}}
            <div class="col-md-6 col-lg-6 col-xxl-5">
                <div class="swiper-arrow2 tour-packages-navigation justify-content-center justify-content-md-end">
                    <button class="tour-packages-next"> <svg width="9" height="18" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.08984 16.92L1.56984 10.4C0.799843 9.62996 0.799843 8.36996 1.56984 7.59996L8.08984 1.07996" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" /></svg> </button>
                    <button class="tour-packages-prev btn-right"> <svg width="9" height="18" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.910156 16.92L7.43016 10.4C8.20016 9.62996 8.20016 8.36996 7.43016 7.59996L0.910156 1.07996" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" /></svg> </button>
                </div>
            </div>
            {{-- Swiper Slider Container --}}
            <div class="col-12 mt-30 mt-md-0 fade-anim" data-direction="right">
                <div class="swiper tour-package-slider">
                    <div class="swiper-wrapper">
                        @foreach($featuredActivities as $activity)
                            <div class="swiper-slide">
                                <div class="tour-package-box bg-white-color">
                                    <div class="tour-package-thumb">
                                        @php
                                            $imageUrl = optional($activity->images->first())->image
                                                        ? asset(optional($activity->images->first())->image)
                                                        : asset('assets/img/tour-packages/tour-placeholder.png');
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="{{ $activity->title }}" class="w-100" />
                                    </div>
                                    <div class="tour-package-content">
                                        <h5 class="title line-clamp-2">
                                            <a href="{{ route('activities.show', ['slug' => $activity->slug]) }}">{{ $activity->title }}</a>
                                        </h5>
                                        <div class="pricing-container">
                                            <div class="package-info">
                                                <span class="package-location">
                                                    <i class="fa-sharp fa-thin fa-location-dot"></i>
                                                    {{ $activity->departure ?? 'Various Locations' }}
                                                </span>
                                                <span class="package-time">
                                                    <i class="fa-sharp fa-thin fa-clock"></i>
                                                    {{ $activity->duration_days ?? 'N/A' }} {{ Str::plural('Day', $activity->duration_days ?? 0) }}
                                                </span>
                                            </div>
                                            <div class="price-info">
                                                {{-- VVV CHANGE THIS PART VVV --}}
                                                {{-- Check if discount exists and is > 0 --}}
                                                @if(isset($activity->discount_percentage) && $activity->discount_percentage > 0)
                                                    {{-- Display Discount Badge --}}
                                                    <span class="price-off text-white-color ff-poppins">
                                                        {{ $activity->discount_percentage }}% OFF
                                                    </span>
                                                @endif
                                                {{-- ^^^ END CHANGE ^^^ --}}

                                                <div class="price">
                                                    {{-- NOTE: This price might need adjustment --}}
                                                    {{-- Is $activity->price_adult the ORIGINAL price or the ALREADY DISCOUNTED price? --}}
                                                    {{-- If it's the original, you might want to calculate the discounted price here. --}}
                                                    {{-- If it's already discounted, this is fine. --}}
                                                    <h6 class="fs-30 ff-rubik">from ${{ number_format($activity->price_adult ?? 0) }}</h6>
                                                    {{-- Optional: If showing original price crossed out: --}}
                                                    {{-- @if(isset($activity->discount_percentage) && $activity->discount_percentage > 0 && isset($activity->original_price_adult))
                                                        <del class="fs-sm ff-rubik">${{ number_format($activity->original_price_adult) }}</del>
                                                    @endif --}}
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('activities.show', ['slug' => $activity->slug]) }}" class="vs-btn style7 w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

                <!--================= Destination Gallery Area start =================-->
                <div class="vs-destination-gallery-style1 overflow-hidden">
                    {{-- Ensure Magnific Popup JS is initialized (likely in main.js or layout) targeting '.gallery-thumb'
                    --}}
                    <div class="row destination-gallery g-0"> {{-- Added g-0 --}}
                        <div class="col-lg-6 p-0">
                            <div class="destination-gallery-box h-100">
                                <img src="{{ asset('assets/img/destination-galler/destination-gallery-1-1.png') }}" {{-- Use
                                    asset --}} alt="Marrakech Koutoubia" class="w-100 h-100 object-fit-cover" {{-- Added
                                    object-fit --}} />
                                <div class="icon-box">
                                    <a href="{{ asset('assets/img/destination-galler/destination-gallery-1-1.png') }}" {{--
                                        Link to image for lightbox --}} title="Marrakech Koutoubia" class="gallery-thumb"
                                        {{-- Class for JS lightbox trigger --}}>
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                                <span class="content">Marrakech</span> {{-- Location Name --}}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row g-0"> {{-- Added g-0 --}}
                                <div class="col-sm-6 p-0">
                                    <div class="destination-gallery-box h-100">
                                        <img src="{{ asset('assets/img/destination-galler/destination-gallery-1-2.png') }}"
                                            alt="Chefchaouen Blue Streets" class="w-100 h-100 object-fit-cover" />
                                        <div class="icon-box"> <a
                                                href="{{ asset('assets/img/destination-galler/destination-gallery-1-2.png') }}"
                                                title="Chefchaouen Blue Streets" class="gallery-thumb"> <i
                                                    class="fa-solid fa-eye"></i> </a> </div>
                                        <span class="content">Chefchaouen</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 p-0">
                                    <div class="destination-gallery-box h-100">
                                        <img src="{{ asset('assets/img/destination-galler/destination-gallery-1-3.png') }}"
                                            alt="Sahara Desert Camel Trek" class="w-100 h-100 object-fit-cover" />
                                        <div class="icon-box"> <a
                                                href="{{ asset('assets/img/destination-galler/destination-gallery-1-3.png') }}"
                                                title="Sahara Desert Camel Trek" class="gallery-thumb"> <i
                                                    class="fa-solid fa-eye"></i> </a> </div>
                                        <span class="content">Sahara Desert</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 p-0">
                                    <div class="destination-gallery-box h-100">
                                        <img src="{{ asset('assets/img/destination-galler/destination-gallery-1-4.png') }}"
                                            alt="Fes Medina Tanneries" class="w-100 h-100 object-fit-cover" />
                                        <div class="icon-box"> <a
                                                href="{{ asset('assets/img/destination-galler/destination-gallery-1-4.png') }}"
                                                title="Fes Medina Tanneries" class="gallery-thumb"> <i
                                                    class="fa-solid fa-eye"></i> </a> </div>
                                        <span class="content">Fes</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 p-0">
                                    <div class="destination-gallery-box h-100">
                                        <img src="{{ asset('assets/img/destination-galler/destination-gallery-1-5.png') }}"
                                            alt="Essaouira Coastal Ramparts" class="w-100 h-100 object-fit-cover" />
                                        <div class="icon-box"> <a
                                                href="{{ asset('assets/img/destination-galler/destination-gallery-1-5.png') }}"
                                                title="Essaouira Coastal Ramparts" class="gallery-thumb"> <i
                                                    class="fa-solid fa-eye"></i> </a> </div>
                                        <span class="content">Essaouira</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--================= Destination Gallery Area end =================-->

                <!--================= Feature Area start =================-->
                <div class="vs-feature-style1 position-relative bg-theme-color">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-7 mt-md-0">
                                <h3
                                    class="feature-expert text-white-color ff-rubik fw-bold text-center text-md-start char-animation">
                                    Need a Tour Expert?
                                </h3>
                            </div>
                            <div
                                class="col-md-5 mt-md-0 d-flex justify-content-center justify-content-md-end btn-trigger btn-bounce">
                                {{-- Link to contact or planning page --}}
                                <a class="vs-btn style-4 bg-second-theme-color" href="{{ route('contact') }}#plan"> {{--
                                    Example Route --}}
                                    Let's Plan Your Trip
                                </a>
                            </div>
                        </div>
                    </div>
                    <h2 class="position-absolute text-white-color">Adventures</h2>
                </div>
                <!--================= Feature Area end =================-->

                <!--================= Services Area start =================-->
                {{-- HTML comment said "end" but section logically starts here --}}
                <div class="vs-services-style1 space bg-second-theme-color"
                    data-bg-src="{{ asset('assets/img/services/vs-services-style1-bg.png') }}" {{-- Use asset --}}>
                    <img src="{{ asset('assets/img/icons/cloud.png') }}" {{-- Use asset --}} alt="icon"
                        class="vs-services-style1-icon-1 animate-parachute" />
                    <img src="{{ asset('assets/img/icons/ballon.png') }}" {{-- Use asset --}} alt="icon"
                        class="vs-services-style1-icon-2 animate-parachute" />
                    <div class="container">
                        <div class="row g-4 align-items-end">
                            <div class="col-md-6 text-center text-md-start">
                                <div class="row">
                                    <div class="col-12 col-xl-11">
                                        <div class="title-area text-center text-md-start">
                                            <span class="sec-subtitle fade-anim" data-direction="bottom">Our Services</span
                                                {{-- Corrected tag --}}>
                                            <h2 class="sec-title text-white-color fade-anim" data-direction="top">
                                                Why <span>Travel</span> With Morocco Quest?
                                            </h2>
                                        </div>
                                        {{-- Link to tours or services page --}}
                                        <a class="vs-btn style-4 fade-anim" data-direction="top"
                                            href="{{ route('tours.index') }}" {{-- Example Route --}}>View All Tours</a>
                                    </div>
                                </div>
                                <div class="row g-4 pt-120">
                                    {{-- Service Box 1: Support --}}
                                    <div class="col-lg-6 fade-anim">
                                        <div class="vs-services-box-style1">
                                            <figure class="services-thumb">
                                                <img src="{{ asset('assets/img/services/services-thumb-1-3.png') }}"
                                                    alt="Support 24/7" class="w-100" />
                                            </figure>
                                            <div class="services-content">
                                                <div class="services-icon"> {{-- SVG Icon (Shortened for readability) --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="104" height="81"
                                                        viewBox="0 0 104 81" fill="none">
                                                        <path d="M89.0195 24.7886...Z" fill="white" />
                                                        <path d="M14.8281 24.7886...Z" fill="white" />
                                                        <circle cx="40.1642" cy="40.1642" r="36.1642"
                                                            transform="matrix(1 0 0 -1 11.7588 80.3286)" fill="white"
                                                            stroke="white" stroke-width="8" />
                                                        <circle cx="53.1844" cy="40.452" r="30.9969" fill="currentColor"
                                                            stroke="currentColor" stroke-width="1.5"
                                                            stroke-dasharray="3 3" />
                                                        <path d="M63.4074 41.097C...Z" fill="white" />
                                                    </svg>
                                                </div>
                                                <div class="services-content-inner">
                                                    <h5 class="services-title"> <a href="#">Support 24/7</a> </h5> {{-- Link
                                                    to support/contact? --}}
                                                    <p class="fs-16 fw-medium"> Dedicated assistance throughout your
                                                        journey. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Service Box 2: Booking --}}
                                    <div class="col-lg-6 fade-anim">
                                        <div class="vs-services-box-style1">
                                            <figure class="services-thumb">
                                                <img src="{{ asset('assets/img/services/services-thumb-1-4.png') }}"
                                                    alt="Fast Booking" class="w-100" />
                                            </figure>
                                            <div class="services-content">
                                                <div class="services-icon"> {{-- SVG Icon --}} <svg
                                                        xmlns="http://www.w3.org/2000/svg" width="104" height="81"
                                                        viewBox="0 0 104 81" fill="none">
                                                        <path d="M89.0195 24.7886...Z" fill="white" />
                                                        <path d="M14.8281 24.7886...Z" fill="white" />
                                                        <circle cx="40.1642" cy="40.1642" r="36.1642"
                                                            transform="matrix(1 0 0 -1 11.7588 80.3286)" fill="white"
                                                            stroke="white" stroke-width="8" />
                                                        <circle cx="53.1844" cy="40.452" r="30.9969" fill="currentColor"
                                                            stroke="currentColor" stroke-width="1.5"
                                                            stroke-dasharray="3 3" />
                                                        <path d="M63.4074 41.097C...Z" fill="white" />
                                                    </svg> </div>
                                                <div class="services-content-inner">
                                                    <h5 class="services-title"> <a href="#">Easy Booking</a> </h5> {{-- Link
                                                    to booking process? --}}
                                                    <p class="fs-16 fw-medium"> Simple and secure online reservation
                                                        process. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row g-4">
                                    {{-- Service Box 3: Adventures --}}
                                    <div class="col-lg-6 fade-anim">
                                        <div class="vs-services-box-style1">
                                            <figure class="services-thumb"> <img
                                                    src="{{ asset('assets/img/services/services-thumb-1-1.png') }}"
                                                    alt="Adventures" class="w-100" /> </figure>
                                            <div class="services-content">
                                                <div class="services-icon"> {{-- SVG Icon --}} <svg
                                                        xmlns="http://www.w3.org/2000/svg" width="104" height="81"
                                                        viewBox="0 0 104 81" fill="none">
                                                        <path d="M89.0195 24.7886...Z" fill="white" />
                                                        <path d="M14.8281 24.7886...Z" fill="white" />
                                                        <circle cx="40.1642" cy="40.1642" r="36.1642"
                                                            transform="matrix(1 0 0 -1 11.7588 80.3286)" fill="white"
                                                            stroke="white" stroke-width="8" />
                                                        <circle cx="53.1844" cy="40.452" r="30.9969" fill="currentColor"
                                                            stroke="currentColor" stroke-width="1.5"
                                                            stroke-dasharray="3 3" />
                                                        <path d="M63.4074 41.097C...Z" fill="white" />
                                                    </svg> </div>
                                                <div class="services-content-inner">
                                                    <h5 class="services-title"> <a href="{{ route('tours.index') }}">Curated
                                                            Adventures</a> </h5> {{-- Link to tours --}}
                                                    <p class="fs-16 fw-medium"> Unique itineraries for memorable
                                                        experiences. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Service Box 4: Guide --}}
                                    <div class="col-lg-6 fade-anim">
                                        <div class="vs-services-box-style1">
                                            <figure class="services-thumb"> <img
                                                    src="{{ asset('assets/img/services/services-thumb-1-2.png') }}"
                                                    alt="Travel Guide" class="w-100" /> </figure>
                                            <div class="services-content">
                                                <div class="services-icon"> {{-- SVG Icon --}} <svg
                                                        xmlns="http://www.w3.org/2000/svg" width="104" height="81"
                                                        viewBox="0 0 104 81" fill="none">
                                                        <path d="M89.0195 24.7886...Z" fill="white" />
                                                        <path d="M14.8281 24.7886...Z" fill="white" />
                                                        <circle cx="40.1642" cy="40.1642" r="36.1642"
                                                            transform="matrix(1 0 0 -1 11.7588 80.3286)" fill="white"
                                                            stroke="white" stroke-width="8" />
                                                        <circle cx="53.1844" cy="40.452" r="30.9969" fill="currentColor"
                                                            stroke="currentColor" stroke-width="1.5"
                                                            stroke-dasharray="3 3" />
                                                        <path d="M63.4074 41.097C...Z" fill="white" />
                                                    </svg> </div>
                                                <div class="services-content-inner">
                                                    <h5 class="services-title"> <a href="#">Expert Local Guides</a> </h5>
                                                    {{-- Link to about/guides page? --}}
                                                    <p class="fs-16 fw-medium"> Enhance your exploration with knowledgeable
                                                        guides. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Client Feedback Box --}}
                                    <div class="col-12 fade-anim">
                                        <div class="vs-services-box-style1 v2">
                                            <div class="title-area text-center text-md-start">
                                                <span class="sec-subtitle text-white-color">Client Feedback</span>
                                                <h4 class="sec-title text-white-color">
                                                    Trusted by Travelers Like You
                                                </h4>
                                            </div>
                                            <div class="services-content d-flex align-items-center gap-3">
                                                {{-- Make avatars dynamic if needed --}}
                                                <img src="{{ asset('assets/img/services/vs-services-box-style1-v2-avatars.png') }}"
                                                    {{-- Use asset --}} alt="Client Avatars" />
                                                <div class="services-info">
                                                    <span class="fs-16 text-white-color text-uppercase">Average Client
                                                        Rating</span {{-- Adjusted text --}}>
                                                    <div class="ratings">
                                                        {{-- Make rating dynamic (e.g., calculate average) --}}
                                                        <ul class="custom-ul d-flex">
                                                            @php $rating = 4.8; @endphp {{-- Example Rating --}}
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($rating >= $i)
                                                                    <li><i class="fa-solid fa-star"></i></li>
                                                                @elseif ($rating > ($i - 1) && $rating < $i)
                                                                    <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                                                @else
                                                                    <li><i class="fa-regular fa-star"></i></li> {{-- Use regular for
                                                                    empty --}}
                                                                @endif
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Consider replacing Eiffel Tower with a Moroccan landmark icon --}}
                                            <img src="{{ asset('assets/img/icons/eiffel-tower.png') }}" {{-- Example:
                                                Replace with actual Moroccan icon asset --}} alt="Morocco Landmark"
                                                class="eiffel-tower" {{-- Consider renaming this class --}} />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--================= Services Area end =================-->

                <!--================= Awards Area start =================-->
                <section class="awards-style1 space" data-bg-src="{{ asset('assets/img/awards/awards-style1-bg.png') }}"
                    {{-- Use asset --}}>
                    <img class="awards-icon-1" src="{{ asset('assets/img/icons/award-icon-1.png') }}" {{-- Use asset --}}
                        alt="icon" />
                    <img class="awards-icon-2 move-item" src="{{ asset('assets/img/icons/award-icon-2.png') }}" {{-- Use
                        asset --}} alt="icon" />
                    <div class="container">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-lg-6 col-xxl-5">
                                <div class="title-area text-center text-md-start">
                                    <span class="sec-subtitle fade-anim" data-direction="bottom">Recognition</span>
                                    <h2 class="sec-title fade-anim" data-direction="top">
                                        Our Awards & Reviews
                                    </h2>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-5 col-xxl-5">
                                {{-- Make review score/count dynamic --}}
                                <div class="google-reviewed mx-auto overflow-hidden">
                                    <div class="left bg-white-color d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/img/icons/awards-google.png') }}" {{-- Use asset --}}
                                            alt="google" />
                                        <div class="info">
                                            <strong class="d-block">Google</strong>
                                            <span class="d-block fs-xxs text-uppercase">Reviewed on</span>
                                        </div>
                                    </div>
                                    <div class="right bg-second-theme-color">
                                        <div class="rating d-flex align-items-baseline gap-2">
                                            <h4 class="fs-32 fw-semibold ff-rubik text-white-color">
                                                {{-- $googleRating ?? '4.8' --}} 4.8
                                            </h4>
                                            <div class="stars">
                                                {{-- Make stars dynamic based on $googleRating --}}
                                                <ul class="custom-ul d-flex align-items-center text-theme-color fs-xxs">
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <span class="review fs-xxs d-block">{{-- $googleReviewCount ?? '1.2k+' --}} 1.2k+
                                            reviews</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Awards Boxes --}}
                        <div class="row g-2 g-lg-4 award-box-style1__row">
                            <div class="line-Shape"></div>
                            {{-- Ideally loop through $awards from controller --}}
                            {{-- Award Box 1 --}}
                            <div class="col-md-6 col-lg-4 fade-anim" data-delay="0.30" data-direction="right">
                                <div class="award-box-style1">
                                    <div class="award-box-style1-wrapper">
                                        <figure class="award-box-icon"> {{-- SVG --}} <svg
                                                xmlns="http://www.w3.org/2000/svg" width="132" height="103"
                                                viewBox="0 0 132 103" fill="none">
                                                <path d="M113.179 31.5771...Z" fill="white" />
                                            </svg> </figure>
                                        <div
                                            class="award-box-header d-flex align-items-end justify-content-between gap-xl-4 text-center">
                                            <img src="{{ asset('assets/img/awards/award-box-left-wings.png') }}"
                                                alt="award wing" />
                                            <h6 class="text-capitalize ff-rubik fw-semibold"> World Travelers Award </h6>
                                            <img src="{{ asset('assets/img/awards/award-box-right-wings.png') }}"
                                                alt="award wing" />
                                        </div>
                                        <div class="award-box-body text-center"> <span
                                                class="text-third-theme-color bg-white-color">Excellence in Travel</span>
                                        </div>
                                        <div class="award-box-footer text-capitalize text-center">
                                            <p class="line1"> Received in <strong>2023</strong> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Award Box 2 --}}
                            <div class="col-md-6 col-lg-4 fade-anim" data-delay="0.45" data-direction="right">
                                <div class="award-box-style1">
                                    <div class="award-box-style1-wrapper">
                                        <figure class="award-box-icon text-center"> {{-- SVG --}} <svg
                                                xmlns="http://www.w3.org/2000/svg" width="132" height="103"
                                                viewBox="0 0 132 103" fill="none">
                                                <path d="M113.179 31.5771...Z" fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M70.1325 38.2514C...Z"
                                                    fill="white" />
                                                <path d="M64.8191 30H69.1814C...Z" fill="white" />
                                            </svg> </figure>
                                        <div
                                            class="award-box-header d-flex align-items-end justify-content-between gap-xl-4 text-center">
                                            <img src="{{ asset('assets/img/awards/award-box-left-wings.png') }}"
                                                alt="award wing" />
                                            <h6 class="text-capitalize ff-rubik fw-semibold"> Top Adventure Operator </h6>
                                            <img src="{{ asset('assets/img/awards/award-box-right-wings.png') }}"
                                                alt="award wing" />
                                        </div>
                                        <div class="award-box-body text-center"> <span
                                                class="text-third-theme-color bg-white-color">Adventure Award</span> </div>
                                        <div class="award-box-footer text-capitalize text-center">
                                            <p class="line1"> Awarded in <strong>2022</strong> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Award Box 3 --}}
                            <div class="col-md-6 col-lg-4 fade-anim" data-delay="0.60" data-direction="right">
                                <div class="award-box-style1">
                                    <div class="award-box-style1-wrapper">
                                        <figure class="award-box-icon text-center"> {{-- SVG --}} <svg
                                                xmlns="http://www.w3.org/2000/svg" width="132" height="103"
                                                viewBox="0 0 132 103" fill="none">
                                                <path d="M113.179 31.5771...Z" fill="white" />
                                                <path d="M51.6644 46.8563L...Z" fill="white" />
                                                <path d="M68.0217 59.458C...Z" fill="white" />
                                            </svg> </figure>
                                        <div
                                            class="award-box-header d-flex align-items-end justify-content-between gap-xl-4 text-center">
                                            <img src="{{ asset('assets/img/awards/award-box-left-wings.png') }}"
                                                alt="award wing" />
                                            <h6 class="text-capitalize ff-rubik fw-semibold"> Customer Choice Award </h6>
                                            <img src="{{ asset('assets/img/awards/award-box-right-wings.png') }}"
                                                alt="award wing" />
                                        </div>
                                        <div class="award-box-body text-center"> <span
                                                class="text-third-theme-color bg-white-color">Service Excellence</span>
                                        </div>
                                        <div class="award-box-footer text-capitalize text-center">
                                            <p class="line1"> Recognized in <strong>2024</strong> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End loop --}}
                        </div>
                    </div>
                </section>
                <!--================= Awards Area end =================-->

                <!--================= Blog Area start =================-->
                <section class="blog-style1 space-top space-extra-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-auto mx-auto">
                                <div class="title-area text-center">
                                    <span class="sec-subtitle fade-anim" data-direction="bottom">Blog & Articles</span>
                                    <h2 class="sec-title fade-anim" data-direction="top">Latest News Update</h2>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4">
                            @foreach ($latestPosts as $post)
                                <div class="col-md-6 col-lg-4 move-anim">
                                    <div class="vs-blog-box style1">
                                        <figure class="blog-thumb">
                                            <a href="{{ route('blog.show', $post->slug) }}">
                                                <img src="{{ asset($post->thumbnail ?? 'assets/img/blog/default.png') }}"
                                                    alt="{{ $post->title }}" class="w-100" />
                                            </a>
                                        </figure>
                                        <div class="blog-content">
                                            <div class="blog-meta">
                                                <ul class="custom-ul">
                                                    <li><a href="#"><i class="fa-sharp fa-solid fa-circle-user"></i> by
                                                    {{ $post->written_by }}</a></li>
                                                    <li><a href="{{ route('blog.show', $post->slug) }}#comments"><i
                                                                class="fa-sharp fa-solid fa-comments"></i>
                                                            {{ $post->comments->count() }} comments</a></li>
                                                    <li class="date">
                                                        @if($post->published_at)
                                                            <div class="vs-blog-date">
                                                                {{ \Carbon\Carbon::parse($post->published_at)->format('d M') }}
                                                            </div>
                                                        @endif
                                                    </li>


                                                </ul>
                                            </div>
                                            <h5 class="blog-title line-clamp-2">
                                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                            </h5>
                                            <div class="blog-footer">
                                                <a href="{{ route('blog.show', $post->slug) }}" class="vs-btn style4">
                                                    <span>Read More</span>
                                                    <i class="fa-duotone fa-regular fa-arrow-right"></i>
                                                </a>
                                                <ul class="custom-ul blog-share">
                                                    <li>
                                                        <i class="fa-solid fa-share-nodes"></i>
                                                        <ul class="custom-ul share-list">
                                                            <li><a href="#" class="facebook" target="_blank"><i
                                                                        class="fa fa-brands fa-facebook"></i></a></li>
                                                            <li><a href="#" class="twitter" target="_blank"><i
                                                                        class="fa fa-brands fa-twitter"></i></a></li>
                                                            <li><a href="#" class="googlePlus" target="_blank"><i
                                                                        class="fa fa-brands fa-google-plus"></i></a></li>
                                                            <li><a href="#" class="instagram" target="_blank"><i
                                                                        class="fa fa-brands fa-instagram"></i></a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Partner Logos Slider -->
                        <div class="row">
                            <div class="col-12">
                                <div class="swiper partner-slider space-top">
                                    <div class="swiper-wrapper">
                                        @foreach (range(1, 5) as $i)
                                            <div class="swiper-slide">
                                                <img src="{{ asset("assets/img/partner/partner-1-$i.svg") }}"
                                                    alt="Partner Logo {{ $i }}" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!--================= Blog Area end =================-->

                <!--================= SEO Content (static, keyword-rich) =================-->
                <section class="space-extra-bottom" aria-label="About our morocco private tours">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="title-area text-center">
                                    <span class="sec-subtitle">Why Travel with Morocco Quest</span>
                                    <h2 class="sec-title">Morocco Private Tours &amp; Marrakech Desert Tours</h2>
                                </div>
                                <p>Morocco Quest specialises in <strong>morocco private tours</strong> and <strong>marrakech desert tours</strong> tailored for travellers who want the real Morocco without compromise. Whether you are dreaming of a <strong>sahara desert tour from marrakech</strong>, a relaxed <strong>luxury desert tours marrakech</strong> escape, or a multi-city itinerary covering imperial cities, every journey is fully private with an English-speaking driver-guide.</p>
                                <p>As one of the <strong>best morocco private tour company</strong> options for couples, families, and small groups, we craft <strong>private tours in morocco</strong> that move at your pace. Our <strong>desert tours marrakech</strong> reach the iconic Erg Chebbi dunes near Merzouga, with handpicked kasbahs along the way and a luxury camp under the stars.</p>
                                <h3 class="h5 mt-4">Most Requested Itineraries</h3>
                                <ul>
                                    <li><strong>Marrakech desert tour 3 days</strong> &mdash; the most popular short Sahara escape</li>
                                    <li><strong>Marrakech desert tours 4 days</strong> &mdash; one full day in the dunes</li>
                                    <li><strong>Best 7 day morocco itinerary</strong> &mdash; Marrakech + Sahara, the classic morocco itinerary one week route</li>
                                    <li><strong>Morocco 14 day itinerary</strong> &mdash; full country, north to south</li>
                                    <li><strong>Fes to marrakech desert tour</strong> &mdash; one-way Sahara crossing, no backtracking</li>
                                    <li><strong>Luxury sahara desert tour from marrakech</strong> &mdash; premium camp, fine dining, private 4x4</li>
                                </ul>
                                <h3 class="h5 mt-4">Departure Cities</h3>
                                <p>We run <strong>morocco desert tours from marrakech</strong>, <strong>desert tour from marrakech</strong>, and reverse routes such as the <strong>marrakech to fes desert tour</strong>. We also offer Agafay desert day trips, Merzouga multi-day tours, and a <strong>private sahara desert tour from marrakech</strong> for travellers who want a fully customised desert experience.</p>
                                <p class="text-center mt-4"><a href="{{ url('/contact') }}" class="vs-btn">Plan Your Private Morocco Tour</a></p>
                            </div>
                        </div>
                    </div>
                </section>
                <!--================= SEO Content end =================-->

            </main>
            <!-- ================= Main Section Wrapper End ================= -->
            {{-- Footer is included in app.blade.php --}}

@endsection {{-- End the content section --}}

        {{-- Optional: Push page-specific scripts if needed (e.g., initializing sliders only on this page) --}}
        @push('scripts')
            <script>
                // Example: Initialize the date range picker if it wasn't globally initialized
                // $(function() {
                //   if ($('#search-date').length) {
                //      $('#search-date').daterangepicker({
                //          autoUpdateInput: false, // To show placeholder initially
                //          singleDatePicker: false, // Or true if you want single date
                //          locale: { cancelLabel: 'Clear', format: 'YYYY-MM-DD' }
                //      });
                //      $('#search-date').on('apply.daterangepicker', function(ev, picker) {
                //          $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                //      });
                //      $('#search-date').on('cancel.daterangepicker', function(ev, picker) {
                //          $(this).val('');
                //      });
                //   }
                // });

                // Ensure sliders defined in main.js run after content loads,
                // or re-initialize specific sliders here if needed.
                console.log('Homepage specific scripts can run here.');
            </script>
        @endpush