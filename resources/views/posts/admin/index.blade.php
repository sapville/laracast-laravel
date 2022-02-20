<x-layout>
    <x-settings :heading="'Dashboard'" :maxWidth="'max-w-6xl'" class="min-w-0">
        <div class="flex flex-col py-2">
            <div class="-my-2 overflow-x-auto">
                <div class="py-2 align-middle inline-block min-w-full px-2">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($posts as $post)
                                <tr>
                                    <td class="min-w-max pl-3 py-4 whitespace-nowrap hidden sm:block">
                                        <img class="h-10 w-10 rounded-xl" src="{{$post->thumbnail}}" alt="">
                                    </td>
                                    <td class="pl-3 sm:pl-0 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{$post->title}}</div>
                                    </td>
                                    <td class="pl-3 sm:pl-0 py-4 whitespace-nowrap hidden sm:table-cell">
                                        @php
                                            $datetime = new DateTime($post->updated_at);
                                        @endphp
                                        <div class="text-sm text-gray-900"><time datetime="{{$datetime->format('o-m-d')}}">{{($datetime)->format('M j o')}}</time></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                        <x-category-label :category="$post->category"/>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Admin</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-settings>
</x-layout>
