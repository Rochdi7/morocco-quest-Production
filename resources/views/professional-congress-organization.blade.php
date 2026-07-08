@extends('layouts.app2')

@section('title', $title ?? 'Professional Congress Organizer Morocco | PCO Marrakech | Morocco Quest DMC')
@section('description', $description ?? 'Professional Congress Organizer services in Morocco. Abstract management, scientific programme support, sponsor and exhibitor management for medical and scientific congresses.')
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
            "name": "What does a Professional Congress Organizer (PCO) do that a meeting planner doesn't?",
            "acceptedAnswer": { "@type": "Answer", "text": "A PCO manages the parts of a congress that are specific to associations and scientific bodies: abstract submission and peer-review platforms, liaison with the scientific committee on programme content, CME/CPD accreditation paperwork, sponsor and exhibitor prospectus sales, and registration systems built around delegate categories and membership rates. A standard meeting planner sources a venue and books rooms; a PCO also runs the academic and commercial machinery around the event." }
        },
        {
            "@type": "Question",
            "name": "Which organisations typically need a PCO in Morocco?",
            "acceptedAnswer": { "@type": "Answer", "text": "Medical and scientific societies, academic bodies and professional federations that run an annual or biennial congress. Most are volunteer-led committees who need continuity of operational knowledge from one edition to the next, since board members and local organising committees rotate." }
        },
        {
            "@type": "Question",
            "name": "Can Morocco Quest support a congress bid before the destination is confirmed?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. We prepare bid documents, venue capacity letters, indicative budgets and destination presentations for associations pitching Marrakech to their international board or general assembly ahead of a future congress edition." }
        },
        {
            "@type": "Question",
            "name": "How does abstract management work for a congress in Marrakech?",
            "acceptedAnswer": { "@type": "Answer", "text": "We set up an online abstract submission platform, manage the peer-review workflow with your scientific committee, track acceptance and rejection notifications, and compile the final programme and abstract book ready for CME/CPD accreditation submission." }
        },
        {
            "@type": "Question",
            "name": "Do you manage sponsor and exhibitor sales for the congress?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. We build the sponsorship and exhibitor prospectus, track sales against your revenue target, manage exhibitor logistics such as booth allocation and shell-scheme build, and follow up on sponsor fulfilment obligations such as branding and session credits." }
        },
        {
            "@type": "Question",
            "name": "What size of congress can you organise in Marrakech?",
            "acceptedAnswer": { "@type": "Answer", "text": "We handle congresses from around 150 delegates with a single plenary track up to 1,000-plus delegate international meetings with parallel sessions, a poster hall and a full exhibition floor." }
        },
        {
            "@type": "Question",
            "name": "How far in advance should an association start planning a congress in Morocco?",
            "acceptedAnswer": { "@type": "Answer", "text": "For an international congress above 400 delegates, 12 to 18 months is a realistic window, since venue contracting, abstract timelines and sponsor sales all run on fixed academic calendars. Regional congresses under 300 delegates can be planned in 6 to 9 months." }
        },
        {
            "@type": "Question",
            "name": "Can you provide continuity across multiple congress editions?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, this is one of the core reasons associations retain a PCO. As local organising committees and board members change between editions, we retain the registration data, sponsor relationships, financial records and process documentation so each new edition doesn't start from zero." }
        },
        {
            "@type": "Question",
            "name": "Why hold a medical or scientific congress in Marrakech rather than a Western European city?",
            "acceptedAnswer": { "@type": "Answer", "text": "Marrakech has direct flight access from Europe, the Middle East and increasingly Africa, venue and accommodation costs that are meaningfully lower than Western congress cities, and a growing track record of hosting international medical and scientific meetings." }
        },
        {
            "@type": "Question",
            "name": "Do you handle registration and badge production on-site?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. We run the online registration system, generate delegate badges with category-based access control, and staff the on-site registration desk for check-in, on-the-day registration and speaker or press accreditation." }
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
                    <h1 class="breadcrumb-title">Professional Congress Organization</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        Abstract management, scientific programme support and sponsor logistics —<br>
                        PCO services for medical and scientific associations in Morocco.
                    </p>
                </div>
                <div class="breadcrumb-menu">
                    <ul class="custom-ul">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('dmc.marrakech') }}">DMC</a></li>
                        <li>Professional Congress Organization</li>
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
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">1,000+</div><div style="font-size:.85rem;opacity:.9;">Max delegate capacity sourced</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">4</div><div style="font-size:.85rem;opacity:.9;">Working languages on-site</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">12-18</div><div style="font-size:.85rem;opacity:.9;">Months typical planning lead time</div></div>
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
                    <span class="sec-subtitle style-2">Professional Congress Organization</span>
                    <h2 class="sec-title">A PCO Partner for Your Association's Congress in Morocco</h2>
                </div>
                <p>A congress is not a meeting with a bigger guest list. It has its own machinery — abstract submission and peer review, a scientific committee that needs coordinating across time zones, sponsors who expect fulfilment on their contracts, and delegates who need to see the programme, not the logistics behind it.</p>
                <p>Morocco Quest works as <strong>Professional Congress Organizer (PCO) in Morocco</strong> for medical societies, scientific associations and professional federations. We run the operational and commercial layers of your congress — registration and abstract platforms, sponsor and exhibitor management, venue and AV coordination — while your scientific committee stays focused on the programme.</p>
                <ul class="custom-ul mt-3" style="list-style:none;padding:0;">
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Abstract submission and peer-review platform setup</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Sponsor and exhibitor prospectus management</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Registration systems and badge/access control</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Continuity of institutional knowledge across editions</li>
                </ul>
                <a href="#congress-enquiry" class="vs-btn mt-4">Request a Proposal</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/Moroccan-Palace-Restaurant-Elegant-Dining-Setup.webp') }}"
                     alt="Congress venue setup in Marrakech for professional congress organization"
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
                    <h2 class="sec-title">Built for Associations Running Their Own Congress</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $audiences = [
                ['icon'=>'fa-user-doctor',     'title'=>'Medical Societies',        'body'=>'National and regional medical associations running an annual congress with CME-accredited sessions.'],
                ['icon'=>'fa-flask',           'title'=>'Scientific Associations',  'body'=>'Research societies coordinating abstract review, poster sessions and a multi-track scientific programme.'],
                ['icon'=>'fa-graduation-cap',  'title'=>'Academic Bodies',          'body'=>'University departments and academic federations hosting a biennial international conference.'],
                ['icon'=>'fa-people-group',    'title'=>'Professional Federations', 'body'=>'Umbrella bodies whose annual general assembly runs alongside a professional development congress.'],
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
                <img src="{{ asset('assets/img/Moroccan-Riad-Pool-Night-View-Arch-Design.webp') }}"
                     alt="Riad venue used for congress delegate dinners and networking evenings in Marrakech"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <div class="title-area">
                    <span class="sec-subtitle style-2">Why Morocco</span>
                    <h2 class="sec-title">A Congress Destination Associations Can Justify to Their Board</h2>
                </div>
                <p>Marrakech and Casablanca connect directly to most major European hubs, several Middle Eastern gateways and a growing number of African capitals, which widens the pool of delegates who can reach the congress without a connecting flight. Morocco's profile as an international congress destination has been building steadily, with purpose-built convention centres now hosting medical and scientific meetings that once went to Southern Europe by default.</p>
                <p>Venue, accommodation and catering costs sit well below Western European congress cities, which matters when a finance committee is comparing bid options for the next edition. It also means sponsor budgets stretch further on exhibition space and delegate hospitality.</p>
                <p>Our approach starts with your congress history — delegate numbers, abstract volume, exhibitor count and past budgets — and returns a realistic proposal built around what your association has actually run before, not a generic convention brochure.</p>
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
                    <h2 class="sec-title">How We Organise Your Congress, Step by Step</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $steps = [
                ['n'=>'01','title'=>'Bid & Venue Selection','body'=>'We support the destination bid where needed, then shortlist venues matched to delegate count, tracks and exhibition space.'],
                ['n'=>'02','title'=>'Registration & Abstract Setup','body'=>'Online registration and abstract submission platforms are configured around your delegate categories and review workflow.'],
                ['n'=>'03','title'=>'Sponsor & Exhibitor Sales','body'=>'We build the prospectus, support sales against your revenue target, and manage exhibitor logistics.'],
                ['n'=>'04','title'=>'Scientific Programme Coordination','body'=>'We liaise with your scientific committee on session scheduling, speaker confirmations and abstract-to-programme mapping.'],
                ['n'=>'05','title'=>'On-Site Delegate & Speaker Management','body'=>'Registration desk, badge issuance, speaker AV checks and session-room flow are managed throughout the congress.'],
                ['n'=>'06','title'=>'Post-Congress Reporting','body'=>'Financial reconciliation, sponsor fulfilment reports and a knowledge handover for the next edition\'s committee.'],
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
                    <h2 class="sec-title">What's Included in Our PCO Service</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $services = [
                ['icon'=>'fa-file-lines',        'title'=>'Abstract & Scientific Programme','body'=>'Abstract submission platform, peer-review workflow and programme compilation for CME/CPD accreditation.'],
                ['icon'=>'fa-id-badge',          'title'=>'Registration & Badge Systems',    'body'=>'Category-based online registration, delegate badges and access control for sessions and exhibition areas.'],
                ['icon'=>'fa-handshake',         'title'=>'Sponsor & Exhibitor Management',  'body'=>'Prospectus development, sales support, booth allocation and sponsor fulfilment tracking.'],
                ['icon'=>'fa-map-location-dot',  'title'=>'Venue & AV Coordination',         'body'=>'Convention centre sourcing, multi-track room planning and AV/staging for plenary and breakout sessions.'],
                ['icon'=>'fa-microphone-lines',  'title'=>'Speaker Logistics',                'body'=>'Speaker travel, accommodation, AV requirements and on-site briefing ahead of each session.'],
                ['icon'=>'fa-clipboard-check',   'title'=>'On-Site Congress Management',     'body'=>'A dedicated team present for registration, badge issuance, room flow and real-time issue resolution.'],
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
                    <h2 class="sec-title">How Associations Use This Service</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">Regional Medical Congress, 400 Delegates</div>
                    <p style="font-size:.9rem;color:#666;">A regional medical society runs its annual CME-accredited congress with two parallel tracks, a poster hall and an exhibitor floor of 20 pharmaceutical and device sponsors.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">International Scientific Society Annual Meeting</div>
                    <p style="font-size:.9rem;color:#666;">An international research society holds its annual meeting with 700+ delegates, abstract-driven programming across four tracks, and simultaneous interpretation for a multilingual membership.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">Multi-Year Congress Bid Support</div>
                    <p style="font-size:.9rem;color:#666;">A professional federation prepares a formal bid to bring its congress to Marrakech in two years, including venue capacity letters, indicative budgets and a board presentation.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- LEAD FORM --}}
<section class="space" id="congress-enquiry">
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

                <form action="{{ route('contact.submit') }}" method="POST" class="form-style1" novalidate>
                    @csrf
                    <input type="hidden" name="enquiry_type" value="Congress Organization">
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
                                <option value="0" {{ old('children') == '0' ? 'selected' : '' }}>Bid / Destination Selection</option>
                                <option value="1" {{ old('children') == '1' ? 'selected' : '' }}>Early Planning (12+ Months Out)</option>
                                <option value="2" {{ old('children') == '2' ? 'selected' : '' }}>Active Planning (6-12 Months Out)</option>
                                <option value="3" {{ old('children') == '3' ? 'selected' : '' }}>Final Preparations (Under 6 Months)</option>
                                <option value="4" {{ old('children') == '4' ? 'selected' : '' }}>Other</option>
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
</section>

{{-- FAQ --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">FAQ</span>
                    <h2 class="sec-title">Frequently Asked Questions — Professional Congress Organization</h2>
                </div>
                <div class="accordion accordion-style1" id="pcoFaq">
                <style>
                    #pcoFaq .accordion-button{padding-right:60px;font-size:1rem;color:var(--title-color);}
                    #pcoFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #pcoFaq .accordion-body{font-size:.92rem;}
                </style>
                    @php
                    $faqs = [
                        ['q'=>'What does a Professional Congress Organizer (PCO) do that a meeting planner doesn\'t?','a'=>'A PCO manages the parts of a congress that are specific to associations and scientific bodies: abstract submission and peer-review platforms, liaison with the scientific committee on programme content, CME/CPD accreditation paperwork, sponsor and exhibitor prospectus sales, and registration systems built around delegate categories and membership rates. A standard meeting planner sources a venue and books rooms; a PCO also runs the academic and commercial machinery around the event.'],
                        ['q'=>'Which organisations typically need a PCO in Morocco?','a'=>'Medical and scientific societies, academic bodies and professional federations that run an annual or biennial congress. Most are volunteer-led committees who need continuity of operational knowledge from one edition to the next, since board members and local organising committees rotate.'],
                        ['q'=>'Can Morocco Quest support a congress bid before the destination is confirmed?','a'=>'Yes. We prepare bid documents, venue capacity letters, indicative budgets and destination presentations for associations pitching Marrakech to their international board or general assembly ahead of a future congress edition.'],
                        ['q'=>'How does abstract management work for a congress in Marrakech?','a'=>'We set up an online abstract submission platform, manage the peer-review workflow with your scientific committee, track acceptance and rejection notifications, and compile the final programme and abstract book ready for CME/CPD accreditation submission.'],
                        ['q'=>'Do you manage sponsor and exhibitor sales for the congress?','a'=>'Yes. We build the sponsorship and exhibitor prospectus, track sales against your revenue target, manage exhibitor logistics such as booth allocation and shell-scheme build, and follow up on sponsor fulfilment obligations such as branding and session credits.'],
                        ['q'=>'What size of congress can you organise in Marrakech?','a'=>'We handle congresses from around 150 delegates with a single plenary track up to 1,000-plus delegate international meetings with parallel sessions, a poster hall and a full exhibition floor.'],
                        ['q'=>'How far in advance should an association start planning a congress in Morocco?','a'=>'For an international congress above 400 delegates, 12 to 18 months is a realistic window, since venue contracting, abstract timelines and sponsor sales all run on fixed academic calendars. Regional congresses under 300 delegates can be planned in 6 to 9 months.'],
                        ['q'=>'Can you provide continuity across multiple congress editions?','a'=>'Yes, this is one of the core reasons associations retain a PCO. As local organising committees and board members change between editions, we retain the registration data, sponsor relationships, financial records and process documentation so each new edition doesn\'t start from zero.'],
                        ['q'=>'Why hold a medical or scientific congress in Marrakech rather than a Western European city?','a'=>'Marrakech has direct flight access from Europe, the Middle East and increasingly Africa, venue and accommodation costs that are meaningfully lower than Western congress cities, and a growing track record of hosting international medical and scientific meetings.'],
                        ['q'=>'Do you handle registration and badge production on-site?','a'=>'Yes. We run the online registration system, generate delegate badges with category-based access control, and staff the on-site registration desk for check-in, on-the-day registration and speaker or press accreditation.'],
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

{{-- CROSS-LINKS --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                <h3 class="sec-title mb-3" style="font-size:1.4rem;">Related DMC Services</h3>
                <p>Planning a corporate meeting rather than an association congress? See our <a href="{{ route('meetings-conventions.management') }}">meetings & conventions management</a> service. For the complete range of ground services, see our <a href="{{ route('dmc.marrakech') }}">DMC Marrakech</a> overview, or browse <a href="{{ route('tours.multi_day') }}">multi-day tour packages</a> for pre- or post-congress delegate excursions.</p>
            </div>
        </div>
    </div>
</section>

{{-- FINAL CTA --}}
<section style="background:#181613;padding:64px 0;">
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
