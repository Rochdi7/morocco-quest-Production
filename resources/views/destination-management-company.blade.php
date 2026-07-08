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
    "description": "Morocco Quest operates as a Destination Management Company in Morocco, providing ground logistics, venue and accommodation sourcing, activity programming and on-site management for event agencies, corporations and travel operators.",
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
            "name": "What exactly is a DMC, and how is it different from a local tour operator?",
            "acceptedAnswer": { "@type": "Answer", "text": "A tour operator typically sells finished itineraries to individual travellers. A DMC works business-to-business — it builds and executes ground programmes on behalf of an event agency, corporation or association that already has its own client or delegate group. The distinction is who the end customer belongs to, not the size of the company." }
        },
        {
            "@type": "Question",
            "name": "How does DMC pricing and net rates actually work?",
            "acceptedAnswer": { "@type": "Answer", "text": "A DMC contracts hotels, venues and suppliers at net rates — pricing below what those suppliers would quote a walk-in client — then adds a management fee for sourcing, contracting and on-site delivery. A transparent DMC will show that fee separately rather than folding it invisibly into a single bundled number." }
        },
        {
            "@type": "Question",
            "name": "What licensing should I check before signing with a DMC in Morocco?",
            "acceptedAnswer": { "@type": "Answer", "text": "Ask for the company's Moroccan tourism operator licence number and confirm it is current, and ask for proof of liability insurance that covers your specific group size and activities. A legitimate DMC will produce both without hesitation." }
        },
        {
            "@type": "Question",
            "name": "Can a DMC work white-label for an event agency?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. Most of our agency partners keep the client relationship entirely in-house — we operate behind their brand, on their paper where needed, and our team on the ground is never presented to the delegate as anything other than the agency's local crew." }
        },
        {
            "@type": "Question",
            "name": "How do we start a trial engagement with Morocco Quest as our DMC?",
            "acceptedAnswer": { "@type": "Answer", "text": "Most partnerships start with one programme, not a long-term contract — a single incentive trip, a congress, or ground support for one group. We treat that first programme as the reference point both sides use to decide whether to continue." }
        }
    ]
}
</script>
@endpush

@section('content')

{{-- HERO --}}
<section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/moroccan-architecture-courtyard-orange-tree-tour-banner.webp') }}">
    <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="" class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />
    <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="" class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">One Accountable Partner on the Ground, Instead of Six Vendors You've Never Met</h1>
                    <p style="color:#fff;font-size:1.15rem;max-width:640px;margin:12px auto 0;">
                        What a Destination Management Company actually does in Morocco, and how to tell a serious one from a middleman with a nice website.
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

{{-- INTRO --}}
<section class="space pb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                <p style="font-size:1.1rem;color:#444;">Run a programme in a country you don't operate in and you inherit a second job: chasing hotel contracts in a language you don't speak, vetting a transport company off a single email thread, hoping the venue you booked from a PDF actually has the loading dock your stage crew needs.</p>
                <p style="font-size:1.05rem;color:#555;">A Destination Management Company exists to remove that second job. Morocco Quest contracts and manages the ground layer — transport, venues, accommodation, activities, on-site delivery — under one agreement, so your team keeps ownership of the client relationship and we keep ownership of everything that happens once the group lands.</p>
                <a href="#dmccompany-enquiry" class="vs-btn mt-3">Discuss Your Programme</a>
            </div>
        </div>
    </div>
</section>

{{-- ALTERNATING SERVICE STACK --}}
<section class="space">
    <div class="container">

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/morocco-train-station-al-boraq-travel.webp') }}"
                     alt="Ground transport and transfer logistics for a DMC programme in Morocco"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Ground Logistics & Transport</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Getting People and Equipment Where They Need to Be, on Time</h2>
                <p>Airport arrivals staggered across a dozen flights, inter-city transfers between Marrakech and Casablanca, a fleet sized correctly for a group that splits into three activity tracks on day two — this is the layer that fails silently when it's wrong and nobody notices when it's right. We run our own vetted fleet and driver-guides rather than subcontracting transport blind to whoever answers the phone first.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5 flex-lg-row-reverse">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/dmc-in-morocco-moroccoquest.webp') }}"
                     alt="Hotel and venue sourcing for corporate groups managed by a Morocco DMC"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Venue & Accommodation Sourcing</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Rate Access You Won't Get Calling a Hotel Directly</h2>
                <p>We hold standing contracts with hotel groups and independent venues across Marrakech, Casablanca and Fes, which means a room block or a ballroom gets sourced at net rate rather than the number a hotel's reservations desk quotes a first-time caller. Negotiation on cancellation terms, room upgrades and rooming-list flexibility happens because the relationship already exists.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/jemaa_el_fna_marrakech_sunset_market.webp') }}"
                     alt="Curated group activity programming in Marrakech arranged by a DMC"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">Activity & Experience Programming</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Activities Matched to the Group, Not a Standard Package</h2>
                <p>A 20-person executive incentive and a 300-delegate congress with two free hours between sessions need entirely different activity design — one wants a private riad dinner with a specific wine list, the other needs three parallel excursion options that all return to the venue within a 15-minute window of each other. We build the programme around your group profile first, then match it to what Morocco actually offers.</p>
            </div>
        </div>

        <div class="row align-items-center gy-4 flex-lg-row-reverse">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/morocco-desert-adventure-support.webp') }}"
                     alt="On-site DMC team managing a Morocco programme with 24/7 crisis response"
                     class="w-100" style="border-radius:12px;object-fit:cover;max-height:380px;" loading="lazy" />
            </div>
            <div class="col-lg-6">
                <span class="sec-subtitle style-2">On-Site Management & Crisis Response</span>
                <h2 class="sec-title" style="font-size:1.6rem;">Someone Physically Present When the Plan Changes</h2>
                <p>Flights get delayed, a venue loses power, a delegate needs a hospital at 11pm — none of that is hypothetical over a multi-day programme. Our team stays on-site for the duration, with a single phone number that reaches someone who can actually act, not a call centre reading a script back to you from another time zone.</p>
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
                <h2 class="sec-title">Complete Destination Management Solutions</h2>
                <p>Every component of a Morocco ground programme, handled under one agreement.</p>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $solutions = [
                ['icon'=>'fa-car-side',        'label'=>'Transport & Transfers'],
                ['icon'=>'fa-hotel',           'label'=>'Hotel & Venue Sourcing'],
                ['icon'=>'fa-mountain-sun',    'label'=>'Activity Programming'],
                ['icon'=>'fa-headset',         'label'=>'On-Site Management'],
                ['icon'=>'fa-file-contract',   'label'=>'Licensing & Insurance'],
                ['icon'=>'fa-users',           'label'=>'Group Coordination'],
                ['icon'=>'fa-utensils',        'label'=>'Catering & Dining'],
                ['icon'=>'fa-triangle-exclamation', 'label'=>'24/7 Crisis Response'],
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

{{-- SIGNATURE MODULE: HOW TO EVALUATE A DMC PARTNER --}}
<section class="space bg-theme-07">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="sec-subtitle">Choosing a Partner</span>
                <h2 class="sec-title">How to Evaluate a DMC Before You Sign</h2>
                <p>Anyone can put "DMC" on a homepage. These are the six things worth actually checking.</p>
            </div>
        </div>
        <div class="row g-4 mt-2">
            @php
            $criteria = [
                ['title'=>'Licensing & Insurance', 'body'=>'Ask for the tourism operator licence number and confirm it\'s current with the Moroccan authorities. Ask for proof of liability insurance that names your group size and activities specifically, not a generic policy summary.'],
                ['title'=>'Transparent Net Pricing', 'body'=>'Request a cost breakdown by service line — transport, venue, accommodation, activities — rather than one bundled total. A DMC that resists itemising its pricing is usually padding the mark-up somewhere in the middle.'],
                ['title'=>'Local Team Size & Presence', 'body'=>'Ask directly how many people will be physically on-site during your programme, not how many the company employs in total. A 200-delegate congress covered by two staff is a company that hasn\'t planned for anything going wrong at once.'],
                ['title'=>'References & Track Record', 'body'=>'Ask for a reference from a programme similar in size and complexity to yours, and actually call them. A polished case study on a website tells you nothing about how the company handles a supplier cancelling three days out.'],
                ['title'=>'Response Times', 'body'=>'Time how long the proposal stage takes — a first reply within a day, a full costed proposal within a week. How a DMC responds while trying to win your business is a reasonable proxy for how it responds once it already has it.'],
                ['title'=>'Supplier Network Depth', 'body'=>'Ask what the fallback option is if your first-choice venue or hotel falls through. A DMC with direct, contracted relationships across multiple properties can pivot in hours; one relying on a single supplier contact cannot.'],
            ];
            @endphp
            @foreach($criteria as $c)
            <div class="col-sm-6 col-lg-4">
                <div class="p-4" style="background:#fff;border-radius:12px;height:100%;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    <div style="font-weight:700;margin-bottom:8px;">{{ $c['title'] }}</div>
                    <div style="font-size:.88rem;color:#666;">{{ $c['body'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- WHY MOROCCO + TESTIMONIAL --}}
<section class="space">
    <div class="container">
        <div class="row align-items-center gy-5 gx-xl-5">
            <div class="col-lg-6 order-lg-2">
                <span class="sec-subtitle style-2">Why Morocco</span>
                <h2 class="sec-title">A Gateway Position That Actually Shows Up in the Logistics</h2>
                <p>Morocco sits within a four-hour flight of most European capitals, on the same working clock as Western Europe, with growing air access from the Gulf and North America through Casablanca. For an agency or corporation weighing where to run a first international programme, that geography is the difference between a supplier answering your call during your own working hours and a nine-hour lag on every decision.</p>
                <p>The country's MICE infrastructure has caught up with that positioning — purpose-built convention space in Marrakech and Casablanca, a hotel base that's expanded steadily through the four- and five-star tiers, and a supplier ecosystem in AV, transport and catering that no longer requires importing crews from Europe for anything short of the largest builds.</p>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div style="background:#fff;border-radius:12px;padding:32px;box-shadow:0 4px 24px rgba(0,0,0,.07);">
                    <div style="font-size:2.5rem;color:var(--theme-color);line-height:1;margin-bottom:12px;">"</div>
                    <p style="font-size:1.05rem;font-style:italic;color:#333;margin-bottom:20px;">
                        "We'd never sold Morocco before and weren't sure our clients would go for it over Portugal or Croatia. Morocco Quest sent us a proposal with net rates itemised by line, not a lump sum, and put us on a call with a reference client running a similar-sized group the week before. That transparency is what got our first booking approved internally."
                    </p>
                    <div style="display:flex;align-items:center;gap:14px;">
                        <div style="width:48px;height:48px;background:#f0f0f0;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                            <i class="fa-solid fa-user" style="color:#aaa;"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:.95rem;">Event Agency Director</div>
                            <div style="font-size:.82rem;color:#777;">UK-Based Corporate Events Agency</div>
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
<section class="space bg-theme-07" id="dmccompany-enquiry">
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
                            <label for="dmccompany_name" style="font-weight:600;margin-bottom:4px;display:block;">Full Name *</label>
                            <input id="dmccompany_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your full name" value="{{ old('name') }}" required autocomplete="name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmccompany_company" style="font-weight:600;margin-bottom:4px;display:block;">Company / Organization *</label>
                            <input id="dmccompany_company" name="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" placeholder="Your company or organization" value="{{ old('nationality') }}" required />
                            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmccompany_email" style="font-weight:600;margin-bottom:4px;display:block;">Business Email *</label>
                            <input id="dmccompany_email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@company.com" value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmccompany_phone" style="font-weight:600;margin-bottom:4px;display:block;">Phone / WhatsApp *</label>
                            <input id="dmccompany_phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="+1 / +44 / +33..." value="{{ old('phone') }}" required autocomplete="tel" />
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmccompany_date" style="font-weight:600;margin-bottom:4px;display:block;">Programme Dates *</label>
                            <input id="dmccompany_date" name="arrival_date" type="text" class="form-control @error('arrival_date') is-invalid @enderror" placeholder="Select programme date" value="{{ old('arrival_date') }}" required readonly />
                            @error('arrival_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmccompany_pax" style="font-weight:600;margin-bottom:4px;display:block;">Group Size (Pax)</label>
                            <input id="dmccompany_pax" name="adults" type="number" min="1" class="form-control @error('adults') is-invalid @enderror" placeholder="Number of participants" value="{{ old('adults') }}" />
                            @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dmccompany_duration" style="font-weight:600;margin-bottom:4px;display:block;">Programme Duration (Days) *</label>
                            <input id="dmccompany_duration" name="duration_days" type="number" min="1" class="form-control @error('duration_days') is-invalid @enderror" placeholder="Number of days" value="{{ old('duration_days') }}" required />
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
                            <label for="dmccompany_brief" style="font-weight:600;margin-bottom:4px;display:block;">Brief Description *</label>
                            <textarea id="dmccompany_brief" name="travel_ideas" class="form-control @error('travel_ideas') is-invalid @enderror" placeholder="Describe your programme: destinations, group profile, services needed, budget range..." rows="5" required>{{ old('travel_ideas') }}</textarea>
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

{{-- FAQ (trimmed) --}}
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="sec-subtitle">FAQ</span>
                    <h2 class="sec-title">Destination Management — Common Questions</h2>
                </div>
                <div class="accordion accordion-style1" id="dmcCoFaq">
                <style>
                    #dmcCoFaq .accordion-button{padding-right:60px;font-size:1rem;color:var(--title-color);}
                    #dmcCoFaq .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #dmcCoFaq .accordion-body{font-size:.92rem;}
                </style>
                    @php
                    $faqs = [
                        ['q'=>'What exactly is a DMC, and how is it different from a local tour operator?','a'=>'A tour operator typically sells finished itineraries to individual travellers. A DMC works business-to-business — it builds and executes ground programmes on behalf of an event agency, corporation or association that already has its own client or delegate group. The distinction is who the end customer belongs to, not the size of the company.'],
                        ['q'=>'How does DMC pricing and net rates actually work?','a'=>'A DMC contracts hotels, venues and suppliers at net rates — pricing below what those suppliers would quote a walk-in client — then adds a management fee for sourcing, contracting and on-site delivery. A transparent DMC will show that fee separately rather than folding it invisibly into a single bundled number.'],
                        ['q'=>'What licensing should I check before signing with a DMC in Morocco?','a'=>'Ask for the company\'s Moroccan tourism operator licence number and confirm it is current, and ask for proof of liability insurance that covers your specific group size and activities. A legitimate DMC will produce both without hesitation.'],
                        ['q'=>'Can a DMC work white-label for an event agency?','a'=>'Yes. Most of our agency partners keep the client relationship entirely in-house — we operate behind their brand, on their paper where needed, and our team on the ground is never presented to the delegate as anything other than the agency\'s local crew.'],
                        ['q'=>'How do we start a trial engagement with Morocco Quest as our DMC?','a'=>'Most partnerships start with one programme, not a long-term contract — a single incentive trip, a congress, or ground support for one group. We treat that first programme as the reference point both sides use to decide whether to continue.'],
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
<section class="space pt-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                <h3 class="sec-title mb-3" style="font-size:1.4rem;">Related DMC Services</h3>
                <p>For our full range of ground services and B2B rates, see the <a href="{{ route('dmc.marrakech') }}">DMC Marrakech</a> overview. If your programme centres on a corporate meeting or conference, visit <a href="{{ route('meetings-conventions.management') }}">meetings & conventions management</a>. Organising a congress or association event? See <a href="{{ route('congress-organization.morocco') }}">professional congress organization</a>. For pre- or post-programme excursions for delegates, browse our <a href="{{ route('tours.multi_day') }}">multi-day tour packages</a>.</p>
            </div>
        </div>
    </div>
</section>

{{-- FINAL CTA --}}
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
        flatpickr('#dmccompany_date', { mode: 'single', dateFormat: 'Y-m-d', minDate: 'today' });
        const alert = document.querySelector('#dmccompany-enquiry .alert');
        if (alert) { alert.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
    });
</script>
@endpush

@endsection
