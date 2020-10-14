<!-- Link tags -->
<link rel='index' title='title website' href='link website' />

<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

@if((Request::is('/')))
<title>Kami Berbahasa Isyarat Jakarta - KamiBijak</title>
@elseif((Request::is('vc/*')))
<title>{{ $namecategory->namecategory }} - KamiBijak</title>
@elseif((Request::is('v/*')))
<title>{{$detail->title}} - KamiBijak</title>
@elseif((Request::is('tag/*')))
@php                
$body = $nametag;                
$body = str_replace('-',' ', $body);
$body = ucwords($body);
@endphp
<title>{{$body}} - KamiBijak</title>
@elseif((Request::is('user/*')))
<title>{{$nameuser->nameuser}} - KamiBijak</title>
@elseif((Request::is('search')))
<title>You searched for as - KamiBijak</title>
@elseif((Request::is('highlight')) || (Request::is('explore')) || (Request::is('menu')))
<title>@yield('title')</title>
@endif

<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="https://i2.wp.com/www.kamibijak.com/wp-content/uploads/2018/08/cropped-favicon-kamibijak.png?fit=32%2C32&#038;ssl=1">


<link rel="apple-touch-icon" href="https://i2.wp.com/www.kamibijak.com/wp-content/uploads/2018/08/cropped-favicon-kamibijak.png?fit=32%2C32&#038;ssl=1">
<link rel="shortcut icon" href="https://i2.wp.com/www.kamibijak.com/wp-content/uploads/2018/08/cropped-favicon-kamibijak.png?fit=32%2C32&#038;ssl=1">

<link rel="shortcut icon" type="image/x-icon" href="https://i2.wp.com/www.kamibijak.com/wp-content/uploads/2018/08/cropped-favicon-kamibijak.png?fit=32%2C32&#038;ssl=1">
<!-- Select one -->
<link rel="shortcut icon" type="image/ico" href="/favicon.ico" />
<link rel="fluid-icon" type="image/png" href="/fluid-icon.png" />

<!-- Import Font -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

<!-- Import Animate CSS -->
<link rel="stylesheet" href="{{url('assets/frontend/css/animate/animate.css')}}" />

<!-- Import Hamburgers CSS -->
<link rel="stylesheet" href="{{url('assets/frontend/css/hamburgers/hamburgers.css')}}" />

<!-- Import Bootstrap CSS -->
<link rel="stylesheet" href="{{url('assets/frontend/css/bootstrap/bootstrap.min.css')}}" />

<!-- Import Owl Carousel CSS -->
<link rel="stylesheet" href="{{url('assets/frontend/css/owlcarousel/owl.carousel.min.css')}}" />
<link rel="stylesheet" href="{{url('assets/frontend/css/owlcarousel/owl.theme.default.min.css')}}" />

<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />

<!-- Import Nprogress CSS -->
<link rel="stylesheet" href="{{ url('assets/frontend/css/nprogress/nprogress.css') }}" />

<!-- Import Fancybox CSS -->
<link rel="stylesheet" href="{{ url('assets/frontend/css/fancybox/jquery.fancybox.min.css') }}" />

<!-- Import CSS -->
<link rel="stylesheet" href="{{url('assets/frontend/css/style.css')}}"/>