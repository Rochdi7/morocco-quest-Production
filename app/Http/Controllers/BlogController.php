<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Import Str facade
use Illuminate\Support\Facades\Storage; // Import Storage facade if using storeAs

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts (main blog page).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Fetch posts for the main listing page.
        $posts = Blog::with(['user', 'category', 'tags']) // Eager load common relationships
                     ->latest() // Order by newest first
                     ->paginate(10); // Get 10 posts per page

        // 2. Fetch data needed for the sidebar.
        $recentBlogs = Blog::latest()->take(5)->get();
        $categories = Category::withCount('blogs')->orderBy('name')->get();
        $tags = Tag::all(); // Get all tags for the sidebar list

        // 3. Return the main blog listing view ('blog.blade.php').
        return view('blog', compact(
            'posts',
            'recentBlogs',
            'categories',
            'tags'
        ));
    }

    /**
     * Store a newly created blog post in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request data.
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id', // Check if category exists
            'content' => 'required|string',
            'summary' => 'nullable|string|max:500',
            'quote' => 'nullable|string',
            'quote_author' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Allow common image types
            'tags' => 'nullable|array', // Tags input should be an array (e.g., from multi-select)
            'tags.*' => 'integer|exists:tags,id' // Validate each tag ID in the array
        ]);

        // 2. Prepare data for the new Blog model.
        $blogData = [
            'title' => $validatedData['title'],
            'slug' => Str::slug($validatedData['title']), // Generate slug
            'summary' => $validatedData['summary'] ?? null,
            'content' => $validatedData['content'], // Remember to sanitize this if it contains user HTML!
            'quote' => $validatedData['quote'] ?? null,
            'quote_author' => $validatedData['quote_author'] ?? null,
            'category_id' => $validatedData['category_id'],
            'user_id' => auth()->id(), // Assign the currently logged-in user
            'written_by' => auth()->user()->name, // Can store name for convenience, but user_id is key
        ];

        // 3. Handle the featured image upload if provided.
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            // Create a unique filename based on time and slug
            $filename = time() . '_' . Str::slug($validatedData['title']) . '.' . $file->getClientOriginalExtension();
            // Store the file in 'storage/app/public/images/blogs'
            // The 'public' disk makes it accessible via symlink
            $path = $file->storeAs('images/blogs', $filename, 'public');
            // Store the web-accessible path (requires 'php artisan storage:link')
            $blogData['featured_image'] = 'storage/' . $path; // Correct path for asset() helper
        }

        // 4. Create and save the new blog post.
        $blog = Blog::create($blogData); // Use create() with fillable fields

        // 5. Attach the selected tags (if any were provided).
        //    sync() handles adding/removing tags to match the provided array.
        if (!empty($validatedData['tags'])) {
            $blog->tags()->sync($validatedData['tags']);
        }

        // 6. Redirect back to the previous page with a success message.
        return redirect()->back()->with('success', 'Blog post created successfully!');
         // Or redirect to the new post:
         // return redirect()->route('blog.show', $blog->slug)->with('success', 'Blog post created successfully!');
    }

    /**
     * Display the specified blog post (details page).
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // 1. Find the blog post by its slug, eager loading relationships.
        //    OrFail() will automatically show a 404 page if not found.
        $blog = Blog::with([
                        'category',        // Load the category info
                        'tags',            // Load the tags SPECIFIC TO THIS POST
                        'user'             // Load the main author (User model) of the post
                    ])
                 ->where('slug', $slug)
                 ->firstOrFail();

        // 2. Get the previous and next blog posts based on ID (simple navigation).
        $previousBlog = Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
        $nextBlog = Blog::where('id', '>', $blog->id)->orderBy('id', 'asc')->first();

        // 3. Get data needed for the sidebar.
        $recentBlogs = Blog::where('id', '!=', $blog->id) // Exclude the current post
                         ->latest()
                         ->take(5)
                         ->get();
        $categories = Category::withCount('blogs')->orderBy('name')->get(); // Get categories with post counts
        $tags = Tag::all(); // *** CHANGE: Get ALL tags for the sidebar list ***
                           // This ensures all defined tags appear, even if not used on this post.

        // 4. Return the blog details view ('blog-details.blade.php').
        return view('blog-details', compact(
            'blog',          // The main blog post object (contains its specific tags in $blog->tags)
            'previousBlog',
            'nextBlog',
            'recentBlogs',   // For sidebar
            'categories',    // For sidebar
            'tags'           // ALL tags for sidebar list
        ));
    }

    /**
      * Display search results for blog posts.
      *
      * @param \Illuminate\Http\Request $request
      * @return \Illuminate\View\View
      */
    public function search(Request $request)
    {
        // 1. Get the search term from the request query string (e.g., /blog/search?query=test)
        $query = $request->input('query');

        // 2. Perform a basic search (you might want a more advanced search later).
        //    Search in title OR content.
        $posts = Blog::with(['user', 'category', 'tags']) // Load relationships
                    ->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('content', 'LIKE', "%{$query}%")
                    // You could also search tag names or category names with joins/whereHas
                    ->latest()
                    ->paginate(10); // Paginate results

        // 3. Fetch sidebar data (same as index/show).
        $recentBlogs = Blog::latest()->take(5)->get();
        $categories = Category::withCount('blogs')->orderBy('name')->get();
        $tags = Tag::all();

        // 4. Return the main blog listing view, passing the search results and query.
        return view('blog', compact(
            'posts',        // Paginated search results
            'recentBlogs',
            'categories',
            'tags',
            'query'         // Pass query back to show in search input/title
        ));
    }

} // End of BlogController class