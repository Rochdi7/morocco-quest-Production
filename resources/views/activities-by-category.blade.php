@extends('layouts.app2') {{-- Or your main layout file --}}

{{-- Dynamic title using the category name --}}
@section('title', 'Activities in ' . $category->name)

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
                            {{-- Show category name in title --}}
                            <h1 class="breadcrumb-title">{{ $category->name }} Activities</h1>
                             {{-- Optional: Show category description --}}
                             @if($category->description)
                                <p class="text-white">{{ $category->description }}</p>
                             @endif
                        </div>
                        <div class="breadcrumb-menu">
                            <ul class="custom-ul">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                {{-- Link back to the main category list --}}
                                <li><a href="{{ route('activity-categories.index') }}">Activity Categories</a></li>
                                {{-- Current category name (not linked) --}}
                                <li>{{ $category->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================= Breadcrumb Area end =================-->

        <!--================= Activities List Area Start =================-->
        <section class="vs-tour-package space"> {{-- Using tour-package class for similar styling --}}
            <div class="container">
                {{-- Check if there are activities in this category --}}
                @if($activities->count() > 0)
                    <div class="row gy-4"> {{-- Use gy-4 for vertical spacing between rows --}}
                        {{-- Loop through activities passed from controller --}}
                        @foreach ($activities as $activity)
                            <div class="col-md-6 col-lg-4"> {{-- 3 cards per row on large screens --}}
                                {{-- Reusing the tour package box style for consistency --}}
                                <div class="tour-package-box bg-white-color h-100"> {{-- Added h-100 for equal height potential --}}
                                    <div class="tour-package-thumb">
                                        @php
                                            $imageUrl = optional($activity->images->first())->image
                                                        ? asset(optional($activity->images->first())->image)
                                                        : asset('assets/img/tour-packages/tour-placeholder.png'); // Placeholder
                                        @endphp
                                        <a href="{{ route('activities.show', $activity->slug) }}">
                                            <img src="{{ $imageUrl }}" alt="{{ $activity->title }}" class="w-100" />
                                        </a>
                                         {{-- Discount Badge --}}
                                         @if(isset($activity->discount_percentage) && $activity->discount_percentage > 0)
                                             <span class="tour-package-offer">{{ $activity->discount_percentage }}% OFF</span>
                                         @endif
                                    </div>
                                    <div class="tour-package-content">
                                        {{-- Location/Departure --}}
                                        @if($activity->departure)
                                            <div class="tour-package-location">
                                                <i class="fas fa-map-marker-alt"></i> {{ $activity->departure }}
                                            </div>
                                        @endif
                                        <h5 class="tour-package-title line-clamp-2">
                                            <a href="{{ route('activities.show', $activity->slug) }}">{{ $activity->title }}</a>
                                        </h5>
                                        {{-- Optional: Short overview snippet --}}
                                        {{-- <p class="tour-package-desc line-clamp-3">{{ Str::limit(strip_tags($activity->overview), 100) }}</p> --}}
                                        <div class="row g-2 justify-content-between align-items-center mt-auto pt-3"> {{-- Push footer to bottom --}}
                                            <div class="col-auto">
                                                <div class="tour-package-info">
                                                    {{-- Duration --}}
                                                    @if($activity->duration_days)
                                                        <span class="info-item">
                                                            <i class="fas fa-clock"></i> {{ $activity->duration_days }} {{ Str::plural('Day', $activity->duration_days) }}
                                                        </span>
                                                    @endif
                                                    {{-- Group Size --}}
                                                    {{-- @if($activity->group_size)
                                                        <span class="info-item">
                                                            <i class="fas fa-users"></i> {{ $activity->group_size }}
                                                        </span>
                                                    @endif --}}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                 {{-- Price --}}
                                                 @if(isset($activity->price_adult))
                                                    <div class="tour-package-price">
                                                        From <span class="price">${{ number_format($activity->price_adult) }}</span>
                                                    </div>
                                                 @endif
                                            </div>
                                        </div>
                                        {{-- View Details Button --}}
                                         <a href="{{ route('activities.show', $activity->slug) }}" class="vs-btn style7 w-100 mt-3">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> {{-- End row --}}

                    {{-- Pagination Links for Activities --}}
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mt-5"> {{-- Added margin top --}}
                            {{ $activities->links() }} {{-- Render pagination links --}}
                        </div>
                    </div>
                @else
                    {{-- Message if the category exists but has no activities --}}
                    <div class="row">
                        <div class="col-12 text-center">
                            <p>There are currently no activities listed under the category "{{ $category->name }}".</p>
                            <a href="{{ route('activity-categories.index') }}" class="vs-btn mt-3">View Other Categories</a>
                        </div>
                    </div>
                @endif
            </div> {{-- End container --}}
        </section>
        <!--================= Activities List Area end =================-->
    </main>
@endsection

@push('styles')
{{-- Add specific styles if needed, e.g., for equal height cards --}}
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