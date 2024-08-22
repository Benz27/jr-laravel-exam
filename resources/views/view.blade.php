@extends('master')
@section('content')

<h2>{{$title}}</h2>
    <hr>

@foreach ($cols as $col)
@if (strpos($col, '.') !== false)
    @php
    $str = explode(".", $col);
    $d = $data;
    foreach ($str as $s) {
        $d = $d[$s];
    }
    @endphp
   <h5 for="">{{$labels[$col]}}: {{ $d }}</h5> 
@else
   <h5 for="">{{$labels[$col]}}: {{ $data[$col] }}</h5> 
@endif
<br>
@endforeach

@stop