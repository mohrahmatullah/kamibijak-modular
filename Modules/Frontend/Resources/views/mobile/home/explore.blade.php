@extends('frontend::mobile.includes.default')
@section('title', 'Explore - KamiBijak')
@section('content')
<!-- Main content -->
<main>

  <div class="container-m">
    <section>
      <div class="row mx-0">
        <div class="col-12 px-0">
          <div id="navheadExp" class="row mx-0 white">
            <div class="col-12 py-3">
              <div class="w-100 d-flex justify-content-center">
                <ul class="list-unstyled mb-0 hd-lnk-m">                  
                  <!-- <li class="mr-2 py-2"><a href="/vc/viral" class="hd-lnk">Viral</a></li> --> 
                  @php
                    $menu_category = DB::table('post_category')->orderby('section', 'ASC')->get();
                  @endphp   
                  @foreach($menu_category as $mc)
                  <li class="mr-2 py-2"><a href="{{ route('category', $mc->slug)}}" class="hd-lnk">{{ $mc->name }}</a></li>
                  @endforeach              
                  <!-- <li class="mr-2 py-2"><a href="/vc/kabarbijak" class="hd-lnk">KabarBijak</a></li>
                  <li class="mr-2 py-2"><a href="/vc/bijakfun" class="hd-lnk">BijakFun</a></li>
                  <li class="mr-2 py-2"><a href="/vc/jalan-jalan-kuliner" class="hd-lnk">Jalan-Jalan Kuliner</a></li>
                  <li class="mr-2 py-2"><a href="/vc/bijakflash" class="hd-lnk">BijakFlash </a></li>
                  <li class="mr-2 py-2"><a href="/vc/ruang-kamibijak" class="hd-lnk">Ruang Kamibijak</a></li>
                  <li class="mr-2 py-2"><a href="/vc/bincang-isyarat" class="hd-lnk">Bincang Isyarat</a></li> -->
                </ul>
              </div>
              <!-- <div class="w-100 mb-2">
                <div class="src-g w-100 position-relative">
                  <input type="text" class="src-inp w-100" placeholder="Cari disini..."/>
                  <div class="src-img position-absolute" ><img src="{{url('assets/frontend/img/src.png')}}" class="w-100 h-auto" /></div>
                </div>
              </div> -->
            </div>
          </div>

          <div class="row mx-0">
            <div class="col-12 px-0">

              @foreach($category as $c)
                @foreach($c as $group => $y)

                  <div class="row mx-0">
                    <div class="col-12 px-0">

                      @if($group == 'infosiana')
                        <!-- START ZONA BANNER KB EXPLORE LBT1 MOBILE 350X150 -->
                        @foreach($banners as $b)
                          @if($b->placement == 'kb-explore-lbt1-mobile-350X150')
                            <section class="py-3 mb-3">
                              <div class="w-100 text-center">
                                @if($b->code == '')
                                <a href="{{ $b->link }}">
                                  <img src="{{ env('URL_ASSET').'images/banner/'.$b->media }}" class="of-cover" width="350" height="auto">
                                </a>
                                @else
                                {!! $b->code !!}
                                @endif
                              </div>
                            </section>
                          @endif
                        @endforeach
                        <!-- END ZONA BANNER KB EXPLORE LBT1 MOBILE 350X150 -->
                      @endif
                      @if($group == 'hiburan')
                        <!-- START ZONA BANNER KB EXPLORE MR1 MOBILE 350X350 -->
                        @foreach($banners as $b)
                          @if($b->placement == 'kb-explore-mr1-mobile-350X350')
                            <section class="py-3 mb-3">
                              <div class="w-100 text-center">
                                @if($b->code == '')
                                <a href="{{ $b->link }}">
                                  <img src="{{ env('URL_ASSET').'images/banner/'.$b->media }}" class="of-cover" width="350" height="auto">
                                </a>
                                @else
                                {!! $b->code !!}
                                @endif
                              </div>
                            </section>
                          @endif
                        @endforeach
                        <!-- END ZONA BANNER KB EXPLORE MR1 MOBILE 350X350 -->
                      @endif
                      @if($group == 'kuliner')
                        <!-- START ZONA BANNER KB EXPLORE MR2 MOBILE 350X350 -->
                        @foreach($banners as $b)
                          @if($b->placement == 'kb-explore-mr2-mobile-350X350')
                            <section class="py-3 mb-3">
                              <div class="w-100 text-center">
                                @if($b->code == '')
                                <a href="{{ $b->link }}">
                                  <img src="{{ env('URL_ASSET').'images/banner/'.$b->media }}" class="of-cover" width="350" height="auto">
                                </a>
                                @else
                                {!! $b->code !!}
                                @endif
                              </div>
                            </section>
                          @endif
                        @endforeach
                        <!-- END ZONA BANNER KB EXPLORE MR2 MOBILE 350X350 -->
                      @endif
                      @if($group == 'flash')
                        <!-- START ZONA BANNER KB EXPLORE MR3 MOBILE 350X350 -->
                        @foreach($banners as $b)
                          @if($b->placement == 'kb-explore-mr3-mobile-350X350')
                            <section class="py-3 mb-3">
                              <div class="w-100 text-center">
                                @if($b->code == '')
                                <a href="{{ $b->link }}">
                                  <img src="{{ env('URL_ASSET').'images/banner/'.$b->media }}" class="of-cover" width="350" height="auto">
                                </a>
                                @else
                                {!! $b->code !!}
                                @endif
                              </div>
                            </section>
                          @endif
                        @endforeach
                        <!-- END ZONA BANNER KB EXPLORE MR3 MOBILE 350X350 -->
                      @endif
                      @if($group == 'ruang-kamibijak')
                        <!-- START ZONA BANNER KB EXPLORE MR4 MOBILE 350X350 -->
                        @foreach($banners as $b)
                          @if($b->placement == 'kb-explore-mr4-mobile-350X350')
                            <section class="py-3 mb-3">
                              <div class="w-100 text-center">
                                @if($b->code == '')
                                <a href="{{ $b->link }}">
                                  <img src="{{ env('URL_ASSET').'images/banner/'.$b->media }}" class="of-cover" width="350" height="auto">
                                </a>
                                @else
                                {!! $b->code !!}
                                @endif
                              </div>
                            </section>
                          @endif
                        @endforeach
                        <!-- END ZONA BANNER KB EXPLORE MR4 MOBILE 350X350 -->
                      @endif

                    </div>
                  </div>

                  <div class="row mx-0">
                    <div class="col-12 px-0">
                      <div class="row mx-0">
                        <div class="col-12 ">
                          @php
                          $category = ucwords($group);
                          $category = str_replace('-',' ',$category);
                          @endphp
                          <h5>{{$category}}</h5>
                        </div>
                      </div>
                      @foreach($y as $x)
                      <a href="{{ route('details', $x->slug) }}">
                        <div class="row mx-0">
                          <div class="col-12 ">
                            <div class="row mx-0 mb-3">
                              <div class="col-6 col-sm-4 col-md-3 px-0">
                                <div class="c-thumb-sm-m position-relative">
                                  
                                  @if(!empty($x->cover))
                                  <img src="{{ env('URL_MEDIA').'/'.$x->cover }}" class="w-100 h-100 of-cover position-absolute" />
                                  @else
                                    @php
                                    $embedscript = substr($x->embed, 68, -77);
                                    $url = get_thumnail_youtube();
                                    $thumnbail = str_replace('Thumbnail',$embedscript, $url);
                                    @endphp
                                  <img src="{{ $thumnbail }}" class="w-100 h-100 of-cover position-absolute" />
                                  @endif
                                  <div class="thumb-cnt-sm-m px-3">
                                    <!-- <div class="ply-time tosca text-white px-2 py-1 d-inline-block position-absolute">03.23</div> -->
                                    <span class="ply-btn position-absolute d-inline-block" href="{{ route('details', $x->slug) }}"><img src="{{url('/assets/frontend/img/ply.svg')}}"></span>                         
                                    
                                  </div>
                                </div>
                                
                              </div>
                              <div class="col-6 col-sm-8 col-md-9 px-0">
                                <div class="c-desc-sm-m py-1 px-2">
                                  <div class="desc-t">{{ $x->title }}</div>
                                  <div class="det-desc fs-9">Published on {!! date('F d, Y', strtotime($x->published)) !!}</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                      @endforeach
                      <div class="row mx-0 mb-3">
                        <div class="col-12 text-right">
                          <a href="{{ route('category', $group)}}" class="text-tosca">Lihat lainnya</a>
                        </div>
                      </div>
                    </div>
                  </div>

                @endforeach
              @endforeach
            </div>
          </div>
          
        </div>
      </div>
    </section>
  </div>

  

</main>
<!-- /Main content -->
@endsection