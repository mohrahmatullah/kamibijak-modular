@extends('frontend::mobile.includes.default')
@section('content')
<!-- Main content -->
<main>

  <div class="container-m">
    <section>
      <div class="row mx-0">
        <div class="col-12 px-0">
          <!-- START ZONA BANNER KB CAT LBT1 MOBILE 350X150 -->
          @foreach($banners as $b)
            @if($b->placement == 'kb-cat-lbt1-mobile-350X150')
              <section class="py-3">
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
          <!-- END ZONA BANNER KB CAT LBT1 MOBILE 350X150 -->

          <div class="row mx-0">
              
            @foreach($category as $key => $p)
            
              <div class="col-12 col-sm-6 col-md-4 px-0 px-sm-2">
                <a href="{{ route('details', $p->slug) }}">
                  <div class="row mx-0">
                    <div class="col-12 px-0">
                      <div class="m-c-thumb position-relative" >
                        @if(!empty($p->cover))
                        <img src="{{ env('URL_MEDIA').'/'.$p->cover }}" class="w-100 h-100 of-cover position-absolute" />
                        @else
                          @php
                          $embedscript = substr($p->embed, 68, -77);
                          $url = get_thumnail_youtube();
                          $thumnbail = str_replace('Thumbnail',$embedscript, $url);
                          @endphp
                        <img src="{{ $thumnbail }}" class="w-100 h-100 of-cover position-absolute" />
                        @endif
                        <div class="m-thumb-cnt px-3">
                          <!-- <div class="ply-time position-absolute tosca text-white px-3 py-1 d-inline-block fs-10">03.23</div> -->
                          <span class="ply-btn position-absolute d-inline-block" href="/"><img src="{{url('/assets/frontend/img/ply.svg')}}"></span>                          
                        </div>
                      </div>
                      <div class="m-c-desc p-3">
                        <div>{!! $p->title !!}</div>
                        <div class="det-desc fs-10">Published on {!! date('F d, Y', strtotime($p->published)) !!}</div>
                        <!-- <div>{!! str_limit($p->seo_description, 75) !!}</div> -->
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              @if($key == 4)
                <!-- START ZONA BANNER KB CAT MR1 MOBILE 350X350 -->
                @foreach($banners as $b)
                  @if($b->placement == 'kb-cat-mr1-mobile-350X350')
                    <section class="py-3 mx-1">
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
                <!-- END ZONA BANNER KB CAT MR1 MOBILE 350X350 -->
              @endif

              @if($key == 9)
                <!-- START ZONA BANNER KB CAT MR2 MOBILE 350X350 -->
                @foreach($banners as $b)
                  @if($b->placement == 'kb-cat-mr2-mobile-350X350')
                    <section class="py-3 mx-1">
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
                <!-- END ZONA BANNER KB CAT MR2 MOBILE 350X350 -->
              @endif

              @if($key == 14)
                <!-- START ZONA BANNER KB CAT MR3 MOBILE 350X350 -->
                @foreach($banners as $b)
                  @if($b->placement == 'kb-cat-mr3-mobile-350X350')
                    <section class="py-3 mx-1">
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
                <!-- END ZONA BANNER KB CAT MR3 MOBILE 350X350 -->
              @endif

              @if($key == 19)
                <!-- START ZONA BANNER KB CAT MR4 MOBILE 350X350 -->
                @foreach($banners as $b)
                  @if($b->placement == 'kb-cat-mr1-mobile-350X350')
                    <section class="py-3 mx-1">
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
                <!-- END ZONA BANNER KB CAT MR4 MOBILE 350X350 -->
              @endif
            
            @endforeach

          </div>
          
          <div id="list-terkini-ajax">
            <div class="row justify-content-center">
              <div class="col-10 text-center" id="load-more">
                @php $paginator = $category; @endphp
                {{ $paginator->appends([])->render('frontend::mobile.layouts.pagging-more') }}
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </section>
  </div>

  

</main>
<!-- /Main content -->
@endsection