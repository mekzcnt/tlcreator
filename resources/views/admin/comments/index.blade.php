@extends('layouts.admin')


@section('content')

  @if(count($comments) > 0)
  <h1>Comments</h1>
  <table class="table">
     <thead>
       <tr>
          <th>ID</th>
          <th>Author</th>
          <th>Email</th>
          <th>Body</th>
        </tr>
      </thead>

      <tbody>
        @foreach($comments as $comment)
        <tr>
           <td>{{$comment->id}}</td>
           <td>{{$comment->author}}</td>
           <td>{{$comment->email}}</td>
           <td>{{$comment->body}}</td>
           <td><a href="{{route('feed.timeline',$comment->post->id)}}">View Post</a></td>
        </tr>
        @endforeach
      </tbody>
  </table>
    @else
      <h1 class="text-center">No Comments</h1>
  @endif

@endsection
