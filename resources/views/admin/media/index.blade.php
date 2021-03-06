@extends('layouts.admin')

@section('title', 'Media')

@section('content')

    @if($photos)

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>


            @foreach($photos as $photo)

                <tr>
                    <td>{{$photo->id}}</td>
                    <td><img height="50" src="{{$photo->file}}" alt=""></td>
                    <td>{{$photo->created_at ? $photo->created_at : 'no date' }}</td>
                    <td>

                        {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminMediasController@destroy', $photo->id]]) !!}
                             <div class="form-group">
                                 {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                             </div>
                        {!! Form::close() !!}

                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{ $photos->render() }}
            </div>
        </div>

    @endif

@stop
