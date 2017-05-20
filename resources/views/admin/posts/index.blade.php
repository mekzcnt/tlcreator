@extends('layouts.admin')

@section('title', 'Posts')

@section('header')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')

    <table class="table" id="table">
       <thead>
         <tr>
             <th>ID</th>
             <th>Photo</th>
             <th>Title</th>
             <th>Category</th>
             <th>User</th>
             <th>Post link</th>
             <th>Comments</th>
             <th>Created at</th>
             <th>Update</th>
        </thead>
        <tbody>

        @if($posts)


            @foreach($posts as $post)

          <tr>
              <td>{{$post->id}}</td>
              <td><img height="50" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400' }} " alt=""></td>
              <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>
              <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
              <td>{{$post->user->name}}</td>
              <td><a href="{{route('feed.timeline', $post->id)}}">View Post</a></td>
              <td><a href="{{route('admin.comments.show', $post->id)}}">View Comments</a></td>
              <td>{{$post->created_at->diffForhumans()}}</td>
              <td>{{$post->updated_at->diffForhumans()}}</td>

          </tr>

            @endforeach

            @endif

       </tbody>
     </table>



    {{-- <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{ $posts->render() }}
        </div>
    </div> --}}

@stop


@section('footer')
  <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

  <script>
    $(document).ready(function(){
      $('#table').DataTable({
        // "paging":   false,
        // "searching":   false
        "order": [[0, 'desc']],
        "columnDefs": [
            { "orderable": false, "targets": 5 },
            { "orderable": false, "targets": 6 }
        ]
      });
    });
  </script>
@endsection
