<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class XmlController extends Controller
{
    function XML()
    {           

        $returndata = view('frontend::robot.sitemap');

        return response($returndata)->header('Last-Modified', date('Y-m-d'))->header('Content-Type','text/xml');
    }

    function XML_home()
    {
        $returndata = view('frontend::robot.sitemap_home');

        return response($returndata)->header('Last-Modified', date('Y-m-d'))->header('Content-Type','text/xml');
    }

    function XML_post()
    {   
        $data['post'] = DB::table('post')->where('status', 4)->orderBy('published', 'desc')->take(500)->get();

        $returndata = view('frontend::robot.sitemap_post', $data);
        return response($returndata)->header('Last-Modified', date('Y-m-d'))->header('Content-Type','text/xml');
    }

    function XML_postnews()
    {
        $data['postnews'] = DB::table('post')->where('status', 4)->orderBy('published', 'desc')->take(500)->get();

        $returndata = view('frontend::robot.sitemap_postnews', $data);
        return response($returndata)->header('Last-Modified', date('Y-m-d'))->header('Content-Type','text/xml');
    }

    function XML_category()
    {
        $data['category'] = DB::table('post_category')->get();

        $returndata = view('frontend::robot.sitemap_category', $data);
        return response($returndata)->header('Last-Modified', date('Y-m-d'))->header('Content-Type','text/xml');
    }

    function XML_tag()
    {       
        $data['tag'] = DB::table('post_tag')->get();
        
        $returndata = view('frontend::robot.sitemap_tag', $data);
        return response($returndata)->header('Last-Modified', date('Y-m-d'))->header('Content-Type','text/xml');
    }

    function XML_page()

    {
        $data['page'] = DB::table('page')->get();

        $returndata = view('frontend::robot.sitemap_page', $data);
        return response($returndata)->header('Last-Modified', date('Y-m-d'))->header('Content-Type','text/xml');
    }

    function XML_rss()

    {
        $data['result'] = DB::table('post_category')
            ->leftjoin('post_category_chain', 'post_category.id','post_category_chain.post_category')
            ->leftjoin('post','post.id','post_category_chain.post')  
            ->where('status', 4)->orderBy('published', 'desc')->take(100)->get();

        $returndata = view('frontend::robot.rss', $data);
        return response($returndata)->header('Last-Modified', date('Y-m-d'))->header('Content-Type','text/xml');
    }
}
