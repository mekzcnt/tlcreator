@extends('layouts.master')

@section('title', 'Category: '.$categories->name)

@section('before_container')
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h1 id="title-page" class="text-center">Category: {{$categories->name}}</h1>
    <hr>
  </div>
</div>

<div class="row equal-height">
  @foreach($posts as $post)
  <div class="col-md-3 col-sm-6 hero-feature">
    <div class="thumbnail">
      <img src="{{$post->photo->file}}" alt="{{$post->title}}">
      <div class="caption">
        <h3><a href="{{route('feed.timeline', $post->id)}}">{{str_limit($post->title, 30)}}</a></h3>
        <p>{{str_limit($post->description, 60)}}</p>
        <p><a href="{{route('feed.timeline', $post->id)}}" class="btn btn-default">More Info</a></p>
      </div>
    </div>
  </div>
  @endforeach
</div>

<div class="row">
    <div class="col-sm-6 col-sm-offset-5">
        {{ $posts->render() }}
    </div>
</div>


@stop
