@extends('layouts.app2')

@section('title', 'Morocco Activities & Day Tours | Marrakech Desert Tours - Morocco Quest')
@section('description', 'Morocco activities and day tours: marrakech desert tours, sahara desert tour from marrakech, and private tours in morocco. Browse all activity categories.')
@section('keywords', 'marrakech desert tours, sahara desert tour from marrakech, private tours in morocco, morocco private tours, luxury desert tours marrakech')

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
                        <h1 class="breadcrumb-title">Our Activities</h1>
                    </div>
                    <div class="breadcrumb-menu">
                        <ul class="custom-ul">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>Activities</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================= Breadcrumb Area end =================-->

    <!--================= Activities Area Start =================-->
    @if(isset($activityCategories) && $activityCategories->count() > 0)
        <section class="vs-activities space">
            <img src="{{ asset('assets/img/icons/tree.png') }}" alt="tree-icon" class="animate-tree activities-icon-1" />
            <div class="container">
                <div class="row gx-3 gy-3">
                    @foreach ($activityCategories as $category)
                        <div class="col-md-6 col-lg-4">
                            <div class="activities-box">
                                <figure class="activities-thumb">
                                    <a href="{{ route('activities.byCategory', ['category_slug' => $category->slug]) }}">
                                        <img src="{{ asset('storage/' . ($category->image_path ?? 'assets/img/activities/activity-placeholder.png')) }}"
                                             alt="{{ $category->name }}"
                                             class="w-100" />
                                    </a>
                                </figure>
                                <div class="activities-content">
                                    <h5 class="title">
                                        <a href="{{ route('activities.byCategory', ['category_slug' => $category->slug]) }}">
                                            {{ $category->name }}
                                        </a>
                                    </h5>
                                    <span class="info">
                                        {{ $category->activities_count }} {{ Str::plural('activity', $category->activities_count) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination Links for Categories --}}
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-40">
                        {{ $activityCategories->links() }}
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="vs-activities space">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p>No activity categories found at the moment.</p>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--================= Activities Area end =================-->
</main>
@endsection
