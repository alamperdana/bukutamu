@props(['name', 'label' => null, 'value' => '', 'id' => $name, 'help' => null])
<label for="{{ $id }}" class="form-label">{{ $label }}</label>
<textarea id="{{ $id }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }}>{{ $value }}</textarea>
@if ($help)
    <div id="{{ $id ?? $name }}-help" class="form-text text-muted mt-1">
        {{ $help }}
    </div>
@endif