@extends('layouts.admin')

@section('pageTitle')
    Sayfayı Düzenle - {!! config('setting.Title') !!}
@endsection

@section('adminContent')

    @if(isset($error))
        <div class='alert alert-danger' role='alert'>
            {{ $error }}
        </div>
    @endif
    <div class='card'>
        <div class='card-header'>{{ $page->title }}</div>

        <div class='card-body'>
            {{ Form::open(['url' => route('pages.update', $page->id), 'method' => 'put']) }}
            {{ Form::bsText('title', 'Başlık', $page->title, ['autocomplete' => 'off'])}}
            {{ Form::bsText('slug', 'Link uzantısı', $page->slug, ['autocomplete' => 'off'])}}
            {{ Form::bsTextarea('content', ' ', $page->content, ['class' => 'tinymce form-control', 'name' => 'content']) }}
            {{ Form::bsSubmit('Kaydet') }}
            {{ Form::close() }}
        </div>
    </div>

@endsection
