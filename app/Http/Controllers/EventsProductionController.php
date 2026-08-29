<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class EventsProductionController extends Controller
{
    public function index(): View
    {
        $title       = 'Corporate Events Morocco | Event Production Marrakech';
        $description = 'Event production in Morocco: staging, lighting, sound, LED and scenography for product launches, brand activations and galas in Marrakech.';
        $keywords    = [
            'corporate events morocco',
            'event production morocco',
            'event production marrakech',
            'brand activation morocco',
            'product launch morocco',
            'corporate event agency morocco',
            'live communication morocco',
            'event scenography marrakech',
            'stage production morocco',
            'corporate gala marrakech',
        ];

        $url   = url('/events-production-morocco');
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
            ->setTitle('Events Production & Communication — Morocco Quest DMC')
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image);

        return view('events-production-morocco', compact('title', 'description', 'keywords'));
    }
}
