@extends('layouts.app2')

@section('title', $title ?? '360° Event Solutions Morocco | Integrated MICE Programmes | Morocco Quest DMC')
@section('description', $description ?? 'One DMC managing your entire multi-day corporate programme in Morocco — meetings, team building, events and gala dinners under a single point of accountability.')
@section('keywords', is_array($keywords ?? null) ? implode(', ', $keywords) : ($keywords ?? '360 event solutions morocco, integrated event management morocco, end to end MICE morocco'))

@push('jsonld')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "360 Degree Event and Travel Solutions",
    "name": "360° Event & Travel Solutions — Morocco Quest DMC",
    "description": "Morocco Quest designs and manages complete, multi-component corporate programmes in Morocco — combining meetings, team building, events production and accommodation under one integrated plan and a single point of accountability.",
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
    "url": "{{ url('/360-event-solutions') }}"
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "DMC", "item": "{{ url('/dmc-marrakech') }}" },
        { "@type": "ListItem", "position": 3, "name": "360° Event & Travel Solutions", "item": "{{ url('/360-event-solutions') }}" }
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
            "name": "What makes this different from booking each of your services separately?",
            "acceptedAnswer": { "@type": "Answer", "text": "Booking each service on its own means each vendor plans against their piece of the calendar, not the whole one. A 360° programme is designed as one interdependent itinerary from day one, so a change in one component — a moved session, a delayed flight — is handled against the full run sheet, not renegotiated separately." }
        },
        {
            "@type": "Question",
            "name": "How do you manage contingencies across days that depend on each other?",
            "acceptedAnswer": { "@type": "Answer", "text": "Because one project manager owns the full run sheet, a disruption on one day is assessed against every day that follows it before we act. A late arrival, for instance, can mean shifting an activity slot and rebriefing a venue in the same afternoon, rather than each supplier discovering the change independently." }
        },
        {
            "@type": "Question",
            "name": "What's the minimum size or length for a 360° programme?",
            "acceptedAnswer": { "@type": "Answer", "text": "It's built for programmes combining more than one service type, typically 3 to 6 days and 30 to 300 participants. A single one-day meeting or a standalone activity day doesn't need this layer — book that service directly and it will run just as well." }
        },
        {
            "@type": "Question",
            "name": "Can we start from a template programme and add or remove pieces?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. We often start from a sample structure like a 4-day conference-plus-incentive format and adjust it to your brief — dropping a component, extending a day, swapping a gala for a lighter closing dinner. The template is a starting point, not a fixed package." }
        },
        {
            "@type": "Question",
            "name": "Do we get one contact, or a different account manager per component?",
            "acceptedAnswer": { "@type": "Answer", "text": "One project manager is assigned from the first brief through to the post-programme debrief, and is present on-site for the duration. They draw on our specialist meetings, team building and production teams for delivery, but you are never redirected between departments." }
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
                    <h1 class="breadcrumb-title">Stop Juggling Five Vendors for One Trip</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        One DMC team runs your whole multi-day programme — meetings, activities and evening events — against a single run sheet, not five separate contracts.
                    </p>
                </div>
                <div class="breadcrumb-menu">
                    <ul class="custom-ul">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('dmc.marrakech') }}">DMC</a></li>
                        <li>360° Event & Travel Solutions</li>
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
                <p style="font-size:1.1rem;color:#444;">A conference, an incentive excursion and a closing gala dinner are, on paper, three separate bookings. In practice they're one programme, running on the same dates for the same delegates — and when three different suppliers plan them in isolation, the gaps between bookings are exactly where things go wrong.</p>
                <p style="font-size:1.05rem;color:#555;">Morocco Quest's 360° Event & Travel Solutions puts one project management team in charge of the entire multi-day programme, drawing on the same specialists behind our meetings, team building and events production services — coordinated against a single itinerary instead of booked as separate pieces.</p>
                <a href="#360-enquiry" class="vs-btn mt-3">Talk With Our Programme Team</a>
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
                     alt="Conference sessions in Marrakech as part of an integrated corporate programme"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Meetings & Conference Days</span>
                <h2 class="sec-title" style="font-size:1.6rem;">The Working Sessions, Slotted Into the Bigger Programme</h2>
                <p>Every integrated programme still needs its core meeting days handled properly — venue, AV, delegate flow, breakout rooms. We run that portion with the same rigour as a standalone conference booking, but scheduled deliberately around the activity days and evening events either side of it, so delegates aren't rushed from a plenary session straight into a coach transfer.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5 flex-lg-row-reverse">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/agafay-desert-luxury-camp-camel-trek-morocco.webp') }}"
                     alt="Incentive team building activity in the Agafay desert near Marrakech"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Incentive & Team Activities</span>
                <h2 class="sec-title" style="font-size:1.6rem;">The Reward Woven Into the Trip, Not Bolted On</h2>
                <p>A mountain excursion or a desert team challenge works best when it's placed at the right point in the programme — after two dense conference days, not squeezed in as an afterthought on arrival morning. We build the incentive or team building day into the same run sheet as the meetings, with transport and timing planned against the rest of the schedule.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/moroccan-traditional-dinner-event.webp') }}"
                     alt="Gala dinner and evening event production for a multi-day corporate programme"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Production & Evening Events</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Gala Dinners and Themed Evenings, Staged to Close the Day</h2>
                <p>The evening events carry a lot of a programme's reputation — a flat closing dinner undoes two good conference days in delegates' memories. We layer staging, lighting and entertainment production into whichever evenings the programme calls for, timed to follow directly on from that day's sessions or activities without a dead gap in between.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 flex-lg-row-reverse">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/guide-dar-el-bacha-marrakech-tour-moroccan-culture.webp') }}"
                     alt="On-site project management team coordinating a multi-day corporate programme in Marrakech"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Single Project Management Team</span>
                <h2 class="sec-title" style="font-size:1.6rem;">One Team Watching the Whole Run Sheet</h2>
                <p>This is the part that actually makes "360°" mean something: one on-site team holds the master schedule for every component, so when a flight lands late or a venue needs an extra hour, they can adjust the next day's activity slot or rebrief the evening's suppliers immediately — instead of you finding out three bookings later that nobody told the desert camp the group would arrive an hour behind.</p>
            </div>
        </div>

    </div>
</section>

{{-- SIGNATURE MODULE: SAMPLE 4-DAY INTEGRATED PROGRAMME --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="sec-subtitle">See It in Practice</span>
                <h2 class="sec-title">A Sample 4-Day Integrated Programme</h2>
                <p>One structure we build from often — every programme is still adjusted to your specific brief and headcount.</p>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $days = [
                ['d'=>'Day 1', 't'=>'Arrival & Welcome Dinner', 'b'=>'Airport meet-and-greet, hotel check-in, and an informal welcome dinner to open the programme and let delegates settle in before the working sessions start.'],
                ['d'=>'Day 2', 't'=>'Conference Sessions', 'b'=>'Full-day meeting programme with AV, breakout rooms and a working lunch — run with the same standard as a standalone conference booking.'],
                ['d'=>'Day 3', 't'=>'Atlas Mountain Team Activity', 'b'=>'A half-day incentive excursion into the Atlas foothills, scheduled to follow the conference days rather than compete with them.'],
                ['d'=>'Day 4', 't'=>'Gala Dinner & Departure', 'b'=>'A closing gala event in the evening, followed by coordinated departure transfers timed against each delegate\'s actual flight.'],
            ];
            @endphp
            @foreach($days as $d)
            <div class="col-sm-6 col-lg-3">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-size:.8rem;font-weight:700;color:var(--theme-color);text-transform:uppercase;letter-spacing:.03em;margin-bottom:8px;">{{ $d['d'] }}</div>
                    <div style="font-weight:700;margin-bottom:8px;">{{ $d['t'] }}</div>
                    <div style="font-size:.88rem;color:#666;">{{ $d['b'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <p class="text-center mt-4" style="color:#666;font-size:.92rem;">Components can be added, removed or reordered — a fifth day, a second activity, a lighter closing dinner instead of a gala. The point of the template is a starting structure, not a fixed package.</p>
    </div>
</section>

{{-- WHY MARRAKECH + TESTIMONIAL --}}
<section class="space">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6 order-lg-2">
                <span class="sec-subtitle style-2">Why Marrakech</span>
                <h2 class="sec-title">A Compact Geography That Makes Multi-Component Programmes Work</h2>
                <p>Marrakech sits within a short drive of a genuine city centre, the Atlas Mountain foothills and Agafay desert terrain — three different experience types inside roughly a 45-minute radius. That's what lets a programme move from a conference room to a mountain excursion to a desert dinner without losing half a day to transfers.</p>
                <p>Direct flights from most major European hubs keep arrival logistics manageable even for large, staggered delegate groups, and venue, activity and catering costs stay competitive against Western European or Gulf alternatives — a difference that compounds when a programme is costed as one whole rather than component by component.</p>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div style="background:#fff;border-radius:12px;padding:32px;box-shadow:0 4px 24px rgba(0,0,0,.07);">
                    <div style="font-size:2.5rem;color:var(--theme-color);line-height:1;margin-bottom:12px;">"</div>
                    <p style="font-size:1.05rem;font-style:italic;color:#333;margin-bottom:20px;">
                        "We were running a 5-day programme combining a sales conference, a desert incentive day and a closing gala for 180 people, and I did not want to manage three separate suppliers on the ground. Morocco Quest ran it as one schedule — when our keynote speaker's flight was delayed, they quietly rearranged the next morning's activity slot before I even had to ask."
                    </p>
                    <div style="display:flex;align-items:center;gap:14px;">
                        <div style="width:48px;height:48px;background:#f0f0f0;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                            <i class="fa-solid fa-user" style="color:#aaa;"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:.95rem;">Programme Director</div>
                            <div style="font-size:.82rem;color:#777;">International Events Agency</div>
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
<section class="space bg-theme-07" id="360-enquiry">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">Get a Proposal</span>
                    <h2 class="sec-title">Talk With Our 360° Programme Team</h2>
                    <p>Tell us about your full programme — every component you need — and we respond within 24 hours with an integrated proposal.</p>
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
                    <input type="hidden" name="enquiry_type" value="360 Event Solutions">
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label for="es_name" style="font-weight:600;margin-bottom:4px;display:block;">Full Name *</label>
                            <input id="es_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your full name" value="{{ old('name') }}" required autocomplete="name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="es_company" style="font-weight:600;margin-bottom:4px;display:block;">Company / Organization *</label>
                            <input id="es_company" name="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" placeholder="Your company or organization" value="{{ old('nationality') }}" required />
                            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="es_email" style="font-weight:600;margin-bottom:4px;display:block;">Business Email *</label>
                            <input id="es_email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@company.com" value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="es_phone" style="font-weight:600;margin-bottom:4px;display:block;">Phone / WhatsApp *</label>
                            <input id="es_phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="+1 / +44 / +33..." value="{{ old('phone') }}" required autocomplete="tel" />
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="es_date" style="font-weight:600;margin-bottom:4px;display:block;">Preferred Start Date *</label>
                            <input id="es_date" name="arrival_date" type="text" class="form-control @error('arrival_date') is-invalid @enderror" placeholder="Select programme start date" value="{{ old('arrival_date') }}" required readonly />
                            @error('arrival_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="es_pax" style="font-weight:600;margin-bottom:4px;display:block;">Total Participants *</label>
                            <input id="es_pax" name="adults" type="number" min="1" class="form-control @error('adults') is-invalid @enderror" placeholder="Number of participants" value="{{ old('adults') }}" required />
                            @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="es_duration" style="font-weight:600;margin-bottom:4px;display:block;">Programme Duration (Days) *</label>
                            <input id="es_duration" name="duration_days" type="number" min="1" class="form-control @error('duration_days') is-invalid @enderror" placeholder="Number of days" value="{{ old('duration_days') }}" required />
                            @error('duration_days')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label style="font-weight:600;margin-bottom:4px;display:block;">Programme Complexity</label>
                            <select name="children" class="form-control" style="height:56px;">
                                <option value="0" {{ old('children') == '0' ? 'selected' : '' }}>Meeting + One Additional Component</option>
                                <option value="1" {{ old('children') == '1' ? 'selected' : '' }}>Meeting + Team Building + Gala</option>
                                <option value="2" {{ old('children') == '2' ? 'selected' : '' }}>Congress + Social Programme</option>
                                <option value="3" {{ old('children') == '3' ? 'selected' : '' }}>Full Multi-City Programme</option>
                                <option value="4" {{ old('children') == '4' ? 'selected' : '' }}>Other / Not Sure Yet</option>
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label for="es_brief" style="font-weight:600;margin-bottom:4px;display:block;">Programme Brief *</label>
                            <textarea id="es_brief" name="travel_ideas" class="form-control @error('travel_ideas') is-invalid @enderror" placeholder="Describe your full programme: components needed, objectives, dates, budget range..." rows="5" required>{{ old('travel_ideas') }}</textarea>
                            @error('travel_ideas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <div style="background:#f8f8f8;border-radius:8px;padding:14px 18px;font-size:.88rem;color:#555;margin-bottom:8px;">
                                <i class="fa-solid fa-lock me-2" style="color:var(--theme-color);"></i>
                                Your enquiry is 100% confidential and reviewed by our programme management team directly.
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
                    <h2 class="sec-title">360° Event & Travel Solutions — Common Questions</h2>
                </div>
                <div class="accordion accordion-style1" id="s360Faq">
                <style>
                    #s360Faq .accordion-button{padding-right:60px;font-size:1rem;color:var(--title-color);}
                    #s360Faq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #s360Faq .accordion-body{font-size:.92rem;}
                </style>
                    @php
                    $faqs = [
                        ['q'=>'What makes this different from booking each of your services separately?','a'=>'Booking each service on its own means each vendor plans against their piece of the calendar, not the whole one. A 360° programme is designed as one interdependent itinerary from day one, so a change in one component — a moved session, a delayed flight — is handled against the full run sheet, not renegotiated separately.'],
                        ['q'=>'How do you manage contingencies across days that depend on each other?','a'=>'Because one project manager owns the full run sheet, a disruption on one day is assessed against every day that follows it before we act. A late arrival, for instance, can mean shifting an activity slot and rebriefing a venue in the same afternoon, rather than each supplier discovering the change independently.'],
                        ['q'=>'What\'s the minimum size or length for a 360° programme?','a'=>'It\'s built for programmes combining more than one service type, typically 3 to 6 days and 30 to 300 participants. A single one-day meeting or a standalone activity day doesn\'t need this layer — book that service directly and it will run just as well.'],
                        ['q'=>'Can we start from a template programme and add or remove pieces?','a'=>'Yes. We often start from a sample structure like a 4-day conference-plus-incentive format and adjust it to your brief — dropping a component, extending a day, swapping a gala for a lighter closing dinner. The template is a starting point, not a fixed package.'],
                        ['q'=>'Do we get one contact, or a different account manager per component?','a'=>'One project manager is assigned from the first brief through to the post-programme debrief, and is present on-site for the duration. They draw on our specialist meetings, team building and production teams for delivery, but you are never redirected between departments.'],
                    ];
                    @endphp
                    @foreach($faqs as $i => $faq)
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#s360Faq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}" aria-controls="s360Faq{{ $i }}">
                                {{ $faq['q'] }}
                            </button>
                        </h3>
                        <div id="s360Faq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#s360Faq">
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
                <p>A 360° programme can draw on any of our specialist services: <a href="{{ route('meetings-conventions.management') }}">meetings & conventions management</a>, <a href="{{ route('team-building.marrakech') }}">team building & incentive travel</a>, <a href="{{ route('events-production.morocco') }}">events production</a>, <a href="{{ route('congress-organization.morocco') }}">professional congress organization</a> and <a href="{{ route('sustainable-events.morocco') }}">sustainable events integration</a>. For the complete range of ground services, see our <a href="{{ route('dmc.marrakech') }}">DMC Marrakech</a> overview, or browse <a href="{{ route('tours.multi_day') }}">multi-day tour packages</a> for pre- or post-programme delegate excursions.</p>
            </div>
        </div>
    </div>
</section>

{{-- FINAL CTA --}}
<section style="background:#181613;padding:64px 0;">
    <div class="container text-center">
        <h2 style="color:#fff;font-size:2rem;margin-bottom:12px;">Plan Your Full Programme With One Team</h2>
        <p style="color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 28px;">
            Meetings, team building, events and logistics — under a single point of accountability. Talk with our programme management team today.
        </p>
        <div class="row g-3 justify-content-center">
            <div class="col-12 col-sm-auto">
                <a href="#360-enquiry" class="vs-btn d-block">Request a Proposal</a>
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
        flatpickr('#es_date', { mode: 'single', dateFormat: 'Y-m-d', minDate: 'today' });
        const alert = document.querySelector('#360-enquiry .alert');
        if (alert) { alert.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
    });
</script>
@endpush

@endsection
