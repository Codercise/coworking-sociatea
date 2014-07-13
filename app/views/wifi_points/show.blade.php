@extends('partials.application')
@section('content')
  <h1>{{ $wifi_point->name }}</h1>
  <ul>
    @foreach ($wifi_point["attributes"] as $key => $wifi_point)
      <li><strong>{{ ucfirst($key) .":" }}</strong> {{ $wifi_point }}
    @endforeach
  </ul>
  <h2>Closest Pubs</h2>
  <ul>
    @for($i = 0; $i < count($closest_pubs); $i++)
      <li>{{ $closest_pubs[$i] }}</li>
    @endfor
  </ul>

  <h2>Closest Cafes</h2>
  <ul>
    @for($i = 0; $i < count($closest_cafes); $i++)
      <li>{{ $closest_cafes[$i] }}</li>
    @endfor
  </ul>

  <h2>Closest Restaurants</h2>
  <ul>
    @for($i = 0; $i < count($closest_restaurants); $i++)
      <li>{{ $closest_restaurants[$i] }}</li>
    @endfor
  </ul>
@stop