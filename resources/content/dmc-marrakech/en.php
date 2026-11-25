<?php

/*
|--------------------------------------------------------------------------
| /dmc-marrakech — English content (source of truth for the page copy)
|--------------------------------------------------------------------------
| Rendered by resources/views/dmc-marrakech.blade.php via DmcController.
| The French version lives in fr.php with the same keys.
|
| Copy rules (docs/seo/dmc-marrakech-benchmarking/16 + 19):
|  - Only company facts that Morocco Quest already publishes (founding year,
|    founder, Gueliz office, contact details, public review profiles).
|  - No licence numbers, memberships, client names, volumes or testimonials
|    until the owner supplies evidence (see 19-verified-business-facts-needed.md).
|  - Destination facts carry a source in $planner['sources'].
|  - Sample programmes are labelled as illustrative formats, never as past events.
|  - `case_studies` and `memberships` stay empty until real, approved items exist;
|    their sections render only when filled.
*/

$wa = 'https://wa.me/212654069718?text=' . rawurlencode('Hello Morocco Quest DMC, I would like a B2B quote for a programme in Marrakech.');

return [
    'locale'   => 'en',
    'og_locale' => 'en_GB',

    'meta' => [
        'title'       => 'DMC Marrakech | Morocco DMC & MICE | Morocco Quest',
        'description' => 'DMC Marrakech for travel agents, tour operators and MICE planners: white-label ground handling, hotels, transfers and incentives. Quote in 24h.',
        'og_image_alt' => 'DMC Marrakech — Morocco Quest DMC',
    ],

    'lang_switch' => ['label' => 'Version française', 'hreflang' => 'fr', 'route' => 'dmc.marrakech.fr'],

    'breadcrumb' => ['home' => 'Home', 'current' => 'DMC Marrakech'],

    'hero' => [
        'eyebrow' => 'Morocco Quest DMC · Marrakech',
        'h1'      => 'DMC Marrakech: Destination Management Company for Travel Agents & MICE Planners',
        'lead'    => 'A Marrakech-based ground partner for travel agencies, tour operators, incentive houses and corporate event planners. We plan and run the local side of your programme — hotels, transfers, venues, guides and on-site staff — and send a line-itemised net-rate proposal within 24 hours.',
        'cta_quote'    => 'Request a net-rate quote',
        'cta_whatsapp' => 'WhatsApp our B2B desk',
        'whatsapp_url' => $wa,
        'image_alt'    => 'Lantern-lit outdoor gala dinner for a large group at a Moroccan venue',
    ],

    'facts' => [
        'heading' => 'Morocco Quest DMC at a glance',
        'items' => [
            ['icon' => 'fa-location-dot', 'label' => 'Office',     'value' => 'Gueliz, Marrakech',          'link' => 'https://maps.app.goo.gl/FtVJocKLhRVvvF377', 'link_label' => 'View on Google Maps'],
            ['icon' => 'fa-calendar-check', 'label' => 'Founded',  'value' => '2022, by Mounir Akajia',     'link' => null],
            ['icon' => 'fa-map',          'label' => 'Coverage',   'value' => 'Marrakech & all of Morocco', 'link' => null],
            ['icon' => 'fa-language',     'label' => 'Languages',  'value' => 'English · French · Spanish · Arabic', 'link' => null],
            ['icon' => 'fa-clock',        'label' => 'Proposals',  'value' => 'Net-rate quote within 24h', 'link' => null],
            ['icon' => 'fa-star',         'label' => 'Reviews',    'value' => 'Tripadvisor & Google',      'link' => '#dmc-reviews', 'link_label' => 'Read independent reviews'],
        ],
    ],

    'who' => [
        'eyebrow' => 'Who we are',
        'h2'      => 'A Destination Management Company in Marrakech for the Travel Trade',
        'paragraphs' => [
            'A destination management company (DMC) plans and runs the ground part of a programme in its own destination: hotels and riads, transfers, meeting venues, guides, activities, dining and the people on site who make the timetable work. As a DMC in Marrakech, that is what Morocco Quest does for agencies, tour operators, incentive houses and companies that need one accountable local partner.',
            'Morocco Quest was founded in Marrakech in 2022 by Mounir Akajia and works from an office on Khalid Ibn Al Walid Street in Gueliz. The same team also runs private tours across Morocco, which keeps us in daily contact with the hotels, drivers, guides, camps and restaurants we contract for groups.',
            'For trade partners we work white-label and on confidential net rates: your brand on the programme, your margin on the price, and a single point of contact from the first brief to the last transfer.',
        ],
        'bullets' => [
            'One local desk for hotels, transport, venues, guides and activities',
            'Line-itemised net-rate proposals you can resell under your own brand',
            'Programmes in Marrakech and across Morocco — imperial cities, Atlas, coast and Sahara',
            'Operations team in Marrakech, reachable by phone, email and WhatsApp',
        ],
        'image_alt' => 'Busy medina street near Jemaa el-Fna in Marrakech with market stalls and a minaret',
        'team_heading' => 'Some of the guides who lead our groups',
        'team_intro'   => 'Local guides from our team, each with a region they know best. Full profiles are on our About page.',
        'team' => [
            ['name' => 'Mohamed Sahraoui', 'role' => 'Desert specialist', 'img' => 'assets/img/guides/mohamed-sahraoui-desert-expert-guide.webp', 'w' => 412, 'h' => 574],
            ['name' => 'Salwa Benayyad',   'role' => 'Mountain guide',     'img' => 'assets/img/guides/salwa-benayyad-certified-female-guide.webp', 'w' => 284, 'h' => 384],
            ['name' => 'Hicham Echerfaoui','role' => 'Rabat specialist',   'img' => 'assets/img/guides/hicham-echerfaoui-rabat-morocco-tour-guide.webp', 'w' => 310, 'h' => 428],
            ['name' => 'Hassan Tebbal',    'role' => 'Fes specialist',     'img' => 'assets/img/guides/hassan-tebbal-fes-expert-guide.webp', 'w' => 788, 'h' => 1066],
        ],
        'about_link' => 'Meet the team on our About page',
    ],

    'services' => [
        'eyebrow' => 'Core DMC services',
        'h2'      => 'Our DMC Services in Marrakech',
        'intro'   => 'Eight service lines, contracted and coordinated by one local team. Open any tile for the details, or go to the dedicated page.',
        'details_label' => 'Details',
        'tiles' => [
            ['img' => 'corporate-event-garden-gala',     'alt' => 'Garden gala dinner with red table settings and Moroccan performers', 'title' => 'MICE & corporate events', 'text' => 'Gala dinners, product launches, award nights and corporate celebrations in palaces, gardens and desert camps.', 'anchor' => 'guide-events', 'route' => 'events-production.morocco', 'route_label' => 'Events production'],
            ['img' => 'incentive-camel-caravan',         'alt' => 'Camel caravan crossing a desert plain under a clear blue sky', 'title' => 'Incentive travel', 'text' => 'Reward trips built around Marrakech, the Agafay desert, the Atlas and the Sahara, with private, exclusive-use moments.', 'anchor' => 'guide-incentive', 'route' => 'team-building.marrakech', 'route_label' => 'Team building & incentives'],
            ['img' => 'conference-theatre-hall',         'alt' => 'Theatre-style conference hall with red seating and a stage', 'title' => 'Conferences & seminars', 'text' => 'Venue sourcing, delegate management, AV through technical partners and hospitality desks for meetings of every size.', 'anchor' => 'guide-meetings', 'route' => 'meetings-conventions.management', 'route_label' => 'Meetings & conventions'],
            ['img' => 'team-building-quad-palm-grove',   'alt' => 'Quad bikes riding along a sandy track through a palm grove', 'title' => 'Team building', 'text' => 'Facilitated formats in the medina, the Palmeraie, the Atlas foothills and the desert, matched to your objectives.', 'anchor' => 'guide-teambuilding', 'route' => 'team-building.marrakech', 'route_label' => 'Team building Marrakech'],
            ['img' => 'luxury-desert-tent-dinner',       'alt' => 'Large Berber-style tent set for a private dinner, with desert hills beyond the windows', 'title' => 'Luxury experiences', 'text' => 'Exclusive-use riads, private dinners, desert camps, balloon flights and access to venues that are hard to book alone.', 'anchor' => 'guide-incentive', 'route' => '360-solutions.morocco', 'route_label' => '360° event & travel solutions'],
            ['img' => 'transport-4x4-fleet',             'alt' => 'Group of 4x4 vehicles and travellers at a stop in rural Morocco', 'title' => 'Transport & logistics', 'text' => 'Airport meet-and-greet at RAK, coaches, minivans, 4x4 convoys, manifests and timed departures for every transfer.', 'anchor' => 'guide-transport', 'route' => null, 'route_label' => null],
            ['img' => 'riad-courtyard-accommodation',    'alt' => 'Arcaded courtyard with a fountain in a traditional Moroccan riad-style hotel', 'title' => 'Hotels & riads', 'text' => 'Room blocks on net rates, riad buy-outs and hotel contracting in Hivernage, the Palmeraie, Agdal and the medina.', 'anchor' => 'guide-hotels', 'route' => null, 'route_label' => null],
            ['img' => 'guided-visit-dar-el-bacha',       'alt' => 'Guided group visit in the tiled courtyard of a Marrakech palace museum', 'title' => 'Excursions & private experiences', 'text' => 'Guided medina visits, Atlas and Essaouira day trips, cooking classes, hammam rituals and private cultural access.', 'anchor' => 'guide-excursions', 'route' => 'tours.index', 'route_label' => 'Tours & day trips'],
        ],
    ],

    'guide' => [
        'eyebrow' => 'Services guide',
        'h2'      => 'DMC Marrakech Services Guide for Agents, Operators & MICE Planners',
        'intro'   => 'What each service includes and how we run it on the ground. Open any topic below.',
        'items' => [
            [
                'id' => 'guide-meetings', 'title' => 'Meetings, conferences & seminars', 'img' => 'conference-interpreting-booth', 'img_alt' => 'Interpreter console, headset and documents at a conference interpreting booth',
                'html' => '<p>Marrakech has the venues for every format: the <strong>Palais des Congrès de Marrakech</strong> in Hivernage, conference hotels in Hivernage, the Palmeraie and Agdal, and private estates for smaller executive meetings. We source and compare venues against your brief, then run the delegate logistics around them.</p>
<ul>
<li><strong>Venue sourcing &amp; contracting</strong> — plenary, breakout and exhibition space, catering and technical riders</li>
<li><strong>Delegate management</strong> — registration support, rooming lists, arrival and departure manifests, hospitality desks</li>
<li><strong>AV, staging &amp; interpreting</strong> through vetted technical partners</li>
<li><strong>Seminars and board meetings</strong> in hotels, riads and private villas, with team activities around the agenda</li>
<li><strong>Partner programmes</strong> for accompanying guests during sessions</li>
</ul>
<p>For large congresses with abstracts, sponsorship and registration platforms, see our <a href="' . route('congress-organization.morocco') . '">professional congress organization</a> service.</p>',
            ],
            [
                'id' => 'guide-incentive', 'title' => 'Incentive travel', 'img' => 'hot-air-balloon-sunrise', 'img_alt' => 'Hot-air balloons rising at sunrise above 4x4 vehicles parked on a desert plain',
                'html' => '<p>An incentive has to feel exclusive and run without friction. We build reward programmes around a few memorable moments and plan the logistics so the group never waits.</p>
<ul>
<li><strong>Arrivals</strong> — private meet-and-greet at Marrakech Menara Airport and a welcome at the hotel or riad</li>
<li><strong>Signature moments</strong> — sunrise balloon flight, sunset in the Agafay desert, a private dinner in a riad or palace</li>
<li><strong>Exclusive use</strong> — riad buy-outs, private camps and reserved terraces for your group</li>
<li><strong>Balanced pacing</strong> — curated activities with free time built in</li>
<li><strong>Extensions</strong> — Essaouira, the Atlas Mountains or a Sahara night for longer programmes</li>
</ul>',
            ],
            [
                'id' => 'guide-events', 'title' => 'Corporate events & gala dinners', 'img' => 'palace-restaurant-service', 'img_alt' => 'Waiter carrying a tray through an ornate palace restaurant under a crystal chandelier',
                'html' => '<p>From a welcome cocktail to an awards night, we match the venue, menu and production to the size of the group and the tone of the event.</p>
<ul>
<li><strong>Venues</strong> — palace restaurants, riad courtyards, Palmeraie estates and luxury tented camps in Agafay</li>
<li><strong>Production</strong> — staging, lighting, sound and décor with our <a href="' . route('events-production.morocco') . '">events production</a> partners</li>
<li><strong>Entertainment</strong> — Gnaoua and Andalusian musicians, folklore troupes, DJs</li>
<li><strong>Themed dinners and product launches</strong>, with branding and run-of-show coordination</li>
</ul>',
            ],
            [
                'id' => 'guide-teambuilding', 'title' => 'Team building in Marrakech', 'img' => null, 'img_alt' => null,
                'html' => '<p>Formats are chosen for the outcome you want — collaboration, leadership, celebration — and delivered with facilitators, transport and equipment included.</p>
<ul>
<li>Medina challenge: teams navigate souks and fondouks with clues and tasks</li>
<li>Tagine cooking challenge with a chef in a riad or farm kitchen</li>
<li>Quad or buggy circuits in the Palmeraie or the Agafay desert</li>
<li>Atlas foothills hike with lunch in a Berber village</li>
<li>Pottery, calligraphy or carpet-weaving workshops with artisans</li>
<li>Desert games and sunset activities at a private camp</li>
<li>CSR days with local associations</li>
</ul>
<p>More formats and examples on our <a href="' . route('team-building.marrakech') . '">team building in Marrakech</a> page.</p>',
            ],
            [
                'id' => 'guide-transport', 'title' => 'Transport & logistics', 'img' => null, 'img_alt' => null,
                'html' => '<p>Transfers are where programmes win or lose time. We plan them as an operation, not a booking.</p>
<ul>
<li><strong>Airport meet-and-greet</strong> at Marrakech Menara (RAK), Casablanca (CMN), Fes (FEZ) and Agadir (AGA)</li>
<li><strong>Vehicles</strong> — chauffeur-driven cars, executive minivans, coaches and 4x4 convoys for desert routes</li>
<li><strong>Manifests &amp; staggered arrivals</strong> for large delegations, with an operations contact on the day</li>
<li><strong>Inter-city logistics</strong> — timed departures, luggage handling and on-board hosts</li>
</ul>',
            ],
            [
                'id' => 'guide-hotels', 'title' => 'Hotels, riads & accommodation', 'img' => null, 'img_alt' => null,
                'html' => '<p>Marrakech offers everything from boutique riads in the medina to international conference resorts. We contract the mix that fits your budget and programme.</p>
<ul>
<li><strong>Room blocks</strong> on net rates with clear release dates</li>
<li><strong>Riad buy-outs</strong> for small groups who want a private house in the medina</li>
<li><strong>Hotels and palaces</strong> in Hivernage, the Palmeraie, Agdal and the Atlas foothills</li>
<li><strong>Site inspections</strong> in person or by video before you confirm</li>
</ul>',
            ],
            [
                'id' => 'guide-excursions', 'title' => 'Excursions, dining & private experiences', 'img' => 'moroccan-gala-dinner-cuisine', 'img_alt' => 'Plated Moroccan main course served at a candle-lit dinner table',
                'html' => '<p>Free afternoons and partner programmes are part of the experience. We run them with our own local guides and suppliers we work with regularly.</p>
<ul>
<li>Guided visits of the medina, Bahia Palace, Ben Youssef Madrasa, Majorelle and Le Jardin Secret</li>
<li>Day trips to the Ourika Valley, Imlil and the High Atlas, Essaouira or Ouarzazate</li>
<li>Cooking classes, food walks at Jemaa el-Fna, wine and olive-oil tastings</li>
<li>Hammam rituals and private spa sessions</li>
<li>Dietary requirements briefed to every venue in writing</li>
</ul>
<p>Ready-made products for your clients are in our <a href="' . route('tours.index') . '">tours</a> and <a href="' . route('experiences.index') . '">experiences</a> catalogues.</p>',
            ],
            [
                'id' => 'guide-responsible', 'title' => 'Responsible destination management', 'img' => null, 'img_alt' => null,
                'html' => '<p>We favour family-run riads, local guides, artisan cooperatives and grouped transfers, and we brief delegates on local etiquette. Programmes with formal ESG reporting needs are covered on our <a href="' . route('sustainable-events.morocco') . '">sustainable events</a> page.</p>',
            ],
        ],
    ],

    'planner' => [
        'eyebrow' => 'For event planners',
        'h2'      => 'Marrakech for Event Planners: Key Facts',
        'intro'   => 'The practical numbers planners ask for first. Figures are approximate and sourced below; we confirm the details for your dates in every proposal.',
        'image_alt' => 'Jemaa el-Fna square at dusk with food stalls lit up, Marrakech',
        'rows' => [
            ['k' => 'Airport',          'v' => 'Marrakech Menara (RAK), about 6 km from the city centre; around 9 million passengers in 2024.', 'src' => [1, 2]],
            ['k' => 'Flight times',     'v' => 'Roughly 3 to 4 hours direct from London or Paris; shorter from Spain and Portugal.', 'src' => []],
            ['k' => 'Congress centre',  'v' => 'Palais des Congrès de Marrakech, Hivernage: 19 meeting rooms, largest room about 1,489 people, about 2,600 m² of exhibition space.', 'src' => [3]],
            ['k' => 'Hotel capacity',   'v' => 'About 1,900 classified establishments with around 75,000 beds, from medina riads to conference resorts.', 'src' => [4]],
            ['k' => 'Agafay desert',    'v' => 'About 30–35 km from the city — around 45 minutes by road. Popular for gala dinners and sunset events.', 'src' => [5]],
            ['k' => 'Essaouira',        'v' => 'About 175–180 km on the Atlantic coast — 2.5 to 3 hours by road.', 'src' => [6]],
            ['k' => 'Time zone',        'v' => 'Morocco uses GMT+1 for most of the year and returns to GMT during Ramadan.', 'src' => []],
            ['k' => 'Currency',         'v' => 'Moroccan dirham (MAD). We quote in EUR, USD, GBP or MAD.', 'src' => []],
            ['k' => 'Language',         'v' => 'Arabic and Amazigh are official; French is widely used in business; English is common in hotels and tourism.', 'src' => []],
            ['k' => 'Event seasons',    'v' => 'Spring and autumn are the most comfortable for outdoor programmes; summer days are very hot; winter is mild in the day and cold at night in the desert.', 'src' => []],
            ['k' => 'Ramadan',          'v' => 'Dates move about 11 days earlier each year; restaurant hours and alcohol service can change, so we plan around them.', 'src' => []],
            ['k' => 'Entry',            'v' => 'Many nationalities, including EU, UK, US and Canadian citizens, can usually visit visa-free for short stays — always check each delegate\'s passport rules.', 'src' => []],
        ],
        'sources_label' => 'Sources',
        'sources' => [
            1 => ['label' => 'Cvent — Getting around Marrakesh', 'url' => 'https://www.cvent.com/meeting-event-planning/morocco/marrakesh/travel'],
            2 => ['label' => 'Wikipedia — Marrakesh Menara Airport', 'url' => 'https://en.wikipedia.org/wiki/Marrakesh_Menara_Airport'],
            3 => ['label' => 'AMI — Palais des Congrès de Marrakech venue listing', 'url' => 'https://www.amimagazine.global/Meeting-Event-Venues/Marrakech-Morocco/Convention-Center/Palais-des-Congres-de-Marrakech-p57988170'],
            4 => ['label' => '7news.ma — Marrakech classified accommodation', 'url' => 'https://en.7news.ma/?p=13164'],
            5 => ['label' => 'Lonely Planet — Best day trips from Marrakesh', 'url' => 'https://www.lonelyplanet.com/articles/best-day-trips-from-marrakesh'],
            6 => ['label' => 'Rough Guides — Marrakech to Essaouira', 'url' => 'https://www.roughguides.com/morocco/getting-around/marrakech-to-essaouira'],
        ],
        'map' => [
            'title' => 'Approximate drive times from Marrakech',
            'center' => 'Marrakech',
            'points' => [
                ['name' => 'Menara Airport (RAK)', 'time' => '≈ 15–20 min'],
                ['name' => 'Agafay desert',        'time' => '≈ 45 min'],
                ['name' => 'Essaouira',            'time' => '≈ 2.5–3 h'],
            ],
            'note' => 'Schematic, not to scale. Times vary with traffic and pick-up point.',
        ],
    ],

    'samples' => [
        'eyebrow' => 'Sample programme formats',
        'h2'      => 'Sample Marrakech Programmes We Can Build for You',
        'disclaimer' => 'Illustrative formats to show what is possible. Every programme is quoted against your brief; these are not records of past events.',
        'items' => [
            ['img' => 'agafay-desert-camp', 'alt' => 'Lounge terrace of a luxury camp in the Agafay desert with the Atlas Mountains on the horizon', 'title' => '3-day incentive in Marrakech', 'meta' => 'Typical group: 20–80 guests', 'points' => ['Arrival meet-and-greet and welcome dinner in a riad', 'Guided medina discovery and free time in the souks', 'Sunset and gala dinner at a private camp in the Agafay desert', 'Optional sunrise balloon flight before departure']],
            ['img' => 'guests-arrival-event-venue', 'alt' => 'Guests walking along a red carpet towards an outdoor event venue', 'title' => '2-day conference with gala night', 'meta' => 'Typical group: 80–300 delegates', 'points' => ['Plenary and breakout sessions in a Hivernage conference hotel', 'Hospitality desk, manifests and timed transfers', 'Gala dinner with Moroccan entertainment in a palace venue', 'Partner programme for accompanying guests']],
            ['img' => 'sahara-camp-sunset-extension', 'alt' => 'Desert camp in the Sahara at sunset with red rugs laid on the sand', 'title' => 'Marrakech + Sahara extension', 'meta' => 'Typical length: 4–6 days', 'points' => ['High Atlas crossing via the Tizi n\'Tichka pass', 'Aït Benhaddou and the Draa or Dadès valleys', 'Night in a luxury camp at Erg Chebbi (Merzouga)', 'Return to Marrakech or departure via Fes']],
        ],
    ],

    // Fill with real, approved programmes only (client type, pax, month/year, venues, services, outcome, photos, permission).
    'case_studies' => [],

    'coverage' => [
        'eyebrow' => 'Morocco-wide coverage',
        'h2'      => 'Beyond Marrakech: Destination Management Across Morocco',
        'intro'   => 'Marrakech is our base; the whole country is our product. Multi-city programmes are delivered end-to-end by the same team, with one contract and one point of contact.',
        'image_alt' => 'Winding mountain road through the Atlas with a roadside settlement below',
        'cities' => [
            ['city' => 'Fes',           'label' => 'Imperial city & medina'],
            ['city' => 'Casablanca',    'label' => 'Business hub & arrivals'],
            ['city' => 'Rabat',         'label' => 'Capital & institutions'],
            ['city' => 'Tangier',       'label' => 'Gateway to Europe'],
            ['city' => 'Essaouira',     'label' => 'Atlantic coast'],
            ['city' => 'Agadir',        'label' => 'Beach & resort groups'],
            ['city' => 'Atlas Mountains', 'label' => 'Kasbahs & trekking'],
            ['city' => 'Sahara',        'label' => 'Merzouga & Erg Chebbi camps'],
        ],
        'links' => [
            ['route' => 'destinations.index', 'label' => 'Explore Morocco destinations'],
            ['route' => 'tours.multi_day',    'label' => 'See multi-day itineraries'],
        ],
    ],

    'why' => [
        'eyebrow' => 'Why work with us',
        'h2'      => 'Why Travel Agencies Choose Morocco Quest as Their DMC Morocco Partner',
        'image_alt' => 'Business handshake in front of a carved Moroccan wooden screen',
        'items' => [
            ['icon' => 'fa-location-dot', 'title' => 'Local office in Marrakech', 'text' => 'Our team works from Gueliz, so venues, suppliers and site inspections are a short drive away.'],
            ['icon' => 'fa-pen-ruler',    'title' => 'Tailored planning',         'text' => 'Every proposal is built to your brief, audience and budget — no fixed packages forced onto a group.'],
            ['icon' => 'fa-diagram-project', 'title' => 'One point of supplier coordination', 'text' => 'Hotels, transport, venues, guides and activities are contracted and coordinated by one team.'],
            ['icon' => 'fa-headset',      'title' => 'Operational support on the day', 'text' => 'An operations contact follows each programme day by day and handles changes on the ground.'],
            ['icon' => 'fa-list-check',   'title' => 'Transparent quotes',        'text' => 'Line-itemised net rates, so you can include, remove or reprice any element before you present it.'],
            ['icon' => 'fa-language',     'title' => 'International B2B communication', 'text' => 'We work in English, French, Spanish and Arabic, with written briefs for every supplier.'],
        ],
    ],

    'choose' => [
        'eyebrow' => 'Buyer\'s checklist',
        'h2'      => 'How to Choose a DMC in Marrakech',
        'intro'   => 'Whichever partner you shortlist, these are the questions worth asking before you sign.',
        'items' => [
            ['title' => 'Licence and legal registration', 'text' => 'Ask for the company\'s tourism licence and registration details, and check they match the contracting entity.'],
            ['title' => 'A real local office', 'text' => 'A team based in Marrakech can inspect venues, meet suppliers and react quickly on the day.'],
            ['title' => 'Liability insurance', 'text' => 'Request the insurance certificate and check that cover applies to the services in your programme.'],
            ['title' => 'Own staff on site', 'text' => 'Ask who will be physically present during arrivals, events and transfers — and how to reach them at night.'],
            ['title' => 'References and independent reviews', 'text' => 'Ask for references from agencies in your market, and read reviews on independent platforms.'],
            ['title' => 'Supplier contracts and release dates', 'text' => 'Hotel blocks, venues and camps should come with written terms and clear release dates.'],
            ['title' => 'Payment terms and currency', 'text' => 'Agree the deposit schedule, final payment date and invoicing currency before contracting.'],
            ['title' => 'Emergency and contingency plans', 'text' => 'Ask how weather, delays, medical issues or venue changes are handled — and who decides.'],
        ],
        'outro' => 'Ask us any of these questions on your first call — we answer in writing.',
    ],

    'process' => [
        'eyebrow' => 'How we work',
        'h2'      => 'How a Programme Works with Our Marrakech DMC Team',
        'steps' => [
            ['title' => 'Initial briefing', 'text' => 'A call or written brief: objectives, audience, dates, group size and must-haves.'],
            ['title' => 'Requirements & budget', 'text' => 'We confirm the budget range, hotel level, venues and constraints before building options.'],
            ['title' => 'Proposal & itinerary', 'text' => 'A day-by-day itinerary with line-itemised net rates — within 24 hours for standard requests.'],
            ['title' => 'Supplier coordination', 'text' => 'Contracting, deposits, rooming lists, manifests, menus and written briefs to every supplier.'],
            ['title' => 'On-site execution', 'text' => 'Our team runs arrivals, transfers, events and activities, and manages changes on the ground.'],
            ['title' => 'Post-event follow-up', 'text' => 'Final reconciliation, feedback from you and your client, and notes for the next programme.'],
        ],
    ],

    'form' => [
        'eyebrow' => 'B2B enquiry',
        'h2'      => 'Request a Net-Rate Quote',
        'intro'   => 'Tell us about your programme. We reply within 24 hours with questions or a first costing. Enquiries are treated as confidential.',
        'page_source' => 'dmc-marrakech',
        'labels' => [
            'name' => 'Full name', 'company' => 'Company / agency', 'email' => 'Business email', 'phone' => 'Phone / WhatsApp',
            'date' => 'Start date', 'pax' => 'Group size (pax)', 'duration' => 'Programme length (days)', 'service' => 'Programme type',
            'brief' => 'Programme brief', 'required' => 'required',
        ],
        'placeholders' => [
            'name' => 'Your full name', 'company' => 'Your company or agency', 'email' => 'you@company.com', 'phone' => '+44 / +33 / +1…',
            'pax' => 'Number of participants', 'duration' => 'Number of days',
            'brief' => 'Destinations, hotel level, objectives, activities, client profile, budget range…',
        ],
        'service_options' => ['Private / FIT tours', 'Incentive / MICE', 'Group package', 'Transfers only', 'Full DMC programme'],
        'privacy' => 'Your enquiry is confidential. We use your details only to reply to this request.',
        'submit' => 'Send B2B enquiry',
        'success_title' => 'Enquiry sent',
        'error_title' => 'Something went wrong',
        'errors_title' => 'Please check the following:',
        'contact_heading' => 'B2B desk',
        'contact_lines' => [
            'company' => 'Morocco Quest DMC',
            'address' => 'Khalid Ibn Al Walid Street, Gueliz, Marrakech 40000, Morocco',
            'languages' => 'English · French · Spanish · Arabic',
            'response' => 'Reply within 24 hours',
        ],
        'call_label' => 'Call',
        'email_label' => 'Email',
        'whatsapp_label' => 'WhatsApp',
    ],

    'reviews' => [
        'eyebrow' => 'Independent reviews',
        'h2'      => 'Read What Travellers and Partners Say',
        'intro'   => 'We publish no anonymous quotes on this page. Read verified reviews of Morocco Quest DMC on independent platforms instead.',
        'links' => [
            ['label' => 'Morocco Quest DMC on Tripadvisor', 'url' => 'https://www.tripadvisor.com/Attraction_Review-g293734-d33367694-Reviews-Morocco_Quest_Dmc-Marrakech_Marrakech_Safi.html', 'icon' => 'fa-star'],
            ['label' => 'Morocco Quest DMC on Google Maps', 'url' => 'https://maps.app.goo.gl/FtVJocKLhRVvvF377', 'icon' => 'fa-location-dot'],
        ],
    ],

    // Fill only with real memberships/partners and permitted logo files.
    'memberships' => [],
    'memberships_heading' => 'Memberships & partners',

    'faq' => [
        'eyebrow' => 'FAQ',
        'h2'      => 'Frequently Asked Questions — DMC Marrakech',
        'items' => [
            ['q' => 'What does a DMC in Marrakech do?', 'a' => 'A destination management company handles the on-the-ground part of a programme: hotels and riads, transfers, meeting and event venues, guides, activities, dining, production and on-site staff. It contracts local suppliers and coordinates them so the client deals with one partner.'],
            ['q' => 'Who do you work with?', 'a' => 'Travel agencies, tour operators, incentive houses, event agencies and corporate planners. Morocco Quest also sells private tours directly to travellers; trade partners get white-label delivery, confidential net rates and a dedicated point of contact.'],
            ['q' => 'How quickly will we receive a proposal?', 'a' => 'For standard requests we send a line-itemised net-rate proposal within 24 hours. Large conferences or complex incentives may need a short briefing call first.'],
            ['q' => 'How far in advance should a MICE programme in Marrakech be booked?', 'a' => 'As a guide, three to six months for groups of 20–60 people and six to twelve months for large conferences, especially in spring and autumn. Shorter lead times are often possible — ask us.'],
            ['q' => 'Can you organise a seminar or team building in Marrakech for a small group?', 'a' => 'Yes. Seminars, board retreats and team building days work well for small groups in riads, private villas or hotels, and we also plan for much larger delegations. Group rates usually become worthwhile from around ten participants.'],
            ['q' => 'Do you organise programmes outside Marrakech?', 'a' => 'Yes — Fes, Casablanca, Rabat, Tangier, Essaouira, Agadir, the Atlas Mountains and the Sahara, as single destinations or multi-city routes with one contract.'],
            ['q' => 'Which languages do your guides speak?', 'a' => 'English, French, Spanish and Arabic as standard. Other languages can be requested and are subject to availability.'],
            ['q' => 'What payment terms and currencies do you use?', 'a' => 'Usually a deposit on confirmation, an interim payment before arrival and the balance on the agreed date; exact terms depend on the programme and supplier conditions. We invoice in EUR, USD, GBP or MAD.'],
            ['q' => 'When is the best time of year for events in Marrakech?', 'a' => 'Spring and autumn are the most comfortable for outdoor events. Summer is very hot, so we schedule activities early and late in the day. Winter days are mild, with cold nights in the desert.'],
            ['q' => 'Can you arrange a site inspection?', 'a' => 'Yes. We organise video walk-throughs of hotels, riads and venues, and in-person site inspections in Marrakech; any costs are quoted in advance.'],
        ],
    ],

    'related' => [
        'heading' => 'Related DMC Services',
        'intro'   => 'Explore the full range of Morocco Quest ground services — every part of your programme, handled by one local partner.',
    ],

    'products' => [
        'subtitle' => 'For your clients',
        'heading'  => 'Ready-Made Marrakech Programmes for Your Clients',
        'intro'    => 'Bookable tours and experiences you can add to a group programme or resell on a net-rate basis.',
    ],

    'cta' => [
        'h2'   => 'Ready to Plan Your Marrakech Programme?',
        'text' => 'Send us your brief and receive a line-itemised net-rate proposal within 24 hours.',
        'quote' => 'Request a quote',
    ],
];
