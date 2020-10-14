<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd">
  @foreach ($post as $c)
    <url>
      <loc>{{url(env('APP_URL_FRONT').'/v/'.$c->slug)}}</loc>
      <lastmod>{{str_replace(' ','T', $c->published)}}+07:00</lastmod>
      <changefreq>daily</changefreq>
      <priority>1.0</priority>
    </url>
  @endforeach
</urlset>