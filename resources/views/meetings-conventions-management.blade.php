@extends('layouts.app2')

@section('title', $title ?? 'Meetings & Conventions Management Marrakech | Morocco Quest DMC')
@section('description', $description ?? 'Professional conference and convention management in Marrakech. Venue sourcing, AV production, delegate logistics and on-site coordination for corporate meetings across Morocco.')
@section('keywords', is_array($keywords ?? null) ? implode(', ', $keywords) : ($keywords ?? 'meetings and conventions marrakech, conference management morocco, convention management marrakech'))

@push('jsonld')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Meetings and Conventions Management",
    "name": "Meetings & Conventions Management — Morocco Quest DMC",
    "description": "Morocco Quest plans and manages corporate meetings, conferences and conventions in Marrakech and across Morocco, from venue sourcing to on-site delegate coordination.",
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
    "url": "{{ url('/meetings-conventions-management') }}"
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "DMC", "item": "{{ url('/dmc-marrakech') }}" },
        { "@type": "ListItem", "position": 3, "name": "Meetings & Conventions Management", "item": "{{ url('/meetings-conventions-management') }}" }
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
            "name": "What does a meetings and conventions management company do in Marrakech?",
            "acceptedAnswer": { "@type": "Answer", "text": "A meetings and conventions management partner handles every operational layer of a corporate meeting: shortlisting and negotiating venues, sourcing AV and simultaneous translation equipment, contracting hotels for delegate blocks, coordinating transfers, and managing on-site registration and room-flow on the meeting days themselves." }
        },
        {
            "@type": "Question",
            "name": "How far in advance should we book a conference venue in Marrakech?",
            "acceptedAnswer": { "@type": "Answer", "text": "For groups above 150 delegates, 6 to 9 months is a safe planning window, particularly for peak season (October to May). Smaller board meetings and executive committees can often be confirmed within 6 to 8 weeks, subject to venue availability." }
        },
        {
            "@type": "Question",
            "name": "Can Morocco Quest manage multilingual conferences?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. We regularly source simultaneous interpretation booths and interpreters in English, French, Spanish and Arabic, and our on-site coordination team operates in all four languages." }
        },
        {
            "@type": "Question",
            "name": "What size of meetings can you handle in Marrakech?",
            "acceptedAnswer": { "@type": "Answer", "text": "We manage everything from 15-person board meetings in private riads to 800-delegate conventions in purpose-built convention centres. Venue selection is matched to your delegate count, format and budget." }
        },
        {
            "@type": "Question",
            "name": "Do you handle hybrid and streamed meetings?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, we work with AV partners who provide live-streaming, hybrid stage setups and multi-camera production for organisations that need to broadcast sessions to remote attendees." }
        },
        {
            "@type": "Question",
            "name": "What is included in a meeting management proposal?",
            "acceptedAnswer": { "@type": "Answer", "text": "A typical proposal covers venue options with floor plans, AV and technical costings, accommodation rates for delegate blocks, ground transport, catering options, and a day-by-day run sheet. Pricing is quoted net, so you retain full control of your client-facing budget." }
        },
        {
            "@type": "Question",
            "name": "Can you organise site inspections before we confirm a venue?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. We arrange familiarisation trips to Marrakech so meeting planners and PCOs can walk the venue, meet the hotel operations team, and confirm technical capabilities before signing a contract." }
        },
        {
            "@type": "Question",
            "name": "Why hold a corporate meeting in Marrakech instead of a European city?",
            "acceptedAnswer": { "@type": "Answer", "text": "Marrakech offers direct flight access from most major European hubs, a lower cost base for venues and catering than Western Europe, and a destination that functions as an incentive in itself — delegates arrive for a meeting and leave with a memorable trip." }
        }
    ]
}
</script>
@endpush

@section('content')

{{-- HERO --}}
<section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/Moroccan-Palace-Restaurant-Elegant-Dining-Setup.webp') }}">
    <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="" class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
    <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="" class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">Meetings & Conventions Management</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        Venue sourcing, AV production and delegate logistics —<br>
                        full-service conference management in Marrakech.
                    </p>
                </div>
                <div class="breadcrumb-menu">
                    <ul class="custom-ul">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('dmc.marrakech') }}">DMC</a></li>
                        <li>Meetings & Conventions</li>
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
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">800</div><div style="font-size:.85rem;opacity:.9;">Max delegate capacity sourced</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">4</div><div style="font-size:.85rem;opacity:.9;">Working languages on-site</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">24/7</div><div style="font-size:.85rem;opacity:.9;">On-site coordination</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">100%</div><div style="font-size:.85rem;opacity:.9;">Net-rate transparency</div></div>
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
                    <span class="sec-subtitle style-2">Conference & Convention Management</span>
                    <h2 class="sec-title">Corporate Meetings, Managed From Brief to Breakdown</h2>
                </div>
                <p>Running a conference in a destination you don't know is a logistics risk. Contracts, technical riders, catering menus and transport schedules all need a local operator who can be on-site, not just on email.</p>
                <p>Morocco Quest manages <strong>meetings and conventions in Marrakech</strong> for corporate clients, associations and professional congress organizers (PCOs). We handle venue negotiation, AV and staging, delegate accommodation blocks, transport, and full on-site coordination — so your team can focus on the agenda, not the logistics.</p>
                <ul class="custom-ul mt-3" style="list-style:none;padding:0;">
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Venue shortlisting matched to delegate count and format</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> AV, staging and simultaneous interpretation sourcing</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Delegate accommodation blocks and rooming lists</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> On-site registration desk and room-flow management</li>
                </ul>
                <a href="#meetings-enquiry" class="vs-btn mt-4">Request a Proposal</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/Moroccan-Palace-Restaurant-Elegant-Dining-Setup.webp') }}"
                     alt="Conference venue setup in Marrakech for corporate meetings management"
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
                    <h2 class="sec-title">Built for Planners Who Need a Local Operator on the Ground</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $audiences = [
                ['icon'=>'fa-building',        'title'=>'Corporate Head Offices',  'body'=>'Annual sales kick-offs, board meetings and leadership offsites that need a discreet, well-run venue.'],
                ['icon'=>'fa-people-group',    'title'=>'Associations & PCOs',     'body'=>'Professional congress organizers running multi-day conventions with parallel sessions and exhibitor space.'],
                ['icon'=>'fa-handshake',       'title'=>'Event & Meeting Agencies','body'=>'International agencies who need a trusted ground partner for a Morocco leg of a global programme.'],
                ['icon'=>'fa-briefcase',       'title'=>'Government & NGOs',       'body'=>'Institutional meetings requiring formal protocol, security coordination and multilingual support.'],
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
                <img src="{{ asset('assets/img/Moroccan-Riad-Pool-Night-View-Arch-Design.webp') }}"
                     alt="Riad venue used for executive meetings and delegate dinners in Marrakech"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <div class="title-area">
                    <span class="sec-subtitle style-2">Why Marrakech</span>
                    <h2 class="sec-title">A Destination That Works Harder Than a Conference Room</h2>
                </div>
                <p>Marrakech connects directly to most major European hubs in under four hours, which keeps travel time — and travel budgets — manageable for international delegates. Venue and catering costs sit well below Western European equivalents, which matters when a board is comparing destination options line by line.</p>
                <p>Unlike a generic business-park hotel, Marrakech gives delegates a reason to extend their stay: riad dinners, Atlas Mountain excursions and medina experiences that double as informal networking time. A well-run meeting here becomes something delegates remember, not just attend.</p>
                <p>Our approach starts with your brief — delegate count, format, budget ceiling and dates — and returns a shortlist of two or three venues with real floor plans and costed AV packages, not a generic brochure.</p>
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
                    <h2 class="sec-title">How We Manage Your Meeting, Step by Step</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $steps = [
                ['n'=>'01','title'=>'Brief & Objectives','body'=>'We confirm delegate count, format, dates, budget ceiling and any protocol requirements.'],
                ['n'=>'02','title'=>'Venue Shortlist','body'=>'We propose two to three venues matched to your brief, with floor plans and technical specs.'],
                ['n'=>'03','title'=>'Costed Proposal','body'=>'A single net-rate proposal covering venue, AV, accommodation, catering and transport.'],
                ['n'=>'04','title'=>'Contracting & Site Visit','body'=>'We negotiate terms and can arrange a familiarisation trip before you sign.'],
                ['n'=>'05','title'=>'Pre-Event Logistics','body'=>'Rooming lists, delegate communication, technical riders and run sheets are finalised.'],
                ['n'=>'06','title'=>'On-Site Delivery','body'=>'Our team is present throughout — registration, room flow, AV checks and issue resolution.'],
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
                    <h2 class="sec-title">What's Included in Our Meeting Management Service</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $services = [
                ['icon'=>'fa-map-location-dot', 'title'=>'Venue Sourcing',        'body'=>'Hotels, convention centres, riads and outdoor venues — matched to capacity and budget.'],
                ['icon'=>'fa-microphone-lines',  'title'=>'AV & Staging',          'body'=>'Sound, lighting, LED screens, staging and simultaneous interpretation booths.'],
                ['icon'=>'fa-bed',               'title'=>'Delegate Accommodation','body'=>'Room blocks, rooming lists and rate negotiation across partner hotels.'],
                ['icon'=>'fa-bus',               'title'=>'Ground Transport',      'body'=>'Airport transfers, venue shuttles and executive vehicles for VIP delegates.'],
                ['icon'=>'fa-utensils',          'title'=>'Catering & Gala Dinners','body'=>'Coffee breaks, working lunches and themed gala evenings in riads or desert venues.'],
                ['icon'=>'fa-clipboard-check',   'title'=>'On-Site Coordination',  'body'=>'A dedicated team present for registration, room flow and real-time problem solving.'],
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
                    <div style="font-weight:700;margin-bottom:8px;">200-Delegate Annual Convention</div>
                    <p style="font-size:.9rem;color:#666;">A European association holds its annual congress in a Marrakech convention centre, with breakout rooms, an exhibitor hall and a closing gala dinner in a private riad.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">40-Person Board Meeting</div>
                    <p style="font-size:.9rem;color:#666;">A multinational's leadership team meets in a private riad for a two-day strategy offsite, with full-day AV support and a desert dinner on the closing night.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">Hybrid Regional Summit</div>
                    <p style="font-size:.9rem;color:#666;">A regional sales summit streams keynote sessions to remote offices while 120 in-person delegates attend breakout workshops on-site.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- LEAD FORM --}}
<section class="space" id="meetings-enquiry">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">Get a Proposal</span>
                    <h2 class="sec-title">Talk With Our Meetings & Conventions Team</h2>
                    <p>Tell us your delegate count, format and dates — we respond within 24 hours with venue options and a costed proposal.</p>
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
                    <input type="hidden" name="enquiry_type" value="Meetings & Conventions">
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label for="mc_name" style="font-weight:600;margin-bottom:4px;display:block;">Full Name *</label>
                            <input id="mc_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your full name" value="{{ old('name') }}" required autocomplete="name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="mc_company" style="font-weight:600;margin-bottom:4px;display:block;">Company / Organization *</label>
                            <input id="mc_company" name="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" placeholder="Your company or organization" value="{{ old('nationality') }}" required />
                            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="mc_email" style="font-weight:600;margin-bottom:4px;display:block;">Business Email *</label>
                            <input id="mc_email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@company.com" value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="mc_phone" style="font-weight:600;margin-bottom:4px;display:block;">Phone / WhatsApp *</label>
                            <input id="mc_phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="+1 / +44 / +33..." value="{{ old('phone') }}" required autocomplete="tel" />
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="mc_date" style="font-weight:600;margin-bottom:4px;display:block;">Preferred Dates *</label>
                            <input id="mc_date" name="arrival_date" type="text" class="form-control @error('arrival_date') is-invalid @enderror" placeholder="Select meeting date" value="{{ old('arrival_date') }}" required readonly />
                            @error('arrival_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="mc_pax" style="font-weight:600;margin-bottom:4px;display:block;">Delegate Count *</label>
                            <input id="mc_pax" name="adults" type="number" min="1" class="form-control @error('adults') is-invalid @enderror" placeholder="Number of delegates" value="{{ old('adults') }}" required />
                            @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="mc_duration" style="font-weight:600;margin-bottom:4px;display:block;">Meeting Duration (Days) *</label>
                            <input id="mc_duration" name="duration_days" type="number" min="1" class="form-control @error('duration_days') is-invalid @enderror" placeholder="Number of days" value="{{ old('duration_days') }}" required />
                            @error('duration_days')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label style="font-weight:600;margin-bottom:4px;display:block;">Meeting Format</label>
                            <select name="children" class="form-control" style="height:56px;">
                                <option value="0" {{ old('children') == '0' ? 'selected' : '' }}>Board Meeting</option>
                                <option value="1" {{ old('children') == '1' ? 'selected' : '' }}>Conference</option>
                                <option value="2" {{ old('children') == '2' ? 'selected' : '' }}>Convention</option>
                                <option value="3" {{ old('children') == '3' ? 'selected' : '' }}>Hybrid / Streamed</option>
                                <option value="4" {{ old('children') == '4' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label for="mc_brief" style="font-weight:600;margin-bottom:4px;display:block;">Meeting Brief *</label>
                            <textarea id="mc_brief" name="travel_ideas" class="form-control @error('travel_ideas') is-invalid @enderror" placeholder="Describe your meeting: format, AV needs, accommodation requirements, budget range..." rows="5" required>{{ old('travel_ideas') }}</textarea>
                            @error('travel_ideas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <div style="background:#f8f8f8;border-radius:8px;padding:14px 18px;font-size:.88rem;color:#555;margin-bottom:8px;">
                                <i class="fa-solid fa-lock me-2" style="color:var(--theme-color);"></i>
                                Your enquiry is 100% confidential and reviewed by our meetings team directly.
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
                    <h2 class="sec-title">Frequently Asked Questions — Meetings & Conventions</h2>
                </div>
                <div class="accordion accordion-style1" id="mcFaq">
                <style>
                    #mcFaq .accordion-button{padding-right:60px;font-size:1rem;color:var(--title-color);}
                    #mcFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #mcFaq .accordion-body{font-size:.92rem;}
                </style>
                    @php
                    $faqs = [
                        ['q'=>'What does a meetings and conventions management company do in Marrakech?','a'=>'A meetings and conventions management partner handles every operational layer of a corporate meeting: shortlisting and negotiating venues, sourcing AV and simultaneous translation equipment, contracting hotels for delegate blocks, coordinating transfers, and managing on-site registration and room-flow on the meeting days themselves.'],
                        ['q'=>'How far in advance should we book a conference venue in Marrakech?','a'=>'For groups above 150 delegates, 6 to 9 months is a safe planning window, particularly for peak season (October to May). Smaller board meetings and executive committees can often be confirmed within 6 to 8 weeks, subject to venue availability.'],
                        ['q'=>'Can Morocco Quest manage multilingual conferences?','a'=>'Yes. We regularly source simultaneous interpretation booths and interpreters in English, French, Spanish and Arabic, and our on-site coordination team operates in all four languages.'],
                        ['q'=>'What size of meetings can you handle in Marrakech?','a'=>'We manage everything from 15-person board meetings in private riads to 800-delegate conventions in purpose-built convention centres. Venue selection is matched to your delegate count, format and budget.'],
                        ['q'=>'Do you handle hybrid and streamed meetings?','a'=>'Yes, we work with AV partners who provide live-streaming, hybrid stage setups and multi-camera production for organisations that need to broadcast sessions to remote attendees.'],
                        ['q'=>'What is included in a meeting management proposal?','a'=>'A typical proposal covers venue options with floor plans, AV and technical costings, accommodation rates for delegate blocks, ground transport, catering options, and a day-by-day run sheet. Pricing is quoted net, so you retain full control of your client-facing budget.'],
                        ['q'=>'Can you organise site inspections before we confirm a venue?','a'=>'Yes. We arrange familiarisation trips to Marrakech so meeting planners and PCOs can walk the venue, meet the hotel operations team, and confirm technical capabilities before signing a contract.'],
                        ['q'=>'Why hold a corporate meeting in Marrakech instead of a European city?','a'=>'Marrakech offers direct flight access from most major European hubs, a lower cost base for venues and catering than Western Europe, and a destination that functions as an incentive in itself — delegates arrive for a meeting and leave with a memorable trip.'],
                    ];
                    @endphp
                    @foreach($faqs as $i => $faq)
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#mcFaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}" aria-controls="mcFaq{{ $i }}">
                                {{ $faq['q'] }}
                            </button>
                        </h3>
                        <div id="mcFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#mcFaq">
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
                <p>Planning a meeting that also needs delegate activities? See our <a href="{{ route('team-building.marrakech') }}">team building & incentive travel</a> and <a href="{{ route('events-production.morocco') }}">events production</a> services. For association congresses with an exhibitor hall, visit <a href="{{ route('congress-organization.morocco') }}">professional congress organization</a>. For the complete range of ground services, see our <a href="{{ route('dmc.marrakech') }}">DMC Marrakech</a> overview, or browse <a href="{{ route('tours.multi_day') }}">multi-day tour packages</a> for pre- or post-meeting delegate excursions.</p>
            </div>
        </div>
    </div>
</section>

{{-- FINAL CTA --}}
<section style="background:#181613;padding:64px 0;">
    <div class="container text-center">
        <h2 style="color:#fff;font-size:2rem;margin-bottom:12px;">Plan Your Marrakech Meeting With a Local Team</h2>
        <p style="color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 28px;">
            Venue sourcing, AV production and on-site delivery — talk with our meetings and conventions team today.
        </p>
        <div class="row g-3 justify-content-center">
            <div class="col-12 col-sm-auto">
                <a href="#meetings-enquiry" class="vs-btn d-block">Request a Proposal</a>
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
        flatpickr('#mc_date', { mode: 'single', dateFormat: 'Y-m-d', minDate: 'today' });
        const alert = document.querySelector('#meetings-enquiry .alert');
        if (alert) { alert.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
    });
</script>
@endpush

@endsection
