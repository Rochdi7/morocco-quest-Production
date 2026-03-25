<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

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

        $recentBlogs = Blog::latest()->take(5)->get();
        $categories = Category::withCount('blogs')->orderBy('name')->get();
        $tags = Tag::all();

        $title = "Articles Tagged: {$tag->name} | Morocco Quest Travel Blog";

        $description = "Read blog posts related to \"{$tag->name}\" on Morocco Quest. Discover private tours morocco, small group tours morocco, and exclusive morocco travel experiences.";

        $url = url()->current();

        $keywords = array_filter([
            $tag->name,
            'morocco private tours',
            'private morocco tours',
            'private morocco tour',
            'private tours morocco',
            'private tour morocco',
            'small group tours morocco',
            'morocco small group tours',
            'exclusive morocco travel experiences',
            'vip morocco tours',
            'morocco luxury travel',
            'luxury travel morocco',
            'morocco travel insurance',
            'morocco travel agent',
            'what is the best time to travel to morocco',
            'morocco travel visa requirements',
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
