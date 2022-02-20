@props(['heading', 'maxWidth'])

<section class="{{$maxWidth}} mx-auto py-8">
    <h1 class="text-lg font-bold mb-4 border-b-2 border-gray-400 pb-2">
        {{$heading}}
    </h1>

    <div class="flex flex-col sm:flex-row">
        <aside class="w-36 flex-shrink-0">
            <h2 class="font-bold sm:mb-2">Links</h2>
            <ul class="mb-4">
                <li>
                    <a href="/admin/posts/create"
                       class="text-sm text-left {{request()->routeIs('post.create') ? 'text-blue-500' : ''}}">New
                        Post</a>
                </li>
                <li>
                    <a href="/admin/dashboard" class="text-sm text-left {{request()->routeIs('dashboard') ? 'text-blue-500' : ''}}">Dashboard</a>
                </li>
            </ul>
        </aside>

        <main {{$attributes->class(['flex-1'])}}>
            <x-panel>
                {{$slot}}
            </x-panel>
        </main>
    </div>
</section>
