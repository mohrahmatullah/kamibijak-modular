<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Post;
use Modules\Admin\Entities\User;
use Modules\Admin\Entities\Banner;
use Artisan;

class DashboardController extends Controller
{
    public function clearCache(){
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        die('cache cleared successfully'. ' <a href="'. route('admin.home') .'">'. 'Back to Dashboard' .'</a>');
    }

    public function bakpau(){
        return redirect()->route('admin.login');
    }

    public function index( Post $p , User $u , Banner $b){
        $data['current_admin'] = current_admin_info();
        $data['permissions_per_session'] = get_permission_per_session();
        $data['post_count'] = $p->count();
        $data['user_count'] = $u->count();
        $data['banner_count'] = $b->count();
   //      $r = get_defined_vars();
   // dd($r);
        return view('admin::home.index', $data);
    }
}
