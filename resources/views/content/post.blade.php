@extends('layouts.dogukan')

@section('pageTitle')
    {{ $post->title }} - {!! config('setting.Title') !!}
@endsection
@section('pageDesc')@if($post->seo_description !== "") {{ $post->seo_description }} @else{{ config('setting.Title') }}@endif @endsection
@section('pageKeyword')@foreach ($post->tags()->get() as $tag){{$tag->name . ','}}@endforeach @endsection
@section('content')
    <main id="Main">
        <div class="container">
            <div class="row">
                <section class="col-lg-8" id="Content">
                    <div class="homePageBox">
                        <div class="row">
                            <div class="col-12 postContent">

                                <h2 class="text-center">
                                    <a href="{{ route('posts', $post->slug) }}">{{ $post->title }}</a>
                                </h2>
                                <div class="homePageBoxDesc">
                                    {{ $post->created_at->formatLocalized(' %d %B %Y') }} tarihinde
                                    @php
                                        $count = count($post->category()->get())
                                    @endphp
                                    @foreach ($post->category()->get() as $category)
                                        <a href="{{ route('category', $category->slug) }}">{{ $category->title }}</a>
                                        @php
                                            if (!(--$count <= 0)) {
                                                echo ',';
                                            }
                                        @endphp
                                    @endforeach
                                    kategorisinde {{ $post->user()->first()->name }} tarafından yayınlanmıştır.
                                </div>
                                <br>

                                {!! $post->content !!}

                                <br>
                                <div class="homePageBoxDesc">
                                    Etiketler:
                                    @php
                                        $count = count($post->tags()->get())
                                    @endphp
                                    @foreach ($post->tags()->get() as $tag)
                                        <a href="{{ route('tags', $tag->slug) }}">{{$tag->name}}</a>@php
                                            if (!(--$count <= 0)) {
                                                echo ',';
                                            }
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="disqus_thread"></div>
                    <br>
                </section>
                @include('layouts.sidebar')
            </div>
        </div>

    </main>
@endsection
