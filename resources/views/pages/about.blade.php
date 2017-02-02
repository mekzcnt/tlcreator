@extends('layouts.master')

@section('title', 'About')

@section('list_nav')
  <li><a href="/">Home</a></li>
  <li class="active"><a href="/about">About</a></li>
  <li><a href="/contact">Contact</a></li>
  <li><a href="/login">Login</a></li>
@endsection

@section('before_container')
@endsection

@section('content')
  <div class="container">
    <h2>About</h2>
    <p>About page</p>
  </div>
@endsection
