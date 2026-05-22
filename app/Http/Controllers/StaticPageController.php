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
        $title       = 'About Morocco Quest | Local Morocco Tour Operator in Marrakech';
        $description = 'About Morocco Quest, a local Moroccan travel agency offering private morocco tours, sahara desert tours from Marrakech, small group tours morocco and luxury morocco tours.';
        $keywords    = ['morocco tours', 'private morocco tours', 'morocco tour package', 'morocco guided tours', 'small group tours morocco', 'luxury morocco tours', 'morocco tour company', 'morocco tour agency'];
        $this->setSeo($title, $description, 'AboutPage', $keywords);
        return view('about', [
            'title' => $title,
            'description' => $description,
            'keywords' => implode(', ', $keywords),
        ]);
    }

    public function faq()
    {
        $title       = 'FAQ | Morocco Tours, Sahara Desert Trips & Booking | Morocco Quest';
        $description = 'FAQs about morocco tours, sahara desert tours from Marrakech, morocco day trips, morocco multi day tours, booking, prices and travel tips.';
        $keywords    = ['morocco tours', 'private morocco tours', 'sahara desert tours morocco', 'morocco desert tours from marrakech', 'morocco day tours', 'morocco multi day tours', 'morocco tour package'];

        $this->setSeo($title, $description, null, $keywords);

        return view('faq', [
            'title' => $title,
            'description' => $description,
            'keywords' => implode(', ', $keywords),
        ]);
    }

    public function contact()
    {
        $title       = 'Contact Morocco Quest | Book Morocco Tours & Sahara Trips';
        $description = 'Contact Morocco Quest to book morocco tours, sahara desert tours from Marrakech, morocco day trips and private morocco tours. Reply within 24h.';
        $keywords    = ['morocco tours', 'morocco tour agency', 'morocco tour company', 'private morocco tours', 'morocco tour package', 'contact morocco tour operator'];
        $this->setSeo($title, $description, 'ContactPage', $keywords);
        return view('contact', [
            'title' => $title,
            'description' => $description,
            'keywords' => implode(', ', $keywords),
        ]);
    }

    public function terms()
    {
        $title       = 'Terms and Conditions | Morocco Quest';
        $description = 'Terms and conditions for booking morocco tours and morocco tour packages with Morocco Quest.';
        $keywords    = ['morocco tours', 'morocco tour package', 'morocco tour agency'];
        $this->setSeo($title, $description, 'TermsOfService', $keywords);
        return view('terms-and-conditions', [
            'title' => $title,
            'description' => $description,
            'keywords' => implode(', ', $keywords),
        ]);
    }

    public function cookie()
    {
        $title       = 'Cookie Policy | Morocco Quest';
        $description = 'Cookie Policy for the Morocco Quest website and our morocco tours booking platform.';
        $keywords    = ['morocco quest', 'morocco tours', 'cookie policy'];
        $this->setSeo($title, $description, 'WebPage', $keywords);
        return view('cookie-policy', [
            'title' => $title,
            'description' => $description,
            'keywords' => implode(', ', $keywords),
        ]);
    }

    public function privacy()
    {
        $title       = 'Privacy Policy | Morocco Quest';
        $description = 'Privacy Policy for Morocco Quest. How we handle your data when you browse and book morocco tours.';
        $keywords    = ['morocco quest', 'morocco tours', 'privacy policy'];
        $this->setSeo($title, $description, 'PrivacyPolicy', $keywords);
        return view('privacy-policy', [
            'title' => $title,
            'description' => $description,
            'keywords' => implode(', ', $keywords),
        ]);
    }

    private function setSeo($title, $description, $type = 'WebPage', $keywords = [])
    {
        $url = url()->current();

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);
        SEOMeta::addKeyword($keywords);

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
