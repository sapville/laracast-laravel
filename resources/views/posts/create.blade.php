<x-layout>
    <section>
        <x-panel class="max-w-sm mx-auto py-10 mt-10">
            <form method="POST" action="/admin/posts/create">
                @csrf

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="title">Title</label>
                    <input class="border border-gray-400 p-2 w-full"
                           type="text" name="title" id="title" required
                           value="{{ old('title' )}}"
                    >
                    @error('title')
                    <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="excerpt">Excerpt</label>
                    <textarea class="border border-gray-400 p-2 w-full text-sm focus:outline-none focus:ring"
                           rows="3" name="excerpt" id="excerpt" required
                    >{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                    <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="body">Body</label>
                    <textarea class="border border-gray-400 p-2 w-full text-sm focus:outline-none focus:ring"
                              rows="6" name="body" id="body" required
                    >{{ old('body') }}</textarea>
                    @error('body')
                    <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="category_id">Category</label>
                    <select id="category_id" name="category_id" class="border border-gray-400 text-sm">
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{$category->id}}" {{$category->id == old('category_id') ? 'selected' : ''}}>{{ucwords($category->name)}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                </div>

                <x-sumbit-button>Publish</x-sumbit-button>
            </form>
        </x-panel>
    </section>
</x-layout>
