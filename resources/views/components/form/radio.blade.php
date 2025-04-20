@props(['name', 'label', 'value' => '', 'options', 'inline' => false])
<label class="form-label d-block">{{ $label }}</label>
@foreach ($options as $key => $optionValue)
    <div class="form-check {{ $inline ? 'form-check-inline' : '' }} mt-2">
        <input class="form-check-input" {{ $value == $optionValue ? 'checked' : '' }} type="radio"
            name="{{ $name }}" id="{{ $optionValue . $key }}" value="{{ $optionValue }}">
        <label for="{{ $optionValue . $key }}" class="form-check-label">{{ $key }}</label>
    </div>
@endforeach
