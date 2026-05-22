@extends('layouts.app2')

@section('title', $title ?? (isset($tag) ? $tag->name.' | Morocco Travel Blog | Morocco Quest' : (isset($category) ? $category->name.' | Morocco Travel Blog | Morocco Quest' : (request('query') ? 'Search "'.request('query').'" | Morocco Travel Blog | Morocco Quest' : 'Morocco Travel Blog | Tour Guides, Itineraries & Tips | Morocco Quest'))))
@section('description', $description ?? (isset($tag) ? 'Articles about '.$tag->name.'. Read morocco tour guides, sahara desert tours from Marrakech and morocco day trips.' : (isset($category) ? 'Latest articles on '.$category->name.'. Morocco tour guides, itineraries and travel tips.' : 'Morocco travel blog with itineraries, guides and tips. Plan morocco tours, sahara desert tours from Marrakech and morocco day trips.')))
@section('keywords', $keywords ?? 'morocco tours, morocco travel blog, morocco tour package, private morocco tours, sahara desert tours morocco, morocco day tours, morocco multi day tours')


@section('content')

    {{-- Breadcrumb Section --}}
    <section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/chefchaouen-blue-house-door-morocco-blog-hero.webp') }}">
        <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="Decorative cloud icon"
            class="vs-breadcrumb-icon-1 animate-parachute" loading="lazy" />

        <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}" alt="Decorative hot air balloon icon"
            class="vs-breadcrumb-icon-2 animate-parachute" loading="lazy" />

        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h1 class="breadcrumb-title">Our Travel Blog</h1>
                        <p class="breadcrumb-subtitle" style="color: white;">
                            Discover inspiring stories, travel tips, and hidden gems of Morocco.
                        </p>

                        <figcaption class="image-caption visually-hidden">
                            A vibrant blue house in Chefchaouen, Morocco, showcasing the town’s unique architecture and
                            colorful charm.
                        </figcaption>

                        <p class="visually-hidden">
                            Experience the serene beauty of Chefchaouen, Morocco’s Blue City. Famous for its painted streets
                            and vibrant doors,
                            this peaceful mountain town is a favorite among travelers and photographers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Main Blog Content Section --}}
    {{-- Schema.org Blog/CollectionPage/SearchResultsPage added via JSON-LD in head --}}
    <section class="vs-blog-wrapper space">
        <div class="container">
            <div class="row gx-3 g-5">
                {{-- Main Content Area (Posts) --}}
                <div class="col-lg-8">
                    <div class="row g-4 gy-4 gy-sm-5">
                        {{-- Loop through posts or show empty state --}}
                        @forelse ($posts as $post)
                            {{-- $post->slug: URL-friendly identifier for the post (e.g., "my-first-trip-to-marrakech") --}}
                            {{-- $post->title: The main title of the blog post --}}
                            {{-- $post->featured_image: Path to the image file relative to storage/app/public --}}
                            {{-- $post->user->name: Name of the User who authored the post (if relationship exists) --}}
                            {{-- $post->written_by: Fallback author name string if user relationship doesn't exist or isn't set --}}
                            {{-- $post->created_at: Timestamp of when the post was created --}}
                            {{-- $post->summary: A short summary text for the post --}}
                            {{-- $post->content: The full content of the post (used for excerpt fallback) --}}
                            <div class="col-12">
                                <div class="vs-blog vs-blog-box3">
                                    <div class="blog-img">
                                        <a href="{{ route('blog.show', $post->slug) ?? '#' }}"
                                            aria-label="Read more about {{ $post->title }}">
                                            @php
                                                $imagePath = $post->featured_image;
                                                $defaultImage = asset('assets/img/blog/blog-3-1.png');
                                                $featuredImage = $defaultImage;

                                                if ($imagePath) {
                                                    $normalizedPath = str_replace('\\', '/', $imagePath);

                                                    if (strpos($normalizedPath, 'public/storage/') !== false) {
                                                        $relativePath = Str::after($normalizedPath, 'public/storage/');
                                                        $featuredImage = asset(
                                                            'public/storage/' . ltrim($relativePath, '/'),
                                                        );
                                                    } elseif (file_exists(public_path('storage/' . $normalizedPath))) {
                                                        $featuredImage = asset('public/storage/' . $normalizedPath);
                                                    } elseif (file_exists(public_path($normalizedPath))) {
                                                        $featuredImage = asset($normalizedPath);
                                                    } else {
                                                        $featuredImage = $defaultImage;
                                                    }
                                                }
                                            @endphp

                                            <img class="img" src="{{ $featuredImage }}" alt="{{ $post->title }}"
                                                loading="lazy"
                                                onerror="this.onerror=null;this.src='{{ asset('assets/img/blog/blog-3-1.png') }}';">

                                        </a>
                                    </div>
                                    <div class="blog-content">
                                        <div class="blog-meta">
                                            <span class="blog-author">
                                                <span class="written-by-label">Written by:</span>
                                                {{-- Link author name if route exists, otherwise just display --}}
                                                {{-- Example conditional link: @if ($post->user && Route::has('author.show')) <a href="{{ route('author.show', $post->user->slug) }}">...</a> @else ... @endif --}}
                                                <a href="#"> {{-- Keep simple link for now --}}
                                                    {{ $post->user->name ?? ($post->written_by ?? 'Morocco Quest Team') }}
                                                </a>
                                            </span>
                                            <span class="blog-date">
                                                <i class="fa-regular fa-calendar-days"></i>
                                                {{ $post->created_at ? $post->created_at->format('F d, Y') : 'Date not set' }}
                                            </span>
                                        </div>
                                        {{-- Post Title (H3) --}}
                                        <h3 class="blog-title">
                                            <a href="{{ route('blog.show', $post->slug) ?? '#' }}"
                                                aria-label="Read more about {{ $post->title }}">
                                                {{ $post->title }}
                                            </a>
                                        </h3>
                                        {{-- Post Excerpt/Summary --}}
                                        <p class="blog-text">
                                            {{ $post->summary ?? Str::limit(strip_tags($post->content), 180) }}
                                        </p>
                                        <div class="blog-footer">
                                            {{-- Read More Link --}}
                                            <a href="{{ route('blog.show', $post->slug) ?? '#' }}" class="blog-link"
                                                aria-label="Read more about {{ $post->title }}">
                                                Read Full Post
                                                <i class="fa-sharp fa-regular fa-angles-right"></i>
                                            </a>
                                            {{-- Social Share Links (Unchanged structure, improved aria-labels) --}}
                                            <div class="share-box">
                                                <span>
                                                    share <i class="fa-solid fa-share-nodes ms-2"></i>
                                                </span>
                                                <ul class="custom-ul">
                                                    <li><a href="https://www.facebook.com/codesommetagency/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug) ?? url('/')) }}"
                                                            target="_blank" rel="noopener noreferrer"
                                                            aria-label="Share {{ $post->title }} on Facebook"><i
                                                                class="fa-brands fa-facebook-f"></i></a></li>
                                                    <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug) ?? url('/')) }}&text={{ urlencode($post->title) }}"
                                                            target="_blank" rel="noopener noreferrer"
                                                            aria-label="Share {{ $post->title }} on X (Twitter)"><i
                                                                class="fa-brands fa-x-twitter"></i></a></li>
                                                    <li><a href="https://www.instagram.com/moroccoquestdmc/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post->slug) ?? url('/')) }}&title={{ urlencode($post->title) }}"
                                                            target="_blank" rel="noopener noreferrer"
                                                            aria-label="Share {{ $post->title }} on LinkedIn"><i
                                                                class="fa-brands fa-linkedin-in"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            {{-- Display when no posts are found --}}
                            <div class="col-12 text-center">
                                <p class="lead mt-5">
                                    @if (isset($query) && $query)
                                        No posts found matching your search query "{{ e($query) }}".
                                    @elseif(isset($category))
                                        No posts found in the category "{{ $category->name }}".
                                    @elseif(isset($tag))
                                        No posts found with the tag "{{ $tag->name }}".
                                    @else
                                        No blog posts have been published yet. Please check back soon!
                                    @endif
                                </p>
                                <a href="{{ route('blog.index') ?? '#' }}" class="vs-btn mt-3">View All Posts</a>
                            </div>
                        @endforelse
                    </div>


                </div>

                {{-- Sidebar Area --}}
                <div class="col-lg-4">
                    <aside class="sidebar-area">
                        {{-- Search Widget --}}
                        <div class="widget widget_search">
                            <h5 class="widget_title title-shep">Search Blog</h5>
                            {{-- Ensure form action points to the correct search route --}}
                            <form class="search-form" action="{{ route('blog.search') ?? '#' }}" method="GET">
                                <input type="text" name="query" placeholder="Search articles..."
                                    value="{{ $query ?? '' }}" aria-label="Search Blog Posts" />
                                <button type="submit" aria-label="Submit Search"><i class="far fa-search"></i></button>
                            </form>
                        </div>

                        {{-- Recent Posts Widget --}}
                        {{-- Check if $recentBlogs exists and has items --}}
                        @isset($recentBlogs)
                            @if ($recentBlogs->count() > 0)
                                <div class="widget widget_recent-posts">
                                    <h5 class="widget_title title-shep">Recent Posts</h5>
                                    <div class="recent-post-wrap">
                                        @foreach ($recentBlogs as $recent)
                                            {{-- $recent->slug, ->title, ->featured_image, ->created_at : Same meaning as in the main $post loop --}}
                                            <div class="recent-post">
                                                <div class="media-img">
                                                    <a href="{{ route('blog.show', $recent->slug) ?? '#' }}"
                                                        aria-label="Read more about {{ $recent->title }}">
                                                        @php
                                                            $recentImagePath = $recent->featured_image;
                                                            $defaultImage = asset(
                                                                'assets/img/blog/recent-post-1-1.png',
                                                            );
                                                            $recentImage = $defaultImage;

                                                            if ($recentImagePath) {
                                                                $normalizedPath = str_replace(
                                                                    '\\',
                                                                    '/',
                                                                    $recentImagePath,
                                                                );

                                                                if (
                                                                    strpos($normalizedPath, 'public/storage/') !== false
                                                                ) {
                                                                    $relativePath = Str::after(
                                                                        $normalizedPath,
                                                                        'public/storage/',
                                                                    );
                                                                    $recentImage = asset(
                                                                        'public/storage/' . ltrim($relativePath, '/'),
                                                                    );
                                                                } elseif (
                                                                    file_exists(
                                                                        public_path('storage/' . $normalizedPath),
                                                                    )
                                                                ) {
                                                                    $recentImage = asset(
                                                                        'public/storage/' . $normalizedPath,
                                                                    );
                                                                } elseif (file_exists(public_path($normalizedPath))) {
                                                                    $recentImage = asset($normalizedPath);
                                                                } else {
                                                                    $recentImage = $defaultImage;
                                                                }
                                                            }
                                                        @endphp

                                                        <img src="{{ $recentImage }}" alt="{{ $recent->title }}"
                                                            loading="lazy"
                                                            onerror="this.onerror=null;this.src='{{ asset('assets/img/blog/recent-post-1-1.png') }}';">

                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="recent-post-meta">
                                                        <a href="{{ route('blog.show', $recent->slug) ?? '#' }}">
                                                            <i class="fa-solid fa-calendar"></i>
                                                            {{ $recent->created_at ? $recent->created_at->format('F d, Y') : '' }}
                                                        </a>
                                                    </div>
                                                    <h6 class="post-title">
                                                        <a class="text-inherit"
                                                            href="{{ route('blog.show', $recent->slug) ?? '#' }}">
                                                            {{ Str::limit($recent->title, 35) }}
                                                        </a>
                                                    </h6>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endisset

                        {{-- Categories Widget --}}
                        @isset($categories)
                            @if ($categories->count() > 0)
                                <div class="widget widget_categories">
                                    <h5 class="widget_title title-shep">Categories</h5>
                                    <ul class="custom-ul">
                                        @foreach ($categories as $cat)
                                            @if (!empty($cat->slug))
                                                <li>
                                                    <a href="{{ route('category.show', ['category' => $cat]) }}"
                                                        aria-label="View posts in {{ $cat->name }}">
                                                        {{ $cat->name }}
                                                    </a>
                                                    <span>({{ $cat->blogs->count() }})</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endisset




                        {{-- Tags Widget --}}
                        @isset($tags)
                            @if ($tags->count() > 0)
                                <div class="widget widget_meta">
                                    <h5 class="widget_title title-shep">Tags</h5>
                                    <div class="tagcloud">
                                        @foreach ($tags as $t)
                                            @if (!empty($t->slug))
                                                {{-- Check for non-empty slug --}}
                                                <a href="{{ route('tag.show', ['tag' => $t->slug]) }}"
                                                    aria-label="View posts tagged with {{ $t->name }}">{{ $t->name }}</a>
                                            @else
                                                <span class="tag-cloud-link"
                                                    title="Tag {{ $t->name }} (link currently unavailable)">{{ $t->name }}</span>
                                                {{-- No link if slug is missing, provide some basic styling if needed --}}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endisset
                        <div class="widget">
                            <h5 class="widget_title title-shep">Follow Us</h5>
                            <div class="sidebar-gallery">
                                <div class="gallery-box">
                                    <div class="post-thumb">
                                        <img src="{{ asset('assets/img/Desert-Camp-Morocco-Sunset-View-Lanterns-Palm-Trees.webp') }}"
                                            alt="Desert Camp Morocco Sunset View Lanterns Palm Trees" class="w-100" />
                                    </div>
                                    <a href="{{ asset('assets/img/Desert-Camp-Morocco-Sunset-View-Lanterns-Palm-Trees.webp') }}"
                                        title="Gallery-1" class=""></a>
                                </div>

                                <div class="gallery-box">
                                    <div class="post-thumb">
                                        <img src="{{ asset('assets/img/Luxury-Dinner-Setup-Wedding-Morocco-Outdoor-Event.webp') }}"
                                            alt="Luxury Dinner Setup Wedding Morocco Outdoor Event" class="w-100" />
                                    </div>
                                    <a href="{{ asset('assets/img/Luxury-Dinner-Setup-Wedding-Morocco-Outdoor-Event.webp') }}"
                                        title="Gallery-2" class=""></a>
                                </div>

                                <div class="gallery-box">
                                    <div class="post-thumb">
                                        <img src="{{ asset('assets/img/Moroccan-Gate-Fes-Tourists-Decorative-Architecture.webp') }}"
                                            alt="Moroccan Gate Fes Tourists Decorative Architecture" class="w-100" />
                                    </div>
                                    <a href="{{ asset('assets/img/Moroccan-Gate-Fes-Tourists-Decorative-Architecture.webp') }}"
                                        title="Gallery-3" class=""></a>
                                </div>

                                <div class="gallery-box">
                                    <div class="post-thumb">
                                        <img src="{{ asset('assets/img/Moroccan-Palace-Restaurant-Elegant-Dining-Setup.webp') }}"
                                            alt="Moroccan Palace Restaurant Elegant Dining Setup" class="w-100" />
                                    </div>
                                    <a href="{{ asset('assets/img/Moroccan-Palace-Restaurant-Elegant-Dining-Setup.webp') }}"
                                        title="Gallery-4" class=""></a>
                                </div>

                                <div class="gallery-box">
                                    <div class="post-thumb">
                                        <img src="{{ asset('assets/img/Moroccan-Riad-Pool-Night-View-Arch-Design.webp') }}"
                                            alt="Moroccan Riad Pool Night View Arch Design" class="w-100" />
                                    </div>
                                    <a href="{{ asset('assets/img/Moroccan-Riad-Pool-Night-View-Arch-Design.webp') }}"
                                        title="Gallery-5" class=""></a>
                                </div>

                                <div class="gallery-box">
                                    <div class="post-thumb">
                                        <img src="{{ asset('assets/img/Traditional-Moroccan-Dining-Event-Outdoor-Lanterns.webp') }}"
                                            alt="Traditional Moroccan Dining Event Outdoor Lanterns" class="w-100" />
                                    </div>
                                    <a href="{{ asset('assets/img/Traditional-Moroccan-Dining-Event-Outdoor-Lanterns.webp') }}"
                                        title="Gallery-6" class=""></a>
                                </div>
                            </div>
                        </div>




                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
