@extends('layouts.app2')

{{-- /dmc-marrakech (EN) + /fr/dmc-marrakech (FR). One template; copy comes from
     resources/content/dmc-marrakech/{en,fr}.php via DmcController. Title, meta,
     canonical, hreflang and OG are set in the controller (SEOMeta/OpenGraph);
     these @section values are fallbacks only. Spec: docs/seo/dmc-marrakech-benchmarking/16. --}}
@section('title', $c['meta']['title'])
@section('description', $c['meta']['description'])
@section('keywords', implode(', ', $keywords))
@section('body_class', 'dmc-page dmcm-page')

@php
    $imgDir = 'assets/img/dmc-marrakech/dmc-marrakech-';
    // Generated widths per image family (see docs/seo/dmc-marrakech-benchmarking/22).
    $sets = [
        'hero'   => [[640, 960, 1280], 1280 / 528],
        'tile'   => [[400, 600], 4 / 3],
        'guide'  => [[480, 720], 3 / 2],
        'sample' => [[480, 720], 3 / 2],
        'wide'   => [[600, 900], null],
        'cover'  => [[640, 1000], 16 / 9],
    ];
    $img = function (string $base, string $set, string $sizes, string $alt, bool $lazy = true, ?float $ratio = null) use ($imgDir, $sets) {
        [$widths, $r] = $sets[$set];
        $r = $ratio ?? $r;
        $srcset = collect($widths)->map(fn ($w) => asset("{$imgDir}{$base}-{$w}.webp") . " {$w}w")->implode(', ');
        $max = end($widths);
        $attrs = $lazy ? 'loading="lazy" decoding="async"' : 'fetchpriority="high" decoding="async"';
        return '<img src="' . asset("{$imgDir}{$base}-{$max}.webp") . '" srcset="' . $srcset . '" sizes="' . $sizes . '"'
            . ' width="' . $max . '" height="' . round($max / $r) . '" alt="' . e($alt) . '" ' . $attrs . '>';
    };
    $heroSrcset = collect($sets['hero'][0])->map(fn ($w) => asset("{$imgDir}hero-lantern-gala-dinner-{$w}.webp") . " {$w}w")->implode(', ');
    $f = $c['form'];
    $isFr = $locale === 'fr';
@endphp

@push('preload')
<link rel="preload" as="image" fetchpriority="high" imagesrcset="{{ $heroSrcset }}" imagesizes="100vw">
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dmc-marrakech.css') }}?v={{ @filemtime(base_path('assets/css/dmc-marrakech.css')) }}">
@endpush

@push('jsonld')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    '@id' => $pageUrl . '#webpage',
    'url' => $pageUrl,
    'name' => $c['meta']['title'],
    'description' => $c['meta']['description'],
    'inLanguage' => $locale,
    'isPartOf' => ['@id' => url('/') . '#website'],
    'about' => ['@id' => url('/') . '#organization'],
    'breadcrumb' => ['@id' => $pageUrl . '#breadcrumb'],
    'primaryImageOfPage' => [
        '@type' => 'ImageObject',
        'url' => asset($imgDir . 'hero-lantern-gala-dinner-1280.webp'),
        'width' => 1280,
        'height' => 528,
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    '@id' => $pageUrl . '#service',
    'serviceType' => $isFr ? 'Services de DMC (agence réceptive)' : 'Destination Management Company (DMC) Services',
    'name' => 'DMC Marrakech — Morocco Quest DMC',
    'alternateName' => $isFr
        ? ['Agence réceptive Marrakech', 'DMC Maroc', 'Destination Management Company Marrakech']
        : ['Marrakech DMC', 'Morocco DMC', 'Destination Management Company Marrakech'],
    'description' => $c['meta']['description'],
    'provider' => ['@id' => url('/') . '#organization'],
    'areaServed' => [
        ['@type' => 'City', 'name' => 'Marrakech'],
        ['@type' => 'Country', 'name' => 'Morocco'],
    ],
    'availableLanguage' => ['en', 'fr', 'es', 'ar'],
    'audience' => [
        '@type' => 'BusinessAudience',
        'audienceType' => $isFr
            ? 'Agences de voyages, tour-opérateurs, agences d\'incentive et organisateurs MICE'
            : 'Travel agents, tour operators, incentive houses and MICE planners',
    ],
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name' => $c['services']['h2'],
        'itemListElement' => array_map(fn ($t) => [
            '@type' => 'Offer',
            'itemOffered' => ['@type' => 'Service', 'name' => $t['title'], 'description' => $t['text']],
        ], $c['services']['tiles']),
    ],
    'url' => $pageUrl,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    '@id' => $pageUrl . '#breadcrumb',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => $c['breadcrumb']['home'], 'item' => url('/')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => $c['breadcrumb']['current'], 'item' => $pageUrl],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
{{-- No FAQPage markup: FAQ rich results are limited to well-known government and
     health sites, so this page is not eligible (Google, Aug 2023). The visible FAQ
     below stays as normal content. --}}
@endpush

@push('scripts')
<script>window.__pageContext = { page_type: 'dmc_marrakech', page_lang: '{{ $locale }}' };</script>
<script>
/* Tiles link to #guide-…: open the matching <details> before the browser scrolls to it. */
(function () {
    function openFromHash() {
        var id = location.hash.slice(1); if (!id) return;
        var el = document.getElementById(id);
        if (el && el.tagName === 'DETAILS') { el.open = true; }
    }
    window.addEventListener('hashchange', openFromHash);
    document.addEventListener('DOMContentLoaded', function () {
        openFromHash();
        var a = document.querySelector('#dmc-enquiry .alert');
        if (a) a.scrollIntoView({ block: 'center' });
    });
})();
</script>
@endpush

@section('content')

@include('partials.dmc-spacing')

{{-- 1 · HERO ───────────────────────────────────────────── --}}
<section class="dmcm-hero" aria-labelledby="dmcm-h1">
    <img class="dmcm-hero__img" src="{{ asset($imgDir . 'hero-lantern-gala-dinner-1280.webp') }}" srcset="{{ $heroSrcset }}" sizes="100vw"
         width="1280" height="528" alt="{{ $c['hero']['image_alt'] }}" fetchpriority="high" decoding="async">
    <div class="dmcm-hero__shade" aria-hidden="true"></div>
    <div class="container dmcm-hero__inner">
        <nav class="dmcm-crumbs" aria-label="Breadcrumb">
            <ol>
                <li><a href="{{ url('/') }}">{{ $c['breadcrumb']['home'] }}</a></li>
                <li aria-current="page">{{ $c['breadcrumb']['current'] }}</li>
            </ol>
            <a class="dmcm-lang" href="{{ route($c['lang_switch']['route']) }}" hreflang="{{ $c['lang_switch']['hreflang'] }}" lang="{{ $c['lang_switch']['hreflang'] }}">
                <i class="fa-solid fa-globe" aria-hidden="true"></i> {{ $c['lang_switch']['label'] }}
            </a>
        </nav>
        <p class="dmcm-hero__eyebrow">{{ $c['hero']['eyebrow'] }}</p>
        <h1 id="dmcm-h1" class="dmcm-hero__title">{{ $c['hero']['h1'] }}</h1>
        <p class="dmcm-hero__lead">{{ $c['hero']['lead'] }}</p>
        <div class="dmcm-hero__ctas">
            <a href="#dmc-enquiry" class="dmcm-btn dmcm-btn--primary">{{ $c['hero']['cta_quote'] }}</a>
            <a href="{{ $c['hero']['whatsapp_url'] }}" class="dmcm-btn dmcm-btn--wa" target="_blank" rel="noopener">
                <i class="fa-brands fa-whatsapp" aria-hidden="true"></i> {{ $c['hero']['cta_whatsapp'] }}
            </a>
        </div>
    </div>
</section>

{{-- 2 · VERIFIED FACTS ────────────────────────────────── --}}
<section class="dmcm-facts" aria-labelledby="dmcm-facts-h">
    <div class="container">
        <h2 id="dmcm-facts-h" class="visually-hidden">{{ $c['facts']['heading'] }}</h2>
        <ul class="dmcm-facts__list">
            @foreach($c['facts']['items'] as $fact)
            <li class="dmcm-facts__item">
                <i class="fa-solid {{ $fact['icon'] }}" aria-hidden="true"></i>
                <span class="dmcm-facts__label">{{ $fact['label'] }}</span>
                <span class="dmcm-facts__value">{{ $fact['value'] }}</span>
                @if($fact['link'])
                    <a class="dmcm-facts__link" href="{{ $fact['link'] }}" @if(str_starts_with($fact['link'], 'http')) target="_blank" rel="noopener" @endif>{{ $fact['link_label'] }}</a>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</section>

{{-- 3 · WHO WE ARE ────────────────────────────────────── --}}
<section class="dmcm-section" id="who-we-are">
    <div class="container">
        <div class="row gy-4 gx-xl-5 align-items-center">
            <div class="col-lg-6">
                <p class="dmcm-eyebrow">{{ $c['who']['eyebrow'] }}</p>
                <h2 class="dmcm-h2">{{ $c['who']['h2'] }}</h2>
                @foreach($c['who']['paragraphs'] as $p)<p>{{ $p }}</p>@endforeach
                <ul class="dmcm-checks">
                    @foreach($c['who']['bullets'] as $b)<li>{{ $b }}</li>@endforeach
                </ul>
            </div>
            <div class="col-lg-6">
                <figure class="dmcm-figure">{!! $img('medina-street-jemaa-el-fna', 'wide', '(min-width: 992px) 540px, 100vw', $c['who']['image_alt'], true, 4 / 3) !!}</figure>
            </div>
        </div>
        <div class="dmcm-team">
            <h3 class="dmcm-h3">{{ $c['who']['team_heading'] }}</h3>
            <p class="dmcm-muted">{{ $c['who']['team_intro'] }}</p>
            <ul class="dmcm-team__list">
                @foreach($c['who']['team'] as $m)
                <li class="dmcm-team__item">
                    <img src="{{ asset($m['img']) }}" width="{{ $m['w'] }}" height="{{ $m['h'] }}" alt="{{ $m['name'] }}, {{ $m['role'] }}" loading="lazy" decoding="async">
                    <span class="dmcm-team__name">{{ $m['name'] }}</span>
                    <span class="dmcm-team__role">{{ $m['role'] }}</span>
                </li>
                @endforeach
            </ul>
            <a class="dmcm-link" href="{{ route('about') }}">{{ $c['who']['about_link'] }} <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></a>
        </div>
    </div>
</section>

{{-- 4 · CORE SERVICES (8 tiles) ───────────────────────── --}}
<section class="dmcm-section dmcm-section--tint" id="dmc-services">
    <div class="container">
        <div class="dmcm-head">
            <p class="dmcm-eyebrow">{{ $c['services']['eyebrow'] }}</p>
            <h2 class="dmcm-h2">{{ $c['services']['h2'] }}</h2>
            <p>{{ $c['services']['intro'] }}</p>
        </div>
        <ul class="dmcm-tiles">
            @foreach($c['services']['tiles'] as $t)
            <li class="dmcm-tile">
                {!! $img($t['img'], 'tile', '(min-width: 1200px) 270px, (min-width: 768px) 45vw, 92vw', $t['alt']) !!}
                <div class="dmcm-tile__body">
                    <h3 class="dmcm-tile__title">{{ $t['title'] }}</h3>
                    <p>{{ $t['text'] }}</p>
                    <div class="dmcm-tile__links">
                        <a href="#{{ $t['anchor'] }}">{{ $c['services']['details_label'] }}</a>
                        @if($t['route'])
                            <a href="{{ route($t['route']) }}">{{ $t['route_label'] }} <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></a>
                        @endif
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</section>

{{-- 5 · SERVICES GUIDE ────────────────────────────────── --}}
<section class="dmcm-section" id="dmc-guide">
    <div class="container">
        <div class="dmcm-head">
            <p class="dmcm-eyebrow">{{ $c['guide']['eyebrow'] }}</p>
            <h2 class="dmcm-h2">{{ $c['guide']['h2'] }}</h2>
            <p>{{ $c['guide']['intro'] }}</p>
        </div>
        <div class="dmcm-guide">
            @foreach($c['guide']['items'] as $i => $g)
            <details class="dmcm-guide__item" id="{{ $g['id'] }}" @if($i === 0) open @endif>
                <summary><h3 class="dmcm-guide__title">{{ $g['title'] }}</h3></summary>
                <div class="dmcm-guide__body @if($g['img']) has-img @endif">
                    <div class="dmcm-prose">{!! $g['html'] !!}</div>
                    @if($g['img'])
                        <figure class="dmcm-figure">{!! $img($g['img'], 'guide', '(min-width: 992px) 360px, 100vw', $g['img_alt']) !!}</figure>
                    @endif
                </div>
            </details>
            @endforeach
        </div>
    </div>
</section>

{{-- 6 · MARRAKECH FOR EVENT PLANNERS ──────────────────── --}}
<section class="dmcm-section dmcm-section--tint" id="marrakech-for-planners">
    <div class="container">
        <div class="dmcm-head">
            <p class="dmcm-eyebrow">{{ $c['planner']['eyebrow'] }}</p>
            <h2 class="dmcm-h2">{{ $c['planner']['h2'] }}</h2>
            <p>{{ $c['planner']['intro'] }}</p>
        </div>
        <div class="row gy-4 gx-xl-5">
            <div class="col-lg-7">
                <table class="dmcm-facts-table">
                    <tbody>
                    @foreach($c['planner']['rows'] as $row)
                        <tr>
                            <th scope="row">{{ $row['k'] }}</th>
                            <td>{{ $row['v'] }}@foreach($row['src'] as $s)<sup><a href="#dmcm-src-{{ $s }}" aria-label="{{ $c['planner']['sources_label'] }} {{ $s }}">[{{ $s }}]</a></sup>@endforeach</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-5">
                <figure class="dmcm-figure">{!! $img('jemaa-el-fna-square-dusk', 'wide', '(min-width: 992px) 440px, 100vw', $c['planner']['image_alt'], true, 3 / 2) !!}</figure>
                <figure class="dmcm-map">
                    <svg viewBox="0 0 400 236" role="img" aria-labelledby="dmcm-map-t">
                        <title id="dmcm-map-t">{{ $c['planner']['map']['title'] }}</title>
                        @php $pts = [[300, 58], [92, 72], [86, 192]]; @endphp
                        @foreach($c['planner']['map']['points'] as $k => $p)
                            <line x1="210" y1="128" x2="{{ $pts[$k][0] }}" y2="{{ $pts[$k][1] }}" class="dmcm-map__line"/>
                            <circle cx="{{ $pts[$k][0] }}" cy="{{ $pts[$k][1] }}" r="6" class="dmcm-map__dot"/>
                            <text x="{{ $pts[$k][0] }}" y="{{ $pts[$k][1] - 12 }}" text-anchor="middle" class="dmcm-map__name">{{ $p['name'] }}</text>
                            <text x="{{ $pts[$k][0] }}" y="{{ $pts[$k][1] + 22 }}" text-anchor="middle" class="dmcm-map__time">{{ $p['time'] }}</text>
                        @endforeach
                        <circle cx="210" cy="128" r="11" class="dmcm-map__hub"/>
                        <text x="210" y="156" text-anchor="middle" class="dmcm-map__hubname">{{ $c['planner']['map']['center'] }}</text>
                    </svg>
                    <figcaption>{{ $c['planner']['map']['title'] }}. {{ $c['planner']['map']['note'] }}</figcaption>
                </figure>
            </div>
        </div>
        <div class="dmcm-sources">
            <h3 class="dmcm-sources__title">{{ $c['planner']['sources_label'] }}</h3>
            <ol>
                @foreach($c['planner']['sources'] as $n => $s)
                    <li id="dmcm-src-{{ $n }}" value="{{ $n }}"><a href="{{ $s['url'] }}" target="_blank" rel="noopener">{{ $s['label'] }}</a></li>
                @endforeach
            </ol>
        </div>
    </div>
</section>

{{-- 7 · PROGRAMMES: real case studies (when supplied) + sample formats ── --}}
@if(!empty($c['case_studies']))
<section class="dmcm-section" id="programmes-delivered">
    <div class="container">
        {{-- Populate resources/content/dmc-marrakech/*.php → case_studies with approved, real programmes. --}}
        <div class="dmcm-cards">
            @foreach($c['case_studies'] as $cs)
            <article class="dmcm-card">
                <h3 class="dmcm-card__title">{{ $cs['title'] }}</h3>
                <p>{{ $cs['summary'] }}</p>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="dmcm-section" id="sample-programmes">
    <div class="container">
        <div class="dmcm-head">
            <p class="dmcm-eyebrow">{{ $c['samples']['eyebrow'] }}</p>
            <h2 class="dmcm-h2">{{ $c['samples']['h2'] }}</h2>
            <p class="dmcm-note"><i class="fa-solid fa-circle-info" aria-hidden="true"></i> {{ $c['samples']['disclaimer'] }}</p>
        </div>
        <div class="dmcm-cards">
            @foreach($c['samples']['items'] as $s)
            <article class="dmcm-card">
                {!! $img($s['img'], 'sample', '(min-width: 992px) 360px, 100vw', $s['alt']) !!}
                <div class="dmcm-card__body">
                    <h3 class="dmcm-card__title">{{ $s['title'] }}</h3>
                    <p class="dmcm-card__meta">{{ $s['meta'] }}</p>
                    <ul class="dmcm-checks dmcm-checks--sm">
                        @foreach($s['points'] as $pt)<li>{{ $pt }}</li>@endforeach
                    </ul>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

{{-- 8 · MOROCCO-WIDE COVERAGE ─────────────────────────── --}}
<section class="dmcm-section dmcm-section--tint" id="morocco-coverage">
    <div class="container">
        <div class="row gy-4 gx-xl-5 align-items-center">
            <div class="col-lg-6">
                <p class="dmcm-eyebrow">{{ $c['coverage']['eyebrow'] }}</p>
                <h2 class="dmcm-h2">{{ $c['coverage']['h2'] }}</h2>
                <p>{{ $c['coverage']['intro'] }}</p>
                <ul class="dmcm-cities">
                    @foreach($c['coverage']['cities'] as $city)
                        <li><strong>{{ $city['city'] }}</strong><span>{{ $city['label'] }}</span></li>
                    @endforeach
                </ul>
                <p class="dmcm-links">
                    @foreach($c['coverage']['links'] as $l)
                        <a class="dmcm-link" href="{{ route($l['route']) }}">{{ $l['label'] }} <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></a>
                    @endforeach
                </p>
            </div>
            <div class="col-lg-6">
                <figure class="dmcm-figure">{!! $img('atlas-mountain-road-coverage', 'cover', '(min-width: 992px) 540px, 100vw', $c['coverage']['image_alt']) !!}</figure>
            </div>
        </div>
    </div>
</section>

{{-- 9 · WHY CHOOSE MOROCCO QUEST ──────────────────────── --}}
<section class="dmcm-section" id="why-morocco-quest">
    <div class="container">
        <div class="row gy-4 gx-xl-5 align-items-center">
            <div class="col-lg-7 order-lg-2">
                <p class="dmcm-eyebrow">{{ $c['why']['eyebrow'] }}</p>
                <h2 class="dmcm-h2">{{ $c['why']['h2'] }}</h2>
                <ul class="dmcm-why">
                    @foreach($c['why']['items'] as $w)
                    <li>
                        <span class="dmcm-why__icon"><i class="fa-solid {{ $w['icon'] }}" aria-hidden="true"></i></span>
                        <span><strong>{{ $w['title'] }}</strong>{{ $w['text'] }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-5 order-lg-1">
                <figure class="dmcm-figure">{!! $img('b2b-partnership-handshake', 'wide', '(min-width: 992px) 440px, 100vw', $c['why']['image_alt'], true, 4 / 3) !!}</figure>
            </div>
        </div>
    </div>
</section>

{{-- 10 · HOW TO CHOOSE A DMC ──────────────────────────── --}}
<section class="dmcm-section dmcm-section--tint" id="how-to-choose-a-dmc">
    <div class="container">
        <div class="dmcm-head">
            <p class="dmcm-eyebrow">{{ $c['choose']['eyebrow'] }}</p>
            <h2 class="dmcm-h2">{{ $c['choose']['h2'] }}</h2>
            <p>{{ $c['choose']['intro'] }}</p>
        </div>
        <ol class="dmcm-checklist">
            @foreach($c['choose']['items'] as $item)
                <li><strong>{{ $item['title'] }}</strong><span>{{ $item['text'] }}</span></li>
            @endforeach
        </ol>
        <p class="dmcm-center"><a class="dmcm-link" href="#dmc-enquiry">{{ $c['choose']['outro'] }}</a></p>
    </div>
</section>

{{-- 11 · HOW WE WORK ──────────────────────────────────── --}}
<section class="dmcm-section" id="how-we-work">
    <div class="container">
        <div class="dmcm-head">
            <p class="dmcm-eyebrow">{{ $c['process']['eyebrow'] }}</p>
            <h2 class="dmcm-h2">{{ $c['process']['h2'] }}</h2>
        </div>
        <ol class="dmcm-steps">
            @foreach($c['process']['steps'] as $step)
                <li><h3 class="dmcm-steps__title">{{ $step['title'] }}</h3><p>{{ $step['text'] }}</p></li>
            @endforeach
        </ol>
    </div>
</section>

{{-- 12 · QUOTE REQUEST ────────────────────────────────── --}}
<section class="dmcm-section dmcm-section--tint" id="dmc-enquiry">
    <div class="container">
        <div class="dmcm-head">
            <p class="dmcm-eyebrow">{{ $f['eyebrow'] }}</p>
            <h2 class="dmcm-h2">{{ $f['h2'] }}</h2>
            <p>{{ $f['intro'] }}</p>
        </div>
        <div class="row gy-4 gx-xl-4">
            <div class="col-lg-8">
                @if(session('success'))
                    <div class="alert dmcm-alert dmcm-alert--ok" role="status"><strong>{{ $f['success_title'] }}</strong> {{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert dmcm-alert dmcm-alert--err" role="alert"><strong>{{ $f['error_title'] }}</strong> {{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert dmcm-alert dmcm-alert--err" role="alert">
                        <strong>{{ $f['errors_title'] }}</strong>
                        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
                <form action="{{ route('contact.submit') }}" method="POST" class="dmcm-form" novalidate>
                    @csrf
                    <input type="hidden" name="enquiry_type" value="DMC B2B">
                    <input type="hidden" name="page_source" value="{{ $f['page_source'] }}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="dmc_name">{{ $f['labels']['name'] }} <span class="dmcm-req" aria-hidden="true">*</span></label>
                            <input id="dmc_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="{{ $f['placeholders']['name'] }}" value="{{ old('name') }}" required autocomplete="name">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="dmc_company">{{ $f['labels']['company'] }} <span class="dmcm-req" aria-hidden="true">*</span></label>
                            <input id="dmc_company" name="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" placeholder="{{ $f['placeholders']['company'] }}" value="{{ old('nationality') }}" required autocomplete="organization">
                            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="dmc_email">{{ $f['labels']['email'] }} <span class="dmcm-req" aria-hidden="true">*</span></label>
                            <input id="dmc_email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ $f['placeholders']['email'] }}" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="dmc_phone">{{ $f['labels']['phone'] }} <span class="dmcm-req" aria-hidden="true">*</span></label>
                            <input id="dmc_phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ $f['placeholders']['phone'] }}" value="{{ old('phone') }}" required autocomplete="tel">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="dmc_date">{{ $f['labels']['date'] }} <span class="dmcm-req" aria-hidden="true">*</span></label>
                            <input id="dmc_date" name="arrival_date" type="date" class="form-control @error('arrival_date') is-invalid @enderror" min="{{ now()->toDateString() }}" value="{{ old('arrival_date') }}" required>
                            @error('arrival_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="dmc_pax">{{ $f['labels']['pax'] }} <span class="dmcm-req" aria-hidden="true">*</span></label>
                            <input id="dmc_pax" name="adults" type="number" min="1" inputmode="numeric" class="form-control @error('adults') is-invalid @enderror" placeholder="{{ $f['placeholders']['pax'] }}" value="{{ old('adults') }}" required>
                            @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="dmc_duration">{{ $f['labels']['duration'] }} <span class="dmcm-req" aria-hidden="true">*</span></label>
                            <input id="dmc_duration" name="duration_days" type="number" min="1" inputmode="numeric" class="form-control @error('duration_days') is-invalid @enderror" placeholder="{{ $f['placeholders']['duration'] }}" value="{{ old('duration_days') }}" required>
                            @error('duration_days')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            {{-- Stored in the existing `children` column as 0–4 (unchanged backend contract). --}}
                            <label for="dmc_service">{{ $f['labels']['service'] }}</label>
                            <select id="dmc_service" name="children" class="form-control form-select">
                                @foreach($f['service_options'] as $v => $label)
                                    <option value="{{ $v }}" @selected((string) old('children', '4') === (string) $v)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="dmc_brief">{{ $f['labels']['brief'] }} <span class="dmcm-req" aria-hidden="true">*</span></label>
                            <textarea id="dmc_brief" name="travel_ideas" rows="5" class="form-control @error('travel_ideas') is-invalid @enderror" placeholder="{{ $f['placeholders']['brief'] }}" required>{{ old('travel_ideas') }}</textarea>
                            @error('travel_ideas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12"><p class="dmcm-muted dmcm-small"><i class="fa-solid fa-lock" aria-hidden="true"></i> {{ $f['privacy'] }}</p></div>
                        @include('partials.recaptcha')
                        <div class="col-12">
                            <button class="dmcm-btn dmcm-btn--primary" type="submit"><i class="fa-solid fa-paper-plane" aria-hidden="true"></i> {{ $f['submit'] }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <aside class="dmcm-desk" aria-labelledby="dmcm-desk-h">
                    <h3 id="dmcm-desk-h" class="dmcm-h3">{{ $f['contact_heading'] }}</h3>
                    <p class="dmcm-desk__company">{{ $f['contact_lines']['company'] }}</p>
                    <p class="dmcm-desk__line"><i class="fa-solid fa-location-dot" aria-hidden="true"></i> {{ $f['contact_lines']['address'] }}</p>
                    <p class="dmcm-desk__line"><i class="fa-solid fa-language" aria-hidden="true"></i> {{ $f['contact_lines']['languages'] }}</p>
                    <p class="dmcm-desk__line"><i class="fa-solid fa-clock" aria-hidden="true"></i> {{ $f['contact_lines']['response'] }}</p>
                    <div class="dmcm-desk__actions">
                        <a class="dmcm-btn dmcm-btn--wa dmcm-btn--block" href="{{ $c['hero']['whatsapp_url'] }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> {{ $f['whatsapp_label'] }}</a>
                        <a class="dmcm-btn dmcm-btn--ghost dmcm-btn--block" href="tel:+212654069718"><i class="fa-solid fa-phone" aria-hidden="true"></i> {{ $f['call_label'] }} +212 654 069 718</a>
                        <a class="dmcm-btn dmcm-btn--ghost dmcm-btn--block" href="mailto:sales@morocco-quest.com"><i class="fa-solid fa-envelope" aria-hidden="true"></i> sales@morocco-quest.com</a>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

{{-- 13 · INDEPENDENT REVIEWS + MEMBERSHIPS ────────────── --}}
<section class="dmcm-section" id="dmc-reviews">
    <div class="container">
        <div class="dmcm-head">
            <p class="dmcm-eyebrow">{{ $c['reviews']['eyebrow'] }}</p>
            <h2 class="dmcm-h2">{{ $c['reviews']['h2'] }}</h2>
            <p>{{ $c['reviews']['intro'] }}</p>
        </div>
        <div class="dmcm-reviews">
            @foreach($c['reviews']['links'] as $r)
                <a class="dmcm-btn dmcm-btn--ghost" href="{{ $r['url'] }}" target="_blank" rel="noopener"><i class="fa-solid {{ $r['icon'] }}" aria-hidden="true"></i> {{ $r['label'] }}</a>
            @endforeach
        </div>
        @if(!empty($c['memberships']))
            <h3 class="dmcm-h3 dmcm-center">{{ $c['memberships_heading'] }}</h3>
            <ul class="dmcm-logos">
                @foreach($c['memberships'] as $m)
                    <li><img src="{{ asset($m['logo']) }}" alt="{{ $m['name'] }}" width="176" height="80" loading="lazy"></li>
                @endforeach
            </ul>
        @endif
    </div>
</section>

{{-- 14 · FAQ ──────────────────────────────────────────── --}}
<section class="dmcm-section dmcm-section--tint" id="dmc-faq">
    <div class="container">
        <div class="dmcm-head">
            <p class="dmcm-eyebrow">{{ $c['faq']['eyebrow'] }}</p>
            <h2 class="dmcm-h2">{{ $c['faq']['h2'] }}</h2>
        </div>
        <div class="dmcm-faq">
            @foreach($c['faq']['items'] as $i => $faq)
                <details class="dmcm-faq__item" @if($i === 0) open @endif>
                    <summary><h3 class="dmcm-faq__q">{{ $faq['q'] }}</h3></summary>
                    <p>{{ $faq['a'] }}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>

{{-- 15 · RELATED SERVICES, PRODUCTS, FINAL CTA ────────── --}}
@include('partials.dmc-related', [
    'current' => 'dmc.marrakech',
    'relatedHeading' => $c['related']['heading'],
    'relatedIntro' => $c['related']['intro'],
    'relatedMore' => $c['related']['more'] ?? null,
    'relatedItems' => $c['related']['items'] ?? [],
])

@include('partials.dmc-products', [
    'curatedTourSlugs' => [
        '5-day-marrakech-luxury-city-break-gardens-culture-relaxation',
        '5-day-marrakech-sahara-luxury-desert-discovery-adventure-tour',
        '5-day-marrakech-essaouira-luxury-duo-private-morocco-tour',
    ],
    'curatedActivitySlugs' => [
        'magical-hot-air-balloon-ride-over-marrakech-with-berber-breakfast',
        'authentic-3-hour-moroccan-cooking-class-in-marrakech-morning-afternoon-sessions',
        'marrakech-medina-hidden-gems-tour-discover-authentic-local-life-with-a-private-guide',
    ],
    'productsSubtitle' => $c['products']['subtitle'],
    'productsHeading' => $c['products']['heading'],
    'productsIntro' => $c['products']['intro'],
    'browseToursLabel' => $c['products']['browse_tours'] ?? null,
    'browseActivitiesLabel' => $c['products']['browse_activities'] ?? null,
])

<section class="dmcm-cta">
    <div class="container dmcm-center">
        <h2 class="dmcm-cta__title">{{ $c['cta']['h2'] }}</h2>
        <p>{{ $c['cta']['text'] }}</p>
        <div class="dmcm-hero__ctas dmcm-hero__ctas--center">
            <a href="#dmc-enquiry" class="dmcm-btn dmcm-btn--primary">{{ $c['cta']['quote'] }}</a>
            <a href="{{ $c['hero']['whatsapp_url'] }}" class="dmcm-btn dmcm-btn--wa" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> WhatsApp</a>
            <a href="mailto:sales@morocco-quest.com" class="dmcm-btn dmcm-btn--light"><i class="fa-solid fa-envelope" aria-hidden="true"></i> sales@morocco-quest.com</a>
        </div>
    </div>
</section>

@endsection
