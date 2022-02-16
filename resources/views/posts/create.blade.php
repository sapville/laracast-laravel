<x-layout>

    <div class="flex max-w-3xl m-auto flex-col sm:flex-row ">
        <aside class="sm:flex-1 sm:py-8 mx-auto">
            <h1 class="text-lg font-bold mb-4">Links</h1>
            <ul>
                <li>
                    <a href="/admin/posts/create" class="text-sm text-left px-3 {{request()->routeIs('post.create') ? 'text-blue-500' : ''}}">New Post</a>
                </li>
                <li>
                    <a href="/admin/dashboard" class="text-sm text-left px-3">Dashboard</a>
                </li>
            </ul>
        </aside>
        <section class="max-w-lg w-full mx-auto py-8">
            <h1 class="text-lg font-bold mb-4">
                Publish New Post
            </h1>
            <x-panel>
                <form method="POST" action="/admin/posts/create" enctype="multipart/form-data">
                    @csrf

                    <x-form.input-text name="title"/>
                    <x-form.input-textarea name="excerpt"/>
                    <x-form.input-textarea name="body"/>


                    <x-form.input-field>
                        <x-form.input-label name="category">Category</x-form.input-label>
                        <select id="category_id" name="category_id" class="border border-gray-400 text-sm" required>
                            @foreach(\App\Models\Category::all() as $category)
                                <option
                                    value="{{$category->id}}" {{$category->id == old('category_id') ? 'selected' : ''}}>{{ucwords($category->name)}}</option>
                            @endforeach
                        </select>
                        <x-form.input-error name="category"/>
                    </x-form.input-field>

                    <x-form.input-text name="thumbnail" type="file"/>

                    <x-sumbit-button>Publish</x-sumbit-button>
                </form>
            </x-panel>
        </section>
    </div>
</x-layout>
