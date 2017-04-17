@extends('layouts.admin')

@section('title', 'Posts')

@section('content')

    <table class="table">
       <thead>
         <tr>
             <th>ID</th>
             <th>Photo</th>
             <th>User</th>
             <th>Category</th>
             <th>Title</th>
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
              <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
              <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
              <td>{{$post->title}}</td>
              <td><a href="{{route('feed.timeline', $post->slug)}}">View Post</a></td>
              <td><a href="{{route('admin.comments.show', $post->id)}}">View Comments</a></td>
              <td>{{$post->created_at->diffForhumans()}}</td>
              <td>{{$post->updated_at->diffForhumans()}}</td>

          </tr>

            @endforeach

            @endif

       </tbody>
     </table>



    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{ $posts->render() }}
        </div>
    </div>



@stop
