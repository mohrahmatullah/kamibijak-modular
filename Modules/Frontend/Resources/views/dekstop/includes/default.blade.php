<!DOCTYPE html>
<html lang="en">
  <head>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga1');
     ga1('set', 'forceSSL', true);
   ga1('create', 'UA-125875117-1', 'auto');
   ga1('send', 'pageview'); 
    
   </script>

    <!-- Required meta tags -->
    @include('frontend::dekstop.includes.essentialmeta')

    <!-- Import CSS -->
    @include('frontend::dekstop.includes.essentialcss')
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125875117-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-125875117-1');
    </script>-->

  </head>
  <body>
    @include('frontend::dekstop.includes.header')

    @include('frontend::dekstop.includes.sidebar')

    @yield('content')
    
    @include('frontend::dekstop.includes.footer')

    @include('frontend::dekstop.includes.essentialjs')

  </body>
</html>