@extends('layouts.app')

@section('title', $category->name . ' | Best Morocco Itinerary - Morocco Quest')
@section('description', $category->name . ' articles on best morocco itinerary, marrakech desert tours, and morocco private tours.')
@section('keywords', 'best morocco itinerary, marrakech desert tours, morocco private tours, sahara desert tour from marrakech, ' . Str::lower($category->name))

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Articles in "{{ $category->name }}"</h2>

    @if ($blogs->count())
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($blog->featured_image)
                            <img src="{{ asset($blog->featured_image) }}" class="card-img-top" alt="{{ $blog->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ Str::limit($blog->summary, 100) }}</p>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-primary">Read more</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $blogs->links() }} {{-- pagination --}}
    @else
        <p>No articles found in this category.</p>
    @endif
</div>
@endsection
