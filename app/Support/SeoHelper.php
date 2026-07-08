<?php

namespace App\Support;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Str;

class SeoHelper
{
    const FALLBACK_OG_IMAGE = 'assets/img/placeholder-image.webp';
    const BRAND = 'Morocco Quest DMC';

    /**
     * Resolve a safe OG image URL — never passes null downstream.
     */
    public static function ogImage(?string $imageUrl): string
    {
        return $imageUrl ?: asset(self::FALLBACK_OG_IMAGE);
    }

    /**
     * Wire up SEOMeta + OpenGraph + JsonLd in one call for listing/collection pages.
     * Listing pages always get CollectionPage schema type.
     */
    public static function setCollection(
        string $title,
        string $description,
        string $canonicalUrl,
        array $keywords = [],
        ?string $image = null
    ): void {
        $safeImage = self::ogImage($image);

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical($canonicalUrl)
            ->addKeyword($keywords);

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl($canonicalUrl)
            ->addImage($safeImage);

        OpenGraph::addProperty('twitter:card', 'summary_large_image');
        OpenGraph::addProperty('twitter:title', $title);
        OpenGraph::addProperty('twitter:description', $description);
        OpenGraph::addProperty('twitter:image', $safeImage);

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType('CollectionPage');
    }

    /**
     * Wire up SEOMeta + OpenGraph + JsonLd for single detail pages.
     * Detail pages use TouristTrip (or override via $type).
     */
    public static function setDetail(
        string $title,
        string $description,
        string $canonicalUrl,
        array $keywords = [],
        ?string $image = null,
        string $type = 'TouristTrip'
    ): void {
        $safeImage = self::ogImage($image);

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical($canonicalUrl)
            ->addKeyword($keywords);

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl($canonicalUrl)
            ->addImage($safeImage);

        OpenGraph::addProperty('twitter:card', 'summary_large_image');
        OpenGraph::addProperty('twitter:title', $title);
        OpenGraph::addProperty('twitter:description', $description);
        OpenGraph::addProperty('twitter:image', $safeImage);

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType($type)
            ->addImage($safeImage);
    }

    /**
     * Add noindex,follow directive — for thin filter/search result pages.
     * Tells Google not to index but still follow links.
     */
    public static function noindex(): void
    {
        SEOMeta::addMeta('robots', 'noindex,follow');
    }
}
