@php
        header("Location: " . URL::to('/'), true, 302);
        exit();
@endphp

@extends('layouts.dogukan')
@section('pageTitle')
    Sayfa bulunamadı! - {{ config('setting.Title') }}
@endsection

@section('content')
    <div id="Main">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>404 Sayfa Bulunamadı!</h1>
                    <br>
                    <img src="{{ asset('dist/img/404.png') }}" alt="404 Not Found" style="max-height: 500px;">
                </div>
            </div>
        </div>
    </div>
@endsection
