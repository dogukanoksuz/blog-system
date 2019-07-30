@extends('layouts.admin')

@section('pageTitle')
Kategori Düzenle - {{ $category->name }} - {!! config('setting.Title') !!}
@endsection

@section('adminContent')

@if(isset($error))
<div class='alert alert-danger' role='alert'>
    {{ $error }}
</div>
@endif
<div class='card'>
    <div class='card-header'>Kategori Düzenle - {{ $category->title }}</div>

    <div class='card-body'>
        {{ Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'put']) }}
        {{ Form::bsText('title', 'İsim', $category->title, ['autocomplete' => 'off'])}}
        {{ Form::bsText('slug', 'Kısa Link', $category->slug, ['autocomplete' => 'off'])}}
        {{ Form::bsSubmit('Kaydet') }}
        {{ Form::close() }}
    </div>
</div>

@endsection
