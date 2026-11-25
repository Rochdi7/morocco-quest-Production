<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

/**
 * /dmc-marrakech (EN) and /fr/dmc-marrakech (FR).
 *
 * Primary keyword "dmc marrakech". Baseline, Google Morocco desktop,
 * non-personalised, 2026-11-24: positions #15 / #18 / #15 across three
 * checks (page 2). Research and spec: docs/seo/dmc-marrakech-benchmarking/
 * (reports 12–18; implementation in 21).
 *
 * Copy lives in resources/content/dmc-marrakech/{en,fr}.php so both language
 * versions share one template and stay structurally identical.
 */
class DmcController extends Controller
{
    /** Pages that exist in both languages, used for hreflang. */
    private const ALTERNATES = [
        'en' => 'dmc.marrakech',
        'fr' => 'dmc.marrakech.fr',
    ];

    public function index(): View
    {
        return $this->render('en', [
            'dmc marrakech',
            'marrakech dmc',
            'morocco dmc',
            'dmc morocco',
            'destination management company marrakech',
            'destination management company morocco',
            'mice marrakech',
            'incentive travel marrakech',
            'corporate events marrakech',
            'team building marrakech',
            'ground handler morocco',
        ]);
    }

    public function indexFr(): View
    {
        return $this->render('fr', [
            'dmc marrakech',
            'agence réceptive marrakech',
            'dmc maroc',
            'séminaire marrakech',
            'organisation événements marrakech',
            'voyages incentive maroc',
            'team building marrakech',
            'agence mice marrakech',
        ]);
    }

    private function render(string $locale, array $keywords): View
    {
        app()->setLocale($locale);

        $c   = require resource_path("content/dmc-marrakech/{$locale}.php");
        $url = route(self::ALTERNATES[$locale]);
        $og  = asset('assets/img/dmc-marrakech/og-dmc-marrakech-morocco-quest-1200x630.jpg');

        SEOMeta::setTitle($c['meta']['title'], false)
            ->setDescription($c['meta']['description'])
            ->setCanonical($url)
            ->addKeyword($keywords);

        foreach (self::ALTERNATES as $lang => $routeName) {
            SEOMeta::addAlternateLanguage($lang, route($routeName));
        }
        SEOMeta::addAlternateLanguage('x-default', route(self::ALTERNATES['en']));

        OpenGraph::setTitle($c['meta']['title'])
            ->setDescription($c['meta']['description'])
            ->setUrl($url)
            ->setType('website')
            ->setSiteName('Morocco Quest')
            ->addProperty('locale', $c['og_locale'])
            ->addProperty('locale:alternate', $locale === 'en' ? 'fr_FR' : 'en_GB')
            ->addImage($og, ['width' => 1200, 'height' => 630, 'alt' => $c['meta']['og_image_alt']]);

        OpenGraph::addProperty('twitter:card', 'summary_large_image');
        OpenGraph::addProperty('twitter:title', $c['meta']['title']);
        OpenGraph::addProperty('twitter:description', $c['meta']['description']);
        OpenGraph::addProperty('twitter:image', $og);

        $alternateUrls = array_map(fn ($r) => route($r), self::ALTERNATES);

        return view('dmc-marrakech', [
            'c'             => $c,
            'locale'        => $locale,
            'pageUrl'       => $url,
            'alternateUrls' => $alternateUrls,
            'ogImage'       => $og,
            // Fallbacks for layouts that read these sections.
            'title'         => $c['meta']['title'],
            'description'   => $c['meta']['description'],
            'keywords'      => $keywords,
        ]);
    }
}
