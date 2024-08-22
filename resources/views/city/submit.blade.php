@extends('master')
@section('content')
<h2>City Form</h2>
    <hr>
<form action="/city/{{ isset($selected) ? "update/$selected[id]" : "store" }}" method="POST">
    @csrf
    @if(isset($selected) && $selected["id"])
        @method("PUT")
    @endif
    <div class="form-floating mb-3">
        <input class="form-control" required id="name" type="name" name="name" value="{{ isset($selected) ? $selected["name"] : ""}}">
        <label for="name">Name</label>
    </div>
    <button class="btn btn-primary" type="submit">{{ isset($selected) ? "Save" : "Submit"}}</button>
</form>
@stop

