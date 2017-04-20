@extends('layouts.master')

@section('title', 'Profile')

@section('before_container')
@stop

@section('content')
<p>{{ $user->name }}</p>
<p>{{$user->email }}</p>
<p>{{ $user->username }}</p>
@stop
