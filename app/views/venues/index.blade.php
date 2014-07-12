@extends('partials.application')
@section('content')
  <h1>All venues</h1>
  <ul>
    @foreach ($venues as $key => $value)
      <li>{{$value->name}}</li>
    @endforeach
  </ul>
@stop