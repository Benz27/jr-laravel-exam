@extends('master')
@section('content')
<h2>Patient Form</h2>
    <hr>
        <form action="/patient/{{ isset($selected) ? "update/$selected[id]" : "store" }}" method="POST">
            @csrf
            @if(isset($selected) && $selected["id"])
                @method("PUT")
            @endif
            <div class="form-floating mb-3">
            <input required class="form-control" type="text" name="name" value="{{ isset($selected) ? $selected["name"] : ""}}">
            <label for="name">Name</label>
            </div>
        <div class="form-floating mb-3">
            <select required name="brgys_id" class="form-control">
                @foreach ($brgys_list as $brgys)
                    <option {{ isset($selected) && $selected["brgys"]["id"] == $brgys["id"] ? "selected" : ""}} value="{{$brgys["id"]}}">{{$brgys["name"]}}</option>
                @endforeach
            </select>
            <label for="name">Baranggay</label>
        </div>
    
        <div class="form-floating mb-3">
            <input required class="form-control" id="number" type="number" maxlength="11" name="number" value="{{ isset($selected) ? $selected["number"] : ""}}">
            <label for="number">Number</label>
        </div>
        <div class="form-floating mb-3">

            <input class="form-control" id="email" type="email" name="email" value="{{ isset($selected) ? $selected["email"] : ""}}">
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-3">
            <select required class="form-control" id="case_type" name="case_type">
                <option {{ isset($selected) && $selected["case_type"] == "PUI" ? "selected" : ""}} value="PUI">PUI</option>
                <option {{ isset($selected) && $selected["case_type"] == "PUM" ? "selected" : ""}} value="PUM">PUM</option>
                <option {{ isset($selected) && $selected["case_type"] == "Positive on Covid" ? "selected" : ""}} value="Positive on Covid">Positive on Covid</option>
                <option {{ isset($selected) && $selected["case_type"] == "Negative on Covid" ? "selected" : ""}} value="Negative on Covid">Negative on Covid</option>
            </select>
            <label for="case_type">Case Type</label>
        </div>

        <div class="form-floating mb-3">

            <select required class="form-control" id="coronavirus_status" name="coronavirus_status">
                <option {{ isset($selected) && $selected["coronavirus_status"] == "active" ? "selected" : ""}} value="active">active</option>
                <option {{ isset($selected) && $selected["coronavirus_status"] == "recovered" ? "selected" : ""}} value="recovered">recovered</option>
                <option {{ isset($selected) && $selected["coronavirus_status"] == "death" ? "selected" : ""}} value="death">death</option>
            </select>
            <label for="coronavirus_status">Coronavirus Status</label>
        </div>





        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

            <button class="btn btn-primary" type="submit">{{ isset($selected) ? "Save" : "Submit"}}</button>
        </div>

            {{-- @if(isset($selected) && $selected["id"])
    <button role="button"><a href="/patient/create">Create</a></button>
    @endif
    <button role="button"><a href="/patient">Go back</a></button> --}}
    
        </form>

    @stop