@extends('layouts.app2')

@section('title', $title ?? $post->title . ' | Morocco Travel Blog | Morocco Quest')
@section('description', $description ?? Str::limit(strip_tags($post->summary ?? $post->content ?? ''), 160))
@section('keywords', $keywords ?? 'morocco tours, morocco travel blog, morocco tour package, private morocco tours, sahara desert tours morocco, ' . Str::lower($post->title))
@section('og_type', 'article')

@section('page_description', Str::limit(strip_tags($post->content), 155))

@php
    $_blogModel = $post;
    $blogSchema = $_blogModel ? [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $_blogModel->title,
        'description' => Str::limit(strip_tags($_blogModel->summary ?? $_blogModel->content ?? ''), 300),
        'author' => ['@type' => 'Person', 'name' => $_blogModel->written_by ?? 'Morocco Quest'],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Morocco Quest',
            'logo' => ['@type' => 'ImageObject', 'url' => asset('assets/img/logo-bg.png')],
        ],
        'datePublished' => optional($_blogModel->created_at)->toIso8601String() ?? '',
        'dateModified' => optional($_blogModel->updated_at)->toIso8601String() ?? '',
        'mainEntityOfPage' => url()->current(),
        'keywords' => 'best morocco itinerary, marrakech desert tours, sahara desert tour from marrakech',
    ] : null;
    $blogBreadcrumb = $_blogModel ? [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => url('/blog')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $_blogModel->title, 'item' => url()->current()],
        ],
    ] : null;
@endphp

@push('jsonld')
@if($blogSchema)<script type="application/ld+json">{!! json_encode($blogSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>@endif
@if($blogBreadcrumb)<script type="application/ld+json">{!! json_encode($blogBreadcrumb, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>@endif
@endpush

@section('content')

    <section class="vs-breadcrumb" data-bg-src="{{ asset('assets/img/moroccan-souk-woman-seller-market-life-fes.webp') }}">
        <img src="{{ asset('assets/img/icons/cloud.png') }}" alt="Decorative cloud icon for blog post section"
            class="vs-breadcrumb-icon-1 animate-parachute" />
        <img src="{{ asset('assets/img/icons/ballon-sclation.png') }}"
            alt="Decorative balloon icon representing cultural stories and Moroccan activities"
            class="vs-breadcrumb-icon-2 animate-parachute" />

        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h1 class="breadcrumb-title">{{ $post->title }}</h1>
                        @if (!empty($post->subtitle))
                            <p class="breadcrumb-subtitle"style="color: white;">{{ $post->subtitle }}</p>
                        @endif
                        <figcaption class="image-caption visually-hidden" style="color: white; font-size: medium;">
                            A Moroccan woman in traditional attire selling fresh vegetables at a local souk, surrounded by
                            colorful produce and community life. This scene captures the essence of Morocco's vibrant
                            markets.
                        </figcaption>

                        <p class="visually-hidden">
                            Explore the vibrant atmosphere of a traditional Moroccan souk where locals gather to sell and
                            buy fresh produce.
                            This authentic moment highlights the cultural richness and community spirit of everyday life in
                            Morocco, a key part of many Morocco tours and excursions.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="space">
        <div class="container">
            <div class="row gx-3 g-4 gx-xl-5">
                <div class="col-lg-8">
                    <div class="vs-blog vs-blog-box3 blog-single">
                        <div class="blog-img rounded-bottom-0">
                            {{-- Note: The PHP logic for image paths is complex. Consider moving to a Model accessor for cleaner templates. --}}
                            @php
                                $imagePath = $post->featured_image;
                                $postImage = asset('assets/img/blog/blog-big-1-1.png'); // Default fallback

                                if ($imagePath) {
                                    $normalizedPath = str_replace('\\', '/', $imagePath);

                                    // If the path already includes 'public/storage/'
                                    if (strpos($normalizedPath, 'public/storage/') !== false) {
                                        $relativePath = Str::after($normalizedPath, 'public/storage/');
                                        $postImage = asset('public/storage/' . ltrim($relativePath, '/'));

                                        // If it is directly inside public (manual upload)
                                    } elseif (file_exists(public_path('storage/' . $normalizedPath))) {
                                        $postImage = asset('public/storage/' . $normalizedPath);

                                        // If it is directly in public_html, use it as is
                                    } elseif (file_exists(public_path($normalizedPath))) {
                                        $postImage = asset($normalizedPath);

                                        // Final fallback to original path
                                    } else {
                                        $postImage = asset('public/storage/' . $normalizedPath);
                                    }
                                }
                            @endphp

                            <img class="img" src="{{ $postImage }}"
                                alt="Featured image for blog post: {{ $post->title }}"
                                onerror="this.onerror=null;this.src='{{ asset('assets/img/blog/blog-placeholder.png') }}';" />

                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-author">
                                    @if ($post->user)
                                        Written by:
                                        @if (Route::has('author.show') && isset($post->user->slug))
                                            {{-- Assuming you might have an author route by slug --}}
                                            <a
                                                href="{{ route('author.show', $post->user->slug) }}">{{ $post->user->name ?? 'Author' }}</a>
                                        @elseif(Route::has('author.show.id') && isset($post->user->id))
                                            {{-- Fallback to ID if slug not present but route exists --}}
                                            <a
                                                href="{{ route('author.show.id', $post->user->id) }}">{{ $post->user->name ?? 'Author' }}</a>
                                        @else
                                            {{ $post->user->name ?? 'Author' }} {{-- Display name if no route --}}
                                        @endif
                                    @elseif($post->written_by)
                                        Written by: {{ $post->written_by }}
                                    @else
                                        Written by: Admin
                                    @endif
                                </span>
                                <span class="blog-date">
                                    <i class="fa-regular fa-calendar-days"></i>
                                    {{ $post->created_at ? $post->created_at->format('F d, Y') : 'Date not set' }}
                                </span>
                            </div>
                            {{-- The H4 title here was redundant with the H1 in the breadcrumb, so it's removed.
                                <h4 class="blog-title">{{ $post->title }}</h4>
                            --}}
                            <div class="dynamic-content-area blog-text">
                                {!! $post->content !!} {{-- Ensure $post->content is sanitized if it comes from user input to prevent XSS --}}
                            </div>
                            @if ($post->quote)
                                <blockquote class="vs-quote">
                                    <i class="quote-icon">
                                        <img src="{{ asset('assets/img/icons/svg-blog-details-quote-icon-1-1.svg') }}"
                                            alt="Decorative quote icon" />
                                    </i>
                                    <div class="quote-content">
                                        <p>{{ $post->quote }}</p>
                                        @if ($post->quote_author)
                                            <cite>{{ $post->quote_author }}</cite>
                                        @endif
                                    </div>
                                </blockquote>
                            @endif
                            <div class="blog-footer flex-wrap">
                                @if ($post->tags && $post->tags->count() > 0)
                                    <div class="block-tag-cloud">
                                        <span class="title">Tags:</span>
                                        @foreach ($post->tags as $tag)
                                            @if ($tag->slug && Route::has('tag.show'))
                                                <a href="{{ route('tag.show', $tag->slug) }}" class="tag-cloud-link"
                                                    aria-label="View posts tagged with {{ $tag->name }}">{{ $tag->name }}</a>
                                            @else
                                                <span class="tag-cloud-link">{{ $tag->name }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                                <div class="share-box">
                                    <span>
                                        Share this post
                                        <i class="fa-solid fa-share-nodes"></i>
                                    </span>
                                    <ul class="custom-ul">
                                        <li>
                                            <a href="https://www.facebook.com/sharer/sharer.php" target="_blank"
                                                rel="noopener noreferrer" aria-label="Share on Facebook">
                                                <i class="fa-brands fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/intent/tweet" target="_blank"
                                                rel="noopener noreferrer" aria-label="Share on Twitter">
                                                <i class="fa-brands fa-x-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/shareArticle?mini=true" target="_blank"
                                                rel="noopener noreferrer" aria-label="Share on LinkedIn">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="blog-single">
                        @if ($post->user || $post->written_by)
                            <div class="blog-single-author">
                                <div class="media-img">
                                    @if ($post->user && $post->user->avatar)
                                        <img src="{{ asset($post->user->avatar) }}"
                                            alt="Avatar of {{ $post->user->name ?? 'author' }}" />
                                    @else
                                        <img src="{{ asset('assets/img/blog/mounir-akajia-morocco-quest-admin-main-blog-author.webp') }}"
                                            alt="Default author avatar" />
                                    @endif
                                </div>
                                <div class="media-body">
                                    <h5 class="author-name">Mounir Akajia</h5>

                                    <p class="author-text">A travel expert and graduate of the High International Institute
                                        of Tourism in Tangier. With a strong background in tourism and hospitality, Mounir
                                        specializes in crafting personalized, immersive travel experiences across Morocco.
                                        His passion for luxury, culture, and adventure allows him to create unforgettable
                                        journeys for those seeking to explore Morocco’s rich heritage.</p>
                                </div>
                            </div>
                        @endif
                        @if ($previousPost || $nextPost)
                            <nav class="post-pagination" aria-label="Blog post navigation">
                                @isset($previousPost)
                                    <a href="{{ route('blog.show', $previousPost->slug) }}" class="post-pagi-box prev"
                                        rel="prev">
                                        <i class="fa-regular fa-arrow-left" aria-hidden="true"></i>
                                        Previous: {{ Str::limit($previousPost->title, 20) }}
                                    </a>
                                @else
                                    <span class="post-pagi-box prev disabled" aria-disabled="true">
                                        <i class="fa-regular fa-arrow-left" aria-hidden="true"></i>
                                        No Previous Post
                                    </span>
                                @endisset
                                @isset($nextPost)
                                    <a href="{{ route('blog.show', $nextPost->slug) }}" class="post-pagi-box next"
                                        rel="next">
                                        Next: {{ Str::limit($nextPost->title, 20) }}
                                        <i class="fa-regular fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <span class="post-pagi-box next disabled" aria-disabled="true">
                                        No Next Post
                                        <i class="fa-regular fa-arrow-right" aria-hidden="true"></i>
                                    </span>
                                @endisset
                            </nav>
                        @endif
                        @if ($post->comments)
                            <div class="vs-comments-wrap">
                                <h4 class="blog-inner-title">
                                    {{ $post->comments->count() }} Comment{{ $post->comments->count() != 1 ? 's' : '' }}
                                </h4>

                                <ul class="custom-ul">
                                    @foreach ($post->comments->whereNull('parent_id') as $comment)
                                        <li class="vs-comment-item">
                                            <div class="vs-post-comment">
                                                <div class="vs-post-comment-inner">
                                                    <div class="comment-avater">
                                                        <div class="comment-avater">
                                                            @php
                                                                $hash = md5(strtolower(trim($comment->email)));
                                                                $gravatarUrl = "https://www.gravatar.com/avatar/$hash?s=80&d=404";
                                                                $firstLetter = strtoupper(substr($comment->name, 0, 1));
                                                                $lastLetter = strtoupper(
                                                                    substr(strrchr($comment->name, ' '), 1, 1),
                                                                );

                                                                // Generate random background color
                                                                $colors = [
                                                                    '#F97316',
                                                                    '#0EA5E9',
                                                                    '#64748B',
                                                                    '#1E3A8A',
                                                                    '#F59E0B',
                                                                ];
                                                                $backgroundColor = $colors[array_rand($colors)];
                                                            @endphp

                                                            @if ($comment->email === config('mail.admin_email'))
                                                                <img src="{{ asset('assets/img/blog/mounir-akajia-morocco-quest-admin-main-blog-author.webp') }}"
                                                                    alt="Admin" class="img-fluid avatar-rounded" />
                                                            @else
                                                                <img src="{{ $gravatarUrl }}"
                                                                    alt="{{ $comment->name }}"
                                                                    class="img-fluid avatar-rounded"
                                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />

                                                                <div class="avatar-placeholder"
                                                                    style="display: none; background-color: {{ $backgroundColor }};">
                                                                    {{ $firstLetter }}{{ $lastLetter }}
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    <style>
                                                        .author-text {
                                                            text-align: justify;
                                                        }

                                                        .comment-avater {
                                                            width: 80px;
                                                            height: 80px;
                                                            border-radius: 50%;
                                                            overflow: hidden;
                                                            display: flex;
                                                            align-items: center;
                                                            justify-content: center;
                                                            font-size: 1.5rem;
                                                            color: white;
                                                            font-weight: bold;
                                                            text-transform: uppercase;
                                                            border: 2px solid #bb5e2a;
                                                        }

                                                        .avatar-rounded {
                                                            width: 100%;
                                                            height: 100%;
                                                            object-fit: cover;
                                                            /* Ensures it fits inside the circle */
                                                            border-radius: 50%;
                                                        }

                                                        .avatar-placeholder {
                                                            width: 100%;
                                                            height: 100%;
                                                            border-radius: 50%;
                                                            display: flex;
                                                            align-items: center;
                                                            justify-content: center;
                                                        }
                                                    </style>



                                                    <div class="comment-content">
                                                        <div class="content-header">
                                                            <h5 class="name">{{ $comment->name }}</h5>
                                                            <span
                                                                class="commented-on">{{ $comment->created_at->format('d M Y') }}</span>
                                                        </div>
                                                        <p class="text">
                                                            {{ $comment->content }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="reply_and_edit">
                                                    <a href="javascript:void(0);" class="replay-btn"
                                                        data-id="{{ $comment->id }}">
                                                        Reply <i class="fa-solid fa-reply"></i>
                                                    </a>
                                                </div>

                                                <!-- Reply Form -->
                                                <div id="reply-form-{{ $comment->id }}" class="reply-form mt-3"
                                                    style="display: none; margin-left: 50px;">
                                                    <form action="{{ route('blog.comments.reply', $comment->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="row gx-20">
                                                            <div class="col-12 form-group">
                                                                <label for="reply_content_{{ $comment->id }}"
                                                                    class="visually-hidden">Your Reply *</label>
                                                                <textarea style="background: rgba(var(--second-theme-color-rgb), 0.07);" id="reply_content_{{ $comment->id }}"
                                                                    name="content" class="form-control @error('content') is-invalid @enderror" placeholder="Your Reply *" required
                                                                    aria-required="true">{{ old('content') }}</textarea>
                                                                @error('content')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            @guest
                                                                <div class="col-md-6 form-group">
                                                                    <label for="reply_name_{{ $comment->id }}"
                                                                        class="visually-hidden">Your Name *</label>
                                                                    <input
                                                                        style="background: rgba(var(--second-theme-color-rgb), 0.07);"
                                                                        id="reply_name_{{ $comment->id }}" type="text"
                                                                        name="name"
                                                                        class="form-control @error('name') is-invalid @enderror"
                                                                        placeholder="Your Name *" required
                                                                        aria-required="true" />
                                                                    @error('name')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="reply_email_{{ $comment->id }}"
                                                                        class="visually-hidden">Your Email *</label>
                                                                    <input
                                                                        style="background: rgba(var(--second-theme-color-rgb), 0.07);"
                                                                        id="reply_email_{{ $comment->id }}" type="email"
                                                                        name="email"
                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                        placeholder="Your Email *" required
                                                                        aria-required="true" />
                                                                    @error('email')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            @endguest

                                                            @auth
                                                                <input type="hidden" name="name"
                                                                    value="{{ auth()->user()->name }}">
                                                                <input type="hidden" name="email"
                                                                    value="{{ auth()->user()->email }}">
                                                                <div class="col-12 form-group">
                                                                    <p>Replying as: <strong>{{ auth()->user()->name }}</strong>
                                                                    </p>
                                                                </div>
                                                            @endauth

                                                            <div class="col-12 form-group mb-0">
                                                                <button type="submit" class="vs-btn"
                                                                    style="background-color: #bb5e2a; color: white;">Submit
                                                                    Reply</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                                <!-- Recursive call for replies -->
                                                @if ($comment->replies->count() > 0)
                                                    <ul class="custom-ul children">
                                                        @foreach ($comment->replies as $reply)
                                                            <li class="vs-comment-item">
                                                                <div class="vs-post-comment">
                                                                    <div class="vs-post-comment-inner">
                                                                        <div class="comment-avater">
                                                                            @if ($reply->email === config('mail.admin_email'))
                                                                                <!-- Admin Avatar -->
                                                                                <img src="{{ asset('assets/img/blog/mounir-akajia-morocco-quest-admin-main-blog-author.webp') }}"
                                                                                    alt="Admin"
                                                                                    class="img-fluid avatar-rounded" />
                                                                            @else
                                                                                @php
                                                                                    $hash = md5(
                                                                                        strtolower(trim($reply->email)),
                                                                                    );
                                                                                    $gravatarUrl = "https://www.gravatar.com/avatar/$hash?s=80&d=404";
                                                                                    $firstLetter = strtoupper(
                                                                                        substr($reply->name, 0, 1),
                                                                                    );
                                                                                    $lastLetter = strtoupper(
                                                                                        substr(
                                                                                            strrchr($reply->name, ' '),
                                                                                            1,
                                                                                            1,
                                                                                        ),
                                                                                    );

                                                                                    // Generate random background color
                                                                                    $colors = [
                                                                                        '#F97316',
                                                                                        '#0EA5E9',
                                                                                        '#64748B',
                                                                                        '#1E3A8A',
                                                                                        '#F59E0B',
                                                                                    ];
                                                                                    $backgroundColor =
                                                                                        $colors[array_rand($colors)];
                                                                                @endphp

                                                                                <img src="{{ $gravatarUrl }}"
                                                                                    alt="{{ $reply->name }}"
                                                                                    class="img-fluid avatar-rounded"
                                                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />

                                                                                <div class="avatar-placeholder"
                                                                                    style="display: none; background-color: {{ $backgroundColor }};">
                                                                                    {{ $firstLetter }}{{ $lastLetter }}
                                                                                </div>
                                                                            @endif
                                                                        </div>

                                                                        <div class="comment-content">
                                                                            <div class="content-header">
                                                                                <h5 class="name">
                                                                                    {{ $reply->name === env('ADMIN_EMAIL') ? 'Admin' : $reply->name }}
                                                                                </h5>
                                                                                <span
                                                                                    class="commented-on">{{ $reply->created_at->format('d M Y') }}</span>
                                                                            </div>
                                                                            <p class="text">
                                                                                {{ $reply->content }}
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="reply_and_edit">
                                                                        <a href="javascript:void(0);" class="replay-btn"
                                                                            data-id="{{ $reply->id }}">
                                                                            Reply <i class="fa-solid fa-reply"></i>
                                                                        </a>
                                                                    </div>

                                                                    <!-- Reply Form -->
                                                                    <div id="reply-form-{{ $reply->id }}"
                                                                        class="reply-form mt-3"
                                                                        style="display: none; margin-left: 50px;">
                                                                        <form
                                                                            action="{{ route('blog.comments.reply', ['id' => $comment->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="row gx-20">
                                                                                <div class="col-12 form-group">
                                                                                    <label
                                                                                        for="reply_content_{{ $reply->id }}"
                                                                                        class="visually-hidden">Your Reply
                                                                                        *</label>
                                                                                    <textarea style="background: rgba(var(--second-theme-color-rgb), 0.07);" id="reply_content_{{ $reply->id }}"
                                                                                        name="content" class="form-control @error('content') is-invalid @enderror" placeholder="Your Reply *" required
                                                                                        aria-required="true">{{ old('content') }}</textarea>
                                                                                    @error('content')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>

                                                                                @guest
                                                                                    <div class="col-md-6 form-group">
                                                                                        <label
                                                                                            for="reply_name_{{ $reply->id }}"
                                                                                            class="visually-hidden">Your Name
                                                                                            *</label>
                                                                                        <input
                                                                                            style="background: rgba(var(--second-theme-color-rgb), 0.07);"
                                                                                            id="reply_name_{{ $reply->id }}"
                                                                                            type="text" name="name"
                                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                                            placeholder="Your Name *" required
                                                                                            aria-required="true" />
                                                                                        @error('name')
                                                                                            <div class="invalid-feedback">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-md-6 form-group">
                                                                                        <label
                                                                                            for="reply_email_{{ $reply->id }}"
                                                                                            class="visually-hidden">Your Email
                                                                                            *</label>
                                                                                        <input
                                                                                            style="background: rgba(var(--second-theme-color-rgb), 0.07);"
                                                                                            id="reply_email_{{ $reply->id }}"
                                                                                            type="email" name="email"
                                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                                            placeholder="Your Email *" required
                                                                                            aria-required="true" />
                                                                                        @error('email')
                                                                                            <div class="invalid-feedback">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                @endguest

                                                                                @auth
                                                                                    <input type="hidden" name="name"
                                                                                        value="{{ auth()->user()->name }}">
                                                                                    <input type="hidden" name="email"
                                                                                        value="{{ auth()->user()->email }}">
                                                                                    <div class="col-12 form-group">
                                                                                        <p>Replying as:
                                                                                            <strong>{{ auth()->user()->name }}</strong>
                                                                                        </p>
                                                                                    </div>
                                                                                @endauth

                                                                                <div class="col-12 form-group mb-0">
                                                                                    <button type="submit" class="vs-btn"
                                                                                        style="background-color: #bb5e2a; color: white;">Submit
                                                                                        Reply</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                    <!-- Recursive call again -->
                                                                    @if ($reply->replies->count() > 0)
                                                                        @include('partials.comment', [
                                                                            'comment' => $reply,
                                                                        ])
                                                                    @endif
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif


                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>




                            <div class="vs-comment-form">
                                <div id="respond" class="comment-respond">
                                    <div class="form-title">
                                        <h4 class="blog-inner-title">Leave a Comment</h4>
                                        <p class="form-text">
                                            Your email address will not be published. Required fields are marked <span
                                                aria-label="required">*</span>
                                        </p>
                                        @if (session('success'))
                                            <div class="alert alert-success mt-2">{{ session('success') }}</div>
                                        @endif
                                        @if ($errors->any() && !$errors->hasAny(['content', 'name', 'email']))
                                            <div class="alert alert-danger mt-2">Please check the form below for errors.
                                            </div>
                                        @endif
                                    </div>

                                    <form action="{{ route('comments.store', $post) }}" method="POST">
                                        @csrf
                                        <div class="row gx-20">
                                            <div class="col-12 form-group">
                                                <label for="comment_content" class="visually-hidden">Your Comment
                                                    *</label>
                                                <textarea id="comment_content" name="content" class="form-control @error('content') is-invalid @enderror"
                                                    placeholder="Your Comment *" required aria-required="true">{{ old('content') }}</textarea>
                                                @error('content')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            @guest
                                                <div class="col-md-6 form-group">
                                                    <label for="comment_name" class="visually-hidden">Your Name *</label>
                                                    <input id="comment_name" type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        placeholder="Your Name *" value="{{ old('name') }}" required
                                                        aria-required="true" />
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="comment_email" class="visually-hidden">Your Email *</label>
                                                    <input id="comment_email" type="email" name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        placeholder="Your Email *" value="{{ old('email') }}" required
                                                        aria-required="true" />
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endguest

                                            @auth
                                                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                                <div class="col-12 form-group">
                                                    <p>Commenting as: <strong>{{ auth()->user()->name }}</strong></p>
                                                </div>
                                            @endauth

                                            <div class="col-12 form-group mb-0">
                                                <button type="submit" class="vs-btn">Post Comment</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <aside class="col-lg-4 sidebar-area">
                    <div class="widget widget_search">
                        <h5 class="widget_title title-shep">Search Blog</h5>
                        <form class="search-form" action="{{ route('blog.search') }}" method="GET" role="search">
                            <label for="sidebar-search" class="visually-hidden">Search blog posts</label>
                            <input id="sidebar-search" type="text" name="query" placeholder="Search here..."
                                value="{{ request('query') ?? '' }}" aria-label="Search blog posts" />
                            <button type="submit" aria-label="Submit search"><i class="far fa-search"></i></button>
                        </form>
                    </div>
                    @isset($recentBlogs)
                        @if ($recentBlogs->count() > 0)
                            <div class="widget widget_recent-posts">
                                <h5 class="widget_title title-shep">Recent Posts</h5>
                                <div class="recent-post-wrap">
                                    @foreach ($recentBlogs as $recent)
                                        <div class="recent-post">
                                            <div class="media-img">
                                                <a href="{{ route('blog.show', $recent->slug) }}"
                                                    aria-label="Read more about {{ $recent->title }}">
                                                    @php
                                                        $recentImagePath = $recent->featured_image;
                                                        $defaultImage = asset('assets/img/blog/recent-post-1-1.png');
                                                        $recentImage = $defaultImage;

                                                        if ($recentImagePath) {
                                                            $normalizedPath = str_replace('\\', '/', $recentImagePath);

                                                            if (strpos($normalizedPath, 'public/storage/') !== false) {
                                                                $relativePath = Str::after(
                                                                    $normalizedPath,
                                                                    'public/storage/',
                                                                );
                                                                $recentImage = asset(
                                                                    'public/storage/' . ltrim($relativePath, '/'),
                                                                );
                                                            } elseif (
                                                                file_exists(public_path('storage/' . $normalizedPath))
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
                                                    <a href="{{ route('blog.show', $recent->slug) }}"
                                                        aria-label="View post {{ $recent->title }} published on {{ $recent->created_at->format('F d, Y') }}">
                                                        <i class="fa-solid fa-calendar" aria-hidden="true"></i>
                                                        <time
                                                            datetime="{{ $recent->created_at->toIso8601String() }}">{{ $recent->created_at->format('F d, Y') }}</time>
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
                    @isset($categories)
                        @if ($categories->count() > 0)
                            <div class="widget widget_categories">
                                <h5 class="widget_title title-shep">Categories</h5>
                                <ul class="custom-ul">
                                    @foreach ($categories as $category)
                                        <li>
                                            @if ($category->slug && Route::has('category.show'))
                                                <a
                                                    href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                                            @else
                                                {{ $category->name }}
                                            @endif
                                            <span>({{ $category->blogs_count ?? 0 }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endisset
                    @isset($tags)
                        @if ($tags->count() > 0)
                            <div class="widget widget_meta">
                                <h5 class="widget_title title-shep">Popular Tags</h5>
                                <div class="tagcloud">
                                    @foreach ($tags as $tag)
                                        @if ($tag->slug && Route::has('tag.show'))
                                            <a href="{{ route('tag.show', $tag->slug) }}" class="tag-cloud-link"
                                                aria-label="View posts tagged with {{ $tag->name }}">{{ $tag->name }}</a>
                                        @else
                                            <span class="tag-cloud-link">{{ $tag->name }}</span>
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
    </section>
    <style>
        .blog-single .blog-content .block-tag-cloud {
            display: block;
        }

        .dynamic-content-area.blog-text {
            text-align: justify;
        }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener for reply buttons
            document.addEventListener('click', function(e) {
                if (e.target.closest('.replay-btn')) {
                    const commentId = e.target.closest('.replay-btn').getAttribute('data-id');
                    const form = document.getElementById(`reply-form-${commentId}`);

                    if (form) {
                        form.style.display = (form.style.display === "none" || !form.style.display) ?
                            "block" : "none";
                    } else {
                        console.error(`Form with ID reply-form-${commentId} not found.`);
                    }
                }
            });
        });
    </script>


@endsection
