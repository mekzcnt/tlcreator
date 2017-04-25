@extends('layouts.master')

@section('title', 'Edit Your Profile')

@section('before_container')
@stop

@section('content')
    <div class="row">
      <div class="col-lg-12">
        <h1 id="title-page" class="text-center">Edit Your Profile</h1>
        <hr>
        <form action="/profile/edit" method="post">
            @if (count($errors) >0)
                <div action="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <table class="table table-bordered">
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" class="form-control" name="name" value="{{ $currentUser->name }}" autofocus>
                    </td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td>
                        <input type="text" class="form-control" name="email" value="{{ $currentUser->email }}">
                    </td>
                </tr>
                <tr>
                    <td>Display Name</td>
                    <td>
                        <input type="text" class="form-control" name="username" value="{{ $currentUser->username }}">
                    </td>
                </tr>
                <tr>
                    <td>Sex</td>
                    <td>
                        @if($currentUser->sex == 'male')
                            <form>
                                <div class="pull-left">
                                    <input type="radio" name="sex" value="male" checked> Male
                                    <br>
                                    <input type="radio" name="sex" value="female"> Female
                                </div>
                            </form>
                        @else
                            <form>
                                <div class="pull-left">
                                    <input type="radio" name="sex" value="male"> Male
                                    <br>
                                    <input type="radio" name="sex" value="famale" checked> Female
                                </div>
                            </form>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td>
                        <input type="text" class="form-control" name="age" value="{{ $currentUser->age }}">
                    </td>
                </tr>
                <tr>
                    <td>Occupation</td>
                    <td>
                        <input type="text" class="form-control" name="occupation" value="{{ $currentUser->occupation }}">
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </form>
      </div>
    </div>
@stop
