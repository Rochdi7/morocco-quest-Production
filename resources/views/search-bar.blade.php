@extends('layouts.app2')
@section('title', isset($searchQuery) && $searchQuery ? 'Search Results for "' . e($searchQuery) . '" | Private Morocco
    Tours' : 'Search Results | Private Morocco Tours & Exclusive Experiences')

@section('page_description', isset($searchQuery) && $searchQuery ? 'Browse private tours morocco, small group tours
    morocco, exclusive morocco travel experiences, and vip morocco tours matching "' . e($searchQuery) . '" with Morocco
    Quest.' : 'Explore private tours morocco, small group tours morocco, exclusive morocco travel experiences, vip morocco
    tours, and morocco travel services available with Morocco Quest.')

@section('keywords',
    'morocco private tours, private morocco tours, private morocco tour, private tours morocco, private tour
    morocco, small group tours morocco, morocco small group tours, exclusive morocco travel experiences, vip morocco tours,
    morocco luxury travel, luxury travel morocco, morocco travel insurance, morocco travel agent, what is the best time to
    travel to morocco, morocco travel visa requirements')


@section('content')

    <!--================= Breadcrumb Area start =================-->
    <section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/hot-air-balloon-ride-morocco-desert-adventure.webp') }}">
        <img src="{{ asset('assets/img/icons/fanous.png') }}" alt="Decorative cloud icon" style="height: 200px;"
            class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />

        <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="Decorative hot air balloon icon"
            class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />

        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h1 class="breadcrumb-title">Find Your Perfect Adventure</h1>
                        <p class="breadcrumb-subtitle" style="color: white;">
                            Search for the best tours, activities, and experiences across Morocco.
                        </p>

                        <figcaption class="image-caption visually-hidden">
                            Discover the best tours, activities, and adventures across Morocco, from desert safaris to city
                            explorations.
                        </figcaption>

                        <p class="visually-hidden">
                            Explore the finest tours, activities, and adventure experiences across Morocco. From
                            breathtaking desert safaris to vibrant city tours and luxurious getaways, find your perfect
                            Moroccan adventure.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--================= Breadcrumb Area end =================-->
    <div class="container py-5">
        <h1 class="mb-4">
            Search Results
            @if (isset($searchQuery) && $searchQuery)
                for "{{ e($searchQuery) }}"
            @endif
        </h1>

        @if ($tours->count() || $activities->count())

            @if ($tours->count())
                <h2 class="text-primary mb-4">Tours Found</h2>
                <div class="row g-4">
                    @foreach ($tours as $tour)
                        <div class="col-md-4">
                            <div class="tour-package-box bg-white-color h-100 d-flex flex-column"> {{-- Added flex classes for consistent height --}}
                                <div class="tour-package-thumb">
                                    {{-- 3. Lazy Loading Added --}}
                                    <img src="{{ optional($tour->images->first())->image_path ? asset(Str::startsWith(optional($tour->images->first())->image_path, 'public/storage/') ? optional($tour->images->first())->image_path : 'public/storage/' . ltrim(optional($tour->images->first())->image_path, '/')) : asset('assets/img/tour-packages/tour-package-placeholder.png') }}"
                                        alt="{{ $tour->title }}" class="w-100" loading="lazy" />

                                </div>
                                <div class="tour-package-content flex-grow-1 d-flex flex-column"> {{-- Added flex classes --}}
                                    <h5 class="title line-clamp-2">
                                        <a href="{{ route('tours.show', $tour->slug) ?? '#' }}"
                                            aria-label="View details for tour: {{ $tour->title }}">
                                            {{ Str::limit($tour->title, 50) }}
                                        </a>
                                    </h5>
                                    <div class="pricing-container mt-auto"> {{-- Pushed to bottom --}}
                                        <div class="package-info">
                                            <span class="package-location">
                                                <i class="fa-solid fa-location-dot"></i>
                                                Marrakech, Rabat, Fez, Casablanca
                                            </span>

                                            <span class="package-time">
                                                <i class="fa-regular fa-clock"></i>
                                                6 Days
                                            </span>
                                        </div>

                                        <div class="price-info">
                                            {{-- Discount logic improved: Use old_price_adult --}}
                                            @if ($tour->old_price_adult && $tour->price_adult && $tour->old_price_adult > $tour->price_adult)
                                                <span class="price-off text-white-color ff-poppins">
                                                    {{ round((($tour->old_price_adult - $tour->price_adult) / $tour->old_price_adult) * 100) }}%
                                                    off
                                                </span>
                                            @elseif($tour->discount && $tour->discount > 0)
                                                {{-- Fallback to discount field --}}
                                                <span class="price-off text-white-color ff-poppins">
                                                    {{ rtrim(rtrim(number_format($tour->discount, 0), '0'), '.') }}% off
                                                </span>
                                            @endif
                                            <div class="price">
                                                <span class="fs-14 ff-rubik" style="font-weight:700;">Price on
                                                    request</span>
                                            </div>

                                        </div>
                                    </div>
                                    <a href="{{ route('tours.show', $tour->slug) ?? '#' }}"
                                        class="vs-btn style7 w-100 mt-3"
                                        aria-label="View details for tour: {{ $tour->title }}">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Tour Pagination --}}
                @if ($tours instanceof \Illuminate\Pagination\LengthAwarePaginator && $tours->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $tours->appends(request()->query())->links() }}
                    </div>
                @endif
            @endif

            @if ($activities->count())
                <h2 class="text-success mt-5 mb-4">Activities Found</h2>
                <div class="row g-4">
                    @foreach ($activities as $activity)
                        <div class="col-md-4">
                            <div class="tour-package-box bg-white-color h-100 d-flex flex-column"> {{-- Added flex classes for consistent height --}}
                                <div class="tour-package-thumb">
                                    {{-- 3. Lazy Loading Added --}}
                                    <img src="{{ optional($activity->images->first())->image ? asset(Str::startsWith(optional($activity->images->first())->image, 'public/storage/') ? optional($activity->images->first())->image : 'public/storage/' . ltrim(optional($activity->images->first())->image, '/')) : asset('assets/img/activities/activity-placeholder.png') }}"
                                        alt="{{ $activity->title }}" class="w-100" loading="lazy" />

                                </div>
                                <div class="tour-package-content flex-grow-1 d-flex flex-column"> {{-- Added flex classes --}}
                                    <h5 class="title line-clamp-2">
                                        <a href="{{ route('activities.show', $activity->slug) ?? '#' }}"
                                            aria-label="View details for activity: {{ $activity->title }}">
                                            {{ Str::limit($activity->title, 50) }}
                                        </a>
                                    </h5>
                                    <div class="pricing-container mt-auto"> {{-- Pushed to bottom --}}
                                        <div class="package-info">
                                            <span class="package-location">
                                                <i class="fa-sharp fa-thin fa-location-dot"></i>
                                                {{ $activity->places->isNotEmpty() ? $activity->places->pluck('name')->implode(', ') : $activity->category->name ?? 'Various Locations' }}
                                            </span>
                                            <span class="package-time">
                                                <i class="fa-sharp fa-thin fa-clock"></i>
                                                {{ $activity->duration ? $activity->duration : 'N/A' }}
                                            </span>
                                        </div>
                                        <div class="price-info">
                                            @if ($activity->old_price_adult && $activity->price_adult && $activity->old_price_adult > $activity->price_adult)
                                                <span class="price-off text-white-color ff-poppins">
                                                    {{ round((($activity->old_price_adult - $activity->price_adult) / $activity->old_price_adult) * 100) }}%
                                                    off
                                                </span>
                                            @endif
                                            <div class="price">
                                                <span class="fs-14 ff-rubik" style="font-weight:700;">Price on
                                                    request</span>
                                            </div>

                                        </div>
                                    </div>
                                    <a href="{{ route('activities.show', $activity->slug) ?? '#' }}"
                                        class="vs-btn style7 w-100 mt-3"
                                        aria-label="View details for activity: {{ $activity->title }}">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Activity Pagination --}}
                @if ($activities instanceof \Illuminate\Pagination\LengthAwarePaginator && $activities->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $activities->appends(request()->query())->links() }}
                    </div>
                @endif
            @endif
        @else
            <div class="alert alert-warning text-center mt-5"> {{-- Centered message --}}
                <p>No tours or activities matched your search criteria for "{{ e($searchQuery ?? '') }}".</p>
                <p>Please try different keywords or browse our popular categories.</p>
                {{-- Optional: Add links to popular categories or all tours/activities --}}
                <a href="{{ route('tours.index') }}" class="vs-btn style4 mt-2">View All Tours</a>
                {{-- <a href="{{ route('activities.index') }}" class="vs-btn style4 mt-2">View All Activities</a> --}}
            </div>
        @endif

    </div>
@endsection

{{-- Add push styles if needed, original had none --}}
@push('styles')
    <style>
        /* Ensure consistent card heights and content alignment */
        .tour-package-box {
            display: flex;
            flex-direction: column;
            height: 100%;
            /* Make sure the box takes full height of the column */
        }

        .tour-package-content {
            flex-grow: 1;
            /* Allows content to fill space */
            display: flex;
            flex-direction: column;
            /* Stack content vertically */
        }

        .tour-package-content .pricing-container {
            margin-top: auto;
            /* Pushes pricing to the bottom */
            padding-top: 1rem;
            /* Add some space above pricing */
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            min-height: 2.4em;
            /* Reserve space */
        }

        /* Other styles from your original input can be added here if needed */
        .tour-package-thumb img {
            aspect-ratio: 350 / 250;
            /* Example aspect ratio, adjust as needed */
            object-fit: cover;
            /* Ensure image covers the area */
        }

        .package-info span {
            display: block;
            margin-bottom: 5px;
            font-size: 0.9em;
            color: #666;
        }

        .package-info i {
            margin-right: 5px;
            color: var(--theme-color);
        }

        .price-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .price-off {
            background-color: var(--theme-color);
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 0.8em;
            font-weight: bold;
        }

        .price h6 {
            margin-bottom: 0;
        }

        .price del {
            color: #999;
            margin-left: 5px;
        }
    </style>
@endpush
