<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
    @foreach ($postnews as $c)
    <url>
        <loc>{{url(env('APP_URL_FRONT').'/v/'.$c->slug)}}</loc>
            <news:news>
                <news:publication>
                    <news:name>KamiBijak</news:name>
                    <news:language>id</news:language>
                </news:publication>
                    <news:publication_date>{{str_replace(' ','T', $c->published)}}+07:00</news:publication_date>
                    <news:title>{{ $c->title }}</news:title>
                    <news:keywords>{{ $c->seo_keywords }}</news:keywords>
            </news:news>
    </url>
    @endforeach
</urlset>