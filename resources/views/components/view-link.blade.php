@props(['active'])

@php
$classes = 'px-3 py-1 bg-green-500 rounded-md text-white text-md uppercase hover:bg-green-600 hover:cursor-pointer';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>