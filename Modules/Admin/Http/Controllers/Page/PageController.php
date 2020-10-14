<?php

namespace Modules\Admin\Http\Controllers\Page;

// use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Page;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Request;
use Session;
use Validator;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index( Page $p )
    {
        $data['current_admin'] = current_admin_info();
        $data['permissions_per_session'] = get_permission_per_session();
        
        $data['page']  =  $p->all();
        // $arr = get_defined_vars();
        // dd($arr);

        return view('admin::page.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function pageUpdate($id = null)
    {
        $params = [];

        if($id){
            $params['current_admin'] = current_admin_info();
            $params['permissions_per_session'] = get_permission_per_session();
            $object = Page::where('id', $id)->first();
            if(!$object)
                {
                    return redirect()->route('admin.page_list');
                }
            $params['title_form'] = "Update Page";
        }else{
            $params['current_admin'] = current_admin_info();
            $params['permissions_per_session'] = get_permission_per_session();
            $object = "";
            $params['title_form'] = "Add Page";
        }

        $params['page'] = $object;
// $arr = get_defined_vars();
//             dd($arr);
        return view('admin::page.update', $params);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function savePage($id = Null)
    {
        // $arr = get_defined_vars();
        // dd($arr);

        if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
          $data = Input::all();
          
          if($id == 0 ){
            $rules =  ['page_title'  => 'required|unique:page,title' , 'page_slug' => 'required'];
            $atributname = [
                'page_title.required' => 'The page title field is required.',
                'page_title.unique' => 'The page title can not be the same.',
                'page_slug.required' => 'The page slug field is required.',
            ];
          }else{
            $rules =  ['page_title'  => 'required' , 'page_slug' => 'required'];
            $atributname = [
                'page_title.required' => 'The page title field is required.',
                'page_slug.required' => 'The page slug field is required.',
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
                $p        =  new Page; 

                $p->title                = Input::get('page_title');
                $p->slug                 = Input::get('page_slug');
                $p->content              = Input::get('page_content');
                $p->seo_schema           = Input::get('page_schema');
                $p->seo_title            = Input::get('page_meta_title');
                $p->seo_description      = Input::get('page_meta_description');
                $p->seo_keywords         = Input::get('page_meta_keywords');
                $p->created              = date("y-m-d H:i:s", strtotime('now'));
                $p->save();

                Session::flash('success-message', "Success add page" );
                return redirect()->route('admin.page_list');

            }else{

                $data = array(
                  'title'               => Input::get('page_title'),
                  'slug'                => Input::get('page_slug'),
                  'content'             => Input::get('page_content'),
                  'seo_schema'          => Input::get('page_schema'),
                  'seo_title'           => Input::get('page_meta_title'),
                  'seo_description'     => Input::get('page_meta_description'),
                  'seo_keywords'        => Input::get('page_meta_keywords'),
                  'created'             => date("y-m-d H:i:s", strtotime('now'))
                );
                Page::where('id', $id)->update($data);

                Session::flash('success-message', "Success update page" );
                return redirect()->route('admin.page_list');

            }
          }
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
