@extends('layouts.app2')

@section('title', $title ?? 'Team Building Marrakech | Incentive Travel Morocco | Morocco Quest DMC')
@section('description', $description ?? 'Team building and incentive travel programmes in Marrakech: Atlas Mountain challenges, desert camps, medina rallies and CSR activities for corporate groups.')
@section('keywords', is_array($keywords ?? null) ? implode(', ', $keywords) : ($keywords ?? 'team building marrakech, incentive travel morocco, corporate team building morocco'))

@push('jsonld')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Team Building and Incentive Travel",
    "name": "Team Building & Incentive Travel — Morocco Quest DMC",
    "description": "Morocco Quest designs and delivers team building activities and incentive travel programmes in Marrakech and across Morocco, from Atlas Mountain challenges to desert incentive camps.",
    "provider": {
        "@type": "TravelAgency",
        "name": "Morocco Quest",
        "url": "{{ url('/') }}",
        "telephone": "+212-654-069-718",
        "email": "sales@morocco-quest.com",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Khalid Ibn Al Walid Street",
            "addressLocality": "Marrakech",
            "addressRegion": "Marrakech-Safi",
            "postalCode": "40000",
            "addressCountry": "MA"
        }
    },
    "areaServed": [
        { "@type": "City", "name": "Marrakech" },
        { "@type": "City", "name": "Casablanca" },
        { "@type": "City", "name": "Rabat" },
        { "@type": "Country", "name": "Morocco" }
    ],
    "url": "{{ url('/team-building-marrakech') }}"
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "DMC", "item": "{{ url('/dmc-marrakech') }}" },
        { "@type": "ListItem", "position": 3, "name": "Team Building & Incentive Travel", "item": "{{ url('/team-building-marrakech') }}" }
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
            "name": "What team building activities can you organise in Marrakech?",
            "acceptedAnswer": { "@type": "Answer", "text": "We run Atlas Mountain challenges, 4x4 rally games in the Agafay Desert, quad biking, camel trekking, medina treasure hunts, cooking workshops in a riad, and CSR activities such as tree planting or school equipment drives. Programmes are usually combined — for example a morning rally followed by a desert camp dinner." }
        },
        {
            "@type": "Question",
            "name": "How many people can you handle for an incentive trip?",
            "acceptedAnswer": { "@type": "Answer", "text": "We regularly organise programmes from small executive groups of 10 to incentive trips of 200 or more, splitting large groups into activity waves so logistics and safety briefings stay manageable." }
        },
        {
            "@type": "Question",
            "name": "Is Marrakech safe for outdoor team building activities?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. All outdoor activities run with licensed operators, briefed guides and insurance cover appropriate to the activity. We build weather contingency options into every itinerary involving mountain or desert terrain." }
        },
        {
            "@type": "Question",
            "name": "Can you accommodate dietary and cultural requirements for large groups?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. We collect dietary and cultural requirements at the planning stage and brief caterers accordingly, including halal, vegetarian, vegan and allergen-specific menus for gala dinners and desert camps." }
        },
        {
            "@type": "Question",
            "name": "How far in advance should we book an incentive trip to Morocco?",
            "acceptedAnswer": { "@type": "Answer", "text": "For groups above 50 people, 3 to 5 months gives comfortable room to secure accommodation blocks and activity providers, particularly in peak season (March to May and September to November). Smaller groups can often be arranged within 4 to 6 weeks." }
        },
        {
            "@type": "Question",
            "name": "Do you offer CSR and sustainability-focused activities?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. Common options include tree-planting sessions with local cooperatives, school equipment or supply drives, and workshops run with women's cooperatives, which can be built into a half-day or full-day CSR module alongside other activities." }
        },
        {
            "@type": "Question",
            "name": "What is included in a team building or incentive proposal?",
            "acceptedAnswer": { "@type": "Answer", "text": "A typical proposal covers activity design and timings, transport, guides and equipment, accommodation and meals, and a costed budget quoted net, so your team retains full control of client-facing pricing where relevant." }
        },
        {
            "@type": "Question",
            "name": "Why choose Marrakech over a European destination for an incentive trip?",
            "acceptedAnswer": { "@type": "Answer", "text": "Marrakech is under four hours from most major European hubs, offers a favourable exchange rate against the euro and pound, and provides dramatic Atlas Mountain and desert backdrops that are difficult to match at a comparable cost in Western Europe." }
        }
    ]
}
</script>
@endpush

@section('content')

{{-- HERO --}}
<section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/agafay-desert-luxury-camp-camel-trek-morocco.webp') }}">
    <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="" class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
    <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="" class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">Team Building & Incentive Travel</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        Atlas Mountain challenges, desert incentive camps and medina rallies —<br>
                        corporate team building programmes designed and delivered in Marrakech.
                    </p>
                </div>
                <div class="breadcrumb-menu">
                    <ul class="custom-ul">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('dmc.marrakech') }}">DMC</a></li>
                        <li>Team Building & Incentive Travel</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TRUST BAR --}}
<section style="background:var(--theme-color);padding:22px 0;">
    <div class="container">
        <div class="row text-center gy-3">
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">300</div><div style="font-size:.85rem;opacity:.9;">Max group size handled</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">15+</div><div style="font-size:.85rem;opacity:.9;">Activity formats available</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">4</div><div style="font-size:.85rem;opacity:.9;">Working languages on-site</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">24h</div><div style="font-size:.85rem;opacity:.9;">Typical response time</div></div>
            </div>
        </div>
    </div>
</section>

{{-- INTRODUCTION --}}
<section class="space">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6">
                <div class="title-area">
                    <span class="sec-subtitle style-2">Team Building & Incentive Travel</span>
                    <h2 class="sec-title">Programmes Built Around Your Group, Not a Brochure Package</h2>
                </div>
                <p>A generic "desert excursion" is not team building. Activities need a purpose — sharpening collaboration, rewarding a sales team, or giving a newly merged group a shared experience — and a format that actually delivers it.</p>
                <p>Morocco Quest designs <strong>team building and incentive travel programmes in Marrakech</strong> for companies, incentive houses and event agencies. We combine Atlas Mountain challenges, Agafay Desert rally games, medina treasure hunts and CSR modules into programmes matched to your group's size, objectives and budget, then deliver them on the ground with our own guides and logistics team.</p>
                <ul class="custom-ul mt-3" style="list-style:none;padding:0;">
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Activity design matched to your objectives, not a fixed catalogue</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Licensed operators and briefed local guides for every activity</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Weather and safety contingency built into desert and mountain days</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> One point of contact from first brief to final gala dinner</li>
                </ul>
                <a href="#teambuilding-enquiry" class="vs-btn mt-4">Request a Proposal</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/agafay-desert-luxury-camp-camel-trek-morocco.webp') }}"
                     alt="Corporate group at a desert incentive camp near Marrakech during a team building programme"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
            </div>
        </div>
    </div>
</section>

{{-- WHO IT'S FOR / WHEN NEEDED --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">Who This Is For</span>
                    <h2 class="sec-title">Built for Teams That Need More Than a Team-Building Checklist</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $audiences = [
                ['icon'=>'fa-users-gear',      'title'=>'HR & People Teams',       'body'=>'Organizing offsites and culture-building days, often after a merger, restructuring or period of remote work.'],
                ['icon'=>'fa-award',           'title'=>'Incentive Houses',        'body'=>'Rewarding top-performing sales teams and partners with a trip that feels earned, not generic.'],
                ['icon'=>'fa-chart-line',      'title'=>'Sales & Commercial Teams','body'=>'Running annual kick-offs that combine strategy sessions with activities that build momentum.'],
                ['icon'=>'fa-handshake',       'title'=>'Event & Incentive Agencies','body'=>'International agencies needing a reliable ground partner to deliver a Morocco leg of a client programme.'],
            ];
            @endphp
            @foreach($audiences as $a)
            <div class="col-sm-6 col-lg-3">
                <div class="text-center p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="width:52px;height:52px;background:var(--theme-color);border-radius:10px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                        <i class="fa-solid {{ $a['icon'] }}" style="color:#fff;font-size:1.3rem;"></i>
                    </div>
                    <div style="font-weight:700;margin-bottom:6px;">{{ $a['title'] }}</div>
                    <div style="font-size:.88rem;color:#666;">{{ $a['body'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- WHY MARRAKECH / OUR APPROACH --}}
<section class="space">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/berber-terrace-atlas-mountains-imlil-morocco.webp') }}"
                     alt="Atlas Mountains near Imlil used as a backdrop for corporate team building challenges"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <div class="title-area">
                    <span class="sec-subtitle style-2">Why Marrakech</span>
                    <h2 class="sec-title">A Backdrop That Does Half the Work for You</h2>
                </div>
                <p>Marrakech sits under four hours from most major European hubs, which keeps travel days short and budgets predictable. The exchange rate against the euro and pound has made Morocco a noticeably more cost-efficient incentive destination than Western Europe for equivalent activity quality and accommodation standard.</p>
                <p>The setting matters as much as the logistics. The Agafay Desert and the Atlas Mountains give activities a dramatic, photogenic backdrop that a hotel car park or business-park field simply cannot offer, and Marrakech's mild climate keeps outdoor programmes viable through most of the year.</p>
                <p>Our approach starts with your objective — reward, culture-building, kick-off, CSR — and we design activities around it, rather than fitting your group into a fixed activity list.</p>
            </div>
        </div>
    </div>
</section>

{{-- PROCESS --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">Planning Process</span>
                    <h2 class="sec-title">How We Build Your Programme, Step by Step</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $steps = [
                ['n'=>'01','title'=>'Brief & Objectives','body'=>'We confirm group size, dates, budget ceiling and what the programme needs to achieve.'],
                ['n'=>'02','title'=>'Activity Design','body'=>'We propose a mix of activities matched to your objective, group profile and physical ability range.'],
                ['n'=>'03','title'=>'Costed Proposal','body'=>'A single net-rate proposal covering activities, transport, meals and accommodation.'],
                ['n'=>'04','title'=>'Site Visit Option','body'=>'We can arrange a familiarisation visit before you confirm, especially for larger programmes.'],
                ['n'=>'05','title'=>'Pre-Trip Logistics','body'=>'Group lists, safety briefings, dietary requirements and run sheets are finalised.'],
                ['n'=>'06','title'=>'On-Ground Delivery','body'=>'Our team is present throughout — guides, safety supervision and real-time problem solving.'],
            ];
            @endphp
            @foreach($steps as $s)
            <div class="col-sm-6 col-lg-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-size:1.6rem;font-weight:800;color:var(--theme-color);opacity:.35;margin-bottom:8px;">{{ $s['n'] }}</div>
                    <div style="font-weight:700;margin-bottom:6px;">{{ $s['title'] }}</div>
                    <div style="font-size:.88rem;color:#666;">{{ $s['body'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SERVICE HIGHLIGHTS --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">Service Highlights</span>
                    <h2 class="sec-title">What's Included in Our Team Building Service</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $services = [
                ['icon'=>'fa-mountain',          'title'=>'Atlas Mountain Challenges','body'=>'Hiking routes, orienteering and physical challenges in the Atlas foothills near Imlil.'],
                ['icon'=>'fa-truck-monster',      'title'=>'Desert Incentive Camps',    'body'=>'Agafay Desert 4x4 rallies, quad biking, camel trekking and overnight luxury camps.'],
                ['icon'=>'fa-map',                'title'=>'Medina Rally Games',        'body'=>'Escape-game style treasure hunts and team challenges through the Marrakech medina.'],
                ['icon'=>'fa-utensils',           'title'=>'Cooking Workshops',         'body'=>'Team-based Moroccan cooking classes in a riad, often paired with a shared dinner.'],
                ['icon'=>'fa-seedling',           'title'=>'CSR & Sustainability',      'body'=>'Tree-planting, school equipment drives and cooperative workshops for purpose-driven days.'],
                ['icon'=>'fa-glass-cheers',       'title'=>'Gala Dinners & Evenings',   'body'=>'Themed dinners in riads, desert camps or private venues to close the programme.'],
            ];
            @endphp
            @foreach($services as $s)
            <div class="col-sm-6 col-lg-4">
                <div style="display:flex;gap:14px;align-items:flex-start;padding:18px;">
                    <div style="width:44px;height:44px;background:var(--theme-color);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fa-solid {{ $s['icon'] }}" style="color:#fff;font-size:1.1rem;"></i>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:.95rem;margin-bottom:4px;">{{ $s['title'] }}</div>
                        <div style="font-size:.88rem;color:#555;">{{ $s['body'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- EXAMPLE SCENARIOS --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">Example Scenarios</span>
                    <h2 class="sec-title">How Companies Use This Service</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">80-Person Sales Incentive Trip</div>
                    <p style="font-size:.9rem;color:#666;">A European sales division rewards its top-performing team with a four-day trip combining an Agafay Desert 4x4 rally, a gala dinner under the stars and free time in Marrakech.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">25-Person Leadership Offsite</div>
                    <p style="font-size:.9rem;color:#666;">A leadership team combines a strategy workshop with an Atlas Mountain hiking challenge and a riad cooking class to reset before the next planning cycle.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">CSR Team Building Day</div>
                    <p style="font-size:.9rem;color:#666;">A regional office runs a half-day tree-planting session with a local cooperative, followed by a medina rally game that splits staff into mixed-department teams.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- LEAD FORM --}}
<section class="space" id="teambuilding-enquiry">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">Get a Proposal</span>
                    <h2 class="sec-title">Talk With Our Team Building & Incentive Team</h2>
                    <p>Tell us your group size, objective and dates — we respond within 24 hours with an activity plan and a costed proposal.</p>
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

                <form action="{{ route('contact.submit') }}" method="POST" class="form-style1" novalidate>
                    @csrf
                    <input type="hidden" name="enquiry_type" value="Team Building & Incentive">
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label for="tb_name" style="font-weight:600;margin-bottom:4px;display:block;">Full Name *</label>
                            <input id="tb_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your full name" value="{{ old('name') }}" required autocomplete="name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tb_company" style="font-weight:600;margin-bottom:4px;display:block;">Company / Organization *</label>
                            <input id="tb_company" name="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" placeholder="Your company or organization" value="{{ old('nationality') }}" required />
                            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tb_email" style="font-weight:600;margin-bottom:4px;display:block;">Business Email *</label>
                            <input id="tb_email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@company.com" value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tb_phone" style="font-weight:600;margin-bottom:4px;display:block;">Phone / WhatsApp *</label>
                            <input id="tb_phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="+1 / +44 / +33..." value="{{ old('phone') }}" required autocomplete="tel" />
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tb_date" style="font-weight:600;margin-bottom:4px;display:block;">Preferred Dates *</label>
                            <input id="tb_date" name="arrival_date" type="text" class="form-control @error('arrival_date') is-invalid @enderror" placeholder="Select programme date" value="{{ old('arrival_date') }}" required readonly />
                            @error('arrival_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tb_pax" style="font-weight:600;margin-bottom:4px;display:block;">Group Size *</label>
                            <input id="tb_pax" name="adults" type="number" min="1" class="form-control @error('adults') is-invalid @enderror" placeholder="Number of participants" value="{{ old('adults') }}" required />
                            @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tb_duration" style="font-weight:600;margin-bottom:4px;display:block;">Programme Duration (Days) *</label>
                            <input id="tb_duration" name="duration_days" type="number" min="1" class="form-control @error('duration_days') is-invalid @enderror" placeholder="Number of days" value="{{ old('duration_days') }}" required />
                            @error('duration_days')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label style="font-weight:600;margin-bottom:4px;display:block;">Activity Type</label>
                            <select name="children" class="form-control" style="height:56px;">
                                <option value="0" {{ old('children') == '0' ? 'selected' : '' }}>Desert Incentive Camp</option>
                                <option value="1" {{ old('children') == '1' ? 'selected' : '' }}>Atlas Mountain Challenge</option>
                                <option value="2" {{ old('children') == '2' ? 'selected' : '' }}>Medina Rally Game</option>
                                <option value="3" {{ old('children') == '3' ? 'selected' : '' }}>Cooking Workshop</option>
                                <option value="4" {{ old('children') == '4' ? 'selected' : '' }}>CSR / Sustainability Activity</option>
                                <option value="5" {{ old('children') == '5' ? 'selected' : '' }}>Mixed Programme / Other</option>
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label for="tb_brief" style="font-weight:600;margin-bottom:4px;display:block;">Programme Brief *</label>
                            <textarea id="tb_brief" name="travel_ideas" class="form-control @error('travel_ideas') is-invalid @enderror" placeholder="Describe your objective: reward trip, offsite, kick-off, CSR day, budget range..." rows="5" required>{{ old('travel_ideas') }}</textarea>
                            @error('travel_ideas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <div style="background:#f8f8f8;border-radius:8px;padding:14px 18px;font-size:.88rem;color:#555;margin-bottom:8px;">
                                <i class="fa-solid fa-lock me-2" style="color:var(--theme-color);"></i>
                                Your enquiry is 100% confidential and reviewed by our team building team directly.
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
</section>

{{-- FAQ --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">FAQ</span>
                    <h2 class="sec-title">Frequently Asked Questions — Team Building & Incentive Travel</h2>
                </div>
                <div class="accordion accordion-style1" id="tbFaq">
                <style>
                    #tbFaq .accordion-button{padding-right:60px;font-size:1rem;color:var(--title-color);}
                    #tbFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #tbFaq .accordion-body{font-size:.92rem;}
                </style>
                    @php
                    $faqs = [
                        ['q'=>'What team building activities can you organise in Marrakech?','a'=>'We run Atlas Mountain challenges, 4x4 rally games in the Agafay Desert, quad biking, camel trekking, medina treasure hunts, cooking workshops in a riad, and CSR activities such as tree planting or school equipment drives. Programmes are usually combined — for example a morning rally followed by a desert camp dinner.'],
                        ['q'=>'How many people can you handle for an incentive trip?','a'=>'We regularly organise programmes from small executive groups of 10 to incentive trips of 200 or more, splitting large groups into activity waves so logistics and safety briefings stay manageable.'],
                        ['q'=>'Is Marrakech safe for outdoor team building activities?','a'=>'Yes. All outdoor activities run with licensed operators, briefed guides and insurance cover appropriate to the activity. We build weather contingency options into every itinerary involving mountain or desert terrain.'],
                        ['q'=>'Can you accommodate dietary and cultural requirements for large groups?','a'=>'Yes. We collect dietary and cultural requirements at the planning stage and brief caterers accordingly, including halal, vegetarian, vegan and allergen-specific menus for gala dinners and desert camps.'],
                        ['q'=>'How far in advance should we book an incentive trip to Morocco?','a'=>'For groups above 50 people, 3 to 5 months gives comfortable room to secure accommodation blocks and activity providers, particularly in peak season (March to May and September to November). Smaller groups can often be arranged within 4 to 6 weeks.'],
                        ['q'=>'Do you offer CSR and sustainability-focused activities?','a'=>'Yes. Common options include tree-planting sessions with local cooperatives, school equipment or supply drives, and workshops run with women\'s cooperatives, which can be built into a half-day or full-day CSR module alongside other activities.'],
                        ['q'=>'What is included in a team building or incentive proposal?','a'=>'A typical proposal covers activity design and timings, transport, guides and equipment, accommodation and meals, and a costed budget quoted net, so your team retains full control of client-facing pricing where relevant.'],
                        ['q'=>'Why choose Marrakech over a European destination for an incentive trip?','a'=>'Marrakech is under four hours from most major European hubs, offers a favourable exchange rate against the euro and pound, and provides dramatic Atlas Mountain and desert backdrops that are difficult to match at a comparable cost in Western Europe.'],
                    ];
                    @endphp
                    @foreach($faqs as $i => $faq)
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#tbFaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}" aria-controls="tbFaq{{ $i }}">
                                {{ $faq['q'] }}
                            </button>
                        </h3>
                        <div id="tbFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#tbFaq">
                            <div class="accordion-body">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CROSS-LINKS --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                <h3 class="sec-title mb-3" style="font-size:1.4rem;">Related DMC Services</h3>
                <p>Combining a conference with a reward programme? See our <a href="{{ route('meetings-conventions.management') }}">meetings & conventions management</a> and <a href="{{ route('events-production.morocco') }}">events production</a> services. For the complete range of ground services, see our <a href="{{ route('dmc.marrakech') }}">DMC Marrakech</a> overview, or browse <a href="{{ route('tours.multi_day') }}">multi-day tour packages</a> for pre- or post-programme extensions.</p>
            </div>
        </div>
    </div>
</section>

{{-- FINAL CTA --}}
<section style="background:#181613;padding:64px 0;">
    <div class="container text-center">
        <h2 style="color:#fff;font-size:2rem;margin-bottom:12px;">Plan Your Marrakech Team Building Programme</h2>
        <p style="color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 28px;">
            Atlas Mountain challenges, desert incentive camps and on-ground delivery — talk with our team building and incentive team today.
        </p>
        <div class="row g-3 justify-content-center">
            <div class="col-12 col-sm-auto">
                <a href="#teambuilding-enquiry" class="vs-btn d-block">Request a Proposal</a>
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
        flatpickr('#tb_date', { mode: 'single', dateFormat: 'Y-m-d', minDate: 'today' });
        const alert = document.querySelector('#teambuilding-enquiry .alert');
        if (alert) { alert.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
    });
</script>
@endpush

@endsection
