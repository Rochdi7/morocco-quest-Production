{{-- ═══════════════════════════════════════════════════════
     DMC PRODUCTS — 3 tours (top row) + 3 activities (bottom row)
     Shared across every DMC page. Self-contained: queries its own
     data (cached 1h) so the DMC controllers stay untouched.
═══════════════════════════════════════════════════════ --}}
@php
    $dmcTours = \Illuminate\Support\Facades\Cache::remember('dmc_products_tours', 3600, function () {
        return \App\Models\Tour::with(['firstImage'])->latest()->take(3)->get();
    });

    $dmcActivities = \Illuminate\Support\Facades\Cache::remember('dmc_products_activities', 3600, function () {
        return \App\Models\Activity::with(['firstImage', 'category'])->latest()->take(3)->get();
    });
@endphp

@if($dmcTours->isNotEmpty() || $dmcActivities->isNotEmpty())
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <span class="sec-subtitle">Build Your Packages</span>
                <h2 class="sec-title">Explore Our Morocco Products</h2>
                <p>Ready-made itineraries and destination content to build your client packages from — all available on a B2B net-rate basis.</p>
            </div>
        </div>

        {{-- ── TOP ROW: TOURS ── --}}
        @if($dmcTours->isNotEmpty())
        <div class="row g-4">
            @foreach($dmcTours as $tour)
            <div class="col-md-6 col-xl-4">
                <div class="tour-package-box style-3 bg-white-color h-100 position-relative">
                    <div class="tour-package-thumb">
                        @php $tourImageUrl = $tour->first_image_url; @endphp
                        @if($tourImageUrl)
                            @php $tourSrcset = \App\Support\ResponsiveImage::srcset($tourImageUrl); @endphp
                            <img src="{{ $tourImageUrl }}"
                                 alt="{{ $tour->title }} — Morocco Quest DMC net-rate tour for travel agents"
                                 class="w-100" loading="lazy" width="450" height="340"
                                 style="aspect-ratio: 4/3; object-fit: cover;"
                                 @if($tourSrcset) srcset="{{ $tourSrcset }}"
                                 sizes="(max-width: 767px) 100vw, (max-width: 1199px) 50vw, 33vw" @endif>
                        @endif
                    </div>
                    <div class="tour-package-content">
                        <div class="location mb-2">
                            <i class="fa-solid fa-location-dot me-1"></i>
                            <span>{{ $tour->location ?? ($tour->departure ?? 'Morocco') }}</span>
                        </div>
                        <h5 class="title line-clamp-2 mb-3">
                            <a href="{{ route('tours.show', ['slug' => $tour->slug]) }}" class="stretched-link">{{ $tour->title }}</a>
                        </h5>
                        <div class="tour-package-footer d-flex justify-content-between align-items-center">
                            <div class="tour-duration me-2">
                                <i class="fa-solid fa-clock"></i>
                                @php
                                    $durationText = 'Flexible';
                                    if (!empty($tour->duration_days) && is_numeric($tour->duration_days)) {
                                        $days = (int) $tour->duration_days;
                                        $durationText = $days . ' ' . \Illuminate\Support\Str::plural('Day', $days);
                                    }
                                @endphp
                                <span class="ms-1">{{ $durationText }}</span>
                            </div>
                            <div class="pricing-info text-end">
                                <span class="fs-14 ff-rubik" style="font-weight:700;color:var(--theme-color);">Net rate <i class="fa-solid fa-arrow-right-long ms-1"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- ── BOTTOM ROW: ACTIVITIES ── --}}
        @if($dmcActivities->isNotEmpty())
        <div class="row g-4 mt-1">
            @foreach($dmcActivities as $activity)
            <div class="col-md-6 col-xl-4">
                <div class="tour-package-box style-3 bg-white-color h-100 position-relative">
                    <div class="tour-package-thumb">
                        @php $activityImageUrl = $activity->first_image_url; @endphp
                        @if($activityImageUrl)
                            @php $activitySrcset = \App\Support\ResponsiveImage::srcset($activityImageUrl); @endphp
                            <img src="{{ $activityImageUrl }}"
                                 alt="{{ $activity->title }} — Morocco Quest DMC group experience in Morocco"
                                 class="w-100" loading="lazy" width="450" height="340"
                                 style="aspect-ratio: 4/3; object-fit: cover;"
                                 @if($activitySrcset) srcset="{{ $activitySrcset }}"
                                 sizes="(max-width: 767px) 100vw, (max-width: 1199px) 50vw, 33vw" @endif>
                        @endif
                    </div>
                    <div class="tour-package-content">
                        <div class="location mb-2">
                            <i class="fa-solid fa-tag me-1"></i>
                            <span>{{ $activity->category->name ?? 'Experience' }}</span>
                        </div>
                        <h5 class="title line-clamp-2 mb-3">
                            <a href="{{ route('activities.show', $activity->slug) }}" class="stretched-link">{{ $activity->title }}</a>
                        </h5>
                        <div class="tour-package-footer d-flex justify-content-between align-items-center">
                            <div class="tour-duration me-2">
                                <i class="fa-solid fa-circle-check"></i>
                                <span class="ms-1">Day experience</span>
                            </div>
                            <div class="pricing-info text-end">
                                <span class="fs-14 ff-rubik" style="font-weight:700;color:var(--theme-color);">Net rate <i class="fa-solid fa-arrow-right-long ms-1"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="row g-3 justify-content-center mt-4">
            <div class="col-12 col-sm-auto">
                <a href="{{ route('tours.index') }}" class="vs-btn d-block">Browse All Tours</a>
            </div>
            <div class="col-12 col-sm-auto">
                <a href="{{ route('experiences.index') }}" class="vs-btn d-block"
                   style="background:transparent;border:2px solid var(--theme-color);color:var(--theme-color);">
                    Browse All Activities
                </a>
            </div>
        </div>
    </div>
</section>
@endif
