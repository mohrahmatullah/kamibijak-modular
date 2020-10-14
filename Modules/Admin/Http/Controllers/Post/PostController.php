<?php

namespace Modules\Admin\Http\Controllers\Post;

// use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Post;
use Modules\Admin\Entities\PostCategory;
use Modules\Admin\Entities\PostCategoryChain;
use Modules\Admin\Entities\PostTag;
use Modules\Admin\Entities\PostSchedule;
use Modules\Admin\Entities\PostTagChain;
use Modules\Admin\Entities\Listing;
use Modules\Admin\Entities\ListingPostChain;
use Modules\Admin\Entities\User;
use Modules\Admin\Entities\PostCreditChain;
use Modules\Admin\Entities\Gallery;
use Modules\Admin\Entities\Microsite;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Request;
use Session;
use Validator;

class PostController extends Controller
{
  public function index( Post $p, Request $req){
    // $input = $req->all();
    $input = Input::all();
    // dd($input);

    $data['current_admin'] = current_admin_info();
    $data['permissions_per_session'] = get_permission_per_session();
    // $data['post'] = $p->orderby('created','DESC')->get();

    $search_value = '';
    $qfilter = '';

    $data['qfilter'] = (isset($_GET['q']) ? $_GET['q'] : '');
    //$data['post']  =  $this->getPost(true, $search_value, $input);
    //$data['search_value']      =  $search_value;
    $data['post'] = $this->getPosts(true, $input);

    $data['publishers'] = $this->getPublishers();
    $data['categories'] = $this->getCategories();

    $data['result'] = $input;

    //dd($data['post']);
    // $arr = get_defined_vars(); dd($arr);

    return view('admin::post.index', $data);
  }

  public function getCategories() {
    $cat = PostCategory::orderBy('name', 'ASC')->get();

    return $cat;
  }

  public function getPublishers() {
    $pub = User::orderBy('fullname', 'ASC')->get();

    return $pub;
  }

  public function getPosts($pagination = false, $req = null) {
    //$qfilter = (isset($req['q']) ? $req['q'] : '');
    $publisher = (isset($req['pub']) && $req['pub'] != 'all' ? $req['pub'] : '');
    $cat = (isset($req['ct']) && $req['ct'] != 'all' ? $req['ct'] : '');
    $status = (isset($req['sts']) && $req['sts'] != 'all' ? $req['sts'] : '');
    $startdate = (isset($req['sd']) ? $req['sd'] : '');
    $enddate = (isset($req['ed']) ? $req['ed'] : '');
    //$featured = (isset($req['ft']) && $req['ft'] != 'all' ? $req['ft'] : 'all');

    $get_posts = Post::join('post_category_chain', 'post.id', 'post_category_chain.post')
      ->join('post_category', 'post_category.id', 'post_category_chain.post_category')
      ->select('post.id','post.title','post.publisher','post.status','post.published','post_category_chain.post_category')
      /*->when($qfilter, function($query, $qfilter) {
        return $query->where('title', 'LIKE', '%' . $qfilter . '%');
      })*/
      ->when($publisher, function($query, $publisher) {
        return $query->where('post.publisher', $publisher);
      })
      ->when($cat, function($query, $cat) {
        return $query->where('post_category.id', $cat);
      })
      ->when($status, function($query, $status) {
        return $query->where('post.status', $status);
      })
      ->when($startdate, function($query, $startdate) {
        return $query->where('post.published', '>=', $startdate);
      })
      ->when($enddate, function($query, $enddate) {
        return $query->where('post.published', '<=', $enddate);
      })
      /*->when($featured, function($query, $featured) {
        if($featured !== 'all') {
          return $query->where('post.featured', $featured);
        }
        return null;
      })*/
      ->orderBy('post.published', 'DESC')->get();//->paginate(15);

      //dd($qfilter . ', ' . $publisher . ', ' . $cat . ', ' . $status . ', ' . $startdate . ', ' . $enddate . ', ' . $featured);

    //dd($get_posts);

    return $get_posts;
  }


  public function create( PostCategory $pc, PostTag $pt , Listing $l, User $u, Gallery $g, Microsite $m){
    $data['current_admin'] = current_admin_info();
    $data['permissions_per_session'] = get_permission_per_session();
    $data['category'] = $pc->get();
    $data['tag'] = $pt->get();
    $data['listing'] = $l->get();
    $data['user'] = $u->get();
    $data['gallery'] = $g->get();
    $data['microsite'] = $m->get();
    $data['selected_user_by_created'] = array($this->get_selected_user_by_created( Session::get('kamibijak_admin') ));

        // $image_url = "http://kambijak.local/uploads/images/road_field_horizon_mountains_clouds_sky_7843x4462.jpg";
        // $aspect_16_9 = crop($image_url);
        // $resize = resizeImageAspectRatio("new.jpg")
        // $micro = microtime();
        // $aspect = crop_image($image_url);
        // list($width, $height, $type, $attr) = getimagesize($image_url);
        // $aspect = get_aspect_ratio($width, $height); //1280x720
        // $r = get_defined_vars();
        // dd($r);
    return view('admin::post.create', $data);
  }

  public function update( $post_id , Post $p , PostSchedule $ps, PostCategory $pc, PostTag $pt , Listing $l, User $u , Gallery $g , Microsite $m){
    $data['current_admin'] = current_admin_info();
    $data['permissions_per_session'] = get_permission_per_session();
    $data['post']          = $p->where('id', $post_id)->first();
    $data['published_schedule']          = $ps->where('post', $post_id)->first();
    $data['category'] = $pc->get();
    $data['selected_category'] = $this->get_selected_category( $post_id );
    $data['tag'] = $pt->get();
    $data['selected_tag'] = $this->get_selected_tag( $post_id );
    $data['listing'] = $l->get();
    $data['selected_listing'] = $this->get_selected_listing( $post_id );
    $data['user'] = $u->get();
    $data['selected_user'] = $this->get_selected_user( $post_id );
    $data['gallery'] = $g->get();
    $data['microsite'] = $m->get();
    $data['selected_user_by_created'] = array($this->get_selected_user_by_created( Session::get('kamibijak_admin') ));
        // $r = get_defined_vars();
        // dd($r);
    return view('admin::post.update', $data);
  }

  public function category( PostCategory $pc ){
    $data['current_admin'] = current_admin_info();
    $data['permissions_per_session'] = get_permission_per_session();
    $data['pc'] = $pc->get();
    return view('admin::post.category.index', $data);
  }

  public function categoryUpdate($id = null)
  {
      $params = [];

      if($id){
          $params['current_admin'] = current_admin_info();
          $params['permissions_per_session'] = get_permission_per_session();
          $params['categories'] = $this->getCategories();
          $object = PostCategory::where('id', $id)->first();
          if(!$object)
              {
                  return redirect()->route('admin.post_category');
              }
          $params['title_form'] = "Update Category";
      }else{
          $params['current_admin'] = current_admin_info();
          $params['permissions_per_session'] = get_permission_per_session();
          $params['categories'] = $this->getCategories();
          $object = "";
          $params['title_form'] = "Add Category";
      }

      $params['category'] = $object;
// $arr = get_defined_vars();
//             dd($arr);
    return view('admin::post.category.update', $params);
  }

  public function saveCategory($id = Null)
  {
      if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
        $data = Input::all();

        if($id == 0 ){
          $rules =  ['category_name'  => 'required|unique:post_category,name' , 'category_slug' => 'required','category_slug_mobile' => 'required','category_section' => 'required'];
          $atributname = [
              'category_name.required' => 'The category name field is required.',
              'category_name.unique' => 'The category name can not be the same.',
              'category_slug.required' => 'The category slug field is required.',
              'category_slug_mobile.required' => 'The category slug mobile field is required.',
              'category_section.required' => 'The category section field is required.',
          ];
        }else{
          $rules =  ['category_name'  => 'required' , 'category_slug' => 'required','category_slug_mobile' => 'required','category_section' => 'required'];
          $atributname = [
              'category_name.required' => 'The category name field is required.',
              'category_slug.required' => 'The category slug field is required.',
              'category_slug_mobile.required' => 'The category slug mobile field is required.',
              'category_section.required' => 'The category section field is required.',
          ];
        }
     
        $validator = Validator:: make($data, $rules, $atributname);
        if($validator->fails()){
          return redirect()->back()
          ->withInput()
          ->withErrors( $validator );
        }
        else{

          if($id == 0 ){
              $p        =  new PostCategory; 

              $p->name                 = Input::get('category_name');
              $p->slug                 = Input::get('category_slug');
              $p->slug_mobile          = Input::get('category_slug_mobile');
              $p->parent               = Input::get('category_parent');
              $p->color                = Input::get('category_color');
              $p->description          = Input::get('category_description');
              $p->favorite             = Input::get('category_favorite');
              $p->new                  = Input::get('category_new');
              $p->section              = Input::get('category_section');
              $p->cover                = Input::get('category_cover');
              $p->avatar               = Input::get('category_avatar');
              $p->icon                 = Input::get('category_icon');
              $p->seo_schema           = Input::get('category_schema');
              $p->seo_title            = Input::get('category_meta_title');
              $p->seo_description      = Input::get('category_meta_description');
              $p->seo_keywords         = Input::get('category_meta_keywords');
              $p->user                 = Session::get('kamibijak_admin');
              $p->created              = date("y-m-d H:i:s", strtotime('now'));
              $p->save();

              Session::flash('success-message', "Success add category" );
              return redirect()->route('admin.post_category');

          }else{

              $data = array(
                'name'                => Input::get('category_name'),
                'slug'                => Input::get('category_slug'),
                'slug_mobile'         => Input::get('category_slug_mobile'),
                'parent'              => Input::get('category_parent'),
                'color'               => Input::get('category_color'),
                'description'         => Input::get('category_description'),
                'favorite'            => Input::get('category_favorite'),
                'new'                 => Input::get('category_new'),
                'section'             => Input::get('category_section'),
                'cover'               => Input::get('category_cover'),
                'avatar'              => Input::get('category_avatar'),
                'icon'                => Input::get('category_icon'),
                'seo_schema'          => Input::get('category_schema'),
                'seo_title'           => Input::get('category_meta_title'),
                'seo_description'     => Input::get('category_meta_description'),
                'seo_keywords'        => Input::get('category_meta_keywords'),
                'user'                => Session::get('kamibijak_admin'),
                'updated'             => date("y-m-d H:i:s", strtotime('now'))
              );
              PostCategory::where('id', $id)->update($data);

              Session::flash('success-message', "Success update category" );
              return redirect()->route('admin.post_category');

          }
        }
      }

  }

  public function tag( PostTag $pt ){
    $data['current_admin'] = current_admin_info();
    $data['permissions_per_session'] = get_permission_per_session();
    $data['pt'] = $pt->get();
    return view('admin::post.tag.index', $data);
  }

  public function tagUpdate($id = null)
  {
      $params = [];

      if($id){
          $params['current_admin'] = current_admin_info();
          $params['permissions_per_session'] = get_permission_per_session();
          $object = PostTag::where('id', $id)->first();
          if(!$object)
              {
                  return redirect()->route('admin.post_tag');
              }
          $params['title_form'] = "Update Tag";
      }else{
          $params['current_admin'] = current_admin_info();
          $params['permissions_per_session'] = get_permission_per_session();
          $object = "";
          $params['title_form'] = "Add Tag";
      }

      $params['tag'] = $object;
// $arr = get_defined_vars();
//             dd($arr);
      return view('admin::post.tag.update', $params);
  }

  public function saveTag($id = Null)
  {
      // $arr = get_defined_vars();
      // dd($arr);

      if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
        $data = Input::all();

        if($id == 0 ){
          $rules =  ['tag_name'  => 'required|unique:post_tag,name' , 'tag_slug' => 'required'];
          $atributname = [
              'tag_name.required' => 'The tag name field is required.',
              'tag_name.unique' => 'The tag name can not be the same.',
              'tag_slug.required' => 'The tag slug field is required.',
          ];
        }else{
          $rules =  ['tag_name'  => 'required' , 'tag_slug' => 'required'];
          $atributname = [
              'tag_name.required' => 'The tag name field is required.',
              'tag_slug.required' => 'The tag slug field is required.',
          ];
        }
     
        $validator = Validator:: make($data, $rules, $atributname);
 // $arr = get_defined_vars();
 //      dd($arr);
        if($validator->fails()){
          return redirect()->back()
          ->withInput()
          ->withErrors( $validator );
        }
        else{

          if($id == 0 ){
              $p        =  new PostTag; 

              $p->name                 = Input::get('tag_name');
              $p->slug                 = Input::get('tag_slug');
              $p->group                = Input::get('tag_group');
              $p->description          = Input::get('tag_description');
              $p->official             = Input::get('tag_official');
              $p->label                = Input::get('tag_label');
              $p->image                = Input::get('tag_image');
              $p->about                = Input::get('tag_about');
              $p->seo_schema           = Input::get('tag_schema');
              $p->seo_title            = Input::get('tag_meta_title');
              $p->seo_description      = Input::get('tag_meta_description');
              $p->seo_keywords         = Input::get('tag_meta_keywords');
              $p->user                 = Session::get('kamibijak_admin');
              $p->created              = date("y-m-d H:i:s", strtotime('now'));
              $p->save();

              Session::flash('success-message', "Success add tag" );
              return redirect()->route('admin.post_tag');

          }else{

              $data = array(
                'name'                => Input::get('tag_name'),
                'slug'                => Input::get('tag_slug'),
                'group'               => Input::get('tag_group'),
                'description'         => Input::get('tag_description'),
                'official'            => Input::get('tag_official'),
                'label'               => Input::get('tag_label'),
                'image'               => Input::get('tag_image'),
                'about'               => Input::get('tag_about'),
                'seo_schema'          => Input::get('tag_schema'),
                'seo_title'           => Input::get('tag_meta_title'),
                'seo_description'     => Input::get('tag_meta_description'),
                'seo_keywords'        => Input::get('tag_meta_keywords'),
                'user'                => Session::get('kamibijak_admin'),
                'updated'             => date("y-m-d H:i:s", strtotime('now'))
              );
              PostTag::where('id', $id)->update($data);

              Session::flash('success-message', "Success update tag" );
              return redirect()->route('admin.post_tag');

          }
        }
      }

  }

  public function saveAjaxTag(){
    $input = Request::all();
    try {
      if ((isset($input['inputTagName']) && $input['inputTagSlug'])) {
            $termObj                    =    new PostTag;
            $termObj->name              =   $input['inputTagName'];
            $termObj->slug              =   $input['inputTagSlug'];
            $termObj->group             =   $input['inputTagGroup'];
            $termObj->description       =   $input['inputTagDescription'];
            $termObj->official          =   $input['tag_official'];
            $termObj->user              =   Session::get('kamibijak_admin');
            $termObj->seo_schema        =   $input['inputTagSchema'];
            $termObj->seo_title         =   $input['inputTagMetaTitle'];
            $termObj->seo_description   =   $input['inputTagMetaDescription'];
            $termObj->seo_keywords      =   $input['inputTagMetaKeywords'];
            $termObj->created           =   date("y-m-d H:i:s", strtotime('now'));
            
          if( $termObj->save() ){
              return response()->json(array('success' => TRUE));
          }  
      }
      else{
        return response()->json(array('error_no_entered' => FALSE));
      }        
    } catch(\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == '1062'){
          return response()->json(array('duplicate_entry' => FALSE));
        }
    }
    
  }

  public function savePost( $post_id = null ){
    //dd(Input::get('post_featured') == null ? 0 : 1);
    if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
      $data = Input::all();

      if(Input::get('hf_post_type') == 'add_post'){
        if(Input::get('post_type') == 'Article'){
          $rules =  ['post_title'  => 'required|max:100|unique:post,title' , 'post_slug' => 'required' ,'post_content' => 'required', 'post_meta_title' => 'required|max:90', 'post_meta_description' => 'required|max:150', 'post_meta_keywords' => 'required', 'post_category' => 'required', 'post_tag' => 'required', 'post_cover' => 'required'];
        }else{
          $rules =  ['post_title'  => 'required|max:100|unique:post,title' , 'post_slug' => 'required' ,'post_content' => 'required', 'post_meta_title' => 'required|max:90', 'post_meta_description' => 'required|max:150', 'post_meta_keywords' => 'required', 'post_category' => 'required', 'post_embed_script' => 'required', 'post_tag' => 'required', 'post_cover' => 'required'];
        }        
        $atributname = [
          'post_title.required' => 'The post title field is required.',
          'post_title.unique' => 'Post title can not be the same.',
          'post_title.max' => 'The post title may not be greater than 100 characters.',
          'post_meta_title.required' => 'The post meta title field is required.',
          'post_meta_title.max' => 'The post meta title may not be greater than 90 characters.',
          'post_meta_description.required' => 'The post meta description field is required.',
          'post_meta_description.max' => 'The post meta description may not be greater than 150 characters.',
          'post_cover.required' => 'The post image cover field is required.',
        ];
      }elseif (Input::get('hf_post_type') == 'update_post'){
        if(Input::get('post_type') == 'Article'){
          $rules =  ['post_title'  => 'required|max:100' , 'post_slug' => 'required' ,'post_content' => 'required', 'post_meta_title' => 'required|max:90', 'post_meta_description' => 'required|max:150', 'post_meta_keywords' => 'required', 'post_category' => 'required', 'post_tag' => 'required', 'post_cover' => 'required'];
        }else{
          $rules =  ['post_title'  => 'required|max:100' , 'post_slug' => 'required' ,'post_content' => 'required', 'post_meta_title' => 'required|max:90', 'post_meta_description' => 'required|max:150', 'post_meta_keywords' => 'required', 'post_category' => 'required', 'post_embed_script' => 'required', 'post_tag' => 'required', 'post_cover' => 'required'];
        }        
        $atributname = [
          'post_title.required' => 'The post title field is required.',
          'post_title.max' => 'The post title may not be greater than 100 characters.',
          'post_meta_title.required' => 'The post meta title field is required.',
          'post_meta_title.max' => 'The post meta title may not be greater than 90 characters.',
          'post_meta_description.required' => 'The post meta description field is required.',
          'post_meta_description.max' => 'The post meta description may not be greater than 150 characters.',
          'post_cover.required' => 'The post image cover field is required.',
        ];
      }      

      $validator = Validator:: make($data, $rules, $atributname);
      if($validator->fails()){
        return redirect()->back()
        ->withInput()
        ->withErrors( $validator );

      }
      else{

        $post        =  new Post;
        $embed       =  Input::get('post_embed_script');
        if(Input::get('hf_post_type') == 'add_post'){
          
          if(Input::has('post_credit') && count(Input::get('post_credit'))>0){
            foreach(Input::get('post_credit') as $credit_id){
              $credit_data = $credit_id;
            }
          }
          $post->title                = Input::get('post_title');
          $post->label                = Input::get('post_label');
          $post->content              = Input::get('post_content');
          $post->embed                = '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$embed.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
          $post->thumbnail            = Input::get('post_thumbnail');
          $post->cover                = Input::get('post_cover');
          $post->is_photo_only        = Input::get('post_photo_only');
          $post->slug                 = Input::get('post_slug');
          $post->location             = Input::get('post_location');
          $post->sources              = Input::get('post_sources');
          $post->gallery              = Input::get('post_gallery');
          $post->microsite            = Input::get('post_microsite');
          $post->status               = Input::get('post_status');
          $post->featured             = (Input::get('post_featured') == null ? 0 : 1);
          $post->editor_pick          = Input::get('post_editor_pick');
          $post->type_post            = Input::get('post_type');
          $post->seo_schema           = Input::get('post_schema');
          $post->seo_title            = Input::get('post_meta_title');
          $post->seo_description      = Input::get('post_meta_description');
          $post->seo_keywords         = Input::get('post_meta_keywords');
          $post->ga_group             = Input::get('post_ganalytics_group');
          $post->review_score         = Input::get('post_score');
          $post->review_pros          = Input::get('post_review_pros');
          $post->review_cons          = Input::get('post_review_cons');
          $post->review_summary       = Input::get('post_summary');
          $post->published            = Input::get('post_date_published');
          $post->publisher            = $credit_data;
          $post->user                 = Session::get('kamibijak_admin');
          $post->created              = date("y-m-d H:i:s", strtotime('now'));

          if($post->save()){
            if(Input::get('post_status') == 3){
             PostSchedule::insert(
                array(
                  'post'      =>  $post->id,
                  'published' => Input::get('post_published_schedule')
                )); 
             }

                        //save categories
            if(Input::has('post_category') && count(Input::get('post_category'))>0){
              $cat_array = array();

              foreach(Input::get('post_category') as $cat_id){
                $cat_data = array('post_category'  =>  $cat_id, 'post'  =>  $post->id );

                array_push($cat_array, $cat_data);
              }

              if(count($cat_array) > 0){
                PostCategoryChain::insert( $cat_array );    
              }
            }
                        //save tag
            if(Input::has('post_tag') && count(Input::get('post_tag'))>0){
              $tag_array = array();

              foreach(Input::get('post_tag') as $tag_id){
                $tag_data = array('post_tag'  =>  $tag_id, 'post'  =>  $post->id );

                array_push($tag_array, $tag_data);
              }

              if(count($tag_array) > 0){
                PostTagChain::insert( $tag_array );    
              }
            }
                          //save listing
            if(Input::has('post_listing') && count(Input::get('post_listing'))>0){
              $listing_array = array();

              foreach(Input::get('post_listing') as $listing_id){
                $listing_data = array('listing'  =>  $listing_id, 'post'  =>  $post->id );

                array_push($listing_array, $listing_data);
              }

              if(count($listing_array) > 0){
                ListingPostChain::insert( $listing_array );    
              }
            }
                          //save credit
            if(Input::has('post_credit') && count(Input::get('post_credit'))>0){
              $credit_array = array();

              foreach(Input::get('post_credit') as $credit_id){
                $credit_data = array('user'  =>  $credit_id, 'post'  =>  $post->id );

                array_push($credit_array, $credit_data);
              }

              if(count($credit_array) > 0){
                PostCreditChain::insert( $credit_array );    
              }
            }

          Session::flash('success-message', "Success add video" );
          return redirect()->route('admin.post_list');
          }
        }
        elseif (Input::get('hf_post_type') == 'update_post'){

          if(Input::has('post_credit') && count(Input::get('post_credit'))>0){
            foreach(Input::get('post_credit') as $credit_id){
              $credit_data = $credit_id;
            }
          }
          $data = array(
            'title'                => Input::get('post_title'),
            'label'                => Input::get('post_label'),
            'content'              => Input::get('post_content'),
            'embed'                => '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$embed.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>',
            'thumbnail'            => Input::get('post_thumbnail'),
            'cover'                => Input::get('post_cover'),
            'is_photo_only'                => Input::get('post_photo_only'),
            'slug'                => Input::get('post_slug'),
            'location'                => Input::get('post_location'),
            'sources'                => Input::get('post_sources'),
            'gallery'                => Input::get('post_gallery'),
            'microsite'                => Input::get('post_microsite'),
            'status'                => Input::get('post_status'),
            'featured'                => (Input::get('post_featured') == null ? 0 : 1),
            'editor_pick'                => Input::get('post_editor_pick'),
            'type_post'            => Input::get('post_type'),
            'seo_schema'                => Input::get('post_schema'),
            'seo_title'                => Input::get('post_meta_title'),
            'seo_description'                => Input::get('post_meta_description'),
            'seo_keywords'                => Input::get('post_meta_keywords'),
            'ga_group'                => Input::get('post_ganalytics_group'),
            'review_score'                => Input::get('post_score'),
            'review_pros'                => Input::get('post_review_pros'),
            'review_cons'                => Input::get('post_review_cons'),
            'review_summary'                => Input::get('post_summary'),
            'published'                => Input::get('post_date_published'),
            'publisher'            => $credit_data,
            'user'                => $credit_data,
            'created'                => date("y-m-d H:i:s", strtotime('now'))
          );
          if( Post::where('id', $post_id)->update($data)){
            if(Input::get('post_status') == 3){
              $is_object_post_schedule = PostSchedule::where('post', $post_id)->first();

              if(count($is_object_post_schedule)>0){
                PostSchedule::where('post', $post_id)->delete();
              }
              PostSchedule::insert(
                array(
                  'post'    =>  $post_id,
                  'published'      => Input::get('post_published_schedule')
                )); 
            }
                          //save categories
            $is_object_post_category = PostCategoryChain::where('post', $post_id)->get();

            if(count($is_object_post_category)>0){
              PostCategoryChain::where('post', $post_id)->delete();
            }

            if(Input::has('post_category') && count(Input::get('post_category'))>0){
              $cat_array = array();

              foreach(Input::get('post_category') as $cat_id){
                $cat_data = array('post_category'  =>  $cat_id, 'post'  =>  $post_id );

                array_push($cat_array, $cat_data);
              }
              if(count($cat_array) > 0){
                PostCategoryChain::insert( $cat_array );    
              }
            }

                          //save tag
            $is_object_post_tag = PostTagChain::where('post', $post_id)->get();

            if(count($is_object_post_tag)>0){
              PostTagChain::where('post', $post_id)->delete();
            }
            if(Input::has('post_tag') && count(Input::get('post_tag'))>0){
              $tag_array = array();

              foreach(Input::get('post_tag') as $tag_id){
                $tag_data = array('post_tag'  =>  $tag_id, 'post'  =>  $post_id );

                array_push($tag_array, $tag_data);
              }

              if(count($tag_array) > 0){
                PostTagChain::insert( $tag_array );    
              }
            }
                          //save listing
            $is_object_post_listing = ListingPostChain::where('post', $post_id)->get();

            if(count($is_object_post_listing)>0){
              ListingPostChain::where('post', $post_id)->delete();
            }
            if(Input::has('post_listing') && count(Input::get('post_listing'))>0){
              $listing_array = array();

              foreach(Input::get('post_listing') as $listing_id){
                $listing_data = array('listing'  =>  $listing_id, 'post'  =>  $post_id );

                array_push($listing_array, $listing_data);
              }

              if(count($listing_array) > 0){
                ListingPostChain::insert( $listing_array );    
              }
            }
                          //save credit
            $is_object_post_credit = PostCreditChain::where('post', $post_id)->get();

            if(count($is_object_post_credit)>0){
              PostCreditChain::where('post', $post_id)->delete();
            }
            if(Input::has('post_credit') && count(Input::get('post_credit'))>0){
              $credit_array = array();

              foreach(Input::get('post_credit') as $credit_id){
                $credit_data = array('user'  =>  $credit_id, 'post'  =>  $post_id );

                array_push($credit_array, $credit_data);
              }

              if(count($credit_array) > 0){
                PostCreditChain::insert( $credit_array );    
              }
            }
            Session::flash('success-message', "Success update video" );
            return redirect()->route('admin.post_list');
          }

        }

      }
    }
  }

  public function autopublishedbyscheduledate(){
    $now = date('Y-m-d H:i:s', time());
    $published_schedule = DB::table('post_schedule')
    ->where('post_schedule.published','>',  $now )
    ->join('post','post.id','post_schedule.post')
    ->select('post_schedule.published','post.id','post.status')
    ->where('post.status',3)
    ->get();

    foreach($published_schedule as $published){
      $published_schedule_date = date('Y-m-d H:i:s', strtotime($published->published));
      if($now > $published_schedule_date){
        $status_update_data = array('status' => 4);
        DB::table('post')->where('id', $published->id)->update( $status_update_data );
      }
    }

  }

  public function get_selected_tag( $post_id ){
    $selected = array();
    $selected_tag = PostTagChain::where('post', $post_id)->get();
    if(count($selected_tag) > 0){
      $tag_id = array();
      foreach($selected_tag as $s)
      {      
        $data = $s->post_tag;
        array_push($tag_id, $data);
      }
      $selected = $tag_id;
    }
    return $selected;
  }

  public function get_selected_category( $post_id ){
    $selected = array();
    $selected_category = PostCategoryChain::where('post', $post_id)->get();
    if(count($selected_category) > 0){
      $category_id = array();
      foreach($selected_category as $s)
      {      
        $data = $s->post_category;
        array_push($category_id, $data);
      }
      $selected = $category_id;
    }
    return $selected;
  }

  public function get_selected_listing( $post_id ){
    $selected = array();
    $selected_listing = ListingPostChain::where('post', $post_id)->get();
    if(count($selected_listing) > 0){
      $listing_id = array();
      foreach($selected_listing as $s)
      {      
        $data = $s->listing;
        array_push($listing_id, $data);
      }
      $selected = $listing_id;
    }
    return $selected;
  }

  public function get_selected_user( $post_id ){
    $selected = array();
    $selected_credit = PostCreditChain::where('post', $post_id)->get();
    if(count($selected_credit) > 0){
      $credit_id = array();
      foreach($selected_credit as $s)
      {      
        $data = $s->user;
        array_push($credit_id, $data);
      }
      $selected = $credit_id;
    }
    return $selected;
  }

  public function get_selected_user_by_created( $id ){
    $selected = User::where('id', $id)->first()->id;
    return $selected;
  }
}
