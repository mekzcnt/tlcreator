@extends('layouts.master')

@section('title', 'Your Profile')

@section('before_container')
@stop

@section('content')
    <div class="row">
      <div class="col-lg-12">
        <div class="card hovercard">
            <div class="card-background">
                <img class="card-bkimg" alt="" src="{{$currentUser->photo ? $currentUser->photo->file
                  : 'http://placehold.it/400x400' }}">
            </div>
            <div class="useravatar">
                <img alt="" src="{{$currentUser->photo ? $currentUser->photo->file
                  : 'http://placehold.it/400x400' }}">
            </div>
            <div class="card-info"> <span class="card-title">{{ $currentUser->name }}</span>
          </div>
        </div>
        <h1 id="title-page" class="text-center">My Timeline</h1>
        <hr>
      </div>
    </div>
    <div class="row equal-height">
      <div class="col-lg-12">
      
      </div>
    </div>
@stop
