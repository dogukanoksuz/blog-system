<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ Doğukan Öksüz ]]></title>
        <link><![CDATA[ https://dogukan.dev/rss.xml ]]></link>
        <description><![CDATA[ A developer diary ]]></description>
        <language>tr</language>
        <pubDate>{{ now() }}</pubDate>

        @foreach($posts as $post)
            <item>
                <title><![CDATA[{{ $post->title }}]]></title>
                <link>{{ route("posts", $post->slug) }}</link>
                <description><![CDATA[{!! $post->content !!}]]></description>
                <category>{{ $post->category()->get()[0]->title }}</category>
                <author><![CDATA[ Doğukan Öksüz ]]></author>
                <guid>{{ $post->id }}</guid>
                <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>