<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Import CSS -->
    @include('frontend::dekstop.includes.essentialcss')

  </head>
  <body>
    @include('frontend::dekstop.includes.header')

    @include('frontend::dekstop.includes.sidebar')

    @yield('content')
    
    @include('frontend::dekstop.includes.footer')

    @include('frontend::dekstop.includes.essentialjs')

  </body>
</html>