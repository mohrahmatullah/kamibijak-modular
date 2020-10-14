<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Modules\Admin\Entities\Post;
use Modules\Admin\Entities\PostCategory;
use Modules\Admin\Entities\PostTag;

class HomeController extends Controller
{
    public function index( Post $p ,PostTag $pt, Request $request)
    {
        $agent = new Agent();
        // $agent->setUserAgent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.13+ (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2');
        // $agent->setHttpHeaders($headers);
        // if($agent->is('Firefox')){

        // }
        if ($agent->isMobile()) {
            $now = date('Y-m-d H:i:s');
            $data['banners'] = DB::table('banner')->select('name', 'placement', 'media','video','code', 'website', 'link')->where('timestart','<=',$now)->where('expired','>=',$now)->get();
            
            $data['post'] = $p->where('status',4)->orderby('published','DESC')->paginate(20);

            if ($request->ajax()) {
                // $view = view('frontend::mobile.home.loadnews', $data)->render();
                // return response()->json(['html'=>$view]);
                return view('frontend::mobile.home.loadnews', $data);
            }
            
            return view('frontend::mobile.home.index', $data);
        }
        else{

            $now = date('Y-m-d H:i:s');
            $data['banners'] = DB::table('banner')->select('name', 'placement', 'media','video','code', 'website', 'link')->where('timestart','<=',$now)->where('expired','>=',$now)->get();
            
            $data['highlight'] = $p->where(['post.status' => 4, 'post.featured' => 1])->orderby('post.published','DESC')->join('user','user.id','post.publisher')->select('post.slug','post.title','post.cover','user.name','user.avatar','post.published','post.embed')->take(6)->get();
            // $data['top_chanel'] = $pt->where(['post_tag.slug' => 'top-chanel'])->join('post_tag_chain','post_tag_chain.post_tag','post_tag.id')->join('post','post.id','post_tag_chain.post')->where(['post.status' => 4])->orderby('post.published','DESC')->join('user','user.id','post.publisher')->select('post.slug','post.title','post.cover','user.name','user.avatar','post.published','post.seo_description')->take(4)->get();
            $start = date('Y-m-d H:i:s', strtotime('-21 DAY'));
            $now = date('Y-m-d H:i:s', time());
            $data['popular'] = DB::table('post')                        
                        ->where('post.status',4)
                        // ->whereBetween('published', array($start, $now))
                        // ->where('post.published', '>', DB::raw('DATE_SUB(CURDATE(), INTERVAL 100 DAY)'))
                        ->join('user','user.id','post.publisher')
                        ->select('post.id','post.cover','post.title','post.published','post.seo_description','post.slug','user.name','user.avatar','post.embed')
                        // ->join('post_trending','post_trending.post','post.id')
                        ->orderby('post.viewed','DESC')
                        ->take(4)
                        ->get();
            $data['post'] = $p->where(['post.status' => 4])->orderby('post.published','DESC')->join('user','user.id','post.publisher')->select('post.slug','post.title','post.cover','user.name','user.avatar','post.published','post.seo_description','post.embed')->paginate(8);
            // $arr = get_defined_vars();
            // dd($arr);
            if ($request->ajax()) {
                return view('frontend::dekstop.home.loadnews', $data);
            }
            return view('frontend::dekstop.home.index', $data);
        }
    }

    public function trending( Post $p , Request $request)
    {
        $agent = new Agent();
        // $agent->setUserAgent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.13+ (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2');
        // $agent->setHttpHeaders($headers);
        // if($agent->is('Firefox')){

        // }
        if ($agent->isMobile()) {            
            return redirect()->route('home');
        }
        else{          
            $data['trending'] = DB::table('post')                        
                        ->where('post.status',4)
                        // ->where('post.published', '>', DB::raw('DATE_SUB(CURDATE(), INTERVAL 21 DAY)'))
                        ->join('user','user.id','post.publisher')
                        ->select('post.id','post.cover','post.title','post.published','post.seo_description','post.slug','user.name','user.avatar','post.embed')
                        // ->join('post_trending','post_trending.post','post.id')
                        ->orderby('post.viewed','DESC')
                        ->paginate(8);
// $arr = get_defined_vars();
//             dd($arr);
            if ($request->ajax()) {
                return view('frontend::dekstop.post.trending.loadnews', $data);
            }
            return view('frontend::dekstop.post.trending.index', $data);
        }
    }

    public function highlight( Post $p , Request $request)
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            $now = date('Y-m-d H:i:s');
            $data['banners'] = DB::table('banner')->select('name', 'placement', 'media','video','code', 'website', 'link')->where('timestart','<=',$now)->where('expired','>=',$now)->get();

            $data['post'] = $p->where(['status' => 4, 'featured' => 1])->orderby('published','DESC')->take(4)->get();
            return view('frontend::mobile.home.highlight', $data);
        }
        else{
          $data['post'] = $p->select('post.id','post.cover','post.title','post.published','post.seo_description','post.slug','user.name','user.avatar','post.embed')->where(['post.status' => 4, 'post.featured' => 1])->orderby('post.published','DESC')->join('user','user.id','post.publisher')->paginate(20);
          if ($request->ajax()) {
                return view('frontend::dekstop.post.highlight.loadnews', $data);
            }
            return view('frontend::dekstop.post.highlight.index', $data);
        }
    }

    public function explore()
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            $now = date('Y-m-d H:i:s');
            $data['banners'] = DB::table('banner')->select('name', 'placement', 'media','video','code', 'website', 'link')->where('timestart','<=',$now)->where('expired','>=',$now)->get();
            
            $data['category'] = $this->mobilepostbyslugcategory();

            // $arr = get_defined_vars();
            // dd($arr);
            return view('frontend::mobile.home.explore',$data);
        }
        else{
          return redirect()->route('home');
        }
    }

    function mobilepostbyslugcategory(){
        $category = PostCategory::select('id','name','slug')->get();
        $data = array();
        foreach ($category as $key) {
            $cat = PostCategory::select('post.published','post.embed','post.title','post.slug','post.cover','post.seo_title','post.seo_description','post_category.name as namecategory','post_category.slug as slugcategory')
                               ->where('post_category.slug',$key->slug)
                               ->leftjoin('post_category_chain', 'post_category_chain.post_category', 'post_category.id')
                               ->leftjoin('post','post.id','post_category_chain.post')
                               ->where('post.status',4)
                               ->orderby('post.published','DESC')
                               ->take(5)->get()->groupby('slugcategory');
            array_push($data, $cat);
        }
        return $data;
    }

    public function menu()
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            return view('frontend::mobile.includes.menu');
        }
    }

    public function search(Request $req, Post $posts)
    {
      $agent = new Agent();
        if ($agent->isMobile()) {
          $data['hal'] = 0;
      
          $posts = $posts->newQuery();
          $posts->orderby('post.published','DESC')
                ->join('user','user.id','post.publisher')
                ->select('post.slug','post.title','post.cover','user.name','user.avatar','post.published','post.seo_description','post.embed');
                if ($req != NULL){
                  if ($req->has('q')) {
                    if ($req->q){
                      $q = explode(" ", $req->q);
                      $data['q'] = $q;
                      $data['search'] = implode(" ",$q);
                      if ($q != ''){
                        $posts->where(function($query) use ($q){
                            foreach($q as $term){
                                $query->where('post.title', 'LIKE', '%'.$term.'%');
                            }
                        });
                      }
                    } else {
                      return redirect('/', 301);
                    }
                  }
                  else
                  {
                    return redirect('/', 301);
                  }
                  if ($req->has('page')) {
                    if ($req->page){
                      $data['hal'] = $req->page;
                    }
                  }
                }      
          $posts->where('post.status',4); 
          $posts->orderby('post.published','DESC');
          $data['result'] = $posts->paginate(20);
          // $arr = get_defined_vars();
          //           dd($arr);
          return view('frontend::mobile.search.index', $data);
        }else{
          $data['hal'] = 0;
      
          $posts = $posts->newQuery();
          $posts->orderby('post.published','DESC')
                ->join('user','user.id','post.publisher')
                ->select('post.slug','post.title','post.cover','user.name','user.avatar','post.published','post.seo_description','post.embed');
                if ($req != NULL){
                  if ($req->has('q')) {
                    if ($req->q){
                      $q = explode(" ", $req->q);
                      $data['q'] = $q;
                      $data['search'] = implode(" ",$q);
                      if ($q != ''){
                        $posts->where(function($query) use ($q){
                            foreach($q as $term){
                                $query->where('post.title', 'LIKE', '%'.$term.'%');
                            }
                        });
                      }
                    } else {
                      return redirect('/', 301);
                    }
                  }
                  else
                  {
                    return redirect('/', 301);
                  }
                  if ($req->has('page')) {
                    if ($req->page){
                      $data['hal'] = $req->page;
                    }
                  }
                }      
          $posts->where('post.status',4); 
          $posts->orderby('post.published','DESC');
          $data['result'] = $posts->paginate(20);

                    // $arr = get_defined_vars();
                    // dd($arr);
           return view('frontend::dekstop.search.index', $data);
        }
    }

}
