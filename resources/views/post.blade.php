<x-layout>
    <article>
        <h1>{{$blogPost->title}}</h1>
        <p>By <a href="/authors/{{$blogPost->author->username}}">{{$blogPost->author->name}}</a> in <a href="/categories/{{$blogPost->category->slug}}">{{$blogPost->category->name}}</a></p>
        <div>
            <p>{{$blogPost->body}}</p>
        </div>
    </article>
    <a href="/">Go Back</a>
</x-layout>
