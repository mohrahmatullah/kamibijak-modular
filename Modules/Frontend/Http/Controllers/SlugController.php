<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Modules\Admin\Entities\Post;
use Modules\Admin\Entities\PostCategory;
use Modules\Admin\Entities\PostCategoryChain;
use Session;

class SlugController extends Controller
{
    public function category( PostCategory $pc, Post $p , $slug , Request $request)
    {
        $agent = new Agent();
        // $agent->setUserAgent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.13+ (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2');
        // $agent->setHttpHeaders($headers);
        // if($agent->is('Firefox')){

        // }
        if ($agent->isMobile()) {
            $now = date('Y-m-d H:i:s');
            $data['banners'] = DB::table('banner')->select('name', 'placement', 'media','video','code', 'website', 'link')->where('timestart','<=',$now)->where('expired','>=',$now)->get();

            $data['namecategory'] = $pc->select('post_category.name as namecategory')
                                   ->where('post_category.slug',$slug)
                                   ->first();

            $data['category'] = $pc->select('post.published','post.title','post.slug','post.cover','post.seo_title','post.seo_description','post_category.name as namecategory','post.embed')
                                   ->where('post_category.slug',$slug)
                                   ->leftjoin('post_category_chain', 'post_category_chain.post_category', 'post_category.id')
                                   ->leftjoin('post','post.id','post_category_chain.post')
                                   ->where('post.status',4)
                                   ->orderby('post.published','DESC')
                                   ->paginate(20);
            if ($request->ajax()) {
                return view('frontend::mobile.post.category-loadnews', $data);
            }

            // $arr = get_defined_vars();
            // dd($arr);
            return view('frontend::mobile.post.category', $data);
        }
        else{
            $now = date('Y-m-d H:i:s');
            $data['banners'] = DB::table('banner')->select('name', 'placement', 'media','video','code', 'website', 'link')->where('timestart','<=',$now)->where('expired','>=',$now)->get();

            $data['namecategory'] = $pc->select('post_category.name as namecategory')
                                   ->where('post_category.slug',$slug)
                                   ->first()->namecategory;
            $data['popular'] = DB::table('post')                        
                        ->where('post.status',4)
                        ->where('post.published', '>', DB::raw('DATE_SUB(CURDATE(), INTERVAL 60 DAY)'))
                        ->join('user','user.id','post.publisher')
                        ->select('post.id','post.cover','post.title','post.published','post.seo_description','post.slug','user.name','user.avatar','post.embed')
                        // ->join('post_trending','post_trending.post','post.id')
                        ->orderby('post.viewed','DESC')
                        ->join('post_category_chain', 'post_category_chain.post', 'post.id')
                        ->join('post_category', 'post_category_chain.post_category', 'post_category.id')
                        ->where('post_category.slug',$slug)
                        ->take(4)
                        ->get();

            $data['category'] = $pc->where('post_category.slug',$slug)
                                   ->leftjoin('post_category_chain', 'post_category_chain.post_category', 'post_category.id')
                                   ->leftjoin('post','post.id','post_category_chain.post')
                                   ->join('user','user.id','post.publisher')
                                   ->where('post.status',4)
                                   ->orderby('post.published','DESC')
                                   ->select('post.id','post.cover','post.title','post.published','post.seo_description','post.slug','user.name','user.avatar','post.embed')
                                   ->paginate(8);
            if ($request->ajax()) {
                return view('frontend::dekstop.post.category-loadnews', $data);
            }
            // $arr = get_defined_vars();
            // dd($arr);
            return view('frontend::dekstop.post.category', $data);
        }
    }

    public function getPostsPreview( $id , Post $p , Request $request)
    {
      $status = $p->where('id', $id)->where('status', '!=' , '4')->first();
      if($status){
        $agent = new Agent();
        if ($agent->isMobile()) {
            $data['detail'] = $p->where('post.id',$id)->join('user','user.id','post.publisher')->select('post.id','post.embed','post.content','post.slug','post.title','post.cover','post.gallery','user.name','user.avatar','post.published','post.seo_description','post.viewed','post.seo_schema','post.type_post')->first();
            
            $data['categoryname'] = DB::table('post_category')
                ->leftjoin('post_category_chain','post_category.id','post_category_chain.post_category')
                ->select('post_category.name')
                ->where('post_category_chain.post', $id)
                ->first()->name;

            $data['categoryslug'] = DB::table('post_category')
                ->leftjoin('post_category_chain','post_category.id','post_category_chain.post_category')
                ->select('post_category.slug')
                ->where('post_category_chain.post',$id)
                ->first()->slug;
            $data['tagnews'] = DB::table('post_tag')
            ->leftjoin('post_tag_chain','post_tag.id','post_tag_chain.post_tag')
            ->select('post_tag.name','post_tag.slug')
            ->where('post_tag_chain.post',$id)
            ->get();

            if($data['detail']->gallery != 0){
              $data['post_gallery'] = DB::table('gallery_media')->where('gallery', $data['detail']->gallery)->get();
            }

            $data['related_video'] = DB::table('post')
            ->leftjoin('post_tag_chain','post_tag_chain.post','post.id')
            ->leftjoin('post_tag','post_tag.id','post_tag_chain.post_tag')
            ->select('post_tag.name','post.id','post.slug','post.cover','post.title','post.published','post.viewed','post.embed')
            ->where('post.status',4)
            ->where('post.id', '!=', $id)
            ->whereIn('post_tag.id', [$this->tagByID($id)])
            ->orderby('post.published','DESC')
            ->take(6)
            ->get();

            // HOT VIDEO
            $data['hot_videos'] = DB::table('post')                        
              ->where('post.status',4)
              ->where('post.published', '>', DB::raw('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'))
              ->select('post.id','post.slug','post.cover','post.title','post.published','post.viewed','post.embed')
              ->orderby('post.viewed','DESC')
              ->take(5)
              ->get();

          return view('frontend::mobile.post.preview.index', $data);
        }else{
          $data['detail'] = $p->where('post.id',$id)->join('user','user.id','post.publisher')->select('post.id','post.embed','post.content','post.slug','post.title','post.cover','post.gallery','user.name','user.avatar','post.published','post.seo_description','post.viewed','post.seo_keywords','post.seo_schema','post.type_post')->first();

          $data['categoryname'] = DB::table('post_category')
              ->leftjoin('post_category_chain','post_category.id','post_category_chain.post_category')
              ->select('post_category.name')
              ->where('post_category_chain.post',$id)
              ->first()->name;

          $data['categoryslug'] = DB::table('post_category')
              ->leftjoin('post_category_chain','post_category.id','post_category_chain.post_category')
              ->select('post_category.slug')
              ->where('post_category_chain.post',$id)
              ->first()->slug;
          
          $data['tagnews'] = DB::table('post_tag')
          ->leftjoin('post_tag_chain','post_tag.id','post_tag_chain.post_tag')
          ->select('post_tag.name','post_tag.slug')
          ->where('post_tag_chain.post',$id)
          ->get();

          if($data['detail']->gallery != 0){
              $data['post_gallery'] = DB::table('gallery_media')->where('gallery', $data['detail']->gallery)->get();
          }

          // UP NEXT
          $data['up_next'] = DB::table('post')
          ->leftjoin('post_tag_chain','post_tag_chain.post','post.id')
          ->leftjoin('post_tag','post_tag.id','post_tag_chain.post_tag')
          ->select('post_tag.name','post.id','post.slug','post.cover','post.title','post.published','post.viewed','post.embed')
          ->where('post.status',4)            
          ->where('post.id', '!=', $id)
          ->whereIn('post_tag.id', [$this->tagByID($id)])
          ->orderby('post.published','DESC')
          ->take(5)
          ->get();
          // ->groupBy('post.id');

          // HOT VIDEO
          $data['hot_videos'] = DB::table('post')                        
            ->where('post.status',4)
            ->where('post.published', '>', DB::raw('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'))
            ->select('post.id','post.slug','post.cover','post.title','post.published','post.viewed','post.embed')
            ->orderby('post.viewed','DESC')
            ->take(5)
            ->get();
          // dd($data['hot_videos']);
          $data['video_terbaru'] = $p->where(['post.status' => 4])->orderby('post.published','DESC')->join('user','user.id','post.publisher')->select('post.slug','post.title','post.cover','user.name','user.avatar','post.published','post.seo_description','post.embed')->paginate(4);

          if ($request->ajax()) {
              return view('frontend::dekstop.post.details-load-news', $data);
          }
        //   $arr = get_defined_vars();
        // dd($arr);
          return view('frontend::dekstop.post.preview.index', $data);
        }
      }else{
        Session::flash('success-message', "can't preview post already published" );
        return redirect()->back();
      }   

    }

    public function detail( Post $p , $slug, Request $request)
    {
        $agent = new Agent();
        // $agent->setUserAgent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.13+ (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2');
        // $agent->setHttpHeaders($headers);
        // if($agent->is('Firefox')){

        // }
        if ($agent->isMobile()) {
            $now = date('Y-m-d H:i:s');
            $data['banners'] = DB::table('banner')->select('name', 'placement', 'media','video','code', 'website', 'link')->where('timestart','<=',$now)->where('expired','>=',$now)->get();

            $data['detail'] = $p->where('post.status',4)->where('post.slug',$slug)->join('user','user.id','post.publisher')->select('post.id','post.embed','post.content','post.slug','post.title','post.cover','post.gallery','user.name','user.avatar','post.published','post.seo_description','post.viewed','post.seo_schema','post.type_post')->first();
            
            $viewed = array(
              'viewed' => $data['detail']->viewed + 1
            );

            DB::table('post')->where('slug',$slug)->update($viewed);

            $data['categoryname'] = DB::table('post_category')
                ->leftjoin('post_category_chain','post_category.id','post_category_chain.post_category')
                ->select('post_category.name')
                ->where('post_category_chain.post',$data['detail']->id)
                ->first()->name;

            $data['categoryslug'] = DB::table('post_category')
                ->leftjoin('post_category_chain','post_category.id','post_category_chain.post_category')
                ->select('post_category.slug')
                ->where('post_category_chain.post',$data['detail']->id)
                ->first()->slug;
            $data['tagnews'] = DB::table('post_tag')
            ->leftjoin('post_tag_chain','post_tag.id','post_tag_chain.post_tag')
            ->select('post_tag.name','post_tag.slug')
            ->where('post_tag_chain.post',$data['detail']->id)
            ->get();

            $post_id = $data['detail']->id;

            if($data['detail']->gallery != 0){
              $data['post_gallery'] = DB::table('gallery_media')->where('gallery', $data['detail']->gallery)->get();
            }

            $data['related_video'] = DB::table('post')
            ->leftjoin('post_tag_chain','post_tag_chain.post','post.id')
            ->leftjoin('post_tag','post_tag.id','post_tag_chain.post_tag')
            ->select('post_tag.name','post.id','post.slug','post.cover','post.title','post.published','post.viewed','post.embed')
            ->where('post.status',4)
            ->where('post.id', '!=', $post_id)
            ->whereIn('post_tag.id', [$this->tagByID($post_id)])
            ->orderby('post.published','DESC')
            ->take(6)
            ->get();

            // HOT VIDEO
            $data['hot_videos'] = DB::table('post')                        
              ->where('post.status',4)
              ->where('post.published', '>', DB::raw('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'))
              ->select('post.id','post.slug','post.cover','post.title','post.published','post.viewed','post.embed')
              ->orderby('post.viewed','DESC')
              ->take(5)
              ->get();
            // $arr = get_defined_vars();
            // dd($arr);
            return view('frontend::mobile.post.details', $data);
        }
        else{
            $now = date('Y-m-d H:i:s');
            $data['banners'] = DB::table('banner')->select('name', 'placement', 'media','video','code', 'website', 'link')->where('timestart','<=',$now)->where('expired','>=',$now)->get();
            
            $data['detail'] = $p->where('post.status',4)->where('post.slug',$slug)->join('user','user.id','post.publisher')->select('post.id','post.embed','post.content','post.slug','post.title','post.cover','post.gallery','user.name','user.avatar','post.published','post.seo_description','post.viewed','post.seo_keywords','post.seo_schema','post.type_post')->first();
            
            $viewed = array(
              'viewed' => $data['detail']->viewed + 1
            );

            DB::table('post')->where('slug',$slug)->update($viewed);

            $data['categoryname'] = DB::table('post_category')
                ->leftjoin('post_category_chain','post_category.id','post_category_chain.post_category')
                ->select('post_category.name')
                ->where('post_category_chain.post',$data['detail']->id)
                ->first()->name;

            $data['categoryslug'] = DB::table('post_category')
                ->leftjoin('post_category_chain','post_category.id','post_category_chain.post_category')
                ->select('post_category.slug')
                ->where('post_category_chain.post',$data['detail']->id)
                ->first()->slug;
            
            $data['tagnews'] = DB::table('post_tag')
            ->leftjoin('post_tag_chain','post_tag.id','post_tag_chain.post_tag')
            ->select('post_tag.name','post_tag.slug')
            ->where('post_tag_chain.post',$data['detail']->id)
            ->get();
            $post_id = $data['detail']->id;

            if($data['detail']->gallery != 0){
              $data['post_gallery'] = DB::table('gallery_media')->where('gallery', $data['detail']->gallery)->get();
            }

            // UP NEXT
            $data['up_next'] = DB::table('post')
            ->leftjoin('post_tag_chain','post_tag_chain.post','post.id')
            ->leftjoin('post_tag','post_tag.id','post_tag_chain.post_tag')
            ->select('post_tag.name','post.id','post.slug','post.cover','post.title','post.published','post.viewed','post.embed')
            ->where('post.status',4)            
            ->where('post.id', '!=', $post_id)
            ->whereIn('post_tag.id', [$this->tagByID($post_id)])
            ->orderby('post.published','DESC')
            ->take(5)
            ->get();
            // ->groupBy('post.id');

            // HOT VIDEO
            $data['hot_videos'] = DB::table('post')                        
              ->where('post.status',4)
              ->where('post.published', '>', DB::raw('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'))
              ->select('post.id','post.slug','post.cover','post.title','post.published','post.viewed','post.embed')
              ->orderby('post.viewed','DESC')
              ->take(5)
              ->get();
            // dd($data['hot_videos']);
            $data['video_terbaru'] = $p->where(['post.status' => 4])->orderby('post.published','DESC')->join('user','user.id','post.publisher')->select('post.slug','post.title','post.cover','user.name','user.avatar','post.published','post.seo_description','post.embed')->paginate(4);

            $data['is_og_detail'] = $data['detail'];
            $data['is_tw_detail'] = $data['detail'];

            if ($request->ajax()) {
                return view('frontend::dekstop.post.details-load-news', $data);
            }

            // $arr = get_defined_vars();
            // dd($arr);
            return view('frontend::dekstop.post.details', $data);
        }
    }

    public function tag( $slug , Request $request)
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            $data['nametag'] = $slug;

            $data['tag'] = DB::table('post_tag')->select('post.published','post.title','post.slug','post.cover','post.seo_title','post.seo_description','post_tag.name as nametag','post.embed')
                                   ->where('post_tag.slug',$slug)
                                   ->leftjoin('post_tag_chain', 'post_tag_chain.post_tag', 'post_tag.id')
                                   ->leftjoin('post','post.id','post_tag_chain.post')
                                   ->where('post.status',4)
                                   ->orderby('post.published','DESC')
                                   ->paginate(20);
            if ($request->ajax()) {
                return view('frontend::mobile.post.tags-loadnews', $data);
            }

            // $arr = get_defined_vars();
            // dd($arr);
            return view('frontend::mobile.post.tags', $data);
        }
        else{
            $data['nametag'] = $slug;

            $data['tag'] = DB::table('post')
                          ->where('post.status',4)
                          ->orderby('post.published','DESC')
                          ->join('post_tag_chain','post_tag_chain.post','post.id')
                          ->join('post_tag','post_tag_chain.post_tag','post_tag.id')                      
                          ->where('post_tag.slug',$slug)
                          ->join('user','user.id','post.publisher')
                          ->select('post.id','post.cover','post.title','post.published','post.seo_description','post.slug','user.name','user.avatar','post.embed')
                          ->paginate(20);
            $data['tagmeta'] = DB::table('post_tag')
                          ->leftjoin('post_tag_chain', 'post_tag.id','post_tag_chain.post_tag')
                          ->select('post_tag.name','post_tag.slug','post_tag.seo_title','post_tag.seo_description','post_tag.seo_keywords')
                          ->where('post_tag.slug',$slug)
                          ->first();
            $data['is_tag_og'] = $data['tagmeta'];
            $data['is_tag_tw'] = $data['tagmeta'];

            if ($request->ajax()) {
                return view('frontend::dekstop.post.tag-loadnews', $data);
            }
            // $arr = get_defined_vars();
            // dd($arr);
        }        
        return view('frontend::dekstop.post.tag', $data);
    }

    public function user($name, Request $req)
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            $data['nameuser'] = DB::table('user')->select('user.fullname as nameuser','user.avatar')
                                   ->where('user.name',$name)
                                   ->first();

            $data['user'] = DB::table('post')->select('post.published','post.title','post.slug','post.cover','post.seo_title','post.seo_description','user.name as nameuser','post.embed')            
                                   ->where('post.status',4)
                                   ->orderby('post.published','DESC')
                                   ->leftjoin('user', 'user.id', 'post.publisher')                                   
                                   ->where('user.name',$name)
                                   ->paginate(20);
            if ($req->ajax()) {
                return view('frontend::mobile.user.user-loadnews', $data);
            }

            // $arr = get_defined_vars();
            // dd($arr);
            return view('frontend::mobile.user.index', $data);
        }
        else{
            $data['nameuser'] = DB::table('user')->select('user.fullname as nameuser','user.avatar')
                                   ->where('user.name',$name)
                                   ->first();
           $data['user'] = DB::table('user')
                          ->where('user.name',$name)
                          ->join('post','post.publisher','user.id')
                          ->select('post.id','post.cover','post.title','post.published','post.seo_description','post.slug','user.name','user.avatar','post.embed')
                          ->where('post.status',4)
                          ->orderby('post.published','DESC')
                          ->paginate(20);


            // $data['popular'] = DB::table('post')                        
            //             ->where('post.status',4)
            //             ->where('post.published', '>', DB::raw('DATE_SUB(CURDATE(), INTERVAL 21 DAY)'))
            //             ->join('user','user.id','post.publisher')
            //             ->where('user.name',$name)
            //             ->select('post.id','post.cover','post.title','post.published','post.seo_description','post.slug','user.name','user.avatar')
            //             ->join('post_trending','post_trending.post','post.id')
            //             ->orderby('post_trending.view','DESC')
            //             ->take(4)
            //             ->get();

            if ($req->ajax()) {
              return view('frontend::dekstop.user.user-loadnews', $data);
            }

            return view('frontend::dekstop.user.index',$data); 
        }
        
    }

    public function page($slug)
    {
      $agent = new Agent();
      if ($agent->isMobile()) {
        $data['page'] = DB::table('page')
                      ->where('page.slug',$slug)
                      ->first();

        $data['oghp_title'] = DB::table('site_params')->where('name', 'site_frontpage_title')->first();
        $data['oghp_descr'] = DB::table('site_params')->where('name', 'site_frontpage_description')->first();
        $data['oghp_keywo'] = DB::table('site_params')->where('name', 'site_frontpage_keywords')->first(); 

        return view('frontend::mobile.page.index',$data);
      }
      else{
        $data['page'] = DB::table('page')
                      ->where('page.slug',$slug)
                      ->first();

        $data['oghp_title'] = DB::table('site_params')->where('name', 'site_frontpage_title')->first();
        $data['oghp_descr'] = DB::table('site_params')->where('name', 'site_frontpage_description')->first();
        $data['oghp_keywo'] = DB::table('site_params')->where('name', 'site_frontpage_keywords')->first();

        return view('frontend::dekstop.page.index',$data);        
      }     
    }

    public function tagByID($post_id){

        $selected = array();
        $selected_tag = DB::table('post')
                        ->select('post_tag.id')
                        ->leftjoin('post_tag_chain','post_tag_chain.post','post.id')
                        ->leftjoin('post_tag','post_tag.id','post_tag_chain.post_tag')
                        ->where('post.id', $post_id)->get();
        if(count($selected_tag) > 0){
            $tag_id = array();
            foreach($selected_tag as $s)
            {      
                $data = $s->id;
              array_push($tag_id, $data);
            }
            $selected = $tag_id;
        }
        return $selected;
    }

}
