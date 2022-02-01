@props(['blogPosts'])
<x-featured-post :post="$blogPosts[0]"></x-featured-post>
@if($blogPosts->count() > 1)
    <div class="lg:grid lg:grid-cols-6">
        @foreach($blogPosts->skip(1) as $post)
            <x-post-card :post="$post" class="{{$loop->iteration < 3 ? 'col-span-3' : 'col-span-2'}}"></x-post-card>
        @endforeach
    </div>
@endif
