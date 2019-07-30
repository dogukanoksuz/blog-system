@extends('layouts.admin')

@section('pageTitle')
    Yeni Sayfa Oluştur - {!! config('setting.Title') !!}
@endsection

@section('adminContent')

    @if(isset($error))
        <div class='alert alert-danger' role='alert'>
            {{ $error }}
        </div>
    @endif
    <div class='card'>
        <div class='card-header'>Yeni Sayfa Oluştur</div>

        <div class='card-body'>
            {{ Form::open(['url' => route('pages.store'), 'method' => 'post']) }}
            {{ Form::bsText('title', 'Başlık', '', ['autocomplete' => 'off'])}}
            {{ Form::bsTextarea('content', ' ', null, ['class' => 'tinymce form-control', 'name' => 'content']) }}
            {{ Form::bsSubmit('Kaydet') }}
            {{ Form::close() }}
        </div>
    </div>

@endsection
