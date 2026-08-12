<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class CongressOrganizationController extends Controller
{
    public function index(): View
    {
        $title       = 'Professional Congress Organizer Morocco | PCO Marrakech | Morocco Quest DMC';
        $description = 'Professional Congress Organizer services in Morocco. Abstract management, scientific programme support, sponsor and exhibitor management for medical and scientific congresses.';
        $keywords    = [
            'professional congress organizer morocco',
            'PCO morocco',
            'congress organization marrakech',
            'medical congress morocco',
            'scientific congress organizer morocco',
            'association congress morocco',
            'congress management marrakech',
            'abstract management platform morocco',
            'scientific programme coordination morocco',
            'congress bidding support morocco',
        ];

        $url   = url('/professional-congress-organization');
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
            ->setTitle('Professional Congress Organization — Morocco Quest DMC')
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image);

        return view('professional-congress-organization', compact('title', 'description', 'keywords'));
    }
}
