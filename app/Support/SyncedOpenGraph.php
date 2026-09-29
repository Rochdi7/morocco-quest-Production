<?php

namespace App\Support;

use Artesaos\SEOTools\OpenGraph;

/**
 * OpenGraph that keeps the Twitter card in step with it.
 *
 * Controllers historically called OpenGraph::addProperty('twitter:title', …),
 * which rendered invalid <meta property="og:twitter:title"> tags while the
 * real twitter:* tags kept the homepage defaults on every page (audit
 * 2026-09-28). Here:
 *  - any 'twitter:*' property is routed to the Twitter card instead of OG;
 *  - the OG title, description and image also become the Twitter card's
 *    values by default (an explicit 'twitter:*' call still wins if it comes
 *    later, which is the order every controller uses).
 */
class SyncedOpenGraph extends OpenGraph
{
    public function addProperty($key, $value)
    {
        if (is_string($key) && str_starts_with($key, 'twitter:')) {
            $this->twitter()->addValue(substr($key, strlen('twitter:')), $value);

            return $this;
        }

        if ($key === 'title' || $key === 'description') {
            $this->twitter()->addValue($key, $value);
        }

        return parent::addProperty($key, $value);
    }

    public function addImage($source = null, $attributes = [])
    {
        if (is_string($source) && $source !== '') {
            $this->twitter()->addValue('image', $source);
        }

        return parent::addImage($source, $attributes);
    }

    private function twitter()
    {
        return app('seotools.twitter');
    }
}
