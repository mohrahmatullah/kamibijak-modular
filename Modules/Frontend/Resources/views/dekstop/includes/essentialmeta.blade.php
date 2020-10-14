@if( isset($is_og_detail) )
@php
$meta['alexaverifyid']  = DB::table('site_params')->where('name', 'code_verification_alexa')->first();
$meta['fbappid']    = DB::table('site_params')->where('name', 'code_application_facebook')->first();
$meta['fbpages']    = DB::table('site_params')->where('name', 'code_facebook_page_id')->first();
$meta['googleverify'] = DB::table('site_params')->where('name', 'code_verification_google')->first();
$meta['msvalidate']   = DB::table('site_params')->where('name', 'code_verification_bing')->first();
$meta['pinterestverify']  = DB::table('site_params')->where('name', 'code_verification_pinterest')->first();
$meta['yandexverify'] = DB::table('site_params')->where('name', 'code_verification_yandex')->first();
@endphp
<meta charset="utf-8">
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1, user-scalable=no">
<meta name="generator" content="AdminCI">
<meta name="alexaVerifyID" content="{{$meta['alexaverifyid']->value}}">
<meta property="fb:pages" content="{{$meta['fbpages']->value}}">
<meta property="fb:app_id" content="{{$meta['fbappid']->value}}">
<meta name="google-site-verification" content="{{$meta['googleverify']->value}}">
<meta name="msvalidate.01" content="{{$meta['msvalidate']->value}}">
<meta property="og:site_name" content="KamiBijak">
<meta name="yandex-verification" content="{{$meta['yandexverify']->value}}">
<meta property="article:modified_time" content="{{str_replace(' ','T', $is_og_detail->published)}}+07:00">
<meta property="article:published_time" content="{{str_replace(' ','T', $is_og_detail->published)}}+07:00">
<meta property="article:publisher" content="{{$meta['fbpages']->value}}">
<meta property="article:section" content="{{ $categoryname }}">
<meta property="article:tag" content="{!! $is_og_detail->seo_keywords !!}">
<meta name="description" content="{!! str_limit($is_og_detail->seo_description, 75) !!}">
<meta name="keywords" content="{!! $is_og_detail->seo_keywords !!}">
<meta property="og:description" content="{!! str_limit($is_og_detail->seo_description, 75) !!}">
<meta property="og:image" content="{!! env('URL_MEDIA_SMALL') .'/'. $is_tw_detail->cover !!}">
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="650" />
<meta property="og:image:height" content="366" />
<meta property="og:title" content="{!! $is_og_detail->title !!}">
<meta property="og:type" content="article">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:updated_time" content="{{date('Y-m-d')}}T{{date('H:i:s')}}+07:00">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:description" content="{!! str_limit($is_og_detail->seo_description, 75) !!}">
<meta name="twitter:image:src" content="{!! env('URL_MEDIA_SMALL') .'/'. $is_tw_detail->cover !!}">
<meta name="twitter:title" content="{!! $is_og_detail->title !!}">
<meta name="twitter:url" content="{{ Request::url() }}">
<link href="{{ Request::url() }}" rel="canonical">
@endif
<link href="{{env('APP_URL_FRONT')}}/feed.xml" rel="alternate" title="Kami Berbahasa Isyarat Jakarta" type="application/rss+xml">
<script type="application/ld+json">
{"@context":"http://schema.org","@type":"WebSite","url":"https://www.kamibijak.com/","description":"Sebuah media video online yang ramah disabilitas dalam bentuk visual Bahasa Isyarat dan Teks untuk penyandang disabilitas khusus Tuli.","headline":"Kami Berbahasa Isyarat Jakarta","publisher":{"@type":"Organization","name":"KamiBijak"},"image":"http://asset.kamibijak.com/images/small/cropped-favicon-kamibijak.png","name":"KamiBijak","potentialAction":{"@type":"SearchAction","target":"https://www.kamibijak.com/search?q={search_term_string}","query-input":"required name=search_term_string"}}
</script>
<script type="application/ld+json">
{"@context":"http://schema.org","@type":"Organization","name":"KamiBijak","url":"https://www.kamibijak.com","logo":"http://asset.kamibijak.com/images/small/cropped-favicon-kamibijak.png","sameAs":["https://www.facebook.com/KamiBijakID/","https://twitter.com/KamiBijakID"],"contactPoint":[{"@type":"ContactPoint","telephone":"+622124520571","contactType":"customer support"}]}
</script>