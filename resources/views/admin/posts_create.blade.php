@extends('layouts.admin')

@section('pageTitle')
    Yeni Yazı Oluştur - {!! config('setting.Title') !!}
@endsection

@section('adminContent')

    @if(isset($error))
        <div class='alert alert-danger' role='alert'>
            {{ $error }}
        </div>
    @endif
    <div class='card'>
        <div class='card-header'>Yeni Yazı Oluştur</div>

        <div class='card-body'>
            {{ Form::open(['url' => route('posts.store'), 'method' => 'post', 'files' => true]) }}
            {{ Form::bsText('title', 'Başlık', '', ['autocomplete' => 'off'])}}
            {{ Form::bsTextarea('content', ' ', null, ['class' => 'tinymce form-control', 'name' => 'content']) }}<br>
            {{ Form::bsCheckbox('categories', 'Kategoriler', $categorySelect) }}<br>
            <div class="form-group mb-3">
                <label for="tags" class="control-label">Etiketler</label>
                <input name="tags" id="input-tags" class="form-control" style="height:40px;"/>
            </div>
            <br>
            {{ Form::bsTextarea('content', 'SEO Açıklama', null, ['class' => 'form-control', 'name' => 'seo_description']) }}
            <br>
            <br>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="thumbnail" name="filepath">
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
