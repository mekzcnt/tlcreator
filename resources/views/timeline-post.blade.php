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

  <!-- Posted Comments -->

  @if(count($comments) > 0)
          @foreach($comments as $comment)
          <!-- Comment -->
          <div class="media">
              <a class="pull-left" href="#">
                  <img height="64" class="media-object" src="{{$comment->photo}}" alt="">
              </a>
              <div class="media-body">
                  <h4 class="media-heading">{{$comment->author}}
                      <small>{{$comment->created_at->diffForHumans()}}</small>
                  </h4>
                  <p>{{$comment->body}}</p>
                  <!-- Nested Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Nested Start Bootstrap
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>

                        {!! Form::open(['method'=>'POST', 'action'=> 'CommentRepliesController@createReply']) !!}

                             <div class="form-group">
                                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                 {!! Form::label('body', 'Reply:') !!}
                                 {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>1])!!}
                             </div>

                             <div class="form-group">
                                 {!! Form::submit('Submit comment', ['class'=>'btn btn-primary']) !!}
                             </div>
                        {!! Form::close() !!}

                    </div>
                  <!-- End Nested Comment -->
              </div>
          </div>
          @endforeach
  @endif

@endsection
