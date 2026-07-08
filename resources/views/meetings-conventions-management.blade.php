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
            "name": "How far in advance should we book a conference venue in Marrakech?",
            "acceptedAnswer": { "@type": "Answer", "text": "For groups above 150 delegates, 6 to 9 months is a safe window, particularly for peak season (October to May). Board meetings and smaller committees can often be confirmed within 6 to 8 weeks, subject to venue availability." }
        },
        {
            "@type": "Question",
            "name": "Can you manage multilingual conferences with interpretation?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. We source simultaneous interpretation booths and interpreters in English, French, Spanish and Arabic, and our on-site team works in all four languages." }
        },
        {
            "@type": "Question",
            "name": "What size of meetings can you handle?",
            "acceptedAnswer": { "@type": "Answer", "text": "Everything from 15-person board meetings in private riads to conventions above 500 delegates in purpose-built centres. Venue choice follows your delegate count and format, not the other way round." }
        },
        {
            "@type": "Question",
            "name": "Do you handle hybrid and streamed sessions?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes — we work with AV partners who provide live-streaming, hybrid stage builds and multi-camera production for sessions that need to reach remote attendees." }
        },
        {
            "@type": "Question",
            "name": "Why choose Marrakech over a European conference city?",
            "acceptedAnswer": { "@type": "Answer", "text": "Direct flights from most major European hubs under four hours, venue and catering costs below Western Europe, and a destination delegates actually want to extend their stay in — which helps attendance for voluntary conferences." }
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
                    <h1 class="breadcrumb-title">Your Conference Room Doesn't Have to Look Like a Conference Room</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        Meetings, conventions and congresses in Marrakech — planned, contracted and run by a team that's on-site, not on a spreadsheet in another country.
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

{{-- INTRO --}}
<section class="space pb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                <p style="font-size:1.1rem;color:#444;">Most meeting planners don't fail on the agenda — they fail on the fifty small logistics decisions nobody sees: the AV rider the venue can't actually meet, the delegate rooming list that arrives a week late, the gala dinner that was quoted for indoors and rains out.</p>
                <p style="font-size:1.05rem;color:#555;">Morocco Quest runs meetings and conventions in Marrakech end to end — venue contracting, staging, delegate accommodation, transport and a team physically present on your event days. You deal with one point of contact, not six vendors.</p>
                <a href="#meetings-enquiry" class="vs-btn mt-3">Talk With Our Meetings Team</a>
            </div>
        </div>
    </div>
</section>

{{-- ALTERNATING SERVICE STACK --}}
<section class="space">
    <div class="container">

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/Moroccan-Palace-Restaurant-Elegant-Dining-Setup.webp') }}"
                     alt="Conference venue in Marrakech set up for a corporate convention"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Venue Sourcing</span>
                <h2 class="sec-title" style="font-size:1.6rem;">A Shortlist You Can Actually Choose From</h2>
                <p>We don't send brochures. We send two or three venues that match your delegate count, format and budget, with real floor plans and a technical spec sheet — convention centres, five-star ballrooms, private riads for smaller committees, even outdoor venues at the edge of the Agafay desert for a closing session with a view.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5 flex-lg-row-reverse">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/Moroccan-Riad-Pool-Night-View-Arch-Design.webp') }}"
                     alt="Riad venue used for executive board meetings and delegate dinners in Marrakech"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">AV, Staging & Interpretation</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Technical Production That Matches the Rider</h2>
                <p>Sound, lighting, LED screens, staging and simultaneous interpretation booths — sourced and tested before your delegates arrive, not discovered broken on the morning of. If your programme streams to remote offices, we bring in the crew for that too.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/guide-dar-el-bacha-marrakech-tour-moroccan-culture.webp') }}"
                     alt="Delegate accommodation and transfers coordinated for a Marrakech conference"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Delegate Logistics</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Rooming Lists, Transfers, and the Boring Parts Done Right</h2>
                <p>Room blocks negotiated across partner hotels, rooming lists managed against your registration data, airport-to-venue transfers scheduled around actual flight times — the unglamorous half of a conference that determines whether delegates arrive relaxed or irritated.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 flex-lg-row-reverse">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/moroccan-traditional-dinner-event.webp') }}"
                     alt="Gala dinner event production for conference delegates in Marrakech"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">On-Site Delivery</span>
                <h2 class="sec-title" style="font-size:1.6rem;">We're in the Room, Not on a Call</h2>
                <p>Registration desk, room-flow between sessions, speaker readiness, real-time fixes when a session overruns or a shipment is late — our team is physically present for the full duration of your meeting, not a remote contact you email if something breaks.</p>
            </div>
        </div>

    </div>
</section>

{{-- COMPLETE SOLUTIONS ICON GRID --}}
<section class="space pb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="sec-subtitle">What's Covered</span>
                <h2 class="sec-title">Complete Meetings & Conventions Solutions</h2>
                <p>Every component of a corporate meeting or convention, handled under one agreement.</p>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $solutions = [
                ['icon'=>'fa-building',        'label'=>'Venue Sourcing'],
                ['icon'=>'fa-bed',             'label'=>'Delegate Accommodation'],
                ['icon'=>'fa-microphone-lines','label'=>'AV & Staging'],
                ['icon'=>'fa-language',        'label'=>'Interpretation Services'],
                ['icon'=>'fa-bus',             'label'=>'Transfers & Logistics'],
                ['icon'=>'fa-id-badge',        'label'=>'Registration & Badging'],
                ['icon'=>'fa-utensils',        'label'=>'Catering & Gala Dinners'],
                ['icon'=>'fa-headset',         'label'=>'On-Site Delivery Team'],
            ];
            @endphp
            @foreach($solutions as $s)
            <div class="col-6 col-md-3">
                <div class="text-center p-4" style="background:#fff;border:1px solid #ececec;border-radius:12px;height:100%;">
                    <i class="fa-solid {{ $s['icon'] }}" style="font-size:1.8rem;color:var(--theme-color);display:block;margin-bottom:14px;"></i>
                    <div style="font-weight:700;font-size:.92rem;text-transform:uppercase;letter-spacing:.02em;">{{ $s['label'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SIGNATURE MODULE: VENUE FORMAT MATRIX --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="sec-subtitle">Match Your Format</span>
                <h2 class="sec-title">Which Venue Type Fits Your Meeting?</h2>
                <p>A rough guide — every proposal is still built around your actual brief.</p>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $formats = [
                ['range'=>'Up to 30 delegates', 'venue'=>'Private Riad or Villa', 'body'=>'Boardroom setup, catered lunches, discreet setting — used for leadership offsites and executive committees.'],
                ['range'=>'30–150 delegates',   'venue'=>'Boutique Hotel Ballroom', 'body'=>'Theatre or classroom seating, breakout rooms available, walkable to medina restaurants for evening events.'],
                ['range'=>'150–500 delegates',  'venue'=>'5-Star Conference Hotel', 'body'=>'Full AV infrastructure on-site, dedicated exhibition space, large-format catering capability.'],
                ['range'=>'500+ delegates',     'venue'=>'Convention Centre', 'body'=>'Parallel session rooms, purpose-built exhibition halls, loading access for large stage builds.'],
            ];
            @endphp
            @foreach($formats as $f)
            <div class="col-sm-6 col-lg-3">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-size:.8rem;font-weight:700;color:var(--theme-color);text-transform:uppercase;letter-spacing:.03em;margin-bottom:8px;">{{ $f['range'] }}</div>
                    <div style="font-weight:700;margin-bottom:8px;">{{ $f['venue'] }}</div>
                    <div style="font-size:.88rem;color:#666;">{{ $f['body'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- WHY MARRAKECH + TESTIMONIAL --}}
<section class="space">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6 order-lg-2">
                <span class="sec-subtitle style-2">Why Marrakech</span>
                <h2 class="sec-title">A Destination That Works Harder Than a Business Park Hotel</h2>
                <p>Marrakech sits under four hours from most major European hubs, with venue and catering costs that stay well below Western European equivalents — a difference a board notices when comparing destination options line by line.</p>
                <p>It also gives delegates a reason to show up. A riad dinner or an Atlas Mountain excursion does more for informal networking than another hotel bar ever will, and a well-run meeting here tends to be the one people remember attending.</p>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div style="background:#fff;border-radius:12px;padding:32px;box-shadow:0 4px 24px rgba(0,0,0,.07);">
                    <div style="font-size:2.5rem;color:var(--theme-color);line-height:1;margin-bottom:12px;">"</div>
                    <p style="font-size:1.05rem;font-style:italic;color:#333;margin-bottom:20px;">
                        "We had eight months to plan a 220-delegate convention and no one on our team had worked in Morocco before. Morocco Quest gave us a venue shortlist within a week and stayed on-site for all three days — including a stage rigging issue on day two that they fixed before most delegates noticed."
                    </p>
                    <div style="display:flex;align-items:center;gap:14px;">
                        <div style="width:48px;height:48px;background:#f0f0f0;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                            <i class="fa-solid fa-user" style="color:#aaa;"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:.95rem;">Conference Manager</div>
                            <div style="font-size:.82rem;color:#777;">European Professional Association</div>
                        </div>
                        <div class="ms-auto">
                            <span style="color:var(--theme-color);">★★★★★</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- LEAD FORM --}}
<section class="space bg-theme-07" id="meetings-enquiry">
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

{{-- FAQ (trimmed) --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">FAQ</span>
                    <h2 class="sec-title">Meetings & Conventions — Common Questions</h2>
                </div>
                <div class="accordion accordion-style1" id="mcFaq">
                <style>
                    #mcFaq .accordion-button{padding-right:60px;font-size:1rem;color:var(--title-color);}
                    #mcFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #mcFaq .accordion-body{font-size:.92rem;}
                </style>
                    @php
                    $faqs = [
                        ['q'=>'How far in advance should we book a conference venue in Marrakech?','a'=>'For groups above 150 delegates, 6 to 9 months is a safe window, particularly for peak season (October to May). Board meetings and smaller committees can often be confirmed within 6 to 8 weeks, subject to venue availability.'],
                        ['q'=>'Can you manage multilingual conferences with interpretation?','a'=>'Yes. We source simultaneous interpretation booths and interpreters in English, French, Spanish and Arabic, and our on-site team works in all four languages.'],
                        ['q'=>'What size of meetings can you handle?','a'=>'Everything from 15-person board meetings in private riads to conventions above 500 delegates in purpose-built centres. Venue choice follows your delegate count and format, not the other way round.'],
                        ['q'=>'Do you handle hybrid and streamed sessions?','a'=>'Yes — we work with AV partners who provide live-streaming, hybrid stage builds and multi-camera production for sessions that need to reach remote attendees.'],
                        ['q'=>'Why choose Marrakech over a European conference city?','a'=>'Direct flights from most major European hubs under four hours, venue and catering costs below Western Europe, and a destination delegates actually want to extend their stay in — which helps attendance for voluntary conferences.'],
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
<section class="space pt-0">
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
