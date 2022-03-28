@props(['post'])
<article
    {{
        $attributes->merge(
            ['class' => 'class="transition-colors duration-300 hover:bg-gray-100  rounded-xl ' .
            ($post->published_at ? 'border border-black border-opacity-0 hover:border-opacity-5' : 'border-4 border-yellow-100 m-0.5')]
        )}}>
    <div class="py-6 px-5">
        <div>
            <img src="{{$post->thumbnail}}" alt="Blog Post illustration" class="rounded-xl">
        </div>

        <div class="mt-8 flex flex-col justify-between">
            <header>

                <x-category-button :category="$post->category"/>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        <a href="/posts/{{$post->slug}}">{{$post->title}}</a>
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                                        Published <time>{{$post->created_at->diffForHumans()}}</time>
                                    </span>
                    <x-view-count :post="$post"/>
                </div>
            </header>

            <div class="text-sm mt-4 space-y-4">
                {!! $post->excerpt !!}
            </div>

            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <img src="/images/lary-avatar.svg" alt="Lary avatar">
                    <div class="ml-3">
                        <h5 class="font-bold">
                            <x-author-link :author="$post->author"/>
                        </h5>
                    </div>
                </div>

                <div>
                    <a href="/posts/{{$post->slug}}"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-6 inline-flex text-center"
                    >Read More</a>
                </div>
            </footer>
        </div>
    </div>
    <x-delete-button class="mr-5 mb-5" :post="$post"/>
</article>
