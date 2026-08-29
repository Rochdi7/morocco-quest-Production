<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class DmcController extends Controller
{
    public function index(): View
    {
        // "morocco dmc" (170/mo, KD 10) carries ~8x the volume of "dmc marrakech"
        // (20/mo, KD 7) at similar difficulty, so it leads; the Marrakech variant
        // is retained in the tail since the page already ranks for it.
        $title       = 'Morocco DMC | MICE & Incentive Travel | DMC Marrakech';
        $description = 'Morocco DMC for travel agents, tour operators and MICE planners. Group tours, team building and incentives across Marrakech and Morocco.';
        // Ordered by Semrush volume: morocco dmc 170, dmc morocco 90, dmc marrakech 20.
        $keywords    = [
            'morocco dmc',
            'dmc morocco',
            'dmc marrakech',
            'destination management company morocco',
            'marrakech dmc',
            'ground operator morocco',
            'morocco ground services',
            'morocco inbound tour operator',
            'morocco travel agent b2b',
            'morocco incentive travel',
            'mice morocco',
            'morocco corporate travel',
            'morocco tour operator wholesale',
            'private tours morocco b2b',
            'morocco group tours operator',
        ];

        $url   = url('/dmc-marrakech');
        $image = asset('assets/img/ait-benhaddou-morocco-travel-hero-banner.webp');

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

        JsonLd::setType('TravelAgency')
            ->setTitle('Morocco Quest — DMC Marrakech')
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image);

        return view('dmc-marrakech', compact('title', 'description', 'keywords'));
    }
}
