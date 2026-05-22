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

        $title = $tag->name . ' | Morocco Travel Blog | Morocco Quest';

        $description = 'Articles about ' . $tag->name . '. Read morocco tour guides, sahara desert tours from Marrakech, morocco day trips and morocco multi day tour itineraries.';

        $url = url()->current();

        $keywordArray = array_filter([
            'morocco tours',
            'morocco travel blog',
            'morocco tour package',
            'private morocco tours',
            'sahara desert tours morocco',
            'morocco day tours',
            strtolower($tag->name),
        ]);
        $keywords = implode(', ', array_unique($keywordArray));


        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);
        SEOMeta::addKeyword($keywordArray);

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
