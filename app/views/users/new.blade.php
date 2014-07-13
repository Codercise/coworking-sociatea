@extends('partials/application')
@section('content')
  <h1>The Coworking Sociatea</h1>
  @if(isset($facebook_error))
    <div class="alert alert-danger" role="alert">{{ $facebook_error }}</div>
  @endif
  @if(Auth::check())
    <a href="/logout"><button class="btn btn-large btn-danger">Logout</button></a>
  @else
    {{ link_to_action('OAuthController@loginWithFacebook', "Login with Facebook", null, array('class' => 'btn btn-large btn-primary')) }}
  @endif
@stop