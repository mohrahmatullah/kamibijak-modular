<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    @include('frontend::mobile.includes.essentialmeta')

    <!-- Import CSS -->
    @include('frontend::mobile.includes.essentialcss')

  </head>
  <body>
    @include('frontend::mobile.includes.header')

    @yield('content')
    
    @include('frontend::mobile.includes.footer')

    @include('frontend::mobile.includes.essentialjs')

  </body>
</html>