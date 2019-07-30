@extends('layouts.dogukan')

@section('pageTitle')
{{ $page->title }} - {!! config('setting.Title') !!}@endsection
@section('pageDesc')
{!! substr(strip_tags($page->content), 0, 145) !!}@endsection
@section('content')
    <main id="Main">
        <div class="container">
            <div class="row">
                <section class="col-lg-8" id="Content">
                    <div class="homePageBox">
                        <div class="row">
                            <div class="col-12 postContent">
                                <h2 class="text-center">
                                    <a href="{{ route('pages', $page->slug) }}">{{ $page->title }}</a>
                                </h2>
                                <div class="homePageBoxDesc">
                                    {{ $page->user()->first()->name }} tarafından yayınlanmıştır.
                                </div>

                                <br>
                                {!! $page->content !!}
                            </div>
                        </div>
                    </div>
                </section>
                @include('layouts.sidebar')
            </div>
        </div>

    </main>
@endsection
