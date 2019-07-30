@extends('layouts.admin')

@section('pageTitle')
    Yeni Kullanıcı - {!! config('setting.Title') !!}
@endsection

@section('adminContent')

    @if(isset($error))
        <div class='alert alert-danger' role='alert'>
            {{ $error }}
        </div>
    @endif
    <div class='card'>
        <div class='card-header'>Yeni Kullanıcı Oluştur</div>

        <div class='card-body'>
            {{ Form::open(['url' => route('users.store'), 'method' => 'post']) }}
            {{ Form::bsText('name', 'İsim', '', ['autocomplete' => 'off'])}}
            {{ Form::bsText('email', 'E-posta', '', ['autocomplete' => 'off'])}}
            {{ Form::bsPassword('password', 'Şifre') }}
            {{ Form::bsSubmit('Kaydet') }}
            {{ Form::close() }}
        </div>
    </div>

@endsection
