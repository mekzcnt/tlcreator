@extends('layouts.admin')

@section('title', 'Upload Media')


@section('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
@stop


@section('content')
    {!! Form::open(['method'=>'POST', 'action'=> 'AdminMediasController@store', 'class'=>'dropzone']) !!}
    {!! Form::close() !!}
@stop


@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
@stop
