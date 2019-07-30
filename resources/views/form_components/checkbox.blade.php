<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
    {{ Form::label($name, $label_name, ['class' => 'control-label']) }}
    <br>
    @foreach ($elements as $element)
        <label class="checkbox">
            <input type="checkbox" name="{{ $name }}[]" value="{{ $element['value'] }}" {{ $element['is_checked'] ? 'checked' : null }}> {{ $element['text'] }}
        </label>
        <br>
    @endforeach
</div>
