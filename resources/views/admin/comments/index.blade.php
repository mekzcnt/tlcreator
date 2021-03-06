@extends('layouts.admin')

@section('title', 'Comments')

@section('header')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')

  @if(count($comments) > 0)
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
        @foreach($comments as $comment)
        <tr>
           <td>{{$comment->id}}</td>
           <td>{{$comment->author}}</td>
           <td>{{$comment->email}}</td>
           <td>{{str_limit($comment->body, 30)}}</td>
           <td><a href="{{route('feed.timeline',$comment->post->id)}}">View Post</a></td>
           <td><a href="{{route('admin.replies.show',$comment->id)}}">View Replies</a></td>
           <td>
              @if($comment->is_active == 1)


                  {!! Form::open(['method'=>'PATCH', 'action'=> ['PostCommentsController@update', $comment->id]]) !!}


                  <input type="hidden" name="is_active" value="0">


                  <div class="form-group">
                      {!! Form::submit('Unapprove', ['class'=>'btn btn-success']) !!}
                  </div>
                  {!! Form::close() !!}


              @else


                  {!! Form::open(['method'=>'PATCH', 'action'=> ['PostCommentsController@update', $comment->id]]) !!}


                  <input type="hidden" name="is_active" value="1">


                  <div class="form-group">
                      {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                  </div>
                  {!! Form::close() !!}




              @endif
            </td>
            <td>
              {!! Form::open(['method'=>'DELETE', 'action'=> ['PostCommentsController@destroy', $comment->id]]) !!}

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
      <h1 class="text-center">No Comments</h1>
  @endif

  {{-- <div class="row">
      <div class="col-sm-6 col-sm-offset-5">
          {{ $comments->render() }}
      </div>
  </div> --}}

@endsection

@section('footer')
  <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

  <script>
    $(document).ready(function(){
      $('.table').DataTable({
        // "paging":   false,
        // "searching":   false
        "order": [[0, 'desc']],
        "columnDefs": [
            { "orderable": false, "targets": 4 },
            { "orderable": false, "targets": 5 },
            { "orderable": false, "targets": 6 },
            { "orderable": false, "targets": 7 }
        ]
      });
    });
  </script>
@endsection
