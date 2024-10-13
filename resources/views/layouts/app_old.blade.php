<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title> @yield('title', 'or ANY DEFAULT TITLE TEXT')</title> <!--was here config('app.name', 'Laravel') -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- bootstrap css 
    -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!-- Scripts  vite is not installet as i undertand-->
    
</head>
<body>
  <div class="container">
            @yield('header')
        </div>
  <div id="app">

  <!-- alert for success email sendind -->
  @if(session()->has('message'))
  <div class="container">
    <div class="alert alert-success" role="alert">
      <strong>Success</strong>{{session()->get('message')}}
    </div>
  </div>
  
  @endif
        
        <div class="container">
            @yield('content')
        </div>
  </div>

    <div>
      @yield('footer')
    </div>  
</body>
<!-- bootstrap js
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

-->


</html>
