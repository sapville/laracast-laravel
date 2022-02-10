@auth
    <x-panel>
        <form
            method="POST" action="/posts/{{$blogPost->slug}}/comment">
            @csrf

            <header class="flex items-center">
                <img src="https://i.pravatar.cc/60?u={{auth()->id()}}" alt="avatar" width="40"
                     height="40"
                     class="rounded-full">
                <h2 class="ml-4">Want to participate?</h2>
            </header>

            <div class="mt-6">
                <textarea
                    class="w-full text-sm focus:outline-none focus:ring" rows="5"
                    name="body"
                    required
                    placeholder="Quick, think of something to say!"></textarea>
            </div>

            @error('body')
            <span class="text-xs text-red-500">{{$message}}</span>
            @enderror
            <x-sumbit-button>Post</x-sumbit-button>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/login" class="text-blue-500 hover:underline">Log In </a>
        or
        <a href="/register" class="text-blue-500 hover:underline"> Register </a>
        to leave a comment.</p>
@endauth
