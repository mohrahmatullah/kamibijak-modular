<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
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