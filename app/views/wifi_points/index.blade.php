@extends('partials.application')
@section('content')
  <h1>All Wifi Points</h1>
  <ul>
    @foreach ($wifi_points as $key => $wifi_point)
      <li>{{ link_to_action("WifiPointController@show", $wifi_point->name, "{$wifi_point->id}") }}</li>
    @endforeach
  </ul>
@stop