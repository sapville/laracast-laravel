@extends('layout')

@section('content')
<article>
    <h1>{{$blogPost->title}}</h1>
    <div>
        {!!$blogPost->body!!}
    </div>
</article>
<a href="/">Go Back</a>
@endsection
