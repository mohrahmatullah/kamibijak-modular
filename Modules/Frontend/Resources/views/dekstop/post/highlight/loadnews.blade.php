<div id="list-terkini">
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
      <!-- </div> -->
      <!-- <div class="col-12 col-md-7 col-xl-8"> -->
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
    <div class="row my-3">
        <div class="col-12 text-center" id="load-more">
          @php $paginator = $post; @endphp
          {{ $paginator->appends([])->render('frontend::dekstop.layouts.pagging-more') }}
        </div>
    </div>
  </div>
</div>