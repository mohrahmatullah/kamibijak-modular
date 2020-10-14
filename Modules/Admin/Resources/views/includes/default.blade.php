<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin::includes.essentialmeta')
    
    <!-- Import CSS -->
    @include('admin::includes.essentialcss')
  </head>
  <body class="hold-transition skin-blue sidebar-mini"> 
    <input type="hidden" name="hf_base_url" id="hf_base_url" value="{{ env('APP_URL') }}">
    <input type="hidden" name="base_url_image" id="base_url_image" value="{{ env('URL_ASSET') }}">
    <div class="wrapper">
          @include('admin::includes.header')
          @include('admin::includes.sidebar')
          <div class="content-wrapper" style="background-color: #fff;">
            <section class="content">
            @yield('content') 
            </section>         
          </div>
          @include('admin::includes.footer')
    </div>   
    
    <!-- Import Javascript -->
    @include('admin::includes.essentialjs')

  </body>
</html>