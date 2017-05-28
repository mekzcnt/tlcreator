@extends('layouts.master')

@section('title', htmlentities($post->title))

@section('code_head')
    <meta property="og:url"          content="{{route('feed.timeline', $post->id)}}" />
    <meta property="og:type"         content="article" />
    <meta property="og:title"        content="{{$post->title}}" />
    <meta property="og:description"  content="{{$post->description}}" />
    <meta property="og:image"        content="{{$post->photo->file}}" />

    <link title="timeline-styles" rel="stylesheet" href="https://cdn.knightlab.com/libs/timeline3/latest/css/timeline.css">

@endsection

@section('before_container')
@endsection

@section('content')

    <!-- <img class="img-responsive" src="{{$post->photo->file}}" alt=""><br> -->
    <h1 class="text-center">
      {{$post->title}}
      @if (Auth::user())
        @if (Auth::user()->id == $post->user_id)
          <a href="{{route('auth.timeline.edit', $post->id)}}" class="btn btn-warning">Edit</a>
        @else

        @endif
      @else

      @endif

    </h1>
    <h4 class="text-center">
        <span class="glyphicon glyphicon-user"></span> <a href="{{ url('/', $post->user->username) }}">{{$post->user->name}}</a> |
        <span class="glyphicon glyphicon-time"></span> {{$post->created_at}} |
        <span class="glyphicon glyphicon-folder-close"></span> Category: <a href="{{ url('/category', $post->category_id) }}">{{$post->category->name}}</a>
    </h4>
    <br>
    {{-- <hr> --}}
    <div class="panel panel-default">
      <div class="panel-body">
        <div id="timeline-embed" style="height: 700px"></div>
      </div>
    </div>


    <hr>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-1"></div>
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-6">
              @if (Auth::check())
                @if($post->isLiked)
                    <a href="{{ route('post.like', $post->id) }}" id="like-btn" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-heart"></span> Liked <span class="badge"><strong>{{ $countLikes }}</strong></span></a>
                    &nbsp;&nbsp;{{ Auth::user()->name }} likes this !
                @else
                    <a href="{{ route('post.like', $post->id) }}" id="like-btn" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-heart-empty"></span> Like <span class="badge"><strong>{{ $countLikes }}</strong></span></a>
                @endif
              @else
                  <a href="#" id="like-btn" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-thumbs-up"></span> Like <span class="badge"><strong>{{ $countLikes }}</strong></span></a>
              @endif
          </div>
          <div class="col-md-6 text-right">
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="at-below-post"></div>
          </div>
        </div>
        <br>

        <p><strong>Embed Code :</strong></p>
        <div class="input-group">
          <input id="timelineEmbedCode" class="input-lg form-control" type="text" value='<iframe width="800px" height="600px" frameborder="0" style="border: 0" src="{{ url('timeline/'.$post->id.'/embed') }}"></iframe>' readonly>
          <span class="input-group-btn">
            <button class="btn btn-default btn-primary btn-lg" type="button" data-clipboard-target="#timelineEmbedCode" >Copy</button>
          </span>
        </div><br>

        <p><strong>Description :</strong></p>
        <p>{{$post->description}}</p><br>

        <p><strong>Tag :</strong></p>
        <p><span class="label label-default">Default</span></p>

        <hr>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-1"></div>
    </div>
@endsection

@section('comment')
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-md-8">


        @if(Session::has('comment_message'))
          <div class="alert alert-warning">
            {{session('comment_message')}}
          </div>
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
        @else
          <div class="alert alert-warning">
            Please <a title="Login to system" href="{{ url('/login') }}">Login</a> to likes or comments.
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
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-1"></div>
    </div>
@endsection

@section('code_foot')

  <!-- Go to www.addthis.com/dashboard to customize your tools -->
  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=mekz"></script>
  {{-- clipboard.js Javascript Library --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.6.1/clipboard.min.js"></script>
  {{-- TimelineJS3 Javascript Library --}}
  <script src="https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js"></script>

  <script type="text/javascript">
    function make_the_json() {
      var obj = {!! $post->timeline !!};
      return obj;
    }
    var timeline_json = make_the_json(); // you write this part
    // two arguments: the id of the Timeline container (no '#')
    // and the JSON object or an instance of TL.TimelineConfig created from
    // a suitable JSON object

    var additionalOptions = {

    }

    window.timeline = new TL.Timeline('timeline-embed', timeline_json, additionalOptions);
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

  <script>
    var btns = document.querySelectorAll('button');
    var clipboard = new Clipboard(btns);
    clipboard.on('success', function(e) {
      console.log(e);
    });
    clipboard.on('error', function(e) {
      console.log(e);
    });
  </script>

@endsection
