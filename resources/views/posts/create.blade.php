<x-layout>
    <section>
        <x-panel class="sm:w-2/3 md:w-1/2 lg:w-5/12 w-5/6 mx-auto py-10 mt-10">
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
                           for="slug">Slug</label>
                    <input class="border border-gray-400 p-2 w-full"
                           type="text" name="slug" id="slug" required
                           value="{{ old('slug' )}}"
                    >
                    @error('slug')
                    <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="excerpt">Excerpt</label>
                    <textarea class="border border-gray-400 p-2 w-full text-xs focus:outline-none focus:ring"
                           rows="4" name="excerpt" id="excerpt" required
                    >{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                    <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                </div>


                <x-sumbit-button>Publish</x-sumbit-button>
            </form>
        </x-panel>
    </section>
</x-layout>
