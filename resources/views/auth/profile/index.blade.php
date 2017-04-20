@extends('layouts.master')

@section('title', 'Profile')

@section('before_container')
@stop

@section('content')
    <div class="row">
      <div class="col-lg-12">
        <p>{{ $currentUser->name }}</p>
        <p>{{ $currentUser->email }}</p>
        <p>{{ $currentUser->photo->id }}</p>
      </div>
    </div>
@stop
