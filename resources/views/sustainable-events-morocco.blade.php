@extends('layouts.app2')

@section('title', $title ?? 'Sustainable Events Morocco | Responsible Event Management, Marrakech | Morocco Quest DMC')
@section('description', $description ?? 'Plan a sustainable event in Morocco with a Marrakech DMC that sources locally, partners with named artisan cooperatives, and reports honestly on what was actually achieved for your CSR or ESG programme.')
@section('keywords', is_array($keywords ?? null) ? implode(', ', $keywords) : ($keywords ?? 'sustainable events morocco, responsible event management marrakech, CSR events morocco, ESG corporate travel morocco, sustainable MICE morocco'))

@push('jsonld')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Sustainable Event Management",
    "name": "Sustainable Event Management — Morocco Quest DMC",
    "description": "Morocco Quest plans corporate events and travel programmes in Morocco with genuine local sourcing, artisan cooperative partnerships and honest sustainability practices for organisations with CSR and ESG requirements.",
    "provider": {
        "@id": "{{ url('/') }}#organization"
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
            "name": "Do you offer carbon-neutral certification for our event?",
            "acceptedAnswer": { "@type": "Answer", "text": "No. We are not a certification body and we don't claim our events are carbon neutral — that would require independent measurement and audit we don't perform. What we do instead is choose suppliers with genuinely local sourcing where it's available, and give you an honest account of what was actually sourced locally versus what wasn't, so your team can decide how to represent that." }
        },
        {
            "@type": "Question",
            "name": "What does \"local sourcing\" actually mean in practice?",
            "acceptedAnswer": { "@type": "Answer", "text": "It means the catering team is buying produce from Marrakech's markets and regional producers instead of a pre-packaged supply chain, and that transport, staffing and some materials are sourced from operators based in the region rather than flown or trucked in. It doesn't mean every single item on a menu or in a gift box is local — for larger events that's rarely realistic, and we'll tell you where the limits are." }
        },
        {
            "@type": "Question",
            "name": "How do the artisan cooperative partnerships actually work?",
            "acceptedAnswer": { "@type": "Answer", "text": "We work directly with specific cooperatives we know — a weaving collective, an argan oil cooperative, a pottery workshop — rather than routing through a generic \"cultural experience\" reseller. Groups visit, see the work, and buy directly if they choose to, with that spend going to the cooperative. It's a working visit, not a staged stop with a gift shop at the end." }
        },
        {
            "@type": "Question",
            "name": "Can genuine local sourcing keep up with a large event?",
            "acceptedAnswer": { "@type": "Answer", "text": "Not always, and we say so upfront. A cooperative that comfortably hosts 25 people for a workshop can't absorb a group of 300. Past a certain size we bring in additional suppliers to cover the gap, and we'd rather flag that trade-off during planning than let a client assume full local sourcing at any scale." }
        },
        {
            "@type": "Question",
            "name": "What does your reporting support actually cover?",
            "acceptedAnswer": { "@type": "Answer", "text": "After the event we can provide a written summary of which suppliers and cooperatives were used, roughly how much spend stayed local, and what the community engagement component involved. It's meant to be a factual record your team can use in internal ESG or CSR reporting — not a marketing document, and not a substitute for third-party audited certification." }
        }
    ]
}
</script>
@endpush

@push('scripts')
<script>window.__pageContext = { page_type: 'sustainable_events_morocco' };</script>
@endpush

@section('content')

{{-- HERO --}}
<section class="vs-breadcrumb hero-overlay" data-bg-src="{{ asset('assets/img/morocco-quest-atlas-mountains-village-sustainable-hero.webp') }}">
    <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="" class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
    <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="" class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">Sustainable Events Morocco: We Won't Tell You Your Event Is Carbon Neutral</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        Because it isn't, and no DMC's is. What we can do is source locally where it genuinely works, partner with real cooperatives, and tell your team exactly what happened — not what sounds good in a report.
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

{{-- INTRO --}}
<section class="space pb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                <p style="font-size:1.1rem;color:#444;">Most "sustainable event" pitches are a photo of a tree and a claim nobody checked. We'd rather show you the supplier list: which caterer buys from which market, which cooperative your group actually visits, which camp packs its waste out instead of burning it.</p>
                <p style="font-size:1.05rem;color:#555;">If your CSR policy or ESG framework needs a defensible account of what was done, that's what we build toward — not a badge, a record.</p>
                <a href="#sustainable-enquiry" class="vs-btn mt-3">Discuss Your Sustainability Brief</a>
            </div>
        </div>
    </div>
</section>

{{-- ALTERNATING SERVICE STACK --}}
<section class="space">
    <div class="container">

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/morocco-quest-rustic-banquet-dining-sustainable-event-morocco.webp') }}"
                     alt="Rustic banquet dining with natural materials at a sustainable Morocco Quest event in Morocco"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Local Sourcing & Catering</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Menus Built From the Market Down the Road</h2>
                <p>We brief caterers to buy produce from Marrakech's markets and regional growers rather than a boxed, pre-imported catering chain. It doesn't mean every ingredient is local — a large gala menu still needs items the region doesn't produce — but the default is regional first, and we can tell you which dishes on the menu were sourced that way and which weren't.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-9 mx-auto text-center">
                <span class="sec-subtitle style-2">Artisan Cooperative Partnerships</span>
                <h2 class="sec-title" style="font-size:1.6rem;">A Working Visit, Not a Gift Shop Stop</h2>
                <p>We work with specific cooperatives we know directly — a women's argan oil cooperative, a weaving collective, a pottery workshop — rather than a generic "cultural experience" booked through a reseller. Groups see the actual work, spend goes straight to the cooperative if they choose to buy, and the visit is sized to what the cooperative can host, not padded to fill an itinerary slot.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/morocco-quest-argan-cooperative-csr-sustainable-morocco.webp') }}"
                     alt="Women's argan cooperative CSR visit arranged by Morocco Quest for a sustainable event in Morocco"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Waste & Water Conscious Venue Selection</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Practical Choices, Not a Marketing Line</h2>
                <p>At desert camps this means checking whether waste is packed out or burned on site, and whether water use for a group of your size is something the camp can actually support without trucking in extra supply. At riads it means asking about greywater reuse and solar water heating rather than taking a brochure claim at face value. Some properties do this well. Some don't. We tell you which is which.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4">
            <div class="col-lg-9 mx-auto text-center">
                <span class="sec-subtitle style-2">Transparent Reporting Support</span>
                <h2 class="sec-title" style="font-size:1.6rem;">A Record Your ESG Team Can Actually Use</h2>
                <p>After the event, we can put together a written summary of which suppliers and cooperatives were used, roughly how much spend stayed local, and what the community engagement component involved. It's a factual account for your internal reporting, not a certificate — and we won't overstate what a two-day programme actually achieved.</p>
            </div>
        </div>

    </div>
</section>

@include('partials.dmc-testimonials')



{{-- COMPLETE SOLUTIONS — VERTICAL CHECKLIST STRIPE --}}
<section class="space pb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="sec-subtitle">What's Covered</span>
                <h2 class="sec-title">Complete Sustainable Event Solutions</h2>
                <p>Every component of a responsible event programme, sourced and documented honestly.</p>
            </div>
        </div>
        <div class="row g-3 g-lg-4 mt-2 se-solutions">
            @php
            $solutions = [
                ['icon'=>'fa-carrot',              'label'=>'Local Sourcing & Catering',      'desc'=>'Regional suppliers and seasonal menus.'],
                ['icon'=>'fa-hands-holding-circle','label'=>'Artisan Cooperative Visits',      'desc'=>'Named cooperatives we partner with directly.'],
                ['icon'=>'fa-droplet',             'label'=>'Waste & Water Conscious Venues',  'desc'=>'Venues chosen for low resource footprint.'],
                ['icon'=>'fa-file-lines',          'label'=>'Transparent Reporting',           'desc'=>'What was sourced locally, in real numbers.'],
                ['icon'=>'fa-seedling',            'label'=>'Community Engagement',            'desc'=>'CSR activities with a real local recipient.'],
                ['icon'=>'fa-people-group',        'label'=>'Group Coordination',             'desc'=>'One team managing the whole delegation.'],
                ['icon'=>'fa-bus',                 'label'=>'Transport & Logistics',          'desc'=>'Efficient routing and shared transfers.'],
                ['icon'=>'fa-headset',             'label'=>'On-Site Support Team',           'desc'=>'Present for the full run of the event.'],
            ];
            @endphp
            @foreach($solutions as $s)
            <div class="col-6 col-lg-3">
                <div class="se-sol-card">
                    <span class="se-sol-card__badge"><i class="fa-solid fa-check"></i></span>
                    <span class="se-sol-card__icon"><i class="fa-solid {{ $s['icon'] }}"></i></span>
                    <span class="se-sol-card__label">{{ $s['label'] }}</span>
                    <span class="se-sol-card__desc">{{ $s['desc'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .se-sol-card{
        position:relative; height:100%;
        display:flex; flex-direction:column;
        background:#fff; border:1px solid #eef0ec; border-radius:14px;
        padding:26px 22px 22px;
        transition:transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .se-sol-card:hover{
        transform:translateY(-5px);
        box-shadow:0 14px 32px rgba(39,174,96,.12);
        border-color:#cdebd6;
    }
    .se-sol-card__badge{
        position:absolute; top:16px; right:16px;
        width:24px; height:24px; border-radius:50%;
        background:#27ae60; color:#fff;
        display:flex; align-items:center; justify-content:center;
        font-size:.6rem;
    }
    .se-sol-card__icon{
        width:52px; height:52px; border-radius:14px; margin-bottom:16px;
        background:linear-gradient(135deg, rgba(39,174,96,.14), rgba(39,174,96,.05));
        color:#27ae60; font-size:1.35rem;
        display:flex; align-items:center; justify-content:center;
    }
    .se-sol-card__label{
        font-weight:700; font-size:1rem; color:var(--title-color);
        line-height:1.3; margin-bottom:6px;
    }
    .se-sol-card__desc{
        font-size:.83rem; color:#7d857a; line-height:1.5;
    }
    @media (max-width:575px){
        .se-sol-card{ padding:20px 16px; }
        .se-sol-card__icon{ width:44px; height:44px; font-size:1.15rem; border-radius:12px; }
        .se-sol-card__desc{ display:none; }
    }
</style>

{{-- SIGNATURE MODULE: WHAT WE CAN REALISTICALLY DELIVER --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="sec-subtitle">Straight Talk</span>
                <h2 class="sec-title">What We Can Realistically Deliver</h2>
                <p>Sustainability claims in events are easy to make and hard to verify. Here's where we draw the line.</p>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $matrix = [
                ['yes'=>true,  'label'=>'Local sourcing, documented', 'body'=>'We can tell you which suppliers and menu items were sourced regionally, with rough numbers.'],
                ['yes'=>false, 'label'=>'"Carbon neutral" certification', 'body'=>'Not something we measure, audit or certify. We won\'t put this on a proposal.'],
                ['yes'=>true,  'label'=>'Direct cooperative partnerships', 'body'=>'Named cooperatives we work with repeatedly, sized to what they can actually host.'],
                ['yes'=>false, 'label'=>'"Saves the planet" messaging', 'body'=>'A two-day event doesn\'t. We describe what was done, not its planetary impact.'],
                ['yes'=>true,  'label'=>'Honest trade-off disclosure', 'body'=>'Where scale or budget limits local sourcing, we say so before you sign off, not after.'],
                ['yes'=>false, 'label'=>'Third-party audited sustainability badges', 'body'=>'We don\'t issue or imply certification we haven\'t earned from an accredited body.'],
            ];
            @endphp
            @foreach($matrix as $m)
            <div class="col-sm-6 col-lg-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);border-left:4px solid {{ $m['yes'] ? '#27ae60' : '#c0392b' }};">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                        <i class="fa-solid {{ $m['yes'] ? 'fa-circle-check' : 'fa-circle-xmark' }}" style="color:{{ $m['yes'] ? '#27ae60' : '#c0392b' }};font-size:1.1rem;"></i>
                        <div style="font-weight:700;">{{ $m['label'] }}</div>
                    </div>
                    <div style="font-size:.88rem;color:#666;">{{ $m['body'] }}</div>
                    <div style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.03em;color:{{ $m['yes'] ? '#27ae60' : '#c0392b' }};margin-top:10px;">{{ $m['yes'] ? 'What this typically means' : "What we won't claim" }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- WHY MARRAKECH --}}
<section class="space">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6 order-lg-2">
                <span class="sec-subtitle style-2">Why Marrakech</span>
                <h2 class="sec-title">The Cooperatives Were Here Before the Demand For Them Was</h2>
                <p>Morocco has a long-standing tradition of artisan cooperatives — argan oil producers, weaving collectives, pottery workshops — many run by women and organised long before "sustainable events" became a line item on a corporate brief. That's infrastructure we can plug an event into honestly, rather than something built to order for a marketing photo.</p>
                <p>Marrakech also sits close to the Agafay plateau and the Atlas foothills, so a desert camp or mountain-village component is usually under an hour away rather than a long internal transfer. That keeps logistics manageable and cuts down on the transport a multi-region itinerary would otherwise need.</p>
            </div>
            <div class="col-lg-6 order-lg-1">
                <img src="{{ asset('assets/img/morocco-quest-guests-red-carpet-arrival-event-venue-morocco.webp') }}"
                     alt="Corporate guests arriving at a Morocco Quest event venue during a sustainable programme in Marrakech"
                     width="800" height="591"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:420px;" loading="lazy" />
                <div class="row g-3 mt-1">
                    <div class="col-6">
                        <div style="background:#fff;border-radius:10px;padding:18px;text-align:center;box-shadow:0 4px 18px rgba(0,0,0,.06);">
                            <div style="font-size:1.7rem;font-weight:700;color:var(--theme-color);">24h</div>
                            <div style="font-size:.82rem;color:#666;">Quote turnaround</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:#fff;border-radius:10px;padding:18px;text-align:center;box-shadow:0 4px 18px rgba(0,0,0,.06);">
                            <div style="font-size:1.7rem;font-weight:700;color:var(--theme-color);">100%</div>
                            <div style="font-size:.82rem;color:#666;">White-label delivery</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- LEAD FORM --}}
<section class="space bg-theme-07" id="sustainable-enquiry">
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
                    <input type="hidden" name="page_source" value="sustainable-events-morocco">
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

{{-- FAQ (trimmed) --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">FAQ</span>
                    <h2 class="sec-title">Sustainable Events — Common Questions</h2>
                </div>
                <div class="accordion accordion-style1" id="susFaq">
                <style>
                    #susFaq .accordion-button{padding-right:60px;font-size:.95rem;color:var(--title-color);text-transform:none;line-height:1.45;}
                    #susFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #susFaq .accordion-body{font-size:.88rem;text-transform:none;line-height:1.6;letter-spacing:normal;}
                    @media (max-width:575px){
                        #susFaq .accordion-button{font-size:.9rem;line-height:1.4;padding-right:44px;}
                        #susFaq .accordion-body{font-size:.84rem;line-height:1.55;}
                    }
                </style>
                    @php
                    $faqs = [
                        ['q'=>'Do you offer carbon-neutral certification for our event?','a'=>"No. We are not a certification body and we don't claim our events are carbon neutral — that would require independent measurement and audit we don't perform. What we do instead is choose suppliers with genuinely local sourcing where it's available, and give you an honest account of what was actually sourced locally versus what wasn't, so your team can decide how to represent that."],
                        ['q'=>'What does "local sourcing" actually mean in practice?','a'=>"It means the catering team is buying produce from Marrakech's markets and regional producers instead of a pre-packaged supply chain, and that transport, staffing and some materials are sourced from operators based in the region rather than flown or trucked in. It doesn't mean every single item on a menu or in a gift box is local — for larger events that's rarely realistic, and we'll tell you where the limits are."],
                        ['q'=>'How do the artisan cooperative partnerships actually work?','a'=>'We work directly with specific cooperatives we know — a weaving collective, an argan oil cooperative, a pottery workshop — rather than routing through a generic "cultural experience" reseller. Groups visit, see the work, and buy directly if they choose to, with that spend going to the cooperative. It\'s a working visit, not a staged stop with a gift shop at the end.'],
                        ['q'=>'Can genuine local sourcing keep up with a large event?','a'=>"Not always, and we say so upfront. A cooperative that comfortably hosts 25 people for a workshop can't absorb a group of 300. Past a certain size we bring in additional suppliers to cover the gap, and we'd rather flag that trade-off during planning than let a client assume full local sourcing at any scale."],
                        ['q'=>'What does your reporting support actually cover?','a'=>"After the event we can provide a written summary of which suppliers and cooperatives were used, roughly how much spend stayed local, and what the community engagement component involved. It's meant to be a factual record your team can use in internal ESG or CSR reporting — not a marketing document, and not a substitute for third-party audited certification."],
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

@include('partials.dmc-related')


{{-- FINAL CTA --}}
<section class="dmc-cta" style="background:#181613;padding:64px 0;">
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
