@extends('frontend::dekstop.includes.default')
@section('content')
<!-- Main content -->
<div class="position-fixed bg-nav"></div>
<main class="main">
@if(count($popular) > 0)
  <section class="w-100 pt-4 pb-5 px-3 f7">
    <div class="container">

      <!-- START ZONA BANNER KB CAT LBT1 DEKSTOP 970X100 -->
      @foreach($banners as $b)
        @if($b->placement == 'kb-cat-lbt1-dekstop-970X100')
        <section class="py-3 mb-3">
          <div class="container text-center">
            @if($b->code == '')
            <a href="{{ $b->link }}">
              <img src="{{ env('URL_ASSET').'images/banner/'.$b->media }}" class="of-cover" width="970" height="100">
            </a>
            @else
            {!! $b->code !!}
            @endif
          </div>
        </section>
        @endif
      @endforeach
      <!-- END ZONA BANNER KB CAT LBT1 DEKSTOP 970X100 -->

      <div class="row mx-0 mb-3 align-items-center">
        <div class="col-6 px-0 mb-3">
          <h5 class="text-tosca mb-0"><strong>Populer</strong></h5>
        </div>
        <!-- <div class="col-6 px-0 text-right">
          <ul class="list-unstyled mb-0 d-inline-block">
            <li class="float-left"><div class="swip-prev"><img src="./assets/img/next.svg" draggable="false" /></div></li>
            <li class="float-left"><div class="swip-next"><img src="./assets/img/next.svg" draggable="false" /></div></li>
          </ul>
          
        </div> -->
      </div>
      

      <div class="row mx-0">
        <div class="col-12 px-0">

          <div class="owl-carousel owl-theme high-c">
            @foreach($popular as $h)
            <a class="lnk-news" href="{{ route('details', $h->slug) }}">
              <div class="item">
                <div class="d-inline-block card-lg transparent w-100">
                  <div class="c-thumb position-relative mb-3" >
                    @if(!empty($h->cover))
                    <img src="{{ env('URL_MEDIA').'/'.$h->cover }}" class="w-100 h-100 of-cover position-absolute"/>
                    @else
                      @php
                      $embedscript = substr($h->embed, 68, -77);
                      $url = get_thumnail_youtube();
                      $thumnbail = str_replace('Thumbnail',$embedscript, $url);
                      @endphp
                    <img src="{{ $thumnbail }}" class="w-100 h-100 of-cover position-absolute"/>
                    @endif
                    <div class="w-100 h-100 position-absolute" style="background-image: linear-gradient(rgba(0,0,0,0) 60%, rgba(0,0,0,.7));"></div>
                    <div class="thumb-cnt px-3">
                      <div class="row" style="height: 165px;">
                        <div class="col-12 py-2">
                          <div class="row mx-0">
                            <div class="col-6 px-0">
                              
                            </div>
                            <div class="col-6 px-0 text-right">
                              <!-- <div class="tosca text-white px-3 py-1 d-inline-block" style="font-size: 10pt;">03.23</div> -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="c-desc mb-2">
                    <div>{{ $h->title }}</div>
                  </div>
                  <div class="c-akun mb-3">
                    <div>
                      <img src="{{ env('URL_MEDIA').'/'.$h->avatar }}" />
                      {{$h->name}} &nbsp;&nbsp; {{timeAgo($h->published)}}
                    </div>
                  </div>
                </div>
              </div>
            </a>
            @endforeach

          </div>

        </div>
      </div>
    </div>
    
  </section>
@endif
  <section class="w-100 pt-5 pb-5 px-3 white">
    <div class="container">
        <div class="row mb-5">
          <div class="col-12">

            <div class="row">
              <div class="col-12 col-md-7 col-xl-8">

                <!-- START ZONA BANNER KB CAT LBT2 DEKSTOP 730X150 -->
                @foreach($banners as $b)
                  @if($b->placement == 'kb-cat-lbt2-dekstop-730X150')
                    <section class="py-3">
                      <div class="w-100 text-center">
                        @if($b->code == '')
                        <a href="{{ $b->link }}">
                          <img src="{{ env('URL_ASSET').'images/banner/'.$b->media }}" class="of-cover" width="730" height="150">
                        </a>
                        @else
                        {!! $b->code !!}
                        @endif
                      </div>
                    </section>
                  @endif
                @endforeach
                <!-- END ZONA BANNER KB CAT LBT2 DEKSTOP 730X150 -->

                <div class="row mx-0 mb-3 align-items-center">
                  <div class="col-12 px-0">
                    <h5 class="text-tosca mb-0"><strong>{{$namecategory}}</strong></h5>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-12">
                    @foreach($category as $key => $vt)
                    <a class="lnk-news" href="{{ route('details', $vt->slug) }}">  
                      <div class="d-flex card-2 mb-3 wow fadeIn">
                        <!-- <div class="col-12 col-md-5 col-xl-4" > -->
                          <div class="c-thumb-2 mr-3">
                            @if(!empty($vt->cover))
                            <img src="{{ env('URL_MEDIA').'/'.$vt->cover }}" class="w-100 h-100 of-cover position-absolute"/>
                            @else
                              @php
                              $embedscript = substr($vt->embed, 68, -77);
                              $url = get_thumnail_youtube();
                              $thumnbail = str_replace('Thumbnail',$embedscript, $url);
                              @endphp
                            <img src="{{ $thumnbail }}" class="w-100 h-100 of-cover position-absolute"/>
                            @endif
                            <div class="thumb-cnt px-3 d-flex align-items-end justify-content-end h-100">
                              <!-- <div class="tosca text-white px-2 py-1 d-inline-flex mb-2" style="font-size: 10pt;z-index: 1;">03.23</div> -->
                            </div>
                          </div>
                        <!-- </div>
                        <div class="col-12 col-md-7 col-xl-7"> -->
                          <div class="c-desc-2">
                            <div class="d-t-2 mb-3">{{$vt->title}}</div>
                            <div class="d-inf-2 mb-3">{!! $vt->seo_description !!}</div>
                            <div class="d-akun-2 mb-3">
                              <div>
                                <img src="{{ env('URL_MEDIA').'/'.$vt->avatar }}" />
                                {{$vt->name}} &nbsp;&nbsp; {{timeAgo($vt->published)}}
                              </div>
                            </div>
                          </div>
                        <!-- </div> -->
                      </div>
                    </a>
                    @endforeach                    
                    <div id="list-terkini-ajax">
                        <div id="load-more">
                          @php $paginator = $category; @endphp
                          {{ $paginator->appends([])->render('frontend::dekstop.layouts.pagging-more') }}
                        </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-12 col-md-5 col-xl-4">
                
                <!-- <div class="subs-card text-center mb-5">
                  <div class="d-inline-block mb-5 subs-t">
                    <strong>Subscribe to our<br />Newsletter</strong>
                  </div>
                  <div class="s-form">
                    <form action="">
                      <input type="text" class="mb-3" placeholder="Enter your email address"  />
                      <input type="button" class="mb-3" value="Subscribe"  />
                      <div class="text-center" style="font-size: 10pt;font-weight: normal;color: rgba(0,0,0,.5);">Don't worry, we don't spam</div>
                    </form>
                  </div>
                </div> -->
                
                <!-- START ZONA BANNER KB CAT MR1 DEKSTOP 350X350 -->
                @foreach($banners as $b)
                  @if($b->placement == 'kb-cat-mr1-dekstop-350X350')
                  <section class="py-3">
                    <div class="w-100 text-center">
                        @if($b->code == '')
                        <a href="{{ $b->link }}">
                          <img src="{{ env('URL_ASSET').'images/banner/'.$b->media }}" class="of-cover" width="350" height="350">
                        </a>
                        @else
                        {!! $b->code !!}
                        @endif
                    </div>                    
                  </section>
                  @endif
                @endforeach
                <!-- END ZONA BANNER KB CAT MR1 DEKSTOP 350X350 -->

                <div class="foll-sec">
                  <h5><stron>Follow us</stron></h5>
                  <a href="https://www.facebook.com/KamiBijakID" target="_blank" class="foll-soc mb-2 w-100 d-block text-center p-2" style="height: 40px;background: #516eab;"><img src="{{url('assets/frontend/img/fb-w.png')}}" alt="facebook" style="width: 25px;height: 25px;"/></a>
                  <a href="https://twitter.com/KamiBijakID" target="_blank" class="foll-soc mb-2 w-100 d-block text-center p-2" style="height: 40px;background: #46c5f6;"><img src="{{url('assets/frontend/img/tw-w.png')}}" alt="twitter" style="width: 25px;height: 25px;"/></a>
                  <a href="https://www.instagram.com/KamiBijakID/" target="_blank" class="foll-soc mb-2 w-100 d-block text-center p-2" style="height: 40px;background: linear-gradient(to right, #df4298 , #332171);"><img src="{{url('assets/frontend/img/ig-w.png')}}" alt="twitter" style="width: 25px;height: 25px;"/></a>
                </div>

                <!-- START ZONA BANNER KB CAT MR2 DEKSTOP 350X350 -->
                @foreach($banners as $b)
                  @if($b->placement == 'kb-cat-mr2-dekstop-350X350')
                  <section class="py-3">
                    <div class="w-100 text-center">
                        @if($b->code == '')
                        <a href="{{ $b->link }}">
                          <img src="{{ env('URL_ASSET').'images/banner/'.$b->media }}" class="of-cover" width="350" height="350">
                        </a>
                        @else
                        {!! $b->code !!}
                        @endif
                    </div>                    
                  </section>
                  @endif
                @endforeach
                <!-- END ZONA BANNER KB CAT MR2 DEKSTOP 350X350 -->
                <!-- START ZONA BANNER KB CAT MR3 DEKSTOP 350X350 -->
                @foreach($banners as $b)
                  @if($b->placement == 'kb-cat-mr3-dekstop-350X350')
                  <section class="py-3">
                    <div class="w-100 text-center">
                        @if($b->code == '')
                        <a href="{{ $b->link }}">
                          <img src="{{ env('URL_ASSET').'images/banner/'.$b->media }}" class="of-cover" width="350" height="350">
                        </a>
                        @else
                        {!! $b->code !!}
                        @endif
                    </div>                    
                  </section>
                  @endif
                @endforeach
                <!-- END ZONA BANNER KB CAT MR3 DEKSTOP 350X350 -->
                <!-- START ZONA BANNER KB CAT MR4 DEKSTOP 350X350 -->
                @foreach($banners as $b)
                  @if($b->placement == 'kb-cat-mr4-dekstop-350X350')
                  <section class="py-3">
                    <div class="w-100 text-center">
                        @if($b->code == '')
                        <a href="{{ $b->link }}">
                          <img src="{{ env('URL_ASSET').'images/banner/'.$b->media }}" class="of-cover" width="350" height="350">
                        </a>
                        @else
                        {!! $b->code !!}
                        @endif
                    </div>                    
                  </section>
                  @endif
                @endforeach
                <!-- END ZONA BANNER KB CAT MR4 DEKSTOP 350X350 -->

              </div>
            </div>

          </div>
        </div>
    </div>
  </section>
</main>
<!-- /Main content -->
@endsection
