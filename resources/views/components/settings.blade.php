@props(['heading'])

<section class="max-w-4xl mx-auto py-8">
    <h1 class="text-lg font-bold mb-4 border-b-2 border-gray-400 pb-2">
        {{$heading}}
    </h1>

    <div class="flex flex-col sm:flex-row">
        <aside class="w-48">
            <h2 class="font-bold sm:mb-2">Links</h2>
            <ul class="mb-4">
                <li>
                    <a href="/admin/posts/create"
                       class="text-sm text-left {{request()->routeIs('post.create') ? 'text-blue-500' : ''}}">New
                        Post</a>
                </li>
                <li>
                    <a href="/admin/dashboard" class="text-sm text-left">Dashboard</a>
                </li>
            </ul>
        </aside>

        <main class="flex-1">
            <x-panel>
                {{$slot}}
            </x-panel>
        </main>
    </div>
</section>
