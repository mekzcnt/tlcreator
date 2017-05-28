@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')

    @include('includes.form_error')

    <div class="row">

        <div class="col-sm-3">
            <img src="{{$post->photo->file}}" alt="" class="img-responsive">
        </div>

        <div class="col-sm-9">

          {!! Form::model($post, ['method'=>'PATCH', 'action'=> ['AdminPostsController@update', $post->id], 'files'=>true]) !!}

          <div class="form-group">
              {!! Form::label('title', 'Title:') !!}
              {!! Form::text('title', null, ['class'=>'form-control'])!!}
          </div>

          <div class="form-group">
              {!! Form::label('category_id', 'Category:') !!}
              {!! Form::select('category_id',  $categories, null, ['class'=>'form-control'])!!}
          </div>

          <div class="form-group">
              {!! Form::label('photo_id', 'Photo:') !!}
              {!! Form::file('photo_id', null, ['class'=>'form-control'])!!}
          </div>

          <div class="form-group">
              {!! Form::label('description', 'Description:') !!}
              {!! Form::textarea('description', null, ['class'=>'form-control'])!!}
          </div>

          <div class="form-group">
              {!! Form::submit('Update Post', ['class'=>'btn btn-primary col-sm-6']) !!}
          </div>

          {!! Form::close() !!}

           <div class="form-group">
              {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminPostsController@destroy', $post->id]]) !!}
                  {!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-6']) !!}
              {!! Form::close() !!}
           </div>

        </div>

    </div>

@stop
