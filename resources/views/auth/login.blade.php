@extends('layouts.master')

@section('title', 'Login')

@section('list_nav')
  @if (Auth::guest())
      <li><a href="{{ url('/') }}">Home</a></li>
      <li><a href="{{ url('/about') }}">About</a></li>
      <li><a href="{{ url('/contact') }}">Contact</a></li>
      <li class="active"><a href="{{ url('/login') }}">Login</a></li>
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

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h1 id="title-page" class="text-center">Login</h1>
            <hr>

              <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                  {{ csrf_field() }}

                  <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                      <label for="username" class="col-md-4 control-label">Username</label>

                      <div class="col-md-6">
                          <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}">

                          @if ($errors->has('username'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('username') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password" class="col-md-4 control-label">Password</label>

                      <div class="col-md-6">
                          <input id="password" type="password" class="form-control" name="password">

                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <div class="checkbox">
                              <label>
                                  <input type="checkbox" name="remember"> Remember Me
                              </label>
                          </div>
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-primary">
                              <i class="fa fa-btn fa-sign-in"></i> Login
                          </button>

                          <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                      </div>
                  </div>
              </form>

        </div>
    </div>
</div>
@endsection
