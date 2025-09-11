@props(['name', 'label', 'value' => '', 'id' => $name, 'type' => 'text', 'help' => null])
<label for="{{ $id }}" class="form-label">{{ $label }}</label>
<input type="{{ $type }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'form-control']) }}
    name="{{ $name }}" value="{{ $value }}">
@if ($help)
    <div id="{{ $id ?? $name }}-help" class="form-text text-muted mt-1"> {{ $help }} </div>
@endif
