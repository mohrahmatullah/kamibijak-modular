<?php

namespace Modules\Admin\Http\Controllers\User;

// use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Request;
use Session;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\User;
use Modules\Admin\Entities\UserPerms;
use Modules\Admin\Entities\Perms;
use Validator;

class UserController extends Controller
{
    public function index(){
        $data['current_admin'] = current_admin_info();
        $data['permissions_per_session'] = get_permission_per_session();
        $data['user'] = DB::table('user')->get();
        return view('admin::user.list',$data);
    }

    public function create( UserPerms $us , Perms $p){
      $data['current_admin'] = current_admin_info();
      $data['permissions_per_session'] = get_permission_per_session();
      $data['permissions'] =  $p->all()->groupBy('group');
        return view('admin::user.create', $data);
    }

    public function update( $user_id,  User $u, UserPerms $us ){
      $data['current_admin'] = current_admin_info();      
      $data['permissions_per_session'] = get_permission_per_session();
      $data['user'] = $u->where('id', $user_id)->first();
      $data['permissions'] =  Perms::all()->groupBy('group');
      $data['selected_userperm'] = $this->get_selected_userperm( $user_id );
      // $rr = get_defined_vars();
      //   dd($rr);
        return view('admin::user.update', $data);
    }

    public function get_selected_userperm( $user_id ){
        $selected = array();
        $selected_userperm = UserPerms::where('user', $user_id)->get();
        if(count($selected_userperm) > 0){
            $userperm_id = array();
            foreach($selected_userperm as $s)
            {      
                $data = $s->perms;
              array_push($userperm_id, $data);
            }
            $selected = $userperm_id;
        }
        return $selected;
    }

    public function saveUser( $user_id = null ){
      if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
        
             
        $data = Input::all();
        // dd($data);
        $rules =  ['name'  => 'required', 'fullname' => 'required', 'email' => 'required'];
        $validator = Validator:: make($data, $rules);
        
        if($validator->fails()){
          return redirect()-> back()
          ->withInput()
          ->withErrors( $validator );
        }
        else{        

          $user        =  new User;

          if(Input::get('hf_user_type') == 'add_user'){

            $user->name            =   Input::get('name');
            $user->fullname              =   Input::get('fullname');
            $user->password               =   bcrypt(Input::get('password'));
            $user->status             =   Input::get('status');
            $user->email                =   Input::get('email');
            $user->website      =   Input::get('website');
            $user->contributor            =   Input::get('iscontributor');
            $user->avatar              =   Input::get('user_avatar');
            $user->background               =   Input::get('user_background');
            $user->about             =   Input::get('about');
            $user->social_facebook                =   Input::get('facebook');
            $user->social_twitter      =   Input::get('twitter');
            $user->social_youtube               =   Input::get('youtube');
            $user->social_instagram             =   Input::get('instagram');
            $user->social_pinterest                =   Input::get('pinterest');
            $user->social_linkedin      =   Input::get('linkedin');
            $user->social_plus      =   Input::get('google');
            $user->created      =   date("y-m-d H:i:s", strtotime('now'));
            if($user->save()){  
              //save permisions
              if(Input::has('perms') && count(Input::get('perms'))>0){
                $perms_array = array();

                foreach(Input::get('perms') as $perms){
                  $perms_data = array('perms'  =>  $perms, 'user'  =>  $user->id );

                  array_push($perms_array, $perms_data);
                }

                if(count($perms_array) > 0){
                  UserPerms::insert( $perms_array );    
                }
              }

              Session::flash('success-message', 'Succes add user');
              return redirect()->route('admin.user_list');
            }
          }
          elseif (Input::get('hf_user_type') == 'update_user'){
            if (Input::get('password') != ''){
              $data = array(
                            'name'             =>  Input::get('name'),
                            'fullname'              =>  Input::get('fullname'),
                            'password'             =>  bcrypt(Input::get('password')),
                            'status'      =>  Input::get('status'),
                            'email'         =>  Input::get('email'),
                            'website'              =>  Input::get('website'),
                            'contributor'            =>   Input::get('iscontributor'),
                            'avatar'              =>   Input::get('user_avatar'),
                            'background'               =>   Input::get('user_background'),
                            'about'             =>   Input::get('about'),
                            'social_facebook'                =>   Input::get('facebook'),
                            'social_twitter'      =>   Input::get('twitter'),
                            'social_youtube'               =>   Input::get('youtube'),
                            'social_instagram'             =>   Input::get('instagram'),
                            'social_pinterest'                =>   Input::get('pinterest'),
                            'social_linkedin'      =>   Input::get('linkedin'),
                            'social_plus'      =>   Input::get('google'),
                            'created'      =>   date("y-m-d H:i:s", strtotime('now'))
              );
            }else{
              $data = array(
                            'name'             =>  Input::get('name'),
                            'fullname'              =>  Input::get('fullname'),
                            'status'      =>  Input::get('status'),
                            'email'         =>  Input::get('email'),
                            'website'              =>  Input::get('website'),
                            'contributor'            =>   Input::get('iscontributor'),
                            'avatar'              =>   Input::get('user_avatar'),
                            'background'               =>   Input::get('user_background'),
                            'about'             =>   Input::get('about'),
                            'social_facebook'                =>   Input::get('facebook'),
                            'social_twitter'      =>   Input::get('twitter'),
                            'social_youtube'               =>   Input::get('youtube'),
                            'social_instagram'             =>   Input::get('instagram'),
                            'social_pinterest'                =>   Input::get('pinterest'),
                            'social_linkedin'      =>   Input::get('linkedin'),
                            'social_plus'      =>   Input::get('google'),
                            'created'      =>   date("y-m-d H:i:s", strtotime('now'))
              );
            }
            if(User::where('id', $user_id)->update($data)){
              //save permisions
              $is_object_user_perms = UserPerms::where('user', $user_id)->get();

              if(count($is_object_user_perms)>0){
                UserPerms::where('user', $user_id)->delete();
              }

              if(Input::has('perms') && count(Input::get('perms'))>0){
                $perms_array = array();

                foreach(Input::get('perms') as $perms){
                  $perms_data = array('perms'  =>  $perms, 'user'  =>  $user_id );

                  array_push($perms_array, $perms_data);
                }
                if(count($perms_array) > 0){
                  UserPerms::insert( $perms_array );    
                }
              }              
              // $arr = get_defined_vars(); dd($arr);
              Session::flash('success-message', 'Succes update user');
              return redirect()->route('admin.user_list');
            }
          }
        }
      }
      else{
        return redirect()-> back();
      }
    }
}
