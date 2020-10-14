<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($category as $t)
    <url>
      <loc>{{url(env('APP_URL_FRONT').'/vc/'.$t->slug)}}</loc>
      <lastmod>{{str_replace(' ','T', $t->created)}}+07:00</lastmod>
      <changefreq>daily</changefreq>
      <priority>1.0</priority>
    </url>
  @endforeach
</urlset>