@extends('master')
@section('content')

    <h2>Baranggay List</h2>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>City</th>
                <th>Actions</th>
            </tr>
        </thead>
       <tbody>
        @foreach ($brgys_list as $brgys)
          <tr>
            <td>{{$brgys["name"]}}</td>
            <td>{{$brgys["city"]["name"] ?? "N/A"}}</td>
            <td>
                <a role="button" style="text-decoration: none;color:black;" href="/brgys/view/{{ $brgys["id"] }}">View</a>
             </td>
             <td>
                 <a role="button" style="text-decoration: none;color:black;" href="/brgys/edit/{{ $brgys["id"] }}">Edit</a>
             </td>
             <td>
                 <form action="/brgys/destroy/{{ $brgys["id"] }}" method="POST">
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