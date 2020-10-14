@extends('frontend::mobile.post.preview.default')
@section('content')
<!-- Main content -->
<main>

  <div class="container-m">
    <section>
      <div class="row mx-0">
        <div class="col-12 px-0">

          <div class="row mx-0" >
            <div class="col-12 px-0">

              <div class="m-c-thumb position-relative" >
                @if($detail->type_post === 'Article')
                  <img src="{{ env('URL_MEDIA').'/'.$detail->cover }}" class="w-100 h-100 of-cover position-absolute">
                @else
                  @php
                   $embed = str_replace('width="560" height="315"', 'class="w-100 h-100 of-cover position-absolute"', $detail->embed);
                  @endphp
                  {!! $embed !!}
                @endif
              </div>

              <div class="c-title p-3">
                <div class="c-category d-flex justify-content-between align-items-center">
                  <a href="{{ route('category', $categoryslug) }}" class="category-btn">{{ $categoryname }}</a>
                </div>
                <h4 class="mb-3"><strong>{{ $detail->title }}</strong></h4>
                <a href="{{ route('user', $detail->name) }}">
                  <div class="d-flex c-writer">
                    <div class="writer-ava mr-2" style="width: 40px;height: 40px;">
                      <img src="{{ env('URL_MEDIA').'/'.$detail->avatar }}" class="of-cover w-100 h-100 img-circle" />
                    </div>
                    <div class="writer-inf">
                      <div class="writer-date" style="line-height: 20px;font-size: 10pt;color: rgba(0,0,0,.6);">
                        Published {!! date('F d, Y', strtotime($detail->published)) !!}
                        <!-- Published Jan 31, 2019 -->
                      </div>
                      <div class="writer-name" style="line-height: 20px;font-size: 10pt;color: rgba(0,0,0,.6);">
                        {{$detail->name}}
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <div class="c-desc">
                
                @php
                $ja = floor((substr_count( $detail->content, "\n" ) + 1));
                $jp = floor((substr_count( $detail->content, "\n" ) + 1) / 2);
                $ca = explode("\n", $detail->content);
                $ca1 = '';
                $ca2 = '';
                for ($i=0;$i<$jp;$i++){
                  $ca1 = $ca1 . $ca[$i];  
                }
                for ($i=$jp;$i<$ja;$i++){
                  $ca2 = $ca2 . $ca[$i];  
                }
                @endphp
                <div class="mb-3" style="font-size: 14pt;font-weight: normal;">
                  <div class="px-3">
                    {!! $ca1 !!}
                  </div>

                  <!-- START BACA JUGA -->
                  <div class="px-3">
                    @if(count($related_video) > 0)
                    <div class="r-article mb-3">
                      <div class="row mx-0">
                        <div class="col-6 px-0">
                          <h5 class="text-tosca"><strong>Baca Juga</strong></h5>
                        </div>
                      </div>
                      @foreach($related_video as $key => $r)
                      @if($key < 2)
                      <a href="{{ route('details', $r->slug) }}">
                        <div class="row mx-0 mb-4">
                          <div class="col-4 col-sm-4 col-md-3 px-0">
                            <div class="c-thumb-sm-m-d position-relative">
                              @if(!empty($r->cover))
                              <img src="{{ env('URL_MEDIA').'/'.$r->cover }}" class="w-100 h-100 of-cover position-absolute" />
                              @else
                                @php
                                $embedscript = substr($r->embed, 68, -77);
                                $url = get_thumnail_youtube();
                                $thumnbail = str_replace('Thumbnail',$embedscript, $url);
                                @endphp
                              <img src="{{ $thumnbail }}" class="w-100 h-100 of-cover position-absolute" />
                              @endif
                              <div class="thumb-cnt-sm-m-d px-3">
                                <!-- <div class="ply-time tosca text-white px-2 py-1 d-inline-block position-absolute">03.23</div> -->
                                <span class="ply-btn position-absolute d-inline-block" href="/"><img src="{{url('/assets/frontend/img/ply.svg')}}"></span>                          
                                
                              </div>
                            </div>
                            
                          </div>
                          <div class="col-8 col-sm-8 col-md-9 px-0">
                            <div class="c-desc-sm-m-d py-2 px-3">
                              <div class="desc-t">{{ $r->title }}</div>
                            </div>
                          </div>
                        </div>
                      </a>
                      @endif
                      @endforeach
                    </div>
                    @endif
                  </div>                  
                  <!-- END BACA JUGA -->
                  
                  <div class="px-3">
                    {!! $ca2 !!}
                  </div>
                  
                </div>

              </div>

            </div>
          </div>

          <div class="row mx-0 mb-3">
            <div class="col-12">
              <div class="tag-s ">
                <div class="" style="font-size: 11pt;font-weight: normal;color: rgba(0,0,0,.6);">Tagged in</div>
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
              <div style="font-size: 11pt;font-weight: normal;color: rgba(0,0,0,.6);" class="mb-3">Gallery</div>
              <div style="column-count: 2;">
                @foreach($post_gallery as $pg)
                <a data-fancybox="gallery" href="{!! env('URL_ASSET') .'images/gallery/'. $pg->media !!}">
                  <img class="w-100 h-auto of-cover mb-3" src="{!! env('URL_ASSET') .'images/gallery/'. $pg->media !!}" alt="">
                </a>
                @endforeach
              </div>
            </div>
          </div>
          @endif

          <div class="row mx-0">
            <!-- START MOST VIEWED -->
              <div class="col-12 px-0">
                <div class="row mx-0">
                  <div class="col-6">
                    <h5>Most Viewed</h5>
                  </div>
                </div>
                @foreach($hot_videos as $key => $r)
                <a href="{{ route('details', $r->slug) }}">
                  <div class="row mx-0">
                    <div class="col-12 px-0">
                      <div class="m-c-thumb position-relative" >
                        @if(!empty($r->cover))
                        <img src="{{ env('URL_MEDIA').'/'.$r->cover }}" class="w-100 h-100 of-cover position-absolute" />
                        @else
                          @php
                          $embedscript = substr($r->embed, 68, -77);
                          $url = get_thumnail_youtube();
                          $thumnbail = str_replace('Thumbnail',$embedscript, $url);
                          @endphp
                        <img src="{{ $thumnbail }}" class="w-100 h-100 of-cover position-absolute" />
                        @endif
                        <div class="m-thumb-cnt px-3">
                          <!-- <div class="ply-time position-absolute tosca text-white px-3 py-1 d-inline-block fs-10">03.23</div> -->
                          <span class="ply-btn position-absolute d-inline-block" href="{{ route('details', $r->slug) }}"><img src="{{url('/assets/frontend/img/ply.svg')}}"></span>                          
                        </div>
                      </div>
                      <div class="m-c-desc p-3">
                        <div>{{ $r->title }}</div>
                        <div class="det-desc fs-10">Published on {!! date('F d, Y', strtotime($r->published)) !!}</div>
                      </div>
                    </div>
                  </div>
                </a>
                @endforeach
              </div>
            <!-- END MOST VIEWED -->

            <!-- START RELATED VIDEO -->
              {{-- <div class="col-12 px-0">
                <div class="row mx-0">
                  <div class="col-6">
                    <h5>Related Videos</h5>
                  </div>
                </div>
                @foreach($related_video as $key => $r)
                @if($key > 1)
                <a href="{{ route('details', $r->slug) }}">
                  <div class="row mx-0">
                    <div class="col-12 px-0">
                      <div class="m-c-thumb position-relative" >
                        @if(!empty($r->cover))
                        <img src="{{ env('URL_MEDIA').'/'.$r->cover }}" class="w-100 h-100 of-cover position-absolute" />
                        @else
                          @php
                          $embedscript = substr($r->embed, 68, -77);
                          $url = get_thumnail_youtube();
                          $thumnbail = str_replace('Thumbnail',$embedscript, $url);
                          @endphp
                        <img src="{{ $thumnbail }}" class="w-100 h-100 of-cover position-absolute" />
                        @endif
                        <div class="m-thumb-cnt px-3">
                          <!-- <div class="ply-time position-absolute tosca text-white px-3 py-1 d-inline-block fs-10">03.23</div> -->
                          <span class="ply-btn position-absolute d-inline-block" href="{{ route('details', $r->slug) }}"><img src="{{url('/assets/frontend/img/ply.svg')}}"></span>                          
                        </div>
                      </div>
                      <div class="m-c-desc p-3">
                        <div>{{ $r->title }}</div>
                        <div class="det-desc fs-10">Published on {!! date('F d, Y', strtotime($r->published)) !!}</div>
                      </div>
                    </div>
                  </div>
                </a>
                @endif
                @endforeach
              </div> --}}
            <!-- END RELATED VIDEO -->
            </div>
        </div>
      </div>
    </section>
  </div>
  

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
          <li class="p-3 mx-0">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('details', $detail->slug) }}?utm_source=facebook&utm_medium=share&utm_campaign=social_media_kamibijak" target="_blank">
              <img src="{{url('assets/frontend/img/fb.png')}}" style="width: 35px;height: 35px;">
            </a>
            </li>
            <li class="p-3 mx-0">
              <a href="https://twitter.com/intent/tweet?text={{ route('details', $detail->slug) }}?utm_source=twitter&utm_medium=share&utm_campaign=social_media_kamibijak" target="_blank">
                <img src="{{url('assets/frontend/img/tw.png')}}" style="width: 35px;height: 35px;">
              </a>
            </li>  
            <li class="p-3 mx-0">
              <a href="https://wa.me/?text={{ route('details', $detail->slug) }}?utm_source=whatsapp&utm_medium=share&utm_campaign=social_media_kamibijak" target="_blank">
                <img src="{{url('assets/frontend/img/wa.png')}}" style="width: 35px;height: 35px;">
              </a>
            </li> 
            <li class="p-3 mx-0">
              <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('details', $detail->slug) }}?utm_source=linkedin&utm_medium=share&utm_campaign=social_media_kamibijak" target="_blank">
                <img src="{{url('assets/frontend/img/in.png')}}" style="width: 35px;height: 35px;">
              </a>
            </li>            
            <li class="p-3 mx-0">
            <a href="http://pinterest.com/pin/create/button/?url={{ route('details', $detail->slug) }}?&media={!! env('URL_MEDIA_SMALL') .'/'. $detail->cover !!}&description={{$detail->title}}?utm_source=pinterest&utm_medium=share&utm_campaign=social_media_kamibijak" target="_blank">
              <img src="{{url('assets/frontend/img/pin.png')}}" style="width: 35px;height: 35px;">
            </a>
            </li>
            {{--<li class="p-3 mx-0">
              <a href="https://www.instagram.com/?url={{ route('details', $detail->slug) }}?utm_source=instagram&utm_medium=share&utm_campaign=social_media_kamibijak" target="_blank">
                <img src="{{url('assets/frontend/img/ig.png')}}" style="width: 35px;height: 35px;">
              </a>
            </li>--}}
            
            
        </div>
        </ul>
      </div>
      
    </div>
  </div>
</div>
@endsection