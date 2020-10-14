@if((Request::is('menu')))
<!-- Navbar Header -->
<header>
  <nav class="navhead-m">
    <div class="container position-relative">

      <!-- Explore/Highlight/Menu Page -->
      <div class="row h-100">
        <div class="col-12 h-100 py-3 d-flex justify-content-center align-items-center">
          <div class="head-t text-tosca">Menu</div>
        </div>
      </div>

      <!-- Home Page -->
      <!-- <div class="row">
        <div class="col-12 py-3 d-flex justify-content-between align-items-center">
          <div class="brand"><img src="./assets/img/logo.png" class="w-100 h-auto" /></div>
          <div class="src"><img src="./assets/img/src.png" class="w-100 h-auto" /></div>
        </div>
      </div> -->

    </div>
  </nav>
  <div class="space-head"></div>
</header>
<!-- /Navbar Header -->
@elseif((Request::is('vc/*')))
<!-- Navbar Header -->
<header>
  <nav class="navhead-m">
    <div class="container position-relative">

      <!-- Explore/Highlight Page -->
      <!-- <div class="row h-100">
        <div class="col-12 h-100 py-3 d-flex justify-content-center align-items-center">
          <div class="head-t text-tosca">Highlight</div>
        </div>
      </div> -->

      <!-- Category Page -->
      <div class="row src-h-b">
        <div class="col-12 py-3 d-flex justify-content-between align-items-center">
          <div class="back ">
            <a href="javascript:history.back()" class="d-flex align-items-center">
              <img src="{{url('assets/frontend/img/back.png')}}" class="mr-3" /><div class="d-inline-block text-tosca" >{{ $namecategory->namecategory}}</div>
            </a>
          </div>
          <div class="src-btn-m"><img src="{{url('assets/frontend/img/src.png')}}" class="w-100 h-auto" /></div>
        </div>
      </div>

      <form action="{{ route('search') }}" method="post" class="row src-h-a position-absolute w-100" style="opacity: 0;">
        {{ csrf_field() }}
        <div class="col-12 p-2">
          <div class="w-100">
            <div class="src-g w-100 position-relative">
              <input name="q" type="search" class="src-inp w-100" placeholder="Cari disini..."/>
              <button class="src-img position-absolute" type="submit" id="">
                <img src="{{url('assets/frontend/img/src.png')}}" class="w-100 h-auto" />
              </button>
            </div>
          </div>
        </div>
      </form>

    </div>
  </nav>
  <div class="space-head"></div>
</header>
<!-- /Navbar Header -->
@elseif((Request::is('v/*')))
<!-- Navbar Header -->
<header>
  <nav class="navhead-m">
    <div class="container position-relative">

      <!-- Explore/Highlight Page -->
      <!-- <div class="row h-100">
        <div class="col-12 h-100 py-3 d-flex justify-content-center align-items-center">
          <div class="head-t text-tosca">Highlight</div>
        </div>
      </div> -->

      <!-- Category Page -->
      <div class="row src-h-b">
        <div class="col-12 py-3 d-flex justify-content-between align-items-center">
          <div class="back ">
            <a href="javascript:history.back()" class="d-flex align-items-center">
              <img src="{{url('assets/frontend/img/back.png')}}" class="mr-3" />
            </a>
          </div>
          <div class="">
            <button class="btn" data-toggle="modal" data-target="#modalShare"><img src="{{url('assets/frontend/img/ico-share.png')}}" style="width: 22px;height: 22px;" /></button>
            <!-- <a href="javascript:voip(0);" id="Bookmark"><img src="{{url('assets/frontend/img/star.png')}}" style="width: 22px;height: 22px;" /></a> -->
          </div>
          <!-- <div class="src-btn-m"><img src="{{url('assets/frontend/img/src.png')}}" class="w-100 h-auto" /></div> -->
        </div>
      </div>

      <form action="{{ route('search') }}" method="post" class="row src-h-a position-absolute w-100" style="opacity: 0;">
        {{ csrf_field() }}
        <div class="col-12 p-2">
          <div class="w-100">
            <div class="src-g w-100 position-relative">
              <input name="q" type="search" class="src-inp w-100" placeholder="Cari disini..."/>
              <button class="src-img position-absolute" type="submit" id="">
                <img src="{{url('assets/frontend/img/src.png')}}" class="w-100 h-auto" />
              </button>
            </div>
          </div>
        </div>
      </form>

    </div>
  </nav>
  <div class="space-head"></div>
</header>
<!-- /Navbar Header -->
@elseif((Request::is('highlight')))
<!-- Navbar Header -->
<header>
  <nav class="navhead-m">
    <div class="container h-100">

      <!-- Explore/Highlight Page -->
      <div class="row h-100">
        <div class="col-12 h-100 py-3 d-flex justify-content-center align-items-center">
          <div class="head-t text-tosca">Highlight</div>
        </div>
      </div>

      <!-- Home Page -->
      <!-- <div class="row">
        <div class="col-12 py-3 d-flex justify-content-between align-items-center">
          <div class="brand"><img src="./assets/img/logo.png" class="w-100 h-auto" /></div>
          <div class="src"><img src="./assets/img/src.png" class="w-100 h-auto" /></div>
        </div>
      </div> -->

    </div>
  </nav>
  <div class="space-head"></div>
</header>
<!-- /Navbar Header -->
@elseif((Request::is('explore')))
<!-- Navbar Header -->
<header>
  <nav class="navhead-m position-relative">
    <div class="container h-100">

      <!-- Explore Page -->
      <div class="row h-100">
        <div class="col-12 h-100 py-3 d-flex justify-content-center align-items-center">
          <div class="head-t text-tosca explore-text">Explore</div>
          <div class="w-100 head-category" style="display: none;">
            <ul class="list-unstyled mb-0 hd-lnk-m">                  
              <!-- <li class="mr-2 py-2"><a href="/vc/viral" class="hd-lnk">Viral</a></li> -->
              <li class="mr-2 py-2"><a href="/vc/entertaiment" class="hd-lnk">Entertaiment</a></li>
              <li class="mr-2 py-2"><a href="/vc/kuliner" class="hd-lnk">Kuliner</a></li>
              <li class="mr-2 py-2"><a href="/vc/flash" class="hd-lnk">Flash </a></li>
              <li class="mr-2 py-2"><a href="/vc/infosiana" class="hd-lnk">Infosiana</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Home Page -->
      <!-- <div class="row">
        <div class="col-12 py-3 d-flex justify-content-between align-items-center">
          <div class="brand"><img src="./assets/img/logo.png" class="w-100 h-auto" /></div>
          <div class="src"><img src="./assets/img/src.png" class="w-100 h-auto" /></div>
        </div>
      </div> -->

    </div>
  </nav>
  <!-- <div class="space-head"></div> -->
</header>
<!-- /Navbar Header -->
@else
<!-- Navbar Header -->
<header>
  <nav class="navhead-m">
    <div class="container position-relative">

      <!-- Explore/Highlight Page -->
      <!-- <div class="row h-100">
        <div class="col-12 h-100 py-3 d-flex justify-content-center align-items-center">
          <div class="head-t text-tosca">Highlight</div>
        </div>
      </div> -->

      <!-- Home Page -->
      <div class="row src-h-b">
        <div class="col-12 py-3 d-flex justify-content-between align-items-center">
          <div class="brand" onclick="window.location='/';"><img src="{{url('assets/frontend/img/logo.png')}}" class="w-100 h-auto" /></div>
          <div class="src-btn-m"><img src="{{url('assets/frontend/img/src.png')}}" class="w-100 h-auto" /></div>
        </div>
      </div>

      <form action="{{ route('search') }}" method="post" class="row src-h-a position-absolute w-100" style="opacity: 0;">
        {{ csrf_field() }}
        <div class="col-12 p-2">
          <div class="w-100">
            <div class="src-g w-100 position-relative">
              <input name="q" type="search" class="src-inp w-100" placeholder="Cari disini..."/>
              <button class="src-img position-absolute" type="submit" id="">
                <img src="{{url('assets/frontend/img/src.png')}}" class="w-100 h-auto" />
              </button>
            </div>
          </div>
        </div>
      </form>

    </div>
  </nav>
  <div class="space-head"></div>
</header>
<!-- /Navbar Header -->
@endif