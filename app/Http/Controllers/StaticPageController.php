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
        $title = 'About Morocco Quest | Best Morocco Private Tour Company';
        $description = 'About Morocco Quest, the best morocco private tour company. Marrakech desert tours, sahara desert tour from marrakech, and luxury desert tours marrakech.';
        $keywords = ['best morocco private tour company', 'morocco private tours', 'marrakech desert tours', 'sahara desert tour from marrakech', 'private tours in morocco'];
        $this->setSeo($title, $description, 'AboutPage', $keywords);
        return view('about');
    }

    public function faq()
    {
        $title = 'FAQ | Morocco Private Tours & Marrakech Desert Tours - Morocco Quest';
        $description = 'Frequently asked questions about morocco private tours, marrakech desert tours, sahara desert tour from marrakech, and private tours in morocco.';
        $keywords = ['morocco private tours', 'marrakech desert tours', 'sahara desert tour from marrakech', 'private tours in morocco', 'luxury desert tours marrakech'];

        $this->setSeo($title, $description, null, $keywords);

        return view('faq');
    }

    public function contact()
    {
        $title = 'Contact Morocco Quest | Book Morocco Private Tours';
        $description = 'Contact Morocco Quest to book morocco private tours, marrakech desert tours, or a sahara desert tour from marrakech. Private tours in morocco tailored to you.';
        $keywords = ['morocco private tours', 'marrakech desert tours', 'sahara desert tour from marrakech', 'private tours in morocco', 'best morocco private tour company'];
        $this->setSeo($title, $description, 'ContactPage', $keywords);
        return view('contact');
    }

    public function terms()
    {
        $title = 'Terms and Conditions | Morocco Quest';
        $description = 'Terms and conditions for Morocco Quest morocco private tours and marrakech desert tours.';
        $keywords = ['morocco private tours', 'marrakech desert tours'];
        $this->setSeo($title, $description, 'TermsOfService', $keywords);
        return view('terms-and-conditions');
    }

    public function cookie()
    {
        $title = 'Cookie Policy | Morocco Quest';
        $description = 'Cookie Policy for Morocco Quest morocco private tours and marrakech desert tours.';
        $keywords = ['morocco private tours', 'marrakech desert tours'];
        $this->setSeo($title, $description, 'WebPage', $keywords);
        return view('cookie-policy');
    }

    public function privacy()
    {
        $title = 'Privacy Policy | Morocco Quest';
        $description = 'Privacy Policy for Morocco Quest morocco private tours and marrakech desert tours.';
        $keywords = ['morocco private tours', 'marrakech desert tours'];
        $this->setSeo($title, $description, 'PrivacyPolicy', $keywords);
        return view('privacy-policy');
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
