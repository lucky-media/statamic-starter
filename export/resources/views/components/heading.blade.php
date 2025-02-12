@props([
    'size' => 'h1',
    'color' => 'black',
    'as' => 'h1',
    'sizes' => [
        'h1' => 'xl:text-6xl lg:text-5xl md:text-4xl text-3xl font-extrabold',
        'h2' => 'lg:text-5xl md:text-4xl text-3xl font-extrabold',
        'h3' => 'md:text-4xl text-3xl font-extrabold',
        'h4' => 'md:text-3xl text-2xl font-extrabold',
        'h5' => 'md:text-2xl text-xl font-semibold',
        'h6' => 'md:text-xl text-lg font-medium',
    ],
    'colors' => [
        'black' => 'text-black',
        'white' => 'text-white',
        'gray' => 'text-gray-900',
        'purple' => 'text-purple-950',
    ],
])

@php
    $classes = $sizes[$size] . ' ' . $colors[$color];
@endphp

<{{ $as }} {{ $attributes->twMerge(["class" => $classes]) }}>
    {{ $slot }}
</{{ $as }}>
