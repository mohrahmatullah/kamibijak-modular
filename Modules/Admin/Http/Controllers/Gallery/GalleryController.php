<?php

namespace Modules\Admin\Http\Controllers\Gallery;

// use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\User;
use Modules\Admin\Entities\Gallery;
use Modules\Admin\Entities\GalleryMedia;
use Modules\Admin\Entities\Microsite;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Request;
use Session;
use Validator;



class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Gallery $g)
    {
        $data['current_admin'] = current_admin_info();
        $data['permissions_per_session'] = get_permission_per_session();
        $data['gallery'] = $g->all();

        return view('admin::gallery.index', $data);
    }

    public function galleryUpdate($id = null, Gallery $g)
    {
        $params = [];

        if($id){
            $params['current_admin'] = current_admin_info();
            $params['permissions_per_session'] = get_permission_per_session();
            $object = Gallery::where('id', $id)->first();
            if(!$object)
            {
                return redirect()->route('admin.post_gallery');
            }
            $params['title_form'] = "Update Gallery";
        }else{
            $params['current_admin'] = current_admin_info();
            $params['permissions_per_session'] = get_permission_per_session();
            $object = "";
            $params['title_form'] = "Add Gallery";
        }

        $params['gallery'] = $object;

        return view('admin::gallery.update', $params);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function saveGallery($id = Null)
    {
        if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
          $data = Input::all();
          
          if($id == 0 ){
            $rules =  ['gallery_name'  => 'required|unique:gallery,name' , 'gallery_author' => 'required' , 'gallery_cover' => 'required'];
            $atributname = [
                'gallery_name.required' => 'The picture name field is required.',
                'gallery_name.unique' => 'The picture name can not be the same.',
                'gallery_author.required' => 'The picture author field is required.',
                'gallery_cover.required' => 'The picture cover field is required.',
            ];
          }else{
            $rules =  ['gallery_name'  => 'required' , 'gallery_author'  => 'required' , 'gallery_cover' => 'required'];
            $atributname = [
                'gallery_name.required' => 'The picture name field is required.',
                'gallery_author.required' => 'The picture author field is required.',
                'gallery_cover.required' => 'The picture cover field is required.',
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
                $g        =  new Gallery; 

                $g->name            = Input::get('gallery_name');
                $g->cover           = Input::get('gallery_cover');
                $g->description     = Input::get('gallery_description');
                $g->group           = Input::get('gallery_group');
                $g->author          = Input::get('gallery_author');
                $g->keywords        = Input::get('gallery_keywords');
                $g->user            = Session::get('kamibijak_admin');
                $g->created         = date("y-m-d H:i:s", strtotime('now'));
                $g->save();

                Session::flash('success-message', "Success add picture" );
                return redirect()->route('admin.post_gallery');

            }else{

                $data = array(
                  'name'           => Input::get('gallery_name'),
                  'cover'          => Input::get('gallery_cover'),
                  'description'    => Input::get('gallery_description'),
                  'group'          => Input::get('gallery_group'),
                  'author'         => Input::get('gallery_author'),
                  'keywords'       => Input::get('gallery_keywords'),
                  'user'           => Session::get('kamibijak_admin'),
                  'created'        => date("y-m-d H:i:s", strtotime('now'))
                );
                Gallery::where('id', $id)->update($data);

                Session::flash('success-message', "Success update picture" );
                return redirect()->route('admin.post_gallery');

            }
          }
        }
    }

    public function galleryMedia($id, Gallery $g, GalleryMedia $gm)
    {
        $data['current_admin'] = current_admin_info();
        $data['permissions_per_session'] = get_permission_per_session();
        $data['gm'] = GalleryMedia::where('gallery', $id)->get();
        $data['id'] = $id;
        $data['name_gallery'] = $g->where('id', $id)->first()->name;

        return view('admin::gallery.gallery_media.index', $data);
    }

    public function galleryMediaUpdate($gallery, $id = null, Gallery $g)
    {
        $params = [];
        $params['id'] = $id;

        if($id){
            $params['current_admin'] = current_admin_info();
            $params['permissions_per_session'] = get_permission_per_session();
            $object = GalleryMedia::where('id', $id)->first();
            if(!$object)
            {
                return redirect()->route('admin.gallery_media', $id);
            }
            $params['title_form'] = "Update Gallery Media";
        }else{
            $params['current_admin'] = current_admin_info();
            $params['permissions_per_session'] = get_permission_per_session();
            $object = "";
            $params['title_form'] = "Add Gallery Media";
        }
        $params['gallery_id'] = $gallery;
        $params['gallerymedia'] = $object;

        return view('admin::gallery.gallery_media.update', $params);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */

    // save
    public function saveGalleryMedia($gallery, $id = Null, Gallery $g, GalleryMedia $gm)
    {
        // $arr = get_defined_vars();
        // dd($arr);

        if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
          $data = Input::all();
          
          if($id == 0 ){
            $rules =  ['gm_title'  => 'required' , 'gm_media' => 'required'];
            $atributname = [
                'gm_title.required' => 'The picture title field is required.',
                'gm_media.required' => 'The picture media field is required.',
            ];
          }else{
            $rules =  ['gm_title'  => 'required' , 'gm_media' => 'required'];
            $atributname = [
                'gm_title.required' => 'The picture title field is required.',
                'gm_media.required' => 'The picture media field is required.',
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
                $gm        =  new GalleryMedia; 

                $gm->title         = Input::get('gm_title');
                $gm->media         = Input::get('gm_media');
                $gm->description   = Input::get('gm_description');
                $gm->gallery       = Input::get('gm_gallery');
                $gm->media_label   = Input::get('gm_media_label');
                $gm->index         = Input::get('gm_index');
                $gm->user          = Session::get('kamibijak_admin');
                $gm->created       = date("y-m-d H:i:s", strtotime('now'));
                $gm->save();

                Session::flash('success-message', "Success add picture" );
                return redirect()->route('admin.gallery_media', Input::get('gm_gallery'));

            }else{

                $data = array(
                  'title'           => Input::get('gm_title'),
                  'media'           => Input::get('gm_media'),
                  'description'     => Input::get('gm_description'),
                  'gallery'         => Input::get('gm_gallery'),
                  'media_label'     => Input::get('gm_media_label'),
                  'index'           => Input::get('gm_index'),
                  'user'            => Session::get('kamibijak_admin'),
                  'created'         => date("y-m-d H:i:s", strtotime('now'))
                );
                GalleryMedia::where('id', $id)->update($data);

                Session::flash('success-message', "Success update picture" );
                return redirect()->route('admin.gallery_media', Input::get('gm_gallery'));

            }
          }
        }

    }


}
