<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\ItineraryDay;
use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * JSON-LD must be valid schema.org and must not contradict visible content
 * (audit 2026-09-28, "31 schema errors").
 */
class StructuredDataTest extends TestCase
{
    use RefreshDatabase;

    /** @return array<int, array> every JSON-LD node on the page */
    private function nodes(string $html): array
    {
        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $m);
        $nodes = [];
        foreach ($m[1] as $raw) {
            $json = json_decode($raw, true);
            $this->assertNotNull($json, 'JSON-LD must parse: ' . json_last_error_msg());
            foreach (isset($json['@graph']) ? $json['@graph'] : [$json] as $node) {
                $nodes[] = $node;
            }
        }

        return $nodes;
    }

    private function nodeOfType(array $nodes, string $type): ?array
    {
        return collect($nodes)->first(fn ($n) => ($n['@type'] ?? null) === $type);
    }

    public function test_tour_trip_has_itinerary_no_duration_no_hidden_price(): void
    {
        $tour = new Tour();
        $tour->forceFill([
            'title' => 'Sahara &amp; Atlas', 'slug' => 'sahara-atlas-3-days', 'overview' => '<p>Desert&nbsp;trip &amp; more</p>',
            'duration_days' => 3, 'price_adult' => 786,
        ])->save();
        foreach ([1 => 'Marrakech to Dades', 2 => 'Merzouga camp'] as $n => $title) {
            ItineraryDay::create(['itineraryable_id' => $tour->id, 'itineraryable_type' => Tour::class, 'day_number' => $n, 'title' => $title, 'description' => 'x']);
        }

        $nodes = $this->nodes($this->get('/tours/' . $tour->slug)->assertOk()->getContent());
        $trip = $this->nodeOfType($nodes, 'TouristTrip');

        $this->assertNotNull($trip);
        $this->assertArrayNotHasKey('duration', $trip);
        $this->assertArrayNotHasKey('offers', $trip, 'page shows "Price On Request"');
        $this->assertSame('ItemList', $trip['itinerary']['@type']);
        $this->assertSame('Day 2: Merzouga camp', $trip['itinerary']['itemListElement'][1]['name']);
        $this->assertStringNotContainsString('&amp;', $trip['description']);
        $this->assertStringNotContainsString('&nbsp;', $trip['description']);

        $crumb = $this->nodeOfType($nodes, 'BreadcrumbList');
        $this->assertSame('Morocco Tours', $crumb['itemListElement'][1]['name']);
    }

    public function test_blog_posting_uses_featured_image_and_org_publisher(): void
    {
        $blog = Blog::create([
            'title' => 'Agafay vs Sahara', 'slug' => 'agafay-vs-sahara', 'written_by' => 'Mounir',
            'summary' => 'Which desert?', 'content' => '<p>Body</p>', 'featured_image' => 'blogs/agafay.webp',
        ]);

        $post = $this->nodeOfType($this->nodes($this->get('/blog/' . $blog->slug)->assertOk()->getContent()), 'BlogPosting');

        $this->assertStringContainsString('agafay.webp', $post['image']);
        $this->assertStringEndsWith('#organization', $post['publisher']['@id']);
        $this->assertLessThanOrEqual(110, mb_strlen($post['headline']));
    }

    public function test_site_search_action_uses_the_real_query_parameter(): void
    {
        $site = $this->nodeOfType($this->nodes($this->get('/about')->getContent()), 'WebSite');

        $this->assertStringContainsString('/search?query={search_term_string}', $site['potentialAction']['target']);
    }

    public function test_travel_agency_has_full_visible_address(): void
    {
        $org = $this->nodeOfType($this->nodes($this->get('/about')->getContent()), 'TravelAgency');

        $this->assertSame('Khalid Ibn Al Walid Street, Gueliz', $org['address']['streetAddress']);
        $this->assertSame('40000', $org['address']['postalCode']);
        $this->assertSame('sales@morocco-quest.com', $org['email']);
    }

    public function test_blog_post_body_h1s_are_demoted_to_keep_one_h1(): void
    {
        $blog = Blog::create([
            'title' => 'Incentive Trips', 'slug' => 'incentive-trips', 'written_by' => 'Mounir',
            'summary' => 's', 'content' => '<h1>Section A</h1><p>x</p><h1 class="big">Section B</h1>',
        ]);

        $html = $this->get('/blog/' . $blog->slug)->assertOk()->getContent();

        $this->assertSame(1, preg_match_all('/<h1[\s>]/i', $html));
        $this->assertStringContainsString('<h2>Section A</h2>', $html);
        $this->assertStringContainsString('<h2 class="big">Section B</h2>', $html);
    }

    public function test_tour_map_iframe_is_lazy_loaded(): void
    {
        $tour = new Tour();
        $tour->forceFill([
            'title' => 'Map Tour', 'slug' => 'map-tour', 'overview' => 'o', 'duration_days' => 2,
            'map_embed_code' => '<iframe src="https://www.google.com/maps/embed?pb=x" width="600"></iframe>',
        ])->save();

        $this->get('/tours/map-tour')->assertOk()->assertSee('<iframe loading="lazy" src="https://www.google.com/maps/embed?pb=x"', false);
    }
}
