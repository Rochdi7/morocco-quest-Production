<?php

namespace Tests\Feature;

use App\Models\ActivityCategory;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Place;
use App\Models\Tag;
use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Regression tests for the P1 technical SEO fixes (audit 2026-09-28).
 */
class P1TechnicalSeoTest extends TestCase
{
    use RefreshDatabase;

    private function robotsTags(string $html): array
    {
        preg_match_all('/<meta name="robots"[^>]*content="([^"]*)"/', $html, $m);

        return $m[1];
    }

    private function makeBlog(string $slug = 'post-one'): Blog
    {
        return Blog::create([
            'title' => 'Post ' . $slug, 'slug' => $slug, 'written_by' => 'Mounir',
            'summary' => 'Summary', 'content' => '<p>Body</p>',
        ]);
    }

    private function makeTour(string $slug = 'tour-one'): Tour
    {
        $tour = new Tour();
        $tour->forceFill(['title' => 'Tour ' . $slug, 'slug' => $slug, 'overview' => 'Overview', 'duration_days' => 3])->save();

        return $tour;
    }

    // P1-1 ---------------------------------------------------------------

    public function test_noindex_pages_emit_a_single_robots_tag(): void
    {
        $robots = $this->robotsTags($this->get('/search?query=sahara')->getContent());

        $this->assertSame(['noindex,follow'], $robots);
    }

    public function test_indexable_pages_keep_index_follow(): void
    {
        $this->assertSame(['index,follow'], $this->robotsTags($this->get('/about')->getContent()));
    }

    // P1-2 / P1-7 ----------------------------------------------------------

    public function test_unknown_type_pages_are_real_404s_with_404_meta(): void
    {
        foreach (['/tours/type/nonexistent-type', '/activities/type/nonexistent-type', '/no-such-page'] as $url) {
            $response = $this->get($url);
            $response->assertNotFound();
            $html = $response->getContent();
            $this->assertStringContainsString('<title>Page Not Found (404)', $html, $url);
            $this->assertSame(['noindex,follow'], $this->robotsTags($html), $url);
        }
    }

    public function test_known_but_empty_type_stays_reachable_and_noindex(): void
    {
        $response = $this->get('/tours/type/garden-tours');

        $response->assertOk();
        $this->assertSame(['noindex,follow'], $this->robotsTags($response->getContent()));
    }

    public function test_legacy_type_aliases_redirect_permanently(): void
    {
        $this->get('/tours/type/multi-day-tours')->assertStatus(301)->assertRedirect(route('tours.multi_day'));
        $this->get('/tours/type/one-day-tours')->assertStatus(301)->assertRedirect(route('tours.one_day'));
    }

    // P1-4 ----------------------------------------------------------------

    public function test_sitemap_has_no_fake_lastmod_and_skips_empty_destinations(): void
    {
        $tour = $this->makeTour();
        $withTour = Place::create(['name' => 'Fez', 'slug' => 'fez']);
        $withTour->tours()->attach($tour->id);
        Place::create(['name' => 'Agadir', 'slug' => 'agadir']);

        $xml = $this->get('/sitemap.xml')->assertOk()->getContent();
        $doc = simplexml_load_string($xml);
        $this->assertNotFalse($doc, 'sitemap must be valid XML');

        $byLoc = [];
        foreach ($doc->url as $url) {
            $byLoc[(string) $url->loc] = isset($url->lastmod) ? (string) $url->lastmod : null;
        }
        $find = fn (string $path) => collect($byLoc)->filter(fn ($v, $k) => str_ends_with($k, $path))->keys()->first();

        $this->assertNotNull($find('/destinations/fez'));
        $this->assertNull($find('/destinations/agadir'), 'empty destination must not be in the sitemap');
        $this->assertNull($byLoc[$find('/about')], 'static pages must not claim a lastmod');
        $this->assertNotNull($byLoc[$find('/tours/tour-one')], 'tours keep their real updated_at');
    }

    // P1-5 ----------------------------------------------------------------

    public function test_tag_archives_are_noindex_and_named(): void
    {
        $tag = Tag::create(['name' => 'Agafay Desert']);
        $this->makeBlog()->tags()->attach($tag->id);

        $response = $this->get('/tag/' . $tag->slug)->assertOk();
        $this->assertSame(['noindex,follow'], $this->robotsTags($response->getContent()));
        $response->assertSee('Articles Tagged', false)->assertSee('Agafay Desert');
    }

    public function test_category_archives_stay_indexable_and_named(): void
    {
        $category = Category::create(['name' => 'Desert Tours']);
        $this->makeBlog()->categories()->attach($category->id);

        $response = $this->get('/category/' . $category->slug)->assertOk();
        $this->assertSame(['index,follow'], $this->robotsTags($response->getContent()));
        $response->assertSee('Desert Tours: Morocco Travel Articles');
    }

    public function test_empty_archives_are_404(): void
    {
        $tag = Tag::create(['name' => 'Empty Tag']);
        $category = Category::create(['name' => 'Empty Cat']);

        $this->get('/tag/' . $tag->slug)->assertNotFound();
        $this->get('/category/' . $category->slug)->assertNotFound();
    }

    // P1-6 / P1-10 ----------------------------------------------------------

    public static function socialPages(): array
    {
        return [['/about'], ['/dmc-marrakech'], ['/tours'], ['/cookie-policy']];
    }

    /**
     * One URL per test: SEOTools state is per-process singletons, and
     * production serves one request per process, so each case gets a
     * fresh application (as a real request would).
     *
     * @dataProvider socialPages
     */
    public function test_twitter_card_follows_the_page_and_no_og_twitter_tags(string $url): void
    {
        $html = $this->get($url)->assertOk()->getContent();
        preg_match('/<title>([^<]*)<\/title>/', $html, $t);
        preg_match('/<meta name="twitter:title" content="([^"]*)"/', $html, $tw);

        $this->assertStringNotContainsString('og:twitter:', $html);
        $this->assertSame(trim($t[1]), $tw[1] ?? null, 'twitter:title must match <title>');
        $this->assertStringNotContainsString('morocco-quest-social-share.webp', $html);
        $this->assertFileExists(base_path('assets/img/morocco-quest-og.webp'));
    }

    public function test_cookie_policy_has_one_canonical_and_starts_with_doctype(): void
    {
        $html = $this->get('/cookie-policy')->assertOk()->getContent();

        $this->assertStringStartsWith('<!DOCTYPE html>', ltrim($html));
        $this->assertSame(1, substr_count($html, 'rel="canonical"'));
        $this->assertSame(1, substr_count($html, 'property="og:image"'));
    }

    // P1-12 ----------------------------------------------------------------

    public function test_renaming_a_category_keeps_its_slug(): void
    {
        $category = Category::create(['name' => 'Desert Tours']);
        $category->update(['name' => 'Sahara Desert Tours']);

        $this->assertSame('desert-tours', $category->fresh()->slug);
    }

    public function test_renaming_an_activity_category_keeps_its_slug(): void
    {
        $cat = ActivityCategory::create(['name' => 'Day Trips']);
        $cat->update(['name' => 'Day Trips from Marrakech']);

        $this->assertSame('day-trips', $cat->fresh()->slug);
    }

    public function test_explicit_activity_category_slug_change_redirects_old_url(): void
    {
        $cat = ActivityCategory::create(['name' => 'Day Trips']);
        $cat->update(['slug' => 'day-trips-from-marrakech']);

        $this->get('/activities/category/day-trips')
            ->assertStatus(301)
            ->assertRedirect('/activities/category/day-trips-from-marrakech');
    }
}
