@extends('layouts.master')

@section('title', 'Edit Your Profile')


@section('code_head')
@stop

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
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1 id="title-page" class="text-center">Edit Your Profile</h1>


        <!-- <form action="/profile/edit" method="post"> -->
        {!! Form::model(Auth::user(), ['method'=>'PATCH', 'action'=> ['UserController@UpdateProfile', Auth::user()->id],'files'=>true, 'class'=>'form-horizontal']) !!}

            @if (count($errors) >0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="panel panel-default">

                <div class="panel-body">

                    <div class="form-group">
                        <label for="profile-url" class="col-md-4 control-label">Profile URL</label>

                        <div class="col-md-6">
                            {{-- <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"> --}}
                            <a href="{{ url('/', Auth::user()->username) }}"><h4>{{ url('/', Auth::user()->username) }}</h4></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-md-4 control-label">Username</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="username" value="{{ $currentUser->username }}" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-mail</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" value="{{ $currentUser->email }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Display Name</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="{{ $currentUser->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo_id" class="col-md-4 control-label">User Photo</label>

                        <div class="col-md-6">
                          <label class="btn btn-default btn-file btn-block">
                            {!! Form::file('photo_id', null, ['class'=>'form-control dropzone'])!!}
                          </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-lg pull-right">Save</button>
                        </div>
                    </div>

                </div>

            </div>

        <!-- </form> -->
        {!! Form::close() !!}
      </div>
    </div>
@stop

@section('code_foot')
@stop
