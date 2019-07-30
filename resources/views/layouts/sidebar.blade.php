<div class="col-lg-4" id="Sidebar">
    <div class="box">
        <h4 class="boxTitle">
            Kategoriler
        </h4>
        <ul class="categories">
            @foreach(App\Admin\Category::all() as $category)
                <li><a href="{{ route('category', $category->slug) }}">{{ $category->title }}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="box">
        <h4 class="boxTitle">
            Arama
        </h4>
        {{ Form::open(['url' => route('search'), 'method' => 'post']) }}
        {{ Form::bsText('searchquery', ' ', '', ['placeholder' => 'Arayacağınız kelime...'])}}
        {{ Form::bsSubmit('Arama') }}
        {{ Form::close() }}
    </div>
    <div class="box">
        <h4 class="boxTitle">
            Son Yazılar
        </h4>
        <ul class="latestPosts">
            @foreach(App\Admin\Post::paginate(3) as $post)
                <li><a href="{{ route('posts', $post->slug) }}">
                        <div class="row">
                            <div class="col-4 latestPostsImg"><img src="{{ asset($post->thumbnail_path) }}"
                                                                   alt="{{ $post->title }}">
                            </div>
                            <div class="col-8">
                                <h5>{{ $post->title }}</h5>
                                <p>{!! substr(strip_tags($post->content), 0, 15) !!}...</p>
                            </div>
                        </div>
                    </a></li>
            @endforeach
        </ul>
    </div>

    <div class="box">
        <h4 class="boxTitle">
            Etiketler
        </h4>
        <ul class="tagCloud">
            @foreach(\Spatie\Tags\Tag::orderBy('created_at', 'desc')->paginate(20) as $tag)
                <li><a href="{{ route('tags', $tag->slug) }}"><span>{{ $tag->name }}</span></a></li>
            @endforeach
        </ul>
    </div>
    <div class="d-block mb-5 row col-12"><br></div>
</div>
