<x-layout>
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <a href="/back/{{$source}}"
           class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                <g fill="none" fill-rule="evenodd">
                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                    </path>
                    <path class="fill-current"
                          d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                    </path>
                </g>
            </svg>

            Back to Posts
        </a>
        <article
            class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10 {{ $blogPost->published_at ? '' : 'p-4 rounded-xl border-4 border-yellow-100'}}">
            <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                <img src="{{$blogPost->thumbnail}}" alt="Thumbnail" class="rounded-xl">

                <p class="mt-4 block text-gray-400 text-xs">
                    Published
                    <time>{{$blogPost->created_at->diffForHumans()}}</time>
                </p>

                <x-view-count :post="$blogPost"/>

                <div class="flex items-center lg:justify-center text-sm mt-4">
                    <img src="/images/lary-avatar.svg" alt="Lary avatar">
                    <div class="ml-3 text-left">
                        <x-author-link :author="$blogPost->author"/>
                    </div>
                </div>
            </div>

            <div class="col-span-8">
                <div class="hidden lg:flex justify-between mb-6">

                    <x-category-button :category="$blogPost->category"/>

                </div>

                <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                    {{$blogPost->title}}
                    @auth
                        <x-bookmark :post="$blogPost"/>
                    @endauth
                </h1>

                <div class="space-y-4 lg:text-lg leading-loose">
                    {!! $blogPost->body !!}
                </div>
            </div>

            <section class="col-span-8 col-start-5 mt-10 space-y-6">

                @include('posts._add-comment-form')

                @foreach($blogPost->comments as $comment)
                    <x-post-comment :comment="$comment"/>
                @endforeach
            </section>

        </article>
    </main>
</x-layout>
