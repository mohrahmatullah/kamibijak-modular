<?php

namespace Modules\Admin\Http\Controllers\Ajax;

// use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Post;
use Modules\Admin\Entities\PostTag;
use Modules\Admin\Entities\PostTagChain;
use Modules\Admin\Entities\PostCategory;
use Modules\Admin\Entities\PostCategoryChain;
use Modules\Admin\Entities\PostSchedule;
use Modules\Admin\Entities\ListingPostChain;
use Modules\Admin\Entities\PostCreditChain;
use Modules\Admin\Entities\Listing;
use Modules\Admin\Entities\ListingArea;
use Modules\Admin\Entities\ListingCategory;
use Modules\Admin\Entities\ListingTag;
use Modules\Admin\Entities\User;
use Modules\Admin\Entities\UserPerms;
use Modules\Admin\Entities\Banner;
use Modules\Admin\Entities\Page;
use Modules\Admin\Entities\SiteParam;
use Modules\Admin\Entities\Gallery;
use Modules\Admin\Entities\GalleryMedia;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Validator;
use Illuminate\Support\Facades\Response;
use Request;
use Session;

class AjaxController extends Controller
{
  public function saveRelatedImage(){
    if(Request::isMethod('post') && Request::ajax()){
      if(Session::token() == Request::header('X-CSRF-TOKEN')){
        $input = Input::all();
        $rules = array();

        if(isset($input['cover_picture'])){
          $rules = array(
            'cover_picture' => 'image',
          );
        }
        if(isset($input['thumbnail_picture'])){
          $rules = array(
            'thumbnail_picture' => 'image',
          );
        }
        if(isset($input['covercat_picture'])){
          $rules = array(
            'covercat_picture' => 'image',
          );
        }
        if(isset($input['avatarcat_picture'])){
          $rules = array(
            'avatarcat_picture' => 'image',
          );
        }
        if(isset($input['iconcat_picture'])){
          $rules = array(
            'iconcat_picture' => 'image',
          );
        }
        if(isset($input['useravatar_picture'])){
          $rules = array(
            'useravatar_picture' => 'image',
          );
        }
        if(isset($input['backgrounduser_picture'])){
          $rules = array(
            'backgrounduser_picture' => 'image',
          );
        }
        if(isset($input['mediabanner_picture'])){
          $rules = array(
            'mediabanner_picture' => 'image',
          );
        }
        if(isset($input['covergal_picture'])){
          $rules = array(
            'covergal_picture' => 'image',
          );
        }
        

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
          return Response::make($validation->errors->first(), 400);
        }
        else{
          $fileName = '';
          $image    = '';
          // $width    = 0;
          // $height   = 0;
          
          
          if(isset($input['cover_picture'])){
            $image = Input::file('cover_picture');
            $fileName = md5(uniqid()).".".$image->getClientOriginalExtension();
            // $width    = 1920;
            // $height = 1080;
          }
          if(isset($input['thumbnail_picture'])){
            $image = Input::file('thumbnail_picture');
            $fileName = md5(uniqid()).".".$image->getClientOriginalExtension();
            // $width    = 300;
            // $height = 250;
          }
          if(isset($input['covercat_picture'])){
            $image = Input::file('covercat_picture');
            $fileName = md5(uniqid()).".".$image->getClientOriginalExtension();
            // $width    = 300;
            // $height = 250;
          }
          if(isset($input['avatarcat_picture'])){
            $image = Input::file('avatarcat_picture');
            $fileName = md5(uniqid()).".".$image->getClientOriginalExtension();
            // $width    = 300;
            // $height = 250;
          }
          if(isset($input['iconcat_picture'])){
            $image = Input::file('iconcat_picture');
            $fileName = md5(uniqid()).".".$image->getClientOriginalExtension();
            // $width    = 300;
            // $height = 250;
          }
          if(isset($input['useravatar_picture'])){
            $image = Input::file('useravatar_picture');
            $fileName = md5(uniqid()).".".$image->getClientOriginalExtension();
            // $width    = 300;
            // $height = 250;
          }
          if(isset($input['backgrounduser_picture'])){
            $image = Input::file('backgrounduser_picture');
            $fileName = md5(uniqid()).".".$image->getClientOriginalExtension();
            // $width    = 300;
            // $height = 250;
          }
          if(isset($input['mediabanner_picture'])){
            $image = Input::file('mediabanner_picture');
            $fileName = md5(uniqid()).".".$image->getClientOriginalExtension();
            // $width    = 300;
            // $height = 250;
          }
          if(isset($input['covergal_picture'])){
            $image = Input::file('covergal_picture');
            $fileName = md5(uniqid()).".".$image->getClientOriginalExtension();
            // $width    = 300;
            // $height = 250;
          }
          
          // $img   = Image::make($image);
          // $img->fit(1920, 1080);
          // $img->resize($width, $height);
          // $path  = public_path('assets/uploads/images/' . $fileName);
          // $upload_success = $image->move(public_path('assets/uploads/images/'),$fileName);

          list($width, $height, $type, $attr) = getimagesize($image);
          $aspect = get_aspect_ratio($width, $height);
          // if ($aspect != "16:9"){
          //   $img = crop($image);
          //   $path  = public_path('assets/uploads/images/' . $fileName);
          //   if ($img->save($path)) {
          //     return response()->json(array('status' => 'success', 'name' => $fileName));
          //   } else {
          //     return Response::json('error', 400);
          //   }
          // }
          // else{
          //   $upload_success = $image->move(public_path('assets/uploads/images/'),$fileName);
          //   if ($upload_success) {
          //     return response()->json(array('status' => 'success', 'name' => $fileName));
          //   } else {
          //     return Response::json('error', 400);
          //   }
          // }

          if ($aspect == "16:9"){
            $img_large   = Image::make($image);
            $img_large->fit(1920, 1080);
            $path_large  = public_path('assets/uploads/images/large/' . $fileName);
            $img_large->save($path_large);

            $img_medium = Image::make($image);
            $img_medium->fit(480, 270);
            $path_medium  = public_path('assets/uploads/images/medium/' . $fileName);
            $img_medium->save($path_medium);

            $img_small = Image::make($image);
            $img_small->fit(246, 138);
            $path_small  = public_path('assets/uploads/images/small/' . $fileName);
            $img_small->save($path_small);

            return response()->json(array('status' => 'success', 'name' => $fileName));
          }
          else
          {
            return Response::json('error', 400);
          }

          // if(isset($input['profile_picture'])){
          //   $img->resize(900, null, function ($constraint) {
          //       $constraint->aspectRatio();
          //   });
            
          //   $img->save(public_path('assets/admin/uploads/' . 'large-'.$fileName));
          // }

          // if($img->width() > 1921 || $img->height() > 1081){
          //   $img->resize($width, $height);
          //   // $img = crop_image($image);
          // }
          // elseif($img->width() == 1920 || $img->height() == 1080){
          //   $img->resize($width, $height);
          // }
          // elseif($width >0 && $height == 0){
          //   $img->resize($width, null, function ($constraint) {
          //       $constraint->aspectRatio();
          //   });
          // }
          // else{
          //   $img->resize(null, $height, function ($constraint) {
          //       $constraint->aspectRatio();
          //   });
          // }
          
          // if ($img->save($path)) {
          //   return response()->json(array('status' => 'success', 'name' => $fileName));
          // } else {
          //   return Response::json('error', 400);
          // }
          // if ($upload_success) {
          //   return response()->json(array('status' => 'success', 'name' => $fileName));
          // } else {
          //   return Response::json('error', 400);
          // }
        }
      }
    }
  }

  public function saveAllImage(){
    if(Request::isMethod('post') && Request::ajax()){
      if(Session::token() == Request::header('X-CSRF-TOKEN')){
        $input = Input::all();
        $rules = array();

        if(isset($input['covercat_picture'])){
          $rules = array(
            'covercat_picture' => 'image',
          );
        }
        if(isset($input['avatarcat_picture'])){
          $rules = array(
            'avatarcat_picture' => 'image',
          );
        }
        if(isset($input['iconcat_picture'])){
          $rules = array(
            'iconcat_picture' => 'image',
          );
        }
        if(isset($input['tag_image'])){
          $rules = array(
            'tag_image' => 'image',
          );
        }

        if(isset($input['useravatar_picture'])){
          $rules = array(
            'useravatar_picture' => 'image',
          );
        }
        if(isset($input['backgrounduser_picture'])){
          $rules = array(
            'backgrounduser_picture' => 'image',
          );
        }
        if(isset($input['covergal_picture'])){
          $rules = array(
            'covergal_picture' => 'image',
          );
        }
        

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
          return Response::make($validation->errors->first(), 400);
        }
        else{
          $fileName = '';
          $image    = '';

          if(isset($input['covercat_picture'])){
            $image = Input::file('covercat_picture');
            $fileName = md5(uniqid())."_cover.".$image->getClientOriginalExtension();
            $upload_success = $image->move(public_path('assets/uploads/images/category/'),$fileName);
          }
          if(isset($input['avatarcat_picture'])){
            $image = Input::file('avatarcat_picture');
            $fileName = md5(uniqid())."_avatar.".$image->getClientOriginalExtension();
            $upload_success = $image->move(public_path('assets/uploads/images/category/'),$fileName);
          }
          if(isset($input['iconcat_picture'])){
            $image = Input::file('iconcat_picture');
            $fileName = md5(uniqid())."_icon.".$image->getClientOriginalExtension();
            $upload_success = $image->move(public_path('assets/uploads/images/category/'),$fileName);
          }
          if(isset($input['tag_image'])){
            $image = Input::file('tag_image');
            $fileName = md5(uniqid())."_icon.".$image->getClientOriginalExtension();
            $upload_success = $image->move(public_path('assets/uploads/images/tag/'),$fileName);
            if(!File::isDirectory($upload_success)){
                File::makeDirectory($upload_success, $mode = 0777, true, true);
            }
          }

          if(isset($input['useravatar_picture'])){
            $image = Input::file('useravatar_picture');
            $fileName = md5(uniqid())."_avatar.".$image->getClientOriginalExtension();
            $upload_success = $image->move(public_path('assets/uploads/images/user/'),$fileName);
            if(!File::isDirectory($upload_success)){
                File::makeDirectory($upload_success, $mode = 0777, true, true);
            }
          }
          if(isset($input['backgrounduser_picture'])){
            $image = Input::file('backgrounduser_picture');
            $fileName = md5(uniqid())."_background.".$image->getClientOriginalExtension();
            $upload_success = $image->move(public_path('assets/uploads/images/user/'),$fileName);
            if(!File::isDirectory($upload_success)){
                File::makeDirectory($upload_success, $mode = 0777, true, true);
            }
          }
          if(isset($input['covergal_picture'])){
            $image = Input::file('covergal_picture');
            $fileName = md5(uniqid())."_covergal.".$image->getClientOriginalExtension();
            $upload_success = $image->move(public_path('assets/uploads/images/gallery/'),$fileName);
          }
          

          if ($upload_success) {
            return response()->json(array('status' => 'success', 'name' => $fileName));
          } else {
            return Response::json('error', 400);
          }
        }
      }
    }
  }

  public function saveImageBanner(){
    if(Request::isMethod('post') && Request::ajax()){
      if(Session::token() == Request::header('X-CSRF-TOKEN')){
        $input = Input::all();
        $rules = array();

        if(isset($input['mediabanner_picture'])){
          $rules = array(
            'mediabanner_picture' => 'image',
          );
        }
        

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
          return Response::make($validation->errors->first(), 400);
        }
        else{
          $fileName = '';
          $image    = '';

            if(isset($input['mediabanner_picture'])){
              $image = Input::file('mediabanner_picture');
              $fileName = md5(uniqid()).".".$image->getClientOriginalExtension();
            }  

            $upload_success = $image->move(public_path('assets/uploads/images/banner/'),$fileName);

            if ($upload_success) {
              return response()->json(array('status' => 'success', 'name' => $fileName));
            } else {
              return Response::json('error', 400);
            }
        }
      }
    }
  }

  public function saveRelatedVideo(){
    if(Request::isMethod('post') && Request::ajax()){
      if(Session::token() == Request::header('X-CSRF-TOKEN')){
        $input = Input::all();
        $rules = array();

        if(isset($input['videobanner_picture'])){
          $rules = array(
            'videobanner_picture' => 'required',
          );
        }
        

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
          return Response::make($validation->errors->first(), 400);
        }
        else{
          $fileName = '';
          $image    = '';
          
          
          if(isset($input['videobanner_picture'])){
            $image = Input::file('videobanner_picture');
            $fileName = time()."-".$image->getClientOriginalName();
          }

          $upload_success = $image->move(public_path('assets/uploads/video/banner/'),$fileName);

          if ($upload_success) {
            return response()->json(array('status' => 'success', 'name' => $fileName));
          } else {
            return Response::json('error', 400);
          }
        }
      }
    }
  }

  public function saveCategoriesDetails(){
    $input = Request::all();
    
    if(Request::isMethod('post') && Request::ajax()){
      if(Session::token() == Request::header('X-CSRF-TOKEN')){
        if((isset($input['data']['name'])&& $input['data']['name']) && (isset($input['data']['slug']) && $input['data']['slug'])){
          
          $termObj          =     new PostCategory;
          // $cat_slug         =     '';
                        
          // $check_slug  = PostCategory::where(['slug' => string_slug_format( $input['data']['slug'] )])->get()->count();

          // if($check_slug === 0){
          //   $cat_slug = string_slug_format( $input['data']['slug'] );
          // }
          // elseif($check_slug > 0){
          //   $slug_count = $check_slug + 1;
          //   $cat_slug = string_slug_format( $input['data']['slug'] ). '-' . $slug_count;
          // }

            if($input['data']['click_source'] == 'for_add'){
                          $termObj->name        =   $input['data']['name'];
                          $termObj->slug        =   $input['data']['slug'];
                          $termObj->cover        =   $input['data']['cover'];
                          $termObj->avatar        =   $input['data']['avatar'];
                          $termObj->icon        =   $input['data']['icon'];
                          $termObj->parent      =   $input['data']['parent'];
                          $termObj->description        =   $input['data']['description'];
                          $termObj->color        =   $input['data']['color'];
                          $termObj->seo_schema        =   $input['data']['schema'];
                          $termObj->seo_title        =   $input['data']['metatitle'];
                          $termObj->seo_description        =   $input['data']['metadescription'];
                          $termObj->seo_keywords        =   $input['data']['metakeywords'];
                          $termObj->user        =   Session::get('kamibijak_admin');
                          $termObj->created        =   date("y-m-d H:i:s", strtotime('now'));
                              
              if( $termObj->save() ){
                        return response()->json(array('success' => TRUE));              
              }
            }
          elseif ($input['data']['click_source'] == 'for_update'){
            $data = array(
                          'name'        =>    $input['data']['name'],
                          'slug'        =>    $input['data']['slug'],
                          'cover'        =>   $input['data']['cover'],
                          'avatar'        =>   $input['data']['avatar'],
                          'icon'        =>   $input['data']['icon'],
                          'parent'      =>    $input['data']['parent'],
                          'description'      =>    $input['data']['description'],
                          'color'           =>      $input['data']['color'],
                          'seo_schema'      =>    $input['data']['schema'],
                          'seo_title'      =>    $input['data']['metatitle'],
                          'seo_description'      =>    $input['data']['metadescription'],
                          'seo_keywords'      =>    $input['data']['metakeywords'],
                          'user'        =>    Session::get('kamibijak_admin'),
                          'created'      =>    date("y-m-d H:i:s", strtotime('now'))
            );
              
            if( PostCategory::where('id', $input['data']['id'])->update($data)){                                
              return response()->json(array('success' => TRUE));
            }
          }
        }
        else {
          return response()->json(array('error_no_entered' => FALSE));
        }
      }
    }
  }

  public function saveTagsDetails(){
    $input = Request::all();
    
    if(Request::isMethod('post') && Request::ajax() && Session::token() == Request::header('X-CSRF-TOKEN')){
      if(isset($input['data']['name'])&& $input['data']['name']){
        $termObj       =    new PostTag;
        $tag_slug      =    '';
        
        // $check_slug  =  PostTag::where(['slug' => string_slug_format( $input['data']['name'] )])->get()->count();

        // if($check_slug === 0){
        //   $tag_slug = string_slug_format( $input['data']['name'] );
        // }
        // elseif($check_slug > 0){
        //   $slug_count = $check_slug + 1;
        //   $tag_slug = string_slug_format( $input['data']['name'] ). '-' . $slug_count;
        // }
        
        if($input['data']['click_source'] == 'for_add'){
            $termObj->name        =   $input['data']['name'];
            $termObj->slug        =   $input['data']['slug'];
            $termObj->group        =   $input['data']['group'];
            $termObj->description      =   $input['data']['description'];
            $termObj->official      =   $input['data']['official'];
            $termObj->user      =   Session::get('kamibijak_admin');
            $termObj->seo_schema      =   $input['data']['schema'];
            $termObj->seo_title      =   $input['data']['metatitle'];
            $termObj->seo_description      =   $input['data']['metadescription'];
            $termObj->seo_keywords      =   $input['data']['metakeywords'];
            $termObj->created        =   date("y-m-d H:i:s", strtotime('now'));
            
          if( $termObj->save() ){
              return response()->json(array('success' => TRUE));
          }
        }
        elseif ($input['data']['click_source'] == 'for_update'){
          $data = array(
                        'name'        =>    $input['data']['name'],
                        'slug'        =>   $input['data']['slug'],
                        'group'        =>   $input['data']['group'],
                        'description'      =>   $input['data']['description'],
                        'official'      =>   $input['data']['official'],
                        'user'      =>   Session::get('kamibijak_admin'),
                        'seo_schema'      =>   $input['data']['schema'],
                        'seo_title'      =>   $input['data']['metatitle'],
                        'seo_description'      =>   $input['data']['metadescription'],
                        'seo_keywords'      =>   $input['data']['metakeywords'],
                        'created'      =>    date("y-m-d H:i:s", strtotime('now'))
          );

          if( PostTag::where('id', $input['data']['id'])->update($data)){
            return response()->json(array('success' => TRUE));
          }
        }
      }
      else {
        return response()->json(array('error_no_entered' => FALSE));
      }
    }
  }

  public function saveBannerDetails(){
    $input = Request::all();
    
    if(Request::isMethod('post') && Request::ajax() && Session::token() == Request::header('X-CSRF-TOKEN')){
      if(isset($input['data']['name'])&& $input['data']['name']){
        $termObj       =    new Banner;
        
        if($input['data']['click_source'] == 'for_add'){
            $termObj->name        =   $input['data']['name'];
            $termObj->placement        =   $input['data']['placement'];
            $termObj->timestart        =   $input['data']['timestart'];
            $termObj->expired      =   $input['data']['expired'];
            $termObj->media      =   $input['data']['media'];
            $termObj->video      =   $input['data']['video'];
            $termObj->link      =   $input['data']['link'];
            $termObj->website      =   $input['data']['website'];
            $termObj->user      =   Session::get('kamibijak_admin');
            $termObj->code      =   $input['data']['code'];
            $termObj->created        =   date("y-m-d H:i:s", strtotime('now'));
            
          if( $termObj->save() ){
              return response()->json(array('success' => TRUE));
          }
        }
        elseif ($input['data']['click_source'] == 'for_update'){
          $data = array(
                        'name'        =>    $input['data']['name'],
                        'placement'        =>   $input['data']['placement'],
                        'timestart'        =>   $input['data']['timestart'],
                        'expired'      =>   $input['data']['expired'],
                        'media'      =>   $input['data']['media'],
                        'video'      =>   $input['data']['video'],
                        'link'      =>   $input['data']['link'],
                        'website'      =>   $input['data']['website'],
                        'user'      =>   Session::get('kamibijak_admin'),
                        'code'      =>   $input['data']['code'],
                        'created'      =>    date("y-m-d H:i:s", strtotime('now'))
          );

          if( Banner::where('id', $input['data']['id'])->update($data)){
            return response()->json(array('success' => TRUE));
          }
        }
      }
      else {
        return response()->json(array('error_no_entered' => FALSE));
      }
    }
  }

  public function savePageDetails(){
    $input = Request::all();
    
    if(Request::isMethod('post') && Request::ajax() && Session::token() == Request::header('X-CSRF-TOKEN')){
      if(isset($input['data']['title'])&& $input['data']['title']){
        $termObj       =    new Page;
        $tag_slug      =    '';
        
        if($input['data']['click_source'] == 'for_add'){
            $termObj->title        =   $input['data']['title'];
            $termObj->slug        =   $input['data']['slug'];
            $termObj->content      =   $input['data']['content'];
            $termObj->seo_schema      =   $input['data']['schema'];
            $termObj->seo_title      =   $input['data']['metatitle'];
            $termObj->seo_description      =   $input['data']['metadescription'];
            $termObj->seo_keywords      =   $input['data']['metakeywords'];
            $termObj->created        =   date("y-m-d H:i:s", strtotime('now'));
            
          if( $termObj->save() ){
              return response()->json(array('success' => TRUE));
          }
        }
        elseif ($input['data']['click_source'] == 'for_update'){
          $data = array(
                        'title'        =>    $input['data']['title'],
                        'slug'        =>   $input['data']['slug'],
                        'content'      =>   $input['data']['content'],
                        'seo_schema'      =>   $input['data']['schema'],
                        'seo_title'      =>   $input['data']['metatitle'],
                        'seo_description'      =>   $input['data']['metadescription'],
                        'seo_keywords'      =>   $input['data']['metakeywords'],
                        'created'      =>    date("y-m-d H:i:s", strtotime('now'))
          );

          if( Page::where('id', $input['data']['id'])->update($data)){
            return response()->json(array('success' => TRUE));
          }
        }
      }
      else {
        return response()->json(array('error_no_entered' => FALSE));
      }
    }
  }

  public function saveParamDetails(){
    $input = Request::all();
    
    if(Request::isMethod('post') && Request::ajax() && Session::token() == Request::header('X-CSRF-TOKEN')){
      if(isset($input['data']['name'])){
        $termObj       =    new SiteParam;
        
        if($input['data']['click_source'] == 'for_add'){
            $termObj->name        =   $input['data']['name'];
            $termObj->value        =   $input['data']['value'];
            $termObj->created        =   date("y-m-d H:i:s", strtotime('now'));
            
          if( $termObj->save() ){
              return response()->json(array('success' => TRUE));
          }
        }
        elseif ($input['data']['click_source'] == 'for_update'){
          $data = array(
                        'name'        =>    $input['data']['name'],
                        'value'        =>   $input['data']['value'],
                        'created'      =>    date("y-m-d H:i:s", strtotime('now'))
          );

          if( SiteParam::where('id', $input['data']['id'])->update($data)){
            return response()->json(array('success' => TRUE));
          }
        }
      }
      else {
        return response()->json(array('error_no_entered' => FALSE));
      }
    }
  }

  public function selectedItemDeleteById(){
    $input = Request::all();
    
    if(Request::isMethod('post') && Request::ajax() && Session::token() == Request::header('X-CSRF-TOKEN')){
      if($input['data']['id'] && $input['data']['track']){
        if($input['data']['track'] == 'tag_list'){
          if(PostTag::where('id', $input['data']['id'])->delete()){
            // PostTagChain::where('post_tag', $input['data']['id'])->delete();
            return response()->json(array('delete' => true));
          }
        }
        elseif($input['data']['track'] == 'cat_list'){
          if(PostCategory::where('id', $input['data']['id'])->delete()){
            return response()->json(array('delete' => true));
          }
        }
        elseif($input['data']['track'] == 'post_list'){
          if(Post::where('id', $input['data']['id'])->delete()){
              PostCategoryChain::where('post', $input['data']['id'])->delete();
              PostTagChain::where('post', $input['data']['id'])->delete();
              ListingPostChain::where('post', $input['data']['id'])->delete();
              PostCreditChain::where('post', $input['data']['id'])->delete();
              PostSchedule::where('post', $input['data']['id'])->delete();
            return response()->json(array('delete' => true));
          }
        }
        elseif($input['data']['track'] == 'listing_list'){
          if(Listing::where('id', $input['data']['id'])->delete()){
            return response()->json(array('delete' => true));
          }
        }
        elseif($input['data']['track'] == 'listing_area_list'){
          if(ListingArea::where('id', $input['data']['id'])->delete()){
            return response()->json(array('delete' => true));
          }
        }
        elseif($input['data']['track'] == 'listing_cat_list'){
          if(ListingCategory::where('id', $input['data']['id'])->delete()){
            return response()->json(array('delete' => true));
          }
        }
        elseif($input['data']['track'] == 'listing_tag_list'){
          if(ListingTag::where('id', $input['data']['id'])->delete()){
            return response()->json(array('delete' => true));
          }
        }
        elseif($input['data']['track'] == 'user_list'){
          if(User::where('id', $input['data']['id'])->delete()){
            UserPerms::where('user', $input['data']['id'])->delete();
            return response()->json(array('delete' => true));
          }
        }
        elseif($input['data']['track'] == 'banner_list'){
          if(Banner::where('id', $input['data']['id'])->delete()){
            return response()->json(array('delete' => true));
          }
        }
        elseif($input['data']['track'] == 'page_list'){
          if(Page::where('id', $input['data']['id'])->delete()){
            return response()->json(array('delete' => true));
          }
        }
        elseif($input['data']['track'] == 'param_list'){
          if(SiteParam::where('id', $input['data']['id'])->delete()){
            return response()->json(array('delete' => true));
          }
        }
        elseif($input['data']['track'] == 'gallery_list'){
          if(Gallery::where('id', $input['data']['id'])->delete()){
            GalleryMedia::where('gallery', $input['data']['id'])->delete();
            return response()->json(array('delete' => true));
          }
        }
        elseif($input['data']['track'] == 'gallery_media_list'){
          if(GalleryMedia::where('id', $input['data']['id'])->delete()){
            return response()->json(array('delete' => true));
          }
        }

      }
    }
  }

  public function getSpecificDetailsById(){
    $input = Request::all();
    
    if(Request::isMethod('post') && Request::ajax()){
      if(Session::token() == Request::header('X-CSRF-TOKEN')){
        if($input['data']['id'] && $input['data']['track']){
          $get_details_by_id = '';

          if($input['data']['track'] == 'cat_list'){
            $get_details_by_id =  PostCategory::where('id', $input['data']['id'])->first();
            
            $data = array('success' => TRUE, 'name' => $get_details_by_id->name, 'cover' => $get_details_by_id->cover, 'avatar' => $get_details_by_id->avatar, 'icon' => $get_details_by_id->icon, 'slug' => $get_details_by_id->slug, 'description' => $get_details_by_id->description, 'color' => $get_details_by_id->color, 'parent' => $get_details_by_id->parent, 'schema' => $get_details_by_id->seo_schema, 'metatitle' => $get_details_by_id->seo_title, 'metadescription' => $get_details_by_id->seo_description, 'metakeywords' => $get_details_by_id->seo_keywords);
          }
          elseif($input['data']['track'] == 'tag_list'){
            $get_details_by_id = PostTag::where('id',$input['data']['id'])->first();
            
            $data = array('success' => TRUE, 'name' => $get_details_by_id->name, 'slug' => $get_details_by_id->slug, 'group' => $get_details_by_id->group, 'description' => $get_details_by_id->description, 'official' => $get_details_by_id->official, 'schema' => $get_details_by_id->seo_schema, 'metatitle' => $get_details_by_id->seo_title, 'metadescription' => $get_details_by_id->seo_description, 'metakeywords' => $get_details_by_id->seo_keywords);
          }
          elseif($input['data']['track'] == 'banner_list'){
            $get_details_by_id = Banner::where('id',$input['data']['id'])->first();
            
            $data = array('success' => TRUE, 'name' => $get_details_by_id->name, 'placement' => $get_details_by_id->placement, 'timestart' => $get_details_by_id->timestart, 'expired' => $get_details_by_id->expired, 'media' => $get_details_by_id->media, 'video' => $get_details_by_id->video, 'link' => $get_details_by_id->link, 'website' => $get_details_by_id->website, 'code' => $get_details_by_id->code);
          }
          elseif($input['data']['track'] == 'page_list'){
            $get_details_by_id = Page::where('id',$input['data']['id'])->first();
            
            $data = array('success' => TRUE, 'title' => $get_details_by_id->title, 'slug' => $get_details_by_id->slug, 'content' => $get_details_by_id->content, 'schema' => $get_details_by_id->seo_schema, 'metatitle' => $get_details_by_id->seo_title, 'metadescription' => $get_details_by_id->seo_description, 'metakeywords' => $get_details_by_id->seo_keywords);
          }
          elseif($input['data']['track'] == 'param_list'){
            $get_details_by_id = SiteParam::where('id',$input['data']['id'])->first();
            
            $data = array('success' => TRUE, 'name' => $get_details_by_id->name, 'value' => $get_details_by_id->value);
          }
          
          return response()->json( $data );
        }
      }
    }
  }

  public function changeItem(){
    $input = Request::all();    
    if(Request::isMethod('post') && Request::ajax() && Session::token() == Request::header('X-CSRF-TOKEN')){
      if($input['data']['id'] && $input['data']['track']){
        if($input['data']['track'] == 'featured_list_yes'){
          if(Post::where('id', $input['data']['id'])->update(['featured' => '1'])){
            return response()->json(array('change' => true));
          }
        }
        elseif($input['data']['track'] == 'featured_list_no'){
          if(Post::where('id', $input['data']['id'])->update(['featured' => '0'])){
            return response()->json(array('change' => true));
          }
        }
        elseif($input['data']['track'] == 'editor_pick_list_yes'){
          if(Post::where('id', $input['data']['id'])->update(['editor_pick' => '1'])){
            return response()->json(array('change' => true));
          }
        }
        elseif($input['data']['track'] == 'editor_pick_list_no'){
          if(Post::where('id', $input['data']['id'])->update(['editor_pick' => '0'])){
            return response()->json(array('change' => true));
          }
        }

      }
    }
  }

  public function notificationapps(){
    // $input = Request::all();
    
    // if(Request::ajax()){
    //   if(Session::token() == Request::header('X-CSRF-TOKEN')){
    //     if($input['data']['id'] && $input['data']['track']){
    //       $get_details_by_id = '';

    //       if($input['data']['track'] == 'notif-to-app'){
    //         $get_details_by_id =  Post::where('id', $input['data']['id'])->first();
            
    //         $data = array('success' => TRUE, 'id' =>$get_details_by_id->id, 'title' => $get_details_by_id->title);
    //       }
          
    //       return response()->json( $data );
    //     }
    //   }
    // }
    $id_artikel = $_GET['id_artikel'];
    $title = $_GET['title'];
    echo $title;
    echo $id_artikel;
  }
  
}
