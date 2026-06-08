@extends('layouts.app')

@section('title', $title ?? 'Morocco Multi Day Tours & Trip Packages | Morocco Quest')
@section('description', $description ?? 'Book morocco trips & multi day tour packages: 3, 5 & 7-day morocco tours with sahara desert from Marrakech. Private morocco tours and small group tours morocco.')
@section('keywords', $keywords ?? 'morocco multi day tours, 3 day morocco tour, 5 day morocco tour, 7 day morocco tour, morocco trip packages, sahara desert trip marrakech, morocco itinerary')

@push('jsonld')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Morocco Multi-Day Trips', 'item' => url('/trips')],
    ],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
    <main>
        {{-- Phase 2: Hub intro — unique, entity-rich, cross-linked --}}
        <section class="hub-intro space-top">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9 text-center">
                        <h1 class="sec-title mb-3">Morocco Multi-Day Tours & Trip Packages</h1>
                        <p class="hub-intro-text">
                            Morocco Quest's multi-day trip packages are designed for travellers who want to move beyond Marrakech and see the full arc of the country: from the snowy peaks of the <strong>High Atlas</strong> and the red-clay kasbah at <strong>Aït Benhaddou</strong> to the black volcanic <strong>Drâa Valley</strong> and the golden dunes of <strong>Erg Chebbi</strong>. Packages range from 3 days to 10 days and include private 4×4 transport, English-speaking guide, Sahara desert camp, and selected riads and hotels. These are not coach tours — every departure is private or runs with a maximum of 8 travellers. Browse <a href="{{ route('tours.index') }}">all individual tours</a>, check out <a href="{{ route('activity-categories.index') }}">Morocco day activities</a>, or read the <a href="{{ route('blog.index') }}">travel blog</a> for itinerary inspiration before you book.
                        </p>
                    </div>
                </div>
            </div>
        </section>

      <section class="vs-tour-package style-2 space">
        <div class="container">
          <div class="row">
            <div class="col-lg-auto mx-auto">
              <div class="title-area text-center">
                <span
                  class="sec-subtitle text-capitalize fade-anim"
                  data-direction="top"
                  >Choose Your Package</span
                >
                <h2 class="sec-title fade-anim" data-direction="bottom">
                  Explore Popular package
                </h2>
              </div>
            </div>
          </div>
          <div class="row g-4">
            @forelse ($trips as $trip)
              <div class="col-md-6 col-xl-4">
                <div class="tour-package-box style-3 bg-white-color">
                  <div class="tour-package-thumb">
                    <img
                      src="{{ asset('assets/img/tour-packages/tour-package-3-'. (($loop->index % 6) + 1) .'.png') }}"
                      alt="{{ $trip->title }}"
                      class="w-100"
                    />
                  </div>
                  <div class="tour-package-content">
                    <div class="location">
                      <i class="fa-sharp fa-light fa-location-dot"></i>
                      <span>{{ $trip->location_display }}</span>
                    </div>
                    <h5 class="title line-clamp-2">
                      <a href="{{ route('trips.show', $trip->slug) }}">{{ $trip->title }}</a>
                    </h5>
                    <div class="tour-package-footer">
                      <div class="tour-duration">
                        <svg
                          width="16"
                          height="16"
                          viewBox="0 0 16 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M8 0C3.58888 0 0 3.58888 0 8C0 12.4111 3.58888 16 8 16C12.4111 16 16 12.4111 16 8C16 3.58888 12.4111 0 8 0ZM8 15C4.14013 15 1 11.8599 1 8C1 4.14013 4.14013 1 8 1C11.8599 1 15 4.14013 15 8C15 11.8599 11.8599 15 8 15Z"
                            fill="#556065"
                          />
                          <path
                            d="M8.5 3H7.5V8.20702L10.6465 11.3535L11.3535 10.6465L8.5 7.79295V3Z"
                            fill="#556065"
                          />
                        </svg>
                        <span>{{ $trip->duration_days }} {{ Str::plural('Day', $trip->duration_days) }}</span>
                      </div>
                      <div class="pricing-info fw-medium">
                        From
                        <h5 class="new-price">${{ $trip->formatted_price }}</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                  No trips found at the moment. Please check back later!
                </div>
              </div>
            @endforelse
          </div>
          <div class="row">
              <div class="col-12 d-flex justify-content-center space-extra-top">
                  {{ $trips->links('pagination::bootstrap-5') }}
              </div>
          </div>
        </div>
      </section>
    </main>
@endsection