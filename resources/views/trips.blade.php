{{-- Assuming you have a main layout file like layouts.app --}}
{{-- Adjust extends and section names as per your project structure --}}
@extends('layouts.app') {{-- Or your main layout file --}}

@section('title', 'Our Trips') {{-- Set the page title --}}

@section('content')

    <main> {{-- Or your main content wrapper --}}

      <!--================= Tour Package Area Start =================-->
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

          {{-- Start of Dynamic Trip Loop --}}
          <div class="row g-4">

            {{-- Use @forelse to handle cases where there are no trips --}}
            @forelse ($trips as $trip)
              <div class="col-md-6 col-xl-4">
                <div class="tour-package-box style-3 bg-white-color">
                  <div class="tour-package-thumb">
                    {{-- IMPORTANT: Replace with dynamic image path once you add the field --}}
                    {{-- Example assuming 'image_path' field stores the path in public/storage --}}
                    {{-- <img src="{{ asset('storage/' . $trip->image_path) }}" alt="{{ $trip->title }}" class="w-100" /> --}}

                    {{-- TEMPORARY Placeholder Image - REMOVE/REPLACE THIS --}}
                    <img
                      src="{{ asset('assets/img/tour-packages/tour-package-3-'. (($loop->index % 6) + 1) .'.png') }}" {{-- Cycle through static images --}}
                      {{-- src="{{ asset('assets/img/tour-packages/tour-package-placeholder.png') }}" --}} {{-- Or use a single placeholder --}}
                      alt="{{ $trip->title }}"
                      class="w-100"
                    />
                  </div>
                  <div class="tour-package-content">
                    <div class="location">
                      <i class="fa-sharp fa-light fa-location-dot"></i>
                      {{-- Use departure or a dedicated location field --}}
                      <span>{{ $trip->location_display }}</span>
                    </div>
                    <h5 class="title line-clamp-2">
                      {{-- Link to the trip details page using the slug --}}
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
                        <span>{{ $trip->duration_days }} {{ Str::plural('Day', $trip->duration_days) }}</span> {{-- Pluralize 'Day' --}}
                      </div>
                      <div class="pricing-info fw-medium">
                        From
                        {{-- No 'old_price' in schema, so we remove the <del> tag --}}
                        {{-- <del class="text-theme-color fw-semibold">$800</del> --}}
                        <h5 class="new-price">${{ $trip->formatted_price }}</h5> {{-- Use formatted price_adult --}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              {{-- Message shown if $trips is empty --}}
              <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                  No trips found at the moment. Please check back later!
                </div>
              </div>
            @endforelse

          </div> {{-- End of .row.g-4 --}}

          {{-- Pagination Links --}}
          <div class="row">
              <div class="col-12 d-flex justify-content-center space-extra-top">
                  {{-- Render pagination links if using paginate() in controller --}}
                  {{ $trips->links('pagination::bootstrap-5') }} {{-- Use Bootstrap 5 pagination view --}}
              </div>
          </div>

          {{-- Optional: Keep the "View More" button if not using pagination, --}}
          {{-- or if it links to a different 'all trips' page --}}
          {{-- <div class="row">
            <div class="col-12">
              <div class="text-center space-extra-top btn-trigger btn-bounce">
                 Link to the same page if using pagination, or a dedicated 'all trips' page if this is a homepage snippet
                <a href="{{ route('trips.index') }}" class="vs-btn style6 text-capitalize">View More</a>
              </div>
            </div>
          </div> --}}

        </div> {{-- End of .container --}}
      </section>
      <!--================= Tour Package Area end =================-->

    </main> {{-- End main content wrapper --}}

@endsection