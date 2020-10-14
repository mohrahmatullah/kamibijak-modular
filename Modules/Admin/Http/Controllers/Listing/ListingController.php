<?php

namespace Modules\Admin\Http\Controllers\Listing;

// use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Listing;
use Modules\Admin\Entities\ListingArea;
use Modules\Admin\Entities\ListingCategory;
use Modules\Admin\Entities\ListingTag;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Request;
use Session;
use Validator;

class ListingController extends Controller
{
    public function index( Listing $l ){
        $data['current_admin'] = current_admin_info();
        $data['permissions_per_session'] = get_permission_per_session();
        $data['listing'] = $l->leftjoin('user','user.id','listing.user')->where('user.id','!=', 0)->select('listing.listing_name', 'listing.created', 'user.fullname as user')->get();
        // $arr = get_defined_vars();
        // dd($arr);
        return view('admin::listing.index', $data);
    }

    public function create()
    {
        return view('admin::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function savelisting($id)
    {
        //
    }

    public function area( ListingArea $la )
    {
        $data['current_admin'] = current_admin_info();
        $data['permissions_per_session'] = get_permission_per_session();
        $data['area'] = $la->get();
// $arr = get_defined_vars();
//         dd($arr);
        return view('admin::listing.area.index', $data);
    }

    public function category( ListingCategory $lc )
    {
        $data['current_admin'] = current_admin_info();
        $data['permissions_per_session'] = get_permission_per_session();
        $data['category'] = $lc->get();
// $arr = get_defined_vars();
//         dd($arr);
        return view('admin::listing.category.index', $data);
    }

    public function tag( ListingTag $lt )
    {
        $data['current_admin'] = current_admin_info();
        $data['permissions_per_session'] = get_permission_per_session();
        $data['tag'] = $lt->get();
// $arr = get_defined_vars();
//         dd($arr);
        return view('admin::listing.tag.index', $data);
    }

}
