@props([
    'label' => null, 'value' => '', 'id' => 'select_' . rand(), 'placeholder' => $label, 'options', 'help' => null,
])
@if ($label)
    <label class="form-label">{{ $label }}</label>
@endif
<select {{ $attributes->merge(['class' => 'form-select']) }} id="{{ $id }}" aria-label="{{ $id }}"
    data-style="btn-default">
    <option selected value="">{{ $placeholder }}</option>
    @foreach ($options as $key => $item)
        <option value="{{ $item }}" @selected($value == $item)>{{ $key }}</option>
    @endforeach
    {{ $slot }}
</select>
