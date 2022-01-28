<!doctype html>

<title>My Post</title>
<link rel="stylesheet" href="{{'/app.css'}}">

<body>
<article>
    <h1>{{$blogPost->title}}</h1>
    <div>
        {!!$blogPost->body!!}
    </div>
</article>
<a href="/">Go Back</a>
</body>
