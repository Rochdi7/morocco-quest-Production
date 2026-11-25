<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * /dmc-marrakech (EN) and /fr/dmc-marrakech (FR): language pair, canonical,
 * hreflang reciprocity and structured-data rules from
 * docs/seo/dmc-marrakech-benchmarking/21-implementation-report.md.
 */
class DmcMarrakechPageTest extends TestCase
{
    use RefreshDatabase;

    public static function pages(): array
    {
        return [
            'en' => ['/dmc-marrakech', 'en', 'DMC Marrakech:'],
            'fr' => ['/fr/dmc-marrakech', 'fr', 'DMC Marrakech :'],
        ];
    }

    #[DataProvider('pages')]
    public function test_page_language_canonical_and_h1(string $path, string $lang, string $h1Start): void
    {
        $html = $this->get($path)->assertOk()->getContent();

        $this->assertStringContainsString('<html class="no-js" lang="' . $lang . '"', $html);
        $this->assertSame(1, substr_count($html, 'rel="canonical"'));
        $this->assertStringContainsString('<link rel="canonical" href="' . url($path) . '"', $html);
        $this->assertSame(1, preg_match_all('/<h1[\s>]/', $html));
        $this->assertMatchesRegularExpression('/<h1[^>]*>\s*' . preg_quote($h1Start, '/') . '/', $html);
        $this->assertStringNotContainsString('noindex', $html);
    }

    #[DataProvider('pages')]
    public function test_hreflang_pair_is_reciprocal(string $path): void
    {
        $html = $this->get($path)->assertOk()->getContent();

        $this->assertStringContainsString('hreflang="en" href="' . url('/dmc-marrakech') . '"', $html);
        $this->assertStringContainsString('hreflang="fr" href="' . url('/fr/dmc-marrakech') . '"', $html);
        $this->assertStringContainsString('hreflang="x-default" href="' . url('/dmc-marrakech') . '"', $html);
    }

    #[DataProvider('pages')]
    public function test_structured_data_is_valid_and_has_no_faq_or_rating_markup(string $path): void
    {
        $html = $this->get($path)->assertOk()->getContent();
        preg_match_all('#<script type="application/ld\+json">(.*?)</script>#s', $html, $m);

        $types = [];
        foreach ($m[1] as $json) {
            $data = json_decode($json, true);
            $this->assertIsArray($data, 'invalid JSON-LD block');
            foreach (($data['@graph'] ?? [$data]) as $node) {
                $types[] = $node['@type'] ?? null;
            }
        }

        $this->assertContains('WebPage', $types);
        $this->assertContains('Service', $types);
        $this->assertContains('BreadcrumbList', $types);
        $this->assertNotContains('FAQPage', $types, 'FAQ rich results are not available to this site type');
        $this->assertStringNotContainsString('AggregateRating', $html);
    }

    public function test_french_page_is_in_the_sitemap(): void
    {
        // The sitemap rewrites hosts to config('app.url'); match on the path.
        $xml = $this->get('/sitemap.xml')->assertOk()->getContent();
        $this->assertStringContainsString('/fr/dmc-marrakech</loc>', $xml);
    }
}
