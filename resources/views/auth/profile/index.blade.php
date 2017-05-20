@extends('layouts.master')

@section('title', 'Your Profile')

@section('before_container')
@stop

@section('content')
    <div class="row">
      <div class="col-lg-12">
        <div class="card hovercard">
            <div class="card-background">
                <img class="card-bkimg" alt="" src="{{$currentUser->photo ? $currentUser->photo->file
                  : 'http://placehold.it/400x400' }}">
            </div>
            <div class="useravatar">
                <img alt="" src="{{$currentUser->photo ? $currentUser->photo->file
                  : 'http://placehold.it/400x400' }}">
            </div>
            <div class="card-info"> <span class="card-title">{{ $currentUser->name }}</span>
          </div>
        </div>
        <h1 id="title-page" class="text-center">My Timeline</h1>
        <hr>
      </div>
    </div>

    <div class="row equal-height">
        @if(count($posts) > 0)
            @foreach($posts as $post)
            <div class="col-md-3 col-sm-6 hero-feature">
              <div class="thumbnail">
                <img src="{{$post->photo->file}}" alt="{{$post->title}}">
                <div class="caption">
                  <h3><a href="{{route('feed.timeline', $post->id)}}">{{str_limit($post->title, 30)}}</a></h3>
                  <p>{{str_limit($post->description, 60)}}</p>
                  <p>
                      @if (Auth::user())
                        @if (Auth::user()->id == $currentUser->id)
                          <a href="{{route('feed.timeline', $post->id)}}" class="btn btn-default">View</a>

                                {!! Form::submit('Edit', ['class'=>'btn btn-warning']) !!}

                              {!! Form::open(['method'=>'DELETE', 'action'=> ['UserPostsController@destroy', $post->id]]) !!}
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                              {!! Form::close() !!}
                        @else
                          <a href="{{route('feed.timeline', $post->id)}}" class="btn btn-default">More Info</a>
                        @endif
                      @else
                        <a href="{{route('feed.timeline', $post->id)}}" class="btn btn-default">More Info</a>
                      @endif

                  </p>
                </div>
              </div>
            </div>
            @endforeach
        @endif
    </div>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{ $posts->render() }}
        </div>
    </div>
@stop
