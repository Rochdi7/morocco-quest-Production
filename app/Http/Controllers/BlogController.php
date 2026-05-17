<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class BlogController extends Controller
{
    /**
     * Get Sidebar Data for Blog Pages.
     * Cached for 1h since categories/tags/recent-blogs change infrequently.
     * Same cache key is shared with CategoryController + TagController so a
     * single warm cache serves all blog/category/tag URLs.
     *
     * Note: the index() method below historically used a slightly different
     * categories query (`Category::with('blogs')->whereHas('blogs')`) than
     * this sidebar helper. The cached version below matches the index()
     * query so the sidebar looks identical to the previous /blog page.
     */
    private function getSidebarData()
    {
        return Cache::remember('blog_sidebar_v1', 3600, function () {
            return [
                'recentBlogs' => Blog::latest()->take(5)->get(),
                'categories'  => Category::withCount('blogs')->orderBy('name')->get(),
                'tags'        => Tag::orderBy('name')->get(),
            ];
        });
    }


    /**
     * Display the Blog Index Page.
     */
    public function index()
    {
        $posts = Blog::latest()->paginate(6);

        $sidebar    = $this->getSidebarData();
        $categories = $sidebar['categories'];
        $tags       = $sidebar['tags'];
        $recentBlogs = $sidebar['recentBlogs'];

        // Build SEO keywords (base + dynamic from categories/tags)
        $baseKeywords = [
            'best morocco itinerary',
            'morocco itinerary one week',
            'best 7 day morocco itinerary',
            'morocco 14 day itinerary',
            'marrakech desert tour 3 days',
            'marrakech desert tours 4 days',
            'luxury sahara desert tour from marrakech',
            'marrakech desert tours',
            'sahara desert tour from marrakech',
            'morocco private tours',
            'private morocco tours',
            'private tours in morocco',
            'private tour morocco',
            'luxury desert tours marrakech',
            'desert tour from marrakech',
        ];

        $dynamicKeywords = array_filter(array_merge(
            $categories->pluck('name')->toArray(),
            $tags->pluck('name')->toArray()
        ));

        // Normalize, de-duplicate, and cap list length
        $keywords = collect($baseKeywords)
            ->merge($dynamicKeywords)
            ->map(fn($k) => Str::of($k)->lower()->trim()->toString())
            ->unique()
            ->take(40) // Increased limit to accommodate new keywords
            ->values()
            ->all();

        // 🔥 SEO Meta for Blog Homepage
        SEOMeta::setTitle('Best Morocco Itinerary & Travel Blog | Morocco Quest')
            ->setDescription('Best morocco itinerary, morocco itinerary one week, best 7 day morocco itinerary, morocco 14 day itinerary, marrakech desert tour 3 days, and luxury desert tours marrakech.')
            ->setCanonical(url()->current())
            ->addKeyword($keywords);

        OpenGraph::setTitle('Best Morocco Itinerary & Travel Blog | Morocco Quest')
            ->setDescription('Expert guides on best morocco itinerary, marrakech desert tours, and morocco private tours. Plan your perfect private tour morocco with our travel insights.')
            ->setUrl(url()->current());

        JsonLd::setTitle('Best Morocco Itinerary & Travel Blog')
            ->setDescription('Your guide to best morocco itinerary, marrakech desert tours, and sahara desert tour from marrakech.')
            ->setType('Blog');

        return view('blog', compact('posts', 'categories', 'tags', 'recentBlogs'));
    }



    /**
     * Search Blog Posts.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return redirect()->route('blog.index');
        }

        $posts = Blog::with(['user', 'categories', 'tags'])
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('content', 'LIKE', "%{$query}%")
                    ->orWhere('summary', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->paginate(10)
            ->appends(['query' => $query]);

        $sidebarData = $this->getSidebarData();

        // 🔥 SEO for Blog Search
        $title = "Search results for \"{$query}\" | Morocco Travel Blog";
        $description = "Find articles matching '{$query}' on Morocco Quest. Learn more about morocco private tours, marrakech desert tours, and sahara desert tour from marrakech.";

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType('SearchResultsPage');

        return view('blog', compact('posts', 'query'), $sidebarData);
    }


    /**
     * Display a Specific Blog Post with Comments.
     */
    public function show($slug)
    {
        $post = Blog::with([
            'categories',
            'tags',
            'user',
            'comments.replies'
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        $previousPost = Blog::where('id', '<', $post->id)->orderBy('id', 'desc')->first();
        $nextPost = Blog::where('id', '>', $post->id)->orderBy('id', 'asc')->first();

        $relatedPosts = Blog::where('id', '!=', $post->id)
            ->whereHas('categories', function ($q) use ($post) {
                $q->whereIn('categories.id', $post->categories->pluck('id'));
            })
            ->latest()
            ->take(3)
            ->get();

        $sidebarData = $this->getSidebarData();

        // ✅ SEO Meta
        $description = Str::limit(strip_tags($post->summary ?? $post->content), 140) . ' Best morocco itinerary, marrakech desert tours, morocco private tours.';
        $image = $post->featured_image ?? asset('images/default-blog.jpg');
        $url = url()->current();
        $keywords = $post->tags->pluck('name')->toArray();

        // Merge commercial keywords with post-specific keywords
        $commercialKeywords = [
            'best morocco itinerary',
            'morocco itinerary one week',
            'best 7 day morocco itinerary',
            'morocco 14 day itinerary',
            'marrakech desert tours',
            'sahara desert tour from marrakech',
            'luxury desert tours marrakech',
            'morocco private tours',
            'private morocco tours',
            'private tours in morocco',
            'private tour morocco',
            'marrakech desert tour 3 days',
            'desert tour from marrakech',
        ];

        $allKeywords = array_merge([strtolower($post->title)], $keywords, $commercialKeywords);

        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);
        SEOMeta::addKeyword($allKeywords);

        OpenGraph::setTitle($post->title)
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image);

        JsonLd::setType('BlogPosting')
            ->setTitle($post->title)
            ->setDescription($description)
            ->addImage($image)
            ->addValue('datePublished', $post->created_at->toIso8601String())
            ->addValue('author', [
                '@type' => 'Person',
                'name' => $post->user->name ?? 'Morocco Quest Team'
            ])
            ->addValue('keywords', implode(', ', $allKeywords));


        return view('blog-details', array_merge([
            'post' => $post,
            'previousPost' => $previousPost,
            'nextPost' => $nextPost,
            'relatedPosts' => $relatedPosts
        ], $sidebarData));
    }



    /**
     * Store a New Comment.
     */
    public function storeComment(Request $request, $blogId)
    {
        $request->validate([
            'content' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        Comment::create([
            'blog_id' => $blogId,
            'parent_id' => null, // Root comment
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Your comment has been added successfully!');
    }

    /**
     * Store a Reply to a Comment.
     */
    public function replyToComment(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $parentComment = Comment::findOrFail($commentId);

        Comment::create([
            'blog_id' => $parentComment->blog_id,
            'parent_id' => $parentComment->id,
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Reply added successfully.');
    }
}
