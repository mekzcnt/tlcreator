@extends('layouts.admin')


@section('content')

<h1>Comments</h1>
<table class="table">
   <thead>
     <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Email</th>
        <th>Body</th>
      </tr>
    </thead>
    <tbody>
      <tr>
         <td>John</td>
         <td>Doe</td>
         <td>john@example.com</td>
      </tr>
      <tr>
         <td>Mary</td>
         <td>Moe</td>
         <td>marry@example.com</td>
      </tr>
    </tbody>
</table>
@endsection
