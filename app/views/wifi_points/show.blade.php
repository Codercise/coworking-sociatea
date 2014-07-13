@extends('partials.application')
@section('content')
  <h1>{{ $wifi_point->name }}</h1>
  <ul>
    @foreach ($wifi_point["attributes"] as $key => $wifi_point)
      <li><strong>{{ ucfirst($key) .":" }}</strong> {{ $wifi_point }}
    @endforeach
  </ul>
@stop