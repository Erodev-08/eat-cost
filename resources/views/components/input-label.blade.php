@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-xs text-gray-800 uppercase tracking-wider mb-1.5']) }}>
    {{ $value ?? $slot }}
</label>
