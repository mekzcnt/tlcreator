@extends('layouts.master')

@section('title', 'Your Profile')

@section('before_container')
@stop

@section('content')
    <div class="row">
      <div class="col-lg-12">
        <h1 id="title-page" class="text-center">Your Profile</h1>
        <hr>
        <p>{{ $currentUser->name }}</p>
        <p>{{ $currentUser->email }}</p>
        <p><img height="50" src="{{$currentUser->photo ? $currentUser->photo->file
          : 'http://placehold.it/400x400' }} " alt=""></p>
      </div>
    </div>
@stop
