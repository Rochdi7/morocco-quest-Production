<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class StaticPageController extends Controller
{
    public function about()
    {
        $title = 'About Morocco Quest | Private Morocco Tours & Exclusive Experiences';
        $description = 'Discover who we are, Morocco Quest, and how we create unforgettable private morocco tours and exclusive morocco travel experiences.'; $this->setSeo($title, $description, 'AboutPage');
        return view('about');
    }

    public function faq()
    {
        $title = 'FAQ | Private Morocco Tours & Morocco Travel Questions | Morocco Quest';
        $description = 'Find answers to common questions about private tours morocco, small group tours morocco, and morocco travel services.';

        $this->setSeo($title, $description, null);

        return view('faq');
    }

    public function contact()
    {
        $title = 'Contact Morocco Quest | Private Morocco Tours & Bookings';
        $description = 'Have questions or ready to book your private tour morocco? Contact Morocco Quest today for the best private tours morocco planning.';
        $this->setSeo($title, $description, 'ContactPage');
        return view('contact');
    }

    public function terms()
    {
        $title = 'Terms and Conditions | Morocco Quest Travel Services';
        $description = 'Read the terms and conditions that govern the use of Morocco Quest services, including private tours morocco bookings.';
        $this->setSeo($title, $description, 'TermsOfService');
        return view('terms-and-conditions');
    }

    public function cookie()
    {
        $title = 'Cookie Policy | Morocco Quest';
        $description = 'Learn how Morocco Quest uses cookies to improve your website experience while browsing our luxury morocco tours and services.';
        $this->setSeo($title, $description, 'WebPage');
        return view('cookie-policy');
    }

    public function privacy()
    {
        $title = 'Privacy Policy | Morocco Quest';
        $description = 'Understand how Morocco Quest collects, uses, and protects your personal data when booking private tours morocco.';
        $this->setSeo($title, $description, 'PrivacyPolicy');
        return view('privacy-policy');
    }

    private function setSeo($title, $description, $type = 'WebPage')
    {
        $url = url()->current();

        $commercialKeywords = [
            'morocco private tours',
            'private morocco tours',
            'private morocco tour',
            'private tours morocco',
            'private tour morocco',
            'small group tours morocco',
            'morocco small group tours',
            'exclusive morocco travel experiences',
            'vip morocco tours',
            'morocco luxury travel',
            'luxury travel morocco',
            'morocco travel insurance',
            'morocco travel agent',
            'what is the best time to travel to morocco',
            'morocco travel visa requirements',
            'luxury desert experience morocco camp',
        ];

        $baseKeywords = array_filter(explode(' ', $title));
        $allKeywords = array_merge($baseKeywords, $commercialKeywords);


        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);
        SEOMeta::addKeyword($allKeywords);

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl($url);

        if ($type) {
            JsonLd::setTitle($title)
                ->setDescription($description)
                ->setType($type);
        }
    }
}
