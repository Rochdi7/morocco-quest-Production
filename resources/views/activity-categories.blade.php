@extends('layouts.app2')

@section('title', $title ?? 'Things to Do in Morocco | Activities, Day Tours & Experiences | Morocco Quest')
@section('description', $description ?? 'Best things to do in Morocco: camel rides, quad biking in Marrakech, desert hikes, food tours and day trips. Private & small group activities with a top-rated local agency.')
@section('keywords', $keywords ?? 'things to do in marrakech, things to do in morocco, morocco activities, morocco day tours, morocco day trips, morocco camel tours, morocco hiking tours, morocco food tour, quad biking marrakech')


@section('content')
    <main> {{-- Semantic <main> tag --}}

        {{-- Breadcrumb section --}}
        <section class="vs-breadcrumb"
            data-bg-src="{{ asset('assets/img/moroccan-belly-dance-night-cultural-activity.webp') }}">
            <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="Decorative cloud icon"
                class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />

            <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="Decorative hot air balloon icon"
                class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />

            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h1 class="breadcrumb-title">Morocco Activities & Private Tours</h1>
                            <p class="breadcrumb-subtitle" style="color: white;">
                                Explore exclusive morocco travel experiences with small group tours morocco.
                            </p>

                            <figcaption class="image-caption visually-hidden">
                                A joyful moment as a guest joins a belly dancer during a traditional Moroccan evening
                                show.
                            </figcaption>

                            <p class="visually-hidden">
                                Discover Moroccan nightlife through cultural performances. Guests are invited to
                                participate in lively belly dance shows,
                                a vibrant celebration of music, rhythm, and local tradition.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- Check if categories exist --}}
        @if (isset($activityCategories) && $activityCategories->count() > 0)
            {{-- Main content section listing categories --}}
            <section class="vs-activities space">
                {{-- Decorative Image: Has loading="lazy" --}}
                <img src="{{ asset('assets/img/icons/tree.png') }}" alt="Decorative palm tree icon"
                    class="animate-tree activities-icon-1" loading="lazy" {{-- Lazy Loading is correctly applied --}} {{--
                        width="X" height="Y" --}}
                    {{-- Recommended: Add dimensions to prevent layout shift --}} />
                <div class="container">
                    <div class="row gx-3 gy-3">
                        {{-- Loop through available categories --}}
                        @foreach ($activityCategories as $category)
                            {{-- $category->slug, ->name, ->image_path, ->activities_count are used correctly --}}
                            <div class="col-md-6 col-lg-4">
                                <div class="activities-box">
                                    <figure class="activities-thumb">
                                        {{-- Link to the specific category page --}}
                                        <a href="{{ route('activities.byCategory', ['category_slug' => $category->slug]) ?? '#' }}"
                                            aria-label="View activities in the {{ e($category->name) }} category">
                                            {{-- Added
                                                e() for safety --}}
                                            {{-- Category Image: Has loading="lazy", dynamic alt, onerror fallback --}}
                                            <img src="{{ $category->image_path ? asset(Str::startsWith($category->image_path, 'public/storage/') ? $category->image_path : 'public/storage/' . ltrim($category->image_path, '/')) : asset('assets/img/activities/activity-placeholder.png') }}"
                                                alt="Activities in category: {{ e($category->name) }}" class="w-100"
                                                loading="lazy"
                                                onerror="this.onerror=null;this.src='{{ asset('assets/img/activities/activity-placeholder.png') }}';" />

                                        </a>
                                    </figure>
                                    <div class="activities-content">
                                        {{-- Category Title (H5 is acceptable here) --}}
                                        <h5 class="title">
                                            <a href="{{ route('activities.byCategory', ['category_slug' => $category->slug]) ?? '#' }}"
                                                aria-label="View activities in the {{ e($category->name) }} category">
                                                {{--
                                                    Added e() for safety --}}
                                                {{ $category->name }}
                                            </a>
                                        </h5>
                                        {{-- Display activity count with correct pluralization --}}
                                        {{-- $category->activities_count: Outputs the count. Str::plural handles "Activity" vs
                                            "Activities". --}}
                                        <span class="info">
                                            {{ $category->activities_count }}
                                            {{ Str::plural('Activity', $category->activities_count) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination Links --}}
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mt-40">
                            {{-- Check if pagination is needed before rendering links --}}
                            @if ($activityCategories->hasPages())
                                {{ $activityCategories->links() }} {{-- Renders Laravel's default pagination view --}}
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @else
            {{-- Fallback content if no categories are found --}}
            <section class="vs-activities space">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <p>No activity categories found at the moment. Please check back soon!</p>
                            {{-- Optional: Link back to home or main activities page --}}
                            <a href="{{ route('home') ?? url('/') }}" class="vs-btn mt-3">Back to Home</a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
