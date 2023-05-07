@extends('layouts.admin')

@section('pageTitle')
    Yeni Yazı Düzenle - {!! config('setting.Title') !!}
@endsection

@section('adminContent')

    @if(isset($error))
        <div class='alert alert-danger' role='alert'>
            {{ $error }}
        </div>
    @endif
    <div class='card'>
        <div class='card-header'>{{ $post->title }}</div>

        <div class='card-body'>
            {{ Form::open(['url' => route('posts.update', $post->id), 'method' => 'put', 'files' => true]) }}
            {{ Form::bsText('title', 'Başlık', $post->title, ['autocomplete' => 'off'])}}
            {{ Form::bsText('slug', 'Link uzantısı', $post->slug, ['autocomplete' => 'off'])}}
            {{ Form::bsTextarea('content', ' ', $post->content, ['class' => 'tinymce form-control', 'name' => 'content']) }}
            <br>
            {{ Form::bsCheckbox('categories', 'Kategoriler', $categorySelect) }}<br>
            <div class="form-group mb-3">
                <label for="tags" class="control-label">Etiketler</label>
                <input name="tags" id="input-tags" class="form-control" style="height:40px;" value="
                    @foreach ($post->tags()->get() as $tag)
                {{$tag->name}},
                    @endforeach
                    "/>
            </div>
            <br>
            {{ Form::bsTextarea('content', 'SEO Açıklama', $post->seo_description, ['class' => 'form-control', 'name' => 'seo_description']) }}
            <br>
            <br>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="thumbnail" name="filepath"
                       placeholder="{{ $post->thumbnail_path }}">
                <div class="input-group-append">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fas fa-images"></i> Öne çıkan resim seçiniz
                    </a>
                </div>
            </div>
            <div class="text-center mb-3">
                <img id="holder" style="margin-top:15px;max-height:250px;">
            </div>
            {{ Form::bsSubmit('Kaydet') }}
            {{ Form::close() }}
        </div>
    </div>

@endsection
