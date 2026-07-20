<?php

// config/company.php
return [

    'name' => 'Morocco Quest',

    'address' => 'Khalid Ibn Al Walid Street, Gueliz, Marrakech, 40000, Morocco', // <-- Updated Address

    'latitude' => '31.6343547',
    'longitude' => '-8.00426',

    'phone' => [
        'customer_service_1' => [
            'display' => '+212654069718', // <-- Updated Phone Number
            'link' => 'tel:+212654069718',    // <-- Updated Link
        ],

    ],

    'email' => [
        'info' => 'sales@morocco-quest.com', // <-- Updated Email

    ],

    'socials' => [
        'instagram' => [
            'url' => 'https://www.instagram.com/moroccoquestdmc/', // <-- Updated Instagram
            'icon' => 'fa-brands fa-instagram',
            'title' => 'Instagram',
        ],
        'twitter' => [
            'url' => 'https://x.com/mounirakajiamounirakajia', // <-- Updated Twitter/X
            'icon' => 'fa-brands fa-twitter',
            'title' => 'Twitter/X',
        ],
        'facebook' => [
            'url' => 'https://www.facebook.com/profile.php?id=61578772746041', // <-- Updated Facebook
            'icon' => 'fa-brands fa-facebook-f',
            'title' => 'Facebook',
        ],
    ],

    // You could add map coordinates or other details here too
    'map_iframe_src' => 'https://www.google.com/maps?q=Morocco+Quest+DMC,31.6343547,-8.00426&output=embed',
    'map_url' => 'https://maps.app.goo.gl/FtVJocKLhRVvvF377',
];
