<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use App\Support\SlugRedirector;
use App\Support\SeoHelper;

class TagController extends Controller
{
    /**
     * Display blog posts filtered by a specific tag.
     */
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->first();

        if (! $tag) {
            return SlugRedirector::redirectForPath('/tag/' . $slug) ?? abort(404);
        }

        $posts = $tag->blogs()
            ->with(['user', 'category'])
            ->latest()
            ->paginate(10);

        // An empty tag (or a page past the end) is a soft 404: it used to
        // return 200 "No posts found".
        if ($posts->isEmpty()) {
            abort(404);
        }

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

        $title = $tag->name . ' — Morocco Travel Guides & Tips | Morocco Quest Blog';

        $description = Str::limit('Articles tagged "' . $tag->name . '" on the Morocco Quest travel blog — guides, itineraries and travel tips.', 160, '');

        $url = url()->current();
        // Page 2+: self-canonical and distinct title (see SeoHelper::paginated).
        [$title, $url] = SeoHelper::paginated($title, $url);

        $keywordArray = array_filter([
            strtolower($tag->name),
            strtolower($tag->name) . ' morocco',
            'morocco travel blog',
            'morocco travel guide',
            'morocco travel tips',
            'morocco itinerary',
        ]);
        $keywords = implode(', ', array_unique($keywordArray));


        SEOMeta::setTitle($title, false);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);
        SEOMeta::addKeyword($keywordArray);

        // Tag archives are thin (67 tags for 16 posts, most holding one
        // post; audit 2026-09-28): keep them out of the index but let
        // crawlers follow through to the posts.
        SeoHelper::noindex();

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
            'tag',
            'title',
            'description',
            'keywords'
        ));
    }
}
