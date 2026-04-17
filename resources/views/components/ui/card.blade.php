@props([
    'title' => '',
    'value' => '',
    'description' => '',
])

<div {{ $attributes->merge(['class' => 'rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200']) }}>
    <p class="text-sm font-medium text-gray-500">{{ $title }}</p>
    <p class="mt-2 text-3xl font-bold tracking-tight text-brand-600">{{ $value }}</p>
    <p class="mt-2 text-sm text-gray-600">{{ $description }}</p>
</div>
