@extends('layouts.master')

@section('title', '{{$post->title}}')

@section('before_container')
@endsection

@section('content')
<div class="container">
    <h1 id="title-page" class="">{{$post->title}}</h1>
    <hr>
    <p>Timeline Post page</p>
</div>
@endsection
