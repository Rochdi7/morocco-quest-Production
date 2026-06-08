@extends('layouts.app')

@section('title', $title ?? $category->name . ' | Morocco Travel Blog | Morocco Quest')
@section('description', $description ?? 'Latest articles on ' . $category->name . '. Read morocco tour guides, itineraries, sahara desert tours from Marrakech and morocco day trips.')
@section('keywords', $keywords ?? 'morocco travel blog, morocco tour package, private morocco tours, sahara desert tours morocco, ' . Str::lower($category->name))

@push('jsonld')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => url('/blog')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $category->name ?? 'Category', 'item' => url()->current()],
    ],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
    {{-- Main container for the category archive page --}}
    <div class="container py-5">
        {{-- H1: Main heading indicating the category being viewed --}}
        {{-- $category->name: Outputs the name of the current category. --}}
        <h1 class="mb-4">{{ $category->name }} - Morocco Travel & Private Tours</h1>

        {{-- Check if there are any blog posts in this category --}}
        @if ($blogs->count())
            {{-- Row containing the blog post cards --}}
            {{-- Schema.org CollectionPage added via JSON-LD in the 'structured_data' section --}}
            <div class="row">
                {{-- Loop through the paginated blog posts for the current page --}}
                @foreach ($blogs as $blog)
                    {{-- $blog->title: The title of the individual blog post. --}}
                    {{-- $blog->featured_image: Path to the featured image relative to storage/app/public. --}}
                    {{-- $blog->summary: A short summary of the post (if available). --}}
                    {{-- $blog->content: The full content of the post (used as fallback for summary). --}}
                    {{-- $blog->slug: The URL-friendly identifier for the post. --}}
                    <div class="col-md-4 mb-4">
                        <div class="card h-100"> {{-- Bootstrap card styling --}}
                            {{-- Check if a featured image exists for the post --}}

                            @if ($blog->featured_image)
                                @php
                                    $imagePath = $blog->featured_image;

                                    if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                                        $imageUrl = $imagePath;
                                    } elseif (Str::startsWith($imagePath, 'public/storage/')) {
                                        $imageUrl = asset($imagePath);
                                    } else {
                                        $imageUrl = asset('public/storage/' . ltrim($imagePath, '/'));
                                    }
                                @endphp

                                <img src="{{ $imageUrl }}" class="card-img-top" alt="{{ e($blog->title) }}" loading="lazy"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/img/blog/blog-placeholder.png') }}';" />
                            @else
                                <img src="{{ asset('assets/img/blog/blog-placeholder.png') }}" class="card-img-top"
                                    alt="{{ e($blog->title) }}" loading="lazy" />
                            @endif


                            <div class="card-body d-flex flex-column"> {{-- Added flex classes for button alignment --}}
                                {{-- Post Title (H5 is appropriate within a card) --}}
                                <h5 class="card-title">{{ e($blog->title) }}</h5>
                                {{-- Post Excerpt/Summary --}}
                                {{-- Uses summary if available, otherwise takes first 100 chars of content --}}
                                <p class="card-text">{{ Str::limit(strip_tags($blog->summary ?? $blog->content), 100) }}</p>
                                {{-- "Read More" Link - Pushed to bottom with mt-auto --}}
                                <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-primary mt-auto"
                                    aria-label="Read more about {{ e($blog->title) }}">Read Full Post</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination Links --}}
            <div class="d-flex justify-content-center mt-4"> {{-- Added margin top --}}
                {{-- $blogs->links(): Renders Laravel's pagination links --}}
                {{ $blogs->links() }}
            </div>
        @else
            {{-- Message displayed if no posts are found in this category --}}
            <p class="text-center mt-4">No articles found in the "{{ e($category->name) }}" category yet. Please check back
                later!</p>
            <div class="text-center mt-3">
                <a href="{{ route('blog.index') ?? url('/blog') }}" class="btn btn-secondary">View All Blog Posts</a>
            </div>
        @endif
    </div>
@endsection
