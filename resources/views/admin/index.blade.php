@extends('layouts.admin')

@section('pageTitle')
    Admin - {!! config('setting.Title') !!}
@endsection

@section('adminContent')
    <div class="card">
        <div class="card-header">{{ __('Hoşgeldiniz') }}</div>
        <div class="card-body">
            {{ config('setting.Title') }} admin paneline hoşgeldiniz. Sol menüden seçeneklere göz atabilirsiniz.
        </div>
    </div>
@endsection
