<?php

namespace App\Support;

use Artesaos\SEOTools\SEOMeta;

/**
 * SEOMeta that HTML-escapes the title and keywords at render time.
 *
 * Upstream artesaos/seotools only runs strip_tags() on these and then
 * interpolates them raw into <title> and <meta name="keywords" content="...">,
 * so any value containing a double quote breaks out of the attribute
 * (reflected XSS on /search?query= found 2026-09-28). The description is
 * already escaped upstream. Escaping here covers every controller that calls
 * setTitle()/addKeyword(), including values derived from request input or
 * admin-editable DB fields.
 *
 * double_encode=false keeps already-encoded entities (e.g. "&amp;") intact,
 * so the rendered text of existing titles is unchanged.
 */
class EscapedSEOMeta extends SEOMeta
{
    public function getTitle()
    {
        $title = parent::getTitle();

        return is_string($title) ? $this->escape($title) : $title;
    }

    public function getKeywords()
    {
        $keywords = parent::getKeywords();

        if ($keywords instanceof \Illuminate\Support\Collection) {
            $keywords = $keywords->toArray();
        }

        return array_map(
            fn ($keyword) => is_string($keyword) ? $this->escape($keyword) : $keyword,
            (array) $keywords
        );
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }
}
