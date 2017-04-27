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
@include('partials.nav')
<div class="row">
  <div class="col s4">
@include('back.partials.sidebar')
  </div>
  <div class="col s8">
@yield('content') {{-- le contenu sera placé ici --}}

  </div>
</div>



</div>

</body>
<script>
$(document).ready(function() {
  $('select').material_select();


  $('#flash').delay(3000).fadeOut();

}) // end-ready;
</script>

  </html>
