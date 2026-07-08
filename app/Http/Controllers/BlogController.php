<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use App\Support\SeoHelper;

class BlogController extends Controller
{
    /**
     * Sidebar data cached for 1h — categories/tags/recent blogs change infrequently.
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

        $sidebar     = $this->getSidebarData();
        $categories  = $sidebar['categories'];
        $tags        = $sidebar['tags'];
        $recentBlogs = $sidebar['recentBlogs'];

        $baseKeywords = [
            'morocco travel blog',
            'morocco tour guides',
            'morocco itineraries',
            'morocco day trips',
            'sahara desert tours morocco',
        ];

        $dynamicKeywords = array_filter(array_merge(
            $categories->pluck('name')->toArray(),
            $tags->pluck('name')->toArray()
        ));

        $keywordsArray = collect($baseKeywords)
            ->merge($dynamicKeywords)
            ->map(fn($k) => Str::of($k)->lower()->trim()->toString())
            ->unique()
            ->take(20)
            ->values()
            ->all();
        $keywords = implode(', ', $keywordsArray);

        $title       = 'Morocco Travel Blog | Tour Guides, Itineraries & Tips | Morocco Quest';
        $description = 'Morocco travel blog with itineraries, guides and tips. Plan your morocco tours, sahara desert tours from Marrakech, morocco day trips and morocco multi day tours.';

        SeoHelper::setCollection($title, $description, url()->current(), $keywordsArray);

        return view('blog', compact('posts', 'categories', 'tags', 'recentBlogs', 'title', 'description', 'keywords'));
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

        $title       = "Search results for \"{$query}\" | Morocco Travel Blog | Morocco Quest";
        $description = "Articles matching '{$query}'. Read morocco tour guides, itineraries and tips on sahara desert tours from Marrakech and morocco day trips.";
        $keywords    = "morocco travel blog, {$query}, morocco tours";

        // Search result pages must not be indexed — they are thin/duplicate content.
        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(route('blog.index'));
        SeoHelper::noindex();

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType('SearchResultsPage');

        return view('blog', array_merge(compact('posts', 'query', 'title', 'description', 'keywords'), $sidebarData));
    }

    /**
     * Display a Specific Blog Post with Comments.
     */
    public function show(string $slug)
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
        $nextPost     = Blog::where('id', '>', $post->id)->orderBy('id', 'asc')->first();

        $relatedPosts = Blog::where('id', '!=', $post->id)
            ->whereHas('categories', function ($q) use ($post) {
                $q->whereIn('categories.id', $post->categories->pluck('id'));
            })
            ->latest()
            ->take(3)
            ->get();

        $sidebarData = $this->getSidebarData();

        $description = $post->meta_description
            ?: Str::limit(strip_tags($post->summary ?? $post->content), 155);
        $image       = SeoHelper::ogImage($post->featured_image_url);
        $url         = url()->current();
        $tagKeywords = $post->tags->pluck('name')->toArray();

        $title = $post->seo_title
            ?: $post->title . ' | Morocco Travel Blog | Morocco Quest';

        $allKeywords = array_unique(array_filter(array_merge(
            [strtolower($post->title)],
            $tagKeywords,
            ['morocco travel blog', 'morocco tours', 'morocco day trips']
        )));
        $keywords = implode(', ', $allKeywords);

        SEOMeta::setTitle($title, false);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);
        SEOMeta::addKeyword($allKeywords);

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->setType('article')
            ->addImage($image);

        JsonLd::setType('BlogPosting')
            ->setTitle($title)
            ->setDescription($description)
            ->addImage($image)
            ->addValue('datePublished', $post->created_at->toIso8601String())
            ->addValue('dateModified', ($post->updated_at ?? $post->created_at)->toIso8601String())
            ->addValue('author', [
                '@type' => 'Person',
                'name'  => $post->user->name ?? 'Morocco Quest Team',
            ])
            ->addValue('publisher', [
                '@type' => 'Organization',
                'name'  => 'Morocco Quest',
                'url'   => url('/'),
                'logo'  => [
                    '@type' => 'ImageObject',
                    'url'   => asset('assets/img/logo-bg-wide.webp'),
                ],
            ])
            ->addValue('mainEntityOfPage', [
                '@type' => 'WebPage',
                '@id'   => $url,
            ])
            ->addValue('keywords', $keywords);

        return view('blog-details', array_merge([
            'post'         => $post,
            'previousPost' => $previousPost,
            'nextPost'     => $nextPost,
            'relatedPosts' => $relatedPosts,
            'title'        => $title,
            'description'  => $description,
            'keywords'     => $keywords,
        ], $sidebarData));
    }

    /**
     * Store a New Comment.
     */
    public function storeComment(Request $request, int $blogId)
    {
        $request->validate([
            'content' => 'required|string',
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
        ]);

        Comment::create([
            'blog_id'   => $blogId,
            'parent_id' => null,
            'name'      => $request->name,
            'email'     => $request->email,
            'content'   => $request->content,
        ]);

        return redirect()->back()->with('success', 'Your comment has been added successfully!');
    }

    /**
     * Store a Reply to a Comment.
     */
    public function replyToComment(Request $request, int $commentId)
    {
        $request->validate([
            'content' => 'required|string',
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
        ]);

        $parentComment = Comment::findOrFail($commentId);

        Comment::create([
            'blog_id'   => $parentComment->blog_id,
            'parent_id' => $parentComment->id,
            'name'      => $request->name,
            'email'     => $request->email,
            'content'   => $request->content,
        ]);

        return redirect()->back()->with('success', 'Reply added successfully.');
    }
}
