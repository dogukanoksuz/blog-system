@extends('layouts.dogukan')
@section('pageTitle')
    Eposta Onaylama - {!! config('setting.Title') !!}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('E-posta adresinizi onaylayın') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('E-posta adresinize yeni bir doğrulama linki gönderildi.') }}
                            </div>
                        @endif

                        {{ __('Başlamadan önce e-postanızı kontrol edin') }}
                        {{ __('Eğer mailimizi almadıysanız') }}, <a
                            href="{{ route('verification.resend') }}">{{ __('buraya tıklayarak yenisini alabilirsiniz') }}</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
