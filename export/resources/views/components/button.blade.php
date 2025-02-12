@props([
    'variant' => 'primary',
    'size' => 'base',
    'as' => 'button',
    'url' => null,
    'base' => [
        'group space-x-3',
        'font-medium uppercase rounded-2xl',
        'w-full inline-flex items-center justify-center',
        'transition ease-in-out duration-200'
    ],
    'variants' => [
        'primary' => 'bg-purple-950 text-white border-2 border-transparent hover:bg-transparent hover:backdrop-blur-md hover:border-purple-950 hover:text-purple-950',
        'outline' => 'bg-transparent backdrop-blur-md border-2 border-purple-950 text-purple-950 hover:bg-purple-950 hover:text-white',
    ],
    'sizes' => [
        'xs' => 'py-3 px-4',
        'sm' => 'px-2 py-1',
        'base' => 'px-4 py-3',
        'md' => 'py-5 px-8',
        'lg' => 'py-4 px-10',
    ],
])

@php
    $classes = implode(' ', $base) . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

@if($url)
    <a href="{{ $url }}" {{ $attributes->twMerge(["class" => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <{{ $as }} {{ $attributes->twMerge(["class" => $classes]) }}>
        {{ $slot }}
    </{{ $as }}>
@endif
