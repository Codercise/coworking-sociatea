@extends('partials.application')
@section('content')
  <ul>
  @foreach ($user["attributes"] as $key => $value)
    <li><strong>{{ ucfirst($key) .":" }}</strong> {{ $value }}
  @endforeach
  </ul>
@stop