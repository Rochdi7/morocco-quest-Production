<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class SustainableEventsController extends Controller
{
    public function index(): View
    {
        $title       = 'Sustainable Events Morocco | Responsible MICE | Morocco Quest';
        $description = 'Sustainable events in Morocco: local sourcing, artisan cooperative partnerships and honest reporting for CSR and ESG corporate programmes.';
        $keywords    = [
            'sustainable events morocco',
            'responsible corporate events morocco',
            'CSR events morocco',
            'sustainable MICE morocco',
            'eco-conscious events marrakech',
            'responsible tourism corporate morocco',
            'sustainable incentive travel morocco',
            'community engagement events marrakech',
            'ESG events morocco',
            'sustainable DMC morocco',
        ];

        $url   = url('/sustainable-events-morocco');
        $image = asset('assets/img/berber-terrace-atlas-mountains-imlil-morocco.webp');

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
            ->setTitle('Sustainable Event Management — Morocco Quest DMC')
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image);

        return view('sustainable-events-morocco', compact('title', 'description', 'keywords'));
    }
}
