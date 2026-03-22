{{-- Using layouts/app.blade.php --}}
@extends('layouts.app2')

{{-- Dynamic page title from the blog post --}}
@section('title', $blog->title) {{-- Use blog title for page title --}}

@section('content')

    <!--================= Breadcrumb Area start =================-->
    <section
        class="vs-breadcrumb"
        {{-- Use asset() helper for background. Keep static or make dynamic if needed. --}}
        data-bg-src="{{ asset('assets/img/bg/breadcrumb-bg.png') }}"
    >
        {{-- Static decorative icons - Use asset() --}}
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
                        {{-- Dynamic Title --}}
                        <h1 class="breadcrumb-title">{{ $blog->title }}</h1>
                    </div>
                    <div class="breadcrumb-menu">
                        <ul class="custom-ul">
                            <li>
                                {{-- Dynamic Home Link --}}
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            {{-- Dynamic Current Page Title --}}
                            <li>{{ $blog->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================= Breadcrumb Area end =================-->

    <!--================= Blog Details Area Start (Original template used 'Destination Area' comment, keeping that structure) =================-->
    <section class="space">
        <div class="container">
            <div class="row gx-3 g-4 gx-xl-5">
                {{-- Main Content Column --}}
                <div class="col-lg-8">
                    <div class="vs-blog vs-blog-box3 blog-single">
                        {{-- Dynamic Featured Image --}}
                        <div class="blog-img rounded-bottom-0">
                             @if($blog->featured_image)
                                <img
                                    class="img" {{-- Keep template class --}}
                                    {{-- Use asset() assuming path is correct like 'storage/images/blogs/...' --}}
                                    src="{{ asset($blog->featured_image) }}"
                                    alt="{{ $blog->title }}"
                                />
                            @else
                                {{-- Fallback placeholder from template --}}
                                <img
                                    class="img"
                                    src="{{ asset('assets/img/blog/blog-big-1-1.png') }}"
                                    alt="{{ $blog->title }}"
                                />
                            @endif
                        </div>
                        <div class="blog-content">
                            {{-- Dynamic Meta --}}
                            <div class="blog-meta">
                                <span class="blog-author">
                                     {{-- Use User relationship if available --}}
                                     @if($blog->user)
                                        Written by: <a href="#">{{ $blog->user->name ?? 'Author' }}</a>
                                    @elseif($blog->written_by)
                                        Written by: <a href="#">{{ $blog->written_by }}</a>
                                    @else
                                        Written by: <a href="#">Admin</a>
                                    @endif
                                </span>
                                <span class="blog-date">
                                    <i class="fa-regular fa-calendar-days"></i>
                                    {{-- Use created_at date --}}
                                    {{ $blog->created_at ? $blog->created_at->format('F d, Y') : 'Date not set' }}
                                </span>
                                {{-- You can add category here if desired in meta --}}
                                {{-- <span class="blog-category">
                                    <i class="fa-solid fa-tag"></i>
                                    @if($blog->category && $blog->category->slug && Route::has('category.show'))
                                        <a href="{{ route('category.show', $blog->category->slug) }}">{{ $blog->category->name ?? 'Uncategorized' }}</a>
                                    @else
                                        {{ $blog->category->name ?? 'Uncategorized' }}
                                    @endif
                                </span> --}}
                            </div>
                            {{-- Dynamic Title --}}
                            <h4 class="blog-title">{{ $blog->title }}</h4>

                            {{-- Dynamic Content Block --}}
                            {{-- This replaces all static paragraphs, blockquotes, subheadings, internal images from the template --}}
                            {{-- It assumes $blog->content contains the full HTML from your editor --}}
                            {{-- Make sure $blog->content is SANITIZED before saving to DB! --}}
                            <div class="dynamic-content-area blog-text"> {{-- Add blog-text class for potential styling --}}
                                {!! $blog->content !!}
                            </div>

                            {{-- Render the separate Quote FIELD if it exists in the DB --}}
                            {{-- This is separate from any quotes potentially inside $blog->content --}}
                             @if($blog->quote)
                                <blockquote class="vs-quote">
                                    {{-- Keep the template's quote icon structure --}}
                                    <i class="quote-icon">
                                        <img
                                            src="{{ asset('assets/img/icons/svg-blog-details-quote-icon-1-1.svg') }}"
                                            alt="quote icon"
                                        />
                                    </i>
                                    <div class="quote-content">
                                        <p>{{ $blog->quote }}</p>
                                        {{-- Use quote_author field --}}
                                        @if($blog->quote_author)<cite>{{ $blog->quote_author }}</cite>@endif
                                    </div>
                                </blockquote>
                            @endif

                            <div class="blog-footer flex-wrap">
    {{-- Dynamic Tags (Specific to this post) --}}
    @if($blog->tags && $blog->tags->count() > 0) {{-- <<< CHECK THIS CONDITION --}}
        <div class="block-tag-cloud">
            <span class="title">Tags:</span>
            @foreach($blog->tags as $tag) {{-- Loop through THIS BLOG POST's tags --}}
                @if($tag->slug && Route::has('tag.show'))
                    <a href="{{ route('tag.show', $tag->slug) }}" class="tag-cloud-link">{{ $tag->name }}</a>
                @else
                    <span class="tag-cloud-link">{{ $tag->name }}</span>
                @endif
            @endforeach
        </div>
    @endif
                                {{-- Dynamic Share Links --}}
                                <div class="share-box">
                                    <span>
                                        share
                                        <i class="fa-solid fa-share-nodes"></i>
                                    </span>
                                    <ul class="custom-ul">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $blog->slug)) }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $blog->slug)) }}&text={{ urlencode($blog->title) }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-x-twitter"></i></a></li>
                                        {{-- Add Instagram if you have a share link standard for it --}}
                                        {{-- <li><a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a></li> --}}
                                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $blog->slug)) }}&title={{ urlencode($blog->title) }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> {{-- End .vs-blog --}}

                    {{-- This div wrapper is from the static template, seems to wrap Author Bio, Pagination, Comments --}}
                    <div class="blog-single">
                        {{-- Dynamic Author Bio --}}
                         @if($blog->user || $blog->written_by)
                            <div class="blog-single-author">
                                <div class="media-img">
                                    {{-- Use user avatar if available, else fallback --}}
                                    @if($blog->user && $blog->user->avatar)
                                        <img src="{{ asset($blog->user->avatar) }}" alt="{{ $blog->user->name }}" />
                                    @else
                                        <img src="{{ asset('assets/img/blog/blog-author.png') }}" alt="Author" />
                                    @endif
                                </div>
                                <div class="media-body">
                                    {{-- Use user name or written_by --}}
                                    <h5 class="author-name">{{ $blog->user->name ?? $blog->written_by ?? 'Author' }}</h5>
                                    {{-- Use user bio if available --}}
                                    @if($blog->user && $blog->user->bio)
                                        <p class="author-text">{{ $blog->user->bio }}</p>
                                    @else
                                        {{-- Placeholder if no bio --}}
                                        <p class="author-text">Author information.</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Dynamic Post Pagination --}}
                        @if($previousBlog || $nextBlog)
                            <div class="post-pagination">
                                @isset($previousBlog)
                                    <a href="{{ route('blog.show', $previousBlog->slug) }}" class="post-pagi-box prev">
                                        <i class="fa-regular fa-arrow-left"></i>
                                        {{ Str::limit($previousBlog->title, 20) }} {{-- Limit title length --}}
                                    </a>
                                @else
                                    {{-- Keep structure but disable --}}
                                    <span class="post-pagi-box prev disabled">
                                         <i class="fa-regular fa-arrow-left"></i>
                                        No Previous Post
                                    </span>
                                @endisset

                                @isset($nextBlog)
                                    <a href="{{ route('blog.show', $nextBlog->slug) }}" class="post-pagi-box next">
                                        {{ Str::limit($nextBlog->title, 20) }}
                                        <i class="fa-regular fa-arrow-right"></i>
                                    </a>
                                @else
                                     {{-- Keep structure but disable --}}
                                     <span class="post-pagi-box next disabled">
                                         No Next Post
                                        <i class="fa-regular fa-arrow-right"></i>
                                    </span>
                                @endisset
                            </div>
                        @endif

                        {{-- Dynamic Comments Section --}}
                         @if($blog->comments) {{-- Check if comments relationship is loaded/exists --}}
                            <div class="vs-comments-wrap">
                                {{-- Dynamic comment count --}}
                                <h4 class="blog-inner-title">{{ $blog->comments->count() }} Comment{{ $blog->comments->count() != 1 ? 's' : '' }}</h4>
                                @if($blog->comments->count() > 0)
                                    <ul class="custom-ul">
                                        {{-- Loop through top-level comments --}}
                                        {{-- TODO: Implement nested comment display logic if needed --}}
                                        @foreach($blog->comments as $comment) {{-- Assuming controller eager loads 'comments.user' --}}
                                            <li class="vs-comment-item">
                                                <div class="vs-post-comment">
                                                    <div class="vs-post-comment-inner">
                                                        <div class="comment-avater">
                                                            {{-- Dynamic avatar --}}
                                                            <img src="{{ asset('assets/img/blog/comment-author-1.png') }}" alt="Author">

                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="content-header">
                                                                {{-- Dynamic name --}}
                                                                <h5 class="name">{{ $comment->name ?? 'Guest' }}
                                                                </h5>
                                                                {{-- Dynamic date --}}
                                                                <span class="commented-on">{{ $comment->created_at->format('d M Y') }}</span>
                                                            </div>
                                                            {{-- Dynamic text --}}
                                                            <p class="text">{{ e($comment->content) }}</p>
                                                        </div>
                                                    </div>
                                                    {{-- Reply button - Keep static structure for now --}}
                                                    <div class="reply_and_edit">
                                                        {{-- Functionality requires JS/Backend --}}
                                                        {{-- <a href="#" class="replay-btn">Replay<i class="fa-solid fa-reply"></i></a> --}}
                                                    </div>
                                                </div>
                                                {{-- Placeholder for nested comments based on template structure --}}
                                                {{-- You would need to check $comment->children or similar and loop here --}}
                                                {{-- <ul class="custom-ul children"> ... </ul> --}}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>Be the first to leave a comment!</p>
                                @endif
                            </div>

                            <!-- Dynamic Comment Form -->
                            <div class="vs-comment-form">
                                <div id="respond" class="comment-respond">
                                    <div class="form-title">
                                        <h4 class="blog-inner-title">Leave a Comment</h4>
                                        <p class="form-text">
                                            Your email address will not be published. Required fields are marked*
                                        </p>
                                        {{-- Display Success/Error Messages --}}
                                        @if (session('success')) <div class="alert alert-success mt-2">{{ session('success') }}</div> @endif
                                        @if ($errors->any() && !$errors->hasAny(['content', 'name', 'email']))
                                            <div class="alert alert-danger mt-2">Please check the form below for errors.</div>
                                        @endif
                                    </div>
                                    {{-- Dynamic Form Action --}}
                                    <form action="{{ route('comments.store', $blog->id) }}" method="POST">

                                        @csrf
                                        <div class="row gx-20">
                                            <div class="col-12 form-group">
                                                {{-- Add name, old value, error handling --}}
                                                <textarea name="content" class="form-control @error('content') is-invalid @enderror" placeholder="Your Comment *" required>{{ old('content') }}</textarea>
                                                 @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                            {{-- Show fields only for guests --}}
                                            @guest
                                                <div class="col-md-6 form-group">
                                                    {{-- Add name, old value, error handling --}}
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name *" value="{{ old('name') }}" required />
                                                     @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                     {{-- Add name, old value, error handling --}}
                                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email *" value="{{ old('email') }}" required /> {{-- Consider making optional --}}
                                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>
                                            @endguest
                                            {{-- Show info for logged-in users --}}
                                             @auth
                                                <div class="col-12 form-group">
                                                    <p>Commenting as: <strong>{{ auth()->user()->name }}</strong></p>
                                                </div>
                                            @endauth

                                            <div class="col-12">
                                                <div class="custom-checkbox notice">
                                                    {{-- Add name, old value check --}}
                                                    <input id="comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" {{ old('wp-comment-cookies-consent') ? 'checked' : '' }} />
                                                    <label for="comment-cookies-consent">
                                                        Save my name, email, and website next time I comment. {{-- Removed '*' as it's optional --}}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 form-group mb-0">
                                                <button type="submit" class="vs-btn">Post Comment</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Comment Form end -->
                        @endif {{-- End check for comments relationship --}}
                    </div> {{-- End .blog-single wrapper --}}
                </div> {{-- End col-lg-8 --}}

                {{-- Sidebar Column --}}
                <div class="col-lg-4">
                    <aside class="sidebar-area"> {{-- Changed div to aside --}}
                        {{-- Dynamic Search Widget --}}
                        <div class="widget widget_search">
                            <h5 class="widget_title title-shep">Search</h5>
                            <form class="search-form" action="{{ route('blog.search') }}" method="GET">
                                <input type="text" name="query" placeholder="Search here..." value="{{ request('query') }}" aria-label="Search" />
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>

                        {{-- Dynamic Recent Posts Widget --}}
                        {{-- Renamed from 'related posts' to match variable name --}}
                        @isset($recentBlogs)
                             @if($recentBlogs->count() > 0)
                                <div class="widget widget_recent-posts">
                                    <h5 class="widget_title title-shep">Recent Posts</h5>
                                    <div class="recent-post-wrap">
                                        @foreach($recentBlogs as $recent)
                                            <div class="recent-post">
                                                <div class="media-img">
                                                    {{-- Dynamic Link & Image --}}
                                                    <a href="{{ route('blog.show', $recent->slug) }}">
                                                        <img src="{{ asset($recent->featured_image ?? 'assets/img/blog/recent-post-1-1.png') }}" alt="{{ $recent->title }}" />
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="recent-post-meta">
                                                         {{-- Dynamic Link & Date --}}
                                                        <a href="{{ route('blog.show', $recent->slug) }}">
                                                            <i class="fa-solid fa-calendar"></i>
                                                            {{ $recent->created_at->format('F d, Y') }}
                                                        </a>
                                                    </div>
                                                    <h6 class="post-title">
                                                         {{-- Dynamic Link & Title --}}
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
                                                {{-- Dynamic Link (with safety check) --}}
                                                @if($category->slug && Route::has('category.show'))
                                                    <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                                                @else
                                                    {{ $category->name }}
                                                @endif
                                                {{-- Dynamic Count --}}
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
                                <div class="widget widget_meta"> {{-- Use widget_tag_cloud class? --}}
                                    <h5 class="widget_title title-shep">Tags</h5>
                                    <div class="tagcloud">
                                         @foreach($tags as $tag)
                                             {{-- Dynamic Link (with safety check) --}}
                                             @if($tag->slug && Route::has('tag.show'))
                                                <a href="{{ route('tag.show', $tag->slug) }}" class="tag-cloud-link">{{ $tag->name }}</a> {{-- Added class back --}}
                                             @else
                                                <span class="tag-cloud-link">{{ $tag->name }}</span>
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
                                {{-- Use asset() for image paths --}}
                                <div class="gallery-box"><div class="post-thumb"><img src="{{ asset('assets/img/instagram/insta-post-1-1.png') }}" alt="instagram" class="w-100"/></div><a href="{{ asset('assets/img/instagram/insta-post-1-1.png') }}" title="Gallery-1" class="popup-image"></a></div> {{-- Add popup class if needed --}}
                                <div class="gallery-box"><div class="post-thumb"><img src="{{ asset('assets/img/instagram/insta-post-1-2.png') }}" alt="instagram" class="w-100"/></div><a href="{{ asset('assets/img/instagram/insta-post-1-2.png') }}" title="Gallery-2" class="popup-image"></a></div>
                                <div class="gallery-box"><div class="post-thumb"><img src="{{ asset('assets/img/instagram/insta-post-1-3.png') }}" alt="instagram" class="w-100"/></div><a href="{{ asset('assets/img/instagram/insta-post-1-3.png') }}" title="Gallery-3" class="popup-image"></a></div>
                                <div class="gallery-box"><div class="post-thumb"><img src="{{ asset('assets/img/instagram/insta-post-1-4.png') }}" alt="instagram" class="w-100"/></div><a href="{{ asset('assets/img/instagram/insta-post-1-4.png') }}" title="Gallery-4" class="popup-image"></a></div>
                                <div class="gallery-box"><div class="post-thumb"><img src="{{ asset('assets/img/instagram/insta-post-1-5.png') }}" alt="instagram" class="w-100"/></div><a href="{{ asset('assets/img/instagram/insta-post-1-5.png') }}" title="Gallery-5" class="popup-image"></a></div>
                                <div class="gallery-box"><div class="post-thumb"><img src="{{ asset('assets/img/instagram/insta-post-1-1.png') }}" alt="instagram" class="w-100"/></div><a href="{{ asset('assets/img/instagram/insta-post-1-1.png') }}" title="Gallery-6" class="popup-image"></a></div>
                             </div>
                        </div>
                    </aside> {{-- End sidebar-area --}}
                </div> {{-- End col-lg-4 --}}
            </div> {{-- End .row --}}
        </div> {{-- End .container --}}
    </section>
    <!--================= Blog Details Area end =================-->

@endsection