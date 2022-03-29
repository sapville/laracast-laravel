@props(['post'])
<a href="#" class="mt-2">
    <svg xmlns="http://www.w3.org/2000/svg"
         class="h-6 w-6 inline hover:shadow-md"
         fill="{{$post->bookmarks->firstWhere('id', '=', Auth::user()->id ?? '') ? 'gray' : 'none'}}"
         viewBox="0 0 24 24" stroke="gray"
         stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
    </svg>
</a>
