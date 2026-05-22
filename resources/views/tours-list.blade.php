@extends('layouts.app2')

@section('title', $title ?? (!empty($placeName) ? 'Morocco Tours in '.$placeName.' | Private & Guided Tour Packages | Morocco Quest' : 'Morocco Tours & Private Sahara Desert Trips from Marrakech | Morocco Quest'))
@section('description', $description ?? (!empty($placeName) ? 'Discover morocco tours in '.$placeName.'. Private morocco tours, small group tours morocco and luxury morocco tours with a top-rated local agency.' : 'Browse morocco tour packages: private morocco tours, sahara desert tours from Marrakech, small group tours morocco and luxury morocco tours.'))
@section('keywords', $keywords ?? 'morocco tours, private morocco tours, morocco tour package, sahara desert tours morocco, morocco desert tours from marrakech, small group tours morocco, luxury morocco tours, morocco guided tours')


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
                                            $firstImage = optional($tour->firstImage)->image_path;

                                            $imageUrl = $firstImage
                                                ? asset(
                                                    Str::startsWith($firstImage, 'public/storage/')
                                                        ? $firstImage
                                                        : 'public/storage/' . ltrim($firstImage, '/'),
                                                )
                                                : asset('assets/img/tour-packages/tour-package-1-1.png');
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
