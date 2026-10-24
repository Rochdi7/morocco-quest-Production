<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Place;
use App\Models\Tag;
use App\Models\Tour;
use App\Support\BlogSidebar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Crawl-architecture fixes (2026-10-24): no template links to 404 tag
 * archives, a capped tag cloud, topic-aware blog cross-links, destination
 * pages that always list local activities, and /activities serving the
 * category hub canonicalised to /experiences.
 */
class CrawlArchitectureTest extends TestCase
{
    use RefreshDatabase;

    private function makeBlog(string $slug = 'post-one', ?string $title = null): Blog
    {
        return Blog::create([
            'title' => $title ?? 'Post '.$slug, 'slug' => $slug, 'written_by' => 'Mounir',
            'summary' => 'Summary', 'content' => '<p>Body</p>',
        ]);
    }

    private function makeActivity(string $title, string $slug, ActivityCategory $category): Activity
    {
        $activity = new Activity;
        $activity->forceFill([
            'title' => $title, 'slug' => $slug, 'overview' => 'Overview', 'duration_days' => 1,
            'activity_category_id' => $category->id,
        ])->save();

        return $activity;
    }

    public function test_sidebar_lists_only_tags_and_categories_that_have_posts(): void
    {
        $post = $this->makeBlog();
        $used = Tag::create(['name' => 'Sahara']);
        $empty = Tag::create(['name' => 'Agafay Desert']);
        $usedCat = Category::create(['name' => 'Desert Tours']);
        $emptyCat = Category::create(['name' => 'Space Events']);
        $post->tags()->attach($used->id);
        $post->categories()->attach($usedCat->id);

        foreach (['/blog', '/blog/post-one', '/tag/'.$used->slug, '/category/'.$usedCat->slug] as $url) {
            $html = $this->get($url)->assertOk()->getContent();
            $this->assertStringContainsString('/tag/'.$used->slug, $html, $url);
            $this->assertStringNotContainsString('/tag/'.$empty->slug, $html, $url.' links an empty (404) tag');
            $this->assertStringContainsString('/category/'.$usedCat->slug, $html, $url);
            $this->assertStringNotContainsString('/category/'.$emptyCat->slug, $html, $url.' links an empty (404) category');
        }
    }

    public function test_sidebar_tag_cloud_is_capped_but_every_tag_stays_reachable_from_its_post(): void
    {
        $post = $this->makeBlog();
        $tags = collect(range(1, BlogSidebar::TAG_LIMIT + 5))
            ->map(fn ($i) => Tag::create(['name' => 'Tag '.str_pad((string) $i, 2, '0', STR_PAD_LEFT)]));
        $post->tags()->attach($tags->pluck('id'));

        $sidebar = BlogSidebar::data();
        $this->assertCount(BlogSidebar::TAG_LIMIT, $sidebar['tags']);

        // The post footer still links all of the post's own tags.
        $html = $this->get('/blog/post-one')->assertOk()->getContent();
        foreach ($tags as $tag) {
            $this->assertStringContainsString('/tag/'.$tag->slug.'"', $html);
        }
    }

    public function test_mice_post_links_its_service_pages_instead_of_consumer_tours(): void
    {
        $post = $this->makeBlog('incentive-trips-in-marrakech', 'Incentive Trips in Marrakech & Agafay');
        $post->categories()->attach(Category::create(['name' => 'MICE & Corporate'])->id);

        $this->get('/blog/incentive-trips-in-marrakech')
            ->assertOk()
            ->assertSee(route('team-building.marrakech'), false)
            ->assertSee(route('dmc.marrakech'), false)
            ->assertSee(route('meetings-conventions.management'), false)
            ->assertDontSee('private Morocco tours departing from Marrakech');
    }

    public function test_desert_post_links_the_sahara_tour_and_general_posts_keep_the_b2c_block(): void
    {
        $tour = new Tour;
        $tour->forceFill(['title' => 'Sahara Tour', 'slug' => '5-day-marrakech-sahara-tour', 'overview' => 'O', 'duration_days' => 5])->save();

        $this->makeBlog('luxury-sahara-desert-tour', 'Luxury Sahara Desert Tour');
        $this->get('/blog/luxury-sahara-desert-tour')
            ->assertOk()
            ->assertSee(route('tours.show', $tour->slug), false)
            ->assertSee('Ready to see the desert');

        $this->makeBlog('craft-holidays', 'Craft Holidays in Morocco');
        $this->get('/blog/craft-holidays')
            ->assertOk()
            ->assertSee('Plan your Morocco trip')
            ->assertSee(route('tours.index'), false);
    }

    public function test_destination_page_falls_back_to_activities_named_after_the_place(): void
    {
        Place::create(['name' => 'Fez', 'slug' => 'fez']);
        $cat = ActivityCategory::create(['name' => 'City Tours']);
        $this->makeActivity('Fes Full-Day City Tour', 'fes-full-day-city-tour', $cat);
        $this->makeActivity('Casablanca Half-Day Tour', 'casablanca-half-day', $cat);

        // No activity_place rows at all, as on production.
        $this->get('/destinations/fez')
            ->assertOk()
            ->assertSee('Things to do in Fez')
            ->assertSee('/activities/fes-full-day-city-tour', false)
            ->assertDontSee('/activities/casablanca-half-day');
    }

    public function test_activities_index_serves_the_category_hub_canonicalised_to_experiences(): void
    {
        ActivityCategory::create(['name' => 'Day Trips']);

        $response = $this->get('/activities')->assertOk();
        $response->assertDontSee('No activity categories found');
        $response->assertSee('Day Trips');
        $this->assertStringContainsString(
            '<link rel="canonical" href="'.route('experiences.index').'"',
            $response->getContent()
        );

        $this->assertStringNotContainsString('<loc>'.route('activities.index').'</loc>', $this->get('/sitemap.xml')->getContent());
    }
}
