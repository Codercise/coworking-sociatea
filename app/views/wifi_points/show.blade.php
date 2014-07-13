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
      <li><strong>{{ $closest_pubs[$i]->name }}</strong>, {{ $closest_pubs[$i]->address }}</li>
    @endfor
  </ul>

  <h2>Closest Cafes</h2>
  <ul>
    @for($i = 0; $i < count($closest_cafes); $i++)
      <li><strong>{{ $closest_cafes[$i]->name }}</strong>, {{ $closest_cafes[$i]->address }}</li>
    @endfor
  </ul>

  <h2>Closest Restaurants</h2>
  <ul>
    @for($i = 0; $i < count($closest_restaurants); $i++)
      <li><strong>{{ $closest_restaurants[$i]->name }}</strong>, {{ $closest_restaurants[$i]->address }}</li>
    @endfor
  </ul>

  <h2>Closest Libraries</h2>
  <ul>
    @for($i = 0; $i < count($closest_libraries); $i++)
      <li><strong>{{ $closest_libraries[$i]->name }}</strong>, {{ $closest_libraries[$i]->address }}</li>
    @endfor
  </ul>
@stop