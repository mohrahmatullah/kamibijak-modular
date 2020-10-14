<?php

namespace Modules\Admin\Http\Controllers\Banner;

// use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Banner;
use Illuminate\Support\Facades\Input;
use Request;
use Session;
use Validator;

class BannerController extends Controller
{
    public function index( Banner $b ){
        $data['current_admin'] = current_admin_info();
        $data['permissions_per_session'] = get_permission_per_session();
        $data['banner'] = $b->get();
        return view('admin::banner.index', $data);
    }

    public function bannerUpdate($id = null)
    {
        $params = [];

        if($id){
            $params['current_admin'] = current_admin_info();
            $params['permissions_per_session'] = get_permission_per_session();
            $object = Banner::where('id', $id)->first();
            if(!$object)
                {
                    return redirect()->route('admin.banner_list');
                }
            $params['title_form'] = "Update Banner";
        }else{
            $params['current_admin'] = current_admin_info();
            $params['permissions_per_session'] = get_permission_per_session();
            $object = "";
            $params['title_form'] = "Add Banner";
        }

        $params['banner'] = $object;
// $arr = get_defined_vars();
//             dd($arr);
        return view('admin::banner.update', $params);
    }

  public function saveBanner($id = Null)
  {
      if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
        $data = Input::all();
        if($id == 0 ){
          $rules =  ['banner_name'  => 'required|unique:banner,name' , 'banner_placement' => 'required'];
          $atributname = [
              'banner_name.required' => 'The banner name field is required.',
              'banner_name.unique' => 'The banner name can not be the same.',
              'banner_placement.required' => 'The banner placement field is required.',
          ];
        }else{
          $rules =  ['banner_name'  => 'required' , 'banner_placement' => 'required'];
          $atributname = [
              'banner_name.required' => 'The banner name field is required.',
              'banner_placement.required' => 'The banner placement field is required.',
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
              $p        =  new Banner; 

              $p->name                 = Input::get('banner_name');
              $p->placement            = Input::get('banner_placement');
              $p->timestart            = Input::get('banner_time_start');
              $p->expired              = Input::get('banner_expired');
              $p->website              = Input::get('banner_caption');
              $p->media                = Input::get('banner_media');
              $p->video                = Input::get('banner_video');
              $p->link                 = Input::get('banner_url');
              $p->code                 = Input::get('banner_code');
              $p->user                 = Session::get('kamibijak_admin');
              $p->created              = date("y-m-d H:i:s", strtotime('now'));
              $p->save();

              Session::flash('success-message', "Success add banner" );
              return redirect()->route('admin.banner_list');

          }else{

              $data = array(
                'name'                  => Input::get('banner_name'),
                'placement'             => Input::get('banner_placement'),
                'timestart'             => Input::get('banner_time_start'),
                'expired'               => Input::get('banner_expired'),
                'website'               => Input::get('banner_caption'),
                'media'                 => Input::get('banner_media'),
                'video'                 => Input::get('banner_video'),
                'link'                  => Input::get('banner_url'),
                'code'                  => Input::get('banner_code'),
                'user'                  => Session::get('kamibijak_admin'),
                'created'               => date("y-m-d H:i:s", strtotime('now'))
              );
              Banner::where('id', $id)->update($data);

              Session::flash('success-message', "Success update banner" );
              return redirect()->route('admin.banner_list');

          }
        }
      }

  }
}
