<!-- Header -->
<header class="header-t position-fixed w-100">
  <!-- <div class="nav-top dark-grey row mx-0 d-none d-md-flex">
    <div class="col-4 col-xl-3 text-center" style="border-right: 1px solid white;">
      <span class="text-white nav-top-text"><?php echo date('l, d F Y'); ?></span>
    </div>
    <div class="col-8 col-xl-9 pl-xl-5">
      <a href="mailto:markom@kamibijak.com" class="text-white nav-top-text px-4">Advertise with us</a>
      <a href="#" class="text-white nav-top-text px-4">Help</a>
    </div>
  </div> -->
  <div class="navbar-kb white row mx-0">
    
      <div class="col-3 col-xl-2 align-self-center">
        <div class="w-100 d-flex align-items-center">
          <!-- <div class="w-25" style="display: inline-grid;">
            <button type="button" class="float-left btn-nav" ><img src="assets/img/menu.svg" alt="menu" style="width: 25px;height: 25px;"/> </button>
          </div>
          <div class="w-50 d-none d-lg-inline-block" style="display: inline-grid;"> -->
          <!-- <button id="btn-nav" class="hamburger mr-2 is-active" type="button">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button> -->
          <button id="btn-nav" class="hamburger hamburger--slider btn-nav" type="button">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
            <!-- <button id="btn-nav" type="button" class="float-left btn-nav mr-2" ><img src="{{url('assets/frontend/img/menu.svg')}}" alt="menu" style="width: 25px;height: 25px;"/> </button> -->
            <a href="/"><img src="{{url('assets/frontend/img/logo.png')}}" class="" alt="logo" style="width: 140px; height: auto;" /></a>
          <!-- </div> -->
        </div>

      </div>

      <div class="col-5 col-xl-7 col-lg-6 align-self-center d-none d-lg-inline-flex">
        <ul class="list-unstyled d-inline-block mb-0">
          <!-- <li class="float-left"><a href="/vc/viral" class="text-grey text-uppercase">viral</a></li> -->
          @php
            $menu_category = DB::table('post_category')->orderby('section', 'ASC')->get();
          @endphp
          
          @foreach($menu_category as $mc)
            <li class="float-left">
              <a href="{{ route('category', $mc->slug)}}" class="text-grey nav-menu-link @if($mc->favorite == 1 || $mc->new == 1) position-relative @endif {{ ($mc->slug == request()->segment(2)) ? 'active' : '' }}">
                {{ $mc->name }}
                @if($mc->favorite == 1)
                <div class="position-absolute text-white py-0 px-1 d-inline-block" style="top: 0;right: 0;background: #f57c00;font-size: 7pt;margin-top: -4px;letter-spacing: 1px;">FAV</div>
                @endif
                @if($mc->new == 1)
                <div class="position-absolute text-white py-0 px-1 d-inline-block" style="top: 0;right: 0;background: #43a047;font-size: 7pt;margin-top: -4px;letter-spacing: 1px;">NEW</div>
                @endif
              </a>
            </li>
          @endforeach

          {{--
          <li class="float-left"><a href="/vc/kabarbijak" class="text-grey nav-menu-link {{ (request()->segment(2)) == 'kabarbijak' ? 'active' : '' }}">KabarBijak</a></li>
          <li class="float-left"><a href="/vc/bijakfun" class="text-grey nav-menu-link {{ (request()->segment(2)) == 'bijakfun' ? 'active' : '' }}">BijakFun</a></li>
          <li class="float-left">
            <a href="/vc/jalan-jalan-kuliner" class="text-grey nav-menu-link position-relative {{ (request()->segment(2)) == 'jalan-jalan-kuliner' ? 'active' : '' }}">
              Jalan-Jalan Kuliner
              <div class="position-absolute text-white py-0 px-1 d-inline-block" style="top: 0;right: 0;background: #f57c00;font-size: 7pt;margin-top: -4px;letter-spacing: 1px;">FAV</div>
            </a>
          </li>
          <li class="float-left"><a href="/vc/bijakflash" class="text-grey nav-menu-link {{ (request()->segment(2)) == 'bijakflash' ? 'active' : '' }}">BijakFlash</a></li>
          <li class="float-left"><a href="/vc/bincang-isyarat" class="text-grey nav-menu-link {{ (request()->segment(2)) == 'bincang-isyarat' ? 'active' : '' }}">Bincang Isyarat</a></li>
          <li class="float-left">
            <a href="/vc/ruang-kamibijak" class="text-grey nav-menu-link position-relative {{ (request()->segment(2)) == 'ruang-kamibijak' ? 'active' : '' }}">
              Ruang Kamibijak
              <div class="position-absolute text-white py-0 px-1 d-inline-block" style="top: 0;right: 0;background: #43a047;font-size: 7pt;margin-top: -4px;letter-spacing: 1px;">NEW</div>
            </a>
          </li>
          --}}
          {{-- @if((Request::is('vc/kabarbijak')))
            <li class="float-left"><a href="/vc/kabarbijak" class="text-grey nav-menu-link active">KabarBijak</a></li>
          @else
            <li class="float-left"><a href="/vc/kabarbijak" class="text-grey nav-menu-link">KabarBijak</a></li>
          @endif

          @if((Request::is('vc/bijakfun')))
          <li class="float-left"><a href="/vc/bijakfun" class="text-grey nav-menu-link active">BijakFun</a></li>
          @else
          <li class="float-left"><a href="/vc/bijakfun" class="text-grey nav-menu-link">BijakFun</a></li>
          @endif

          @if((Request::is('vc/jalan-jalan-kuliner')))
            <li class="float-left">
              <a href="/vc/jalan-jalan-kuliner" class="text-grey nav-menu-link active position-relative">
                Jalan-Jalan Kuliner
                <div class="position-absolute text-white py-0 px-1 d-inline-block" style="top: 0;right: 0;background: #f57c00;font-size: 7pt;margin-top: -4px;letter-spacing: 1px;">FAV</div>
              </a>
            </li>
          @else
            <li class="float-left">
              <a href="/vc/jalan-jalan-kuliner" class="text-grey nav-menu-link position-relative">
                Jalan-Jalan Kuliner
                <div class="position-absolute text-white py-0 px-1 d-inline-block" style="top: 0;right: 0;background: #f57c00;font-size: 7pt;margin-top: -4px;letter-spacing: 1px;">FAV</div>
              </a>
            </li>
          @endif

          @if((Request::is('vc/bijakflash')))
            <li class="float-left"><a href="/vc/bijakflash" class="text-grey nav-menu-link active">BijakFlash</a></li>
          @else
            <li class="float-left"><a href="/vc/bijakflash" class="text-grey nav-menu-link">BijakFlash</a></li>
          @endif

          @if((Request::is('vc/ruang-kamibijak')))
            <li class="float-left">
              <a href="/vc/ruang-kamibijak" class="text-grey nav-menu-link active position-relative">
                Ruang Kamibijak
                <div class="position-absolute text-white py-0 px-1 d-inline-block" style="top: 0;right: 0;background: #43a047;font-size: 7pt;margin-top: -4px;letter-spacing: 1px;">NEW</div>
              </a>
            </li>
          @else
            <li class="float-left">
              <a href="/vc/ruang-kamibijak" class="text-grey nav-menu-link position-relative">
                Ruang Kamibijak
                <div class="position-absolute text-white py-0 px-1 d-inline-block" style="top: 0;right: 0;background: #43a047;font-size: 7pt;margin-top: -4px;letter-spacing: 1px;">NEW</div>
              </a>
            </li>
          @endif

          @if((Request::is('vc/bincang-isyarat')))
            <li class="float-left"><a href="/vc/bincang-isyarat" class="text-grey nav-menu-link active">Bincang Isyarat</a></li>
          @else
            <li class="float-left"><a href="/vc/bincang-isyarat" class="text-grey nav-menu-link">Bincang Isyarat</a></li>
          @endif
          --}}
          <!-- <li class="float-left"><a href="#" class="text-white btn-upload red ">Upload</a></li> -->
        </ul>
      </div>

      <form action="{{ route('search') }}" method="post" class="col-4 col-xl-3 col-lg-3 align-self-center d-none d-lg-inline-block">
        {{ csrf_field() }}
        <div class="w-100">
          <div class="src-g w-100 position-relative">
            <input name="q" type="search" class="src-inp w-100" placeholder="Cari disini..."/>
            <button class="src-img position-absolute" type="submit" id="">
              <img src="{{url('assets/frontend/img/src.png')}}" class="w-100 h-auto" />
            </button>
          </div>
        </div>
      </form>
      
      <!-- <form action="{{ route('search') }}" method="post" class="d-none d-lg-flex hn-sc">
          {{ csrf_field() }}
          <div class="input-group">
            <input name="q" type="search" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
              <button class="btn d-flex" type="submit" id=""><img src="{{ url('assets/img/src.png') }}" alt="Search" /></button>
            </div>
          </div>
        </form> -->
      <!-- <div class="col-2 col-lg-3 align-self-center d-none d-lg-inline-block">
        <div class="w-100 d-flex align-items-center">
          <div class="notif-sec " style="display: inline-grid;width: 15%;">
            <div class="message-notif position-relative">
              <img src="assets/img/mail.svg" class="position-absolute align-top" alt="mess" />
              <span class="red rounded-circle position-absolute text-white align-bottom">25</span>
            </div>
          </div>
          <div class="notif-sec " style="display: inline-grid;width: 15%;">
            <div class="message-notif position-relative">
              <img src="assets/img/notif.svg" class="position-absolute align-top" alt="mess" />
              <span class="red rounded-circle position-absolute text-white align-bottom">54</span>
            </div>
          </div>
          <div class="notif-sec d-inline-flex align-items-center justify-content-end" style="width: 70%;">
            <div class="message-notif position-relative text-right d-inline-flex align-items-center">
              <div class="text-grey d-inline-flex" style="font-size: 12pt;">Ahmad Rifki Fachrudin</div>
              <img src="assets/img/ava.jpg" class="align-top rounded-circle ml-3" style="width: 35px;height: 35px;" alt="mess" />
            </div>
          </div>
        </div>
      </div> -->
    
  </div>
</header>
<div class="space-header"></div>

<!-- /Header -->