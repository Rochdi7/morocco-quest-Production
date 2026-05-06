@extends('layouts.app2') {{-- Make sure this points to your correct layout file --}}

@section('title', 'Morocco Destinations | Private Tours in Morocco - Morocco Quest')
@section('description', 'Explore morocco destinations with private tours in morocco. Marrakech desert tours, sahara desert tour from marrakech, and morocco private tours across all major cities.')
@section('keywords', 'private tours in morocco, morocco private tours, marrakech desert tours, sahara desert tour from marrakech, private morocco tours')

@section('content')
    {{-- The <main> tag might be part of your layout.
         If layouts.app2 already includes <main> around @yield('content'),
         you can remove the <main> and </main> tags below. --}}
    <main>

        <!--================= Breadcrumb Area start =================-->
        <section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/bg/breadcrumb-bg.png') }}">
            <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="vs-breadcrumb-icon"
                class="vs-breadcrumb-icon-1 animate-parachute" />
            <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="vs-breadcrumb-icon"
                class="vs-breadcrumb-icon-2 animate-parachute" />
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h1 class="breadcrumb-title">Explore destinations</h1>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul class="custom-ul">
                                <li>
                                    <a href="{{ url('/') }}">Home</a>
                                </li>
                                <li>destinations</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================= Breadcrumb Area end =================-->

        <!--================= Destination Area Start =================-->
        <section class="vs-destination space">
            <div class="container">
                {{-- Check if $placesData exists and has items --}}
                @if(isset($placesData) && $placesData->count() > 0)
                    <div class="row gx-3 gy-3">
                        {{-- Loop through each place --}}
                        @foreach ($placesData as $place)
                            <div class="col-md-6 col-lg-3">
                                {{-- Link to tours filtered by this place's name --}}
                                <a href="{{ route('tours.index', ['place' => $place->name]) }}"
                                    class="destination-box-2 d-block text-decoration-none">
                                    <figure class="destination-thumb">
                                        {{--
                                            Determine the image source:
                                            1. Check if the specific image file exists in public/storage.
                                            2. If yes, use the asset URL for the storage image.
                                            3. If no, use a default placeholder image.
                                        --}}
                                        @php
                                            $imagePath = 'storage/' . $place->image_path;
                                            $imageUrl = file_exists(public_path($imagePath))
                                                        ? asset($imagePath)
                                                        : asset('assets/img/destination/destination-1-1.png'); // Default image
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="Image for {{ $place->name }}" class="w-100" />
                                    </figure>
                                    <div class="destination-content">
                                        {{-- Display Place Name --}}
                                        <h5 class="title">
                                            {{ $place->name }}
                                        </h5>
                                        {{-- Display Tour Count (uses 'tours_count', likely from withCount('tours')) --}}
                                        <span class="info">
                                            {{ $place->tours_count ?? 0 }} {{ Str::plural('Tour', $place->tours_count ?? 0) }}
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination Links --}}
                    {{-- Check if $placesData is a Paginator instance before rendering links --}}
                    @if ($placesData instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $placesData->links() }} {{-- Render Bootstrap pagination links --}}
                        </div>
                    @endif

                @else
                    {{-- Message when no destinations are found --}}
                    <div class="row">
                        <div class="col-12 text-center">
                            <p>No destinations available at the moment.</p>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        <!--================= Destination Area end =================-->

    </main> {{-- Close main tag - remove if your layout already includes it --}}
@endsection