<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
  <rss version="2.0"
  xmlns:content="http://purl.org/rss/1.0/modules/content/"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:media="http://search.yahoo.com/mrss/"
  xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title>Kami Berbahasa Isyarat Jakarta - KamiBijak</title>
    <link>{{(env('APP_URL_FRONT'))}}</link>
    <atom:link href="{{(env('APP_URL_FRONT'))}}/feed" rel="self" type="application/rss+xml"/>
    <language>ID</language>
    <description>Sebuah media video online yang ramah disabilitas dalam bentuk visual Bahasa Isyarat dan Teks untuk penyandang disabilitas khusus Tuli.</description>
    <copyright>Copyright 2019 {{(env('APP_URL_FRONT'))}} All rights reserved.</copyright>
    <lastBuildDate>{{date('Y-m-d')}}T{{date("H:i:s")}}+07:00</lastBuildDate>
    <docs>{{(env('APP_URL_FRONT'))}}/feed</docs>
    <image>
      <link>{{(env('APP_URL_FRONT'))}}</link>
      <title>{{(env('APP_URL_FRONT'))}}</title>
      <url>https://asset.kamibijak.com/images/small/cropped-favicon-kamibijak.png</url>
      <height>72</height>
      <width>72</width>
    </image>
    @foreach($result as $r)
    <item>
      <title>{{$r->title}}</title>
      <link>{{(env('APP_URL_FRONT').'/v/'.$r->slug)}}</link>
      <description>&lt;img src=&quot;{{(env('URL_MEDIA').'/'.$r->cover)}}&quot; align=&quot;left&quot; hspace=&quot;7&quot; width=&quot;100&quot; /&gt;
          {!! string_decode($r->seo_description) !!}
      </description>
      <content:encoded>
      {{$r->content}}
      </content:encoded>
      <category>{{$r->name}}</category>
      <guid>{{(env('APP_URL_FRONT').'/v/'.$r->slug)}}</guid>
      <pubDate>{{str_replace(' ','T', $r->published)}}+07:00</pubDate>
      <enclosure url="{{(env('URL_MEDIA').'/'.$r->cover)}}" length="678080" type="image/jpg" />
      <media:content url="{{(env('URL_MEDIA').'/'.$r->cover)}}" />
      <media:title>{{$r->title}}</media:title>
      <media:copyright>{{$r->title}}</media:copyright>
      <media:text>{{$r->seo_description}}</media:text>
      <media:description>{{$r->seo_description}}</media:description>
    </item>
    @endforeach
  </channel> 
</rss>
