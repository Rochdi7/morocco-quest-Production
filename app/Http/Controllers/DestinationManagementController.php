<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class DestinationManagementController extends Controller
{
    public function index(): View
    {
        $title       = 'Destination Management Company Morocco | What is a DMC | Morocco Quest';
        $description = 'What a Destination Management Company does in Morocco: services, when to use one, and how to evaluate a DMC partner for events, incentives and group travel.';
        $keywords    = [
            'destination management company morocco',
            'DMC morocco',
            'what is a DMC',
            'DMC services morocco',
            'ground handling company morocco',
            'morocco DMC partner',
            'event agency morocco',
            'destination management company marrakech',
            'DMC partner selection',
            'MICE ground operator morocco',
        ];

        $url   = url('/destination-management-company');
        $image = asset('assets/img/dmc-in-morocco-moroccoquest.webp');

        SEOMeta::setTitle($title)
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
            ->setTitle('Destination Management Company Services — Morocco Quest DMC')
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image);

        return view('destination-management-company', compact('title', 'description', 'keywords'));
    }
}
