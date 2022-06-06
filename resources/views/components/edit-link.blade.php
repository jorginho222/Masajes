@props(['active'])

@php
$classes = 'px-3 py-1 bg-indigo-100 border-2 border-indigo-600 rounded-md text-indigo-600 hover:bg-indigo-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>