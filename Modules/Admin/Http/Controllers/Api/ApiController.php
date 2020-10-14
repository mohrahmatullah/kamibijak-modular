<?php

namespace Modules\Admin\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Post;
use Modules\Admin\Entities\PostCategory;
use Modules\Admin\Entities\PostCategoryChain;
use Modules\Admin\Entities\Banner;
use Modules\Admin\Entities\Page;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function all( Post $p )
    {
        $data = $p->where(['post.status' => 4])->orderby('post.published','DESC')->join('user','user.id','post.user')->select('post.id','post.slug','post.title','post.cover','user.name','user.avatar','post.published','post.seo_description','post.embed')->paginate(8);

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function category( PostCategory $pc, Post $p , $slug )
    {
        $data = $pc->select('post.id', 'post.id','post.published','post.title','post.slug','post.cover','post.seo_title','post.seo_description','post_category.slug_mobile as namecategory','post.embed')
                       ->where('post_category.slug_mobile',$slug)
                       ->leftjoin('post_category_chain', 'post_category_chain.post_category', 'post_category.id')
                       ->leftjoin('post','post.id','post_category_chain.post')
                       ->where('post.status',4)
                       ->orderby('post.published','DESC')
                       ->paginate(20);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function detail( Post $p, $id )
    {
        $data['data'] = $p->where('post.status',4)->where('post.id',$id)->join('user','user.id','post.user')->join('post_category_chain','post_category_chain.post','post.id')->join('post_category','post_category.id','post_category_chain.post_category')->select('post.id','post.embed','post.content','post.slug','post.title',/*'post.cover as embed',*/'user.name','user.avatar','post.published','post.seo_description','post.viewed','post_category.name as categoryname','post_category.slug_mobile')->first();

        return $data;
    }

    public function banner( Banner $b )
    {
        $now = date('Y-m-d H:i:s');
        $data['data'] = $b->select('banner.*')->where('timestart','<=',$now)->where('placement','dekstop-banner-detail-video-1')->where('expired','>=',$now)->get();

        return $data;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function related( Post $p, $slug )
    {   
        $data['data'] = $p
            ->leftjoin('post_category_chain','post_category_chain.post','post.id')
            ->leftjoin('post_category','post_category.id','post_category_chain.post_category')
            ->select('post.id','post.slug','post.cover','post.title','post.published','post.viewed','post.embed')
            ->where('post.status',4)
            ->where('post_category.slug', $slug)
            ->orderby('post.published','DESC')
            ->take(5)
            ->get();

        return $data;
    }

    public function tagByID( $p, $id){

        $selected = array();
        $selected_tag = $p
                        ->select('post_tag.id')
                        ->leftjoin('post_tag_chain','post_tag_chain.post','post.id')
                        ->leftjoin('post_tag','post_tag.id','post_tag_chain.post_tag')
                        ->where('post.id', $id)->get();
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

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function highlight( Post $p)
    {
        $data = $p->select('post.id','post.cover','post.title','post.published','post.seo_description','post.slug','user.name','user.avatar','post.embed')->where(['post.status' => 4, 'post.featured' => 1])->orderby('post.published','DESC')->join('user','user.id','post.user')->paginate(8);

        return $data;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function trending( Post $p )
    {
        $data = $p                        
            ->where('post.status',4)
            ->join('user','user.id','post.user')
            ->select('post.id','post.cover','post.title','post.published','post.seo_description','post.slug','user.name','user.avatar','post.embed')
            ->orderby('post.viewed','DESC')
            ->paginate(8);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function search(Request $req, Post $posts)
    {
        $posts = $posts->newQuery();
        $posts->orderby('post.published','DESC')
                ->join('user','user.id','post.user')
                ->select('post.id','post.slug','post.title','post.cover','user.name','user.avatar','post.published','post.seo_description','post.embed');
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
        $data = $posts->paginate(20);

        return $data;
    }

    public function version( )
    {
        // $data['data'] = array(['version' => '19.01']);
        // $data['data'] = array(['version' => '19.05']);
        $data['data'] = array(['version' => '19.04']);

        return $data;
    }

    public function page( Page $p, $slug )
    {
        $data['data'] = $p->where('slug', $slug)->first();

        return $data;
    }
}
