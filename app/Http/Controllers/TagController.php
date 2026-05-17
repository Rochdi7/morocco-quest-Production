<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class TagController extends Controller
{
    /**
     * Display blog posts filtered by a specific tag.
     */
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $posts = $tag->blogs()
            ->with(['user', 'category'])
            ->latest()
            ->paginate(10);

        // Same sidebar cache key as CategoryController + BlogController.
        // Shared across all blog/category/tag pages; auto-expires after 1h.
        $sidebar = Cache::remember('blog_sidebar_v1', 3600, function () {
            return [
                'recentBlogs' => Blog::latest()->take(5)->get(),
                'categories'  => Category::withCount('blogs')->orderBy('name')->get(),
                'tags'        => Tag::orderBy('name')->get(),
            ];
        });
        $recentBlogs = $sidebar['recentBlogs'];
        $categories  = $sidebar['categories'];
        $tags        = $sidebar['tags'];

        $title = 'Posts tagged: '.$tag->name.' | Morocco Quest';

        $description = 'Articles tagged '.$tag->name.' on best morocco itinerary, marrakech desert tours, and morocco private tours.';

        $url = url()->current();

        $keywords = array_filter([
            'best morocco itinerary',
            'marrakech desert tours',
            'morocco private tours',
            'sahara desert tour from marrakech',
            strtolower($tag->name),
        ]);


        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);
        SEOMeta::addKeyword($keywords);

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl($url);

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType('CollectionPage');

        return view('blog', compact(
            'posts',
            'recentBlogs',
            'categories',
            'tags',
            'tag'
        ));
    }
}
