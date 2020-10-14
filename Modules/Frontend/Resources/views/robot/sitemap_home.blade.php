<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>{{url(env('APP_URL_FRONT'))}}</loc>
    <lastmod>{{date('Y-m-d')}}T{{date("H:i:s")}}+07:00</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>
</urlset>