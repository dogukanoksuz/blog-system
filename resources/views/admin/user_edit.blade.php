@extends('layouts.admin')

@section('pageTitle')
    Kullanıcı Düzenle - {{ $user->name }} - {!! config('setting.Title') !!}
@endsection

@section('adminContent')

    @if(isset($error))
        <div class='alert alert-danger' role='alert'>
            {{ $error }}
        </div>
    @endif
    <div class='card'>
        <div class='card-header'>{{ $user->name }}</div>

        <div class='card-body'>
            {{ Form::model($user, ['route' => ['users.update', $user->id, ], 'method' => 'put']) }}
            {{ Form::bsText('name', 'İsim', $user->name, ['autocomplete' => 'off'])}}
            {{ Form::bsText('email', 'E-posta', $user->email, ['autocomplete' => 'off'])}}
            {{ Form::bsPassword('password', 'Şifre') }}
            {{ Form::bsCheckbox('role', 'Yetkiler', [
                ['text' => 'Root', 'value' => '1', 'is_checked' => $user->doesHavePermission('root')],
                ['text' => 'Author', 'value' => '2', 'is_checked' => $user->doesHavePermission('author')],
                ['text' => 'Standard User', 'value' => '3', 'is_checked' => $user->doesHavePermission('standard_user')],
            ]) }}
            {{ Form::bsSubmit('Kaydet') }}
            {{ Form::close() }}
        </div>
    </div>

@endsection
