@extends('partials/application')
@section('content')
  <h1>The Coworking Sociatea</h1>
  @if(isset($facebook_error))
    <div class="alert alert-danger" role="alert">{{ $facebook_error }}</div>
  @endif
  <h2>{{ link_to_action('OAuthController@loginWithFacebook', 'Login with Facebook') }}</h2>
@stop