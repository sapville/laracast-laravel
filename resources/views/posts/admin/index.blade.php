<x-layout>
    <x-settings :heading="'Dashboard'" :maxWidth="'max-w-6xl'" class="min-w-0">
        <div class="flex flex-col py-2">
            <div class="-my-2 overflow-x-auto">
                <div class="py-2 align-middle inline-block min-w-full px-2">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($posts as $post)
                                <tr class="flex flex-col sm:table-row">
                                    <td class="min-w-max pl-3 py-4 whitespace-nowrap hidden lg:block">
                                        <img class="h-10 rounded-xl" src="{{$post->thumbnail}}" alt="">
                                    </td>
                                    <td class="pl-3 sm:py-4 py-3 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <a
                                                href="/posts/{{$post->slug}}"
                                                class="hover:text-blue-500"
                                            >{{$post->title}}</a>
                                        </div>
                                    </td>
                                    <td class="pl-3 py-4 whitespace-nowrap hidden lg:table-cell">
                                        @php
                                            $datetime = new DateTime($post->updated_at);
                                        @endphp
                                        <div class="text-sm text-gray-900"><time datetime="{{$datetime->format('o-m-d')}}">{{($datetime)->format('M j o')}}</time></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                                        <x-category-label :category="$post->category"/>
                                    </td>
                                    <td class="px-6 sm:py-4 whitespace-nowrap text-sm font-medium text-blue-500">
                                        <a
                                            href="/admin/posts/{{$post->slug}}/edit"
                                        >Edit</a>
                                    </td>
                                    <td class="px-6 sm:py-4 py-3 whitespace-nowrap sm:text-right text-sm font-medium text-blue-500">
                                        <form method="POST" action="/admin/posts/{{$post->slug}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{$posts->links()}}
    </x-settings>
</x-layout>
