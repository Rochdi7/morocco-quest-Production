<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class TeamBuildingController extends Controller
{
    public function index(): View
    {
        $title       = 'Team Building Marrakech | Incentive Travel Morocco';
        $description = 'Team building and incentive travel programmes in Marrakech: Atlas Mountain challenges, desert camps, medina rallies and CSR activities for corporate groups.';
        $keywords    = [
            'team building marrakech',
            'incentive travel morocco',
            'corporate team building morocco',
            'incentive travel marrakech',
            'morocco incentive house',
            'group activities marrakech',
            'corporate retreat morocco',
            'csr activities morocco',
            'incentive programme marrakech',
            'agafay desert team building',
        ];

        $url   = url('/team-building-marrakech');
        $image = asset('assets/img/agafay-desert-luxury-camp-camel-trek-morocco.webp');

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
            ->setTitle('Team Building & Incentive Travel — Morocco Quest DMC')
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image);

        return view('team-building-marrakech', compact('title', 'description', 'keywords'));
    }
}
