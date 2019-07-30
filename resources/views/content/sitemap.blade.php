@php
    echo '<?xml version="1.0" encoding="UTF-8"?>';
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('index') }}</loc>
        <lastmod>{{ $posts->first()->created_at->toAtomString() }}</lastmod>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>

    @foreach($posts as $post)
        <url>
            <loc>{{ route('posts', $post->slug) }}</loc>
            <lastmod>{{ $post->created_at->toAtomString() }}</lastmod>
            <changefreq>Daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach($categories as $category)
        <url>
            <loc>{{ route('category', $category->slug) }}</loc>
            @if ($category->post()->first() != null)
                <lastmod>{{ $category->post()->orderBy('created_at', 'desc')->first()->created_at->toAtomString() }}</lastmod>
            @endif
            <changefreq>Daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

    @foreach($pages as $page)
        <url>
            <loc>{{ route('pages', $page->slug) }}</loc>
            <lastmod>{{ $now }}</lastmod>
            <changefreq>Weekly</changefreq>
            <priority>0.4</priority>
        </url>
    @endforeach

    @foreach($tags as $tag)
        <url>
            <loc>{{ route('tags', $tag->slug) }}</loc>
            <lastmod>{{ $tag->created_at->toAtomString() }}</lastmod>
            <changefreq>Daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

</urlset>
