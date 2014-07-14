<!DOCTYPE html>
<html>
<head>
  <title>Coworking Sociatea - A War Tapir Production</title>
  {{ HTML::style('/assets/bootstrap/css/bootstrap.css') }}
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
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