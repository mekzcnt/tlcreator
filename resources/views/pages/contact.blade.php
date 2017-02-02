@extends('layouts.master')

@section('title', 'Contact')

@section('list_nav')
  @if (Auth::guest())
      <li><a href="{{ url('/') }}">Home</a></li>
      <li><a href="{{ url('/about') }}">About</a></li>
      <li class="active"><a href="{{ url('/contact') }}">Contact</a></li>
      <li><a href="{{ url('/login') }}">Login</a></li>
      <li><a href="{{ url('/register') }}">Register</a></li>
  @else
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ Auth::user()->name }} <span class="caret"></span>
          </a>

          <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
          </ul>
      </li>
  @endif
@endsection

@section('before_container')
@endsection

@section('content')
<div class="container">
  <h2>Contact</h2>
  <p>Contact page</p>
</div>
@endsection
