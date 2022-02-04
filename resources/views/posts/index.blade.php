<x-layout>

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

        @include('posts._header')
        @if($blogPosts->count())
            <x-posts-grid :blogPosts="$blogPosts"></x-posts-grid>
        @else
            <p class="text-center">No posts yet</p>
        @endif
        {{$blogPosts->onEachSide(1)->links()}}
    </main>

</x-layout>
