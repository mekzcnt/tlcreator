@extends('layouts.master')

@section('title', htmlentities($post->title))

@section('code_head')
    <meta property="og:url"          content="/timeline/{{$post->id}}" />
    <meta property="og:type"         content="article" />
    <meta property="og:title"        content="{{$post->title}}" />
    <meta property="og:description"  content="{{$post->description}}" />
    <meta property="og:image"        content="{{$post->photo->file}}" />

    <link title="timeline-styles" rel="stylesheet" href="https://cdn.knightlab.com/libs/timeline3/latest/css/timeline.css">

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

    <div id='timeline-embed' style="width: 100%; height: 600px"></div>

    <hr>
    <p><strong>Description :</strong></p>
    <p>{{$post->description}}</p>
    <hr>
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

                  @if(Auth::check())
                  <div class="comment-reply-container">

                      <button class="toggle-reply btn btn-primary">Reply</button>

                      <div class="comment-reply well">
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
                  @endif

                  @if(count($comment->replies) > 0)

                      @foreach($comment->replies as $reply)

                          @if($reply->is_active == 1)
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
                            @endif

                      @endforeach

                  @endif

              </div>
          </div>
          @endforeach
  @endif
  </div>

@endsection

@section('code_foot')

  <script src="https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js"></script>

  <script type="text/javascript">
    function make_the_json() {
      var obj = json_decode('{{$post->timeline}}');
      return obj;
    }
    var timeline_json = make_the_json(); // you write this part
    // two arguments: the id of the Timeline container (no '#')
    // and the JSON object or an instance of TL.TimelineConfig created from
    // a suitable JSON object
    window.timeline = new TL.Timeline('timeline-embed', timeline_json);
  </script>

  <script>
    $(".comment-reply-container .toggle-reply").click(function(){
      $(this).next().slideToggle("slow");
    });

    $(document).ready(function(){
      var my_posts = $("[rel=tooltip]");

      var size = $(window).width();
        for(i=0;i<my_posts.length;i++){
      		the_post = $(my_posts[i]);

      		if(the_post.hasClass('invert') && size >=767 ){
      			the_post.tooltip({ placement: 'left'});
      			the_post.css("cursor","pointer");
      		}else{
      			the_post.tooltip({ placement: 'rigth'});
      			the_post.css("cursor","pointer");
    		}
    	}
    });
  </script>

@endsection
