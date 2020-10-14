@extends('frontend::mobile.includes.default')
@section('title', 'Menu - KamiBijak')
@section('content')
<!-- Main content -->
<main>
  <section>
    <div class="row mx-0">
      <div class="col-12 px-0">

        <div class="row mx-0 mb-3" style="border-bottom: 1px solid rgba(0,0,0,.1);">
          <div class="col-12 px-0 py-3">
            <ul class="list-unstyled mb-0">
             <!--  <li class="text-center py-3">
                <a href="/vc/viral" class="text-black" style="font-size: 15pt;font-weight: 400;">Viral</a>
              </li> --> 
              @php
                $menu_category = DB::table('post_category')->orderby('section', 'ASC')->get();
              @endphp
              
              @foreach($menu_category as $mc)
                <li class="text-center py-3">
                  <a href="{{ route('category', $mc->slug)}}" class="text-black @if($mc->favorite == 1 || $mc->new == 1) position-relative @endif" style="font-size: 15pt;font-weight: 400;">{{ $mc->name }}
                    @if($mc->favorite == 1)
                    <div class="position-absolute text-white py-0 px-1 d-inline-block" style="top: 0;background: #f57c00;font-size: 7pt;margin-top: -4px;letter-spacing: 1px;">FAV</div>
                    @endif
                    @if($mc->new == 1)
                    <div class="position-absolute text-white py-0 px-1 d-inline-block" style="top: 0;background: #43a047;font-size: 7pt;margin-top: -4px;letter-spacing: 1px;">NEW</div>
                    @endif
                  </a>
                </li>
              @endforeach             
              <!-- <li class="text-center py-3">
                <a href="/vc/kabarbijak" class="text-black" style="font-size: 15pt;font-weight: 400;">KabarBijak</a>
              </li>
              <li class="text-center py-3">
                <a href="/vc/bijakfun" class="text-black" style="font-size: 15pt;font-weight: 400;">BijakFun</a>
              </li>
              <li class="text-center py-3">
                <a href="/vc/jalan-jalan-kuliner" class="text-black" style="font-size: 15pt;font-weight: 400;">Jalan-Jalan Kuliner</a>
              </li>
              <li class="text-center py-3">
                <a href="/vc/bijakflash" class="text-black" style="font-size: 15pt;font-weight: 400;">BIjakFlash</a>
              </li>
              <li class="text-center py-3">
                <a href="/vc/ruang-kamibijak" class="text-black" style="font-size: 15pt;font-weight: 400;">Ruang Kamibijak</a>
              </li>
              <li class="text-center py-3">
                <a href="/vc/bincang-isyarat" class="text-black" style="font-size: 15pt;font-weight: 400;">Bincang Isyarat</a>
              </li> -->
            </ul>
          </div>
        </div>

        <div class="row mx-0 mb-3" style="border-bottom: 1px solid rgba(0,0,0,.1);">
          <div class="col-12 px-0 py-3">
            <ul class="list-unstyled mb-0">
              <li class="text-center py-3">
                <a href="/page/tentang" class="text-black" style="font-size: 15pt;font-weight: 400;">Tentang kami</a>
              </li>
              <li class="text-center py-3">
                <a href="/page/kontak" class="text-black" style="font-size: 15pt;font-weight: 400;">Kontak</a>
              </li>
              <li class="text-center py-3">
                <a href="/page/redaksi" class="text-black" style="font-size: 15pt;font-weight: 400;">Redaksi</a>
              </li>
            </ul>
          </div>
        </div>

        <div class="row mx-0">
          <div class="col-12 px-0 py-3 text-center">
            <div class="d-inline-block brand-foot mb-4"><img src="{{url('assets/frontend/img/logo.png')}}" class="w-100 h-auto" /></div>
            <div class="t-foot w-100">
              <div class="row mx-0 justify-content-center mb-4">
                <div class="col-7 px-0 text-center">
                  <a href="/page/advertise" class="foot-link">Advertise</a>
                </div>
              </div>
              <div class="row mx-0 justify-content-center mb-4">
                <div class="col-7 px-0 text-center">
                  <div class="foot-link"><a href="/page/terms-privacy-policy-safety"> Terms Privacy Policy & Safety</a> Copyright &copy; 2019 <a href="/">Kamibijak.com</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>

</main>
<!-- /Main content -->
@endsection