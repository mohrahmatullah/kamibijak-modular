@if((Request::is('v/*')))
<!-- Comment -->
<!-- <div class="space-head"></div>
<nav class="nav-menu">
  <div class="row mx-0">
    <div class="col-12 py-2">
      <div class="src-g w-100 position-relative">
        <input type="text" class="src-inp w-100" placeholder="Ketik komentar disini"/>
        <div class="src-img position-absolute" ><img src="{{url('assets/frontend/img/send.png')}}" class="w-100 h-auto" /></div>
      </div>
    </div>
  </div>
</nav> -->
<!-- Comment -->
@else
<!-- Nav Menu -->
<div class="space-head"></div>
<nav class="nav-menu">
  <div class="row mx-0 h-100 align-items-center">
    <div class="col-3 px-0 text-center">
      @if((Request::is('/')))
      <a href="{{route('home')}}" class="menu-link active">
        <svg>
          <use xlink:href="#home" />
        </svg>
        <div>Beranda</div>
      </a>
      @else
      <a href="{{route('home')}}" class="menu-link">
        <svg>
          <use xlink:href="#home" />
        </svg>
        <div>Beranda</div>
      </a>
      @endif
    </div>
    <div class="col-3 px-0 text-center">
      @if((Request::is('explore')))
      <a href="{{route('explore')}}" class="menu-link active">
        <svg>
          <use xlink:href="#explore" />
        </svg>
        <div>Explore</div>
      </a>
      @else
      <a href="{{route('explore')}}" class="menu-link">
        <svg>
          <use xlink:href="#explore" />
        </svg>
        <div>Explore</div>
      </a>
      @endif
    </div>
    <div class="col-3 px-0 text-center">
      @if((Request::is('highlight')))
      <a href="{{route('highlight')}}" class="menu-link active">
        <svg>
          <use xlink:href="#highlight" />
        </svg>
        <div>Highlight</div>
      </a>
      @else
      <a href="{{route('highlight')}}" class="menu-link">
        <svg>
          <use xlink:href="#highlight" />
        </svg>
        <div>Highlight</div>
      </a>
      @endif
    </div>
    <div class="col-3 px-0 text-center">
      @if((Request::is('menu')))
      <a href="{{ route('menu') }}" class="menu-link active">
        <svg>
          <use xlink:href="#menu" />
        </svg>
        <div>Menu</div>
      </a>
      @else
      <a href="{{ route('menu') }}" class="menu-link">
        <svg>
          <use xlink:href="#menu" />
        </svg>
        <div>Menu</div>
      </a>
      @endif
    </div>
  </div>
</nav>
<!-- Nav Menu -->

<!-- Footer -->
<!-- /Footer -->

<!-- SVG -->
<!-- Menu Navbar -->
<svg style="display: none">
  <symbol width="22" height="22" viewBox="0 0 32 32" id="home">
    <path class="a" d="M29.4,15.6,17.6,3.8h0a2,2,0,0,0-.9-.5,1.48,1.48,0,0,0-.7-.1h0a2.28,2.28,0,0,0-1.1.3,1,1,0,0,0-.5.4L2.6,15.6a2.17,2.17,0,0,0-.3,2.9,2.28,2.28,0,0,0,3.5.3l.8-.8v9.2a1.75,1.75,0,0,0,1.7,1.7h4.1a1.32,1.32,0,0,0,1.3-1.3v-7a.9.9,0,0,1,.9-.9h2.6a.9.9,0,0,1,.9.9v7.1A1.24,1.24,0,0,0,19.3,29h4.4a1.75,1.75,0,0,0,1.7-1.7V18l.9.9a2.27,2.27,0,0,0,3.3-.1,2.34,2.34,0,0,0-.2-3.2" transform="translate(-1.87 -3.2)"/>
  </symbol>
  <symbol width="22" height="22" viewBox="0 0 32 32" id="explore">
    <rect class="a" width="12.2" height="12.2"/><rect class="a" y="15.7" width="12.2" height="12.2"/><rect class="a" x="15.8" width="12.2" height="12.2"/><rect class="a" x="15.8" y="15.7" width="12.2" height="12.2"/>
  </symbol>
  <symbol width="22" height="22" viewBox="0 0 32 32" id="highlight">
    <path class="a" d="M20.1,20A8.28,8.28,0,1,1,20,5.6h.2a7.86,7.86,0,0,1,3,3A8.44,8.44,0,0,1,20.1,20Zm7.8,5.8s-3.1-5.4-3.7-6.3a2.82,2.82,0,0,0,1.6-.9c.5-.8-.4-2.1-.1-3s1.6-1.7,1.6-2.6-1.4-1.9-1.6-2.8.6-2.2.1-3-2-.7-2.7-1.4-.7-2.2-1.5-2.6-2.1.4-3,.2S16.9,1.9,16,1.9s-2.4,1.5-2.7,1.6c-.9.2-2.2-.7-3-.2s-.8,2-1.5,2.6-2.2.4-2.6,1.2.4,2.1.1,3-1.6,1.8-1.6,2.8S6,14.6,6.3,15.5s-.6,2.2-.1,3a1.68,1.68,0,0,0,1.4.8c.1,0,.2.1.1.2-.4.7-3.6,6.2-3.6,6.2-.3.4,0,.8.5.8l2.4.2a2,2,0,0,1,1.4.8l1.3,2.1a.57.57,0,0,0,1,0l3.7-6.4c.1-.1.1-.1.2,0a3.08,3.08,0,0,0,1.4.7,1.89,1.89,0,0,0,1.3-.7.14.14,0,0,1,.2,0l3.7,6.4a.57.57,0,0,0,1,0l1.3-2.1a2,2,0,0,1,1.4-.8l2.5-.1C28,26.6,28.2,26.2,27.9,25.8Z" transform="translate(-3.98 -1.9)"/><path class="a" d="M20.3,12.3l-1.2,1.1a1.74,1.74,0,0,0-.5,1.5l.3,1.6c.1.5-.2.7-.7.5l-1.4-.8a2.21,2.21,0,0,0-1.6,0l-1.4.8c-.4.2-.7,0-.7-.5l.3-1.6a1.65,1.65,0,0,0-.5-1.5l-1.2-1.1c-.4-.4-.2-.7.3-.8l1.6-.2a1.89,1.89,0,0,0,1.3-1l.7-1.5c.2-.5.6-.5.8,0l.7,1.5a1.89,1.89,0,0,0,1.3,1l1.6.2C20.6,11.6,20.7,11.9,20.3,12.3Zm-.8-5.5h0a7,7,0,0,0-7,0A6.9,6.9,0,0,0,10,16.3a7.56,7.56,0,0,0,2.3,2.4.31.31,0,0,0,.2.1,6.95,6.95,0,1,0,7-12Z" transform="translate(-3.98 -1.9)"/>
  </symbol>
  <symbol width="22" height="22" viewBox="0 0 32 32" id="menu">
    <path class="a" d="M3.1,5.74A1.51,1.51,0,0,1,4.81,4H27.19A1.51,1.51,0,0,1,28.9,5.74a1.51,1.51,0,0,1-1.71,1.71H4.81A1.51,1.51,0,0,1,3.1,5.74Z" transform="translate(-3.1 -4.03)"/><path class="a" d="M3.1,16a1.51,1.51,0,0,1,1.71-1.71H27.19A1.51,1.51,0,0,1,28.9,16a1.51,1.51,0,0,1-1.71,1.71H4.81A1.51,1.51,0,0,1,3.1,16Z" transform="translate(-3.1 -4.03)"/><path class="a" d="M3.1,26.26a1.51,1.51,0,0,1,1.71-1.71H27.19a1.51,1.51,0,0,1,1.71,1.71A1.51,1.51,0,0,1,27.19,28H4.81A1.51,1.51,0,0,1,3.1,26.26Z" transform="translate(-3.1 -4.03)"/>
  </symbol>
</svg>
<!-- /SVG -->
@endif