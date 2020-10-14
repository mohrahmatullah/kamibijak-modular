<div id="list-terkini">
  <div class="row mx-0">
            
    @foreach($tag as $p)
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
    @endforeach

  </div>
  <!-- <div class="infinite-scroll text-center" style="display:none">
    <p>Load More</p>
  </div> -->
  <div id="list-terkini-ajax">
    <div class="row my-3">
        <div class="col-12 text-center" id="load-more">
          @php $paginator = $tag; @endphp
          {{ $paginator->appends([])->render('frontend::mobile.layouts.pagging-more') }}
        </div>
    </div>
  </div>
</div>