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
        <p>{{ $currentUser->photo->id }}</p>
      </div>
    </div>
@stop
