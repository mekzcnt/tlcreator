@extends('layouts.admin')

@section('title', 'Users')

@section('header')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')

    @if(Session::has('deleted_user'))
        <p class="bg-danger">{{session('deleted_user')}}</p>
    @endif

    <table id="table" class="table">
       <thead>
         <tr>
             <th>Id</th>
             <th>Photo</th>
             <th>Name</th>
             <th>Email</th>
             <th>Role</th>
             <th>Status</th>
             <th>Created</th>
             <th>Updated</th>
          </tr>
        </thead>
        <tbody>

        @if($users)


            @foreach($users as $user)


           <tr>
              <td>{{$user->id}}</td>
               <td> <img height="50" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt="" ></td>
              <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
              <td>{{$user->email}}</td>
              <td>{{$user->role ? $user->role->name : 'User has no role'}}</td>
               <td>{{$user->is_active == 1 ? 'Active' : 'Not Active' }}</td>
              <td>{{$user->created_at->diffForHumans()}}</td>
              <td>{{$user->updated_at->diffForHumans()}}</td>
           </tr>

            @endforeach


          @endif


       </tbody>
     </table>

     {{-- <div class="row">
         <div class="col-sm-6 col-sm-offset-5">
             {{ $users->render() }}
         </div>
     </div> --}}

@stop

@section('footer')
  <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

  <script>
    $(document).ready(function(){
      $('#table').DataTable({
        // "paging":   false,
        // "searching":   false
        "order": [[0, 'desc']]
        
      });
    });
  </script>
@endsection
