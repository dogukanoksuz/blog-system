@extends('layouts.admin')

@section('pageTitle')
    Site Ayarları - {!! config('setting.Title') !!}
@endsection

@section('adminContent')
    @if (isset($error))
        <div class="alert alert-success" role="alert">
            {{ $error }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">{{ __('Site Ayarları') }}</div>

        <div class="card-body">
            {{ Form::open(['url' => route('admin/settings/store'), 'method' => 'post']) }}
            @foreach ($settings as $setting)
                @if($setting->name !== 'Social Links')
                    {{ Form::bsText($setting->name, trans('custom.' . $setting->name), $setting->value, ['autocomplete' => 'off'])}}
                @else
                    {{ Form::bsSubmit('Kaydet') }}
        </div>
    </div>
    <div class="card">
        <div class="card-header">{{ __('Sosyal Medya Ayarları') }}</div>

        <div class="card-body">
                    @php
                        $new = json_decode($setting->value, JSON_PRETTY_PRINT)
                    @endphp
                    @foreach ($new as $key => $val)
                        {{ Form::bsText($key, trans('custom.' . $key), $val, ['autocomplete' => 'off']) }}
                    @endforeach
                @endif

            @endforeach

            {{ Form::bsSubmit('Kaydet') }}
            {{ Form::close() }}
        </div>
    </div>
@endsection
