@props(['category'])
<x-category-badge>
    <a href="/?category={{$category->slug}}"
    >{{$category->name}}</a>
</x-category-badge>
