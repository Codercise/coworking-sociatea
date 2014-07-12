@extends('partials.application')
@section('content')
  <h1>All venues</h1>
  <ul>
    @foreach ($venues as $key => $venue)
      <?php
        $venue->trimmed = preg_replace("/[\s-]+/", " ", $venue->name);
        $venue->trimmed = preg_replace("/[\s_]/", "-", $venue->name);
      ?>
      <li>{{ link_to_action("VenueController@show", $venue->name, "{$venue->id}") }}</li>
    @endforeach
  </ul>
@stop