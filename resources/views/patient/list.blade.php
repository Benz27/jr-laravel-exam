@extends('master')
@section('content')

    <h2>Patient List</h2>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Baranggay</th>
                <th>Number</th>
                <th>Email</th>
                <th>Case Type</th>
                <th>Corona Virus Status</th>
                <th>Actions</th>
            </tr>
        </thead>
       <tbody>
        @foreach ($patients as $patient)
          <tr>
            <td>{{$patient["name"]}}</td>
            <td>{{$patient["brgys"]["name"] ?? "N/A"}}</td>
            <td>{{$patient["number"]}}</td>
            <td>{{$patient["email"]}}</td>
            <td>{{$patient["case_type"]}}</td>
            <td>{{$patient["coronavirus_status"]}}</td>
            <td>
               <a role="button" style="text-decoration: none;color:black;" href="/patient/view/{{ $patient["id"] }}">View</a>
            </td>
            <td>
                <a role="button" style="text-decoration: none;color:black;" href="/patient/edit/{{ $patient["id"] }}">Edit</a>
            </td>
            <td>
                <form action="/patient/destroy/{{ $patient["id"] }}" method="POST">
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