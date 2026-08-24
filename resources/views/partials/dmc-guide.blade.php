{{-- resources/views/partials/dmc-guide.blade.php
     Long-form B2B guide for /dmc-marrakech. Each block is a collapsed Bootstrap
     accordion so the page stays visually compact while the full copy remains in
     the DOM (crawlable, expandable by users — NOT hidden text / cloaking).
     Heading order: section H2 → accordion H3 → H4 inside bodies. --}}
<section class="space" id="dmc-guide">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-4">
                    <span class="sec-subtitle">Complete Guide</span>
                    <h2 class="sec-title">DMC Marrakech Services Guide for Agents, Operators &amp; MICE Planners</h2>
                    <p class="mb-0">Everything a B2B buyer needs before the first call — expand any topic below.</p>
                </div>

                <style>
                    #dmcGuide .accordion-button{padding-right:60px;font-size:1.02rem;font-weight:700;color:var(--title-color);text-transform:none;line-height:1.4;}
                    #dmcGuide .accordion-button:not(.collapsed){color:var(--theme-color);}
                    #dmcGuide .accordion-body{font-size:.92rem;line-height:1.65;text-transform:none;letter-spacing:normal;}
                    #dmcGuide .accordion-body h4{font-size:1rem;font-weight:700;margin:18px 0 8px;}
                    #dmcGuide .accordion-body h4:first-child{margin-top:0;}
                    #dmcGuide .accordion-body ul{padding-left:1.15rem;margin-bottom:12px;}
                    #dmcGuide .accordion-body li{margin-bottom:5px;}
                    #dmcGuide .accordion-body ol{padding-left:1.25rem;}
                    #dmcGuide .accordion-body p{margin-bottom:10px;}
                    #dmcGuide .accordion-body .dmc-ex{font-style:italic;color:#555;border-left:3px solid var(--theme-color);padding:6px 12px;margin:10px 0;background:#faf8f5;}
                    #dmcGuide table{width:100%;font-size:.9rem;border-collapse:collapse;}
                    #dmcGuide table th{width:32%;text-align:left;padding:6px 10px;background:#faf8f5;font-weight:700;}
                    #dmcGuide table td{padding:6px 10px;border-bottom:1px solid #eee;}
                    @media (max-width:575px){ #dmcGuide .accordion-button{font-size:.95rem;padding-right:44px;} #dmcGuide .accordion-body{font-size:.88rem;} }
                </style>

                <div class="accordion accordion-style1" id="dmcGuide">

                    {{-- 1. At a glance --}}
                    <div class="accordion-item">
                        <h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dmcG1" aria-expanded="false" aria-controls="dmcG1">DMC Marrakech at a Glance</button></h3>
                        <div id="dmcG1" class="accordion-collapse collapse" data-bs-parent="#dmcGuide"><div class="accordion-body">
                            <table>
                                <tr><th>Based in</th><td>Marrakech, Morocco — with operations across the whole country</td></tr>
                                <tr><th>Licence</th><td>Moroccan Ministry of Tourism licensed tour operator, fully insured</td></tr>
                                <tr><th>Business model</th><td>Trade-only, white-label, confidential net rates</td></tr>
                                <tr><th>Group range</th><td>2 to 500+ participants</td></tr>
                                <tr><th>Core markets</th><td>UK, Europe, North America, GCC, Asia</td></tr>
                                <tr><th>Languages</th><td>EN · FR · ES · AR (DE, IT, PT, RU, ZH, JA on request)</td></tr>
                                <tr><th>Quote turnaround</th><td>Within 24 hours / one business day</td></tr>
                                <tr><th>Support</th><td>Dedicated account manager + 24/7 operations line</td></tr>
                                <tr><th>Specialities</th><td>MICE Marrakech, incentive travel, team building, luxury private tours, Sahara programmes</td></tr>
                            </table>
                        </div></div>
                    </div>

                    {{-- 2. Marrakech as a MICE destination --}}
                    <div class="accordion-item">
                        <h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dmcG2" aria-expanded="false" aria-controls="dmcG2">Marrakech as a MICE Destination</button></h3>
                        <div id="dmcG2" class="accordion-collapse collapse" data-bs-parent="#dmcGuide"><div class="accordion-body">
                            <p>Few cities make a DMC's job easier. Marrakech combines short-haul access with long-haul exoticism — which is exactly why incentive houses and congress organisers keep returning.</p>
                            <ul>
                                <li><strong>Access</strong> — Marrakech Menara Airport (RAK) has direct flights from 100+ European cities in under 4 hours, plus daily connections from the Gulf and North America via Casablanca.</li>
                                <li><strong>Venues</strong> — 5-star palace hotels, a 3,500-seat congress centre, exclusive-use riads, private estates in the Palmeraie and desert camps 45 minutes away.</li>
                                <li><strong>Hotel inventory</strong> — over 30,000 beds, from boutique riads to internationally branded conference resorts.</li>
                                <li><strong>Climate</strong> — 300+ days of sunshine; spring and autumn deliver 22–28 °C for outdoor programmes.</li>
                                <li><strong>Wow factor</strong> — the medina, Jemaa el-Fnaa, the Atlas skyline and two deserts within reach make every itinerary photogenic.</li>
                                <li><strong>Value</strong> — luxury delivery at rates that compare favourably with Southern Europe and the Gulf.</li>
                                <li><strong>Safety</strong> — a stable, welcoming destination with dedicated tourist police and a mature hospitality sector.</li>
                            </ul>
                            <p>A DMC Marrakech partner who knows this inventory intimately turns those advantages into a programme that runs on time and on budget.</p>
                        </div></div>
                    </div>

                    {{-- 3. MICE & incentive --}}
                    <div class="accordion-item">
                        <h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dmcG3" aria-expanded="false" aria-controls="dmcG3">MICE &amp; Incentive Travel Services</button></h3>
                        <div id="dmcG3" class="accordion-collapse collapse" data-bs-parent="#dmcGuide"><div class="accordion-body">
                            <p>MICE Marrakech is our core business. The city has the venues, the hotels, the airport and the wow factor — we add the local team that turns a concept into an operationally flawless event.</p>
                            <h4>Corporate Events &amp; Conferences</h4>
                            <ul>
                                <li><strong>Venue sourcing &amp; contracting</strong> — palaces, five-star conference hotels, private estates, desert camps</li>
                                <li><strong>Accommodation blocks</strong> across 3 to 5-star properties, negotiated on net rates</li>
                                <li><strong>Delegate management</strong> — arrivals, registration, hospitality desks, rooming lists</li>
                                <li><strong>AV, staging &amp; production</strong> through our vetted technical partners</li>
                                <li><strong>Gala dinners &amp; themed evenings</strong> — a 1,001-nights dinner in a Palmeraie palace, a lantern-lit banquet in Agafay</li>
                                <li><strong>On-site staffing</strong> — bilingual hostesses, coordinators, security liaison</li>
                            </ul>
                            <p class="dmc-ex">Example: a 3-day pharmaceutical congress for 260 delegates — plenary in a Hivernage hotel, 4 parallel workshops, welcome cocktail in a riad, closing gala under the stars in Agafay.</p>
                            <h4>Incentive Travel Programs</h4>
                            <ul>
                                <li><strong>Signature arrivals</strong> — rose-water welcome, private airport meet &amp; greet, VIP fast-track where available</li>
                                <li><strong>Exclusive-use venues</strong> — buy-out riads, private palaces, desert camps reserved for your group only</li>
                                <li><strong>Wow moments</strong> — hot-air balloon at dawn, helicopter transfer to the Atlas, sunset camel caravan, private concert in a kasbah</li>
                                <li><strong>Layered itineraries</strong> — free time balanced with curated experiences so every delegate returns with a story</li>
                                <li><strong>Gifting &amp; branding</strong> — bespoke Moroccan gifts, branded touchpoints, custom menus</li>
                            </ul>
                            <p class="dmc-ex">Example: a 45-person sales-award incentive — 4 nights across a Marrakech palace hotel and a luxury Agafay camp, cooking class, quad-bike sunset, private hammam evening, gala with Gnaoua musicians.</p>
                            <h4>Team Building &amp; Wellness Retreats</h4>
                            <ul>
                                <li><strong>Outcome-driven formats</strong> — collaboration, leadership, culture, celebration</li>
                                <li><strong>Wellness retreats</strong> — yoga on riad rooftops, hammam rituals, Atlas Mountain hikes, mindful desert nights</li>
                                <li><strong>Hybrid days</strong> — morning workshop, afternoon medina challenge, evening rooftop dinner</li>
                                <li><strong>Full facilitation</strong> — English/French-speaking facilitators, scoring, prizes, photo &amp; video coverage</li>
                            </ul>
                            <p class="dmc-ex">Example: a 30-person leadership retreat — 2 nights in a private Atlas kasbah, guided trek to a Berber village, tagine-cooking competition, strategy sessions with a mountain view.</p>
                            <p><a href="{{ route('team-building.marrakech') }}">View Team Building &amp; Incentive Travel options →</a></p>
                        </div></div>
                    </div>

                    {{-- 4. Destination services --}}
                    <div class="accordion-item">
                        <h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dmcG4" aria-expanded="false" aria-controls="dmcG4">Destination Services &amp; Activities</button></h3>
                        <div id="dmcG4" class="accordion-collapse collapse" data-bs-parent="#dmcGuide"><div class="accordion-body">
                            <p>As a full-service destination management company, we operate every element of the ground programme — so you contract one partner, not ten suppliers.</p>
                            <h4>Guided City Tours &amp; Cultural Immersion</h4>
                            <ul>
                                <li><strong>The Medina</strong> — souks, fondouks, artisan quarters, guided by licensed local experts</li>
                                <li><strong>Koutoubia Mosque &amp; Gardens</strong> — the city's landmark minaret and the perfect starting point for a walking tour</li>
                                <li><strong>Bahia Palace</strong> — 19th-century grandeur, zellige, cedar ceilings and courtyard gardens</li>
                                <li><strong>Jemaa el-Fnaa</strong> — storytellers, musicians and food stalls at dusk, with reserved rooftop seating for groups</li>
                                <li><strong>Ben Youssef Madrasa, Saadian Tombs, Majorelle &amp; Le Jardin Secret</strong> — combined into half-day or full-day circuits</li>
                                <li><strong>Immersive add-ons</strong> — calligraphy classes, spice-souk tastings, private meetings with master artisans</li>
                            </ul>
                            <p>Formats: 2-hour walking tours, half-day guided circuits, full-day cultural immersion, evening food walks.</p>
                            <h4>Desert Camps &amp; Sahara Experiences</h4>
                            <p><strong>Agafay Desert (45 minutes from Marrakech)</strong> — luxury tented camps with private dining, pools and lounges; ideal for gala dinners, one-night incentives and team building; quad biking, camel rides, stargazing, live music.</p>
                            <p><strong>Erg Chebbi &amp; Merzouga (Sahara)</strong> — overnight stays in private luxury camps beneath the great dunes; camel caravan at sunset, 4x4 dune safaris, Gnaoua music by the fire. Reached via a 2-day Atlas &amp; Kasbah route (Aït Ben Haddou, Dadès and Todra Gorges) or by domestic flight to Errachidia. Best for 3 to 6-night programmes and high-impact incentives.</p>
                            <p>We manage every layer: camp buy-outs, convoy logistics, menus, welfare and contingency for remote locations.</p>
                            <h4>Accommodation &amp; Transfer Coordination</h4>
                            <ul>
                                <li>Long-standing <strong>riad partnerships</strong> in the medina — exclusive-use buy-outs for 8 to 40 guests</li>
                                <li><strong>Luxury hotels &amp; palaces</strong> — Hivernage, Palmeraie, Agdal and the Atlas foothills</li>
                                <li><strong>Room blocks</strong> on negotiated net rates with clear release dates; site inspections and virtual walk-throughs on request</li>
                                <li>Airport meet &amp; greet at Marrakech Menara (RAK), Casablanca (CMN), Fes (FEZ), Agadir (AGA)</li>
                                <li>Executive minivans, luxury coaches, 4x4 fleets and chauffeur-driven cars</li>
                                <li>Inter-city logistics with timed departures, luggage handling and on-board hosts; staggered arrival management for large delegations</li>
                            </ul>
                            <h4>Dining, Culinary &amp; Wellness Experiences</h4>
                            <ul>
                                <li><strong>Private riad dinners</strong> with live oud or Gnaoua music; <strong>rooftop dining</strong> above the medina at sunset</li>
                                <li><strong>Chef-led cooking classes</strong> — tagine, couscous, pastilla, mint tea ceremony</li>
                                <li><strong>Palace gala banquets</strong> for 100–500 guests, with full production</li>
                                <li><strong>Street-food walks</strong> on Jemaa el-Fnaa; <strong>wine &amp; olive-oil tastings</strong> in the Atlas foothills</li>
                                <li><strong>All dietary requirements</strong> handled: halal by default, vegetarian, vegan, gluten-free, kosher-style on request</li>
                                <li><strong>Wellness &amp; spa</strong> — traditional hammam rituals, private spa buy-outs, rooftop yoga, Atlas retreats</li>
                            </ul>
                        </div></div>
                    </div>

                    {{-- 5. Team building list --}}
                    <div class="accordion-item">
                        <h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dmcG5" aria-expanded="false" aria-controls="dmcG5">12 Team Building Activities in Marrakech</button></h3>
                        <div id="dmcG5" class="accordion-collapse collapse" data-bs-parent="#dmcGuide"><div class="accordion-body">
                            <p>Twelve proven formats, delivered with facilitators, transport, equipment and insurance included. Mix and match to your objectives and timing.</p>
                            <ol>
                                <li><strong>Moroccan Cooking Class Challenge</strong> — teams source spices in the souk, then compete to cook the best tagine under a chef's guidance.</li>
                                <li><strong>Camel Trekking in the Sahara</strong> — a sunset caravan across the Erg Chebbi dunes to a private camp.</li>
                                <li><strong>Horseback Riding in the Palmeraie</strong> — guided rides through palm groves and Berber villages.</li>
                                <li><strong>Traditional Hammam Experience</strong> — a private spa buy-out with black-soap scrub, argan rituals and mint tea.</li>
                                <li><strong>Medina Treasure Hunt</strong> — GPS-guided teams decode clues across souks, fondouks and hidden squares.</li>
                                <li><strong>Pottery &amp; Carpet-Weaving Workshops</strong> — hands-on sessions with master artisans.</li>
                                <li><strong>Sunset at Jemaa el-Fnaa</strong> — reserved rooftop terrace, street-food tasting menu and a guided walk.</li>
                                <li><strong>Quad Biking &amp; Desert Adventures</strong> — guided quad or buggy circuits across Agafay, then lunch at a luxury camp.</li>
                                <li><strong>Atlas Mountains Hiking</strong> — guided treks from Imlil or the Ourika Valley, with lunch in a Berber family home.</li>
                                <li><strong>Souk Market Tour &amp; Haggling Workshop</strong> — learn the etiquette, then compete to negotiate the best price.</li>
                                <li><strong>Tagine Preparation &amp; Dining Experience</strong> — cook, dine and share stories in a private riad courtyard.</li>
                                <li><strong>Berber Village Homestay</strong> — an overnight immersion in the High Atlas; shared meals, storytelling and a dawn walk.</li>
                            </ol>
                            <p><strong>Optional add-ons:</strong> hot-air balloon flights, olympic-style desert games, calligraphy classes, drum circles, CSR days with local associations.</p>
                        </div></div>
                    </div>

                    {{-- 6. Nationwide --}}
                    <div class="accordion-item">
                        <h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dmcG6" aria-expanded="false" aria-controls="dmcG6">Beyond Marrakech: Nationwide Destination Management</button></h3>
                        <div id="dmcG6" class="accordion-collapse collapse" data-bs-parent="#dmcGuide"><div class="accordion-body">
                            <p>One DMC partner, the whole of Morocco. Marrakech is our base; the country is our product.</p>
                            <ul>
                                <li><strong>Fes</strong> — the world's largest living medieval medina; tanneries, madrasas, gala dinners in restored palaces</li>
                                <li><strong>Casablanca</strong> — Morocco's business capital; corporate arrivals, Hassan II Mosque, conference hotels</li>
                                <li><strong>Rabat</strong> — the capital; government-level events, Kasbah of the Udayas, Hassan Tower, Chellah</li>
                                <li><strong>Tangier &amp; Chefchaouen</strong> — Mediterranean gateway and the blue medina; ideal for Spain-combined programmes</li>
                                <li><strong>Essaouira</strong> — Atlantic breeze, UNESCO medina, seafood, wind sports and Gnaoua music; 2.5 hours from Marrakech</li>
                                <li><strong>Agadir &amp; Taghazout</strong> — beach resorts, golf, surf and wellness for large leisure groups</li>
                                <li><strong>The Atlas Mountains</strong> — Imlil, Ourika, Ouirgane; kasbah hotels, treks, Berber hospitality</li>
                                <li><strong>Ouarzazate &amp; the Kasbah Route</strong> — Aït Ben Haddou, film studios, Dadès and Todra gorges</li>
                                <li><strong>Erg Chebbi &amp; Erg Chigaga</strong> — the great Saharan dunes; luxury camps, 4x4 safaris</li>
                            </ul>
                            <p><strong>Signature multi-city routes:</strong> Imperial Cities (Marrakech · Fes · Meknes · Rabat), Sahara Circuit (Marrakech · Atlas · Merzouga · Fes), Coast &amp; Medina (Marrakech · Essaouira · Agadir). Each route is delivered end-to-end by the same Morocco Quest team.</p>
                        </div></div>
                    </div>

                    {{-- 7. Agents & operators --}}
                    <div class="accordion-item">
                        <h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dmcG7" aria-expanded="false" aria-controls="dmcG7">Why Travel Agents &amp; Tour Operators Partner With Us</button></h3>
                        <div id="dmcG7" class="accordion-collapse collapse" data-bs-parent="#dmcGuide"><div class="accordion-body">
                            <p>Beyond MICE, FIT and small-group bookings come to us year-round from agencies and operators who need a reliable Marrakech ground handler for their own product.</p>
                            <h4>What the partnership looks like</h4>
                            <ul>
                                <li><strong>White-label from day one</strong> — no Morocco Quest branding on vouchers, vehicles or guides unless you want it</li>
                                <li><strong>Net-rate tariff &amp; seasonal rate card</strong> — annual contracting for operators, ad-hoc quotes for agencies</li>
                                <li><strong>Product support</strong> — sample itineraries, hotel descriptions, image libraries and copy you can resell</li>
                                <li><strong>Fast turnaround</strong> — quotes within 24 hours, confirmations within 48</li>
                                <li><strong>Consistency</strong> — the same guides, drivers and standards on every departure</li>
                                <li><strong>Protection</strong> — licensed, insured and compliant with Moroccan tourism regulation</li>
                            </ul>
                            <h4>Product types we operate for the trade</h4>
                            <ul>
                                <li>Private tailor-made tours (couples, families, small friends' groups)</li>
                                <li>Guaranteed-departure small-group tours under your brand</li>
                                <li>Luxury honeymoon and celebration travel</li>
                                <li>Special-interest programmes: art, gardens, gastronomy, photography, hiking, golf</li>
                                <li>Day trips and excursions from Marrakech for cruise and resort guests</li>
                                <li>Ground services only (transfers, guides, hotels) for operators packaging their own product</li>
                            </ul>
                        </div></div>
                    </div>

                    {{-- 8. Sustainability --}}
                    <div class="accordion-item">
                        <h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dmcG8" aria-expanded="false" aria-controls="dmcG8">Sustainable &amp; Responsible Destination Management</button></h3>
                        <div id="dmcG8" class="accordion-collapse collapse" data-bs-parent="#dmcGuide"><div class="accordion-body">
                            <p>Luxury and responsibility are not opposites. As a Marrakech DMC we are committed to programmes that benefit the communities your clients visit:</p>
                            <ul>
                                <li><strong>Local first</strong> — family-owned riads, Berber-run mountain lodges, artisan cooperatives, local guides</li>
                                <li><strong>CSR &amp; purpose formats</strong> — school-garden projects, women's cooperative visits, reforestation days in the Atlas</li>
                                <li><strong>Lower-impact logistics</strong> — grouped transfers, electric vehicles in the city where available, plastic-free water solutions</li>
                                <li><strong>Cultural respect</strong> — briefing documents for delegates on etiquette, dress and photography</li>
                                <li><strong>Measurable reporting</strong> — sustainability summaries for corporate clients with ESG obligations</li>
                            </ul>
                            <p><a href="{{ route('sustainable-events.morocco') }}">Read more about our Sustainable Events →</a></p>
                        </div></div>
                    </div>

                    {{-- 9. Pricing --}}
                    <div class="accordion-item">
                        <h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dmcG9" aria-expanded="false" aria-controls="dmcG9">Pricing &amp; Packages</button></h3>
                        <div id="dmcG9" class="accordion-collapse collapse" data-bs-parent="#dmcGuide"><div class="accordion-body">
                            <p>We work exclusively on <strong>confidential net rates</strong> for the trade. Your commission and mark-up remain entirely yours. Every quote is line-itemised so you can present it to your client with confidence. Rates depend on:</p>
                            <ul>
                                <li><strong>Group size</strong> — economies of scale on transport, guides and venues</li>
                                <li><strong>Season</strong> — peak (March–May, October–December), shoulder and summer</li>
                                <li><strong>Accommodation level</strong> — boutique riads, 4-star hotels, 5-star palaces, luxury camps</li>
                                <li><strong>Activities &amp; production</strong> — from guided tours to full gala production and AV</li>
                                <li><strong>Programme length &amp; geography</strong> — single-city stays vs multi-city or Sahara routes</li>
                            </ul>
                            <h4>Popular packages (fully customisable)</h4>
                            <ul>
                                <li><strong>Marrakech Essentials</strong> — 3 nights, riad or hotel, guided medina, Agafay dinner</li>
                                <li><strong>Incentive Signature</strong> — 4 nights, palace hotel + luxury camp, cooking class, quad sunset, gala</li>
                                <li><strong>Sahara Grand Tour</strong> — 6 nights, Marrakech · Atlas · Erg Chebbi · Fes</li>
                                <li><strong>Congress Ground Package</strong> — hotel blocks, transfers, hospitality desk, gala, optional tours</li>
                            </ul>
                            <p><a href="#dmc-enquiry">Request a custom quote — net-rate proposal within 24 hours →</a></p>
                        </div></div>
                    </div>

                    {{-- 10. How to book --}}
                    <div class="accordion-item">
                        <h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dmcG10" aria-expanded="false" aria-controls="dmcG10">How to Book Your Marrakech DMC Programme</button></h3>
                        <div id="dmcG10" class="accordion-collapse collapse" data-bs-parent="#dmcGuide"><div class="accordion-body">
                            <h4>Request a Custom Proposal</h4>
                            <p>Send us the essentials and we do the rest:</p>
                            <ul>
                                <li>Group size and participant profile</li>
                                <li>Preferred dates (or season) and programme length</li>
                                <li>Destinations of interest — Marrakech only, or multi-city</li>
                                <li>Accommodation level and budget guidance</li>
                                <li>Objectives: incentive, conference, team building, leisure</li>
                                <li>Any must-have experiences or constraints</li>
                            </ul>
                            <h4>Our Planning Process</h4>
                            <ol>
                                <li><strong>Brief &amp; discovery call</strong> — we clarify objectives, audience and budget within 24 hours of your enquiry.</li>
                                <li><strong>Tailored proposal</strong> — a full itinerary with line-itemised net rates, venue options and visuals, typically within one business day.</li>
                                <li><strong>Refinement</strong> — we adjust the programme with you until it fits the brief and the budget.</li>
                                <li><strong>Contracting</strong> — clear terms, deposit schedule and supplier release dates.</li>
                                <li><strong>Pre-arrival operations</strong> — rooming lists, manifests, menus, briefing documents and a dedicated operations contact.</li>
                                <li><strong>On-the-ground delivery</strong> — your account manager and our operations team on site, 24/7.</li>
                                <li><strong>Post-programme review</strong> — reconciliation, feedback and a debrief for your next programme.</li>
                            </ol>
                        </div></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
