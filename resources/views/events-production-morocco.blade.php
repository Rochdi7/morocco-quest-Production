@extends('layouts.app2')

@section('title', $title ?? 'Corporate Events Morocco | Event Production Marrakech | Morocco Quest DMC')
@section('description', $description ?? 'Full-service event production in Morocco: staging, lighting, sound, LED and scenography for product launches, brand activations and corporate galas in Marrakech.')
@section('keywords', is_array($keywords ?? null) ? implode(', ', $keywords) : ($keywords ?? 'corporate events morocco, event production morocco, event production marrakech'))

@push('jsonld')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Event Production and Communication",
    "name": "Events Production & Communication — Morocco Quest DMC",
    "description": "Morocco Quest produces corporate events in Marrakech and across Morocco, covering staging, lighting, sound, LED, scenography and on-site technical management for product launches, brand activations and galas.",
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
            "name": "What does an event production company do for a corporate event in Morocco?",
            "acceptedAnswer": { "@type": "Answer", "text": "An event production partner turns a creative brief into a delivered show: designing the stage and scenography, sourcing lighting and sound equipment, booking LED screens and technical crews, managing rigging and power on-site, and running the live show from load-in to strike." }
        },
        {
            "@type": "Question",
            "name": "How far in advance should we book event production services in Marrakech?",
            "acceptedAnswer": { "@type": "Answer", "text": "For a full production with custom scenography and imported equipment, 3 to 4 months gives enough time for design, quotes and freight where needed. Simpler formats — a branded dinner or a small activation — can often be produced within 4 to 6 weeks." }
        },
        {
            "@type": "Question",
            "name": "Can you produce events in unconventional venues like riads or the desert?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, this is one of our core strengths. Riads, palmeraie estates and desert camps all require site-specific power planning, rigging solutions that respect the architecture, and weather contingency for outdoor stages — we handle all of it as part of the technical production plan." }
        },
        {
            "@type": "Question",
            "name": "Do you handle live broadcast or hybrid streaming for corporate events?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. We work with broadcast crews who provide multi-camera coverage, live switching and streaming for product launches or award ceremonies that need to reach an audience beyond the room." }
        },
        {
            "@type": "Question",
            "name": "What is included in an event production proposal?",
            "acceptedAnswer": { "@type": "Answer", "text": "A typical proposal covers scenography and set design concepts, a technical plan for lighting, sound and LED, entertainment booking, crew and rigging costs, and a day-by-day production schedule from build to strike. Pricing is quoted net." }
        },
        {
            "@type": "Question",
            "name": "Can Morocco Quest source specialist equipment not available locally?",
            "acceptedAnswer": { "@type": "Answer", "text": "Where a specific rig, LED pitch or line array isn't available from local suppliers, we can arrange import of specialist equipment from Europe, coordinated with customs and freight timelines built into the production schedule." }
        },
        {
            "@type": "Question",
            "name": "How large a production can you manage in Marrakech?",
            "acceptedAnswer": { "@type": "Answer", "text": "We produce everything from 80-guest brand activations in a riad courtyard to 500-guest gala dinners and award ceremonies in convention centres or desert venues, with full staging, lighting and sound." }
        },
        {
            "@type": "Question",
            "name": "Why produce a brand event in Marrakech instead of Western Europe?",
            "acceptedAnswer": { "@type": "Answer", "text": "Marrakech offers backdrops — medina, desert, Atlas Mountains — that elevate brand storytelling in a way a hotel ballroom in Western Europe cannot, alongside production costs that generally run well below Western European equivalents and experienced local technical crews." }
        }
    ]
}
</script>
@endpush

@section('content')

{{-- HERO --}}
<section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/Luxury-Dinner-Setup-Wedding-Morocco-Outdoor-Event.webp') }}">
    <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="" class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
    <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="" class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">Events Production & Communication</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        Staging, lighting, sound and scenography —<br>
                        full-service event production for corporate audiences in Morocco.
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

{{-- TRUST BAR --}}
<section style="background:var(--theme-color);padding:22px 0;">
    <div class="container">
        <div class="row text-center gy-3">
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">500</div><div style="font-size:.85rem;opacity:.9;">Max guests produced on-site</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">3</div><div style="font-size:.85rem;opacity:.9;">Core disciplines: staging, AV, scenography</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">24/7</div><div style="font-size:.85rem;opacity:.9;">On-site technical management</div></div>
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
                    <span class="sec-subtitle style-2">Event Production & Communication</span>
                    <h2 class="sec-title">Corporate Events, Produced From Concept to Strike</h2>
                </div>
                <p>Producing a brand event in a destination you don't know means coordinating riggers, sound engineers, LED suppliers and venue managers you've never worked with, on a timeline that rarely gives you room to fix mistakes on-site.</p>
                <p>Morocco Quest produces <strong>corporate events in Morocco</strong> for brands, agencies and companies — product launches, brand activations, press events, gala dinners and award ceremonies. We handle staging and scenography, lighting and sound design, LED and video, entertainment booking, and full on-site technical management, so your team can focus on the guest experience, not the cabling.</p>
                <ul class="custom-ul mt-3" style="list-style:none;padding:0;">
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Staging, rigging and scenography built for the venue</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Lighting design, DMX control and line array sound systems</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> LED walls, video content and live broadcast support</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Entertainment booking and on-site technical direction</li>
                </ul>
                <a href="#events-enquiry" class="vs-btn mt-4">Request a Proposal</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/Luxury-Dinner-Setup-Wedding-Morocco-Outdoor-Event.webp') }}"
                     alt="Staged corporate event production setup in Marrakech with lighting and dining design"
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
                    <h2 class="sec-title">Built for Teams Who Need a Production Partner on the Ground</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $audiences = [
                ['icon'=>'fa-bullhorn',        'title'=>'Marketing & Communication Teams', 'body'=>'Launching a product or campaign and need a fully staged, on-brand moment for press and clients.'],
                ['icon'=>'fa-people-group',    'title'=>'Brand & Activation Agencies',      'body'=>'Producing an activation for a client and need a reliable local technical partner in Morocco.'],
                ['icon'=>'fa-trophy',          'title'=>'Companies Hosting Award Ceremonies','body'=>'Annual awards or recognition events that need a stage, lighting and a run of show that holds together.'],
                ['icon'=>'fa-champagne-glasses','title'=>'Anniversary & Gala Organizers',    'body'=>'Milestone celebrations that call for scenography and entertainment beyond a standard banquet.'],
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

{{-- WHY MOROCCO / OUR APPROACH --}}
<section class="space">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/Traditional-Moroccan-Dining-Event-Outdoor-Lanterns.webp') }}"
                     alt="Outdoor branded event production with lighting and lantern scenography in Morocco"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <div class="title-area">
                    <span class="sec-subtitle style-2">Why Morocco</span>
                    <h2 class="sec-title">Backdrops a Ballroom Cannot Match</h2>
                </div>
                <p>A product launch staged against the Marrakech medina, an award ceremony under Atlas Mountain silhouettes, or a gala built into a desert camp — these are settings that do part of the storytelling for you, before a single light is even rigged.</p>
                <p>Production costs in Morocco generally run below Western European equivalents for comparable staging, lighting and crew day rates, which lets the same budget stretch further into scenography or entertainment. Local technical crews here are experienced with international productions and used to working alongside foreign agencies and directors.</p>
                <p>Our approach starts with your creative brief — objectives, brand guidelines, guest count and budget ceiling — and returns a concept and technical plan matched to a venue that fits the story you're telling, not a generic function room.</p>
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
                    <h2 class="sec-title">How We Produce Your Event, Step by Step</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $steps = [
                ['n'=>'01','title'=>'Creative Brief','body'=>'We confirm objectives, brand guidelines, guest count, dates and budget ceiling.'],
                ['n'=>'02','title'=>'Concept & Scenography','body'=>'We propose a design direction — stage, set and space — matched to your brief and venue options.'],
                ['n'=>'03','title'=>'Technical Production Plan','body'=>'Lighting, sound, LED, power and rigging are specced and costed against the venue.'],
                ['n'=>'04','title'=>'On-Site Build & Rehearsal','body'=>'Load-in, rigging, technical checks and a full rehearsal before doors open.'],
                ['n'=>'05','title'=>'Live Delivery','body'=>'Our production team runs the show — cues, technical direction and real-time problem solving.'],
                ['n'=>'06','title'=>'Strike & Breakdown','body'=>'Equipment is struck, the venue is restored, and freight/return logistics are closed out.'],
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
                    <h2 class="sec-title">What's Included in Our Event Production Service</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $services = [
                ['icon'=>'fa-drafting-compass', 'title'=>'Staging & Scenography',   'body'=>'Stage design, set builds and branded environments adapted to the venue and brief.'],
                ['icon'=>'fa-lightbulb',        'title'=>'Lighting Design',         'body'=>'DMX-controlled lighting rigs, architectural uplighting and mood design for the room.'],
                ['icon'=>'fa-volume-high',       'title'=>'Sound Production',        'body'=>'Line array sound systems, mixing and technical crew for speeches, music and live performance.'],
                ['icon'=>'fa-tv',                'title'=>'LED & Video',             'body'=>'LED walls, screen content and live broadcast or streaming for hybrid audiences.'],
                ['icon'=>'fa-music',             'title'=>'Entertainment Booking',   'body'=>'Musicians, performers and MCs sourced and briefed to fit the tone of your event.'],
                ['icon'=>'fa-clipboard-check',   'title'=>'On-Site Technical Management','body'=>'A dedicated crew present for build, rehearsal, live delivery and strike.'],
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
                    <div style="font-weight:700;margin-bottom:8px;">Product Launch for 300 Guests</div>
                    <p style="font-size:.9rem;color:#666;">A global brand launches a new product line in a Marrakech venue, with a custom stage, LED backdrop and live-streamed keynote for international press and distributors.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">20th Anniversary Gala Dinner</div>
                    <p style="font-size:.9rem;color:#666;">A company marks its 20th anniversary with a themed gala in a private riad, featuring architectural lighting, a live band and a scripted run of show for speeches and awards.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">Regional Sales Awards Ceremony</div>
                    <p style="font-size:.9rem;color:#666;">A multinational's regional office hosts its annual sales awards for 150 staff, with staging, sound, a video wall for recognition reels and desert-camp dinner staging.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- LEAD FORM --}}
<section class="space" id="events-enquiry">
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

                <form action="{{ route('contact.submit') }}" method="POST" class="form-style1" novalidate>
                    @csrf
                    <input type="hidden" name="enquiry_type" value="Events Production">
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
                                <option value="2" {{ old('children') == '2' ? 'selected' : '' }}>Gala Dinner</option>
                                <option value="3" {{ old('children') == '3' ? 'selected' : '' }}>Award Ceremony</option>
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
</section>

{{-- FAQ --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">FAQ</span>
                    <h2 class="sec-title">Frequently Asked Questions — Events Production</h2>
                </div>
                <div class="accordion accordion-style1" id="epFaq">
                <style>
                    #epFaq .accordion-button{padding-right:60px;font-size:1rem;color:var(--title-color);}
                    #epFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #epFaq .accordion-body{font-size:.92rem;}
                </style>
                    @php
                    $faqs = [
                        ['q'=>'What does an event production company do for a corporate event in Morocco?','a'=>'An event production partner turns a creative brief into a delivered show: designing the stage and scenography, sourcing lighting and sound equipment, booking LED screens and technical crews, managing rigging and power on-site, and running the live show from load-in to strike.'],
                        ['q'=>'How far in advance should we book event production services in Marrakech?','a'=>'For a full production with custom scenography and imported equipment, 3 to 4 months gives enough time for design, quotes and freight where needed. Simpler formats — a branded dinner or a small activation — can often be produced within 4 to 6 weeks.'],
                        ['q'=>'Can you produce events in unconventional venues like riads or the desert?','a'=>'Yes, this is one of our core strengths. Riads, palmeraie estates and desert camps all require site-specific power planning, rigging solutions that respect the architecture, and weather contingency for outdoor stages — we handle all of it as part of the technical production plan.'],
                        ['q'=>'Do you handle live broadcast or hybrid streaming for corporate events?','a'=>'Yes. We work with broadcast crews who provide multi-camera coverage, live switching and streaming for product launches or award ceremonies that need to reach an audience beyond the room.'],
                        ['q'=>'What is included in an event production proposal?','a'=>'A typical proposal covers scenography and set design concepts, a technical plan for lighting, sound and LED, entertainment booking, crew and rigging costs, and a day-by-day production schedule from build to strike. Pricing is quoted net.'],
                        ['q'=>'Can Morocco Quest source specialist equipment not available locally?','a'=>'Where a specific rig, LED pitch or line array isn\'t available from local suppliers, we can arrange import of specialist equipment from Europe, coordinated with customs and freight timelines built into the production schedule.'],
                        ['q'=>'How large a production can you manage in Marrakech?','a'=>'We produce everything from 80-guest brand activations in a riad courtyard to 500-guest gala dinners and award ceremonies in convention centres or desert venues, with full staging, lighting and sound.'],
                        ['q'=>'Why produce a brand event in Marrakech instead of Western Europe?','a'=>'Marrakech offers backdrops — medina, desert, Atlas Mountains — that elevate brand storytelling in a way a hotel ballroom in Western Europe cannot, alongside production costs that generally run well below Western European equivalents and experienced local technical crews.'],
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

{{-- CROSS-LINKS --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                <h3 class="sec-title mb-3" style="font-size:1.4rem;">Related DMC Services</h3>
                <p>Producing an event alongside a wider corporate programme? See our <a href="{{ route('meetings-conventions.management') }}">meetings & conventions management</a> and <a href="{{ route('team-building.marrakech') }}">team building & incentive travel</a> services. For the complete range of ground services, see our <a href="{{ route('dmc.marrakech') }}">DMC Marrakech</a> overview, or browse <a href="{{ route('tours.multi_day') }}">multi-day tour packages</a> for pre- or post-event guest excursions.</p>
            </div>
        </div>
    </div>
</section>

{{-- FINAL CTA --}}
<section style="background:#181613;padding:64px 0;">
    <div class="container text-center">
        <h2 style="color:#fff;font-size:2rem;margin-bottom:12px;">Produce Your Next Event With a Local Team</h2>
        <p style="color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 28px;">
            Staging, lighting, sound and on-site delivery — talk with our events production team today.
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
