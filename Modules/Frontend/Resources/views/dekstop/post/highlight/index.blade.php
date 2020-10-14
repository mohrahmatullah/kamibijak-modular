@extends('frontend::dekstop.includes.default')
@section('title', 'Highlight - KamiBijak')
@section('content')
<!-- Main content -->
<div class="position-fixed bg-nav"></div>
<main class="main">
  <section class="w-100 pt-5 pb-5 px-3 white">
    <div class="container">
        <div class="row mb-5">
          <div class="col-12">

            <div class="row">
              <div class="col-12 col-md-7 col-xl-8">

                <div class="row mx-0">
                  <div class="col-12 col-sm-6 col-md-4 px-sm-2">
                    <div class="tag-list">
                      <ul class="list-unstyled">
                        <li class="float-left mr-2"><a class="tag-btn">Highlight</a></li>
                      </ul>
                    </div>
                  </div>            
                </div>
                <br>

                <div class="row mb-3">
                  <div class="col-12">
                    @foreach($post as $key => $vt) 
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
                        <div class="col-12 col-md-7 col-xl-8"> -->
                          <div class="c-desc-2">
                            <div class="d-t-2 mb-3">{{$vt->title}}</div>
                            <div class="d-inf-2 mb-3 pr-5">{!! $vt->seo_description !!}</div>
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
                          @php $paginator = $post; @endphp
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

                <div class="foll-sec">
                  <h5><stron>Follow us</stron></h5>
                  <a href="https://www.facebook.com/KamiBijakID" target="_blank" class="foll-soc mb-2 w-100 d-block text-center p-2" style="height: 40px;background: #516eab;"><img src="{{url('assets/frontend/img/fb-w.png')}}" alt="facebook" style="width: 25px;height: 25px;"/></a>
                  <a href="https://twitter.com/KamiBijakID" target="_blank" class="foll-soc mb-2 w-100 d-block text-center p-2" style="height: 40px;background: #46c5f6;"><img src="{{url('assets/frontend/img/tw-w.png')}}" alt="twitter" style="width: 25px;height: 25px;"/></a>
                  <a href="https://www.instagram.com/KamiBijakID/" target="_blank" class="foll-soc mb-2 w-100 d-block text-center p-2" style="height: 40px;background: linear-gradient(to right, #df4298 , #332171);"><img src="{{url('assets/frontend/img/ig-w.png')}}" alt="twitter" style="width: 25px;height: 25px;"/></a>
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
