@if( isset($is_og_detail) )
<meta property="og:title" content="{!! $is_og_detail->title !!}" />
<meta property="og:description" content="{!! str_limit($is_og_detail->seo_description, 75) !!}" />
@if(!empty($is_og_detail->cover))
<meta property="og:image" content="{!! env('URL_MEDIA_SMALL') .'/'. $is_og_detail->cover !!}" />
@else
  @php
  $embedscript = substr($is_og_detail->embed, 68, -77);
  $url = get_thumnail_youtube();
  $thumnbail = str_replace('Thumbnail',$embedscript, $url);
  @endphp
<meta property="og:image" content="{{ $thumnbail }}" />
@endif

<meta property="og:site_name" content="kamibijak">
@if(!empty($is_og_detail->cover))
<meta property="og:image:secure_url" content="{!! str_replace('http:','https:',  env('URL_MEDIA_SMALL') .'/'. $is_og_detail->cover  ) !!}" />
@else
  @php
  $embedscript = substr($is_og_detail->embed, 68, -77);
  $url = get_thumnail_youtube();
  $thumnbail = str_replace('Thumbnail',$embedscript, $url);
  @endphp
<meta property="og:image:secure_url" content="{{ $thumnbail }}" />
@endif
<meta name="keywords" content="{!! $is_og_detail->seo_keywords !!}">
@endif

@if( isset($is_tag_og) )
<meta property="og:title" content="Kumpulan Berita Harian {!! $is_tag_og->name !!} Terbaru" />
<meta property="og:description" content="Berikut ini kumpulan dan informasi berita terbaru mengenai {!! $is_tag_og->name !!} yang diulas lengkap dan valid oleh Kabaroto.com yang bisa Anda baca setiap harinya!" />
<meta property="og:site_name" content="kambijak.com">
<meta name="description" content="Berikut ini kumpulan dan informasi berita terbaru mengenai {!! $is_tag_og->name !!} yang diulas lengkap dan valid oleh Kamibijak.com yang bisa Anda baca setiap harinya!">
<meta name="keywords" content="Berita {!! $is_tag_og->name !!}, Info {!! $is_tag_og->name !!}, Foto {!! $is_tag_og->name !!}" >
@endif

<meta property="og:type" content="website" />
<meta property="og:locale" content="en_ID" />
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:updated_time" content="{{date('Y-m-dTH:i:s+07:00')}}">
{{--<meta property="og:image" content="{{env('URL_MEDIA_SMALL').'/'.'cropped-favicon-kamibijak.png'}}">
<meta property="og:image:secure_url" content="{{env('URL_MEDIA_SMALL').'/'.'cropped-favicon-kamibijak.png'}}" /> --}}
@if( isset($oghp_title) )
<meta property="og:title" content="{!! $oghp_title->value !!}" />
<meta property="og:image" content="{{env('URL_MEDIA_SMALL').'/'.'cropped-favicon-kamibijak.png'}}">
@endif
@if( isset($oghp_descr) )
<meta property="og:description" content="{!! $oghp_descr->value !!}" />
<meta name="description" content="{!! $oghp_descr->value !!}">
@endif
@if( isset($oghp_keywo) )
<meta name="keywords" content="{!! $oghp_keywo->value !!}">
@endif
@php
$meta['alexaverifyid']  = DB::table('site_params')->where('name', 'code_verification_alexa')->first();
$meta['fbappid']    = DB::table('site_params')->where('name', 'code_application_facebook')->first();
$meta['fbpages']    = DB::table('site_params')->where('name', 'code_facebook_page_id')->first();
$meta['googleverify'] = DB::table('site_params')->where('name', 'code_verification_google')->first();
$meta['msvalidate']   = DB::table('site_params')->where('name', 'code_verification_bing')->first();
$meta['pinterestverify']  = DB::table('site_params')->where('name', 'code_verification_pinterest')->first();
$meta['yandexverify'] = DB::table('site_params')->where('name', 'code_verification_yandex')->first();
@endphp

@if($meta['alexaverifyid'] != "")
<meta name="alexaVerifyID" content="{{$meta['alexaverifyid']->value}}">
@endif
@if($meta['fbappid'] != "")
{{--<meta property="fb:app_id" content="{{$meta['fbappid']->value}}">--}}
<meta property="fb:app_id" content="944733245718155">
@endif
@if($meta['fbpages'] != "")
<meta name="fb:pages" content="{{$meta['fbpages']->value}}">
{{--<meta name="fb:pages" content="294405004697837">--}}
@endif
@if($meta['googleverify'] != "")
<meta name="google-site-verification" content="{{$meta['googleverify']->value}}">
@endif
@if($meta['msvalidate'] != "")
<meta name="msvalidate.01" content="{{$meta['msvalidate']->value}}">
@endif
@if($meta['pinterestverify'] != "")
<meta name="p:domain_verify" content="{{$meta['pinterestverify']->value}}">
@endif
@if($meta['yandexverify'] != "")
<meta name="yandex-verification" content="{{$meta['yandexverify']->value}}">
@endif

@if( isset($is_tw_detail) )
<meta name="twitter:description" content="{!! $is_tw_detail->seo_description !!}">
<meta name="twitter:image:src" content="{!! env('URL_MEDIA_SMALL') .'/'. $is_tw_detail->cover !!}">
<meta name="twitter:title" content="{!! $is_tw_detail->title !!}">
@endif
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ Request::url() }}">
@if( isset($oghp_title) )
<meta name="twitter:title" content="{!! $oghp_title->value !!}" />
@endif
@if( isset($oghp_descr) )
<meta name="twitter:description" content="{!! $oghp_descr->value !!}" />
@endif
@if( isset($oghp_image) )
<meta name="twitter:image:src" content="{!! env('URL_MEDIA_SMALL') . $oghp_image->value !!}" />
@endif


<link href="{{env('APP_URL_FRONT')}}/feed.xml" rel="alternate" title="Kami Berbahasa Isyarat Jakarta" type="application/rss+xml">
<link rel="alternate" hreflang="id-en" href="{{ Request::url() }}" />
<link href="{{ Request::url() }}" rel="canonical">

<script type="application/ld+json">
{"@context":"http://schema.org","@type":"WebSite","url":"https://kamibijak.com/","description":"Sebuah media video online yang ramah disabilitas dalam bentuk visual Bahasa Isyarat dan Teks untuk penyandang disabilitas khusus Tuli.","headline":"Kami Berbahasa Isyarat Jakarta","publisher":{"@type":"Organization","name":"kamibijak"},"image":"http://asset.kamibijak.com/images/small/cropped-favicon-kamibijak.png","name":"kambijak","potentialAction":{"@type":"SearchAction","target":"https://kamibijak.com/search?q={search_term_string}","query-input":"required name=search_term_string"}}</script>
<script type="application/ld+json">
{"@context":"http://schema.org","@type":"Organization","name":"kamibijak","url":"https://kamibijak.com/","logo":"http://asset.kamibijak.com/images/small/cropped-favicon-kamibijak.png","sameAs":["https://www.facebook.com/kamibijakcom","https://plus.google.com/+Kabarotocom/","https://www.pinterest.com/kamibijakcom/","https://twitter.com/kamibijakcom"],"contactPoint":[{"@type":"ContactPoint","telephone":"+622124520571","contactType":"customer support"}]}</script>
