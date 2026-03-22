{{-- Assuming you have a layout file like layouts/app.blade.php --}}
@extends('layouts.app2')

{{-- Set the page title (static for the index page, or dynamic based on search/category/tag) --}}
@section('title', isset($tag) ? 'Posts tagged: '.$tag->name : (isset($category) ? 'Posts in category: '.$category->name : (request('query') ? 'Search results for: '.request('query') : 'Latest News & Blog') ))

@section('content')

<!--================= Breadcrumb Area start =================-->
<section
    class="vs-breadcrumb"
    data-bg-src="{{ asset('assets/img/bg/breadcrumb-bg.png') }}"
>
    <img
        src="{{ asset('assets/img/icons/cloud.png') }}"
        alt="vs-breadcrumb-icon"
        class="vs-breadcrumb-icon-1 animate-parachute"
    />
    <img
        src="{{ asset('assets/img/icons/ballon-sclation.png') }}"
        alt="vs-breadcrumb-icon"
        class="vs-breadcrumb-icon-2 animate-parachute"
    />
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    {{-- Dynamic title based on context (search, category, tag, or default) --}}
                    <h1 class="breadcrumb-title">
                        @if(isset($tag)) Posts tagged with "{{ $tag->name }}"
                        @elseif(isset($category)) Posts in category "{{ $category->name }}"
                        @elseif(request('query')) Search Results for "{{ request('query') }}"
                        @else Latest News
                        @endif
                    </h1>
                </div>
                <div class="breadcrumb-menu">
                    <ul class="custom-ul">
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li>Our Blog</li> {{-- Keep this generic for now --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================= Breadcrumb Area end =================-->

<!--================= Blog Listing Area Start (Based on Destination Area comment) =================-->
<section class="vs-blog-wrapper space">
    <div class="container">
        <div class="row gx-3 g-5">
            {{-- Main Blog Posts Column --}}
            <div class="col-lg-8">
                <div class="row g-4 gy-4 gy-sm-5">

                    {{-- Loop through paginated posts ($posts variable from controller) --}}
                    @forelse ($posts as $post)
                        <div class="col-12">
                            <div class="vs-blog vs-blog-box3">
                                <div class="blog-img">
                                    {{-- Dynamic Link to post details --}}
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        {{-- Dynamic Image --}}
                                        <img
                                            class="img"
                                            src="{{ asset($post->featured_image ?? 'assets/img/blog/blog-3-1.png') }}" {{-- Use featured_image, provide fallback --}}
                                            alt="{{ $post->title }}"
                                        />
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        {{-- Dynamic Author --}}
                                        <span class="blog-author">
                                             @if($post->user)
                                                Written by:<a href="#">{{ $post->user->name ?? 'Author' }}</a>
                                            @elseif($post->written_by)
                                                Written by:<a href="#">{{ $post->written_by }}</a>
                                            @else
                                                Written by:<a href="#">Admin</a>
                                            @endif
                                        </span>
                                        {{-- Dynamic Date --}}
                                        <span class="blog-date">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            {{ $post->created_at ? $post->created_at->format('F d, Y') : 'Date not set' }}
                                        </span>
                                        {{-- Optional: Display Category Here --}}
                                        {{-- @if($post->category)
                                        <span class="blog-category">
                                            <i class="fa-solid fa-tag"></i>
                                             @if($post->category->slug && Route::has('category.show'))
                                                <a href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->name }}</a>
                                            @else
                                                {{ $post->category->name }}
                                            @endif
                                        </span>
                                        @endif --}}
                                    </div>
                                    {{-- Dynamic Title and Link --}}
                                    <h3 class="blog-title">
                                        <a href="{{ route('blog.show', $post->slug) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    {{-- Dynamic Excerpt/Summary --}}
                                    <p class="blog-text">
                                        {{-- Use summary field if it exists, otherwise limit content --}}
                                        {{ $post->summary ?? Str::limit(strip_tags($post->content), 180) }} {{-- Adjust limit as needed --}}
                                    </p>
                                    <div class="blog-footer">
                                        {{-- Dynamic Read More Link --}}
                                        <a href="{{ route('blog.show', $post->slug) }}" class="blog-link">
                                            read more
                                            <i class="fa-sharp fa-regular fa-angles-right"></i>
                                        </a>
                                        {{-- Dynamic Share Box --}}
                                        <div class="share-box">
                                            <span>
                                                share <i class="fa-solid fa-share-nodes ms-2"></i> {{-- Added margin like theme --}}
                                            </span>
                                            <ul class="custom-ul">
                                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a></li>
                                                <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-x-twitter"></i></a></li>
                                                {{-- <li><a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a></li> --}}
                                                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post->slug)) }}&title={{ urlencode($post->title) }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- Message shown if no posts are found (e.g., empty category or search) --}}
                        <div class="col-12 text-center">
                            <p class="lead mt-5">
                                @if(request('query'))
                                    No posts found matching your search query "{{ request('query') }}".
                                @else
                                    No blog posts found.
                                @endif
                             </p>
                            <a href="{{ route('blog.index') }}" class="vs-btn mt-3">View All Posts</a> {{-- Link back --}}
                        </div>
                    @endforelse

                </div> {{-- End inner row for posts --}}

                 {{-- Pagination Links --}}
                 {{-- Render pagination links only if there are posts --}}
                 @if ($posts->hasPages())
                     <div class="vs-pagination pt-50 pb-30"> {{-- Added padding like theme examples might have --}}
                         {{-- This uses Laravel's default pagination view --}}
                         {{-- You might need to publish and customize pagination views to match theme exactly --}}
                         {{ $posts->appends(request()->except('page'))->links() }}
                         {{-- appends() ensures search query/etc persists through pagination --}}
                     </div>
                 @endif


            </div> {{-- End col-lg-8 --}}

            {{-- Sidebar Column --}}
            <div class="col-lg-4">
                {{-- Reuse the exact same sidebar code from blog-details.blade.php --}}
                <aside class="sidebar-area">
                    {{-- Dynamic Search Widget --}}
                    <div class="widget widget_search">
                        <h5 class="widget_title title-shep">Search</h5>
                        <form class="search-form" action="{{ route('blog.search') }}" method="GET">
                            <input type="text" name="query" placeholder="Search here..." value="{{ request('query') }}" aria-label="Search" />
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>

                    {{-- Dynamic Recent Posts Widget --}}
                    @isset($recentBlogs)
                         @if($recentBlogs->count() > 0)
                            <div class="widget widget_recent-posts">
                                <h5 class="widget_title title-shep">Recent Posts</h5> {{-- Changed from related --}}
                                <div class="recent-post-wrap">
                                    @foreach($recentBlogs as $recent)
                                        <div class="recent-post">
                                            <div class="media-img">
                                                <a href="{{ route('blog.show', $recent->slug) }}">
                                                    <img src="{{ asset($recent->featured_image ?? 'assets/img/blog/recent-post-1-1.png') }}" alt="{{ $recent->title }}" />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="recent-post-meta">
                                                    <a href="{{ route('blog.show', $recent->slug) }}">
                                                        <i class="fa-solid fa-calendar"></i>
                                                        {{ $recent->created_at->format('F d, Y') }}
                                                    </a>
                                                </div>
                                                <h6 class="post-title">
                                                    <a class="text-inherit" href="{{ route('blog.show', $recent->slug) }}">
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

                    {{-- Dynamic Categories Widget --}}
                     @isset($categories)
                        @if ($categories->count() > 0)
                            <div class="widget widget_categories">
                                <h5 class="widget_title title-shep">Categories</h5>
                                <ul class="custom-ul">
                                    @foreach($categories as $category)
                                        <li>
                                            @if($category->slug && Route::has('category.show'))
                                                <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                                            @else
                                                {{ $category->name }}
                                            @endif
                                            {{-- Use blogs_count from controller --}}
                                            <span>{{ $category->blogs_count ?? 0 }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endisset

                    {{-- Dynamic Tags Widget --}}
                     @isset($tags)
                         @if ($tags->count() > 0)
                            <div class="widget widget_meta">
                                <h5 class="widget_title title-shep">Tags</h5>
                                <div class="tagcloud">
                                     @foreach($tags as $tag)
                                         @if($tag->slug && Route::has('tag.show'))
                                            <a href="{{ route('tag.show', $tag->slug) }}" >{{ $tag->name }}</a>
                                         @else
                                            <span>{{ $tag->name }}</span>
                                         @endif
                                     @endforeach
                                </div>
                            </div>
                        @endif
                    @endisset

                    {{-- Static Follow Us/Gallery Widget --}}
                    <div class="widget">
                        <h5 class="widget_title title-shep">Follow Us</h5>
                        <div class="sidebar-gallery">
                            <div class="gallery-box"><div class="post-thumb"><img src="{{ asset('assets/img/instagram/insta-post-1-1.png') }}" alt="instagram" class="w-100"/></div><a href="{{ asset('assets/img/instagram/insta-post-1-1.png') }}" title="Gallery-1" class="popup-image"></a></div>
                            <div class="gallery-box"><div class="post-thumb"><img src="{{ asset('assets/img/instagram/insta-post-1-2.png') }}" alt="instagram" class="w-100"/></div><a href="{{ asset('assets/img/instagram/insta-post-1-2.png') }}" title="Gallery-2" class="popup-image"></a></div>
                            <div class="gallery-box"><div class="post-thumb"><img src="{{ asset('assets/img/instagram/insta-post-1-3.png') }}" alt="instagram" class="w-100"/></div><a href="{{ asset('assets/img/instagram/insta-post-1-3.png') }}" title="Gallery-3" class="popup-image"></a></div>
                            <div class="gallery-box"><div class="post-thumb"><img src="{{ asset('assets/img/instagram/insta-post-1-4.png') }}" alt="instagram" class="w-100"/></div><a href="{{ asset('assets/img/instagram/insta-post-1-4.png') }}" title="Gallery-4" class="popup-image"></a></div>
                            <div class="gallery-box"><div class="post-thumb"><img src="{{ asset('assets/img/instagram/insta-post-1-5.png') }}" alt="instagram" class="w-100"/></div><a href="{{ asset('assets/img/instagram/insta-post-1-5.png') }}" title="Gallery-5" class="popup-image"></a></div>
                            <div class="gallery-box"><div class="post-thumb"><img src="{{ asset('assets/img/instagram/insta-post-1-1.png') }}" alt="instagram" class="w-100"/></div><a href="{{ asset('assets/img/instagram/insta-post-1-1.png') }}" title="Gallery-6" class="popup-image"></a></div>
                         </div>
                    </div>
                </aside> {{-- End sidebar-area --}}
            </div> {{-- End col-lg-4 --}}
        </div> {{-- End outer row --}}
    </div> {{-- End container --}}
</section>
<!--================= Blog Listing Area end =================-->

@endsection