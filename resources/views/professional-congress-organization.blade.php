@extends('layouts.app2')

@section('title', $title ?? 'Professional Congress Organizer Morocco | PCO Marrakech | Morocco Quest DMC')
@section('description', $description ?? 'Morocco Quest is a Marrakech-based PCO running abstract management, registration, sponsor and exhibitor programmes for medical and scientific congresses across Morocco — bid support through post-congress reporting.')
@section('keywords', is_array($keywords ?? null) ? implode(', ', $keywords) : ($keywords ?? 'professional congress organizer morocco, PCO morocco, congress organization marrakech'))

@push('jsonld')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Professional Congress Organization",
    "name": "Professional Congress Organization — Morocco Quest DMC",
    "description": "Morocco Quest acts as Professional Congress Organizer (PCO) for medical, scientific and academic associations running congresses in Marrakech and across Morocco, from bid support to post-congress reporting.",
    "provider": {
        "@id": "{{ url('/') }}#organization"
    },
    "areaServed": [
        { "@type": "City", "name": "Marrakech" },
        { "@type": "City", "name": "Casablanca" },
        { "@type": "City", "name": "Rabat" },
        { "@type": "Country", "name": "Morocco" }
    ],
    "url": "{{ url('/professional-congress-organization') }}"
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "DMC", "item": "{{ url('/dmc-marrakech') }}" },
        { "@type": "ListItem", "position": 3, "name": "Professional Congress Organization", "item": "{{ url('/professional-congress-organization') }}" }
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
            "name": "Do you provide the abstract submission platform, or do we need our own?",
            "acceptedAnswer": { "@type": "Answer", "text": "We provide and configure the platform — submission categories, reviewer accounts, scoring rubric and the notification workflow — and connect it to your scientific committee's process. If your society already licenses a platform, we can work inside it instead." }
        },
        {
            "@type": "Question",
            "name": "Can you support CME or CPD accreditation for the scientific programme?",
            "acceptedAnswer": { "@type": "Answer", "text": "We compile the documentation an accrediting body asks for — final programme, faculty disclosures, learning objectives, session timings — and manage the submission calendar so it aligns with your accreditor's deadlines. The accreditation decision itself sits with the awarding body, not with us." }
        },
        {
            "@type": "Question",
            "name": "Our organising committee changes every congress. How do you keep continuity?",
            "acceptedAnswer": { "@type": "Answer", "text": "We hold the operational memory the committee doesn't: registration data, sponsor contacts, room-block history, vendor pricing and what went wrong last time. When a new committee takes over, they inherit a working file instead of starting from a blank page." }
        },
        {
            "@type": "Question",
            "name": "Can you help us bid for a future congress before the destination is confirmed?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. We prepare venue capacity letters, indicative budgets and a destination presentation your board or general assembly can use to vote on Marrakech as a future congress host, typically two to three years ahead of the proposed edition." }
        }
    ]
}
</script>
@endpush

@push('scripts')
<script>window.__pageContext = { page_type: 'professional_congress_organization' };</script>
@endpush

@section('body_class', 'dmc-page')

@section('content')

@include('partials.dmc-spacing')

{{-- HERO --}}
<section class="vs-breadcrumb hero-overlay" data-bg-src="{{ asset('assets/img/morocco-quest-palais-des-congres-marrakech-pco-hero.webp') }}">
    <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="" class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
    <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="" class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">Professional Congress Organizer Morocco: A Marrakech PCO Your Committee Doesn't Have to Rebuild Every Edition</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        Abstract platforms, sponsor contracts, badge systems, on-site delivery — run by a Marrakech-based PCO team that carries the operational history from one edition into the next.
                    </p>
                </div>
                <div class="breadcrumb-menu">
                    <ul class="custom-ul">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('dmc.marrakech') }}">Morocco DMC</a></li>
                        <li>Professional Congress Organization</li>
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
                <p style="font-size:1.1rem;color:#444;">A congress doesn't reset between editions the way a one-off meeting does. Abstract deadlines, sponsor renewals, accreditation paperwork and a scientific committee that turns over its chair every term — all of it has to carry forward, usually held together by whoever happened to be secretary-general last time.</p>
                <p style="font-size:1.05rem;color:#555;">Morocco Quest is a Marrakech-based PCO for medical societies, scientific associations and academic federations bringing their congress to Morocco. We run the abstract platform, registration and badging, and sponsor/exhibitor contracts under one agreement, and we hold the operational thread across editions — registration data, sponsor history, vendor pricing — so each new committee inherits a working file, not a blank page.</p>
                <a href="#congress-enquiry" class="vs-btn mt-3">Talk With Our PCO Team</a>
            </div>
        </div>
    </div>
</section>

{{-- ALTERNATING SERVICE STACK --}}
<section class="space">
    <div class="container">

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/morocco-quest-garden-catering-beverage-station-corporate-event.webp') }}"
                     alt="Garden catering and beverage station staffed by Morocco Quest at a corporate congress in Morocco"
                     title="Garden catering station at a Morocco Quest corporate event"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Abstract & Scientific Programme</span>
                <h2 class="sec-title" style="font-size:1.6rem;">The Review Workflow Runs Without Chasing Reviewers by Email</h2>
                <p>We configure the submission platform around your categories and scoring rubric, set reviewer accounts for your scientific committee, and track the review workflow through to acceptance notifications. When the programme is locked, we compile the abstract book and the documentation your accreditor needs for CME or CPD credit — timed against their submission calendar, not built the week before.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-9 mx-auto text-center">
                <span class="sec-subtitle style-2">Registration & Badge Systems</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Delegate Categories That Actually Match Your Membership Structure</h2>
                <p>Member, non-member, student, industry, press — the registration platform is built around the categories your association already uses, not a generic form. Badges carry access control by session and exhibition zone, printed and issued at a check-in desk that can handle a queue of 300 delegates on a Monday morning without becoming the story of day one.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <figure class="mb-0">
                    <img src="{{ asset('assets/img/morocco-quest-sponsor-exhibitor-booth-congress-morocco.webp') }}"
                         alt="Sponsor and exhibitor booths on the congress floor managed by Morocco Quest in Morocco"
                         title="Sponsor and exhibitor booths — Morocco Quest PCO congress management"
                         class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
                    <figcaption class="visually-hidden">Exhibition floor with booth space allocated against signed sponsor tiers, with fulfilment tracked through to on-site delivery.</figcaption>
                </figure>
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Sponsor & Exhibitor Management</span>
                <h2 class="sec-title" style="font-size:1.6rem;">A Prospectus That Sells, and Fulfilment That Doesn't Get Forgotten</h2>
                <p>We build the sponsorship and exhibitor prospectus around tiers your industry partners recognise, track sales against the revenue target the congress budget depends on, and allocate booth space before floor plans get contentious. After the contract is signed, we track fulfilment — branding placements, session credits, badge allocations — so nothing owed to a sponsor gets discovered missing on-site.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4">
            <div class="col-lg-9 mx-auto text-center">
                <span class="sec-subtitle style-2">On-Site Congress Delivery</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Someone Who Knows Which Session Room Has the Broken Mic</h2>
                <p>Across a three- or four-day congress with parallel tracks, a poster hall and a shifting speaker schedule, something moves every day — a session overruns, a speaker's flight is delayed, a shipment of poster boards arrives short. Our team is on-site for the full run, solving it in the corridor rather than in an email thread your scientific committee chair has to manage between sessions.</p>
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
                <h2 class="sec-title">Complete Congress Organization Solutions</h2>
                <p>Every component of a scientific or association congress, handled under one agreement — from the first abstract to the post-congress report.</p>
            </div>
        </div>
        <div class="tb-tags mt-4">
            @php
            $solutions = [
                ['icon'=>'fa-file-lines', 'label'=>'Abstract Management', 'rot'=>-3],
                ['icon'=>'fa-id-badge', 'label'=>'Registration & Badging', 'rot'=>2],
                ['icon'=>'fa-handshake', 'label'=>'Sponsor & Exhibitor Sales', 'rot'=>-2],
                ['icon'=>'fa-building-columns', 'label'=>'Venue & Accreditation Support', 'rot'=>3],
                ['icon'=>'fa-microphone-lines', 'label'=>'AV & Session Production', 'rot'=>-4],
                ['icon'=>'fa-bed', 'label'=>'Delegate Accommodation', 'rot'=>1],
                ['icon'=>'fa-chart-line', 'label'=>'Post-Congress Reporting', 'rot'=>-1],
                ['icon'=>'fa-headset', 'label'=>'On-Site Delivery Team', 'rot'=>4],
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


{{-- SIGNATURE MODULE: CONGRESS LIFECYCLE TIMELINE --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="sec-subtitle">The Multi-Year Arc</span>
                <h2 class="sec-title">A Congress Runs on a Longer Clock Than a Meeting</h2>
                <p>Unlike a single corporate meeting, a congress is planned in stages against fixed academic and commercial deadlines. Here's the arc we plan around.</p>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $timeline = [
                ['stage'=>'Bid & Venue Selection', 'marker'=>'18-24 Months Out', 'body'=>'Destination bid documents, venue capacity letters and budget modelling for the board or general assembly vote.'],
                ['stage'=>'Registration Platform Launch', 'marker'=>'12 Months Out', 'body'=>'Online registration opens with early-bird pricing tiers and delegate category structure locked in.'],
                ['stage'=>'Abstract Submission Window', 'marker'=>'9 Months Out', 'body'=>'Submission platform opens, peer review runs against your scientific committee\'s timeline and rubric.'],
                ['stage'=>'Sponsor & Exhibitor Sales', 'marker'=>'6 Months Out', 'body'=>'Prospectus in market, booth allocation begins, fulfilment obligations tracked against signed contracts.'],
                ['stage'=>'Final Programme & Badging', 'marker'=>'2 Months Out', 'body'=>'Abstract book compiled, accreditation documentation submitted, badges and access control finalised.'],
                ['stage'=>'On-Site Delivery', 'marker'=>'Congress Week', 'body'=>'Registration desk, session-room management and real-time problem-solving across every congress day.'],
                ['stage'=>'Post-Congress Reporting', 'marker'=>'4-6 Weeks After', 'body'=>'Financial reconciliation, sponsor fulfilment report and a knowledge handover file for the next edition.'],
                ['stage'=>'Next Edition Planning', 'marker'=>'3 Months After', 'body'=>'Lessons-learned review, delegate survey analysis and an early destination shortlist for the following congress.'],
            ];
            @endphp
            @foreach($timeline as $i => $t)
            <div class="col-sm-6 col-lg-3">
                <div class="p-4" style="background:var(--theme-color);border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-size:.78rem;font-weight:700;color:rgba(255,255,255,.8);text-transform:uppercase;letter-spacing:.03em;margin-bottom:8px;">{{ $t['marker'] }}</div>
                    <div style="font-weight:700;margin-bottom:8px;color:#fff;">{{ $t['stage'] }}</div>
                    <div style="font-size:.88rem;color:rgba(255,255,255,.9);">{{ $t['body'] }}</div>
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
                <h2 class="sec-title">A Congress Destination Your Board Can Justify With Numbers</h2>
                <p>Marrakech and Casablanca now connect directly to most major European hubs, several Middle Eastern gateways, and a growing number of African capitals — which widens the pool of delegates who can reach the congress without a connecting flight. Morocco's convention centres are increasingly hosting international medical and scientific meetings that a decade ago would have defaulted to Southern Europe.</p>
                <p>Venue, accommodation and catering costs sit meaningfully below Western congress cities, a difference that shows up directly in a finance committee's comparison of bid options — and stretches sponsor budgets further on exhibition space and delegate hospitality.</p>
            </div>
            <div class="col-lg-6 order-lg-1">
                <img src="{{ asset('assets/img/morocco-quest-marrakech-congress-destination.webp') }}"
                     alt="Marrakech, a congress destination in Morocco for international delegates"
                     title="Marrakech congress destination"
                     width="1100" height="825"
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
<section class="space bg-theme-07" id="congress-enquiry">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">Get a Proposal</span>
                    <h2 class="sec-title">Talk With Our Congress Organization Team</h2>
                    <p>Tell us your expected delegate count, congress stage and dates — we respond within 24 hours with a costed proposal.</p>
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
                    <input type="hidden" name="enquiry_type" value="Congress Organization">
                    <input type="hidden" name="page_source" value="professional-congress-organization">
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label for="pco_name" style="font-weight:600;margin-bottom:4px;display:block;">Full Name *</label>
                            <input id="pco_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your full name" value="{{ old('name') }}" required autocomplete="name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="pco_org" style="font-weight:600;margin-bottom:4px;display:block;">Association / Organization *</label>
                            <input id="pco_org" name="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" placeholder="Your association or organization" value="{{ old('nationality') }}" required />
                            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="pco_email" style="font-weight:600;margin-bottom:4px;display:block;">Business Email *</label>
                            <input id="pco_email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@association.org" value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="pco_phone" style="font-weight:600;margin-bottom:4px;display:block;">Phone / WhatsApp *</label>
                            <input id="pco_phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="+1 / +44 / +33..." value="{{ old('phone') }}" required autocomplete="tel" />
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="pco_date" style="font-weight:600;margin-bottom:4px;display:block;">Preferred Congress Dates *</label>
                            <input id="pco_date" name="arrival_date" type="text" class="form-control @error('arrival_date') is-invalid @enderror" placeholder="Select congress date" value="{{ old('arrival_date') }}" required readonly />
                            @error('arrival_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="pco_pax" style="font-weight:600;margin-bottom:4px;display:block;">Expected Delegate Count *</label>
                            <input id="pco_pax" name="adults" type="number" min="1" class="form-control @error('adults') is-invalid @enderror" placeholder="Number of delegates" value="{{ old('adults') }}" required />
                            @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="pco_duration" style="font-weight:600;margin-bottom:4px;display:block;">Congress Duration (Days) *</label>
                            <input id="pco_duration" name="duration_days" type="number" min="1" class="form-control @error('duration_days') is-invalid @enderror" placeholder="Number of days" value="{{ old('duration_days') }}" required />
                            @error('duration_days')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label style="font-weight:600;margin-bottom:4px;display:block;">Congress Stage</label>
                            <select name="children" class="form-control" style="height:56px;">
                                <option value="0" {{ old('children') == '0' ? 'selected' : '' }}>Bid Stage</option>
                                <option value="1" {{ old('children') == '1' ? 'selected' : '' }}>Planning Stage</option>
                                <option value="2" {{ old('children') == '2' ? 'selected' : '' }}>Ready to Contract</option>
                                <option value="3" {{ old('children') == '3' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label for="pco_brief" style="font-weight:600;margin-bottom:4px;display:block;">Congress Brief *</label>
                            <textarea id="pco_brief" name="travel_ideas" class="form-control @error('travel_ideas') is-invalid @enderror" placeholder="Describe your congress: expected abstract volume, number of tracks, exhibitor needs, accreditation requirements, budget range..." rows="5" required>{{ old('travel_ideas') }}</textarea>
                            @error('travel_ideas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <div style="background:#f8f8f8;border-radius:8px;padding:14px 18px;font-size:.88rem;color:#555;margin-bottom:8px;">
                                <i class="fa-solid fa-lock me-2" style="color:var(--theme-color);"></i>
                                Your enquiry is 100% confidential and reviewed by our congress organization team directly.
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
                    <h2 class="sec-title">Professional Congress Organization — Common Questions</h2>
                </div>
                <div class="accordion accordion-style1" id="pcoFaq">
                <style>
                    #pcoFaq .accordion-button{padding-right:60px;font-size:.95rem;color:var(--title-color);text-transform:none;line-height:1.45;}
                    #pcoFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #pcoFaq .accordion-body{font-size:.88rem;text-transform:none;line-height:1.6;letter-spacing:normal;}
                    @media (max-width:575px){
                        #pcoFaq .accordion-button{font-size:.9rem;line-height:1.4;padding-right:44px;}
                        #pcoFaq .accordion-body{font-size:.84rem;line-height:1.55;}
                    }
                </style>
                    @php
                    $faqs = [
                        ['q'=>'Do you provide the abstract submission platform, or do we need our own?','a'=>'We provide and configure the platform — submission categories, reviewer accounts, scoring rubric and the notification workflow — and connect it to your scientific committee\'s process. If your society already licenses a platform, we can work inside it instead.'],
                        ['q'=>'Can you support CME or CPD accreditation for the scientific programme?','a'=>'We compile the documentation an accrediting body asks for — final programme, faculty disclosures, learning objectives, session timings — and manage the submission calendar so it aligns with your accreditor\'s deadlines. The accreditation decision itself sits with the awarding body, not with us.'],
                        ['q'=>'Our organising committee changes every congress. How do you keep continuity?','a'=>'We hold the operational memory the committee doesn\'t: registration data, sponsor contacts, room-block history, vendor pricing and what went wrong last time. When a new committee takes over, they inherit a working file instead of starting from a blank page.'],
                        ['q'=>'Can you help us bid for a future congress before the destination is confirmed?','a'=>'Yes. We prepare venue capacity letters, indicative budgets and a destination presentation your board or general assembly can use to vote on Marrakech as a future congress host, typically two to three years ahead of the proposed edition.'],
                    ];
                    @endphp
                    @foreach($faqs as $i => $faq)
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#pcoFaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}" aria-controls="pcoFaq{{ $i }}">
                                {{ $faq['q'] }}
                            </button>
                        </h3>
                        <div id="pcoFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#pcoFaq">
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
        <h2 style="color:#fff;font-size:2rem;margin-bottom:12px;">Plan Your Congress in Morocco With a Local PCO Team</h2>
        <p style="color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 28px;">
            Abstract management, sponsor logistics and on-site delivery — talk with our congress organization team today.
        </p>
        <div class="row g-3 justify-content-center">
            <div class="col-12 col-sm-auto">
                <a href="#congress-enquiry" class="vs-btn d-block">Request a Proposal</a>
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
        flatpickr('#pco_date', { mode: 'single', dateFormat: 'Y-m-d', minDate: 'today' });
        const alert = document.querySelector('#congress-enquiry .alert');
        if (alert) { alert.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
    });
</script>
@endpush

@endsection
