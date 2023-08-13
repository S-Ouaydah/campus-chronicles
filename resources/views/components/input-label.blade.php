@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 select-none']) }}>
    {{ $value ?? $slot }}
</label>
