<!doctype html>

<title>My Blog</title>
<link rel="stylesheet" href="{{'app.css'}}">

<body>
@foreach ($blogPosts as $post)
    <article>
        <h1><a href="{{"/posts/$post->slug"}}">{{$post->title}}</a></h1>
        <div>{{$post->excerpt}}</div>
    </article>
@endforeach
</body>
