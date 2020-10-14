<!-- Nav Menu -->
<div class="position-fixed bg-nav clearMenuM"></div>
<nav class="nav-m">
  <div class="row mx-0">
    <div class="col-12 px-0">

      <div class="row mx-0 mb-3 bb-1">
        <div class="col-12 px-0 py-3">
          <ul class="list-unstyled mb-0">
            <li class="px-4 py-3">
              <a href="/" class="text-black fs-14 d-flex align-items-center">
                <img class="mr-3" src="{{url('assets/frontend/img/home.png')}}" alt="home" style="width: 20px;height: 20px;"/>
                Home
              </a>
            </li>
            <li class="px-4 py-3">
              <a href="{{ route('highlight')}}" class="text-black fs-14 d-flex align-items-center">
                <img class="mr-3" src="{{url('assets/frontend/img/hight.png')}}" alt="hight" style="width: 20px;height: 20px;"/>
                Highlight
              </a>
            </li>
            <li class="px-4 py-3">
              <a href="{{ route('trending')}}" class="text-black fs-14 d-flex align-items-center">
                <img class="mr-3" src="{{url('assets/frontend/img/star-b.png')}}" alt="star" style="width: 20px;height: 20px;"/>  
                Populer
              </a>
            </li>
          </ul>
        </div>
      </div>

      <!-- <div class="row mx-0 mb-3 bb-1">
        <div class="col-12 px-0 py-3">
          <ul class="list-unstyled mb-0">
            <li class="px-4 py-3">
              <a href="/" class="text-black fs-14">History</a>
            </li>
            <li class="px-4 py-3">
              <a href="/" class="text-black fs-14">Tersimpan</a>
            </li>
          </ul>
        </div>
      </div> -->

      <!-- <div class="row mx-0 mb-3 bb-1">
        <div class="col-12 px-0 py-3">
          <ul class="list-unstyled mb-0">
            <li class="px-4 py-3">
              <a href="/" class="text-black fs-14">Setting</a>
            </li>
            <li class="px-4 py-3">
              <a href="/" class="text-black fs-14">Help</a>
            </li>
          </ul>
        </div>
      </div> -->

      <div class="row mx-0">
        <div class="col-12 px-0 py-3">
          <!-- <div class="d-inline-block brand-foot mb-4"><img src="./assets/img/logo.png" class="w-100 h-auto" /></div> -->
          <div class="t-foot w-100">
            <div class="row mx-0 px-4 mb-4">
              <div class="col-12 px-0">
                @php
                  $page = DB::table('page')->get();
                @endphp
                @foreach($page as $p)
                  <a href="{{ route('page', $p->slug)}}" class="foot-link"><h4 class="fs-10 d-inline-block">{{ $p->title }}</h4></a>
                @endforeach
              </div>
            </div>
            <div class="row mx-0 px-4 mb-4">
              <div class="col-12 px-0">
                <div class="foot-link"><h5 class="fs-10 d-inline-block"> Copyright &copy; 2019 <a href="/" class="d-inline-block"><h6 class="fs-10 d-inline-block">Kamibijak.com</h6></a></h5></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</nav>
<!-- /Nav Menu -->