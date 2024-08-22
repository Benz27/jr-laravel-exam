@extends('master')
@section('content')
    <h2>{{$title}}</h2>
    <hr>
    <form action="/reports/{{$type}}" method="POST">
        @csrf
        @method("PUT")
        <div class="row">

        <div class="form-floating mb-3 col-6">
        <select required class="form-control" id="city" name="city_id">
            @foreach ($cities as $city)
                <option {{ isset($city_id) && $city_id == $city["id"] ? "selected" : ""}} value="{{$city["id"]}}">{{$city["name"]}}</option>
            @endforeach
        </select>
        <label for="city">City</label>
    </div>
    <div class="form-floating mb-3 col-6">
        <select required id="brgys" name="brgys_id" class="form-control">
        </select>
        <label for="brgys">Baranggay</label>
    </div>
</div>

        <button class="btn btn-primary" type="submit">Generate Report</button>
    </form>
    <hr>
    @if($type == "awareness")
    <table class="table">
        <thead>
            <tr>
                <th>PUI</th>
                <th>PUM</th>
                <th>Positive on Covid</th>
                <th>Negative on Covid</th>
              </tr>
        </thead>
        <tbody>
            <tr>

                <td>{{ $rep["PUI"] }}</td>
                <td>{{ $rep["PUM"] }}</td>
                <td>{{ $rep["Positive on Covid"] }}</td>
                <td>{{ $rep["Negative on Covid"] }}</td>
            </tr>
        </tbody>
      </table>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Total</th>
                <th>Recovered</th>
                <th>Active</th>
                <th>Death</th>
              </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $rep["total"] }}</td>
                <td>{{ $rep["recovered"] }}</td>
                <td>{{ $rep["active"] }}</td>
                <td>{{ $rep["death"] }}</td>
            </tr>
        </tbody>
      </table>
    @endif
   
    <script type="module" src="{{ asset('js/reports/reports.js') }}"></script>


@stop