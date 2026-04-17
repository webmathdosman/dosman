@props([
    'variant' => 'primary',
])

@php
    $baseClasses = 'inline-flex items-center rounded-lg px-4 py-2 text-sm font-semibold transition';
    $variantClasses = $variant === 'secondary'
        ? 'bg-white text-gray-700 ring-1 ring-gray-300 hover:bg-gray-50'
        : 'bg-brand-600 text-white hover:bg-brand-700';
@endphp

<button {{ $attributes->merge(['type' => 'button', 'class' => $baseClasses.' '.$variantClasses]) }}>
    {{ $slot }}
</button>
