<x-layout>
    @foreach ($blogPosts as $blogPost)
        <article>
            <h1><a href="{{"/posts/$blogPost->slug"}}">{{$blogPost->title}}</a></h1>
            <p>By <a href="/authors/{{$blogPost->author->username}}">{{$blogPost->author->name}}</a> in <a href="/categories/{{$blogPost->category->slug}}">{{$blogPost->category->name}}</a></p>
            <div>{!! $blogPost->excerpt !!}</div>
        </article>
    @endforeach
</x-layout>
