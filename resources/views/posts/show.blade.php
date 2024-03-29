@extends('layouts.app')

@section('content')

    <a href="/posts" class="btn btn-default">Go back</a>
    <h1>{{$post->title}}</h1>
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="">
    <br><br>
         <div><p>{!!$post->body!!}</p></div>
         <hr>
       <small>Created at: {{$post->created_at}} by {{$post->user->name}}</small><br>
        <small>Last updated: {{$post->updated_at}}</small>
        <hr>
        @if (Auth::user())
          {{--@if(!Auth::guest())--}}
          @if (Auth::user()->id == $post->user_id)

            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right' ])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
            <br><br>
          @endif
        @endif
@endsection
