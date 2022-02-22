<x-layout>
    <x-settings :heading="'Publish New Post'" :maxWidth="'max-w-2xl'">
        <form method="POST" action="/admin/posts/create" enctype="multipart/form-data">
            @csrf

            <x-form.input-text :name="'title'"/>
            <x-form.input-textarea :name="'excerpt'">{{old('excerpt')}}</x-form.input-textarea>
            <x-form.input-textarea :name="'body'">{{old('body')}}</x-form.input-textarea>

            <x-form.input-field>
                <x-form.input-label :name="'category'">Category</x-form.input-label>
                <select id="category_id" name="category_id" class="border border-gray-200 text-sm rounded-md" required>
                    @foreach(\App\Models\Category::all() as $category)
                        <option
                            value="{{$category->id}}" {{$category->id == old('category_id') ? 'selected' : ''}}>{{ucwords($category->name)}}</option>
                    @endforeach
                </select>
                <x-form.input-error :name="'category'"/>
            </x-form.input-field>

            <x-form.input-text :name="'thumbnail'" type="file"/>

            <x-form.button>Publish</x-form.button>
        </form>
    </x-settings>
</x-layout>
