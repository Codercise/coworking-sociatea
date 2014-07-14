@extends('partials.application')
@section('content')
  <h1>{{$venue->name }}</h1>
  <ul>
    @foreach ($venue["attributes"] as $key => $value)
      <li><strong>{{ ucfirst($key) .":" }}</strong> {{ $value }}
    @endforeach
  </ul>
    @if (Session::get("checked_in['venue_id']") == $venue->id)
      <button class="btn btn-large btn-danger checkout btn1">Check Out!</button>
    @else
      <button class="btn btn-large btn-primary checkin">Check in!</button>
      {{ link_to_action('CheckinController@create', "Check in!", array($venue->id))}}
    @endif
    <script type="text/javascript">
    </script>
@stop