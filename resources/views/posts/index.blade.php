@extends('layouts.app')

@section('content')

  <h1>Posts</h1>

  <ul>
  @foreach ($posts as $post)

    <a href="{{$post->url}}"><li>{{$post->title}}</li></a>

  @endforeach
  </ul>

  {{$posts->render()}}
@endsection
