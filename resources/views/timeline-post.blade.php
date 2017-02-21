@extends('layouts.master')

@section('title', '')

@section('before_container')
@endsection

@section('content')
<div class="container">
    <img class="img-responsive" src="{{$post->photo->file}}" alt=""><br>
    <h1 class="">{{$post->title}}</h1>
    <p class="lead">
        <span class="glyphicon glyphicon-user"></span> <a href="#">{{$post->user->name}}</a> |
        <span class="glyphicon glyphicon-time"></span> {{$post->created_at->diffForHumans()}}</span>
    </p>
    <hr>
    <p class="text-center"><img src="https://f.ptcdn.info/652/016/000/1394692365-updatetime-o.jpg"></p><br>
    <p><strong>Description :</strong></p>
    <p>{{$post->description}}</p>
</div>
@endsection
