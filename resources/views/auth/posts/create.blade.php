@extends('layouts.master')

@section('title', 'Create a timeline')

@section('before_container')
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
  @include('includes.form_error')


  {!! Form::open(['method'=>'POST', 'action'=> 'UserPostsController@store', 'files'=>true]) !!}

   <div class="form-group">
         {!! Form::label('title', 'Title:') !!}
         {!! Form::text('title', null, ['class'=>'form-control'])!!}
   </div>

    <div class="form-group">
        {!! Form::label('category_id', 'Category:') !!}
        {!! Form::select('category_id', [''=>'Choose Categories'] + $categories, null, ['class'=>'form-control'])!!}
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
        {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
     </div>

   {!! Form::close() !!}
  </div>
</div>

@stop
