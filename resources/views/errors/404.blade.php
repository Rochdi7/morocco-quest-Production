@php
    $siteName = config('app.name', 'Morocco Quest');
@endphp

@extends('layouts.app2')

@section('title', 'Page Not Found (404) | ' . $siteName)

@section('page_description', 'Sorry, the page you were looking for could not be found on ' . $siteName . '. Please check the URL or return to the homepage.')

@section('content')
    <!--================= Breadcrumb Area start =================-->
    <section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/grand-theatre-de-rabat-404-hero.webp') }}">
        <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="Decorative cloud icon"
            class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />

        <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="Decorative hot air balloon icon"
            class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />

        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h1 class="breadcrumb-title">Page Not Found</h1>
                        <p class="breadcrumb-subtitle" style="color: white;">
                            Oops! The page you are looking for doesn’t exist. Let's get you back on track.
                        </p>

                        <figcaption class="image-caption visually-hidden">
                            High-resolution black and white photo of the Grand Theatre of Rabat, Morocco. Featuring bold futuristic architecture, this iconic landmark enhances your 404 error page with elegance and modern Moroccan design.
                        </figcaption>

                        <p class="visually-hidden">
                            This stunning image captures the Grand Theatre of Rabat, a symbol of modern Moroccan architecture and cultural significance. Even when lost, beauty and elegance remain constant.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================= Breadcrumb Area end =================-->

    <!--================= Error Area Start =================-->
    <section class="vs-error space" data-bg-src="{{ asset('assets/img/bg/404-bg.png') }}">
        <div class="container">
            <div class="row g-4 gx-xxl-5 justify-content-between align-items-center p-xxl-0">
                <div class="col-lg-6 text-center text-lg-start">
                    <img class="error-img mb-60 mw-100"
                        src="{{ asset('assets/img/error/error.png') }}"
                        alt="Illustration indicating a 404 Page Not Found error"
                        loading="lazy"
                        width="600" height="450" />
                </div>
                <div class="col-lg-6">
                    <div class="error-content text-center">
                        <h2 class="sec-title display-1 fw-bold text-theme mb-0">404</h2>
                        <span class="sec-subtitle mb-3 fs-4 d-block">Oops! Page Not Found</span>

                        <p class="error-text mb-4 pb-2">
                            We're sorry, but the page you were looking for seems to have gone missing or never existed.
                            Please check the web address for typos, or try one of the options below.
                        </p>

                        <a href="{{ route('home') }}" class="vs-btn mb-4">
                            <i class="fas fa-home me-2"></i> Go Back To Homepage
                        </a>

                        <div class="mt-3">
                            <p class="mb-2">Alternatively, you can:</p>
                            <ul class="list-unstyled d-flex flex-wrap justify-content-center gap-3">
                                <li><a href="{{ route('destinations.index') }}" class="text-link">Browse Tours</a></li>
                                <li><a href="{{ route('activities.index') }}" class="text-link">Explore Activities</a></li>
                                <li><a href="{{ route('blog.index') }}" class="text-link">Read Our Blog</a></li>
                                <li><a href="{{ route('contact.show') }}" class="text-link">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================= Error Area end =================-->
@endsection

@push('styles')
    <style>
        .text-link {
            color: var(--theme-color, #F7921E);
            text-decoration: underline;
        }
        .text-link:hover {
            color: var(--title-color, #1D2D35);
            text-decoration: none;
        }
        .vs-error .sec-title {
            font-size: clamp(6rem, 15vw, 10rem);
            line-height: 1;
        }
    </style>
@endpush