@extends('layouts.app2') {{-- Or your main layout file --}}

{{-- Dynamic title based on context --}}
@section('title')
    @if($placeName)
        Tours in {{ $placeName }}
    @elseif($query)
        Search Results for "{{ $query }}"
    @else
        Explore Our Tours
    @endif
@endsection

@section('content')
    <main>
        <!--================= Breadcrumb Area start =================-->
        <section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/bg/breadcrumb-bg.png') }}">
            <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="vs-breadcrumb-icon" class="vs-breadcrumb-icon-1 animate-parachute" />
            <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="vs-breadcrumb-icon" class="vs-breadcrumb-icon-2 animate-parachute" />
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            {{-- Show title based on context --}}
                            <h1 class="breadcrumb-title">
                                @if($placeName)
                                    Tours in {{ $placeName }}
                                @elseif($query)
                                    Search Results
                                @else
                                    Explore Our Tours
                                @endif
                            </h1>
                             {{-- Optional: Show search query if applicable --}}
                             @if($query)
                                <p class="text-white">Showing results for: "{{ $query }}"</p>
                             @endif
                        </div>
                        <div class="breadcrumb-menu">
                            <ul class="custom-ul">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                {{-- Link back to the main destinations list --}}
                                <li><a href="{{ route('destinations.list') }}">Destinations</a></li>
                                {{-- Show current place if filtering, or "Tours" if not --}}
                                @if($placeName)
                                    <li>{{ $placeName }}</li>
                                @else
                                    <li>Tours</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================= Breadcrumb Area end =================-->

        <!--================= Tours List Area Start =================-->
        {{-- Using tour-package class for similar styling as activities --}}
        <section class="vs-tour-package space">
            <div class="container">
                {{-- Check if there are tours matching the criteria --}}
                @if($tours->count() > 0)
                    <div class="row gy-4"> {{-- Use gy-4 for vertical spacing between rows --}}
                        {{-- Loop through tours passed from controller --}}
                        @foreach ($tours as $tour)
                            <div class="col-md-6 col-lg-4"> {{-- 3 cards per row on large screens --}}
                                {{-- Reusing the tour package box style for consistency --}}
                                <div class="tour-package-box bg-white-color h-100"> {{-- Added h-100 for equal height --}}
                                    <div class="tour-package-thumb">
                                        @php
                                            // Use the eager-loaded firstImage relation if available
                                            $imageUrl = optional($tour->firstImage)->image
                                                        ? asset(optional($tour->firstImage)->image)
                                                        : asset('assets/img/tour-packages/tour-placeholder.png'); // Default Placeholder
                                        @endphp
                                        <a href="{{ route('tours.show', $tour->slug) }}">
                                            <img src="{{ $imageUrl }}" alt="{{ $tour->title }}" class="w-100" />
                                        </a>
                                         {{-- Discount Badge --}}
                                         @if(isset($tour->discount_percentage) && $tour->discount_percentage > 0)
                                             <span class="tour-package-offer">{{ $tour->discount_percentage }}% OFF</span>
                                         @endif
                                    </div>
                                    <div class="tour-package-content">
                                        {{-- Location/Departure --}}
                                        @if($tour->departure)
                                            <div class="tour-package-location">
                                                <i class="fas fa-map-marker-alt"></i> {{ $tour->departure }}
                                            </div>
                                        @endif
                                        <h5 class="tour-package-title line-clamp-2">
                                            <a href="{{ route('tours.show', $tour->slug) }}">{{ $tour->title }}</a>
                                        </h5>
                                        {{-- Optional: Short overview snippet --}}
                                        {{-- <p class="tour-package-desc line-clamp-3">{{ Str::limit(strip_tags($tour->overview), 100) }}</p> --}}
                                        <div class="row g-2 justify-content-between align-items-center mt-auto pt-3"> {{-- Push footer to bottom --}}
                                            <div class="col-auto">
                                                <div class="tour-package-info">
                                                    {{-- Duration --}}
                                                    @if($tour->duration_days)
                                                        <span class="info-item">
                                                            <i class="fas fa-clock"></i> {{ $tour->duration_days }} {{ Str::plural('Day', $tour->duration_days) }}
                                                        </span>
                                                    @endif
                                                    {{-- Group Size (Optional, if you have this field) --}}
                                                    {{-- @if($tour->group_size)
                                                        <span class="info-item">
                                                            <i class="fas fa-users"></i> {{ $tour->group_size }}
                                                        </span>
                                                    @endif --}}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                 {{-- Price --}}
                                                 @if(isset($tour->price_adult))
                                                    <div class="tour-package-price">
                                                        From <span class="price">${{ number_format($tour->price_adult) }}</span>
                                                    </div>
                                                 @endif
                                            </div>
                                        </div>
                                        {{-- View Details Button --}}
                                         <a href="{{ route('tours.show', $tour->slug) }}" class="vs-btn style7 w-100 mt-3">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> {{-- End row --}}

                    {{-- Pagination Links for Tours --}}
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mt-5"> {{-- Added margin top --}}
                            {{-- Append existing query parameters (like 'place' or 'query') to pagination links --}}
                            {{ $tours->appends(request()->query())->links() }}
                        </div>
                    </div>
                @else
                    {{-- Message if no tours are found --}}
                    <div class="row">
                        <div class="col-12 text-center">
                            @if($placeName)
                                <p>There are currently no tours listed for the destination "{{ $placeName }}".</p>
                                <a href="{{ route('destinations.list') }}" class="vs-btn mt-3">View Other Destinations</a>
                            @elseif($query)
                                <p>No tours found matching your search criteria "{{ $query }}".</p>
                                <a href="{{ route('tours.index') }}" class="vs-btn mt-3">View All Tours</a>
                            @else
                                <p>No tours available at the moment.</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div> {{-- End container --}}
        </section>
        <!--================= Tours List Area end =================-->
    </main>
@endsection

@push('styles')
{{-- Reusing the same styles from the activities page for consistency --}}
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
    .tour-package-content > .row { /* Target the footer row */
        margin-top: auto; /* Pushes the footer down */
    }
    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        min-height: 2.4em; /* Adjust based on font size/line height for 2 lines */
    }
     .line-clamp-3 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
     }
     /* Style for the discount badge */
    .tour-package-thumb {
        position: relative; /* Needed for absolute positioning of badge */
    }
    .tour-package-offer {
        position: absolute;
        top: 15px;
        left: 15px;
        background-color: var(--theme-color); /* Or your desired offer color */
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
        margin-bottom: 8px; /* Spacing below location */
    }
    .tour-package-location i {
         margin-right: 4px;
         color: var(--theme-color);
    }
    .tour-package-info .info-item {
        margin-right: 10px; /* Add some spacing between info items */
        font-size: 0.9em;
        color: #666;
    }
    .tour-package-info .info-item i {
        margin-right: 4px;
        color: var(--theme-color); /* Adjust icon color */
    }
    .tour-package-price {
        font-size: 0.9em;
        color: #666;
    }
     .tour-package-price .price {
        font-size: 1.3em;
        font-weight: bold;
        color: var(--title-color); /* Adjust price color */
    }

</style>
@endpush