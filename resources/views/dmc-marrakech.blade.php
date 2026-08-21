@extends('layouts.app2')

{{-- Title/description are set live by DmcController::index() via SEOMeta — layouts.app2 renders
     SEOMeta::generate(), not these @section values. Kept only as a fallback for $title/$description. --}}
@section('title', $title ?? 'DMC Marrakech | Destination Management Company Morocco | Morocco Quest')
@section('description', $description ?? 'Morocco Quest — trusted DMC in Marrakech for travel agents, tour operators & MICE groups: private tours, desert camps, transfers & event logistics.')
@section('keywords', is_array($keywords ?? null) ? implode(', ', $keywords) : ($keywords ?? 'dmc marrakech, morocco ground handler, morocco dmc partner, b2b tour operator morocco, mice marrakech, net rate morocco tours'))

@push('jsonld')
{{-- Organization/TravelAgency identity is emitted once, globally, by layouts/app2.blade.php (@id: {{ url('/') }}#organization) --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home",          "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "DMC Marrakech", "item": "{{ url('/dmc-marrakech') }}" }
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
            "name": "Does Morocco Quest work with travel agents and tour operators?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. Morocco Quest operates a dedicated B2B desk. We work with travel agents, online tour operators, incentive houses and MICE planners on a net-rate basis. Contact us at sales@morocco-quest.com for a trade account and rate card."
            }
        },
        {
            "@type": "Question",
            "name": "What ground services does Morocco Quest DMC provide?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Our DMC services include: tailor-made private tours, airport & city transfers, licensed English/French/Spanish guides, desert camp bookings in Merzouga, hotel sourcing & contracting, team-building & incentive programmes, MICE event logistics, group coordination and 24/7 local support."
            }
        },
        {
            "@type": "Question",
            "name": "Which destinations in Morocco does Morocco Quest cover?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "We cover the entire country: Marrakech, Fes, Casablanca, Rabat, Chefchaouen, Tangier, Agadir, Ouarzazate, Merzouga (Sahara Desert), Dades & Draa Valleys, the Atlas Mountains and all coastal cities."
            }
        },
        {
            "@type": "Question",
            "name": "How do I request a B2B quote from Morocco Quest DMC?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Use the B2B enquiry form on this page or email sales@morocco-quest.com directly. Include your group size, travel dates, destinations and service requirements. We respond within 24 hours with a detailed net-rate proposal."
            }
        },
        {
            "@type": "Question",
            "name": "Do you handle MICE and incentive travel programmes in Morocco?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. We run MICE Morocco programmes end-to-end: gala dinners in traditional riads, team-building in the Atlas Mountains, exclusive Sahara camps for incentive groups, themed entertainment and full event production."
            }
        }
    ]
}
</script>
@endpush

@push('scripts')
<script>window.__pageContext = { page_type: 'dmc_marrakech' };</script>
@endpush

@section('body_class', 'dmc-page')

@section('content')

@include('partials.dmc-spacing')

<section class="vs-breadcrumb hero-overlay" data-bg-src="{{ asset('assets/img/morocco-quest-marrakech-koutoubia-dmc-hero.webp') }}">
    <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="" class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
    <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="" class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">DMC Marrakech: Net-Rate Ground Handling for Agents, Operators &amp; MICE</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        Licensed Marrakech ground handler running white-label programmes across Morocco —<br>
                        24-hour quotes, one point of contact, no surprises on the ground.
                    </p>
                </div>
                <div class="breadcrumb-menu">
                    <ul class="custom-ul">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>DMC Marrakech</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     TRUST BAR — quick stats
═══════════════════════════════════════════════════════ --}}
<section style="background:var(--theme-color);padding:20px 0;">
    <div class="container">
        <div class="row align-items-center gy-3 gx-lg-4">

            {{-- LEFT 50%: the four counts, 2x2 --}}
            <div class="col-12 col-lg-6">
                <div class="row text-center gy-3">
                    @php
                    $dmcStats = [
                        ['value' => '20+',  'label' => 'Groups handled / year'],
                        ['value' => '11',   'label' => 'Countries served'],
                        ['value' => '24/7', 'label' => 'On-ground support'],
                        ['value' => '100%', 'label' => 'Licensed & insured'],
                    ];
                    @endphp
                    @foreach($dmcStats as $stat)
                    <div class="col-6">
                        <div style="color:#fff;">
                            <div style="font-size:1.9rem;font-weight:700;line-height:1.1;">{{ $stat['value'] }}</div>
                            <div style="font-size:.82rem;opacity:.9;">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT 50%: world map — source markets in white, Morocco dark --}}
            <div class="col-12 col-lg-6 text-center">
                <style>
                    /* Height-capped so the trust bar stays compact; width follows the aspect ratio. */
                    .dmc-worldmap{ fill:rgba(255,255,255,.28); stroke:rgba(255,255,255,.38); stroke-width:.4;
                                   max-height:150px; width:auto; max-width:100%; margin-inline:auto; }
                    @media (max-width:991.98px){ .dmc-worldmap{ max-height:120px; } }
                    .dmc-worldmap__src{ fill:#fff; stroke:#fff; stroke-width:.5; }
                    .dmc-worldmap__ma{ fill:#181613; stroke:#181613; stroke-width:1.2; }
                </style>
                <figure class="mb-0">
                    <figcaption style="font-size:.8rem;letter-spacing:.05em;text-transform:uppercase;color:rgba(255,255,255,.85);font-weight:600;margin-bottom:8px;">
                        Countries We Serve
                    </figcaption>
                    @include('partials.dmc-world-map')
                </figure>
                <div class="visually-hidden">
                    Countries we serve: England, Scotland, Norway, France, Italy, Spain, Germany, Sweden, Canada, USA, Russia.
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     WHAT IS A DMC + WHY MOROCCO QUEST
═══════════════════════════════════════════════════════ --}}
<section class="space">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6">
                <div class="title-area">
                    <span class="sec-subtitle style-2">Your Ground Partner in Morocco</span>
                    <h2 class="sec-title">A Marrakech DMC Built for Repeat B2B Business</h2>
                </div>
                <p>Morocco Quest runs ground programmes for agencies across Europe, North America, the Middle East and Asia on a confidential, net-rate basis. No client-facing branding, no commission visible in your pricing — just a local team that delivers what's on the brief, on the ground, every time.</p>
                <p>From single private tours to full <strong>MICE Marrakech</strong> and <strong>events Marrakech</strong> production, we operate as your local desk: sourcing, contracting, logistics and on-site troubleshooting handled so you can stay focused on the client relationship.</p>
                <ul class="custom-ul mt-3" style="list-style:none;padding:0;">
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Licensed Moroccan tour operator (IATA compatible)</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Net-rate pricing — no commissions visible to your clients</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Full tailor-made itineraries built to your brief</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Dedicated B2B account manager, 24/7 WhatsApp line</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Emergency support on the ground, every day</li>
                </ul>
                <a href="#dmc-enquiry" class="vs-btn mt-4">Request a B2B Quote</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/destination management company (1).webp') }}"
                     alt="Tour group at Ben Youssef Madrasa in Marrakech — Morocco Quest DMC ground services for travel agents and operators"
                     width="800" height="591"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     DESTINATIONS COVERAGE — 4x2 city grid
═══════════════════════════════════════════════════════ --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">Nationwide Coverage</span>
                    <h2 class="sec-title">We Operate Across All of Morocco</h2>
                    <p>One DMC partner. The entire country covered — from imperial cities to the Sahara.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-10">
                <figure class="mb-0">
                    <img src="{{ asset('assets/img/morocco-quest-atlas-mountains-road-nationwide-coverage.webp') }}"
                         alt="Winding Atlas Mountains road used by Morocco Quest DMC for transfers across Morocco"
                         title="Atlas Mountains road — Morocco Quest DMC nationwide coverage"
                         width="1200" height="800"
                         class="w-100" style="border-radius:12px;object-fit:cover;max-height:560px;" loading="lazy" />
                </figure>
            </div>
        </div>
        <div class="row g-3 mt-4 justify-content-center">
            @php
            // 4 x 2 grid: eight core destinations we base programmes on.
            $destinations = [
                ['city' => 'Marrakech',   'label' => 'Gateway & base for most tours'],
                ['city' => 'Fes',         'label' => 'Imperial city & medina'],
                ['city' => 'Casablanca',  'label' => 'Business hub & arrivals'],
                ['city' => 'Chefchaouen', 'label' => 'Blue city in the Rif'],
                ['city' => 'Merzouga',    'label' => 'Sahara desert & camel treks'],
                ['city' => 'Ouarzazate',  'label' => 'Kasbah route & film studios'],
                ['city' => 'Essaouira',   'label' => 'Atlantic coast & wind sports'],
                ['city' => 'Agadir',      'label' => 'Beach & resort groups'],
            ];
            @endphp
            @foreach($destinations as $d)
            <div class="col-6 col-lg-3">
                <div class="text-center p-3" style="border-radius:8px;background:var(--theme-color);height:100%;">
                    <i class="fa-solid fa-location-dot" style="color:#fff;font-size:1.2rem;display:block;margin-bottom:6px;"></i>
                    <div style="font-weight:700;font-size:.95rem;color:#fff;">{{ $d['city'] }}</div>
                    <div style="font-size:.78rem;color:rgba(255,255,255,.85);">{{ $d['label'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     WHY B2B PARTNERS CHOOSE US
═══════════════════════════════════════════════════════ --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6 order-lg-2">
                <div class="title-area">
                    <span class="sec-subtitle style-2">Why Partner With Us</span>
                    <h2 class="sec-title">What Makes Morocco Quest Different as a DMC Morocco Partner</h2>
                </div>
                <div class="row g-4 mt-1">
                    @php
                    $reasons = [
                        ['icon'=>'fa-handshake',    'title'=>'True B2B Partnership',      'body'=>'We never compete with you. Your brand, your margin. We operate fully white-label.'],
                        ['icon'=>'fa-clock',        'title'=>'24-Hour Quote Turnaround',  'body'=>'Send us a brief — receive a full net-rate costing within one business day.'],
                        ['icon'=>'fa-shield-halved','title'=>'Fully Licensed & Insured',  'body'=>'Moroccan Ministry of Tourism licensed. Full liability coverage for all groups.'],
                        ['icon'=>'fa-language',     'title'=>'Multilingual Team',         'body'=>'Our operations team works in EN, FR, ES and AR — matching your client language.'],
                    ];
                    @endphp
                    @foreach($reasons as $r)
                    <div class="col-sm-6">
                        <div style="display:flex;gap:14px;align-items:flex-start;">
                            <div style="width:44px;height:44px;background:var(--theme-color);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fa-solid {{ $r['icon'] }}" style="color:#fff;font-size:1.1rem;"></i>
                            </div>
                            <div>
                                <div style="font-weight:700;font-size:.95rem;margin-bottom:4px;">{{ $r['title'] }}</div>
                                <div style="font-size:.88rem;color:#555;">{{ $r['body'] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <img src="{{ asset('assets/img/morocco-quest-koutoubia-mosque-marrakech-why-us.webp') }}"
                     alt="Koutoubia Mosque minaret in Marrakech — landmark of the city Morocco Quest DMC operates from"
                     title="Koutoubia Mosque, Marrakech — Morocco Quest DMC base city"
                     width="1400" height="1051"
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

{{-- ═══════════════════════════════════════════════════════
     B2B LEAD FORM
═══════════════════════════════════════════════════════ --}}
<section class="space" id="dmc-enquiry">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">B2B Enquiry</span>
                    <h2 class="sec-title">Request a Net-Rate Quote</h2>
                    <p>Fill in the form below — we respond within 24 hours with a full costing. All enquiries are treated as strictly confidential.</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-dismissible fade show d-flex align-items-start gap-3 mb-4"
                         role="alert"
                         style="background:#e9f7ef;border:1px solid #a8d5b5;border-radius:10px;padding:18px 20px;">
                        <i class="fa-solid fa-circle-check" style="color:#27ae60;font-size:1.4rem;margin-top:2px;flex-shrink:0;"></i>
                        <div>
                            <div style="font-weight:700;color:#1a7a40;font-size:1rem;margin-bottom:2px;">Enquiry sent successfully!</div>
                            <div style="color:#2d6a4f;font-size:.92rem;">{{ session('success') }}</div>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-dismissible fade show d-flex align-items-start gap-3 mb-4"
                         role="alert"
                         style="background:#fdf0ef;border:1px solid #f5c6c2;border-radius:10px;padding:18px 20px;">
                        <i class="fa-solid fa-circle-exclamation" style="color:#e74c3c;font-size:1.4rem;margin-top:2px;flex-shrink:0;"></i>
                        <div>
                            <div style="font-weight:700;color:#a93226;font-size:1rem;margin-bottom:2px;">Something went wrong</div>
                            <div style="color:#922b21;font-size:.92rem;">{{ session('error') }}</div>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-dismissible fade show d-flex align-items-start gap-3 mb-4"
                         role="alert"
                         style="background:#fdf0ef;border:1px solid #f5c6c2;border-radius:10px;padding:18px 20px;">
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
                    {{-- Hidden field so the contact controller knows this is a DMC enquiry --}}
                    <input type="hidden" name="enquiry_type" value="DMC B2B">
                    <input type="hidden" name="page_source" value="dmc-marrakech">
                    <div class="row g-3">

                        <div class="col-md-6 form-group">
                            <label for="dmc_name" style="font-weight:400;margin-bottom:4px;display:block;">Full Name *</label>
                            <input id="dmc_name" name="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Your full name"
                                   value="{{ old('name') }}" required autocomplete="name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="dmc_company" style="font-weight:400;margin-bottom:4px;display:block;">Company / Agency *</label>
                            <input id="dmc_company" name="nationality" type="text"
                                   class="form-control @error('nationality') is-invalid @enderror"
                                   placeholder="Your company or agency name"
                                   value="{{ old('nationality') }}" required />
                            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="dmc_email" style="font-weight:400;margin-bottom:4px;display:block;">Business Email *</label>
                            <input id="dmc_email" name="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="your@company.com"
                                   value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="dmc_phone" style="font-weight:400;margin-bottom:4px;display:block;">Phone / WhatsApp *</label>
                            <input id="dmc_phone" name="phone" type="tel"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="+1 / +44 / +33..."
                                   value="{{ old('phone') }}" required autocomplete="tel" />
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="dmc_date" style="font-weight:400;margin-bottom:4px;display:block;">Travel Dates *</label>
                            <input id="dmc_date" name="arrival_date" type="text"
                                   class="form-control @error('arrival_date') is-invalid @enderror"
                                   placeholder="Select departure date"
                                   value="{{ old('arrival_date') }}" required readonly />
                            @error('arrival_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="dmc_pax" style="font-weight:400;margin-bottom:4px;display:block;">Group Size (Pax) *</label>
                            <input id="dmc_pax" name="adults" type="number" min="1"
                                   class="form-control @error('adults') is-invalid @enderror"
                                   placeholder="Number of travellers"
                                   value="{{ old('adults') }}" required />
                            @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="dmc_duration" style="font-weight:400;margin-bottom:4px;display:block;">Programme Duration (Days) *</label>
                            <input id="dmc_duration" name="duration_days" type="number" min="1"
                                   class="form-control @error('duration_days') is-invalid @enderror"
                                   placeholder="Number of days"
                                   value="{{ old('duration_days') }}" required />
                            @error('duration_days')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label style="font-weight:400;margin-bottom:4px;display:block;">Service Type</label>
                            <select name="children" class="form-control" style="height:56px;">
                                <option value="0" {{ old('children') == '0' ? 'selected' : '' }}>Private Tours</option>
                                <option value="1" {{ old('children') == '1' ? 'selected' : '' }}>Incentive / MICE</option>
                                <option value="2" {{ old('children') == '2' ? 'selected' : '' }}>Group Package</option>
                                <option value="3" {{ old('children') == '3' ? 'selected' : '' }}>Transfers Only</option>
                                <option value="4" {{ old('children') == '4' ? 'selected' : '' }}>Full DMC Programme</option>
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label for="dmc_brief" style="font-weight:400;margin-bottom:4px;display:block;">Programme Brief *</label>
                            <textarea id="dmc_brief" name="travel_ideas"
                                      class="form-control @error('travel_ideas') is-invalid @enderror"
                                      placeholder="Describe your programme: destinations, accommodation category, special requests, activities, client profile..."
                                      rows="5" required>{{ old('travel_ideas') }}</textarea>
                            @error('travel_ideas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <div style="background:#f8f8f8;border-radius:8px;padding:14px 18px;font-size:.88rem;color:#555;margin-bottom:8px;">
                                <i class="fa-solid fa-lock me-2" style="color:var(--theme-color);"></i>
                                Your enquiry is 100% confidential. We never share your client data or undercut your pricing.
                            </div>
                        </div>

                        @include('partials.recaptcha')
                        <div class="col-12 form-group mb-0">
                            <button class="vs-btn w-100 w-sm-auto" type="submit">
                                <i class="fa-solid fa-paper-plane me-2"></i> Send B2B Enquiry
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

{{-- ═══════════════════════════════════════════════════════
     FAQ
═══════════════════════════════════════════════════════ --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">FAQ</span>
                    <h2 class="sec-title">Frequently Asked Questions — DMC Marrakech</h2>
                </div>
                <div class="accordion accordion-style1" id="dmcFaq" style="--dmc-faq-pr:60px;">
                <style>
                    #dmcFaq .accordion-button{padding-right:60px;font-size:.95rem;color:var(--title-color);text-transform:none;line-height:1.45;}
                    #dmcFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #dmcFaq .accordion-body{font-size:.88rem;text-transform:none;line-height:1.6;letter-spacing:normal;}
                    @media (max-width:575px){
                        #dmcFaq .accordion-button{font-size:.9rem;line-height:1.4;padding-right:44px;}
                        #dmcFaq .accordion-body{font-size:.84rem;line-height:1.55;}
                    }
                </style>

                    @php
                    $faqs = [
                        [
                            'q' => 'Does Morocco Quest work with travel agents and tour operators?',
                            'a' => 'Yes. Morocco Quest operates a dedicated B2B desk. We work with travel agents, online tour operators, incentive houses and MICE planners on a net-rate basis. Contact us at sales@morocco-quest.com for a trade account and rate card.',
                        ],
                        [
                            'q' => 'What ground services does Morocco Quest DMC provide?',
                            'a' => 'Our DMC services include: tailor-made private tours, airport & city transfers, licensed English/French/Spanish guides, desert camp bookings in Merzouga, hotel sourcing & contracting, team-building & incentive programmes, MICE event logistics, group coordination and 24/7 local support.',
                        ],
                        [
                            'q' => 'Which destinations in Morocco does Morocco Quest cover?',
                            'a' => 'We cover the entire country: Marrakech, Fes, Casablanca, Rabat, Chefchaouen, Tangier, Agadir, Ouarzazate, Merzouga (Sahara Desert), Dades & Draa Valleys, the Atlas Mountains and all coastal cities.',
                        ],
                        [
                            'q' => 'How do I request a B2B quote from Morocco Quest DMC?',
                            'a' => 'Use the B2B enquiry form above or email sales@morocco-quest.com directly. Include your group size, travel dates, destinations and service requirements. We respond within 24 hours with a detailed net-rate proposal.',
                        ],
                        [
                            'q' => 'Do you handle MICE and incentive travel programmes in Morocco?',
                            'a' => 'Absolutely. We specialise in MICE Morocco programmes: gala dinners in traditional riads, team-building in the Atlas Mountains, exclusive Sahara camps for incentive groups, themed entertainment, local entertainment and full event production.',
                        ],
                    ];
                    @endphp

                    @foreach($faqs as $i => $faq)
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#dmcFaq{{ $i }}"
                                    aria-expanded="{{ $i === 0 ? 'true' : 'false' }}"
                                    aria-controls="dmcFaq{{ $i }}">
                                {{ $faq['q'] }}
                            </button>
                        </h3>
                        <div id="dmcFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#dmcFaq">
                            <div class="accordion-body">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.dmc-testimonials')

@include('partials.dmc-related')

@include('partials.dmc-products')

{{-- ═══════════════════════════════════════════════════════
     FINAL CTA
═══════════════════════════════════════════════════════ --}}
<section class="dmc-cta" style="background:#181613;padding:64px 0;">
    <div class="container text-center">
        <h2 style="color:#fff;font-size:2rem;margin-bottom:12px;">Ready to Partner with Morocco Quest DMC?</h2>
        <p style="color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 28px;">
            Trusted by travel agencies and operators as their Morocco ground partner for MICE Morocco and events Morocco programmes. Send your brief today — net-rate quote within 24 hours.
        </p>
        <div class="row g-3 justify-content-center">
            <div class="col-12 col-sm-auto">
                <a href="#dmc-enquiry" class="vs-btn d-block">Request a Quote</a>
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
        flatpickr('#dmc_date', {
            mode: 'single',
            dateFormat: 'Y-m-d',
            minDate: 'today',
        });

        // Auto-scroll to alert if present
        const alert = document.querySelector('#dmc-enquiry .alert');
        if (alert) {
            alert.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script>
@endpush

@endsection
