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
  <div class="">
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


                  <div class="comment-reply-container well">

                      <!-- <button class="toggle-reply btn btn-primary pull-right">Reply</button> -->

                      <div class="comment-reply col-sm-12">
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

                  </div>

                  @if(count($comment->replies) > 0)

                      @foreach($comment->replies as $reply)





                          <!-- Nested Comment -->
                          <div class="media">
                              <a class="pull-left" href="#">
                                  <img height="64" class="media-object" src="{{$reply->photo}}" alt="">
                              </a>
                              <div class="media-body">
                                  <h4 class="media-heading">{{$reply->author}}
                                      <small>{{$reply->created_at->diffForHumans()}}</small>
                                  </h4>
                                  <p>{{$reply->body}}</p>
                              </div>


                            </div>
                            <!-- End Nested Comment -->
                      @endforeach
                  @endif

              </div>
          </div>
          @endforeach
  @endif
  </div>

@endsection

@section('code_foot')
  <script>
    $(".comment-reply-container .toggle-reply").click(function(){
      $(this).next().slideToggle("slow");
    });
  </script>
@endsection
