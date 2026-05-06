<?php echo '<?xml version="1.0" encoding="UTF-8"?>'."\n"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap-0.9">
    {{-- Static pages --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/about') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ url('/contact') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ url('/tours') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ url('/destinations') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/activity-categories') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/activities') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/blog') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/trips') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>

    {{-- Tours --}}
    @foreach($tours as $tour)
    <url>
        <loc>{{ url('/tours/'.$tour->slug) }}</loc>
        <lastmod>{{ optional($tour->updated_at)->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach

    {{-- Activities --}}
    @foreach($activities as $activity)
    <url>
        <loc>{{ url('/activity/'.$activity->slug) }}</loc>
        <lastmod>{{ optional($activity->updated_at)->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- Activity categories --}}
    @foreach($activityCategories as $cat)
    <url>
        <loc>{{ url('/activities/category/'.$cat->slug) }}</loc>
        <lastmod>{{ optional($cat->updated_at)->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    {{-- Blogs --}}
    @foreach($blogs as $blog)
    <url>
        <loc>{{ url('/blog/'.$blog->slug) }}</loc>
        <lastmod>{{ optional($blog->updated_at)->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    {{-- Blog categories --}}
    @foreach($categories as $cat)
    <url>
        <loc>{{ url('/category/'.$cat->slug) }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    @endforeach

    {{-- Tags --}}
    @foreach($tags as $tag)
    <url>
        <loc>{{ url('/tag/'.$tag->slug) }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.4</priority>
    </url>
    @endforeach

    {{-- Places --}}
    @foreach($places as $place)
    <url>
        <loc>{{ url('/tours?place='.$place->slug) }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
</urlset>
