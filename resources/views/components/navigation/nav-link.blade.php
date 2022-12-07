@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-red-600 transition duration-150 ease-in-out'
: 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 hover:text-red-600 focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes . " bg-tree-leaf"]) }}>
    {{ $slot }}
</a>