@extends('frontend::dekstop.includes.default')

@section('content')
<!-- Main content -->
    <div class="position-fixed bg-nav"></div>
    <main class="main">

      <section class="w-100 pt-3 pb-5 px-3" style="background: #f7f7f7;">
        <div class="container">
          <!-- START ZONA BANNER KB READ LBT1 DEKSTOP 970X100 -->
          @foreach($banners as $b)
            @if($b->placement == 'kb-read-lbt1-dekstop-970X100')
            <section class="pb-3 mt-3">
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
          <!-- END ZONA BANNER KB READ LBT1 DEKSTOP 970X100 -->

          <div class="row mb-5 mt-3">
            <div class="col-12">
              <div class="row">
                <div class="col-12 col-md-7 col-xl-8">
                  
                  <div class="row mb-3">
                    <div class="col-12">
                      <div class="position-relative">

                        @if($detail->type_post === 'Article')
                          <img src="{{ env('URL_MEDIA').'/'.$detail->cover }}" width="100%" height="400" alt="">
                        @else
                          @php
                           $embed = str_replace('width="560" height="315"', 'width="100%" height="400" id="id-video"', $detail->embed);
                          @endphp                        
                          {!! $embed !!}
                          
                          @php
                          $embedscript = substr($detail->embed, 68, -77);
                          $url = get_thumnail_youtube();
                          $thumnbail = str_replace('Thumbnail',$embedscript, $url);
                          $embed_y = substr($detail->embed, 38, -77);
                          @endphp

                          @foreach($banners as $b)
                            @if($b->placement == 'dekstop-banner-detail-video-1')
                              @if(!empty($detail->cover))
                              <video poster="{{ $thumnbail }}" id="vid-iklan" class="c-shadow" height="400" style="object-fit: cover;position: absolute;top: 0px;width: 100%; z-index: 1;" controls autoplay muted>
                                  <source src="{{ env('URL_VIDEO').'/'.$b->video }}" type="video/mp4">
                              </video>
                              @else
                              <video poster="{{ $thumnbail }}" id="vid-iklan" class="c-shadow" height="400" style="object-fit: cover;position: absolute;top: 0px;width: 100%; z-index: 1;" controls autoplay muted>
                                  <source src="{{ env('URL_VIDEO').'/'.$b->video }}" type="video/mp4">
                              </video>
                              @endif
                              <a id="btn-skip" onclick="skip()" class="text-uppercase text-white fw-600 py-2 px-3 align-items-center btn-skip-iklan">Lewati Iklan</a>

                              <a href="{{ $b->link }}" id="linkto" class="text-uppercase text-white fw-600 py-2 px-3 align-items-center domain-iklan" target="_blank" >{{$b->website}}</a>

                              <a href="{{ route('details', $detail->slug) }}" id="next-iklan" class="align-items-center text-uppercase text-white fw-600 py-2 px-3 align-items-center" style="display:flex; right: 0px;background: rgba(0, 0, 0, 0.3);position: absolute;z-index: 1;font-size: 12pt;top: 0px;"><p class="mr-3 mb-0" id="countdown"></p><img src="{{ $thumnbail }}" style="object-fit: cover; width: 50; height: 50px;" /></a>
                            @endif
                          @endforeach

                          <input type="hidden" name="embed_url" id="embed_url" value="{{ $embed_y }}">
                          
                          <!-- START ZONA BANNER KB READ LBT2 DEKSTOP 730x150 -->
                          @foreach($banners as $b)
                            @if($b->placement == 'kb-read-lbt2-dekstop-730X150')
                            <section class="pb-3 pt-2">
                              <div class="text-center">
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
                          <!-- END ZONA BANNER KB READ LBT2 DEKSTOP 730x150 -->
                        @endif

                        <div class="white p-4 c-shadow" style="border-radius: 2px;">
                          <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('category', $categoryslug)}}" class="text-uppercase text-tosca fw-600 d-inline-block mb-2">{{ $categoryname }}</a>
                            <button class="btn text-uppercase text-white fw-600 d-inline-flex mb-2 py-1 px-4 fs-10 align-items-center" style="background: #ED3A25;border-radius: 50px;" data-toggle="modal" data-target="#modalShare"><img src="{{url('assets/frontend/img/share.svg')}}" alt="logo" class="mr-2" style="width: 15px; height: 25px;" />Share</button>
                          </div>
                          <h1 class="det-t">{{$detail->title}}</h1>
                          <h2 class="det-sd">{{$detail->seo_description}}</h2>
                          <div class="det-desc fs-12">{{$detail->viewed}} &nbsp; views</div>
                        </div>
                      </div>
  
                    </div>
                  </div>
  
                  <div class="row mb-3">
                    <div class="col-12">
                      <div class="white p-4 c-shadow" style="border-radius: 2px;">
                      
                        <div class="row align-items-center">
                          <div class="col-12 col-md-6">
                            <a href="{{ route('user', $detail->name) }}">
                              <div class="d-flex">
                                <div class="d-inline-flex mr-3">
                                  <img class="img-circle of-cover" src="{{ env('URL_MEDIA').'/'.$detail->avatar }}" style="width: 36px;height: 36px;" />
                                </div>
                                <div class="d-inline-flex flex-column">
                                  <h6 class="text-tosca mb-0">{{$detail->name}}</h6>
                                  <div class="det-desc"><i class="far fa-calendar-alt"></i> Published on {!! date('F d, Y', strtotime($detail->published)) !!}</div>
                                </div>
                              </div>
                            </a>
                          </div>
                          <!-- <div class="col-12 col-md-6 text-md-right">
                            <a href="/" class="py-2 px-4 text-white" style="background: red;border: 2px solid red;">20K Follower</a>
                            <a href="/" class="py-2 px-2 white" style="border: 2px solid red;"><i class="far fa-bell" style="color: red;"></i></a>
                          </div> -->
                        </div>
  
                      </div>
                    </div>
                      
                  </div>
  
                  <div class="row mb-3">
                    <div class="col-12">
                      <div class="white p-4 c-shadow" style="border-radius: 2px;">
                        <div class="mb-4">
                          <!-- <h6 class="text-tosca">About</h6> -->
                          <div class="t-desc">{!! $detail->content !!}</div>
                        </div>
                        <!-- <div class="">
                          <h6 class="text-tosca">Tag</h6>
                          <div class="">
                            <ul class="list-unstyled d-inline-block mb-0">
                              @foreach($tagnews as $t)
                              <li class="float-left"><a href="{{route('tag', $t->slug)}}" class="py-1 px-3 mr-2 d-block text-tosca" style="border-radius: 2px;font-size: 10pt;border: 1px solid #14A3B2;">{{$t->name}}</a></li>
                              @endforeach
                            </ul>
                          </div>
                        </div> -->

                        <div class="row mx-0 mb-3">
                          <div class="col-12">
                            <div class="tag-s ">
                              <div class="text-tosca">Tag</div>
                              <div class="tag-list">
                                <ul class="list-unstyled">
                                  @foreach($tagnews as $t)
                                  <li class="float-left mr-2"><a href="{{route('tag', $t->slug)}}" class="tag-btn">{{$t->name}}</a></li>
                                  @endforeach
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>

                        @if($detail->gallery != 0)
                        <div class="row mx-0">
                          <div class="col-12">
                            <div class="text-tosca mb-3">Gallery</div>
                            <div style="column-count: 3;">
                              @foreach($post_gallery as $pg)
                              <a data-fancybox="gallery" href="{!! env('URL_ASSET') .'images/gallery/'. $pg->media !!}">
                                <img class="w-100 h-auto of-cover mb-3" src="{!! env('URL_ASSET') .'images/gallery/'. $pg->media !!}" alt="">
                              </a>
                              @endforeach
                            </div>
                          </div>
                        </div>
                        @endif
                        
                      </div>
                    </div>
                  </div>

                  <!-- START ZONA BANNER KB READ LBT3 DEKSTOP 730x150 -->
                  @foreach($banners as $b)
                    @if($b->placement == 'kb-read-lbt3-dekstop-730X150')
                    <section class="pb-3">
                      <div class="text-center">
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
                  <!-- END ZONA BANNER KB READ LBT3 DEKSTOP 730x150 -->

                  <div class="row">
                    <div class="col-12">
                      <div class="white p-4 c-shadow" style="border-radius: 2px;">

                        <div class="row mx-0 mb-3 align-items-center">
                          <div class="col-12 px-0">
                            <h3 class="text-tosca mb-0 fs-16"><strong>Video Terbaru</strong></h3>
                          </div>
                        </div>
        
                        <div class="row mb-3">
                          <div class="col-12">
                            @foreach($video_terbaru as $vt)
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
                                    <!-- <div class="thumb-cnt px-3 d-flex align-items-end justify-content-end h-100">
                                      <div class="tosca text-white px-2 py-1 d-inline-flex mb-2" style="font-size: 10pt;z-index: 1;">03.23</div>
                                    </div> -->
                                  </div>
                                <!-- </div>
                                <div class="col-12 col-md-7 col-xl-7"> -->
                                  <div class="c-desc-2">
                                    <div class="d-t-2 mb-3">{{$vt->title}}</div>
                                    <div class="d-inf-2 mb-3">{!! str_limit($vt->seo_description, 75) !!}</div>
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
                                @php $paginator = $video_terbaru; @endphp
                                {{ $paginator->appends([])->render('frontend::dekstop.layouts.pagging-more') }}
                              </div>
                            </div>
                            <!-- <button class="tosca text-white w-100" style="border: none;padding: .75rem;border-radius: 4px;">LOAD MORE</button> -->
                            
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
  
                </div>
                <div class="col-12 col-md-5 col-xl-4">
                  
                  <!-- <div class="row mb-3">
                    <div class="col-12 ">
                      <div class="mb-3" style="background: #eaeaea;width: 336px;height: 280px;"></div>
                    </div>
                  </div> -->

                  <!-- START ZONA BANNER KB READ MR1 DEKSTOP 350X350 -->
                  @foreach($banners as $b)
                    @if($b->placement == 'kb-read-mr1-dekstop-350X350')
                    <section class="pb-3">
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
                  <!-- END ZONA BANNER KB READ MR1 DEKSTOP 350X350 -->

                  <div class="row mb-3">
                    <div class="col-12 ">
                      <h3 class="fs-16">MOST VIEWED</h3>
                    </div>
                  </div>
  
                  <div class="row mb-3">
                    <div class="col-12 ">
                      @foreach($hot_videos as $u)
                      @php
                        $category = DB::table('post_category_chain')->where('post_category_chain.post', $u->id)->leftjoin('post_category','post_category.id','post_category_chain.post_category')->first()->name;
                      @endphp
                      <a class="lnk-news" href="{{ route('details', $u->slug) }}">
                        <div class="row card-sm mb-3 mx-0 wow fadeIn">
                          <div class="col-12 col-md-4 col-xl-4 px-0" >
                            <div class="c-thumb-sm">
                              @if(!empty($u->cover))
                              <img src="{{ env('URL_MEDIA').'/'.$u->cover }}" class="w-100 h-100 of-cover position-absolute">
                              @else
                                @php
                                $embedscript = substr($u->embed, 68, -77);
                                $url = get_thumnail_youtube();
                                $thumnbail = str_replace('Thumbnail',$embedscript, $url);
                                @endphp
                              <img src="{{ $thumnbail }}" class="w-100 h-100 of-cover position-absolute"/>
                              @endif
                              <div class="thumb-cnt-sm px-2 d-flex align-items-end justify-content-end h-100">
                                <!-- <div class="tosca text-white px-2 py-1 d-inline-flex mb-2">03.23</div> -->
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-8 col-xl-8">
                            <div class="c-desc-sm">
                              <div class="d-t-sm mb-1">{{ $u->title }}</div>
                              <div class="d-cat-sm mb-1 text-tosca">{{$category}} <!-- <i class="fas fa-check-circle"></i> --></div>
                              <div class="d-inf-sm mb-1">{{ $u->viewed }} &nbsp; view &nbsp; <i class="far fa-calendar-alt"></i> {{timeAgo($u->published)}}</div>
                              
                            </div>
                          </div>
                        </div>
                      </a>
                      @endforeach
                    </div>
                  </div>
                  <!-- END HOT -->

                  <!-- START ZONA BANNER KB READ MR2 DEKSTOP 350X350 -->
                  @foreach($banners as $b)
                    @if($b->placement == 'kb-read-mr2-dekstop-350X350')
                    <section class="pb-3">
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
                  <!-- END ZONA BANNER KB READ MR2 DEKSTOP 350X350 -->
                  <!-- START ZONA BANNER KB READ MR3 DEKSTOP 350X350 -->
                  @foreach($banners as $b)
                    @if($b->placement == 'kb-read-mr3-dekstop-350X350')
                    <section class="pb-3">
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
                  <!-- END ZONA BANNER KB READ MR3 DEKSTOP 350X350 -->
                  
                  <!-- START UP NEXT -->
                  {{-- <div class="row mb-3">
                    <div class="col-12 ">
                      <h3 class="fs-16">Up Next</h3>
                    </div>
                  </div>
  
                  <div class="row mb-3">
                    <div class="col-12 ">
                      @foreach($up_next as $u)
                      @php
                        $category = DB::table('post_category_chain')->where('post_category_chain.post', $u->id)->leftjoin('post_category','post_category.id','post_category_chain.post_category')->first()->name;
                      @endphp
                      <a class="lnk-news" href="{{ route('details', $u->slug) }}">
                        <div class="row card-sm mb-3 mx-0 wow fadeIn">
                          <div class="col-12 col-md-4 col-xl-4 px-0" >
                            <div class="c-thumb-sm">
                              @if(!empty($u->cover))
                              <img src="{{ env('URL_MEDIA').'/'.$u->cover }}" class="w-100 h-100 of-cover position-absolute">
                              @else
                                @php
                                $embedscript = substr($u->embed, 68, -77);
                                $url = get_thumnail_youtube();
                                $thumnbail = str_replace('Thumbnail',$embedscript, $url);
                                @endphp
                              <img src="{{ $thumnbail }}" class="w-100 h-100 of-cover position-absolute"/>
                              @endif
                              <div class="thumb-cnt-sm px-2 d-flex align-items-end justify-content-end h-100">
                                <!-- <div class="tosca text-white px-2 py-1 d-inline-flex mb-2">03.23</div> -->
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-8 col-xl-8">
                            <div class="c-desc-sm">
                              <div class="d-t-sm mb-1">{{ $u->title }}</div>
                              <div class="d-cat-sm mb-1 text-tosca">{{$category}} <!-- <i class="fas fa-check-circle"></i> --></div>
                              <div class="d-inf-sm mb-1">{{ $u->viewed }} &nbsp; view &nbsp; <i class="far fa-calendar-alt"></i> {{timeAgo($u->published)}}</div>
                              
                            </div>
                          </div>
                        </div>
                      </a>
                      @endforeach
                    </div>
                  </div> --}}
                  <!-- END UP NEXT -->
  
                  <!-- <div class="row mb-3">
                    <div class="col-12 ">
                      <div class="mb-3" style="background: #eaeaea;width: 336px;height: 280px;"></div>
                    </div>
                  </div>
  
                  <div class="row mb-3">
                    <div class="col-12 ">
  
                      <div class="row card-sm mb-3 mx-0 wow fadeIn" onclick="window.location='detail.html';">
                        <div class="col-12 col-md-4 col-xl-4 px-0" >
                          <div class="c-thumb-sm">
                            <img src="./assets/img/ava.jpg" class="w-100 h-100 of-cover position-absolute" />
                            <div class="thumb-cnt-sm px-2 d-flex align-items-end justify-content-end h-100">
                              <div class="tosca text-white px-2 py-1 d-inline-flex mb-2">03.23</div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-md-8 col-xl-8">
                          <div class="c-desc-sm">
                            <div class="d-t-sm mb-1">Fakta Tsunami Selat Sunda yang Mengerikan</div>
                            <div class="d-cat-sm mb-1 text-tosca">Education <i class="fas fa-check-circle"></i></div>
                            <div class="d-inf-sm mb-1">1.8M &nbsp; view &nbsp; <i class="far fa-calendar-alt"></i> 11 Months ago</div>
                            
                          </div>
                        </div>
                      </div>
  
                    </div>
                  </div> -->
  
                </div>
              </div>
  
            </div>
          </div>
        </div>
        

      </section>

      <div class="close-float-vid position-fixed" style="display: none"><i class="fas fa-times"></i></div>

    </main>
    <!-- /Main content -->

    <!-- Modal -->
    <div class="modal fade" id="modalShare" tabindex="-1" role="dialog" aria-labelledby="modalShareLabel" aria-hidden="true">
      <div class="modal-dialog d-flex align-items-center my-0 border-0 c-shadow h-100" role="document">
        <div class="modal-content border-0">
          <div class="modal-header border-bottom py-2 px-3">
            <h5 class="modal-title" id="modalShareLabel">Share to</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul class="list-unstyled d-flex justify-content-center">
              <li class="p-3 mx-6">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('details', $detail->slug) }}?utm_source=facebook&utm_medium=share&utm_campaign=social_media_kamibijak" target="_blank">
                  <img src="{{url('assets/frontend/img/fb.png')}}" style="width: 45px;height: 45px;">
                </a>
              </li>
              <li class="p-3 mx-6">
                <!-- <a href="https://twitter.com/intent/tweet?text={{ route('details', $detail->slug) }}?utm_source=twitter&utm_medium=share&utm_campaign=social_media_kamibijak" data-title="{{ route('details', $detail->title) }}" data-image="{{ route('details', $detail->cover) }}" onclick="_pt(this, &quot;share top&quot;, &quot;twitter&quot;, &quot;share twitter&quot;)" target="_blank"> -->
                  <!-- "https://twitter.com/intent/tweet?text=my share text&amp;url=http://jorenvanhocht.be" -->
                <a href="https://twitter.com/intent/tweet?text={{ route('details', $detail->title) }}&url={{ route('details', $detail->slug) }}" onclick="_pt(this, &quot;share top&quot;, &quot;twitter&quot;, &quot;share twitter&quot;)" target="_blank">
                  <img src="{{url('assets/frontend/img/tw.png')}}" style="width: 45px;height: 45px;">
                </a>
              </li>

              <li class="p-3 mx-6">
                <a href="https://wa.me/?text={{ route('details', $detail->slug) }}?utm_source=whatsapp&utm_medium=share&utm_campaign=social_media_kamibijak" data-action="share/whatsapp/share" target="_blank">
                  <img src="{{url('assets/frontend/img/wa.png')}}" style="width: 45px;height: 45px;">
                </a>
              </li>
              
              <li class="p-3 mx-6">
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('details', $detail->slug) }}?utm_source=linkedin&utm_medium=share&utm_campaign=social_media_kamibijak" target="_blank">
                  <img src="{{url('assets/frontend/img/in.png')}}" style="width: 45px;height: 45px;">
                </a>
              </li>
              <li class="p-3 mx-6">
                <a href="http://pinterest.com/pin/create/button/?url={{ route('details', $detail->slug) }}?&media={!! env('URL_MEDIA_SMALL') .'/'. $is_tw_detail->cover !!}&description={{$vt->title}}?utm_source=pinterest&utm_medium=share&utm_campaign=social_media_kamibijak" target="_blank">
                <!-- <a href="http://pinterest.com/pin/create/button/?url={{ route('details', $detail->slug) }}?utm_source=pinterest&utm_medium=share&utm_campaign=social_media_kamibijak" target="_blank"> -->
                  <img src="{{url('assets/frontend/img/pin.png')}}" style="width: 45px;height: 45px;">
                </a>
              </li>
              {{-- <li class="p-3 mx-6">
                <!-- <a href="https://www.instagram.com/?url={{ route('details', $detail->slug) }}?utm_source=instagram&utm_medium=share&utm_campaign=social_media_kamibijak" target="_blank"> -->
                <a href="https://www.instagram.com/?url={{ route('details', $detail->slug) }}?utm_source=instagram&utm_medium=share&utm_campaign=social_media_kamibijak" target="_blank">
                  <img src="{{url('assets/frontend/img/ig.png')}}" style="width: 45px;height: 45px;">
                </a> 
              </li>--}}
              
              
            </ul>
          </div>
          
        </div>
      </div>
    </div>
@endsection