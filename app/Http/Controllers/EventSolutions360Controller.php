<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class EventSolutions360Controller extends Controller
{
    public function index(): View
    {
        $title       = '360° Event Solutions Morocco | Integrated MICE Programmes | Morocco Quest DMC';
        $description = 'One DMC managing your entire multi-day corporate programme in Morocco — meetings, team building, events and gala dinners under a single point of accountability.';
        $keywords    = [
            '360 event solutions morocco',
            'integrated event management morocco',
            'end to end MICE morocco',
            'full service DMC morocco',
            'turnkey corporate events morocco',
            'integrated incentive programme morocco',
            'multi-day corporate programme marrakech',
            'complete event management morocco',
            'single point of contact DMC morocco',
        ];

        $url   = url('/360-event-solutions');
        $image = asset('assets/img/Luxury-Dinner-Setup-Wedding-Morocco-Outdoor-Event.webp');

        SEOMeta::setTitle($title, false)
            ->setDescription($description)
            ->setCanonical($url)
            ->addKeyword($keywords);

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->setType('website')
            ->setSiteName('Morocco Quest')
            ->addImage($image, ['width' => 1200, 'height' => 630]);

        OpenGraph::addProperty('twitter:card',        'summary_large_image');
        OpenGraph::addProperty('twitter:title',       $title);
        OpenGraph::addProperty('twitter:description', $description);
        OpenGraph::addProperty('twitter:image',       $image);

        JsonLd::setType('Service')
            ->setTitle('360° Event & Travel Solutions — Morocco Quest DMC')
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image);

        return view('360-event-solutions', compact('title', 'description', 'keywords'));
    }
}
