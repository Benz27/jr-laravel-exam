@extends('master')
@section('content')
<h2>Baranggay Form</h2>
    <hr>
    <form action="/brgys/{{ isset($selected) ? "update/$selected[id]" : "store" }}" method="POST">
        @csrf
        @if(isset($selected) && $selected["id"])
            @method("PUT")
        @endif
        <div class="form-floating mb-1">
            <input class="form-control" required id="name" type="text" name="name" value="{{ isset($selected) ? $selected["name"] : ""}}">
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <select required name="city_id" id="city_id" class="form-control">
                @foreach ($cities as $city)
                    <option {{ isset($selected) && $selected["city"]["id"] == $city["id"] ? "selected" : ""}} value="{{$city["id"]}}">{{$city["name"]}}</option>
                @endforeach
            </select>
            <label for="city_id">City</label>
        </div>
        <button class="btn btn-primary" type="submit">{{ isset($selected) ? "Save" : "Submit"}}</button>
    </form>
    @stop