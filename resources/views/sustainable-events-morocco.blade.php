@extends('layouts.app2')

@section('title', $title ?? 'Sustainable Events Morocco | Responsible Corporate Events | Morocco Quest DMC')
@section('description', $description ?? 'Responsible corporate event planning in Morocco: local sourcing, artisan cooperative partnerships and honest sustainability practices for CSR-focused programmes.')
@section('keywords', is_array($keywords ?? null) ? implode(', ', $keywords) : ($keywords ?? 'sustainable events morocco, responsible corporate events morocco, CSR events morocco'))

@push('jsonld')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Sustainable Event Management",
    "name": "Sustainable Event Management — Morocco Quest DMC",
    "description": "Morocco Quest plans corporate events and travel programmes in Morocco with genuine local sourcing, artisan cooperative partnerships and honest sustainability practices for organisations with CSR and ESG requirements.",
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
    "url": "{{ url('/sustainable-events-morocco') }}"
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "DMC", "item": "{{ url('/dmc-marrakech') }}" },
        { "@type": "ListItem", "position": 3, "name": "Sustainable Events", "item": "{{ url('/sustainable-events-morocco') }}" }
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
            "name": "What does \"sustainable events\" actually mean for a corporate programme in Morocco?",
            "acceptedAnswer": { "@type": "Answer", "text": "In practical terms it means choosing suppliers and venues that source food and materials locally where possible, working with artisan cooperatives and community-based operators rather than only large intermediaries, reducing waste at desert camps and event venues, and being deliberate about water use. It is a set of sourcing and planning decisions, not a certificate." }
        },
        {
            "@type": "Question",
            "name": "Is this greenwashing?",
            "acceptedAnswer": { "@type": "Answer", "text": "We are careful not to make claims we cannot stand behind. Morocco Quest is not a certified carbon-neutral operator and we do not present our events as zero-impact. What we can offer is transparency about which suppliers we use, why we chose them, and what trade-offs exist between scale, budget and genuinely local sourcing. If a claim cannot be verified, we do not make it." }
        },
        {
            "@type": "Question",
            "name": "Can you provide reporting for our ESG or CSR documentation?",
            "acceptedAnswer": { "@type": "Answer", "text": "We can provide a supplier and sourcing summary — which cooperatives, guides and local operators were used, approximate spend retained locally, and a description of the community engagement component — that your team can incorporate into internal ESG reporting. We do not issue third-party audited sustainability certificates." }
        },
        {
            "@type": "Question",
            "name": "What does local sourcing look like at a desert camp event?",
            "acceptedAnswer": { "@type": "Answer", "text": "Where feasible we favour camps that buy produce from nearby communities, employ local staff, and manage waste by packing it out rather than burying or burning it on site. Water use is planned around what the site can realistically support, particularly for larger groups. Availability varies by location and season, and we're upfront about it when a preferred option isn't practical for a given group size." }
        },
        {
            "@type": "Question",
            "name": "Do you work with artisan cooperatives directly?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. Morocco has an established network of women's argan oil cooperatives, weaving collectives and pottery workshops, particularly around Marrakech and the Atlas Mountains. We can build a visit, workshop or purchasing component around one of these cooperatives as part of a programme, with the group's spend going directly to the cooperative rather than a reseller." }
        },
        {
            "@type": "Question",
            "name": "How does group size affect what's realistically achievable?",
            "acceptedAnswer": { "@type": "Answer", "text": "A cooperative that can host 20 people comfortably for a workshop may not have the capacity for 150. For larger groups we're honest about where genuine local sourcing has limits and where we need to bring in additional suppliers to meet demand — we would rather tell you this at the planning stage than overpromise." }
        },
        {
            "@type": "Question",
            "name": "What accommodation options have genuine sustainability practices?",
            "acceptedAnswer": { "@type": "Answer", "text": "A number of riads and desert camps in the Marrakech region operate with solar water heating, greywater reuse, locally sourced breakfast produce or staff drawn from the surrounding community. We assess each property individually rather than relying on marketing claims, and we'll tell you honestly where a property's practices are limited." }
        },
        {
            "@type": "Question",
            "name": "Can sustainability be part of a CSR-linked incentive trip?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, this is one of the more common requests we receive. A typical format pairs a standard incentive itinerary with a half-day community engagement component — a cooperative visit, a tree-planting session, or a hands-on workshop — that gives the trip a stated CSR outcome alongside the reward element." }
        },
        {
            "@type": "Question",
            "name": "Does choosing sustainable suppliers cost more?",
            "acceptedAnswer": { "@type": "Answer", "text": "Sometimes, yes. Cooperative-sourced catering or community-based excursions can carry a premium over mass-market alternatives, and we budget for that transparently rather than hiding it in a bundled rate. We'll flag where a sustainability-aligned choice affects cost so your team can make an informed decision." }
        },
        {
            "@type": "Question",
            "name": "How far in advance should we brief you on sustainability requirements?",
            "acceptedAnswer": { "@type": "Answer", "text": "The earlier the better, ideally at initial brief stage. Supplier vetting for genuine local sourcing and cooperative partnerships takes longer than booking a standard venue, particularly for larger groups or peak season (October to May) dates." }
        }
    ]
}
</script>
@endpush

@section('content')

{{-- HERO --}}
<section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/berber-terrace-atlas-mountains-imlil-morocco.webp') }}">
    <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="" class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
    <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="" class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">Sustainable Events</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        Local sourcing, cooperative partnerships and honest reporting —<br>
                        responsible corporate events in Morocco for organisations with CSR and ESG commitments.
                    </p>
                </div>
                <div class="breadcrumb-menu">
                    <ul class="custom-ul">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('dmc.marrakech') }}">DMC</a></li>
                        <li>Sustainable Events</li>
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
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">12+</div><div style="font-size:.85rem;opacity:.9;">Local cooperatives partnered with</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">3</div><div style="font-size:.85rem;opacity:.9;">Regions covered — Marrakech, Atlas, Agafay</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">100%</div><div style="font-size:.85rem;opacity:.9;">Net-rate transparency on sourcing</div></div>
            </div>
            <div class="col-6 col-md-3">
                <div style="color:#fff;"><div style="font-size:2rem;font-weight:700;">1:1</div><div style="font-size:.85rem;opacity:.9;">Supplier vetting per programme brief</div></div>
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
                    <span class="sec-subtitle style-2">Responsible Corporate Events</span>
                    <h2 class="sec-title">Sustainable Event Planning, Handled Honestly</h2>
                </div>
                <p>More companies now carry a CSR mandate or an ESG reporting requirement into their event planning, and Morocco offers genuine ground to work with — a long-standing network of artisan cooperatives, community-based tourism operators and a landscape where local sourcing is a realistic option rather than a marketing add-on.</p>
                <p>We are not a certified carbon-neutral operator, and we will not tell you we are. What we do is plan <strong>sustainable events in Morocco</strong> around suppliers we have vetted for genuine local sourcing, build in community engagement components that go beyond a token photo stop, and stay transparent with you about where trade-offs exist between scale, budget and how local we can realistically go.</p>
                <ul class="custom-ul mt-3" style="list-style:none;padding:0;">
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Supplier vetting for genuine local sourcing, not marketing claims</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Direct partnerships with artisan cooperatives and community operators</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Waste and water conscious venue selection where feasible</li>
                    <li style="padding:6px 0;"><i class="fa-solid fa-circle-check text-theme-color me-2"></i> Honest reporting support for internal ESG documentation</li>
                </ul>
                <a href="#sustainable-enquiry" class="vs-btn mt-4">Discuss Your Sustainability Brief</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/berber-terrace-atlas-mountains-imlil-morocco.webp') }}"
                     alt="Atlas Mountains terrace near Imlil used for community-based sustainable event programmes"
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
                    <h2 class="sec-title">Built for Organisations That Take Sustainability Seriously</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $audiences = [
                ['icon'=>'fa-leaf',            'title'=>'CSR & ESG-Mandated Teams',   'body'=>'Companies whose events need to align with a stated CSR policy or contribute to ESG reporting requirements.'],
                ['icon'=>'fa-people-group',    'title'=>'Associations with Charters', 'body'=>'Associations and NGOs operating under an environmental or sustainability charter for their congresses.'],
                ['icon'=>'fa-hand-holding-heart','title'=>'Brand & Marketing Teams',   'body'=>'Brands wanting an authentic community engagement component, not a staged gesture, in their event programme.'],
                ['icon'=>'fa-gift',            'title'=>'CSR-Linked Incentive Groups','body'=>'Incentive travel programmes that pair reward travel with a genuine, planned community engagement element.'],
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
                <img src="{{ asset('assets/img/agafay-desert-luxury-camp-camel-trek-morocco.webp') }}"
                     alt="Agafay desert camp near Marrakech used for low-transit sustainable event programmes"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <div class="title-area">
                    <span class="sec-subtitle style-2">Why Marrakech</span>
                    <h2 class="sec-title">A Region Where Local Sourcing Is Genuinely Available</h2>
                </div>
                <p>Marrakech sits close to the Agafay plateau and the Atlas Mountains, which means desert camp and mountain-village components can be reached in under an hour rather than requiring a long-haul internal transfer. That proximity reduces transport emissions relative to itineraries that criss-cross the country, and it keeps logistics manageable for larger groups.</p>
                <p>The region also has a genuinely long-standing tradition of artisan cooperatives — argan oil producers, weaving collectives, pottery workshops — and community-based tourism operators who are used to hosting groups. This isn't infrastructure we had to build for the purpose of sustainability marketing; it existed before the demand for it did.</p>
                <p>Our approach starts with your sustainability brief — what your CSR policy requires, what your stakeholders expect to see reported — and we vet suppliers against that brief rather than assuming a generic package will satisfy it.</p>
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
                    <h2 class="sec-title">How We Plan a Sustainable Event, Step by Step</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $steps = [
                ['n'=>'01','title'=>'Sustainability Brief Intake','body'=>'We ask what your CSR policy or ESG framework actually requires, and what your stakeholders expect to see.'],
                ['n'=>'02','title'=>'Supplier Vetting','body'=>'We check venues, caterers and operators for genuine local sourcing — not just a sustainability page on their website.'],
                ['n'=>'03','title'=>'Community Engagement Design','body'=>'We design a cooperative visit, workshop or community component that fits your group size and schedule realistically.'],
                ['n'=>'04','title'=>'Costed Proposal','body'=>'A transparent proposal that flags where sustainability-aligned choices affect cost, so nothing is hidden in a bundled rate.'],
                ['n'=>'05','title'=>'Measurement & Reporting Support','body'=>'We prepare a supplier and sourcing summary your team can use for internal ESG documentation.'],
                ['n'=>'06','title'=>'On-Site Delivery','body'=>'Our team is present to manage waste handling, water use and the community engagement component on the day.'],
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
                    <h2 class="sec-title">What's Included in Our Sustainable Events Service</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $services = [
                ['icon'=>'fa-carrot',            'title'=>'Local Sourcing & Catering',       'body'=>'Menus built around produce and suppliers from the region where availability and quality allow.'],
                ['icon'=>'fa-hands-holding-circle','title'=>'Artisan Cooperative Partnerships','body'=>'Direct partnerships with weaving, pottery and argan oil cooperatives for visits, workshops and sourcing.'],
                ['icon'=>'fa-droplet',           'title'=>'Waste & Water Conscious Venues',   'body'=>'Venue selection that weighs waste handling and water use, particularly for desert camp locations.'],
                ['icon'=>'fa-people-roof',       'title'=>'Community Engagement Programming', 'body'=>'Engagement components designed with the community, not staged for a group photo.'],
                ['icon'=>'fa-file-lines',        'title'=>'Transparent Reporting Support',    'body'=>'A supplier and sourcing summary your team can fold into internal CSR or ESG documentation.'],
                ['icon'=>'fa-route',             'title'=>'Low-Impact Transport Planning',    'body'=>'Itineraries that favour proximity — Agafay and the Atlas foothills over long internal transfers.'],
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
                    <div style="font-weight:700;margin-bottom:8px;">CSR-Linked Incentive Trip with Cooperative Visit</div>
                    <p style="font-size:.9rem;color:#666;">A sales incentive group spends a morning at a women's argan oil cooperative near Marrakech, with direct purchasing, before continuing to a standard incentive itinerary.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">Association Congress with Local Sourcing Requirement</div>
                    <p style="font-size:.9rem;color:#666;">An association's environmental charter requires catering to prioritise local produce; we brief caterers accordingly and document sourcing for the congress report.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">Corporate Offsite with Community Engagement Day</div>
                    <p style="font-size:.9rem;color:#666;">A leadership offsite adds a half-day at an Atlas Mountain village, working alongside a local cooperative on a planned, mutually agreed activity.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- LEAD FORM --}}
<section class="space" id="sustainable-enquiry">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">Get a Proposal</span>
                    <h2 class="sec-title">Talk With Our Sustainable Events Team</h2>
                    <p>Tell us your sustainability requirements, group size and dates — we respond within 24 hours with an honest, costed proposal.</p>
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
                    <input type="hidden" name="enquiry_type" value="Sustainable Events">
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label for="se_name" style="font-weight:600;margin-bottom:4px;display:block;">Full Name *</label>
                            <input id="se_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your full name" value="{{ old('name') }}" required autocomplete="name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="se_company" style="font-weight:600;margin-bottom:4px;display:block;">Company / Organization *</label>
                            <input id="se_company" name="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" placeholder="Your company or organization" value="{{ old('nationality') }}" required />
                            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="se_email" style="font-weight:600;margin-bottom:4px;display:block;">Business Email *</label>
                            <input id="se_email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@company.com" value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="se_phone" style="font-weight:600;margin-bottom:4px;display:block;">Phone / WhatsApp *</label>
                            <input id="se_phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="+1 / +44 / +33..." value="{{ old('phone') }}" required autocomplete="tel" />
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="se_date" style="font-weight:600;margin-bottom:4px;display:block;">Preferred Dates *</label>
                            <input id="se_date" name="arrival_date" type="text" class="form-control @error('arrival_date') is-invalid @enderror" placeholder="Select event date" value="{{ old('arrival_date') }}" required readonly />
                            @error('arrival_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="se_pax" style="font-weight:600;margin-bottom:4px;display:block;">Group Size *</label>
                            <input id="se_pax" name="adults" type="number" min="1" class="form-control @error('adults') is-invalid @enderror" placeholder="Number of attendees" value="{{ old('adults') }}" required />
                            @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="se_duration" style="font-weight:600;margin-bottom:4px;display:block;">Event Duration (Days) *</label>
                            <input id="se_duration" name="duration_days" type="number" min="1" class="form-control @error('duration_days') is-invalid @enderror" placeholder="Number of days" value="{{ old('duration_days') }}" required />
                            @error('duration_days')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label style="font-weight:600;margin-bottom:4px;display:block;">Event Type</label>
                            <select name="children" class="form-control" style="height:56px;">
                                <option value="0" {{ old('children') == '0' ? 'selected' : '' }}>CSR-Linked Incentive Trip</option>
                                <option value="1" {{ old('children') == '1' ? 'selected' : '' }}>Association Congress</option>
                                <option value="2" {{ old('children') == '2' ? 'selected' : '' }}>Corporate Offsite</option>
                                <option value="3" {{ old('children') == '3' ? 'selected' : '' }}>Team Building with Community Component</option>
                                <option value="4" {{ old('children') == '4' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label for="se_brief" style="font-weight:600;margin-bottom:4px;display:block;">Event Brief *</label>
                            <textarea id="se_brief" name="travel_ideas" class="form-control @error('travel_ideas') is-invalid @enderror" placeholder="Describe your event and please include any sustainability, CSR or ESG requirements we should plan around..." rows="5" required>{{ old('travel_ideas') }}</textarea>
                            @error('travel_ideas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <div style="background:#f8f8f8;border-radius:8px;padding:14px 18px;font-size:.88rem;color:#555;margin-bottom:8px;">
                                <i class="fa-solid fa-lock me-2" style="color:var(--theme-color);"></i>
                                Your enquiry is 100% confidential and reviewed by our sustainable events team directly.
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
                    <h2 class="sec-title">Frequently Asked Questions — Sustainable Events</h2>
                </div>
                <div class="accordion accordion-style1" id="susFaq">
                <style>
                    #susFaq .accordion-button{padding-right:60px;font-size:1rem;color:var(--title-color);}
                    #susFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #susFaq .accordion-body{font-size:.92rem;}
                </style>
                    @php
                    $faqs = [
                        ['q'=>'What does "sustainable events" actually mean for a corporate programme in Morocco?','a'=>'In practical terms it means choosing suppliers and venues that source food and materials locally where possible, working with artisan cooperatives and community-based operators rather than only large intermediaries, reducing waste at desert camps and event venues, and being deliberate about water use. It is a set of sourcing and planning decisions, not a certificate.'],
                        ['q'=>'Is this greenwashing?','a'=>'We are careful not to make claims we cannot stand behind. Morocco Quest is not a certified carbon-neutral operator and we do not present our events as zero-impact. What we can offer is transparency about which suppliers we use, why we chose them, and what trade-offs exist between scale, budget and genuinely local sourcing. If a claim cannot be verified, we do not make it.'],
                        ['q'=>'Can you provide reporting for our ESG or CSR documentation?','a'=>'We can provide a supplier and sourcing summary — which cooperatives, guides and local operators were used, approximate spend retained locally, and a description of the community engagement component — that your team can incorporate into internal ESG reporting. We do not issue third-party audited sustainability certificates.'],
                        ['q'=>'What does local sourcing look like at a desert camp event?','a'=>"Where feasible we favour camps that buy produce from nearby communities, employ local staff, and manage waste by packing it out rather than burying or burning it on site. Water use is planned around what the site can realistically support, particularly for larger groups. Availability varies by location and season, and we're upfront about it when a preferred option isn't practical for a given group size."],
                        ['q'=>'Do you work with artisan cooperatives directly?','a'=>"Yes. Morocco has an established network of women's argan oil cooperatives, weaving collectives and pottery workshops, particularly around Marrakech and the Atlas Mountains. We can build a visit, workshop or purchasing component around one of these cooperatives as part of a programme, with the group's spend going directly to the cooperative rather than a reseller."],
                        ['q'=>"How does group size affect what's realistically achievable?",'a'=>"A cooperative that can host 20 people comfortably for a workshop may not have the capacity for 150. For larger groups we're honest about where genuine local sourcing has limits and where we need to bring in additional suppliers to meet demand — we would rather tell you this at the planning stage than overpromise."],
                        ['q'=>'What accommodation options have genuine sustainability practices?','a'=>"A number of riads and desert camps in the Marrakech region operate with solar water heating, greywater reuse, locally sourced breakfast produce or staff drawn from the surrounding community. We assess each property individually rather than relying on marketing claims, and we'll tell you honestly where a property's practices are limited."],
                        ['q'=>'Can sustainability be part of a CSR-linked incentive trip?','a'=>'Yes, this is one of the more common requests we receive. A typical format pairs a standard incentive itinerary with a half-day community engagement component — a cooperative visit, a tree-planting session, or a hands-on workshop — that gives the trip a stated CSR outcome alongside the reward element.'],
                        ['q'=>'Does choosing sustainable suppliers cost more?','a'=>"Sometimes, yes. Cooperative-sourced catering or community-based excursions can carry a premium over mass-market alternatives, and we budget for that transparently rather than hiding it in a bundled rate. We'll flag where a sustainability-aligned choice affects cost so your team can make an informed decision."],
                        ['q'=>'How far in advance should we brief you on sustainability requirements?','a'=>'The earlier the better, ideally at initial brief stage. Supplier vetting for genuine local sourcing and cooperative partnerships takes longer than booking a standard venue, particularly for larger groups or peak season (October to May) dates.'],
                    ];
                    @endphp
                    @foreach($faqs as $i => $faq)
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#susFaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}" aria-controls="susFaq{{ $i }}">
                                {{ $faq['q'] }}
                            </button>
                        </h3>
                        <div id="susFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#susFaq">
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
                <p>Looking to add a community engagement day to a team programme? See our <a href="{{ route('team-building.marrakech') }}">team building & incentive travel</a> service. Planning a congress or conference with a sustainability charter? Visit <a href="{{ route('meetings-conventions.management') }}">meetings & conventions management</a>. For the complete range of ground services, see our <a href="{{ route('dmc.marrakech') }}">DMC Marrakech</a> overview, or browse <a href="{{ route('tours.multi_day') }}">multi-day tour packages</a> for pre- or post-event excursions.</p>
            </div>
        </div>
    </div>
</section>

{{-- FINAL CTA --}}
<section style="background:#181613;padding:64px 0;">
    <div class="container text-center">
        <h2 style="color:#fff;font-size:2rem;margin-bottom:12px;">Plan a Sustainable Event With an Honest Local Team</h2>
        <p style="color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 28px;">
            Local sourcing, cooperative partnerships and transparent reporting — talk with our sustainable events team today.
        </p>
        <div class="row g-3 justify-content-center">
            <div class="col-12 col-sm-auto">
                <a href="#sustainable-enquiry" class="vs-btn d-block">Request a Proposal</a>
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
        flatpickr('#se_date', { mode: 'single', dateFormat: 'Y-m-d', minDate: 'today' });
        const alert = document.querySelector('#sustainable-enquiry .alert');
        if (alert) { alert.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
    });
</script>
@endpush

@endsection
