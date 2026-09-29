<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Place;
use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Contextual links added for the audit's internal-linking gaps (2026-09-28).
 */
class InternalLinkingTest extends TestCase
{
    use RefreshDatabase;

    private function makeActivity(ActivityCategory $category): Activity
    {
        $activity = new Activity();
        $activity->forceFill([
            'title' => 'Hot Air Balloon Ride', 'slug' => 'hot-air-balloon-ride',
            'overview' => 'Sunrise flight', 'duration_days' => 1,
            'activity_category_id' => $category->id,
        ])->save();

        return $activity;
    }

    public function test_destination_page_links_to_its_activities_and_has_own_h1(): void
    {
        $place = Place::create(['name' => 'Marrakech', 'slug' => 'marrakech']);
        $activity = $this->makeActivity(ActivityCategory::create(['name' => 'Outdoor Activities']));
        $place->activities()->attach($activity->id);

        $this->get('/destinations/marrakech')
            ->assertOk()
            ->assertSee('Tours in Marrakech, Morocco')
            ->assertSee('Things to do in Marrakech')
            ->assertSee(route('activities.show', 'hot-air-balloon-ride'), false);
    }

    public function test_activity_page_links_to_its_category_and_destination(): void
    {
        $category = ActivityCategory::create(['name' => 'Outdoor Activities']);
        $activity = $this->makeActivity($category);
        $activity->places()->attach(Place::create(['name' => 'Marrakech', 'slug' => 'marrakech'])->id);

        $this->get('/activities/' . $activity->slug)
            ->assertOk()
            ->assertSee(route('destinations.show', 'marrakech'), false)
            ->assertSee(route('activities.byCategory', $category->slug), false)
            ->assertSee('Outdoor Activities in Morocco');
    }

    public function test_tours_intro_no_longer_makes_false_claims(): void
    {
        $tour = new Tour();
        $tour->forceFill(['title' => 'T', 'slug' => 't', 'overview' => 'o', 'duration_days' => 3])->save();

        $html = $this->get('/tours')->assertOk()->getContent();

        $this->assertStringNotContainsString('Every tour in this collection departs from', $html);
        $this->assertStringNotContainsString('Prices are per person', $html);
        $this->assertStringContainsString('prices are quoted on request', $html);
        $this->assertStringContainsString('href="' . route('experiences.index') . '">day experience', $html);
    }

    public function test_header_links_tours_and_destinations_hubs(): void
    {
        $html = $this->get('/about')->assertOk()->getContent();

        $this->assertStringContainsString('href="' . route('tours.index') . '">All Morocco Tours', $html);
        $this->assertStringContainsString('href="' . route('destinations.index') . '">Destinations', $html);
        $this->assertStringNotContainsString('<a href="#">Info Hub</a>', $html);
    }
}
