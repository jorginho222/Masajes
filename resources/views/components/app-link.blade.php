@props(['active'])

@php
$classes = 'bg-indigo-500 inline-flex items-center px-3 py-2 text-lg font-medium leading-5 text-white hover:bg-indigo-600 hover:text-gray-100 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>