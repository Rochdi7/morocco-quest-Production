<?php

return [

    /*
    |--------------------------------------------------------------------------
    | SEO Meta Defaults
    |--------------------------------------------------------------------------
    */
    'meta' => [
        'defaults' => [
            'title'       => 'Morocco Quest: Authentic Tours and Travel',
            'description' => 'Discover unforgettable Morocco tours, Sahara desert adventures, day trips, and cultural experiences with Morocco Quest – your trusted travel agency.',
            'separator'   => ' | ',
            'keywords' => [
                'morocco desert tours',
                'sahara desert tours from marrakech',
                'merzouga camel trekking',
                '3 day desert tour morocco',
                'ouzoud waterfalls day trip',
                'atlas mountains trekking',
                'fes to marrakech desert tour',
                'chefchaouen excursions',
                'private morocco tours',
                'local berber guide',
                'marrakech day trips',
                'morocco adventure travel',
            ],
            'canonical'   => null, // Set dynamically
            'robots'      => 'index,follow',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | OpenGraph Defaults
    |--------------------------------------------------------------------------
    */
    'opengraph' => [
        'defaults' => [
            'title'       => 'Morocco Quest: Authentic Tours and Travel',
            'description' => 'Join expertly guided desert tours, private excursions, and cultural trips across Morocco with Morocco Quest.',
            'url'         => null, // Set dynamically
            'type'        => 'website',
            'site_name'   => 'Morocco Quest',
            'images'      => [
                'https://morocco-quest.com/assets/img/morocco-quest-social-share.webp',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Twitter Card Defaults
    |--------------------------------------------------------------------------
    */
    'twitter' => [
        'defaults' => [
            'card'        => 'summary_large_image',
            'site'        => '@MoroccoQuest',
            'title'       => 'Morocco Quest: Authentic Tours and Travel',
            'description' => 'Explore Morocco with desert adventures, imperial city tours, and personalized travel packages.',
            'image'       => 'https://morocco-quest.com/assets/img/morocco-quest-social-share.webp',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | JSON-LD Defaults
    |--------------------------------------------------------------------------
    */
    'json-ld' => [
        'defaults' => [
            'title'       => 'Morocco Quest: Authentic Tours and Travel',
            'description' => 'Plan your Moroccan adventure with Sahara desert tours, cultural trips, and expert guides at Morocco Quest.',
            'url'         => null, // Set dynamically
            'type'        => 'WebPage',
            'images'      => [
                'https://morocco-quest.com/assets/img/morocco-quest-social-share.webp',
            ],
        ],
    ],
];
