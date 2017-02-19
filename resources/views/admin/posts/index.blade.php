@extends('layouts.admin')


@section('content')


    <h1>Posts</h1>


    <table class="table">
       <thead>
         <tr>
             <th>Id</th>
             <th>User</th>
             <th>Category</th>
             <th>Photo</th>
             <th>Title</th>
             <th>Description</th>
             <th>Created at</th>
             <th>Update</th>
        </thead>
        <tbody>

        @if($posts)


            @foreach($posts as $post)

          <tr>
              <td>{{$post->id}}</td>
              <td>{{$post->user_id}}</td>
              <td>{{$post->category_id}}</td>
              <td>{{$post->photo_id}}</td>
              <td>{{$post->title}}</td>
              <td>{{str_limit($post->description, 30)}}</td>
              <td>{{$post->created_at->diffForhumans()}}</td>
              <td>{{$post->updated_at->diffForhumans()}}</td>

          </tr>

            @endforeach

            @endif

       </tbody>
     </table>



    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">

            {{$posts->render()}}

        </div>
    </div>



@stop
