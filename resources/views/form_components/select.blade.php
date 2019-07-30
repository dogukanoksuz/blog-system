<div class="form-group">
    {{ Form::label($name, $label_name, ['class' => 'control-label']) }}
    {{ Form::select($name, $list, $value, ['placeholder' => $placeholder, 'class' => 'selectpicker', 'data-width' => '100%']) }}
</div>
