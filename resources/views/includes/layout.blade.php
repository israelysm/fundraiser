<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./buefy/buefy.min.css">
    @yield('style')
    #include('sidemenustyle')
  </head>

  <body>
    <div id="app">
      <div class="columns">
        <div class="column is-3">
        @yield('side-menu')
        </div>
        <div class="column is-8">
        @yield('content')
        </div>
      </div>
      
      
    </div>
    @yield('script')
  </body>

</html>