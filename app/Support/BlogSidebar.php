<?php

namespace App\Support;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

/**
 * Shared sidebar data for the blog index, single posts, category and tag
 * archives (crawl-architecture fix, 2026-10-24).
 *
 * Why this exists: the three controllers each built the same sidebar with
 * `Tag::orderBy('name')->get()`. Since empty archives return 404
 * (2026-09-29), that list linked seven dead tag URLs from every blog-family
 * page (~770 internal 404 links in the 2026-10-14 crawl). The full tag cloud
 * also put ~60 links to noindex archives on each of ~110 pages.
 *
 * Rules:
 *  - only categories and tags that have at least one post are listed;
 *  - `tags` holds the TAG_LIMIT most-used tags for meta keywords only; since
 *    2026-10-30 no template links tag archives (they are noindex and were a
 *    third of the crawl), post footers show tags as plain labels;
 *  - categories are listed in full (they are indexable archives).
 */
class BlogSidebar
{
    public const CACHE_KEY = 'blog_sidebar_v2';

    public const TTL = 3600;

    public const TAG_LIMIT = 20;

    /** @return array{recentBlogs: \Illuminate\Support\Collection, categories: \Illuminate\Support\Collection, tags: \Illuminate\Support\Collection} */
    public static function data(): array
    {
        return Cache::remember(self::CACHE_KEY, self::TTL, function () {
            return [
                'recentBlogs' => Blog::latest()->take(5)->get(),
                'categories' => Category::has('blogs')
                    ->withCount('blogs')
                    ->orderBy('name')
                    ->get(),
                'tags' => Tag::has('blogs')
                    ->withCount('blogs')
                    ->orderByDesc('blogs_count')
                    ->orderBy('name')
                    ->take(self::TAG_LIMIT)
                    ->get(),
            ];
        });
    }

    public static function forget(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
