@extends('layouts.app2')

@section('title', $title ?? 'Event Production Morocco | Corporate Events Company Marrakech | Morocco Quest')
@section('description', $description ?? 'Morocco Quest is an event production company in Marrakech handling staging, lighting, sound, LED and scenography for product launches, brand activations and corporate galas — on-site crew from load-in to strike.')
@section('keywords', is_array($keywords ?? null) ? implode(', ', $keywords) : ($keywords ?? 'events production morocco, event production company marrakech, corporate events morocco, event production marrakech'))

@push('jsonld')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Event Production and Communication",
    "name": "Events Production & Communication — Morocco Quest DMC",
    "description": "Morocco Quest produces corporate events in Marrakech and across Morocco, covering scenography, lighting, sound, LED, video and entertainment booking for brand launches, activations and galas.",
    "provider": {
        "@id": "{{ url('/') }}#organization"
    },
    "areaServed": [
        { "@type": "City", "name": "Marrakech" },
        { "@type": "City", "name": "Casablanca" },
        { "@type": "City", "name": "Rabat" },
        { "@type": "Country", "name": "Morocco" }
    ],
    "url": "{{ url('/events-production-morocco') }}"
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "DMC", "item": "{{ url('/dmc-marrakech') }}" },
        { "@type": "ListItem", "position": 3, "name": "Events Production & Communication", "item": "{{ url('/events-production-morocco') }}" }
    ]
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "Can you source specialist production equipment that isn't available locally?",
            "acceptedAnswer": { "@type": "Answer", "text": "Where a specific LED pitch, line array or rigging component isn't held by our local suppliers, we arrange import from Europe. That gets built into the production timeline early, since customs and freight need lead time — it's one of the first questions we ask on a technical call." }
        },
        {
            "@type": "Question",
            "name": "Can you build a stage in a riad courtyard or a desert camp?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, and it's a large part of what we do. Riads and desert venues aren't built for rigging, so every load-in starts with a site survey — floor loads, power access, generator placement, sightlines — before a single truss goes up. What works in a convention hall doesn't automatically work in a 400-year-old courtyard." }
        },
        {
            "@type": "Question",
            "name": "How much lead time does a full production build need?",
            "acceptedAnswer": { "@type": "Answer", "text": "A production with custom scenography and imported equipment needs 3 to 4 months for design, sourcing and freight. A branded dinner or a smaller activation using locally available kit can often be turned around in 4 to 6 weeks, though we'd rather have more time on anything with a custom set build." }
        },
        {
            "@type": "Question",
            "name": "What happens to an outdoor production if the weather turns?",
            "acceptedAnswer": { "@type": "Answer", "text": "Every outdoor build gets a weather contingency written into the production plan before the event, not improvised on the day — covered rigging options, an indoor or tented fallback venue held on standby, and a call-time deadline for switching plans. Marrakech evenings are usually dry, but we don't stage a launch on 'usually.'" }
        },
        {
            "@type": "Question",
            "name": "Does your technical crew work in English?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. Our lighting, sound and stage crews are used to briefs and rehearsals in English and French, and have worked alongside international agencies and directors on past productions — you won't need a translator on the technical walkthrough." }
        }
    ]
}
</script>
@endpush

@push('scripts')
<script>window.__pageContext = { page_type: 'events_production_morocco' };</script>
@endpush

@section('body_class', 'dmc-page')

@section('content')

@include('partials.dmc-spacing')

{{-- HERO --}}
<section class="vs-breadcrumb hero-overlay" data-bg-src="{{ asset('assets/img/morocco-quest-stage-performance-evening-event-hero.webp') }}">
    <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="" class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
    <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="" class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">Event Production Morocco: A Marrakech Crew for Staging, Lighting &amp; Scenography</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        Full-service event production in Marrakech — staging, lighting, sound and scenography, run by the same crew that's on-site for load-in, rehearsal and strike, not just the pitch.
                    </p>
                </div>
                <div class="breadcrumb-menu">
                    <ul class="custom-ul">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('dmc.marrakech') }}">DMC</a></li>
                        <li>Events Production & Communication</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- INTRO --}}
<section class="space pb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                <p style="font-size:1.1rem;color:#444;">Most brand events don't fall apart on the big idea — they fall apart on the technical rider the venue can't actually deliver, the LED wall that clears customs two days late, or a stage rigged for a hall that turns out to have half the ceiling height on the drawing.</p>
                <p style="font-size:1.05rem;color:#555;">Morocco Quest produces corporate events in Marrakech and across Morocco end to end: scenography, lighting, sound, LED and entertainment, run by a technical team physically present from load-in to strike. You brief one production partner, not six separate suppliers who've never met.</p>
                <a href="#events-enquiry" class="vs-btn mt-3">Talk With Our Production Team</a>
            </div>
        </div>
    </div>
</section>

{{-- ALTERNATING SERVICE STACK --}}
<section class="space">
    <div class="container">

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <figure class="mb-0">
                    <img src="{{ asset('assets/img/morocco-quest-event-scenography-stage-design-morocco.webp') }}"
                         alt="Custom scenography and stage set built by Morocco Quest for a corporate event in Morocco"
                         title="Event scenography and stage design — Morocco Quest event production"
                         class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
                    <figcaption style="font-size:.85rem;color:#777;margin-top:10px;">Set design built to the venue's real rigging points, floor loads and sightlines — not adapted from a template.</figcaption>
                </figure>
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Scenography & Staging</span>
                <h2 class="sec-title" style="font-size:1.6rem;">A Set Built for the Venue You Actually Booked</h2>
                <p>A stage design that works in a purpose-built convention hall rarely transfers to a riad courtyard or a desert camp without changes to rigging points, floor loads and sightlines. We design scenography around the venue's real constraints first — then build the theming, backdrops and set pieces that carry your brand into the space, whether that's a minimalist product plinth or a full theatrical set for a gala.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-9 mx-auto text-center">
                <span class="sec-subtitle style-2">Lighting & Sound Production</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Lighting That's Cued, Not Just Switched On</h2>
                <p>DMX-controlled rigs programmed to specific cues for keynotes, reveals and performances, paired with line array sound systems sized to the room rather than borrowed from whatever the venue has in storage. Our technical crew tests the full lighting and sound plot at rehearsal, so the first time your speaker hits their mark isn't the first time the follow spot finds them.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/morocco-quest-stage-lighting-production-event-morocco.webp') }}"
                     alt="Stage lighting and technical production rig set up by Morocco Quest at a corporate event in Morocco"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">LED & Video Production</span>
                <h2 class="sec-title" style="font-size:1.6rem;">A Screen That Holds Up in Daylight and on Camera</h2>
                <p>LED walls specced for the venue's ambient light and viewing distance, not a generic panel count, plus multi-camera live production for reveals, keynotes or panels that need to reach a remote audience. If your launch is streaming to head office or a press list that couldn't travel, we bring in the switching and broadcast crew alongside the on-site build.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4">
            <div class="col-lg-9 mx-auto text-center">
                <span class="sec-subtitle style-2">Entertainment & Talent Booking</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Performers Briefed to Your Run of Show, Not Just Booked</h2>
                <p>Local musicians, dancers and cultural performers alongside international acts and MCs when the brief calls for it — booked, briefed and rehearsed against your actual run of show, with timing that respects speeches and award moments rather than colliding with them. We handle contracts, technical riders and stage transitions so entertainment supports the programme instead of derailing it.</p>
            </div>
        </div>

    </div>
</section>

@include('partials.dmc-testimonials')



{{-- COMPLETE SOLUTIONS — SCATTERED TAG CLOUD --}}
<section class="space pb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="sec-subtitle">What's Covered</span>
                <h2 class="sec-title">Complete Event Production Solutions</h2>
                <p>Every technical and creative component of a brand event, handled under one agreement.</p>
            </div>
        </div>
        <div class="tb-tags mt-4">
            @php
            $solutions = [
                ['icon'=>'fa-drafting-compass', 'label'=>'Scenography & Staging', 'rot'=>-3],
                ['icon'=>'fa-lightbulb', 'label'=>'Lighting Design', 'rot'=>2],
                ['icon'=>'fa-volume-high', 'label'=>'Sound Production', 'rot'=>-2],
                ['icon'=>'fa-tv', 'label'=>'LED & Video Walls', 'rot'=>3],
                ['icon'=>'fa-camera', 'label'=>'Live Camera & Streaming', 'rot'=>-4],
                ['icon'=>'fa-music', 'label'=>'Entertainment & Talent', 'rot'=>1],
                ['icon'=>'fa-truck-fast', 'label'=>'Equipment Import & Freight', 'rot'=>-1],
                ['icon'=>'fa-headset', 'label'=>'On-Site Technical Crew', 'rot'=>4],
            ];
            @endphp
            @foreach($solutions as $i => $s)
            <div class="tb-tag {{ $i % 2 === 0 ? 'tb-tag--dark' : '' }}" style="--rot:{{ $s['rot'] }}deg;">
                <i class="fa-solid {{ $s['icon'] }}"></i>
                <span>{{ $s['label'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    /* ── What's Covered ──
       Desktop + tablet: the original free-wrapping scattered pill cloud.
       Mobile (≤767px): switches to a uniform 2-col grid, because at phone
       widths the rotated pills wrapped raggedly and were hard to read. */
    .tb-tags{
        display:flex;
        flex-wrap:wrap;
        justify-content:center;
        gap:18px 16px;
        max-width:1000px;
        margin:0 auto;
        padding:10px 0;
    }
    .tb-tag{
        display:inline-flex;
        align-items:center;
        gap:10px;
        padding:14px 22px;
        border-radius:30px;
        background:#fff;
        border:2px solid var(--theme-color);
        font-weight:700;
        font-size:.9rem;
        color:var(--title-color);
        transform:rotate(var(--rot));
        transition:transform .2s ease, background .2s ease, color .2s ease;
        cursor:default;
    }
    .tb-tag i{ color:var(--theme-color); font-size:1.05rem; transition:color .2s ease; }
    .tb-tag--dark{ background:#181613; border-color:#181613; color:#fff; }
    .tb-tag--dark i{ color:var(--theme-color); }
    .tb-tag:hover{
        transform:rotate(0deg) scale(1.06);
        background:var(--theme-color);
        border-color:var(--theme-color);
        color:#fff;
    }
    .tb-tag:hover i{ color:#fff; }

    /* Tablet — same scattered look, slightly tighter. */
    @media (max-width:991px){
        .tb-tags{ gap:14px 12px; max-width:760px; }
        .tb-tag{ padding:12px 18px; font-size:.84rem; gap:9px; }
        .tb-tag i{ font-size:.98rem; }
    }

    /* Mobile — uniform grid: no rotation, even rows, full-width cells. */
    @media (max-width:767px){
        .tb-tags{
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:10px;
            max-width:100%;
            padding:4px 0;
        }
        .tb-tag{
            justify-content:flex-start;
            padding:13px 14px;
            border-radius:12px;
            font-size:.76rem;
            line-height:1.3;
            gap:8px;
            border-width:1.5px;
            transform:none;
            height:100%;
        }
        .tb-tag i{ font-size:.92rem; flex-shrink:0; }
        .tb-tag:hover{ transform:none; }
    }
    @media (max-width:479px){
        .tb-tags{ gap:8px; }
        .tb-tag{ padding:11px 12px; font-size:.72rem; gap:7px; }
        .tb-tag i{ font-size:.86rem; }
    }
</style>


{{-- SIGNATURE MODULE: EVENT TYPE SHOWCASE --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="sec-subtitle">Match Your Format</span>
                <h2 class="sec-title">What Kind of Event Are You Producing?</h2>
                <p>A starting point — every production plan is still scoped around your actual brief and budget.</p>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $eventTypes = [
                ['label'=>'Product Launch', 'title'=>'Reveal-Led, Camera-Ready', 'body'=>'Built around a single reveal moment — a lift, a reverse-drape or a synchronized LED sequence — with lighting and video production designed for press photography and live-stream broadcast as much as the room.'],
                ['label'=>'Brand Activation', 'title'=>'Immersive, Multi-Zone', 'body'=>'Several themed zones rather than one stage: sampling areas, photo moments and interactive installs, each with its own lighting and sound treatment, briefed to agency creative direction rather than a single fixed set.'],
                ['label'=>'Award Ceremony', 'title'=>'Structured Run of Show', 'body'=>'A tightly cued programme — stage, lectern, video wall for nominee reels, orchestrated entrances and exits — where lighting and sound cues are locked to a rehearsed script rather than improvised on the night.'],
                ['label'=>'Anniversary Gala', 'title'=>'Scenography-Led Celebration', 'body'=>'The heaviest scenography of the four formats: full theming, a live band or headline performer, and a dinner service choreographed around speeches — designed to feel like a milestone, not a standard banquet.'],
            ];
            @endphp
            @foreach($eventTypes as $e)
            <div class="col-sm-6 col-lg-3">
                <div class="p-4" style="background:var(--theme-color);border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-size:.8rem;font-weight:700;color:rgba(255,255,255,.8);text-transform:uppercase;letter-spacing:.03em;margin-bottom:8px;">{{ $e['label'] }}</div>
                    <div style="font-weight:700;margin-bottom:8px;color:#fff;">{{ $e['title'] }}</div>
                    <div style="font-size:.88rem;color:rgba(255,255,255,.9);">{{ $e['body'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- WHY MARRAKECH --}}
<section class="space">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6 order-lg-2">
                <span class="sec-subtitle style-2">Why Marrakech</span>
                <h2 class="sec-title">A Backdrop That Does Some of the Storytelling for You</h2>
                <p>A product reveal staged against the medina walls, a gala set into a desert camp under the Atlas foothills — these are settings a hotel ballroom simply can't offer, and they do work for your brand before a single light is even rigged.</p>
                <p>Production costs here generally sit below Western European equivalents for comparable staging, lighting and crew day rates, and the technical crews we work with have built for international agencies before — they know what a European production rider actually expects on-site.</p>
            </div>
            <div class="col-lg-6 order-lg-1">
                <img src="{{ asset('assets/img/morocco-quest-jemaa-el-fna-night-market-marrakech.webp') }}"
                     alt="Jemaa el-Fna night market in Marrakech, backdrop for Morocco Quest event productions"
                     title="Jemaa el-Fna at night — Marrakech event backdrop"
                     width="1100" height="733"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
                <div class="row g-3 mt-1">
                    <div class="col-6">
                        <div style="background:var(--theme-color);border-radius:10px;padding:18px;text-align:center;box-shadow:0 4px 18px rgba(0,0,0,.06);">
                            <div style="font-size:1.7rem;font-weight:700;color:#fff;">24h</div>
                            <div style="font-size:.82rem;color:rgba(255,255,255,.85);">Quote turnaround</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:var(--theme-color);border-radius:10px;padding:18px;text-align:center;box-shadow:0 4px 18px rgba(0,0,0,.06);">
                            <div style="font-size:1.7rem;font-weight:700;color:#fff;">100%</div>
                            <div style="font-size:.82rem;color:rgba(255,255,255,.85);">White-label delivery</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- LEAD FORM --}}
<section class="space bg-theme-07" id="events-enquiry">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">Get a Proposal</span>
                    <h2 class="sec-title">Talk With Our Events Production Team</h2>
                    <p>Tell us your event format, guest count and dates — we respond within 24 hours with a concept and costed proposal.</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-dismissible fade show d-flex align-items-start gap-3 mb-4" role="alert" style="background:#e9f7ef;border:1px solid #a8d5b5;border-radius:10px;padding:18px 20px;">
                        <i class="fa-solid fa-circle-check" style="color:#27ae60;font-size:1.4rem;margin-top:2px;flex-shrink:0;"></i>
                        <div>
                            <div style="font-weight:700;color:#1a7a40;font-size:1rem;margin-bottom:2px;">Enquiry sent successfully!</div>
                            <div style="color:#2d6a4f;font-size:.92rem;">{{ session('success') }}</div>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-dismissible fade show d-flex align-items-start gap-3 mb-4" role="alert" style="background:#fdf0ef;border:1px solid #f5c6c2;border-radius:10px;padding:18px 20px;">
                        <i class="fa-solid fa-circle-exclamation" style="color:#e74c3c;font-size:1.4rem;margin-top:2px;flex-shrink:0;"></i>
                        <div>
                            <div style="font-weight:700;color:#a93226;font-size:1rem;margin-bottom:2px;">Something went wrong</div>
                            <div style="color:#922b21;font-size:.92rem;">{{ session('error') }}</div>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-dismissible fade show d-flex align-items-start gap-3 mb-4" role="alert" style="background:#fdf0ef;border:1px solid #f5c6c2;border-radius:10px;padding:18px 20px;">
                        <i class="fa-solid fa-triangle-exclamation" style="color:#e67e22;font-size:1.4rem;margin-top:2px;flex-shrink:0;"></i>
                        <div>
                            <div style="font-weight:700;color:#a04000;font-size:1rem;margin-bottom:6px;">Please fix the following errors:</div>
                            <ul style="margin:0;padding-left:18px;color:#784212;font-size:.92rem;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div style="background:#f7f6f4;border-radius:14px;padding:32px 28px;">
                <form action="{{ route('contact.submit') }}" method="POST" class="form-style1" novalidate>
                    @csrf
                    <input type="hidden" name="enquiry_type" value="Events Production">
                    <input type="hidden" name="page_source" value="events-production-morocco">
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label for="ep_name" style="font-weight:600;margin-bottom:4px;display:block;">Full Name *</label>
                            <input id="ep_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your full name" value="{{ old('name') }}" required autocomplete="name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="ep_company" style="font-weight:600;margin-bottom:4px;display:block;">Company / Brand *</label>
                            <input id="ep_company" name="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" placeholder="Your company or brand" value="{{ old('nationality') }}" required />
                            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="ep_email" style="font-weight:600;margin-bottom:4px;display:block;">Business Email *</label>
                            <input id="ep_email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@company.com" value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="ep_phone" style="font-weight:600;margin-bottom:4px;display:block;">Phone / WhatsApp *</label>
                            <input id="ep_phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="+1 / +44 / +33..." value="{{ old('phone') }}" required autocomplete="tel" />
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="ep_date" style="font-weight:600;margin-bottom:4px;display:block;">Preferred Event Date *</label>
                            <input id="ep_date" name="arrival_date" type="text" class="form-control @error('arrival_date') is-invalid @enderror" placeholder="Select event date" value="{{ old('arrival_date') }}" required readonly />
                            @error('arrival_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="ep_pax" style="font-weight:600;margin-bottom:4px;display:block;">Guest Count *</label>
                            <input id="ep_pax" name="adults" type="number" min="1" class="form-control @error('adults') is-invalid @enderror" placeholder="Number of guests" value="{{ old('adults') }}" required />
                            @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="ep_duration" style="font-weight:600;margin-bottom:4px;display:block;">Production Days *</label>
                            <input id="ep_duration" name="duration_days" type="number" min="1" class="form-control @error('duration_days') is-invalid @enderror" placeholder="Number of days" value="{{ old('duration_days') }}" required />
                            @error('duration_days')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label style="font-weight:600;margin-bottom:4px;display:block;">Event Type</label>
                            <select name="children" class="form-control" style="height:56px;">
                                <option value="0" {{ old('children') == '0' ? 'selected' : '' }}>Product Launch</option>
                                <option value="1" {{ old('children') == '1' ? 'selected' : '' }}>Brand Activation</option>
                                <option value="2" {{ old('children') == '2' ? 'selected' : '' }}>Award Ceremony</option>
                                <option value="3" {{ old('children') == '3' ? 'selected' : '' }}>Anniversary Gala</option>
                                <option value="4" {{ old('children') == '4' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label for="ep_brief" style="font-weight:600;margin-bottom:4px;display:block;">Event Brief *</label>
                            <textarea id="ep_brief" name="travel_ideas" class="form-control @error('travel_ideas') is-invalid @enderror" placeholder="Describe your event: format, staging/AV needs, entertainment, budget range..." rows="5" required>{{ old('travel_ideas') }}</textarea>
                            @error('travel_ideas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <div style="background:#f8f8f8;border-radius:8px;padding:14px 18px;font-size:.88rem;color:#555;margin-bottom:8px;">
                                <i class="fa-solid fa-lock me-2" style="color:var(--theme-color);"></i>
                                Your enquiry is 100% confidential and reviewed by our events production team directly.
                            </div>
                        </div>
                        @include('partials.recaptcha')
                        <div class="col-12 form-group mb-0">
                            <button class="vs-btn w-100 w-sm-auto" type="submit">
                                <i class="fa-solid fa-paper-plane me-2"></i> Request a Proposal
                            </button>
                            <div style="margin-top:12px;font-size:.88rem;color:#777;">
                                We reply within <strong>24 hours</strong> — or call us:
                                <a href="tel:+212654069718" style="color:var(--theme-color);font-weight:600;">+212 654 069 718</a>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FAQ (trimmed) --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">FAQ</span>
                    <h2 class="sec-title">Events Production — Common Questions</h2>
                </div>
                <div class="accordion accordion-style1" id="epFaq">
                <style>
                    #epFaq .accordion-button{padding-right:60px;font-size:.95rem;color:var(--title-color);text-transform:none;line-height:1.45;}
                    #epFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #epFaq .accordion-body{font-size:.88rem;text-transform:none;line-height:1.6;letter-spacing:normal;}
                    @media (max-width:575px){
                        #epFaq .accordion-button{font-size:.9rem;line-height:1.4;padding-right:44px;}
                        #epFaq .accordion-body{font-size:.84rem;line-height:1.55;}
                    }
                </style>
                    @php
                    $faqs = [
                        ['q'=>"Can you source specialist production equipment that isn't available locally?",'a'=>"Where a specific LED pitch, line array or rigging component isn't held by our local suppliers, we arrange import from Europe. That gets built into the production timeline early, since customs and freight need lead time — it's one of the first questions we ask on a technical call."],
                        ['q'=>'Can you build a stage in a riad courtyard or a desert camp?','a'=>"Yes, and it's a large part of what we do. Riads and desert venues aren't built for rigging, so every load-in starts with a site survey — floor loads, power access, generator placement, sightlines — before a single truss goes up. What works in a convention hall doesn't automatically work in a 400-year-old courtyard."],
                        ['q'=>'How much lead time does a full production build need?','a'=>'A production with custom scenography and imported equipment needs 3 to 4 months for design, sourcing and freight. A branded dinner or a smaller activation using locally available kit can often be turned around in 4 to 6 weeks, though we\'d rather have more time on anything with a custom set build.'],
                        ['q'=>'What happens to an outdoor production if the weather turns?','a'=>"Every outdoor build gets a weather contingency written into the production plan before the event, not improvised on the day — covered rigging options, an indoor or tented fallback venue held on standby, and a call-time deadline for switching plans. Marrakech evenings are usually dry, but we don't stage a launch on \"usually.\""],
                        ['q'=>'Does your technical crew work in English?','a'=>"Yes. Our lighting, sound and stage crews are used to briefs and rehearsals in English and French, and have worked alongside international agencies and directors on past productions — you won't need a translator on the technical walkthrough."],
                    ];
                    @endphp
                    @foreach($faqs as $i => $faq)
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#epFaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}" aria-controls="epFaq{{ $i }}">
                                {{ $faq['q'] }}
                            </button>
                        </h3>
                        <div id="epFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#epFaq">
                            <div class="accordion-body">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.dmc-related')

@include('partials.dmc-products')


{{-- FINAL CTA --}}
<section class="dmc-cta" style="background:#181613;padding:64px 0;">
    <div class="container text-center">
        <h2 style="color:#fff;font-size:2rem;margin-bottom:12px;">Produce Your Next Event With a Local Team</h2>
        <p style="color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 28px;">
            Scenography, lighting, sound and on-site delivery — talk with our events production team today.
        </p>
        <div class="row g-3 justify-content-center">
            <div class="col-12 col-sm-auto">
                <a href="#events-enquiry" class="vs-btn d-block">Request a Proposal</a>
            </div>
            <div class="col-12 col-sm-auto">
                <a href="mailto:sales@morocco-quest.com" class="vs-btn d-block" style="background:transparent;border:2px solid var(--theme-color);color:var(--theme-color);">
                    <i class="fa-solid fa-envelope me-2"></i> sales@morocco-quest.com
                </a>
            </div>
            <div class="col-12 col-sm-auto">
                <a href="tel:+212654069718" class="vs-btn d-block" style="background:transparent;border:2px solid rgba(255,255,255,.4);color:#fff;">
                    <i class="fa-solid fa-phone me-2"></i> +212 654 069 718
                </a>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr('#ep_date', { mode: 'single', dateFormat: 'Y-m-d', minDate: 'today' });
        const alert = document.querySelector('#events-enquiry .alert');
        if (alert) { alert.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
    });
</script>
@endpush

@endsection
