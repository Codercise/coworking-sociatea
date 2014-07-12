<!DOCTYPE html>
<html>
<head>
  <title>Coworking Sociatea - A War Tapir Production</title>
  {{ HTML::style('/assets/bootstrap/css/bootstrap.css') }}
</head>
<body>
  @include('partials.navigation')
  <div class="container-fluid col-xs-12">
    <div class="col-xs-12">
      @yield('content')
    </div>
  </div>
</body>
</html>