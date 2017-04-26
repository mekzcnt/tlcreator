@extends('layouts.master')

@section('title', 'Contact')

@section('before_container')
@endsection

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h1 id="title-page" class="text-center">Contact</h1>
    <hr>
    <p>Contact page</p>
    <table class="table table-bordered">
        <tr>
            <td>Name</td>
            <td>
                <input type="text" class="form-control" name="name" value="" autofocus>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input type="text" class="form-control" name="age" value="">
            </td>
        </tr>
        <tr>
            <td>Content</td>
            <td>
                <input type="text" class="form-control" name="occupation" value="">
            </td>
        </tr>
    </table>
    <button type="submit" class="btn btn-primary pull-right">Submit</button>
  </div>
</div>
@endsection
