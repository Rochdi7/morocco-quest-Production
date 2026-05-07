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

        $title = $category->name.' | Best Morocco Itinerary - Morocco Quest';

        $description = $category->name.' articles on best morocco itinerary, marrakech desert tours, and morocco private tours.';

        $url = url()->current();

        $keywords = array_filter([
            'best morocco itinerary',
            'marrakech desert tours',
            'morocco private tours',
            'sahara desert tour from marrakech',
            strtolower($category->name),
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
