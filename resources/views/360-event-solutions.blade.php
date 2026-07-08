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
            "name": "What is a 360° event and travel solution?",
            "acceptedAnswer": { "@type": "Answer", "text": "It means one DMC takes responsibility for every component of a multi-day corporate programme — meetings, team building, events production, accommodation and transport — instead of a client coordinating separate vendors for each piece. You get a single point of contact, a single proposal and a single team on the ground." }
        },
        {
            "@type": "Question",
            "name": "How is this different from booking your other DMC services separately?",
            "acceptedAnswer": { "@type": "Answer", "text": "Booking services separately means each element is planned and delivered somewhat in isolation. A 360° programme is planned as one interdependent whole from the outset, so a delay in one component — a late flight, a venue change — is managed against the full itinerary, not just that day's booking." }
        },
        {
            "@type": "Question",
            "name": "What size of programme is this suited to?",
            "acceptedAnswer": { "@type": "Answer", "text": "It works for any multi-day programme combining more than one service type — typically 30 to 300 participants over 3 to 6 days. Smaller single-component bookings, such as a one-day meeting alone, are usually better served by booking that specific service directly." }
        },
        {
            "@type": "Question",
            "name": "Do you still handle each component to the same standard as your specialist services?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. The same specialist teams who run our meetings, team building and events production services deliver each component of a 360° programme — the difference is that one project manager coordinates all of them against a shared timeline and budget." }
        },
        {
            "@type": "Question",
            "name": "Can you manage a programme that spans several cities or regions in Morocco?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. Morocco's geography allows city, mountain and desert experiences within a short driving radius of Marrakech, and we also coordinate programmes that move between Marrakech, Casablanca and Rabat when a brief requires it." }
        },
        {
            "@type": "Question",
            "name": "How far in advance should we start planning an integrated programme?",
            "acceptedAnswer": { "@type": "Answer", "text": "For programmes above 100 participants with multiple components, 4 to 6 months gives us enough runway to secure venues, activity slots and accommodation blocks that align across every day. Smaller or simpler combined programmes can sometimes be confirmed within 6 to 8 weeks." }
        },
        {
            "@type": "Question",
            "name": "What happens if something goes wrong mid-programme, like a delayed flight?",
            "acceptedAnswer": { "@type": "Answer", "text": "Because one team manages the full run sheet, we can adjust downstream elements in real time — shifting an activity slot, rebriefing a venue, or amending transport — without the client having to renegotiate with separate suppliers under pressure." }
        },
        {
            "@type": "Question",
            "name": "Is a 360° programme more expensive than booking services separately?",
            "acceptedAnswer": { "@type": "Answer", "text": "Not typically. A single integrated proposal often reduces overall cost, since transport, staffing and venue negotiations are planned across the whole programme rather than re-quoted for each separate booking. You also save the internal time cost of managing multiple vendors." }
        },
        {
            "@type": "Question",
            "name": "Do you provide a single point of contact throughout the programme?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. A dedicated project manager is assigned from the initial brief through to post-event reporting, and is present on-site for the duration of the programme alongside the operational team for each component." }
        },
        {
            "@type": "Question",
            "name": "Can a 360° programme include a sustainable or CSR element?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. Sustainable event elements — from local sourcing to community-based activities — can be integrated into any day of the programme alongside meetings, team building or gala components." }
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
                    <h1 class="breadcrumb-title">360° Event & Travel Solutions</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        One DMC, one team, one point of accountability —<br>
                        integrated end-to-end programmes across Morocco.
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

{{-- TRUST BAR --}}
<section style="background:var(--theme-color);padding:22px 0;">
    <div class="container">
        <div class="row text-center gy-3">
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">1</div><div style="font-size:.85rem;opacity:.9;">Point of contact, full programme</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">5</div><div style="font-size:.85rem;opacity:.9;">Service lines integrated on request</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">6</div><div style="font-size:.85rem;opacity:.9;">Days, typical programme length</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">24/7</div><div style="font-size:.85rem;opacity:.9;">On-site programme management</div></div>
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
                    <span class="sec-subtitle style-2">360° Event & Travel Solutions</span>
                    <h2 class="sec-title">One Team Managing the Full Programme, Not One Piece of It</h2>
                </div>
                <p>A conference, an incentive trip and a gala dinner are, on paper, three separate bookings. In practice, they are one programme — the same delegates, the same dates, the same budget — and when three different vendors manage them independently, the gaps between bookings are where things go wrong.</p>
                <p><strong>360° Event & Travel Solutions</strong> is how Morocco Quest handles that: one DMC, one project manager and one costed proposal covering every component of a multi-day corporate programme, from arrival transfer to departure. It draws on the same specialist teams behind our meetings, team building, events production and congress services, coordinated against a single run sheet rather than booked as isolated pieces.</p>
                <ul class="custom-ul mt-3" style="list-style:none;padding:0;">
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> A single point of accountability across every day and every component</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> One integrated itinerary, not a stack of separate bookings</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Contingency planning across interdependent programme elements</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> One on-site project management team for the full duration</li>
                </ul>
                <a href="#360-enquiry" class="vs-btn mt-4">Request a Proposal</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/Luxury-Dinner-Setup-Wedding-Morocco-Outdoor-Event.webp') }}"
                     alt="Integrated corporate programme in Morocco combining conference, activities and gala dinner"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
            </div>
        </div>
    </div>
</section>

{{-- HOW AN INTEGRATED PROGRAMME COMES TOGETHER --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">How It Comes Together</span>
                    <h2 class="sec-title">A Multi-Day Programme, Coordinated as One Timeline</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-lg-10">
                <p class="text-center" style="color:#666;">A typical integrated programme runs across four or more days, with each day's component planned against the ones before and after it — not in isolation. A illustrative run might look like this:</p>
                <div class="row g-3 mt-3">
                    @php
                    $days = [
                        ['d'=>'Day 1','t'=>'Arrival & Welcome Dinner','b'=>'Airport meet-and-greet, hotel check-in, and an informal welcome dinner to open the programme.'],
                        ['d'=>'Day 2','t'=>'Conference Sessions','b'=>'Full-day meeting or conference programme with AV, breakout rooms and working lunch.'],
                        ['d'=>'Day 3','t'=>'Team Building Excursion','b'=>'An Atlas Mountain or desert-based activity day, run by the same on-site team managing the conference.'],
                        ['d'=>'Day 4','t'=>'Gala Dinner & Departure','b'=>'A closing gala event followed by coordinated departure transfers across multiple flight times.'],
                    ];
                    @endphp
                    @foreach($days as $d)
                    <div class="col-md-3 col-sm-6">
                        <div class="p-4 text-center" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                            <div style="font-size:.8rem;font-weight:700;color:var(--theme-color);text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px;">{{ $d['d'] }}</div>
                            <div style="font-weight:700;margin-bottom:6px;">{{ $d['t'] }}</div>
                            <div style="font-size:.86rem;color:#666;">{{ $d['b'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="text-center mt-4" style="color:#666;font-size:.92rem;">Every day is planned by one team, against one master run sheet — so a change on Day 2 is automatically reflected in the logistics for Day 3.</p>
            </div>
        </div>
    </div>
</section>

{{-- WHO IT'S FOR / WHEN NEEDED --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">Who This Is For</span>
                    <h2 class="sec-title">Built for Programmes With More Than One Moving Part</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $audiences = [
                ['icon'=>'fa-building',        'title'=>'Hybrid Programme Companies',  'body'=>'Organisations combining a conference or meeting with an incentive trip, team building day or social component.'],
                ['icon'=>'fa-handshake',       'title'=>'Agencies Wanting One Vendor', 'body'=>'Event and travel agencies who want a single ground partner managing an entire multi-day itinerary, not several.'],
                ['icon'=>'fa-people-group',    'title'=>'Large Corporate Groups',      'body'=>'Groups with complex logistics — multiple hotels, staggered arrivals, or parallel activity tracks.'],
                ['icon'=>'fa-sitemap',         'title'=>'Multi-Component Congresses',  'body'=>'Associations running a congress alongside a social programme, exhibitor days and delegate excursions.'],
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
<section class="space bg-theme-07">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/agafay-desert-luxury-camp-camel-trek-morocco.webp') }}"
                     alt="Desert camp near Marrakech used for multi-component corporate programmes"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <div class="title-area">
                    <span class="sec-subtitle style-2">Why Morocco</span>
                    <h2 class="sec-title">A Compact Geography That Makes Multi-Component Programmes Work</h2>
                </div>
                <p>Marrakech sits within a short drive of city venues, Atlas Mountain foothills and Agafay or Sahara-fringe desert terrain. That means a single programme can move from a conference room to a mountain excursion to a desert gala dinner without long transfer days eating into the schedule — something few destinations can offer within a 45-minute radius.</p>
                <p>Direct flights from most major European hubs keep arrival logistics simple even for large, staggered delegate groups, and the overall cost base for venues, activities and catering remains competitive against Western European or Gulf alternatives — which matters when a programme is being costed as a whole rather than component by component.</p>
                <p>Our approach reflects that geography: we design the programme as one itinerary first, then assign the specialist team for each component, so the logistics between days are planned in from the start rather than reconciled afterwards.</p>
            </div>
        </div>
    </div>
</section>

{{-- PROCESS --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">Planning Process</span>
                    <h2 class="sec-title">How We Build Your Integrated Programme, Step by Step</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $steps = [
                ['n'=>'01','title'=>'Full Programme Brief','body'=>'We confirm every component you need — meetings, activities, accommodation, production — and your overall objectives.'],
                ['n'=>'02','title'=>'Integrated Itinerary Design','body'=>'We design the full multi-day itinerary as one sequence, so each day is planned against the ones around it.'],
                ['n'=>'03','title'=>'Single Costed Proposal','body'=>'One net-rate proposal covering every component of the programme, not separate quotes to reconcile.'],
                ['n'=>'04','title'=>'Unified Logistics Plan','body'=>'Transport, accommodation and supplier schedules are mapped against a single master run sheet.'],
                ['n'=>'05','title'=>'On-Site Programme Management','body'=>'One project management team is present for the full duration, coordinating every component in real time.'],
                ['n'=>'06','title'=>'Post-Event Reporting','body'=>'A debrief covering what worked, supplier performance and recommendations for future programmes.'],
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

{{-- CHALLENGES & SOLUTIONS --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">Challenges & Solutions</span>
                    <h2 class="sec-title">What Makes Multi-Component Programmes Hard — and How We Manage It</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $challenges = [
                ['icon'=>'fa-plane-slash', 'title'=>'Interdependent Delays', 'body'=>'A delayed inbound flight can push back a scheduled activity or venue slot. One team managing the full run sheet can adjust downstream elements immediately, rather than each supplier reacting independently.'],
                ['icon'=>'fa-people-arrows','title'=>'Multiple Supplier Types','body'=>'A single programme may involve a conference venue, an activity operator, a catering team and a transport fleet. We contract and brief all of them under one timeline, so responsibilities do not fall between the gaps.'],
                ['icon'=>'fa-cloud-showers-heavy','title'=>'Weather & Logistics Contingency','body'=>'An outdoor team building day or desert dinner needs a backup plan. We build contingency options into the itinerary from the start, across every outdoor element of the programme.'],
            ];
            @endphp
            @foreach($challenges as $c)
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="width:44px;height:44px;background:var(--theme-color);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
                        <i class="fa-solid {{ $c['icon'] }}" style="color:#fff;font-size:1.1rem;"></i>
                    </div>
                    <div style="font-weight:700;margin-bottom:6px;">{{ $c['title'] }}</div>
                    <div style="font-size:.88rem;color:#666;">{{ $c['body'] }}</div>
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
                    <h2 class="sec-title">Everything We Can Fold Into a Single Programme</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $services = [
                ['icon'=>'fa-people-group',      'title'=>'Meetings & Conventions',      'body'=>'Venue sourcing, AV production and delegate logistics, integrated into your wider programme.', 'route'=>'meetings-conventions.management'],
                ['icon'=>'fa-mountain-sun',       'title'=>'Team Building & Incentive',   'body'=>'Atlas Mountain, desert and city-based activities scheduled around your meeting days.', 'route'=>'team-building.marrakech'],
                ['icon'=>'fa-clapperboard',       'title'=>'Events Production',           'body'=>'Staging, AV and gala production for opening nights, awards evenings and closing dinners.', 'route'=>'events-production.morocco'],
                ['icon'=>'fa-user-tie',           'title'=>'Congress Organization',       'body'=>'Association congresses with exhibitor space, parallel sessions and delegate programmes.', 'route'=>'congress-organization.morocco'],
                ['icon'=>'fa-leaf',               'title'=>'Sustainable Events Integration','body'=>'Local sourcing and community-based elements woven into any day of the programme.', 'route'=>'sustainable-events.morocco'],
                ['icon'=>'fa-clipboard-check',    'title'=>'Unified On-Site Project Management', 'body'=>'One project management team present throughout, coordinating every component in real time.', 'route'=>null],
            ];
            @endphp
            @foreach($services as $s)
            <div class="col-sm-6 col-lg-4">
                <div style="display:flex;gap:14px;align-items:flex-start;padding:18px;">
                    <div style="width:44px;height:44px;background:var(--theme-color);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fa-solid {{ $s['icon'] }}" style="color:#fff;font-size:1.1rem;"></i>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:.95rem;margin-bottom:4px;">
                            @if($s['route'])
                                <a href="{{ route($s['route']) }}" style="color:inherit;">{{ $s['title'] }}</a>
                            @else
                                {{ $s['title'] }}
                            @endif
                        </div>
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
                    <div style="font-weight:700;margin-bottom:8px;">4-Day Conference + Incentive Programme for 150 Delegates</div>
                    <p style="font-size:.9rem;color:#666;">A conference in a Marrakech venue on Days 1 and 2, followed by an Atlas Mountain incentive excursion on Day 3 and a closing gala dinner on Day 4 — all planned and delivered by one team.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">Product Launch Combined With Regional Sales Kick-Off</div>
                    <p style="font-size:.9rem;color:#666;">A staged product reveal event on the first evening, followed by two days of sales training sessions and a desert dinner to close the programme for 90 regional staff.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">Multi-Day Association Congress With Social Programme</div>
                    <p style="font-size:.9rem;color:#666;">A three-day congress with exhibitor hall and parallel sessions, paired with delegate excursions and a closing evening event for 220 attendees across multiple hotels.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- LEAD FORM --}}
<section class="space" id="360-enquiry">
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

{{-- FAQ --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">FAQ</span>
                    <h2 class="sec-title">Frequently Asked Questions — 360° Event & Travel Solutions</h2>
                </div>
                <div class="accordion accordion-style1" id="s360Faq">
                <style>
                    #s360Faq .accordion-button{padding-right:60px;font-size:1rem;color:var(--title-color);}
                    #s360Faq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #s360Faq .accordion-body{font-size:.92rem;}
                </style>
                    @php
                    $faqs = [
                        ['q'=>'What is a 360° event and travel solution?','a'=>'It means one DMC takes responsibility for every component of a multi-day corporate programme — meetings, team building, events production, accommodation and transport — instead of a client coordinating separate vendors for each piece. You get a single point of contact, a single proposal and a single team on the ground.'],
                        ['q'=>'How is this different from booking your other DMC services separately?','a'=>'Booking services separately means each element is planned and delivered somewhat in isolation. A 360° programme is planned as one interdependent whole from the outset, so a delay in one component — a late flight, a venue change — is managed against the full itinerary, not just that day\'s booking.'],
                        ['q'=>'What size of programme is this suited to?','a'=>'It works for any multi-day programme combining more than one service type — typically 30 to 300 participants over 3 to 6 days. Smaller single-component bookings, such as a one-day meeting alone, are usually better served by booking that specific service directly.'],
                        ['q'=>'Do you still handle each component to the same standard as your specialist services?','a'=>'Yes. The same specialist teams who run our meetings, team building and events production services deliver each component of a 360° programme — the difference is that one project manager coordinates all of them against a shared timeline and budget.'],
                        ['q'=>'Can you manage a programme that spans several cities or regions in Morocco?','a'=>'Yes. Morocco\'s geography allows city, mountain and desert experiences within a short driving radius of Marrakech, and we also coordinate programmes that move between Marrakech, Casablanca and Rabat when a brief requires it.'],
                        ['q'=>'How far in advance should we start planning an integrated programme?','a'=>'For programmes above 100 participants with multiple components, 4 to 6 months gives us enough runway to secure venues, activity slots and accommodation blocks that align across every day. Smaller or simpler combined programmes can sometimes be confirmed within 6 to 8 weeks.'],
                        ['q'=>'What happens if something goes wrong mid-programme, like a delayed flight?','a'=>'Because one team manages the full run sheet, we can adjust downstream elements in real time — shifting an activity slot, rebriefing a venue, or amending transport — without the client having to renegotiate with separate suppliers under pressure.'],
                        ['q'=>'Is a 360° programme more expensive than booking services separately?','a'=>'Not typically. A single integrated proposal often reduces overall cost, since transport, staffing and venue negotiations are planned across the whole programme rather than re-quoted for each separate booking. You also save the internal time cost of managing multiple vendors.'],
                        ['q'=>'Do you provide a single point of contact throughout the programme?','a'=>'Yes. A dedicated project manager is assigned from the initial brief through to post-event reporting, and is present on-site for the duration of the programme alongside the operational team for each component.'],
                        ['q'=>'Can a 360° programme include a sustainable or CSR element?','a'=>'Yes. Sustainable event elements — from local sourcing to community-based activities — can be integrated into any day of the programme alongside meetings, team building or gala components.'],
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
<section class="space">
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
