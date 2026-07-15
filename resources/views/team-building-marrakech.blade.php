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
    "description": "Morocco Quest designs and delivers team building activities and incentive travel programmes in Marrakech and across Morocco, from desert 4x4 rallies to CSR days with local cooperatives.",
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
            "name": "What happens to the programme if the weather turns on a desert or mountain day?",
            "acceptedAnswer": { "@type": "Answer", "text": "Every itinerary with an Agafay Desert or Atlas Mountain component has a covered or indoor backup built in before you arrive — usually a riad-based workshop or a covered camp activity — so a sandstorm or a cold snap in the mountains doesn't sink the day." }
        },
        {
            "@type": "Question",
            "name": "Is insurance included for activities like quad biking or 4x4 rallies?",
            "acceptedAnswer": { "@type": "Answer", "text": "Activity-specific insurance and licensed operators are arranged for every physical activity we book, and safety briefings are given in your delegates' working language before anyone gets on a quad or into a rally vehicle." }
        },
        {
            "@type": "Question",
            "name": "What's the largest group you can run a programme for?",
            "acceptedAnswer": { "@type": "Answer", "text": "We've handled incentive trips above 250 people by splitting the group into activity waves — half doing the desert rally while the other half does the medina rally, then swapping — so no one is standing around waiting for a vehicle or a guide." }
        },
        {
            "@type": "Question",
            "name": "Can you handle dietary and cultural requirements across a large group?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. We collect dietary and cultural requirements during planning and brief every caterer accordingly, whether that's a desert camp dinner or a riad cooking workshop, covering halal, vegetarian, vegan and allergen needs." }
        },
        {
            "@type": "Question",
            "name": "How far ahead should we book a team building or incentive programme?",
            "acceptedAnswer": { "@type": "Answer", "text": "For groups above 50 people, plan on 3 to 5 months to lock accommodation blocks and activity providers, particularly across March to May and September to November. Smaller groups can often be confirmed within 4 to 6 weeks." }
        }
    ]
}
</script>
@endpush

@section('content')

{{-- HERO --}}
<section class="vs-breadcrumb hero-overlay" data-bg-src="{{ asset('assets/img/morocco-quest-desert-4x4-convoy-team-building-hero.webp') }}">
    <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="" class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
    <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="" class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">Nobody Remembers the Trust Fall. They Remember the Desert.</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        Team building and incentive travel in Marrakech — built around what your group actually needs to get out of it, not a fixed activity catalogue.
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

{{-- INTRO --}}
<section class="space pb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                <p style="font-size:1.1rem;color:#444;">Most corporate offsites fail for the same reason: the activity doesn't match the objective. A trust-fall exercise in a hotel conference room doesn't reward a sales team, and a generic city tour doesn't rebuild trust between two departments that just merged.</p>
                <p style="font-size:1.05rem;color:#555;">Morocco Quest designs team building and incentive programmes in Marrakech that start from what you need the day to accomplish, then draw on Atlas Mountain terrain, the Agafay Desert and the medina to build it — with our own guides and logistics team running the day itself.</p>
                <a href="#teambuilding-enquiry" class="vs-btn mt-3">Talk With Our Team Building Team</a>
            </div>
        </div>
    </div>
</section>

{{-- ALTERNATING SERVICE STACK --}}
<section class="space">
    <div class="container">

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/morocco-quest-camel-caravan-desert-team-building-marrakech.webp') }}"
                     alt="Morocco Quest corporate group on a camel caravan desert team-building challenge near Marrakech"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Desert & Mountain Challenges</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Terrain That Forces People to Actually Work Together</h2>
                <p>Agafay Desert 4x4 rally games with checkpoint challenges, quad biking convoys, camel trekking to a sunset viewpoint, and half-day Atlas Mountain hikes out of Imlil with a Berber guide — these put teams in situations a conference room can't manufacture, where someone has to read a map, someone has to make a call, and the group either coordinates or falls behind schedule.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-9 mx-auto text-center">
                <span class="sec-subtitle style-2">Culinary & Cultural Team Activities</span>
                <h2 class="sec-title" style="font-size:1.6rem;">The Souk Rally Beats the Icebreaker Every Time</h2>
                <p>A riad cooking workshop splits your group into small teams cooking a tagine or pastilla against the clock, judged and eaten together afterward. A medina souk rally — clue-based, GPS-tracked, small mixed teams racing between spice stalls and dye souks — does the same job as an escape room but with better photos and a spice merchant who remembers your group by name.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/morocco-quest-guests-red-carpet-arrival-event-venue-morocco.webp') }}"
                     alt="Morocco Quest incentive group arriving on a red carpet at an exclusive event venue near Marrakech"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Incentive Trip Design</span>
                <h2 class="sec-title" style="font-size:1.6rem;">A Reward Trip That Feels Earned, Not Generic</h2>
                <p>For top-performer trips we build around a centrepiece — an exclusive desert camp with a private dining setup under the stars, a gala dinner in a riad courtyard, or a hot-air balloon sunrise over the Atlas foothills — then fill the rest of the itinerary so the people who hit their number this year get something their colleagues will hear about next year.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4">
            <div class="col-lg-9 mx-auto text-center">
                <span class="sec-subtitle style-2">CSR & Community Engagement</span>
                <h2 class="sec-title" style="font-size:1.6rem;">A Give-Back Day That Isn't Just for Show</h2>
                <p>Half-day visits to a women's argan or weaving cooperative near Marrakech, tree-planting sessions on the outskirts of the Palmeraie, or a supply drop at a rural school your group helps stock — arranged directly with the cooperative or association involved, so the time your team spends there has a real recipient at the other end, not a branded backdrop.</p>
            </div>
        </div>

    </div>
</section>

@include('partials.dmc-testimonials')



{{-- COMPLETE SOLUTIONS — SCATTERED TAG CLOUD --}}
<section class="space pb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="sec-subtitle">What's Covered</span>
                <h2 class="sec-title">Complete Team Building & Incentive Solutions</h2>
                <p>Every component of a team building or incentive programme, handled under one agreement.</p>
            </div>
        </div>
        <div class="tb-tags mt-4">
            @php
            $solutions = [
                ['icon'=>'fa-person-hiking',   'label'=>'Desert & Mountain Challenges', 'rot'=>-3],
                ['icon'=>'fa-utensils',        'label'=>'Culinary & Cultural Activities', 'rot'=>2],
                ['icon'=>'fa-champagne-glasses','label'=>'Incentive Trip Design', 'rot'=>-2],
                ['icon'=>'fa-hands-holding-circle','label'=>'CSR & Community Engagement', 'rot'=>3],
                ['icon'=>'fa-tent',            'label'=>'Desert Camps & Venues', 'rot'=>-4],
                ['icon'=>'fa-shield-halved',   'label'=>'Activity Insurance & Safety', 'rot'=>1],
                ['icon'=>'fa-bus',             'label'=>'Transport & Logistics', 'rot'=>-1],
                ['icon'=>'fa-headset',         'label'=>'On-Site Guides & Support', 'rot'=>4],
            ];
            @endphp
            @foreach($solutions as $i => $s)
            <div class="tb-tag {{ $i % 2 === 0 ? 'tb-tag--dark' : '' }}" style="--rot:{{ $s['rot'] }}deg;">
                <i class="fa-solid {{ $s['icon'] }}"></i>
                <span>{{ $s['label'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .tb-tags{
        display:flex;
        flex-wrap:wrap;
        justify-content:center;
        gap:18px 16px;
        max-width:1000px;
        margin:0 auto;
        padding:10px 0;
    }
    .tb-tag{
        display:inline-flex;
        align-items:center;
        gap:10px;
        padding:14px 22px;
        border-radius:30px;
        background:#fff;
        border:2px solid var(--theme-color);
        font-weight:700;
        font-size:.9rem;
        color:var(--title-color);
        transform:rotate(var(--rot));
        transition:transform .2s ease, background .2s ease, color .2s ease;
        cursor:default;
    }
    .tb-tag i{ color:var(--theme-color); font-size:1.05rem; transition:color .2s ease; }
    .tb-tag--dark{ background:#181613; border-color:#181613; color:#fff; }
    .tb-tag--dark i{ color:var(--theme-color); }
    .tb-tag:hover{
        transform:rotate(0deg) scale(1.06);
        background:var(--theme-color);
        border-color:var(--theme-color);
        color:#fff;
    }
    .tb-tag:hover i{ color:#fff; }
    @media (max-width:767px){
        .tb-tags{ gap:10px 8px; padding:6px 0; }
        .tb-tag{ transform:none; padding:9px 14px; font-size:.74rem; gap:7px; border-width:1.5px; }
        .tb-tag i{ font-size:.85rem; }
    }
    @media (max-width:479px){
        .tb-tags{ gap:8px 6px; }
        .tb-tag{ padding:8px 12px; font-size:.68rem; gap:6px; border-radius:22px; }
        .tb-tag i{ font-size:.78rem; }
    }
</style>

{{-- SIGNATURE MODULE: ACTIVITY TYPE FINDER --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="sec-subtitle">Match Your Objective</span>
                <h2 class="sec-title">Which Activity Format Fits What You're Trying to Do?</h2>
                <p>A starting point — every programme is still built around your actual brief and group profile.</p>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $objectives = [
                ['label'=>'New Team, First Few Months', 'title'=>'Break the Ice Without the Cringe', 'body'=>'Medina souk rally or a riad cooking workshop in small mixed teams — low physical barrier to entry, forces conversation, done within half a day.'],
                ['label'=>'Sales or Performance Reward', 'title'=>'Give Top Performers a Story to Tell', 'body'=>'Desert camp gala dinner, hot-air balloon sunrise, or a full incentive itinerary built around one standout evening.'],
                ['label'=>'Merged or Cross-Department Group', 'title'=>'Build Trust Between People Who Don\'t Know Each Other', 'body'=>'Agafay 4x4 rally or Atlas Mountain hike in mixed-department teams — shared physical challenge outranks a seating chart at dinner.'],
                ['label'=>'CSR / Give-Back Component', 'title'=>'Add a Half-Day That Means Something', 'body'=>'Cooperative visit or tree-planting session with a local partner, usually paired with a lighter activity in the same day.'],
            ];
            @endphp
            @foreach($objectives as $o)
            <div class="col-sm-6 col-lg-3">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-size:.8rem;font-weight:700;color:var(--theme-color);text-transform:uppercase;letter-spacing:.03em;margin-bottom:8px;">{{ $o['label'] }}</div>
                    <div style="font-weight:700;margin-bottom:8px;">{{ $o['title'] }}</div>
                    <div style="font-size:.88rem;color:#666;">{{ $o['body'] }}</div>
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
                <h2 class="sec-title">A Backdrop the Budget Doesn't Have to Fight</h2>
                <p>Marrakech's climate stays workable for outdoor activity most of the year, and it sits under four hours from most major European hubs — short enough that a three-day programme doesn't lose a full day to travel on either end.</p>
                <p>Set against the exchange rate against the euro and pound, a desert camp evening or a full incentive itinerary here typically costs meaningfully less than an equivalent programme in Western Europe, without asking your group to compromise on the setting.</p>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div style="background:#fff;border-radius:12px;padding:32px;box-shadow:0 4px 24px rgba(0,0,0,.07);">
                    <div style="font-size:2.5rem;color:var(--theme-color);line-height:1;margin-bottom:12px;">"</div>
                    <p style="font-size:1.05rem;font-style:italic;color:#333;margin-bottom:20px;">
                        "We took 45 people who'd just gone through a difficult reorganisation and needed something other than another all-hands meeting. Morocco Quest put half the group on quads and half on a souk rally in the morning, then swapped them after lunch. By the desert dinner that evening people who hadn't spoken in months were sitting together."
                    </p>
                    <div style="display:flex;align-items:center;gap:14px;">
                        <div style="width:48px;height:48px;background:#f0f0f0;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                            <i class="fa-solid fa-user" style="color:#aaa;"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:.95rem;">HR Director</div>
                            <div style="font-size:.82rem;color:#777;">European Financial Services Firm</div>
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
<section class="space bg-theme-07" id="teambuilding-enquiry">
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
                                <option value="0" {{ old('children') == '0' ? 'selected' : '' }}>Desert & Mountain Challenge</option>
                                <option value="1" {{ old('children') == '1' ? 'selected' : '' }}>Culinary / Cultural Activity</option>
                                <option value="2" {{ old('children') == '2' ? 'selected' : '' }}>Incentive Trip / Reward Programme</option>
                                <option value="3" {{ old('children') == '3' ? 'selected' : '' }}>CSR / Community Engagement</option>
                                <option value="4" {{ old('children') == '4' ? 'selected' : '' }}>Mixed Programme / Not Sure Yet</option>
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

{{-- FAQ (trimmed) --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">FAQ</span>
                    <h2 class="sec-title">Team Building & Incentive Travel — Common Questions</h2>
                </div>
                <div class="accordion accordion-style1" id="tbFaq">
                <style>
                    #tbFaq .accordion-button{padding-right:60px;font-size:.95rem;color:var(--title-color);text-transform:none;line-height:1.45;}
                    #tbFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #tbFaq .accordion-body{font-size:.88rem;text-transform:none;line-height:1.6;letter-spacing:normal;}
                    @media (max-width:575px){
                        #tbFaq .accordion-button{font-size:.9rem;line-height:1.4;padding-right:44px;}
                        #tbFaq .accordion-body{font-size:.84rem;line-height:1.55;}
                    }
                </style>
                    @php
                    $faqs = [
                        ['q'=>'What happens to the programme if the weather turns on a desert or mountain day?','a'=>'Every itinerary with an Agafay Desert or Atlas Mountain component has a covered or indoor backup built in before you arrive — usually a riad-based workshop or a covered camp activity — so a sandstorm or a cold snap in the mountains doesn\'t sink the day.'],
                        ['q'=>'Is insurance included for activities like quad biking or 4x4 rallies?','a'=>'Activity-specific insurance and licensed operators are arranged for every physical activity we book, and safety briefings are given in your delegates\' working language before anyone gets on a quad or into a rally vehicle.'],
                        ['q'=>'What\'s the largest group you can run a programme for?','a'=>'We\'ve handled incentive trips above 250 people by splitting the group into activity waves — half doing the desert rally while the other half does the medina rally, then swapping — so no one is standing around waiting for a vehicle or a guide.'],
                        ['q'=>'Can you handle dietary and cultural requirements across a large group?','a'=>'Yes. We collect dietary and cultural requirements during planning and brief every caterer accordingly, whether that\'s a desert camp dinner or a riad cooking workshop, covering halal, vegetarian, vegan and allergen needs.'],
                        ['q'=>'How far ahead should we book a team building or incentive programme?','a'=>'For groups above 50 people, plan on 3 to 5 months to lock accommodation blocks and activity providers, particularly across March to May and September to November. Smaller groups can often be confirmed within 4 to 6 weeks.'],
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

@include('partials.dmc-related')

{{-- FINAL CTA --}}
<section class="dmc-cta" style="background:#181613;padding:64px 0;">
    <div class="container text-center">
        <h2 style="color:#fff;font-size:2rem;margin-bottom:12px;">Plan Your Marrakech Team Building Programme</h2>
        <p style="color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 28px;">
            Desert rallies, souk challenges and incentive camps — talk with our team building and incentive team today.
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
