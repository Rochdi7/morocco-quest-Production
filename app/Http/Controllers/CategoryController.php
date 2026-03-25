<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->blogs()
            ->with(['user', 'category'])
            ->latest()
            ->paginate(10);

        $recentBlogs = \App\Models\Blog::latest()->take(5)->get();
        $categories = \App\Models\Category::withCount('blogs')->get();
        $tags = \App\Models\Tag::all();

        $title = "{$category->name} - Private Morocco Tours & Exclusive Experiences | Morocco Quest";

        $description = "Explore {$category->name} with Morocco Quest. We offer private tours morocco, small group tours morocco, vip morocco tours, and exclusive experiences.";

        $url = url()->current();

        $keywords = array_filter([
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
            Str::slug($category->name),
        ]);


        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical($url)
            ->addKeyword($keywords);

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->addProperty('type', 'article');

        OpenGraph::addProperty('twitter:card', 'summary');
        OpenGraph::addProperty('twitter:title', $title);
        OpenGraph::addProperty('twitter:description', $description);

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType('CollectionPage')
            ->setUrl($url);

        return view('blog', compact(
            'posts',
            'recentBlogs',
            'categories',
            'tags',
            'category'
        ));
    }
}
