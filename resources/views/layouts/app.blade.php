<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('images/favicon.ico')}}" />
  <link rel="stylesheet" href="{{asset('css/styles.min.css')}}" />
  @yield('css')
</head>

<body>
  <!--  Body Wrapper -->
  
    @yield('content')

  <!-- solar icons -->
  @yield('js')
</body>

</html>