@extends('layouts.app2')

@section('title', $title ?? 'Destination Management Company Morocco | What is a DMC | Morocco Quest')
@section('description', $description ?? 'What a Destination Management Company does in Morocco: services, when to use one, and how to evaluate a DMC partner for events, incentives and group travel.')
@section('keywords', is_array($keywords ?? null) ? implode(', ', $keywords) : ($keywords ?? 'destination management company morocco, DMC morocco, what is a DMC, DMC services morocco'))

@push('jsonld')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Destination Management Company Services",
    "name": "Destination Management Company Services — Morocco Quest DMC",
    "description": "Morocco Quest operates as a Destination Management Company in Morocco, providing transport, venue sourcing, accommodation contracting, activity programming, event production and on-site management for corporate and group travel.",
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
            "name": "What is a Destination Management Company?",
            "acceptedAnswer": { "@type": "Answer", "text": "A Destination Management Company (DMC) is a local company that provides the on-the-ground logistics and supplier network needed to run an event, incentive trip or group programme in a specific destination. It acts as the local operational partner for event agencies, corporations and travel operators who do not have their own presence in that market." }
        },
        {
            "@type": "Question",
            "name": "What services does a DMC provide in Morocco?",
            "acceptedAnswer": { "@type": "Answer", "text": "A Morocco-based DMC typically covers ground transport and transfers, venue sourcing, accommodation contracting, activity and entertainment programming, event production, on-site management, supplier and vendor coordination, and risk and safety management for the duration of the programme." }
        },
        {
            "@type": "Question",
            "name": "How is a DMC different from a travel agency or tour operator?",
            "acceptedAnswer": { "@type": "Answer", "text": "A retail travel agency typically sells trips to individual travellers. A DMC works business-to-business, operating on the ground for agencies, corporations and organisations that already have a client or delegate group and need a local partner to execute the logistics in Morocco." }
        },
        {
            "@type": "Question",
            "name": "Who typically needs to hire a DMC?",
            "acceptedAnswer": { "@type": "Answer", "text": "Event and incentive agencies without a Morocco office, corporations planning an incentive trip or offsite, international travel operators needing ground support for a group, and associations or PCOs organising a congress in Morocco all typically work through a DMC." }
        },
        {
            "@type": "Question",
            "name": "How do I evaluate a DMC before signing a contract?",
            "acceptedAnswer": { "@type": "Answer", "text": "Check the company's tourism licence and insurance coverage, ask for references from comparable past programmes, request transparent net pricing rather than bundled mark-ups, confirm the size of their local on-site team, and test their response time during the proposal stage — it is a fair predictor of response time during your event." }
        },
        {
            "@type": "Question",
            "name": "Does a DMC only work on large events?",
            "acceptedAnswer": { "@type": "Answer", "text": "No. DMCs handle everything from a 10-person executive incentive trip to an 800-delegate congress. The scope of services scales to the group size and programme complexity, not the other way around." }
        },
        {
            "@type": "Question",
            "name": "Why use a DMC instead of booking hotels and suppliers directly?",
            "acceptedAnswer": { "@type": "Answer", "text": "Booking directly means managing dozens of separate supplier relationships, contracts and payment terms yourself, usually at retail rates, with no single point of accountability if something goes wrong on the ground. A DMC consolidates that into one contract, one point of contact, and access to negotiated net rates." }
        },
        {
            "@type": "Question",
            "name": "Is Morocco Quest a licensed DMC?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. Morocco Quest is a licensed Moroccan tour operator working as a Destination Management Company for event agencies, corporations, associations and travel operators, with full liability insurance and a team based year-round in Marrakech." }
        },
        {
            "@type": "Question",
            "name": "Can a DMC handle crisis or emergency situations during a programme?",
            "acceptedAnswer": { "@type": "Answer", "text": "A properly resourced DMC maintains a 24/7 on-ground contact point during any live programme, so that itinerary changes, medical issues, weather disruption or supplier problems can be handled locally and in real time, rather than escalated back to a head office abroad." }
        },
        {
            "@type": "Question",
            "name": "What information should I send when requesting a DMC proposal?",
            "acceptedAnswer": { "@type": "Answer", "text": "Group size, proposed dates, destinations within Morocco, the type of programme (incentive, congress, corporate meeting, ground support for a tour), accommodation category, and budget range. The more specific the brief, the more accurate the first proposal will be." }
        }
    ]
}
</script>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════════ --}}
<section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/moroccan-architecture-courtyard-orange-tree-tour-banner.webp') }}">
    <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="" class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
    <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="" class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">Destination Management Company</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        What a DMC is, what it does, and how to evaluate one —<br>
                        a practical guide for companies planning a Morocco programme.
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

{{-- ═══════════════════════════════════════════════════════
     TRUST BAR
═══════════════════════════════════════════════════════ --}}
<section style="background:var(--theme-color);padding:22px 0;">
    <div class="container">
        <div class="row text-center gy-3">
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">8</div><div style="font-size:.85rem;opacity:.9;">Core service categories covered</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">11</div><div style="font-size:.85rem;opacity:.9;">Countries our partners come from</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">24/7</div><div style="font-size:.85rem;opacity:.9;">On-ground crisis response</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">100%</div><div style="font-size:.85rem;opacity:.9;">Net-rate pricing transparency</div></div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     INTRODUCTION — what is a DMC
═══════════════════════════════════════════════════════ --}}
<section class="space">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6">
                <div class="title-area">
                    <span class="sec-subtitle style-2">Definition & Role</span>
                    <h2 class="sec-title">What is a Destination Management Company?</h2>
                </div>
                <p>A <strong>Destination Management Company (DMC)</strong> is a local operator that supplies the ground logistics and supplier network required to deliver an event, incentive trip or group programme in a specific destination. It sits between the client — an event agency, a corporation, an association — and the dozens of individual suppliers a programme actually depends on: hotels, venues, transport companies, guides, caterers, entertainment acts and security providers.</p>
                <p>In the events and travel supply chain, a DMC is the operational layer. The client owns the relationship with the delegate or traveller; the DMC owns execution on the ground. That distinction matters because it defines accountability: when something needs to change at short notice — a flight delay, a venue issue, a weather disruption — the DMC is the party physically present to resolve it.</p>
                <p>Morocco Quest operates as a DMC for companies and agencies running programmes in Morocco, from a single executive incentive trip to a multi-day congress with several hundred delegates.</p>
                <a href="#dmccompany-enquiry" class="vs-btn mt-4">Discuss Your Programme</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/dmc-in-morocco-moroccoquest.webp') }}"
                     alt="Destination Management Company ground operations team in Morocco"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     WHO IT'S FOR / WHEN NEEDED
═══════════════════════════════════════════════════════ --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">Who Needs a DMC</span>
                    <h2 class="sec-title">When an Organisation Needs a Local Ground Partner</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $audiences = [
                ['icon'=>'fa-handshake',      'title'=>'Event Agencies Without a Local Office', 'body'=>'Agencies running a Morocco leg of a global programme who need execution capacity on the ground, not just a supplier contact list.'],
                ['icon'=>'fa-building',       'title'=>'Corporations Planning a Morocco Programme','body'=>'Companies organising an incentive trip, sales kick-off or leadership offsite in a market their internal team does not know well.'],
                ['icon'=>'fa-route',          'title'=>'Travel Operators Needing Ground Support', 'body'=>'Tour operators and wholesalers who sell Morocco itineraries but need a local partner to deliver transport, guiding and accommodation.'],
                ['icon'=>'fa-people-group',   'title'=>'Associations & Congress Organisers',      'body'=>'Associations and PCOs evaluating or organising a congress in Morocco, requiring venue, logistics and delegate management support.'],
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
        <div class="row justify-content-center mt-4">
            <div class="col-lg-10">
                <p style="text-align:center;color:#555;font-size:.95rem;">The common thread is not company size — it is local knowledge. Any organisation running an event or trip in a market where it lacks supplier relationships, regulatory familiarity or an on-the-ground presence is, in practice, operating without a safety net until it engages a DMC.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     WHY MOROCCO / OUR APPROACH
═══════════════════════════════════════════════════════ --}}
<section class="space">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/morocco-desert-adventure-support.webp') }}"
                     alt="Morocco as a destination management gateway between Europe, Africa and the Middle East"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <div class="title-area">
                    <span class="sec-subtitle style-2">Why Morocco</span>
                    <h2 class="sec-title">Morocco's Position in the Destination Management Market</h2>
                </div>
                <p>Morocco sits at a genuine crossroads — a short flight from most European capitals, a similar time zone to Western Europe, and reasonable air access from the Gulf and North America through Casablanca. For a company weighing Morocco against Southern Europe or the Gulf as an event destination, that geography removes a lot of the friction that usually comes with running a programme far from a client's home market.</p>
                <p>The country's MICE infrastructure has grown steadily over the past decade: purpose-built convention space in Marrakech and Casablanca, an expanding four- and five-star hotel base, and a supplier ecosystem — AV, transport, catering, entertainment — that has matured alongside it. It is not yet at the scale of established European congress cities, but for groups up to a few hundred delegates it is well equipped.</p>
                <p>Our approach as a DMC starts with understanding what "good" looks like for your specific programme — budget ceiling, delegate profile, risk tolerance — before we propose venues or suppliers. A programme for a 20-person board offsite and one for a 400-delegate congress draw on the same supplier network, but almost nothing else about how we plan them is the same.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     PROCESS — onboarding a new client
═══════════════════════════════════════════════════════ --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">How We Work</span>
                    <h2 class="sec-title">Onboarding a New Client, Step by Step</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $steps = [
                ['n'=>'01','title'=>'Initial Brief Call','body'=>'We discuss objectives, group profile, dates and budget range before proposing anything.'],
                ['n'=>'02','title'=>'Scope Definition','body'=>'We confirm exactly which services you need us to manage versus what you handle in-house.'],
                ['n'=>'03','title'=>'Supplier Sourcing','body'=>'We shortlist venues, hotels and suppliers matched to your brief and request costings.'],
                ['n'=>'04','title'=>'Net-Rate Proposal','body'=>'A single consolidated proposal with transparent net pricing across every service line.'],
                ['n'=>'05','title'=>'Contracting & Planning','body'=>'Contracts, run sheets, rooming lists and risk plans are finalised ahead of arrival.'],
                ['n'=>'06','title'=>'On-Site Delivery','body'=>'Our team is present throughout the programme, with a 24/7 contact point for issues.'],
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

{{-- ═══════════════════════════════════════════════════════
     SERVICE HIGHLIGHTS — full scope of DMC services
═══════════════════════════════════════════════════════ --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">Scope of Services</span>
                    <h2 class="sec-title">What a Full-Service DMC Covers</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $services = [
                ['icon'=>'fa-bus',               'title'=>'Transport & Transfers',        'body'=>'Airport transfers, inter-city movement, venue shuttles and executive vehicles for VIP delegates.'],
                ['icon'=>'fa-map-location-dot',  'title'=>'Venue & Accommodation Sourcing','body'=>'Shortlisting and contracting venues and hotel room blocks matched to group size and budget.'],
                ['icon'=>'fa-champagne-glasses', 'title'=>'Activity & Entertainment Programming','body'=>'Excursions, team-building, gala evenings and local entertainment built around the group profile.'],
                ['icon'=>'fa-clapperboard',      'title'=>'Event Production',              'body'=>'AV, staging, lighting and technical production for conferences, galas and branded events.'],
                ['icon'=>'fa-clipboard-check',   'title'=>'On-Site Management',            'body'=>'A dedicated team present for registration, room flow, supplier coordination and real-time fixes.'],
                ['icon'=>'fa-shield-halved',     'title'=>'24/7 Crisis Support',           'body'=>'A local emergency contact point for medical issues, itinerary changes or supplier problems.'],
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
        <div class="row justify-content-center mt-3">
            <div class="col-lg-10">
                <p style="text-align:center;color:#555;font-size:.95rem;">Beyond these six, most established DMCs — Morocco Quest included — also manage supplier and vendor relationships on the client's behalf, and carry risk and safety management as a standing responsibility across every programme, rather than as an add-on service.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     HOW TO EVALUATE A DMC PARTNER
═══════════════════════════════════════════════════════ --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">Choosing a Partner</span>
                    <h2 class="sec-title">How to Evaluate a DMC Partner</h2>
                    <p>Not every company calling itself a DMC operates at the same standard. These are the points worth checking before you sign.</p>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $criteria = [
                ['icon'=>'fa-id-card',        'title'=>'Licensing & Insurance',     'body'=>'Confirm the company holds a valid Moroccan tourism operator licence and carries liability insurance that covers your group size and activities.'],
                ['icon'=>'fa-file-invoice-dollar','title'=>'Transparent Net Pricing', 'body'=>'Ask for net rates broken down by service line, not a single bundled figure. Transparent pricing signals a partner comfortable with scrutiny.'],
                ['icon'=>'fa-users-viewfinder','title'=>'Local Team Size',           'body'=>'A DMC with one or two staff cannot realistically cover a 200-delegate programme with parallel activities. Ask how many people will actually be on-site.'],
                ['icon'=>'fa-star',           'title'=>'References & Track Record', 'body'=>'Request references from programmes similar in size and complexity to yours, not just their largest or most polished case study.'],
                ['icon'=>'fa-network-wired',  'title'=>'Supplier Network Depth',    'body'=>'A DMC that owns strong, direct relationships with multiple hotels and venues can offer real alternatives if your first choice falls through.'],
                ['icon'=>'fa-stopwatch',      'title'=>'Response Times',            'body'=>'How quickly a DMC replies during the proposal stage is a reasonable predictor of how quickly they will respond when something goes wrong on-site.'],
            ];
            @endphp
            @foreach($criteria as $c)
            <div class="col-sm-6 col-lg-4">
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

{{-- ═══════════════════════════════════════════════════════
     EXAMPLE SCENARIOS
═══════════════════════════════════════════════════════ --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-area">
                    <span class="sec-subtitle">Example Scenarios</span>
                    <h2 class="sec-title">How Companies Typically Engage a DMC</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">International Agency Needs a Morocco Ground Partner</div>
                    <p style="font-size:.9rem;color:#666;">A European event agency wins a client programme that includes a Morocco stop but has no local office. It engages Morocco Quest as the ground partner for transport, hotels and on-site delivery, while keeping the client relationship in-house.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">Corporation Planning Its First Morocco Incentive Trip</div>
                    <p style="font-size:.9rem;color:#666;">A company rewarding its top sales performers with a trip to Marrakech has never run a programme in Morocco before. A DMC handles venue and hotel sourcing, activity programming and on-site logistics from brief to departure.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">Association Evaluating Morocco as a Future Congress Destination</div>
                    <p style="font-size:.9rem;color:#666;">A professional association shortlisting host cities for its 2028 congress requests venue capacity data, indicative costings and a familiarisation trip from a Morocco-based DMC before making a bid decision.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     LEAD FORM
═══════════════════════════════════════════════════════ --}}
<section class="space" id="dmccompany-enquiry">
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

                <form action="{{ route('contact.submit') }}" method="POST" class="form-style1" novalidate>
                    @csrf
                    <input type="hidden" name="enquiry_type" value="DMC Partnership Inquiry">
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label for="dmcco_name" style="font-weight:600;margin-bottom:4px;display:block;">Full Name *</label>
                            <input id="dmcco_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your full name" value="{{ old('name') }}" required autocomplete="name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmcco_company" style="font-weight:600;margin-bottom:4px;display:block;">Company / Organization *</label>
                            <input id="dmcco_company" name="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" placeholder="Your company or organization" value="{{ old('nationality') }}" required />
                            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmcco_email" style="font-weight:600;margin-bottom:4px;display:block;">Business Email *</label>
                            <input id="dmcco_email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@company.com" value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmcco_phone" style="font-weight:600;margin-bottom:4px;display:block;">Phone / WhatsApp *</label>
                            <input id="dmcco_phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="+1 / +44 / +33..." value="{{ old('phone') }}" required autocomplete="tel" />
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmcco_date" style="font-weight:600;margin-bottom:4px;display:block;">Programme Dates *</label>
                            <input id="dmcco_date" name="arrival_date" type="text" class="form-control @error('arrival_date') is-invalid @enderror" placeholder="Select programme date" value="{{ old('arrival_date') }}" required readonly />
                            @error('arrival_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmcco_pax" style="font-weight:600;margin-bottom:4px;display:block;">Group Size (Pax) *</label>
                            <input id="dmcco_pax" name="adults" type="number" min="1" class="form-control @error('adults') is-invalid @enderror" placeholder="Number of participants" value="{{ old('adults') }}" required />
                            @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmcco_duration" style="font-weight:600;margin-bottom:4px;display:block;">Programme Duration (Days) *</label>
                            <input id="dmcco_duration" name="duration_days" type="number" min="1" class="form-control @error('duration_days') is-invalid @enderror" placeholder="Number of days" value="{{ old('duration_days') }}" required />
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
                            <label for="dmcco_brief" style="font-weight:600;margin-bottom:4px;display:block;">Brief Description *</label>
                            <textarea id="dmcco_brief" name="travel_ideas" class="form-control @error('travel_ideas') is-invalid @enderror" placeholder="Describe your programme: destinations, group profile, services needed, budget range..." rows="5" required>{{ old('travel_ideas') }}</textarea>
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
                    <h2 class="sec-title">Frequently Asked Questions — Destination Management Companies</h2>
                </div>
                <div class="accordion accordion-style1" id="dmcCoFaq">
                <style>
                    #dmcCoFaq .accordion-button{padding-right:60px;font-size:1rem;color:var(--title-color);}
                    #dmcCoFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #dmcCoFaq .accordion-body{font-size:.92rem;}
                </style>
                    @php
                    $faqs = [
                        ['q'=>'What is a Destination Management Company?','a'=>'A Destination Management Company (DMC) is a local company that provides the on-the-ground logistics and supplier network needed to run an event, incentive trip or group programme in a specific destination. It acts as the local operational partner for event agencies, corporations and travel operators who do not have their own presence in that market.'],
                        ['q'=>'What services does a DMC provide in Morocco?','a'=>'A Morocco-based DMC typically covers ground transport and transfers, venue sourcing, accommodation contracting, activity and entertainment programming, event production, on-site management, supplier and vendor coordination, and risk and safety management for the duration of the programme.'],
                        ['q'=>'How is a DMC different from a travel agency or tour operator?','a'=>'A retail travel agency typically sells trips to individual travellers. A DMC works business-to-business, operating on the ground for agencies, corporations and organisations that already have a client or delegate group and need a local partner to execute the logistics in Morocco.'],
                        ['q'=>'Who typically needs to hire a DMC?','a'=>'Event and incentive agencies without a Morocco office, corporations planning an incentive trip or offsite, international travel operators needing ground support for a group, and associations or PCOs organising a congress in Morocco all typically work through a DMC.'],
                        ['q'=>'How do I evaluate a DMC before signing a contract?','a'=>'Check the company\'s tourism licence and insurance coverage, ask for references from comparable past programmes, request transparent net pricing rather than bundled mark-ups, confirm the size of their local on-site team, and test their response time during the proposal stage — it is a fair predictor of response time during your event.'],
                        ['q'=>'Does a DMC only work on large events?','a'=>'No. DMCs handle everything from a 10-person executive incentive trip to an 800-delegate congress. The scope of services scales to the group size and programme complexity, not the other way around.'],
                        ['q'=>'Why use a DMC instead of booking hotels and suppliers directly?','a'=>'Booking directly means managing dozens of separate supplier relationships, contracts and payment terms yourself, usually at retail rates, with no single point of accountability if something goes wrong on the ground. A DMC consolidates that into one contract, one point of contact, and access to negotiated net rates.'],
                        ['q'=>'Is Morocco Quest a licensed DMC?','a'=>'Yes. Morocco Quest is a licensed Moroccan tour operator working as a Destination Management Company for event agencies, corporations, associations and travel operators, with full liability insurance and a team based year-round in Marrakech.'],
                        ['q'=>'Can a DMC handle crisis or emergency situations during a programme?','a'=>'A properly resourced DMC maintains a 24/7 on-ground contact point during any live programme, so that itinerary changes, medical issues, weather disruption or supplier problems can be handled locally and in real time, rather than escalated back to a head office abroad.'],
                        ['q'=>'What information should I send when requesting a DMC proposal?','a'=>'Group size, proposed dates, destinations within Morocco, the type of programme (incentive, congress, corporate meeting, ground support for a tour), accommodation category, and budget range. The more specific the brief, the more accurate the first proposal will be.'],
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

{{-- CROSS-LINKS --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                <h3 class="sec-title mb-3" style="font-size:1.4rem;">Related DMC Services</h3>
                <p>For our full range of ground services and B2B rates, see the <a href="{{ route('dmc.marrakech') }}">DMC Marrakech</a> overview. If your programme centres on a corporate meeting or conference, visit <a href="{{ route('meetings-conventions.management') }}">meetings & conventions management</a>. Organising a congress or association event? See <a href="{{ route('congress-organization.morocco') }}">professional congress organization</a>. For pre- or post-programme excursions for delegates, browse our <a href="{{ route('tours.multi_day') }}">multi-day tour packages</a>.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     FINAL CTA
═══════════════════════════════════════════════════════ --}}
<section style="background:#181613;padding:64px 0;">
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
        flatpickr('#dmcco_date', { mode: 'single', dateFormat: 'Y-m-d', minDate: 'today' });
        const alert = document.querySelector('#dmccompany-enquiry .alert');
        if (alert) { alert.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
    });
</script>
@endpush

@endsection
