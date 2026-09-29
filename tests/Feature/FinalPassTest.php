<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Blog;
use App\Models\Place;
use App\Models\Tag;
use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Final re-audit pass (2026-09-29): ItemList/TouristDestination/Service
 * schema, paginated canonicals, DB-driven sitemap categories, icon subset,
 * JS-error fixes that live in templates.
 */
class FinalPassTest extends TestCase
{
    use RefreshDatabase;

    private function makeTour(int $i): Tour
    {
        $t = new Tour();
        $t->forceFill(['title' => "Tour {$i}", 'slug' => "tour-{$i}", 'overview' => 'o', 'duration_days' => 3])->save();

        return $t;
    }

    private function jsonLdTypes(string $html): array
    {
        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $m);

        return collect($m[1])->map(fn ($j) => json_decode($j, true))
            ->each(fn ($j) => $this->assertNotNull($j, 'JSON-LD must parse'))
            ->all();
    }

    public function test_tour_listing_itemlist_matches_visible_cards_and_paginates(): void
    {
        foreach (range(1, 10) as $i) {
            $this->makeTour($i);
        }

        $page1 = $this->get('/tours')->assertOk()->getContent();
        $list = collect($this->jsonLdTypes($page1))->firstWhere('@type', 'ItemList');
        $this->assertSame(8, $list['numberOfItems']);
        foreach ($list['itemListElement'] as $item) {
            $this->assertStringContainsString('href="' . $item['url'] . '"', $page1, 'every ItemList URL is a visible link');
        }

        $page2 = $this->get('/tours?page=2')->assertOk()->getContent();
        $list2 = collect($this->jsonLdTypes($page2))->firstWhere('@type', 'ItemList');
        $this->assertSame(9, $list2['itemListElement'][0]['position'], 'page 2 positions continue after page 1');
        $this->assertStringContainsString('<link rel="canonical" href="' . url('/tours') . '?page=2"', $page2);
        $this->assertStringContainsString('– Page 2', $page2);
        $this->assertStringContainsString('<link rel="canonical" href="' . url('/tours') . '"', $page1);
    }

    public function test_destination_page_has_tourist_destination_and_breadcrumb_level(): void
    {
        $place = Place::create(['name' => 'Fez', 'slug' => 'fez']);
        $place->tours()->attach($this->makeTour(1)->id);

        $nodes = collect($this->jsonLdTypes($this->get('/destinations/fez')->assertOk()->getContent()));

        $dest = $nodes->firstWhere('@type', 'TouristDestination');
        $this->assertSame('Fez', $dest['name']);
        $crumb = $nodes->firstWhere('@type', 'BreadcrumbList');
        $this->assertSame('Destinations', $crumb['itemListElement'][1]['name']);
        $this->assertNotNull($nodes->firstWhere('@type', 'ItemList'));
    }

    public function test_dmc_hub_has_service_linked_to_the_organization(): void
    {
        $nodes = collect($this->jsonLdTypes($this->get('/dmc-marrakech')->assertOk()->getContent()));
        $service = $nodes->firstWhere('@type', 'Service');

        $this->assertNotNull($service);
        $this->assertStringEndsWith('#organization', $service['provider']['@id']);
        $this->assertNotEmpty($service['description']);
        $this->assertSame(1, $nodes->where('@type', 'TravelAgency')->count(), 'no duplicate organization');
    }

    public function test_paginated_tag_archive_is_self_canonical(): void
    {
        $tag = Tag::create(['name' => 'Desert']);
        foreach (range(1, 12) as $i) {
            Blog::create(['title' => "P{$i}", 'slug' => "p-{$i}", 'written_by' => 'M', 'summary' => 's', 'content' => 'c'])->tags()->attach($tag->id);
        }

        $html = $this->get('/tag/' . $tag->slug . '?page=2')->assertOk()->getContent();
        $this->assertStringContainsString('<link rel="canonical" href="' . url('/tag/' . $tag->slug) . '?page=2"', $html);
    }

    public function test_sitemap_lists_only_activity_categories_that_have_activities(): void
    {
        $full = ActivityCategory::create(['name' => 'Outdoor Activities']);
        ActivityCategory::create(['name' => 'Wellness Experiences']);
        $a = new Activity();
        $a->forceFill(['title' => 'Hike', 'slug' => 'hike', 'overview' => 'o', 'duration_days' => 1, 'activity_category_id' => $full->id])->save();

        $xml = $this->get('/sitemap.xml')->assertOk()->getContent();
        $this->assertStringContainsString('/activities/category/outdoor-activities</loc>', $xml);
        $this->assertStringNotContainsString('/activities/category/wellness-experiences</loc>', $xml);
    }

    public function test_bootstrap_icons_subset_is_served_and_covers_used_glyphs(): void
    {
        $html = $this->get('/about')->assertOk()->getContent();
        $this->assertStringContainsString('bootstrap-icons-subset.min.css', $html);
        $this->assertStringNotContainsString('bootstrap-icons/bootstrap-icons.min.css', $html);

        $css = file_get_contents(base_path('assets/plugins/bootstrap-icons/bootstrap-icons-subset.min.css'));
        $this->assertStringContainsString('.bi-whatsapp::before', $css);
        $this->assertFileExists(base_path('assets/plugins/bootstrap-icons/fonts/bootstrap-icons-subset.woff2'));
    }

    public function test_fallback_images_and_type_page_assets_are_local_and_exist(): void
    {
        $this->assertFileExists(base_path('assets/img/placeholder-image.webp'));

        $this->makeTour(1)->forceFill(['tour_type' => 'Garden Tour'])->save();
        $html = $this->get('/tours/type/garden-tours')->assertOk()->getContent();
        $this->assertStringNotContainsString('https://morocco-quest.com/assets/', $html);
    }

    public function test_360_page_no_longer_uses_an_invalid_css_selector(): void
    {
        $html = $this->get('/360-event-solutions')->assertOk()->getContent();
        $this->assertStringNotContainsString("document.querySelector('#360-enquiry", $html);
        $this->assertStringContainsString("getElementById('360-enquiry')", $html);
    }
}
