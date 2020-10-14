<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd">
	  <sitemap>
	    	<loc>{{url(env('APP_URL_FRONT'))}}/sitemap_home.xml</loc>
	  </sitemap>
	  <sitemap>
	    	<loc>{{url(env('APP_URL_FRONT'))}}/sitemap_category.xml</loc>
	  </sitemap>
	  <sitemap>
	    	<loc>{{url(env('APP_URL_FRONT'))}}/sitemap_tag.xml</loc>
	  </sitemap>
	  <sitemap>
	    	<loc>{{url(env('APP_URL_FRONT'))}}/sitemap_post.xml</loc>
	  </sitemap>
	  <sitemap>
	    	<loc>{{url(env('APP_URL_FRONT'))}}/sitemap_postnews.xml</loc>
	  </sitemap>
	  <sitemap>
	    	<loc>{{url(env('APP_URL_FRONT'))}}/sitemap_page.xml</loc>
	  </sitemap>
 </sitemapindex>