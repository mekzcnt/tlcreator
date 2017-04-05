@extends('layouts.master')

@section('title', '')

@section('code_head')
    <meta property="og:url"          content="ใส่ด้วยอย่าลืม" />
    <meta property="og:type"         content="article" />
    <meta property="og:title"        content="{{$post->title}}" />
    <meta property="og:description"  content="{{$post->description}}" />
    <meta property="og:image"        content="{{$post->photo->file}}" />
@endsection

@section('before_container')
@endsection

@section('content')
<div class="container">
    <img class="img-responsive" src="{{$post->photo->file}}" alt=""><br>
    <h1 class="">{{$post->title}}</h1>
    <p class="lead">
        <span class="glyphicon glyphicon-user"></span> <a href="#">{{$post->user->name}}</a> |
        <span class="glyphicon glyphicon-time"></span> {{$post->created_at->diffForHumans()}}</span>
    </p>
    <hr>
    <p class="text-center"><img class="img-responsive" src="https://f.ptcdn.info/652/016/000/1394692365-updatetime-o.jpg"></p><br>
    <p><strong>Description :</strong></p>
    <p>{{$post->description}}</p>
</div>
@endsection

@section('comment')

  @if(Session::has('comment_message'))
    {{session('comment_message')}}
  @endif

  @if(Auth::check())
  <!-- Comments Form -->
  <div class="well">
      <h4>Leave a Comment:</h4>

      {!! Form::open(['method'=>'POST', 'action'=> 'PostCommentsController@store']) !!}

          <input type="hidden" name="post_id" value="{{$post->id}}">

           <div class="form-group">
               {!! Form::label('body', 'Comments:') !!}
               {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>3])!!}
           </div>

           <div class="form-group">
               {!! Form::submit('Submit comment', ['class'=>'btn btn-primary']) !!}
           </div>
      {!! Form::close() !!}
  </div>
  @endif

  <hr>



@endsection
