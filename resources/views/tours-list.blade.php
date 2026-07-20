@extends('layouts.app2')

@section('title', $title ?? (!empty($placeName) ? 'Tours in '.$placeName.' Morocco | Private Day Trips & Multi-Day Tours | Morocco Quest' : 'Morocco Tour Packages | Browse All Private & Group Tours | Morocco Quest'))
@section('description', $description ?? (!empty($placeName) ? 'Explore all tours in '.$placeName.', Morocco. Compare private day trips, multi-day packages and small group tours. Book direct with a local Marrakech-based agency.' : 'Browse all morocco tour packages: private day trips, multi-day sahara desert tours, small group tours and luxury morocco tours. Book direct with a top-rated local agency.'))
@section('keywords', $keywords ?? 'browse morocco tours, all morocco tour packages, private day trips morocco, morocco group tours, marrakech tour packages, best morocco tour deals')

@push('jsonld')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => !empty($placeName) ? 'Tours in '.$placeName : 'Morocco Tour Packages', 'item' => url()->current()],
    ],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
    <main>
        {{-- Banner Section --}}
        <section class="vs-breadcrumb"
            data-bg-src="{{ asset('assets/img/moroccan-architecture-courtyard-orange-tree-tour-banner.webp') }}">
            <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="Decorative cloud icon"
                class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />

            <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="Decorative hot air balloon icon"
                class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />

            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h1 class="breadcrumb-title">Private Morocco Tours</h1>
                            <p class="breadcrumb-subtitle" style="color: white;">
                                Explore small group tours morocco and exclusive travel experiences.
                            </p>

                            <figcaption class="image-caption visually-hidden">
                                A serene Moroccan courtyard with traditional arches and an orange tree in bloom, reflecting
                                the charm of cultural tour experiences.
                            </figcaption>

                            <p class="visually-hidden">
                                Step into Morocco’s rich heritage with a visit to traditional courtyards and palaces.
                                This image captures the timeless beauty of Moroccan design, where intricate tilework,
                                archways, and lush orange trees offer a peaceful glimpse into local architecture and
                                culture.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- Phase 2: Hub intro — unique, departure-specific, entity-rich --}}
        <section class="hub-intro space-top">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9 text-center">
                        <h2 class="hub-intro-title h4 mb-3">Private &amp; Small Group Morocco Tours from Marrakech</h2>
                        <p class="hub-intro-text">
                            Every tour in this collection departs from <strong>Marrakech</strong> — Morocco's most-visited imperial city and the gateway to the High Atlas Mountains, the Drâa Valley, and the Sahara desert at <strong>Erg Chebbi, Merzouga</strong>. Whether you're comparing a <a href="{{ route('tours.show', '3-day-sahara-desert-tour-from-marrakech') }}">3-day sahara desert tour</a>, a <a href="{{ route('tours.multi_day') }}">multi-day morocco tour package</a>, or a focused <a href="{{ route('activities.index') }}">Marrakech day activity</a>, each option is led by a licensed local guide. Prices are per person and include 4×4 transport on mountain and desert routes. Filter by duration, departure city or group size — or <a href="{{ route('contact.show') }}">contact us</a> for a tailor-made itinerary.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Tour Listing Section --}}
        <section class="vs-tour-package space">
            <div class="container">
                @if ($tours->count() > 0)
                    <div class="row gy-4">
                        @foreach ($tours as $tour)
                            <div class="col-md-6 col-lg-4">
                                <div class="tour-package-box bg-white-color h-100">
                                    <div class="tour-package-thumb">
                                        @php
                                            $imageUrl = $tour->first_image_url;
                                        @endphp

                                        <a href="{{ route('tours.show', $tour->slug) }}">
                                            <img src="{{ $imageUrl }}" alt="{{ $tour->title }}" class="w-100"
                                                loading="lazy" />
                                            <span class="visually-hidden">
                                                {{ $tour->short_description ?? 'Tour: ' . $tour->title }}
                                            </span>
                                        </a>



                                        @if (isset($tour->discount_percentage) && $tour->discount_percentage > 0)
                                            <span class="tour-package-offer">{{ $tour->discount_percentage }}% OFF</span>
                                        @endif
                                    </div>
                                    <div class="tour-package-content">
                                        @if ($tour->departure)
                                            <div class="tour-package-location">
                                                <i class="fas fa-map-marker-alt"></i> {{ $tour->departure }}
                                            </div>
                                        @endif
                                        <h5 class="tour-package-title line-clamp-2">
                                            <a href="{{ route('tours.show', $tour->slug) }}">{{ $tour->title }}</a>
                                        </h5>
                                        <div class="row g-2 justify-content-between align-items-center mt-auto pt-3">
                                            <div class="col-auto">
                                                <div class="tour-package-info">
                                                    @if ($tour->duration_days)
                                                        <span class="info-item">
                                                            <i class="fas fa-clock"></i> {{ $tour->duration_days }}
                                                            {{ Str::plural('Day', $tour->duration_days) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                @if (isset($tour->price_adult))
                                                    <div class="tour-package-price">
                                                        Price On Request
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                        <a href="{{ route('tours.show', $tour->slug) }}"
                                            class="vs-btn style7 w-100 mt-3">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Pagination --}}
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mt-5">
                            {{ $tours->appends(request()->query())->links() }}
                        </div>
                    </div>
                @else
                    {{-- No Tours Found Message --}}
                    <div class="row">
                        <div class="col-12 text-center">
                            @if ($placeName)
                                <p>There are currently no tours listed for the destination "{{ $placeName }}".</p>
                                <a href="{{ route('destinations.index') }}" class="vs-btn mt-3">View Other Destinations</a>
                            @elseif($query)
                                <p>No tours found matching your search criteria "{{ $query }}".</p>
                                <a href="{{ route('tours.index') }}" class="vs-btn mt-3">View All Tours</a>
                            @else
                                <p>No tours available at the moment.</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection

@push('styles')
    {{-- Styles remain unchanged --}}
    <style>
        .tour-package-box {
            display: flex;
            flex-direction: column;
        }

        .tour-package-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .tour-package-content>.row {
            margin-top: auto;
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            min-height: 2.4em;
            /* Ensure space even for short titles */
        }

        .line-clamp-3 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .tour-package-thumb {
            position: relative;
        }

        .tour-package-offer {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: var(--theme-color);
            color: white;
            padding: 5px 10px;
            font-size: 0.8em;
            font-weight: bold;
            border-radius: 3px;
            z-index: 2;
        }

        .tour-package-location {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 8px;
        }

        .tour-package-location i {
            margin-right: 4px;
            color: var(--theme-color);
        }

        .tour-package-info .info-item {
            margin-right: 10px;
            font-size: 0.9em;
            color: #666;
        }

        .tour-package-info .info-item i {
            margin-right: 4px;
            color: var(--theme-color);
        }

        .tour-package-price {
            font-size: 0.9em;
            color: #666;
        }

        .tour-package-price .price {
            font-size: 1.3em;
            font-weight: bold;
            color: var(--title-color);
        }

        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
    </style>
@endpush
