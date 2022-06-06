@props(['active'])

@php
$classes = 'py-2 px-6 bg-indigo-100 text-indigo-500 border-2 border-indigo-500 font-medium rounded hover:bg-indigo-200 cursor-pointer ease-in-out duration-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>