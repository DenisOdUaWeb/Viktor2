<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts  AND CSS AND SCSS     ADDED --> 
    @vite(['resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
</head>
<body>
    <div id="app">

<!-- example component of VUE JS --><!-- example component of VUE JS --><!-- example component of VUE JS -->    
        <div id="vue_app"><!-- example component of VUE JS --><!-- example component of VUE JS -->
            <example></example> 

            

            <!-- example component of VUE JS --><!-- example component of VUE JS -->
        <!-- example component of VUE JS --><!-- example component of VUE JS -->
<!-- example component of VUE JS --><!-- example component of VUE JS --><!-- example component of VUE JS -->
<!-- BTN VUE BTN VUE -->
        <btn text="NEW NEW text" mtype2="submit" type="type for wrapping div"></btn>
<!-- END BTN VUE BTN VUE -->

        <div class="container">
            @yield('header')
        </div>
  

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
           
        </main>
        
        <div class="new-class"><h1 style="color:white">&nbsp STYLE from app.scss</h1></div>
        <div class="new-class2"><h1 style="color:white">&nbsp STYLE from app.css</h1></div>
        <div>
            @yield('footer')
        </div>

        
        </div> <!-- end of vue app div  -->
        
    </div> <!-- END id="app" -->

</body>
</html>
