@extends('layouts.app2')

@section('title', $title ?? 'DMC Marrakech | Destination Management Company Morocco | Morocco Quest')
@section('description', $description ?? 'Morocco Quest — trusted DMC in Marrakech for travel agents, tour operators & MICE groups. Tailor-made ground services: private tours, desert camps, transfers, guides & event logistics across Morocco.')
@section('keywords', is_array($keywords ?? null) ? implode(', ', $keywords) : ($keywords ?? 'dmc marrakech, destination management company morocco, dmc morocco, morocco ground services, morocco inbound tour operator'))

@push('jsonld')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "TravelAgency",
    "@id": "{{ url('/') }}#dmc-marrakech",
    "name": "Morocco Quest DMC Marrakech",
    "description": "Morocco Quest is a licensed Destination Management Company (DMC) based in Marrakech, Morocco. We provide tailor-made ground services for travel agents, tour operators, incentive houses and MICE planners worldwide.",
    "url": "{{ url('/dmc-marrakech') }}",
    "logo": "{{ asset('assets/img/logo-bg-wide.webp') }}",
    "image": "{{ asset('assets/img/ait-benhaddou-morocco-travel-hero-banner.webp') }}",
    "telephone": "+212-654-069-718",
    "email": "sales@morocco-quest.com",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "Khalid Ibn Al Walid Street",
        "addressLocality": "Marrakech",
        "addressRegion": "Marrakech-Safi",
        "postalCode": "40000",
        "addressCountry": "MA"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "31.6295",
        "longitude": "-7.9811"
    },
    "areaServed": [
        { "@type": "Country", "name": "Morocco" },
        { "@type": "City",    "name": "Marrakech" },
        { "@type": "City",    "name": "Fes" },
        { "@type": "City",    "name": "Casablanca" },
        { "@type": "Place",   "name": "Sahara Desert" },
        { "@type": "Place",   "name": "Merzouga" },
        { "@type": "City",    "name": "Chefchaouen" },
        { "@type": "City",    "name": "Agadir" }
    ],
    "knowsAbout": [
        "Destination Management Company Marrakech",
        "Morocco ground services",
        "MICE Morocco",
        "incentive travel Morocco",
        "private tours Morocco",
        "Morocco corporate events",
        "Morocco inbound tour operator",
        "Morocco group travel"
    ],
    "sameAs": [
        "https://www.facebook.com/codesommetagency/",
        "https://www.instagram.com/moroccoquestdmc/",
        "https://www.tripadvisor.com/Attraction_Review-g293734-d33367694-Reviews-Morocco_Quest_Dmc-Marrakech_Marrakech_Safi.html"
    ],
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+212-654-069-718",
        "email": "sales@morocco-quest.com",
        "contactType": "B2B Sales",
        "areaServed": ["MA","US","EU","UK","AE"],
        "availableLanguage": ["English", "French", "Spanish"]
    }
}
</script>
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
            "name": "What is a DMC in Marrakech?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "A DMC (Destination Management Company) in Marrakech is a local ground operator that provides travel agents and tour operators with on-the-ground logistics: private transfers, licensed guides, accommodation, desert camps, event production and full itinerary management across Morocco."
            }
        },
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
        }
    ]
}
</script>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════════ --}}
<section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/ait-benhaddou-morocco-travel-hero-banner.webp') }}">
    <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="" class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
    <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="" class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">DMC Marrakech</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        Your trusted Destination Management Company in Morocco —<br>
                        tailor-made ground services for travel agents, operators &amp; MICE groups.
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
     TRUST BAR — 4 quick stats
═══════════════════════════════════════════════════════ --}}
<section style="background:#f7921e;padding:22px 0;">
    <div class="container">
        <div class="row text-center gy-3">
            <div class="col-6 col-md-3">
                <div style="color:#fff;">
                    <div style="font-size:2rem;font-weight:700;">500+</div>
                    <div style="font-size:.85rem;opacity:.9;">Groups handled / year</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;">
                    <div style="font-size:2rem;font-weight:700;">30+</div>
                    <div style="font-size:.85rem;opacity:.9;">Countries served</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;">
                    <div style="font-size:2rem;font-weight:700;">24/7</div>
                    <div style="font-size:.85rem;opacity:.9;">On-ground support</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;">
                    <div style="font-size:2rem;font-weight:700;">100%</div>
                    <div style="font-size:.85rem;opacity:.9;">Licensed & insured</div>
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
                    <h2 class="sec-title">What is a DMC in Marrakech?</h2>
                </div>
                <p>A <strong>Destination Management Company (DMC)</strong> is a local expert that handles every on-the-ground detail so travel agents, tour operators and corporate planners can sell Morocco with confidence — without managing the logistics themselves.</p>
                <p>Morocco Quest has operated as a <strong>licensed DMC in Marrakech</strong> for years, working with agencies across Europe, North America, the Middle East and Asia on a confidential net-rate basis. We are your local eyes, ears and operational backbone.</p>
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
                <img src="{{ asset('assets/img/dmc-in-morocco-moroccoquest.webp') }}"
                     alt="Morocco Quest DMC Marrakech — ground services for travel agents and tour operators"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     B2B SERVICES GRID
═══════════════════════════════════════════════════════ --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">DMC Ground Services</span>
                    <h2 class="sec-title">Everything Your Clients Need — Handled Locally</h2>
                    <p>From a single transfer to a 500-person incentive programme, Morocco Quest provides the full spectrum of B2B ground services across Morocco.</p>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">

            {{-- Service card --}}
            @php
            $services = [
                [
                    'icon'  => 'fa-route',
                    'title' => 'Tailor-Made Private Tours',
                    'body'  => 'FIT and group itineraries built entirely to your brief — any duration, any budget, any style. Private vehicles with licensed guides across the whole country.',
                ],
                [
                    'icon'  => 'fa-tent',
                    'title' => 'Sahara Desert Camps',
                    'body'  => 'Exclusive luxury camps and standard bivouac options in Merzouga and Zagora. We manage access, camel treks, dinner under the stars and overnight logistics.',
                ],
                [
                    'icon'  => 'fa-van-shuttle',
                    'title' => 'Airport & City Transfers',
                    'body'  => 'Meet-and-greet, private minibuses, executive sedans and coaches for groups of any size — Marrakech, Casablanca, Fes, Agadir and all airports.',
                ],
                [
                    'icon'  => 'fa-person-chalkboard',
                    'title' => 'Licensed Guide Services',
                    'body'  => 'Official licensed guides in English, French, Spanish, German and Italian. City tours, museum visits, medina walks and specialist cultural guides.',
                ],
                [
                    'icon'  => 'fa-hotel',
                    'title' => 'Hotel Sourcing & Contracting',
                    'body'  => 'Pre-contracted rates at riads, boutique hotels and 5-star properties. We handle rooming lists, meal plans, room drops and VIP amenities.',
                ],
                [
                    'icon'  => 'fa-trophy',
                    'title' => 'Incentive & MICE Programmes',
                    'body'  => 'End-to-end incentive travel and corporate event management: gala dinners in a riad, team-building in the Atlas, desert experiences for C-suite groups.',
                ],
            ];
            @endphp

            @foreach($services as $s)
            <div class="col-md-6 col-lg-4">
                <div class="bg-white-color h-100 p-4" style="border-radius:10px;border:1px solid #eee;transition:box-shadow .2s;" onmouseover="this.style.boxShadow='0 6px 24px rgba(0,0,0,.10)'" onmouseout="this.style.boxShadow='none'">
                    <div style="width:52px;height:52px;background:#fff4e5;border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                        <i class="fa-solid {{ $s['icon'] }}" style="font-size:1.4rem;color:#f7921e;"></i>
                    </div>
                    <h3 style="font-size:1.05rem;font-weight:700;margin-bottom:8px;">{{ $s['title'] }}</h3>
                    <p style="font-size:.92rem;color:#555;margin:0;">{{ $s['body'] }}</p>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     DESTINATIONS COVERAGE MAP (text-based)
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
        <div class="row g-3 mt-2 justify-content-center">
            @php
            $destinations = [
                ['city' => 'Marrakech',   'label' => 'Gateway & base for most tours'],
                ['city' => 'Fes',         'label' => 'Imperial city & medina'],
                ['city' => 'Casablanca',  'label' => 'Business hub & arrivals'],
                ['city' => 'Chefchaouen','label' => 'Blue city in the Rif'],
                ['city' => 'Merzouga',    'label' => 'Sahara desert & camel treks'],
                ['city' => 'Ouarzazate',  'label' => 'Kasbah route & film studios'],
                ['city' => 'Essaouira',   'label' => 'Atlantic coast & wind sports'],
                ['city' => 'Agadir',      'label' => 'Beach & resort groups'],
                ['city' => 'Rabat',       'label' => 'Capital city tours'],
                ['city' => 'Tangier',     'label' => 'Northern gateway & day trips'],
            ];
            @endphp
            @foreach($destinations as $d)
            <div class="col-6 col-md-4 col-lg-2">
                <div class="text-center p-3" style="border-radius:8px;background:#f8f8f8;height:100%;">
                    <i class="fa-solid fa-location-dot" style="color:#f7921e;font-size:1.2rem;display:block;margin-bottom:6px;"></i>
                    <div style="font-weight:700;font-size:.95rem;">{{ $d['city'] }}</div>
                    <div style="font-size:.78rem;color:#777;">{{ $d['label'] }}</div>
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
                    <h2 class="sec-title">What Makes Morocco Quest Different as a DMC</h2>
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
                            <div style="width:44px;height:44px;background:#f7921e;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
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
                {{-- Testimonial / social proof block --}}
                <div style="background:#fff;border-radius:12px;padding:32px;box-shadow:0 4px 24px rgba(0,0,0,.07);">
                    <div style="font-size:2.5rem;color:#f7921e;line-height:1;margin-bottom:12px;">"</div>
                    <p style="font-size:1.05rem;font-style:italic;color:#333;margin-bottom:20px;">
                        "Morocco Quest handled our 120-person incentive group flawlessly — from the Marrakech airport pickup to the private Sahara camp dinner. Their local knowledge and responsiveness are unmatched. We've made them our exclusive Morocco DMC partner."
                    </p>
                    <div style="display:flex;align-items:center;gap:14px;">
                        <div style="width:48px;height:48px;background:#f0f0f0;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                            <i class="fa-solid fa-user" style="color:#aaa;"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:.95rem;">Sophie M.</div>
                            <div style="font-size:.82rem;color:#777;">Incentive Travel Director — Paris, France</div>
                        </div>
                        <div class="ms-auto">
                            <span style="color:#f7921e;">★★★★★</span>
                        </div>
                    </div>
                </div>
                <div style="background:#fff;border-radius:12px;padding:24px;box-shadow:0 4px 24px rgba(0,0,0,.07);margin-top:16px;">
                    <p style="font-size:.98rem;font-style:italic;color:#333;margin-bottom:14px;">
                        "The net rates are very competitive and the turnaround time on quotes is impressive. Highly recommend Morocco Quest as a reliable DMC partner in Marrakech."
                    </p>
                    <div style="display:flex;align-items:center;gap:14px;">
                        <div style="width:40px;height:40px;background:#f0f0f0;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                            <i class="fa-solid fa-user" style="color:#aaa;"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:.9rem;">James T.</div>
                            <div style="font-size:.8rem;color:#777;">Tour Operator — London, UK</div>
                        </div>
                        <div class="ms-auto">
                            <span style="color:#f7921e;">★★★★★</span>
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

                <form action="{{ route('contact.submit') }}" method="POST" class="form-style1" novalidate>
                    @csrf
                    {{-- Hidden field so the contact controller knows this is a DMC enquiry --}}
                    <input type="hidden" name="enquiry_type" value="DMC B2B">
                    <div class="row g-3">

                        <div class="col-md-6 form-group">
                            <label for="dmc_name" style="font-weight:600;margin-bottom:4px;display:block;">Full Name *</label>
                            <input id="dmc_name" name="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Your full name"
                                   value="{{ old('name') }}" required autocomplete="name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="dmc_company" style="font-weight:600;margin-bottom:4px;display:block;">Company / Agency *</label>
                            <input id="dmc_company" name="nationality" type="text"
                                   class="form-control @error('nationality') is-invalid @enderror"
                                   placeholder="Your company or agency name"
                                   value="{{ old('nationality') }}" required />
                            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="dmc_email" style="font-weight:600;margin-bottom:4px;display:block;">Business Email *</label>
                            <input id="dmc_email" name="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="your@company.com"
                                   value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="dmc_phone" style="font-weight:600;margin-bottom:4px;display:block;">Phone / WhatsApp *</label>
                            <input id="dmc_phone" name="phone" type="tel"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="+1 / +44 / +33..."
                                   value="{{ old('phone') }}" required autocomplete="tel" />
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="dmc_date" style="font-weight:600;margin-bottom:4px;display:block;">Travel Dates *</label>
                            <input id="dmc_date" name="arrival_date" type="text"
                                   class="form-control @error('arrival_date') is-invalid @enderror"
                                   placeholder="Select departure date"
                                   value="{{ old('arrival_date') }}" required readonly />
                            @error('arrival_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="dmc_pax" style="font-weight:600;margin-bottom:4px;display:block;">Group Size (Pax) *</label>
                            <input id="dmc_pax" name="adults" type="number" min="1"
                                   class="form-control @error('adults') is-invalid @enderror"
                                   placeholder="Number of travellers"
                                   value="{{ old('adults') }}" required />
                            @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="dmc_duration" style="font-weight:600;margin-bottom:4px;display:block;">Programme Duration (Days) *</label>
                            <input id="dmc_duration" name="duration_days" type="number" min="1"
                                   class="form-control @error('duration_days') is-invalid @enderror"
                                   placeholder="Number of days"
                                   value="{{ old('duration_days') }}" required />
                            @error('duration_days')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label style="font-weight:600;margin-bottom:4px;display:block;">Service Type</label>
                            <select name="children" class="form-control" style="height:56px;">
                                <option value="0" {{ old('children') == '0' ? 'selected' : '' }}>Private Tours</option>
                                <option value="1" {{ old('children') == '1' ? 'selected' : '' }}>Incentive / MICE</option>
                                <option value="2" {{ old('children') == '2' ? 'selected' : '' }}>Group Package</option>
                                <option value="3" {{ old('children') == '3' ? 'selected' : '' }}>Transfers Only</option>
                                <option value="4" {{ old('children') == '4' ? 'selected' : '' }}>Full DMC Programme</option>
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label for="dmc_brief" style="font-weight:600;margin-bottom:4px;display:block;">Programme Brief *</label>
                            <textarea id="dmc_brief" name="travel_ideas"
                                      class="form-control @error('travel_ideas') is-invalid @enderror"
                                      placeholder="Describe your programme: destinations, accommodation category, special requests, activities, client profile..."
                                      rows="5" required>{{ old('travel_ideas') }}</textarea>
                            @error('travel_ideas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <div style="background:#f8f8f8;border-radius:8px;padding:14px 18px;font-size:.88rem;color:#555;margin-bottom:8px;">
                                <i class="fa-solid fa-lock me-2" style="color:#f7921e;"></i>
                                Your enquiry is 100% confidential. We never share your client data or undercut your pricing.
                            </div>
                        </div>

                        <div class="col-12 form-group mb-0">
                            <button class="vs-btn w-100 w-sm-auto" type="submit">
                                <i class="fa-solid fa-paper-plane me-2"></i> Send B2B Enquiry
                            </button>
                            <div style="margin-top:12px;font-size:.88rem;color:#777;">
                                We reply within <strong>24 hours</strong> — or call us:
                                <a href="tel:+212654069718" style="color:#f7921e;font-weight:600;">+212 654 069 718</a>
                            </div>
                        </div>

                    </div>
                </form>
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
                <style>#dmcFaq .accordion-button{padding-right:60px;}</style>

                    @php
                    $faqs = [
                        [
                            'q' => 'What is a DMC in Marrakech?',
                            'a' => 'A DMC (Destination Management Company) in Marrakech is a local ground operator that provides travel agents and tour operators with on-the-ground logistics: private transfers, licensed guides, accommodation, desert camps, event production and full itinerary management across Morocco.',
                        ],
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

{{-- Phase 5: Cross-links to tours + blog for topical authority --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                <h3 class="sec-title mb-3" style="font-size:1.4rem;">Explore Our Morocco Products</h3>
                <p>Looking for ready-made itineraries to build your packages from? Browse our full range of <a href="{{ route('tours.index') }}">private morocco tours</a> and <a href="{{ route('trips.index') }}">multi-day trip packages</a> — all are available as B2B net-rate products. For destination insights to share with your clients, our <a href="{{ route('blog.index') }}">Morocco travel blog</a> covers route planning, best travel seasons, packing guides, and city-by-city advice. For individual traveller bookings, see our <a href="{{ route('activity-categories.index') }}">Morocco activities</a> and <a href="{{ route('destinations.index') }}">destination guides</a>.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     FINAL CTA
═══════════════════════════════════════════════════════ --}}
<section style="background:#181613;padding:64px 0;">
    <div class="container text-center">
        <h2 style="color:#fff;font-size:2rem;margin-bottom:12px;">Ready to Partner with Morocco Quest DMC?</h2>
        <p style="color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 28px;">
            Join 200+ travel agencies and operators who trust us as their Morocco ground partner. Send your brief today — net-rate quote within 24 hours.
        </p>
        <div class="row g-3 justify-content-center">
            <div class="col-12 col-sm-auto">
                <a href="#dmc-enquiry" class="vs-btn d-block">Request a Quote</a>
            </div>
            <div class="col-12 col-sm-auto">
                <a href="mailto:sales@morocco-quest.com" class="vs-btn d-block" style="background:transparent;border:2px solid #f7921e;color:#f7921e;">
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
