@extends('frontend::mobile.includes.default')
@section('content')
<!-- Main content -->
@php
  $words = $q;
  $q = implode(" ",$q);
  $pg = $hal;
  $hal = ($pg > 1 ? ' Page '.$pg : '');
  $colors = array(
      '#e8ff08'
  );
@endphp
<!-- Main content -->
<main>
  <div class="container-m">
    <section>
      <div class="row mx-0">
        <div class="col-12 px-0">

          <div class="row mx-0">
            <div class="col-12 col-sm-6 col-md-4 px-0 px-sm-2">
              @php                
              $body = $search;                
              $body = str_replace('-',' ', $body);
              $body = ucwords($body);
              @endphp
              <div class="m-c-desc p-3">
                <div class="det-desc fs-10"><strong>Hasil Pencarian</strong>&nbsp;&nbsp;:&nbsp;&nbsp;<i>"{{$body}}"</i><strong>&nbsp;&nbsp;ditemukan dalam {{ $result->total() }} video.</strong></div>
              </div>
            </div>
          </div>

          <div class="row mx-0">
            
            @foreach($result as $p)
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
                          <span class="ply-btn position-absolute d-inline-block" href="{{ route('details', $p->slug) }}"><img src="{{url('/assets/frontend/img/ply.svg')}}"></span>                          
                        </div>
                      </div>
                      <div class="m-c-desc p-3">
                        <div>{!! string_decode(highlight_words($p->title, $words, $colors)) !!}</div>
                        <div class="det-desc fs-10">Published on {!! date('F d, Y', strtotime($p->published)) !!}</div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>            
            @endforeach

          </div>
          <!-- Pagination -->
          @php $paginator = $result; @endphp
          {{ $paginator->appends(['q' => $q])->render('frontend::mobile.layouts.pagination') }}
          <!-- /Pagination -->
          <!-- <div class="infinite-scroll text-center" style="display:none">
            <p>Loading More user</p>
          </div> -->
        </div>
      </div>
    </section>
  </div>
  

</main>
<!-- /Main content -->
@endsection
