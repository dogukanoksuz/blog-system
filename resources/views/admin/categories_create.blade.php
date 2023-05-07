@extends('layouts.admin')

@section('pageTitle')
    Yeni Kategori - {!! config('setting.Title') !!}
@endsection

@section('adminContent')

    @if(isset($error))
        <div class='alert alert-danger' role='alert'>
            {{ $error }}
        </div>
    @endif
    <div class='card'>
        <div class='card-header'>Yeni Kategori Oluştur</div>

        <div class='card-body'>
            {{ Form::open(['url' => route('categories.store'), 'method' => 'post']) }}
            {{ Form::bsText('title', 'Başlık', '', ['autocomplete' => 'off'])}}
            {{ Form::bsSubmit('Kaydet') }}
            {{ Form::close() }}
        </div>
    </div>

@endsection
