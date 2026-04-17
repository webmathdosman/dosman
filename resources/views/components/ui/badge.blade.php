@props([
    'variant' => 'info',
])

@php
    $styles = [
        'info' => 'bg-brand-100 text-brand-700',
        'success' => 'bg-emerald-100 text-emerald-700',
        'warning' => 'bg-amber-100 text-amber-700',
        'danger' => 'bg-rose-100 text-rose-700',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium '.($styles[$variant] ?? $styles['info'])]) }}>
    {{ $slot }}
</span>
