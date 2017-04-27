<html>
  <head>
      <title>App Name - @yield('title')</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      @include('partials.nav') {{--inclusion de nav.blade.php dans le dossier partials--}}

      <div class="row">
        <div class="col s4">
          @include('partials.sidebar')
        </div>

      <div class="col s8">
          @yield('content')
     </div>
   </div> <!-- /row -->
   </div> <!-- /container -->
   <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script><!-- Compiled and minified JavaScript -->

   <script>
       $(".button-collapse").sideNav();
   </script>
   </body>
  </body>
</html>
