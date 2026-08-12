<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class MeetingsConventionsController extends Controller
{
    public function index(): View
    {
        $title       = 'Meetings & Conventions Management Marrakech | Morocco Quest DMC';
        $description = 'Professional conference and convention management in Marrakech. Venue sourcing, AV production, delegate logistics and on-site coordination for corporate meetings across Morocco.';
        $keywords    = [
            'meetings and conventions marrakech',
            'conference management morocco',
            'convention management marrakech',
            'corporate meetings morocco',
            'meeting planner marrakech',
            'venue sourcing marrakech',
            'conference venues morocco',
            'delegate management morocco',
            'business events marrakech',
            'PCO morocco',
        ];

        $url   = url('/meetings-conventions-management');
        $image = asset('assets/img/Moroccan-Palace-Restaurant-Elegant-Dining-Setup.webp');

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
            ->setTitle('Meetings & Conventions Management — Morocco Quest DMC')
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image);

        return view('meetings-conventions-management', compact('title', 'description', 'keywords'));
    }
}
