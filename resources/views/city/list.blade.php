@extends('master')
@section('content')

    <h2>City List</h2>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
       <tbody>
        @foreach ($cities as $city)
          <tr>
            <td>{{$city["name"]}}</td>
            <td>
                <a role="button" style="text-decoration: none;color:black;" href="/city/view/{{ $city["id"] }}">View</a>
             </td>
             <td>
                 <a role="button" style="text-decoration: none;color:black;" href="/city/edit/{{ $city["id"] }}">Edit</a>
             </td>
             <td>
                 <form action="/city/destroy/{{ $city["id"] }}" method="POST">
                     @csrf
                     @method("DELETE")
                     <button class="btn btn-warning" role="button" type="submit">Delete</button>
                 </form>
             </td>
          </tr>
        @endforeach 
    </tbody>
      </table>
@stop