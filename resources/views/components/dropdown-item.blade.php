@props(['active' => false])

@php
    $classes = 'block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white';
@endphp

<a
    {{$attributes->class([$classes, 'text-white bg-blue-500' => $active])}}
>{{$slot}}</a>
