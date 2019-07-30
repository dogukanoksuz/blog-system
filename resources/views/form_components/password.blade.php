<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
    {{ Form::label('password', 'Şifre', ['class' => 'control-label']) }}
    {{ Form::password($name, array_merge(['class' => 'form-control'], $attributes)) }}
    @if ($errors->has($name))
        <span class="help-block">
            <b>{{ $errors->first($name) }}</b>
        </span>
    @endif
</div>
