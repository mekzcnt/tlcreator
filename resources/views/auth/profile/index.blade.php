@extends('layouts.master')

@section('title', 'Profile')

@section('before_container')
@stop

@section('content')
<p>{{ $currentUser->name }}</p>
<p>{{ $currentUser->email }}</p>
<p>{{ $currentUser->username }}</p>
@stop
