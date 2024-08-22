@extends('master')
@section('content')
    <h2>Patient Search</h2>
    <hr>
    <form action="/patient/search" method="POST">
        @csrf
        @method("PUT")
        <input required class="form-control mb-2" type="number" name="number">
        <button class="btn btn-primary" type="submit">Search by Number</button>
    </form>
@stop