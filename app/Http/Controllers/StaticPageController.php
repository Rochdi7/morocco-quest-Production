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
        $description = 'Morocco Quest is a Marrakech-based tour operator run by local guides. We offer private morocco tours, sahara desert trips, small group tours and luxury morocco packages — with 24h support.';
        $keywords    = [
            'morocco tour company',
            'morocco tour agency',
            'morocco tour operator',
            'local morocco tour company',
            'best morocco tour companies',
            'morocco tours',
            'private morocco tours',
            'small group tours morocco',
            'luxury morocco tours',
            'marrakech tour operator',
        ];
        $this->setSeo($title, $description, 'AboutPage', $keywords);
        return view('about', [
            'title'       => $title,
            'description' => $description,
            'keywords'    => implode(', ', $keywords),
        ]);
    }

    public function faq()
    {
        $title       = 'Morocco Tours FAQ | Cost, Booking & Sahara Desert Questions Answered';
        $description = 'Answers to the most common questions about booking morocco tours: how much does a morocco tour cost, are sahara desert trips worth it, best time to visit morocco, group size and cancellation policy.';
        $keywords    = [
            'morocco tours faq',
            'how much does a morocco tour cost',
            'best time to visit morocco',
            'are sahara desert tours worth it',
            'morocco tour booking',
            'morocco day tours',
            'morocco multi day tours',
            'morocco desert tours from marrakech',
            'private morocco tours',
            'morocco tour package',
        ];
        $this->setSeo($title, $description, 'FAQPage', $keywords);
        return view('faq', [
            'title'       => $title,
            'description' => $description,
            'keywords'    => implode(', ', $keywords),
        ]);
    }

    public function contact()
    {
        $title       = 'Contact Morocco Quest | Book a Private Morocco Tour from Marrakech';
        $description = 'Get in touch with Morocco Quest to book a private morocco tour, sahara desert trip or day excursion from Marrakech. We reply within 24 hours. Best price guaranteed.';
        $keywords    = [
            'contact morocco tour operator',
            'book morocco tour',
            'morocco tour agency',
            'morocco tour company',
            'private morocco tours',
            'morocco tours',
            'sahara desert tours morocco',
            'morocco tour package',
        ];
        $this->setSeo($title, $description, 'ContactPage', $keywords);
        return view('contact', [
            'title'       => $title,
            'description' => $description,
            'keywords'    => implode(', ', $keywords),
        ]);
    }

    public function terms()
    {
        $title       = 'Terms and Conditions | Morocco Quest';
        $description = 'Read the terms and conditions for booking morocco tours and morocco trip packages with Morocco Quest, including payment, cancellation and refund policies.';
        $keywords    = ['morocco quest', 'morocco tours terms', 'morocco tour booking conditions'];
        $this->setSeo($title, $description, 'TermsOfService', $keywords);
        return view('terms-and-conditions', [
            'title'       => $title,
            'description' => $description,
            'keywords'    => implode(', ', $keywords),
        ]);
    }

    public function cookie()
    {
        $title       = 'Cookie Policy | Morocco Quest';
        $description = 'Cookie Policy for Morocco Quest — how we use cookies when you browse our morocco tours and book travel packages.';
        $keywords    = ['morocco quest', 'cookie policy'];
        $this->setSeo($title, $description, 'WebPage', $keywords);
        return view('cookie-policy', [
            'title'       => $title,
            'description' => $description,
            'keywords'    => implode(', ', $keywords),
        ]);
    }

    public function privacy()
    {
        $title       = 'Privacy Policy | Morocco Quest';
        $description = 'Privacy Policy for Morocco Quest. Learn how we collect and protect your data when you browse and book morocco tours with us.';
        $keywords    = ['morocco quest', 'privacy policy'];
        $this->setSeo($title, $description, 'PrivacyPolicy', $keywords);
        return view('privacy-policy', [
            'title'       => $title,
            'description' => $description,
            'keywords'    => implode(', ', $keywords),
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
