@extends('layouts.master')

@section('title', '')

@section('before_container')
@endsection

@section('content')
<div class="container">
    <h1 class="">{{$post->title}}</h1>
    <p class="lead">
        Created by <a href="#">{{$post->user->name}}</a> |
        <span class="glyphicon glyphicon-time"></span> {{$post->created_at->diffForHumans()}}</span>
    </p>
    <hr>
    <img class="img-responsive" src="{{$post->photo->file}}" alt="">
    <br>
    <p>{{$post->description}}</p>
</div>
@endsection
