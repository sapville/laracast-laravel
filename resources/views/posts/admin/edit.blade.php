<x-layout>
    <x-settings :heading="'Edit Post: '. $post->title" :maxWidth="'max-w-2xl'">
        <form method="POST" action="/admin/posts/{{$post->id}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input-text :name="'title'" value="{{old('title', $post->title)}}"/>
            <x-form.input-textarea :name="'excerpt'">{{old('excerpt', $post->excerpt)}}</x-form.input-textarea>
            <x-form.input-textarea :name="'body'">{{old('body', $post->body)}}</x-form.input-textarea>

            <x-form.input-field>
                <x-form.input-label :name="'category'">Category</x-form.input-label>
                <select id="category_id" name="category_id" class="border border-gray-200 text-sm rounded-md" required>
                    @foreach(\App\Models\Category::all() as $category)
                        <option
                            value="{{$category->id}}" {{$category->id == old('category_id', $post->category_id) ? 'selected' : ''}}>{{ucwords($category->name)}}</option>
                    @endforeach
                </select>
                <x-form.input-error :name="'category'"/>
            </x-form.input-field>

            <div
                class="flex sm:items-center sm:flex-row flex-col"
                x-data="{changed: false}"
            >
                <x-form.input-text
                    x-on:change="changed = true"
                    :name="'thumbnail'"
                    :required="''"
                    type="file"/>
                <div class="flex sm:flex-1 sm:justify-center w-full">
                    <img
                        x-show="! changed"
                        class="h-24 sm:pl-4"
                        src="{{$post->thumbnail}}" alt="Post Thumbnail">
                </div>
            </div>
            <x-form.button>Save Changes</x-form.button>
        </form>
    </x-settings>
</x-layout>
