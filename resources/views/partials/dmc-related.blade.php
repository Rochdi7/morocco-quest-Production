{{-- ═══════════════════════════════════════════════════════
     RELATED DMC SERVICES — full list of DMC pages (shared partial)
     Pass $current = current route name to exclude it from the grid.
═══════════════════════════════════════════════════════ --}}
@php
    $current = $current ?? (\Illuminate\Support\Facades\Route::currentRouteName());
    $dmcServices = [
        ['route' => 'dmc.marrakech',                  'icon' => 'fa-map-location-dot', 'title' => 'DMC Marrakech',                  'desc' => 'Full ground-services overview for agents & operators.'],
        ['route' => 'destination-management.company', 'icon' => 'fa-sitemap',          'title' => 'Destination Management Company', 'desc' => 'What a DMC does & how to evaluate a Morocco partner.'],
        ['route' => 'meetings-conventions.management','icon' => 'fa-handshake',        'title' => 'Meetings & Conventions',        'desc' => 'Venue sourcing, AV and delegate logistics.'],
        ['route' => 'team-building.marrakech',        'icon' => 'fa-people-group',     'title' => 'Team Building & Incentive Travel','desc' => 'Desert, Atlas & medina programmes that fit the brief.'],
        ['route' => 'events-production.morocco',      'icon' => 'fa-lightbulb',        'title' => 'Events Production',             'desc' => 'Scenography, lighting, sound and LED production.'],
        ['route' => 'congress-organization.morocco',  'icon' => 'fa-microphone-lines', 'title' => 'Professional Congress Organization','desc' => 'Abstracts, registration, sponsors & on-site delivery.'],
        ['route' => 'sustainable-events.morocco',     'icon' => 'fa-leaf',             'title' => 'Sustainable Events',            'desc' => 'Low-impact events with local, responsible sourcing.'],
        ['route' => '360-solutions.morocco',          'icon' => 'fa-arrows-rotate',    'title' => '360° Event & Travel Solutions', 'desc' => 'End-to-end delivery under one project manager.'],
    ];
@endphp

<section class="space pt-0 dmc-related">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-4">
                <h3 class="sec-title" style="font-size:1.5rem;">Related DMC Services</h3>
                <p>Explore the full range of Morocco Quest ground services — every part of your programme, handled by one local partner.</p>
            </div>
        </div>
        <div class="row g-3 justify-content-center">
            @foreach($dmcServices as $s)
                @continue($s['route'] === $current)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route($s['route']) }}" class="dmc-related__card">
                        <span class="dmc-related__icon"><i class="fa-solid {{ $s['icon'] }}"></i></span>
                        <span class="dmc-related__title">{{ $s['title'] }}</span>
                        <span class="dmc-related__desc">{{ $s['desc'] }}</span>
                        <span class="dmc-related__go">Learn more <i class="fa-solid fa-arrow-right-long"></i></span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .dmc-related__card{
        display:flex; flex-direction:column; height:100%;
        background:#fff; border:1px solid #ececec; border-radius:12px;
        padding:22px 20px; text-align:left; text-decoration:none;
        transition:transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .dmc-related__card:hover{
        transform:translateY(-5px);
        box-shadow:0 12px 28px rgba(0,0,0,.09);
        border-color:var(--theme-color);
    }
    .dmc-related__icon{
        width:46px; height:46px; border-radius:10px; margin-bottom:14px;
        background:var(--theme-color); color:#fff;
        display:flex; align-items:center; justify-content:center; font-size:1.15rem;
    }
    .dmc-related__title{ font-weight:700; font-size:.98rem; color:var(--title-color); line-height:1.3; margin-bottom:6px; }
    .dmc-related__desc{ font-size:.82rem; color:#777; line-height:1.45; flex-grow:1; }
    .dmc-related__go{
        margin-top:14px; font-size:.82rem; font-weight:700; color:var(--theme-color);
        display:inline-flex; align-items:center; gap:6px;
    }
    .dmc-related__go i{ transition:transform .25s ease; }
    .dmc-related__card:hover .dmc-related__go i{ transform:translateX(4px); }

    /* ── Shared Final CTA — smaller buttons & text on desktop + mobile ── */
    .dmc-cta h2{ font-size:1.7rem !important; line-height:1.25; margin-bottom:10px !important; }
    .dmc-cta p{ font-size:.95rem; }
    .dmc-cta .vs-btn{
        font-size:13px;
        padding:13px 26px;
        border-radius:11px;
    }
    .dmc-cta .vs-btn i{ font-size:.9em; }
    @media (max-width:575px){
        .dmc-cta{ padding:44px 0 !important; }
        .dmc-cta h2{ font-size:1.35rem !important; }
        .dmc-cta p{ font-size:.85rem; margin-bottom:22px !important; }
        .dmc-cta .vs-btn{ font-size:12px; padding:11px 20px; }
    }
</style>
