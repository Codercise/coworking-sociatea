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
      <li><strong>{{ $closest_pubs[$i]->name }}</strong>, {{ link_to_action("VenueController@show", $closest_pubs[$i]->address, $closest_pubs[$i]->id) }}</li>
    @endfor
  </ul>

  <h2>Closest Cafes</h2>
  <ul>
    @for($i = 0; $i < count($closest_cafes); $i++)
      <li><strong>{{ $closest_cafes[$i]->name }}</strong>, {{ link_to_action("VenueController@show", $closest_cafes[$i]->address, $closest_cafes[$i]->id) }}</li>
    @endfor
  </ul>

  <h2>Closest Restaurants</h2>
  <ul>
    @for($i = 0; $i < count($closest_restaurants); $i++)
      <li><strong>{{ $closest_restaurants[$i]->name }}</strong>, {{ link_to_action("VenueController@show", $closest_restaurants[$i]->address, $closest_restaurants[$i]->id) }}</li>
    @endfor
  </ul>

  <h2>Closest Libraries</h2>
  <ul>
    @for($i = 0; $i < count($closest_libraries); $i++)
      <li><strong>{{ $closest_libraries[$i]->name }}</strong>, {{ link_to_action("VenueController@show", $closest_libraries[$i]->address, $closest_libraries[$i]->id) }}</li>
    @endfor
  </ul>
@stop