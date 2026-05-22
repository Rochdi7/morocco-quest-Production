@extends('layouts.app2')

@section('title', $title ?? (isset($type) ? 'Morocco '.$type.' | Private & Guided Tour Packages | Morocco Quest' : 'Morocco Tours & Tour Packages | Morocco Quest'))

@section('description', $description ?? (isset($type) ? 'Book morocco '.$type.' with a top-rated local agency. Private morocco tours, small group tours morocco and luxury morocco tours.' : 'Morocco tour packages: private morocco tours, sahara desert tours from Marrakech, morocco multi day tours and morocco day trips.'))

@section('page_description', $description ?? 'Morocco tour packages: private morocco tours, sahara desert tours from Marrakech, morocco multi day tours and morocco day trips with a top-rated local agency.')

@section('keywords', $keywords ?? 'morocco tours, morocco tour package, private morocco tours, morocco guided tours, sahara desert tours morocco, morocco multi day tours, morocco day tours, small group tours morocco')

    @push('styles')
        <style>
            .swiper-button-next,
            .swiper-button-prev,
            .owl-nav button.owl-prev,
            .owl-nav button.owl-next {
                font-size: 2rem !important;
                width: 40px;
                height: 40px;
                background: #f3f3f3;
                border-radius: 50%;
                line-height: 40px;
                text-align: center;
                color: #333;
                transition: all 0.3s ease;
            }

            .swiper-button-next:hover,
            .swiper-button-prev:hover,
            .owl-nav button.owl-prev:hover,
            .owl-nav button.owl-next:hover {
                background-color: #15635F;
                color: white;
            }
        </style>
    @endpush

@section('content')
    <section class="vs-breadcrumb" data-bg-src="https://morocco-quest.com/assets/img/sunset-luxury-desert-camp-morocco.webp">
        <img src="https://morocco-quest.com/assets/img/icons/cloud.png" alt="Decorative cloud icon"
            class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
        <img src="https://morocco-quest.com/assets/img/icons/ballon-sclation.png" alt="Decorative hot air balloon icon"
            class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />

        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h1 class="breadcrumb-title">Discover Our Exclusive Tours</h1>
                        <p class="mt-3 text-white">Explore Morocco's Breathtaking Landscapes With Our Multi-Day Tours And
                            One-Day Excursions. Whether You Dream Of Wandering The Sahara Desert, Exploring Ancient Medinas,
                            Or Enjoying A Sunset Over The Atlas Mountains, We Bring Your Travel Experience To Life.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-5">
        <h2 class="mb-4">{{ $type }}</h2>

        @if ($tours->isEmpty() && $activities->isEmpty())
            <p class="text-muted">No results found for this category.</p>
        @endif

        <!-- Tours Section -->
        @if ($tours->count())
            <h3 class="mt-4 mb-3 h4">Tours</h3>
            <div class="row g-4">
                @foreach ($tours as $tour)
                    <div class="col-md-6 col-xl-4">
                        <div class="tour-package-box style-3 bg-white-color h-100 position-relative">
                            <div class="tour-package-thumb">
                                @php
                                    $image = optional($tour->firstImage)->image_path;
                                @endphp
                                @if ($image)
                                    <img src="{{ 'https://morocco-quest.com/public/storage/' . ltrim(str_replace(['public/storage/', 'storage/'], '', $image), '/') }}"
                                        alt="Discover {{ $tour->title }} in {{ $tour->places->first()->name ?? ($tour->location ?? 'Morocco') }}"
                                        class="w-100" loading="lazy" style="aspect-ratio: 4/3; object-fit: cover;" />
                                @endif
                            </div>
                            <div class="tour-package-content">
                                <div class="location mb-2">
                                    <i class="fa-solid fa-location-dot me-1"></i>
                                    <span>{{ $tour->places->first()->name ?? ($tour->location ?? 'No Location') }}</span>
                                </div>
                                <h5 class="title line-clamp-2 mb-3">
                                    <a href="{{ route('tours.show', $tour->slug) }}"
                                        class="stretched-link">{{ $tour->title }}</a>
                                </h5>
                                <div class="tour-package-footer d-flex justify-content-between align-items-center">
                                    <div class="tour-duration me-2">
                                        <i class="fa-regular fa-clock"></i>
                                        <span class="ms-1">{{ $tour->duration_days ?? 'Flexible' }} Days</span>
                                    </div>
                                    @if (isset($tour->price_adult))
                                        <div class="pricing-info text-end">
                                            <span class="fs-xs d-block">

                                            </span>
                                            <span class="fs-14 ff-rubik" style="font-weight:700;">Price on request</span>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $tours->links() }}
        @endif

        <!-- Activities Section -->
        @if ($activities->count())
            <h3 class="mt-5 mb-3 h4">Activities</h3>
            <div class="row g-4">
                @foreach ($activities as $activity)
                    <div class="col-md-6 col-xl-4">
                        <div class="tour-package-box style-3 bg-white-color h-100 position-relative">
                            <div class="tour-package-thumb">
                                @php
                                    $image = optional($activity->images->first())->image;
                                    $imagePath = $image
                                        ? 'https://morocco-quest.com/public/storage/' .
                                            ltrim(str_replace(['public/storage/', 'storage/'], '', $image), '/')
                                        : 'https://morocco-quest.com/assets/img/activities/activity-placeholder.png';
                                @endphp
                                <img src="{{ $imagePath }}"
                                    alt="Join {{ $activity->title }} in {{ $activity->location ?? 'Morocco' }}"
                                    class="w-100" loading="lazy" style="aspect-ratio: 4/3; object-fit: cover;" />
                            </div>
                            <div class="tour-package-content">
                                <div class="location mb-2">
                                    <i class="fa-solid fa-location-dot me-1"></i>
                                    <span>{{ $activity->location ?? 'Unknown Location' }}</span>
                                </div>
                                <h5 class="title line-clamp-2 mb-3">
                                    <a href="{{ route('activities.show', $activity->slug) }}"
                                        class="stretched-link">{{ $activity->title }}</a>
                                </h5>
                                <div class="tour-package-footer d-flex justify-content-between align-items-center">
                                    <div class="tour-duration me-2">
                                        <i class="fa-regular fa-clock"></i>
                                        <span class="ms-1">{{ $activity->duration ?? 'Flexible Duration' }}</span>
                                    </div>
                                    @if (isset($activity->price_adult))
                                        <div class="pricing-info text-end">
                                            <span class="fs-xs d-block">

                                            </span>
                                            <span class="new-price text-theme fw-semibold fs-5">Price On Request</span>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $activities->links() }}
        @endif
    </div>
@endsection
