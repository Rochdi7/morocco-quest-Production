<?php

namespace App\Support;

use App\Models\Blog;
use App\Models\Tour;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/**
 * Topic-aware "plan your trip" links shown under every blog post
 * (crawl-architecture fix, 2026-10-24).
 *
 * Before this, every post carried the same B2C block (tours, multi-day,
 * experiences), so a corporate-incentive article linked consumer tours and
 * never its own service page. Google ranked that article (#9, 2026-09-28)
 * while /team-building-marrakech did not appear. Links are chosen from the
 * post's categories, tags and title, and every target is checked to exist.
 */
class BlogRelatedLinks
{
    /** @return array{intro: string, links: array<int, array{url: string, text: string}>} */
    public static function for(Blog $post): array
    {
        $topic = self::topic($post);

        if ($topic === 'mice') {
            return [
                'intro' => 'Planning a corporate programme in Morocco?',
                'links' => self::existing([
                    ['team-building.marrakech',          'team building and incentive programmes in Marrakech'],
                    ['dmc.marrakech',                    'our Morocco DMC services for agencies and planners'],
                    ['meetings-conventions.management',  'meetings and conventions management'],
                    ['contact.show',                     'request a proposal'],
                ]),
            ];
        }

        if ($topic === 'desert') {
            $links = [];
            $sahara = Tour::query()
                ->whereNotNull('slug')
                ->where(fn ($q) => $q->where('slug', 'LIKE', '%sahara%')->orWhere('slug', 'LIKE', '%desert%'))
                ->orderBy('id')
                ->first();
            if ($sahara && Route::has('tours.show')) {
                $links[] = ['url' => route('tours.show', $sahara->slug), 'text' => 'our private Sahara desert tour from Marrakech'];
            }

            return [
                'intro' => 'Ready to see the desert for yourself?',
                'links' => array_merge($links, self::existing([
                    ['tours.multi_day',    'multi-day Morocco tour packages'],
                    ['experiences.index',  'day experiences and things to do in Morocco'],
                    ['contact.show',       'contact our team for a tailor-made itinerary'],
                ])),
            ];
        }

        return [
            'intro' => 'Plan your Morocco trip:',
            'links' => self::existing([
                ['tours.index',        'private Morocco tours departing from Marrakech'],
                ['tours.multi_day',    'multi-day Morocco tour packages'],
                ['experiences.index',  'things to do in Morocco'],
                ['faq',                'read our FAQ'],
                ['contact.show',       'contact our team'],
            ]),
        ];
    }

    public static function topic(Blog $post): string
    {
        $haystack = Str::lower(implode(' ', array_filter([
            $post->title,
            $post->slug,
            $post->relationLoaded('categories') ? $post->categories->pluck('name')->implode(' ') : '',
            $post->relationLoaded('tags') ? $post->tags->pluck('name')->implode(' ') : '',
        ])));

        if (preg_match('/\b(incentive|mice|corporate|team.?building|congress|conference|event planning|events?\b|dmc|destination management|meetings?)\b/u', $haystack)) {
            return 'mice';
        }

        if (preg_match('/\b(sahara|desert|agafay|merzouga|erg chebbi|camp)s?\b/u', $haystack)) {
            return 'desert';
        }

        return 'general';
    }

    /** @param array<int, array{0: string, 1: string}> $pairs */
    private static function existing(array $pairs): array
    {
        $out = [];
        foreach ($pairs as [$route, $text]) {
            if (Route::has($route)) {
                $out[] = ['url' => route($route), 'text' => $text];
            }
        }

        return $out;
    }
}
