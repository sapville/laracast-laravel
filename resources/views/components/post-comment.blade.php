@props(['comment'])
<x-panel class="bg-gray-50">
    <article class="flex space-x-4">
        <div class="flex-shrink-0">
            <img src="https://i.pravatar.cc/60?u={{$comment->user_id}}" alt="avatar" width="60" height="60"
                 class="rounded-xl">
        </div>
        <div>
            <header class="mb-4">
                <h3 class="font-bold">{{$comment->author->name}}</h3>
                <p class="text-xs">
                    Posted
                    <time>{{$comment->created_at->diffForHumans()}}</time>
                </p>
            </header>
            <p>
                {{$comment->body}}
            </p>
        </div>
    </article>
    @if(auth()->id() === $comment->author->id)
        <form method="POST" class="flex justify-end" action="/comment-delete/{{$comment->id}}">
            @csrf
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:shadow-md" fill="none" viewBox="0 0 24 24"
                     stroke="grey">
                    <path stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </form>
    @endif
</x-panel>
