@extends('layouts.app2')

@section('title', $title ?? 'Destination Management Company Morocco | Morocco Quest DMC Partner')
@section('description', $description ?? 'Morocco Quest is a licensed destination management company running ground logistics, venue sourcing and on-site delivery for event agencies, corporates and operators across Morocco. Net-rate pricing, one point of contact, 24-hour proposals.')
@section('keywords', is_array($keywords ?? null) ? implode(', ', $keywords) : ($keywords ?? 'destination management company morocco, morocco dmc partner, DMC services morocco, MICE destination management morocco'))

@push('jsonld')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Destination Management Company Services",
    "name": "Destination Management Company Services — Morocco Quest DMC",
    "description": "Morocco Quest operates as a Destination Management Company in Morocco, providing ground logistics, venue and accommodation sourcing, activity programming and on-site management for event agencies, corporations and travel operators.",
    "provider": {
        "@id": "{{ url('/') }}#organization"
    },
    "areaServed": [
        { "@type": "City", "name": "Marrakech" },
        { "@type": "City", "name": "Casablanca" },
        { "@type": "City", "name": "Rabat" },
        { "@type": "Country", "name": "Morocco" }
    ],
    "url": "{{ url('/destination-management-company') }}"
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "DMC", "item": "{{ url('/dmc-marrakech') }}" },
        { "@type": "ListItem", "position": 3, "name": "Destination Management Company", "item": "{{ url('/destination-management-company') }}" }
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
            "name": "How does DMC pricing and net rates actually work?",
            "acceptedAnswer": { "@type": "Answer", "text": "A DMC contracts hotels, venues and suppliers at net rates — pricing below what those suppliers would quote a walk-in client — then adds a management fee for sourcing, contracting and on-site delivery. A transparent DMC will show that fee separately rather than folding it invisibly into a single bundled number." }
        },
        {
            "@type": "Question",
            "name": "What licensing should I check before signing with a DMC in Morocco?",
            "acceptedAnswer": { "@type": "Answer", "text": "Ask for the company's Moroccan tourism operator licence number and confirm it is current, and ask for proof of liability insurance that covers your specific group size and activities. A legitimate DMC will produce both without hesitation." }
        },
        {
            "@type": "Question",
            "name": "Can a DMC work white-label for an event agency?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. Most of our agency partners keep the client relationship entirely in-house — we operate behind their brand, on their paper where needed, and our team on the ground is never presented to the delegate as anything other than the agency's local crew." }
        },
        {
            "@type": "Question",
            "name": "How do we start a trial engagement with Morocco Quest as our DMC?",
            "acceptedAnswer": { "@type": "Answer", "text": "Most partnerships start with one programme, not a long-term contract — a single incentive trip, a congress, or ground support for one group. We treat that first programme as the reference point both sides use to decide whether to continue." }
        }
    ]
}
</script>
@endpush

@push('scripts')
<script>window.__pageContext = { page_type: 'destination_management_company' };</script>
@endpush

@section('body_class', 'dmc-page')

@section('content')

@include('partials.dmc-spacing')

{{-- HERO --}}
<section class="vs-breadcrumb hero-overlay" data-bg-src="{{ asset('assets/img/morocco-quest-bedouin-dinner-table-setting-desert-event.webp') }}">
    <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="" class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
    <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="" class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">Destination Management Company Morocco: One Accountable Partner Instead of Six Vendors</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        Licensed ground logistics, venue sourcing and on-site delivery across Morocco — how Morocco Quest runs the destination layer, and what to check before you sign.
                    </p>
                </div>
                <div class="breadcrumb-menu">
                    <ul class="custom-ul">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('dmc.marrakech') }}">DMC</a></li>
                        <li>Destination Management Company</li>
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
                <p style="font-size:1.1rem;color:#444;">You already know what a DMC should deliver. The question is whether the one you pick in Morocco can actually back it up — licensed contracts, a local team that answers at 11pm, rates that hold up against a direct hotel quote.</p>
                <p style="font-size:1.05rem;color:#555;">Morocco Quest contracts and manages the ground layer — transport, venues, accommodation, activities, on-site delivery — under one agreement, so your team keeps ownership of the client relationship and we keep ownership of everything that happens once the group lands. Below is how we actually run that, not a generic description of the model.</p>
                <a href="#dmccompany-enquiry" class="vs-btn mt-3">Discuss Your Programme</a>
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
                    <img src="{{ asset('assets/img/morocco-quest-camel-caravan-desert-team-building-marrakech.webp') }}"
                         alt="Camel caravan crossing the desert on a Morocco Quest team-building transfer near Marrakech"
                         title="Camel caravan transfer — Morocco Quest ground logistics near Marrakech"
                         class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
                    <figcaption style="font-size:.85rem;color:#777;margin-top:10px;">Desert transfer leg of a Marrakech incentive programme, run on Morocco Quest's own vetted fleet and camel-handler network.</figcaption>
                </figure>
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Ground Logistics & Transport</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Getting People and Equipment Where They Need to Be, on Time</h2>
                <p>Airport arrivals staggered across a dozen flights, inter-city transfers between Marrakech and Casablanca, a fleet sized correctly for a group that splits into three activity tracks on day two — this is the layer that fails silently when it's wrong and nobody notices when it's right. We run our own vetted fleet and driver-guides rather than subcontracting transport blind to whoever answers the phone first.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6 order-lg-2">
                <figure class="mb-0">
                    <img src="{{ asset('assets/img/morocco-quest-marrakech-medina-souk-incentive-program.webp') }}"
                         alt="Marrakech medina street used for Morocco Quest venue and accommodation sourcing"
                         title="Marrakech medina — Morocco Quest venue and riad sourcing"
                         class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
                    <figcaption style="font-size:.85rem;color:#777;margin-top:10px;">Riads and boutique venues inside the Marrakech medina, contracted at net rate through standing Morocco Quest agreements.</figcaption>
                </figure>
            </div>
            <div class="col-lg-6 order-lg-1">
                <span class="sec-subtitle style-2">Venue & Accommodation Sourcing</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Rate Access You Won't Get Calling a Hotel Directly</h2>
                <p>We hold standing contracts with hotel groups and independent venues across Marrakech, Casablanca and Fes, which means a room block or a ballroom gets sourced at net rate rather than the number a hotel's reservations desk quotes a first-time caller. Negotiation on cancellation terms, room upgrades and rooming-list flexibility happens because the relationship already exists.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <figure class="mb-0">
                    <img src="{{ asset('assets/img/morocco-quest-team-hands-together-corporate-incentive.webp') }}"
                         alt="Corporate group joining hands during a Morocco Quest incentive activity programme"
                         title="Team activity programming — Morocco Quest corporate incentives in Morocco"
                         class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
                    <figcaption style="font-size:.85rem;color:#777;margin-top:10px;">Activity programming built around the group profile — from 20-person executive incentives to 300-delegate congress breakouts.</figcaption>
                </figure>
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Activity & Experience Programming</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Activities Matched to the Group, Not a Standard Package</h2>
                <p>A 20-person executive incentive and a 300-delegate congress with two free hours between sessions need entirely different activity design — one wants a private riad dinner with a specific wine list, the other needs three parallel excursion options that all return to the venue within a 15-minute window of each other. We build the programme around your group profile first, then match it to what Morocco actually offers.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4">
            <div class="col-lg-9 mx-auto text-center">
                <span class="sec-subtitle style-2">On-Site Management & Crisis Response</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Someone Physically Present When the Plan Changes</h2>
                <p>Flights get delayed, a venue loses power, a delegate needs a hospital at 11pm — none of that is hypothetical over a multi-day programme. Our team stays on-site for the duration, with a single phone number that reaches someone who can actually act, not a call centre reading a script back to you from another time zone.</p>
                <figure class="mb-0 mt-4">
                    <img src="{{ asset('assets/img/morocco-quest-congress-registration-desk-delegates.webp') }}"
                         alt="Morocco Quest staff managing the congress registration desk on-site for arriving delegates"
                         title="On-site registration desk — Morocco Quest congress management in Morocco"
                         class="w-100" style="border-radius:12px;object-fit:cover;max-height:400px;" loading="lazy" />
                    <figcaption style="font-size:.85rem;color:#777;margin-top:10px;">Morocco Quest staff on the registration desk — the same on-site team that handles schedule changes and incidents for the duration of the programme.</figcaption>
                </figure>
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
                <h2 class="sec-title">Complete Destination Management Solutions</h2>
                <p>Every component of a Morocco ground programme, handled under one agreement.</p>
            </div>
        </div>
        <div class="tb-tags mt-4">
            @php
            $solutions = [
                ['icon'=>'fa-car-side', 'label'=>'Transport & Transfers', 'rot'=>-3],
                ['icon'=>'fa-hotel', 'label'=>'Hotel & Venue Sourcing', 'rot'=>2],
                ['icon'=>'fa-mountain-sun', 'label'=>'Activity Programming', 'rot'=>-2],
                ['icon'=>'fa-headset', 'label'=>'On-Site Management', 'rot'=>3],
                ['icon'=>'fa-file-contract', 'label'=>'Licensing & Insurance', 'rot'=>-4],
                ['icon'=>'fa-users', 'label'=>'Group Coordination', 'rot'=>1],
                ['icon'=>'fa-utensils', 'label'=>'Catering & Dining', 'rot'=>-1],
                ['icon'=>'fa-triangle-exclamation', 'label'=>'24/7 Crisis Response', 'rot'=>4],
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


{{-- SIGNATURE MODULE: HOW TO EVALUATE A DMC PARTNER --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="sec-subtitle">Choosing a Partner</span>
                <h2 class="sec-title">How to Evaluate a DMC Before You Sign</h2>
                <p>Anyone can put "DMC" on a homepage. These are the six things worth actually checking.</p>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $criteria = [
                ['title'=>'Licensing & Insurance', 'body'=>'Ask for the tourism operator licence number and confirm it\'s current with the Moroccan authorities. Ask for proof of liability insurance that names your group size and activities specifically, not a generic policy summary.'],
                ['title'=>'Transparent Net Pricing', 'body'=>'Request a cost breakdown by service line — transport, venue, accommodation, activities — rather than one bundled total. A DMC that resists itemising its pricing is usually padding the mark-up somewhere in the middle.'],
                ['title'=>'Local Team Size & Presence', 'body'=>'Ask directly how many people will be physically on-site during your programme, not how many the company employs in total. A 200-delegate congress covered by two staff is a company that hasn\'t planned for anything going wrong at once.'],
                ['title'=>'References & Track Record', 'body'=>'Ask for a reference from a programme similar in size and complexity to yours, and actually call them. A polished case study on a website tells you nothing about how the company handles a supplier cancelling three days out.'],
                ['title'=>'Response Times', 'body'=>'Time how long the proposal stage takes — a first reply within a day, a full costed proposal within a week. How a DMC responds while trying to win your business is a reasonable proxy for how it responds once it already has it.'],
                ['title'=>'Supplier Network Depth', 'body'=>'Ask what the fallback option is if your first-choice venue or hotel falls through. A DMC with direct, contracted relationships across multiple properties can pivot in hours; one relying on a single supplier contact cannot.'],
            ];
            @endphp
            @foreach($criteria as $c)
            <div class="col-sm-6 col-lg-4">
                <div class="p-4" style="background:var(--theme-color);border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;color:#fff;">{{ $c['title'] }}</div>
                    <div style="font-size:.88rem;color:rgba(255,255,255,.9);">{{ $c['body'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- WHY MOROCCO --}}
<section class="space">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6 order-lg-2">
                <span class="sec-subtitle style-2">Why Morocco</span>
                <h2 class="sec-title">A Gateway Position That Actually Shows Up in the Logistics</h2>
                <p>Morocco sits within a four-hour flight of most European capitals, on the same working clock as Western Europe, with growing air access from the Gulf and North America through Casablanca. For an agency or corporation weighing where to run a first international programme, that geography is the difference between a supplier answering your call during your own working hours and a nine-hour lag on every decision.</p>
                <p>The country's MICE infrastructure has caught up with that positioning — purpose-built convention space in Marrakech and Casablanca, a hotel base that's expanded steadily through the four- and five-star tiers, and a supplier ecosystem in AV, transport and catering that no longer requires importing crews from Europe for anything short of the largest builds.</p>
            </div>
            <div class="col-lg-6 order-lg-1">
                <img src="{{ asset('assets/img/morocco-quest-marrakech-souk-carpet-shop-dmc.webp') }}"
                     alt="Carpet shop in the Marrakech souk where Morocco Quest sources artisan suppliers"
                     title="Marrakech souk carpet shop — Morocco Quest supplier network"
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
<section class="space bg-theme-07" id="dmccompany-enquiry">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">Talk to Us</span>
                    <h2 class="sec-title">Discuss a Destination Management Partnership</h2>
                    <p>Tell us about your programme — we respond within 24 hours with next steps and, where relevant, an indicative costing.</p>
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
                    <input type="hidden" name="enquiry_type" value="DMC Partnership Inquiry">
                    <input type="hidden" name="page_source" value="destination-management-company">
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label for="dmccompany_name" style="font-weight:600;margin-bottom:4px;display:block;">Full Name *</label>
                            <input id="dmccompany_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your full name" value="{{ old('name') }}" required autocomplete="name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmccompany_company" style="font-weight:600;margin-bottom:4px;display:block;">Company / Organization *</label>
                            <input id="dmccompany_company" name="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" placeholder="Your company or organization" value="{{ old('nationality') }}" required />
                            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmccompany_email" style="font-weight:600;margin-bottom:4px;display:block;">Business Email *</label>
                            <input id="dmccompany_email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@company.com" value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmccompany_phone" style="font-weight:600;margin-bottom:4px;display:block;">Phone / WhatsApp *</label>
                            <input id="dmccompany_phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="+1 / +44 / +33..." value="{{ old('phone') }}" required autocomplete="tel" />
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmccompany_date" style="font-weight:600;margin-bottom:4px;display:block;">Programme Dates *</label>
                            <input id="dmccompany_date" name="arrival_date" type="text" class="form-control @error('arrival_date') is-invalid @enderror" placeholder="Select programme date" value="{{ old('arrival_date') }}" required readonly />
                            @error('arrival_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmccompany_pax" style="font-weight:600;margin-bottom:4px;display:block;">Group Size (Pax)</label>
                            <input id="dmccompany_pax" name="adults" type="number" min="1" class="form-control @error('adults') is-invalid @enderror" placeholder="Number of participants" value="{{ old('adults') }}" />
                            @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmccompany_duration" style="font-weight:600;margin-bottom:4px;display:block;">Programme Duration (Days) *</label>
                            <input id="dmccompany_duration" name="duration_days" type="number" min="1" class="form-control @error('duration_days') is-invalid @enderror" placeholder="Number of days" value="{{ old('duration_days') }}" required />
                            @error('duration_days')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label style="font-weight:600;margin-bottom:4px;display:block;">Type of Enquiry</label>
                            <select name="children" class="form-control" style="height:56px;">
                                <option value="0" {{ old('children') == '0' ? 'selected' : '' }}>General DMC Partnership</option>
                                <option value="1" {{ old('children') == '1' ? 'selected' : '' }}>Incentive / MICE Programme</option>
                                <option value="2" {{ old('children') == '2' ? 'selected' : '' }}>Congress / Association Event</option>
                                <option value="3" {{ old('children') == '3' ? 'selected' : '' }}>Ground Support for Existing Tour</option>
                                <option value="4" {{ old('children') == '4' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label for="dmccompany_brief" style="font-weight:600;margin-bottom:4px;display:block;">Brief Description *</label>
                            <textarea id="dmccompany_brief" name="travel_ideas" class="form-control @error('travel_ideas') is-invalid @enderror" placeholder="Describe your programme: destinations, group profile, services needed, budget range..." rows="5" required>{{ old('travel_ideas') }}</textarea>
                            @error('travel_ideas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <div style="background:#f8f8f8;border-radius:8px;padding:14px 18px;font-size:.88rem;color:#555;margin-bottom:8px;">
                                <i class="fa-solid fa-lock me-2" style="color:var(--theme-color);"></i>
                                Your enquiry is 100% confidential and reviewed by our DMC team directly.
                            </div>
                        </div>
                        @include('partials.recaptcha')
                        <div class="col-12 form-group mb-0">
                            <button class="vs-btn w-100 w-sm-auto" type="submit">
                                <i class="fa-solid fa-paper-plane me-2"></i> Send Enquiry
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
                    <h2 class="sec-title">Destination Management — Common Questions</h2>
                </div>
                <div class="accordion accordion-style1" id="dmcCoFaq">
                <style>
                    #dmcCoFaq .accordion-button{padding-right:60px;font-size:.95rem;color:var(--title-color);text-transform:none;line-height:1.45;}
                    #dmcCoFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #dmcCoFaq .accordion-body{font-size:.88rem;text-transform:none;line-height:1.6;letter-spacing:normal;}
                    @media (max-width:575px){
                        #dmcCoFaq .accordion-button{font-size:.9rem;line-height:1.4;padding-right:44px;}
                        #dmcCoFaq .accordion-body{font-size:.84rem;line-height:1.55;}
                    }
                </style>
                    @php
                    $faqs = [
                        ['q'=>'How does DMC pricing and net rates actually work?','a'=>'A DMC contracts hotels, venues and suppliers at net rates — pricing below what those suppliers would quote a walk-in client — then adds a management fee for sourcing, contracting and on-site delivery. A transparent DMC will show that fee separately rather than folding it invisibly into a single bundled number.'],
                        ['q'=>'What licensing should I check before signing with a DMC in Morocco?','a'=>'Ask for the company\'s Moroccan tourism operator licence number and confirm it is current, and ask for proof of liability insurance that covers your specific group size and activities. A legitimate DMC will produce both without hesitation.'],
                        ['q'=>'Can a DMC work white-label for an event agency?','a'=>'Yes. Most of our agency partners keep the client relationship entirely in-house — we operate behind their brand, on their paper where needed, and our team on the ground is never presented to the delegate as anything other than the agency\'s local crew.'],
                        ['q'=>'How do we start a trial engagement with Morocco Quest as our DMC?','a'=>'Most partnerships start with one programme, not a long-term contract — a single incentive trip, a congress, or ground support for one group. We treat that first programme as the reference point both sides use to decide whether to continue.'],
                    ];
                    @endphp
                    @foreach($faqs as $i => $faq)
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#dmcCoFaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}" aria-controls="dmcCoFaq{{ $i }}">
                                {{ $faq['q'] }}
                            </button>
                        </h3>
                        <div id="dmcCoFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#dmcCoFaq">
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
        <h2 style="color:#fff;font-size:2rem;margin-bottom:12px;">Considering a DMC for Your Morocco Programme?</h2>
        <p style="color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 28px;">
            Tell us your objectives and group profile — we'll walk you through what a DMC partnership with Morocco Quest would look like.
        </p>
        <div class="row g-3 justify-content-center">
            <div class="col-12 col-sm-auto">
                <a href="#dmccompany-enquiry" class="vs-btn d-block">Discuss Your Programme</a>
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
        flatpickr('#dmccompany_date', { mode: 'single', dateFormat: 'Y-m-d', minDate: 'today' });
        const alert = document.querySelector('#dmccompany-enquiry .alert');
        if (alert) { alert.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
    });
</script>
@endpush

@endsection
