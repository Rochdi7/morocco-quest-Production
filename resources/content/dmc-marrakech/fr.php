<?php

/*
|--------------------------------------------------------------------------
| /fr/dmc-marrakech — contenu français (mêmes clés que en.php)
|--------------------------------------------------------------------------
| Version localisée (pas une traduction mot à mot) pour les agences, TO,
| agences d'incentive et organisateurs d'événements francophones.
| Mêmes règles que en.php : aucun fait d'entreprise non vérifié.
*/

$wa = 'https://wa.me/212654069718?text=' . rawurlencode('Bonjour Morocco Quest DMC, je souhaite un devis B2B pour un programme à Marrakech.');

return [
    'locale'   => 'fr',
    'og_locale' => 'fr_FR',

    'meta' => [
        'title'       => 'DMC Marrakech | Agence réceptive & MICE | Morocco Quest',
        'description' => 'DMC à Marrakech pour agences, tour-opérateurs et entreprises : séminaires, voyages incentive, team building et logistique au Maroc. Devis sous 24 h.',
        'og_image_alt' => 'DMC Marrakech — Morocco Quest DMC',
    ],

    'lang_switch' => ['label' => 'English version', 'hreflang' => 'en', 'route' => 'dmc.marrakech'],

    'breadcrumb' => ['home' => 'Accueil', 'current' => 'DMC Marrakech'],

    'hero' => [
        'eyebrow' => 'Morocco Quest DMC · Marrakech',
        'h1'      => 'DMC Marrakech : agence réceptive pour séminaires, voyages incentive et événements d\'entreprise',
        'lead'    => 'Votre partenaire local à Marrakech pour les agences de voyages, tour-opérateurs, agences d\'incentive et organisateurs d\'événements. Nous organisons et pilotons toute la partie terrain de votre programme — hôtels, transferts, lieux, guides et équipes sur place — et vous adressons un devis net détaillé sous 24 heures.',
        'cta_quote'    => 'Demander un devis',
        'cta_whatsapp' => 'WhatsApp — service B2B',
        'whatsapp_url' => $wa,
        'image_alt'    => 'Dîner de gala en plein air sous des lanternes, pour un grand groupe, dans un lieu marocain',
    ],

    'facts' => [
        'heading' => 'Morocco Quest DMC en bref',
        'items' => [
            ['icon' => 'fa-location-dot', 'label' => 'Bureau',     'value' => 'Guéliz, Marrakech',          'link' => 'https://maps.app.goo.gl/FtVJocKLhRVvvF377', 'link_label' => 'Voir sur Google Maps'],
            ['icon' => 'fa-calendar-check', 'label' => 'Création', 'value' => '2022, par Mounir Akajia',    'link' => null],
            ['icon' => 'fa-map',          'label' => 'Couverture', 'value' => 'Marrakech et tout le Maroc', 'link' => null],
            ['icon' => 'fa-language',     'label' => 'Langues',    'value' => 'Français · anglais · espagnol · arabe', 'link' => null],
            ['icon' => 'fa-clock',        'label' => 'Devis',      'value' => 'Devis net sous 24 h',        'link' => null],
            ['icon' => 'fa-star',         'label' => 'Avis',       'value' => 'Tripadvisor et Google',     'link' => '#dmc-reviews', 'link_label' => 'Lire les avis indépendants'],
        ],
    ],

    'who' => [
        'eyebrow' => 'Qui sommes-nous',
        'h2'      => 'Une agence réceptive à Marrakech au service des professionnels du voyage',
        'paragraphs' => [
            'Une DMC (Destination Management Company), ou agence réceptive, conçoit et pilote la partie terrain d\'un programme dans sa destination : hôtels et riads, transferts, lieux de réunion et d\'événement, guides, activités, restauration et équipes présentes sur place. C\'est exactement le rôle de Morocco Quest à Marrakech pour les agences, les tour-opérateurs, les agences d\'incentive et les entreprises qui veulent un seul interlocuteur local.',
            'Morocco Quest a été fondée à Marrakech en 2022 par Mounir Akajia ; notre bureau se trouve rue Khalid Ibn Al Walid, à Guéliz. La même équipe organise aussi des circuits privés dans tout le Maroc, ce qui nous met chaque jour en contact avec les hôtels, chauffeurs, guides, camps et restaurants que nous réservons pour les groupes.',
            'Pour nos partenaires professionnels, nous travaillons en marque blanche et à tarifs nets confidentiels : votre marque sur le programme, votre marge sur le prix, et un interlocuteur unique du premier brief au dernier transfert.',
        ],
        'bullets' => [
            'Un seul interlocuteur local pour les hôtels, le transport, les lieux, les guides et les activités',
            'Des devis nets détaillés ligne par ligne, revendables sous votre marque',
            'Des programmes à Marrakech et dans tout le Maroc — villes impériales, Atlas, côte et Sahara',
            'Une équipe opérationnelle à Marrakech, joignable par téléphone, e-mail et WhatsApp',
        ],
        'image_alt' => 'Rue animée de la médina près de Jemaa el-Fna à Marrakech, avec étals et minaret',
        'team_heading' => 'Quelques-uns des guides qui accompagnent nos groupes',
        'team_intro'   => 'Des guides locaux de notre équipe, chacun spécialiste de sa région. Leurs profils complets sont sur notre page À propos (en anglais).',
        'team' => [
            ['name' => 'Mohamed Sahraoui', 'role' => 'Spécialiste du désert', 'img' => 'assets/img/guides/mohamed-sahraoui-desert-expert-guide.webp', 'w' => 412, 'h' => 574],
            ['name' => 'Salwa Benayyad',   'role' => 'Guide de montagne',     'img' => 'assets/img/guides/salwa-benayyad-certified-female-guide.webp', 'w' => 284, 'h' => 384],
            ['name' => 'Hicham Echerfaoui','role' => 'Spécialiste de Rabat', 'img' => 'assets/img/guides/hicham-echerfaoui-rabat-morocco-tour-guide.webp', 'w' => 310, 'h' => 428],
            ['name' => 'Hassan Tebbal',    'role' => 'Spécialiste de Fès',   'img' => 'assets/img/guides/hassan-tebbal-fes-expert-guide.webp', 'w' => 788, 'h' => 1066],
        ],
        'about_link' => 'Découvrir l\'équipe (page À propos)',
    ],

    'services' => [
        'eyebrow' => 'Nos services DMC',
        'h2'      => 'Nos services de DMC à Marrakech',
        'intro'   => 'Huit métiers, réservés et coordonnés par une seule équipe locale. Ouvrez une vignette pour le détail ou consultez la page dédiée (en anglais).',
        'details_label' => 'Détails',
        'tiles' => [
            ['img' => 'corporate-event-garden-gala',     'alt' => 'Dîner de gala dans un jardin, tables nappées de rouge et artistes marocains', 'title' => 'MICE et événements d\'entreprise', 'text' => 'Dîners de gala, lancements de produits, soirées de remise de prix et célébrations dans des palais, jardins et camps du désert.', 'anchor' => 'guide-events', 'route' => 'events-production.morocco', 'route_label' => 'Production d\'événements'],
            ['img' => 'incentive-camel-caravan',         'alt' => 'Caravane de dromadaires traversant une plaine désertique sous un ciel bleu', 'title' => 'Voyages incentive', 'text' => 'Des voyages de stimulation autour de Marrakech, du désert d\'Agafay, de l\'Atlas et du Sahara, avec des moments privatisés.', 'anchor' => 'guide-incentive', 'route' => 'team-building.marrakech', 'route_label' => 'Team building et incentive'],
            ['img' => 'conference-theatre-hall',         'alt' => 'Salle de conférence en configuration théâtre avec fauteuils rouges et scène', 'title' => 'Congrès et séminaires', 'text' => 'Recherche de lieux, gestion des participants, technique via nos partenaires et accueil sur place pour toutes les tailles de réunion.', 'anchor' => 'guide-meetings', 'route' => 'meetings-conventions.management', 'route_label' => 'Réunions et congrès'],
            ['img' => 'team-building-quad-palm-grove',   'alt' => 'Quads sur une piste sableuse à travers une palmeraie', 'title' => 'Team building', 'text' => 'Des formats animés dans la médina, la Palmeraie, les contreforts de l\'Atlas et le désert, choisis selon vos objectifs.', 'anchor' => 'guide-teambuilding', 'route' => 'team-building.marrakech', 'route_label' => 'Team building à Marrakech'],
            ['img' => 'luxury-desert-tent-dinner',       'alt' => 'Grande tente berbère dressée pour un dîner privé, collines désertiques derrière les baies', 'title' => 'Expériences haut de gamme', 'text' => 'Riads privatisés, dîners privés, camps dans le désert, vols en montgolfière et accès à des lieux difficiles à réserver seul.', 'anchor' => 'guide-incentive', 'route' => '360-solutions.morocco', 'route_label' => 'Solutions événementielles 360°'],
            ['img' => 'transport-4x4-fleet',             'alt' => 'Groupe de 4x4 et de voyageurs lors d\'un arrêt dans le Maroc rural', 'title' => 'Transport et logistique', 'text' => 'Accueil à l\'aéroport de Marrakech, autocars, minibus, convois 4x4, manifestes et départs minutés pour chaque transfert.', 'anchor' => 'guide-transport', 'route' => null, 'route_label' => null],
            ['img' => 'riad-courtyard-accommodation',    'alt' => 'Patio à arcades avec fontaine dans un hôtel de style riad', 'title' => 'Hôtels et riads', 'text' => 'Allotements à tarifs nets, riads privatisés et contrats hôteliers à l\'Hivernage, à la Palmeraie, à l\'Agdal et dans la médina.', 'anchor' => 'guide-hotels', 'route' => null, 'route_label' => null],
            ['img' => 'guided-visit-dar-el-bacha',       'alt' => 'Visite guidée d\'un groupe dans le patio carrelé d\'un palais-musée de Marrakech', 'title' => 'Excursions et expériences privées', 'text' => 'Visites guidées de la médina, excursions dans l\'Atlas et à Essaouira, cours de cuisine, hammam et accès culturels privés.', 'anchor' => 'guide-excursions', 'route' => 'tours.index', 'route_label' => 'Circuits et excursions'],
        ],
    ],

    'guide' => [
        'eyebrow' => 'Guide des services',
        'h2'      => 'Guide des services DMC à Marrakech pour agences, TO et organisateurs MICE',
        'intro'   => 'Ce que comprend chaque service et comment nous l\'opérons sur le terrain. Ouvrez un thème ci-dessous.',
        'items' => [
            [
                'id' => 'guide-meetings', 'title' => 'Réunions, congrès et séminaires', 'img' => 'conference-interpreting-booth', 'img_alt' => 'Pupitre d\'interprète, casque et documents dans une cabine de traduction',
                'html' => '<p>Marrakech dispose de lieux pour tous les formats : le <strong>Palais des Congrès de Marrakech</strong> à l\'Hivernage, des hôtels de congrès à l\'Hivernage, à la Palmeraie et à l\'Agdal, et des domaines privés pour les comités de direction. Nous sélectionnons et comparons les lieux selon votre cahier des charges, puis organisons toute la logistique des participants.</p>
<ul>
<li><strong>Recherche et réservation de lieux</strong> — plénière, sous-commissions, espace d\'exposition, traiteur et fiches techniques</li>
<li><strong>Gestion des participants</strong> — appui à l\'inscription, rooming lists, manifestes d\'arrivée et de départ, desks d\'accueil</li>
<li><strong>Technique, scénographie et interprétation</strong> avec des prestataires sélectionnés</li>
<li><strong>Séminaires d\'entreprise et comités de direction</strong> en hôtel, riad ou villa privée, avec des activités autour du programme</li>
<li><strong>Programmes accompagnants</strong> pendant les sessions</li>
</ul>
<p>Pour les grands congrès avec abstracts, sponsoring et plateforme d\'inscription, voir notre service d\'<a href="' . route('congress-organization.morocco') . '">organisation professionnelle de congrès</a> (en anglais).</p>',
            ],
            [
                'id' => 'guide-incentive', 'title' => 'Voyages incentive', 'img' => 'hot-air-balloon-sunrise', 'img_alt' => 'Montgolfières s\'élevant au lever du soleil au-dessus de 4x4 garés dans une plaine désertique',
                'html' => '<p>Un incentive doit être exclusif et se dérouler sans accroc. Nous construisons le voyage autour de quelques moments forts et organisons la logistique pour que le groupe n\'attende jamais.</p>
<ul>
<li><strong>Arrivées</strong> — accueil privé à l\'aéroport de Marrakech-Ménara et accueil à l\'hôtel ou au riad</li>
<li><strong>Moments signature</strong> — montgolfière au lever du soleil, coucher de soleil dans le désert d\'Agafay, dîner privé dans un riad ou un palais</li>
<li><strong>Privatisations</strong> — riads, camps et terrasses réservés à votre groupe</li>
<li><strong>Un rythme équilibré</strong> — activités choisies et temps libre prévus</li>
<li><strong>Extensions</strong> — Essaouira, l\'Atlas ou une nuit au Sahara pour les programmes plus longs</li>
</ul>',
            ],
            [
                'id' => 'guide-events', 'title' => 'Organisation d\'événements et dîners de gala', 'img' => 'palace-restaurant-service', 'img_alt' => 'Serveur traversant un restaurant de palais richement décoré sous un lustre en cristal',
                'html' => '<p>Du cocktail de bienvenue à la soirée de remise de prix, nous adaptons le lieu, le menu et la production à la taille du groupe et au ton de l\'événement.</p>
<ul>
<li><strong>Lieux</strong> — restaurants de palais, patios de riads, domaines de la Palmeraie et camps de luxe à Agafay</li>
<li><strong>Production</strong> — scène, lumière, son et décor avec nos partenaires en <a href="' . route('events-production.morocco') . '">production d\'événements</a></li>
<li><strong>Animations</strong> — musiciens gnaoua et andalous, troupes folkloriques, DJ</li>
<li><strong>Dîners à thème et lancements de produits</strong>, avec habillage et conduite de soirée</li>
</ul>',
            ],
            [
                'id' => 'guide-teambuilding', 'title' => 'Team building à Marrakech', 'img' => null, 'img_alt' => null,
                'html' => '<p>Chaque format est choisi pour l\'objectif visé — cohésion, leadership, célébration — et livré avec animateurs, transport et matériel.</p>
<ul>
<li>Rallye dans la médina : les équipes parcourent souks et fondouks avec énigmes et défis</li>
<li>Défi tajine avec un chef, dans un riad ou une ferme</li>
<li>Circuits en quad ou buggy dans la Palmeraie ou le désert d\'Agafay</li>
<li>Randonnée dans les contreforts de l\'Atlas et déjeuner dans un village berbère</li>
<li>Ateliers poterie, calligraphie ou tissage avec des artisans</li>
<li>Jeux du désert et activités au coucher du soleil dans un camp privé</li>
<li>Journées RSE avec des associations locales</li>
</ul>
<p>Plus de formats sur notre page <a href="' . route('team-building.marrakech') . '">team building à Marrakech</a> (en anglais).</p>',
            ],
            [
                'id' => 'guide-transport', 'title' => 'Transport et logistique', 'img' => null, 'img_alt' => null,
                'html' => '<p>C\'est dans les transferts qu\'un programme gagne ou perd du temps. Nous les organisons comme une opération, pas comme une simple réservation.</p>
<ul>
<li><strong>Accueil aéroport</strong> à Marrakech-Ménara (RAK), Casablanca (CMN), Fès (FEZ) et Agadir (AGA)</li>
<li><strong>Véhicules</strong> — voitures avec chauffeur, minibus, autocars et convois 4x4 pour les routes du désert</li>
<li><strong>Manifestes et arrivées échelonnées</strong> pour les grands groupes, avec un contact opérationnel le jour J</li>
<li><strong>Logistique inter-villes</strong> — départs minutés, gestion des bagages et accompagnateurs à bord</li>
</ul>',
            ],
            [
                'id' => 'guide-hotels', 'title' => 'Hôtels, riads et hébergement', 'img' => null, 'img_alt' => null,
                'html' => '<p>Marrakech propose aussi bien des riads de charme dans la médina que des resorts internationaux équipés pour les congrès. Nous réservons la combinaison adaptée à votre budget et à votre programme.</p>
<ul>
<li><strong>Allotements</strong> à tarifs nets avec dates de rétrocession claires</li>
<li><strong>Riads privatisés</strong> pour les petits groupes qui souhaitent une maison privée dans la médina</li>
<li><strong>Hôtels et palaces</strong> à l\'Hivernage, à la Palmeraie, à l\'Agdal et au pied de l\'Atlas</li>
<li><strong>Visites d\'inspection</strong> sur place ou en vidéo avant confirmation</li>
</ul>',
            ],
            [
                'id' => 'guide-excursions', 'title' => 'Excursions, gastronomie et expériences privées', 'img' => 'moroccan-gala-dinner-cuisine', 'img_alt' => 'Plat marocain servi lors d\'un dîner aux chandelles',
                'html' => '<p>Les après-midi libres et les programmes accompagnants font partie de l\'expérience. Nous les assurons avec nos propres guides locaux et des prestataires avec qui nous travaillons régulièrement.</p>
<ul>
<li>Visites guidées de la médina, du palais Bahia, de la médersa Ben Youssef, du jardin Majorelle et du Jardin Secret</li>
<li>Excursions dans la vallée de l\'Ourika, à Imlil et dans le Haut Atlas, à Essaouira ou à Ouarzazate</li>
<li>Cours de cuisine, balades gourmandes à Jemaa el-Fna, dégustations de vin et d\'huile d\'olive</li>
<li>Rituels de hammam et soins privés</li>
<li>Régimes alimentaires communiqués par écrit à chaque prestataire</li>
</ul>
<p>Nos produits prêts à vendre sont dans les catalogues <a href="' . route('tours.index') . '">circuits</a> et <a href="' . route('experiences.index') . '">expériences</a> (en anglais).</p>',
            ],
            [
                'id' => 'guide-responsible', 'title' => 'Une gestion de destination responsable', 'img' => null, 'img_alt' => null,
                'html' => '<p>Nous privilégions les riads familiaux, les guides locaux, les coopératives d\'artisans et les transferts groupés, et nous informons les participants des usages locaux. Les programmes avec reporting ESG sont présentés sur notre page <a href="' . route('sustainable-events.morocco') . '">événements durables</a> (en anglais).</p>',
            ],
        ],
    ],

    'planner' => [
        'eyebrow' => 'Pour les organisateurs',
        'h2'      => 'Marrakech pour les organisateurs d\'événements : repères clés',
        'intro'   => 'Les chiffres que les organisateurs demandent en premier. Données approximatives, sources ci-dessous ; nous les confirmons pour vos dates dans chaque proposition.',
        'image_alt' => 'Place Jemaa el-Fna au crépuscule avec les stands éclairés, Marrakech',
        'rows' => [
            ['k' => 'Aéroport',          'v' => 'Marrakech-Ménara (RAK), à environ 6 km du centre-ville ; environ 9 millions de passagers en 2024.', 'src' => [1, 2]],
            ['k' => 'Temps de vol',      'v' => 'Environ 3 h à 4 h en vol direct depuis Paris ou Londres ; moins depuis l\'Espagne et le Portugal.', 'src' => []],
            ['k' => 'Palais des congrès', 'v' => 'Palais des Congrès de Marrakech, Hivernage : 19 salles de réunion, plus grande salle d\'environ 1 489 personnes, environ 2 600 m² d\'exposition.', 'src' => [3]],
            ['k' => 'Capacité hôtelière', 'v' => 'Environ 1 900 établissements classés et quelque 75 000 lits, des riads de la médina aux resorts de congrès.', 'src' => [4]],
            ['k' => 'Désert d\'Agafay',  'v' => 'À environ 30–35 km de la ville, soit 45 minutes de route. Très demandé pour les dîners de gala et les couchers de soleil.', 'src' => [5]],
            ['k' => 'Essaouira',         'v' => 'Environ 175–180 km sur la côte atlantique, soit 2 h 30 à 3 h de route.', 'src' => [6]],
            ['k' => 'Fuseau horaire',    'v' => 'Le Maroc est à GMT+1 la majeure partie de l\'année et repasse à GMT pendant le ramadan.', 'src' => []],
            ['k' => 'Monnaie',           'v' => 'Dirham marocain (MAD). Nous établissons nos devis en EUR, USD, GBP ou MAD.', 'src' => []],
            ['k' => 'Langues',           'v' => 'L\'arabe et l\'amazighe sont officiels ; le français est très utilisé dans les affaires ; l\'anglais est courant dans l\'hôtellerie et le tourisme.', 'src' => []],
            ['k' => 'Saisons',           'v' => 'Le printemps et l\'automne sont les plus agréables pour les programmes en extérieur ; l\'été est très chaud ; l\'hiver est doux le jour et froid la nuit dans le désert.', 'src' => []],
            ['k' => 'Ramadan',           'v' => 'Les dates avancent d\'environ 11 jours chaque année ; horaires des restaurants et service d\'alcool peuvent changer, nous en tenons compte.', 'src' => []],
            ['k' => 'Formalités',        'v' => 'De nombreuses nationalités, dont les citoyens de l\'UE, du Royaume-Uni, des États-Unis et du Canada, peuvent en général entrer sans visa pour un court séjour — vérifiez toujours les règles pour chaque passeport.', 'src' => []],
        ],
        'sources_label' => 'Sources',
        'sources' => [
            1 => ['label' => 'Cvent — Getting around Marrakesh', 'url' => 'https://www.cvent.com/meeting-event-planning/morocco/marrakesh/travel'],
            2 => ['label' => 'Wikipédia — Aéroport de Marrakech-Ménara', 'url' => 'https://en.wikipedia.org/wiki/Marrakesh_Menara_Airport'],
            3 => ['label' => 'AMI — fiche Palais des Congrès de Marrakech', 'url' => 'https://www.amimagazine.global/Meeting-Event-Venues/Marrakech-Morocco/Convention-Center/Palais-des-Congres-de-Marrakech-p57988170'],
            4 => ['label' => '7news.ma — hébergement classé à Marrakech', 'url' => 'https://en.7news.ma/?p=13164'],
            5 => ['label' => 'Lonely Planet — excursions depuis Marrakech', 'url' => 'https://www.lonelyplanet.com/articles/best-day-trips-from-marrakesh'],
            6 => ['label' => 'Rough Guides — Marrakech à Essaouira', 'url' => 'https://www.roughguides.com/morocco/getting-around/marrakech-to-essaouira'],
        ],
        'map' => [
            'title' => 'Temps de route approximatifs depuis Marrakech',
            'center' => 'Marrakech',
            'points' => [
                ['name' => 'Aéroport Ménara (RAK)', 'time' => '≈ 15–20 min'],
                ['name' => 'Désert d\'Agafay',      'time' => '≈ 45 min'],
                ['name' => 'Essaouira',             'time' => '≈ 2 h 30–3 h'],
            ],
            'note' => 'Schéma sans échelle. Les durées varient selon le trafic et le point de départ.',
        ],
    ],

    'samples' => [
        'eyebrow' => 'Exemples de formats',
        'h2'      => 'Exemples de programmes à Marrakech que nous pouvons construire',
        'disclaimer' => 'Formats indicatifs pour montrer ce qui est possible. Chaque programme est chiffré selon votre brief ; il ne s\'agit pas de comptes rendus d\'événements passés.',
        'items' => [
            ['img' => 'agafay-desert-camp', 'alt' => 'Terrasse lounge d\'un camp de luxe dans le désert d\'Agafay, avec l\'Atlas à l\'horizon', 'title' => 'Incentive de 3 jours à Marrakech', 'meta' => 'Groupe type : 20 à 80 personnes', 'points' => ['Accueil à l\'aéroport et dîner de bienvenue dans un riad', 'Découverte guidée de la médina et temps libre dans les souks', 'Coucher de soleil et dîner de gala dans un camp privé à Agafay', 'Vol en montgolfière au lever du soleil en option']],
            ['img' => 'guests-arrival-event-venue', 'alt' => 'Invités marchant sur un tapis rouge vers un lieu d\'événement en plein air', 'title' => 'Séminaire de 2 jours avec soirée de gala', 'meta' => 'Groupe type : 80 à 300 participants', 'points' => ['Plénière et ateliers dans un hôtel de congrès de l\'Hivernage', 'Desk d\'accueil, manifestes et transferts minutés', 'Dîner de gala avec animations marocaines dans un palais', 'Programme accompagnants pendant les sessions']],
            ['img' => 'sahara-camp-sunset-extension', 'alt' => 'Camp dans le Sahara au coucher du soleil avec des tapis rouges posés sur le sable', 'title' => 'Marrakech + extension au Sahara', 'meta' => 'Durée type : 4 à 6 jours', 'points' => ['Traversée du Haut Atlas par le col du Tizi n\'Tichka', 'Aït Benhaddou et les vallées du Drâa ou du Dadès', 'Nuit dans un camp de luxe à l\'Erg Chebbi (Merzouga)', 'Retour à Marrakech ou départ via Fès']],
        ],
    ],

    'case_studies' => [],

    'coverage' => [
        'eyebrow' => 'Tout le Maroc',
        'h2'      => 'Au-delà de Marrakech : une DMC pour tout le Maroc',
        'intro'   => 'Marrakech est notre base, tout le pays est notre terrain. Les programmes multi-villes sont assurés de bout en bout par la même équipe, avec un seul contrat et un seul interlocuteur.',
        'image_alt' => 'Route sinueuse de montagne dans l\'Atlas, avec un village en contrebas',
        'cities' => [
            ['city' => 'Fès',            'label' => 'Ville impériale et médina'],
            ['city' => 'Casablanca',     'label' => 'Pôle d\'affaires et arrivées'],
            ['city' => 'Rabat',          'label' => 'Capitale et institutions'],
            ['city' => 'Tanger',         'label' => 'Porte de l\'Europe'],
            ['city' => 'Essaouira',      'label' => 'Côte atlantique'],
            ['city' => 'Agadir',         'label' => 'Balnéaire et grands groupes'],
            ['city' => 'Atlas',          'label' => 'Kasbahs et randonnée'],
            ['city' => 'Sahara',         'label' => 'Camps de Merzouga et de l\'Erg Chebbi'],
        ],
        'links' => [
            ['route' => 'destinations.index', 'label' => 'Découvrir les destinations (en anglais)'],
            ['route' => 'tours.multi_day',    'label' => 'Voir les circuits de plusieurs jours (en anglais)'],
        ],
    ],

    'why' => [
        'eyebrow' => 'Pourquoi nous',
        'h2'      => 'Pourquoi les agences choisissent Morocco Quest comme DMC au Maroc',
        'image_alt' => 'Poignée de main devant un moucharabieh en bois sculpté',
        'items' => [
            ['icon' => 'fa-location-dot', 'title' => 'Un bureau à Marrakech', 'text' => 'Notre équipe travaille depuis Guéliz : lieux, prestataires et visites d\'inspection sont à quelques minutes.'],
            ['icon' => 'fa-pen-ruler',    'title' => 'Des programmes sur mesure', 'text' => 'Chaque proposition est construite selon votre brief, votre public et votre budget — pas de forfait imposé.'],
            ['icon' => 'fa-diagram-project', 'title' => 'Une coordination unique des prestataires', 'text' => 'Hôtels, transport, lieux, guides et activités sont réservés et coordonnés par la même équipe.'],
            ['icon' => 'fa-headset',      'title' => 'Un suivi opérationnel le jour J', 'text' => 'Un contact opérationnel suit chaque programme jour après jour et gère les imprévus sur place.'],
            ['icon' => 'fa-list-check',   'title' => 'Des devis transparents', 'text' => 'Des tarifs nets détaillés ligne par ligne, pour ajouter, retirer ou recalculer chaque élément avant de le présenter.'],
            ['icon' => 'fa-language',     'title' => 'Une communication B2B internationale', 'text' => 'Nous travaillons en français, anglais, espagnol et arabe, avec un brief écrit pour chaque prestataire.'],
        ],
    ],

    'choose' => [
        'eyebrow' => 'Check-list acheteur',
        'h2'      => 'Comment choisir une DMC à Marrakech',
        'intro'   => 'Quel que soit le partenaire retenu, voici les questions à poser avant de signer.',
        'items' => [
            ['title' => 'Licence et immatriculation', 'text' => 'Demandez la licence d\'agence de voyages et les informations légales, et vérifiez qu\'elles correspondent à l\'entité qui signe le contrat.'],
            ['title' => 'Un vrai bureau local', 'text' => 'Une équipe basée à Marrakech peut visiter les lieux, rencontrer les prestataires et réagir vite le jour J.'],
            ['title' => 'Assurance responsabilité civile', 'text' => 'Demandez l\'attestation d\'assurance et vérifiez qu\'elle couvre les prestations de votre programme.'],
            ['title' => 'Des équipes propres sur place', 'text' => 'Demandez qui sera physiquement présent aux arrivées, événements et transferts — et comment le joindre la nuit.'],
            ['title' => 'Références et avis indépendants', 'text' => 'Demandez des références d\'agences de votre marché et lisez les avis sur des plateformes indépendantes.'],
            ['title' => 'Contrats prestataires et rétrocessions', 'text' => 'Allotements, lieux et camps doivent faire l\'objet de conditions écrites avec des dates de rétrocession claires.'],
            ['title' => 'Conditions de paiement et devise', 'text' => 'Convenez de l\'échéancier d\'acomptes, de la date de solde et de la devise de facturation avant de contracter.'],
            ['title' => 'Plans d\'urgence', 'text' => 'Demandez comment sont gérés la météo, les retards, les problèmes médicaux ou un changement de lieu — et qui décide.'],
        ],
        'outro' => 'Posez-nous ces questions dès le premier échange : nous y répondons par écrit.',
    ],

    'process' => [
        'eyebrow' => 'Notre méthode',
        'h2'      => 'Comment se déroule un programme avec notre équipe DMC à Marrakech',
        'steps' => [
            ['title' => 'Brief initial', 'text' => 'Un appel ou un brief écrit : objectifs, public, dates, nombre de participants et incontournables.'],
            ['title' => 'Besoins et budget', 'text' => 'Nous validons l\'enveloppe, la catégorie d\'hôtel, les lieux et les contraintes avant de proposer des options.'],
            ['title' => 'Proposition et itinéraire', 'text' => 'Un programme jour par jour avec tarifs nets détaillés — sous 24 heures pour les demandes standard.'],
            ['title' => 'Coordination des prestataires', 'text' => 'Contrats, acomptes, rooming lists, manifestes, menus et brief écrit à chaque prestataire.'],
            ['title' => 'Exécution sur place', 'text' => 'Notre équipe gère arrivées, transferts, événements et activités, et règle les imprévus sur le terrain.'],
            ['title' => 'Suivi après l\'événement', 'text' => 'Bilan financier, retours de votre part et de votre client, et notes pour le programme suivant.'],
        ],
    ],

    'form' => [
        'eyebrow' => 'Demande B2B',
        'h2'      => 'Demander un devis à tarifs nets',
        'intro'   => 'Présentez-nous votre programme. Nous répondons sous 24 heures avec nos questions ou une première estimation. Toutes les demandes sont confidentielles.',
        'page_source' => 'dmc-marrakech-fr',
        'labels' => [
            'name' => 'Nom complet', 'company' => 'Société / agence', 'email' => 'E-mail professionnel', 'phone' => 'Téléphone / WhatsApp',
            'date' => 'Date de début', 'pax' => 'Nombre de participants', 'duration' => 'Durée du programme (jours)', 'service' => 'Type de programme',
            'brief' => 'Votre brief', 'required' => 'obligatoire',
        ],
        'placeholders' => [
            'name' => 'Votre nom complet', 'company' => 'Votre société ou agence', 'email' => 'vous@societe.com', 'phone' => '+33 / +32 / +41…',
            'pax' => 'Nombre de participants', 'duration' => 'Nombre de jours',
            'brief' => 'Destinations, catégorie d\'hôtel, objectifs, activités, profil des participants, budget…',
        ],
        'service_options' => ['Circuits privés / individuels', 'Incentive / MICE', 'Forfait groupe', 'Transferts uniquement', 'Programme DMC complet'],
        'privacy' => 'Votre demande est confidentielle. Vos coordonnées servent uniquement à vous répondre.',
        'submit' => 'Envoyer la demande',
        'success_title' => 'Demande envoyée',
        'error_title' => 'Une erreur est survenue',
        'errors_title' => 'Merci de vérifier les points suivants :',
        'contact_heading' => 'Service B2B',
        'contact_lines' => [
            'company' => 'Morocco Quest DMC',
            'address' => 'Rue Khalid Ibn Al Walid, Guéliz, Marrakech 40000, Maroc',
            'languages' => 'Français · anglais · espagnol · arabe',
            'response' => 'Réponse sous 24 heures',
        ],
        'call_label' => 'Appeler',
        'email_label' => 'E-mail',
        'whatsapp_label' => 'WhatsApp',
    ],

    'reviews' => [
        'eyebrow' => 'Avis indépendants',
        'h2'      => 'Ce que disent voyageurs et partenaires',
        'intro'   => 'Nous ne publions pas de témoignages anonymes sur cette page. Consultez plutôt les avis vérifiés sur Morocco Quest DMC sur des plateformes indépendantes.',
        'links' => [
            ['label' => 'Morocco Quest DMC sur Tripadvisor', 'url' => 'https://www.tripadvisor.com/Attraction_Review-g293734-d33367694-Reviews-Morocco_Quest_Dmc-Marrakech_Marrakech_Safi.html', 'icon' => 'fa-star'],
            ['label' => 'Morocco Quest DMC sur Google Maps', 'url' => 'https://maps.app.goo.gl/FtVJocKLhRVvvF377', 'icon' => 'fa-location-dot'],
        ],
    ],

    'memberships' => [],
    'memberships_heading' => 'Adhésions et partenaires',

    'faq' => [
        'eyebrow' => 'FAQ',
        'h2'      => 'Questions fréquentes — DMC Marrakech',
        'items' => [
            ['q' => 'Que fait une DMC à Marrakech ?', 'a' => 'Une DMC, ou agence réceptive, prend en charge la partie terrain d\'un programme : hôtels et riads, transferts, lieux de réunion et d\'événement, guides, activités, restauration, production et équipes sur place. Elle réserve les prestataires locaux et les coordonne pour que le client n\'ait qu\'un seul interlocuteur.'],
            ['q' => 'Avec qui travaillez-vous ?', 'a' => 'Agences de voyages, tour-opérateurs, agences d\'incentive, agences événementielles et services voyages d\'entreprises. Morocco Quest vend aussi des circuits privés directement aux voyageurs ; nos partenaires professionnels bénéficient de la marque blanche, de tarifs nets confidentiels et d\'un interlocuteur dédié.'],
            ['q' => 'Sous quel délai recevons-nous une proposition ?', 'a' => 'Pour une demande standard, nous envoyons un devis net détaillé sous 24 heures. Un grand congrès ou un incentive complexe peut nécessiter un court appel de cadrage.'],
            ['q' => 'Combien de temps à l\'avance faut-il réserver un séminaire à Marrakech ?', 'a' => 'À titre indicatif, trois à six mois pour un groupe de 20 à 60 personnes et six à douze mois pour un grand congrès, surtout au printemps et à l\'automne. Des délais plus courts sont souvent possibles — interrogez-nous.'],
            ['q' => 'Organisez-vous des séminaires et du team building à Marrakech pour de petits groupes ?', 'a' => 'Oui. Séminaires, comités de direction et journées de team building fonctionnent très bien en petit comité dans un riad, une villa privée ou un hôtel, et nous organisons aussi des délégations bien plus importantes. Les tarifs groupe deviennent intéressants à partir d\'une dizaine de participants environ.'],
            ['q' => 'Organisez-vous des programmes en dehors de Marrakech ?', 'a' => 'Oui : Fès, Casablanca, Rabat, Tanger, Essaouira, Agadir, l\'Atlas et le Sahara, en destination unique ou en circuit multi-villes avec un seul contrat.'],
            ['q' => 'Quelles langues parlent vos guides ?', 'a' => 'Français, anglais, espagnol et arabe en standard. D\'autres langues sont possibles sur demande, selon disponibilité.'],
            ['q' => 'Quelles conditions de paiement et quelles devises ?', 'a' => 'En général un acompte à la confirmation, un second versement avant l\'arrivée et le solde à la date convenue ; les conditions exactes dépendent du programme et des prestataires. Nous facturons en EUR, USD, GBP ou MAD.'],
            ['q' => 'Quelle est la meilleure saison pour un événement à Marrakech ?', 'a' => 'Le printemps et l\'automne sont les plus agréables pour l\'extérieur. L\'été est très chaud : nous programmons alors les activités tôt le matin et en fin de journée. L\'hiver est doux en journée, avec des nuits froides dans le désert.'],
            ['q' => 'Pouvez-vous organiser une visite d\'inspection ?', 'a' => 'Oui. Nous proposons des visites vidéo des hôtels, riads et lieux, ainsi que des visites d\'inspection sur place à Marrakech ; les éventuels frais sont communiqués à l\'avance.'],
        ],
    ],

    'related' => [
        'heading' => 'Nos autres services DMC',
        'intro'   => 'Découvrez l\'ensemble de nos services réceptifs (pages en anglais) — chaque élément de votre programme pris en charge par un seul partenaire local.',
        'more'    => 'En savoir plus',
        'items' => [
            'destination-management.company'  => ['title' => 'Qu\'est-ce qu\'une DMC ?', 'desc' => 'Le rôle d\'une DMC et comment évaluer un partenaire au Maroc.'],
            'meetings-conventions.management' => ['title' => 'Réunions et congrès', 'desc' => 'Recherche de lieux, technique et logistique des participants.'],
            'team-building.marrakech'         => ['title' => 'Team building et incentive', 'desc' => 'Programmes désert, Atlas et médina adaptés à votre brief.'],
            'events-production.morocco'       => ['title' => 'Production d\'événements', 'desc' => 'Scénographie, lumière, son et écrans LED.'],
            'congress-organization.morocco'   => ['title' => 'Organisation de congrès (PCO)', 'desc' => 'Abstracts, inscriptions, sponsors et gestion sur place.'],
            'sustainable-events.morocco'      => ['title' => 'Événements durables', 'desc' => 'Événements à faible impact et achats locaux responsables.'],
            '360-solutions.morocco'           => ['title' => 'Solutions 360°', 'desc' => 'Une prestation de bout en bout avec un chef de projet unique.'],
        ],
    ],

    'products' => [
        'subtitle' => 'Pour vos clients',
        'heading'  => 'Des programmes prêts à vendre à Marrakech',
        'intro'    => 'Circuits et expériences réservables à intégrer à un programme de groupe ou à revendre à tarif net (fiches en anglais).',
        'browse_tours' => 'Tous les circuits',
        'browse_activities' => 'Toutes les expériences',
    ],

    'cta' => [
        'h2'   => 'Prêt à préparer votre programme à Marrakech ?',
        'text' => 'Envoyez-nous votre brief et recevez un devis net détaillé sous 24 heures.',
        'quote' => 'Demander un devis',
    ],
];
