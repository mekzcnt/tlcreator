@extends('layouts.master')

@section('title', 'Edit Your Profile')

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

        <h1 id="title-page" class="text-center">Edit Your Profile</h1>
        <hr>

        <!-- <form action="/profile/edit" method="post"> -->
        {!! Form::model(Auth::user(), ['method'=>'PATCH', 'action'=> ['UserController@UpdateProfile', Auth::user()->id],'files'=>true]) !!}

            @if (count($errors) >0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="col-md-1">
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-8">
              <table class="table table-bordered">
                  <tr>
                      <td><strong class="text-center">Profile URL</strong></td>
                      <td>
                          <a href="{{ url('/', Auth::user()->username) }}">{{ url('/', Auth::user()->username) }}</a>
                      </td>
                  </tr>
                  <tr>
                      <td><strong class="text-center">Username</strong></td>
                      <td>
                          <input type="text" class="form-control" name="username" value="{{ $currentUser->username }}" autofocus>
                      </td>
                  </tr>
                  <tr>
                      <td><strong class="text-center">E-mail</strong></td>
                      <td>
                          <input type="text" class="form-control" name="email" value="{{ $currentUser->email }}">
                      </td>
                  </tr>
                  <tr>
                      <td><strong class="text-center">Display Name</strong></td>
                      <td>
                          <input type="text" class="form-control" name="name" value="{{ $currentUser->name }}">
                      </td>
                  </tr>
                  <tr>
                      <td><strong class="text-center">User Photo</strong></td>
                      <td>
                          {!! Form::file('photo_id', null, ['class'=>'form-control'])!!}
                      </td>
                  </tr>
              </table>

            <button type="submit" class="btn btn-primary pull-right">Submit</button>

            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-1">
            </div>


        <!-- </form> -->
        {!! Form::close() !!}
      </div>
    </div>
@stop
