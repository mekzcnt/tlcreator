@extends('layouts.admin')

@section('title', 'Show Replies')

@section('header')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')

  @if(count($replies) > 0)
  <table id="table" class="table">
     <thead>
       <tr>
          <th>ID</th>
          <th>Author</th>
          <th>Email</th>
          <th>Body</th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        @foreach($replies as $reply)
        <tr>
           <td>{{$reply->id}}</td>
           <td>{{$reply->author}}</td>
           <td>{{$reply->email}}</td>
           <td>{{str_limit($reply->body, 30)}}</td>
           <td><a href="{{route('feed.timeline',$reply->comment->post->id)}}">View Post</a></td>
           <td>

              @if($reply->is_active == 1)

                  {!! Form::open(['method'=>'PATCH', 'action'=> ['CommentRepliesController@update', $reply->id]]) !!}


                  <input type="hidden" name="is_active" value="0">


                  <div class="form-group">
                      {!! Form::submit('Unapprove', ['class'=>'btn btn-success']) !!}
                  </div>
                  {!! Form::close() !!}


              @else


                  {!! Form::open(['method'=>'PATCH', 'action'=> ['CommentRepliesController@update', $reply->id]]) !!}


                  <input type="hidden" name="is_active" value="1">


                  <div class="form-group">
                      {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                  </div>
                  {!! Form::close() !!}




              @endif
            </td>
            <td>
              {!! Form::open(['method'=>'DELETE', 'action'=> ['CommentRepliesController@destroy', $reply->id]]) !!}

              <div class="form-group">
                  {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
              </div>
              {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
      </tbody>
  </table>
    @else
      <h1 class="text-center">No replies</h1>
  @endif

@endsection

@section('footer')
  <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

  <script>
    $(document).ready(function(){
      $('#table').DataTable({
        // "paging":   false,
        // "searching":   false
        order: [[0, 'desc']]
      });
    });
  </script>
@endsection
