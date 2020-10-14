<?php 

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

function sufficient_permission_check() {
  $currentAdminData = current_admin_info();

  if(count($currentAdminData) > 0){
    $get_permission_data = permissions_details( $currentAdminData['user_id'] );
    
    foreach ($get_permission_data as $row) {
        /* Use Do While */
        do{
            if(Request::is('bakpau982/home')){
              return true;
            }
            if(Request::is('bakpau982/category') && $row['perms'] == 'read-post_category'){
              return true;
            }
            if(Request::is('bakpau982/user/list') && $row['perms'] == 'read-user'){
              return true;
            }
            if(Request::is('bakpau982/user/create') && $row['perms'] == 'create-user'){
              return true;
            }
            if(Request::is('bakpau982/user/update/*') && $row['perms'] == 'update-user'){
              return true;
            }
            if(Request::is('bakpau982/post/list') && $row['perms'] == 'read-post'){
              return true;
            }
            if(Request::is('bakpau982/post/create') && $row['perms'] == 'create-post'){
              return true;
            }
            if(Request::is('bakpau982/post/update/*') && $row['perms'] == 'update-post'){
              return true;
            }
            if(Request::is('bakpau982/post/category') && $row['perms'] == 'read-post_category'){
              return true;
            }
            if(Request::is('bakpau982/post/category/*') && $row['perms'] == 'create-post_category'){
              return true;
            }
            if(Request::is('bakpau982/post/category/*') && $row['perms'] == 'update-post_category'){
              return true;
            }
            if(Request::is('bakpau982/post/tag') && $row['perms'] == 'read-post_tag'){
              return true;
            }
            if(Request::is('bakpau982/post/tag/*') && $row['perms'] == 'create-post_tag'){
              return true;
            }
            if(Request::is('bakpau982/post/tag/*') && $row['perms'] == 'update-post_tag'){
              return true;
            }
            if(Request::is('bakpau982/listing/list') && $row['perms'] == 'read-listing'){
              return true;
            }
            if(Request::is('bakpau982/listing/cat') && $row['perms'] == 'read-listing_category'){
              return true;
            }
            if(Request::is('bakpau982/listing/area') && $row['perms'] == 'read-listing_area'){
              return true;
            }
            if(Request::is('bakpau982/listing/tag') && $row['perms'] == 'read-listing_tag'){
              return true;
            }
            if(Request::is('bakpau982/banner') && $row['perms'] == 'read-banner'){
              return true;
            }
            if(Request::is('bakpau982/banner/*') && $row['perms'] == 'create-banner'){
              return true;
            }
            if(Request::is('bakpau982/banner/*') && $row['perms'] == 'update-banner'){
              return true;
            }
            if(Request::is('bakpau982/page') && $row['perms'] == 'read-page'){
              return true;
            }
            if(Request::is('bakpau982/page/*') && $row['perms'] == 'create-page'){
              return true;
            }
            if(Request::is('bakpau982/page/*') && $row['perms'] == 'update-page'){
              return true;
            }
            if(Request::is('bakpau982/setting/param') && $row['perms'] == 'read-site_param'){
              return true;
            }
            if(Request::is('bakpau982/post/gallery') && $row['perms'] == 'read-gallery'){
              return true;
            }
            if(Request::is('bakpau982/post/gallery/*') && $row['perms'] == 'create-gallery'){
              return true;
            }
            if(Request::is('bakpau982/post/gallery/*') && $row['perms'] == 'update-gallery'){
              return true;
            }
            if(Request::is('bakpau982/post/gallery/media/{id}') && $row['perms'] == 'read-gallery_media'){
              return true;
            }
            if(Request::is('bakpau982/post/gallery/media/{id}/*') && $row['perms'] == 'create-gallery_media'){
              return true;
            }
            if(Request::is('bakpau982/post/gallery/media/{id}/*') && $row['perms'] == 'update-gallery_media'){
              return true;
            }

        }while (false);

        /* Or Use Switch Default */
        /*switch(1){
          default:
            if(Request::is('admin/home')){
              return true;
            }
            if(Request::is('admin/category') && $row['perms'] == 'read-post_category'){
              return true;
            }
        }*/ 
    }
    
  }
}

function current_admin_info(){
  $userData = array();
  
  if(Session::has('kamibijak_admin')){
    $getuserdata = DB::table('user')->find(Session::get('kamibijak_admin'));
    
    if(!empty($getuserdata)){
      $userData['user_name'] = $getuserdata->name;
      $userData['user_email'] = $getuserdata->email;
      $userData['user_status'] = $getuserdata->status;
      $userData['fullname'] = $getuserdata->fullname;
      $userData['avatar'] = $getuserdata->avatar;
      $userData['user_id'] = Session::get('kamibijak_admin');
    }
  }
  else{
    $userData['user_name'] = '';
    $userData['user_status'] = '';
    $userData['user_id'] = '';
  }
  
  return $userData;
}

function permissions_details( $user_id ){
  $permissions = array();
  $perm = DB::table('user_perms')->where('user', '=', $user_id)
  ->select('user_perms.*')        
  ->get();    
    foreach($perm as $rows)
    {      
        $data['user'] = $rows->user;
        $data['perms'] = $rows->perms;
      array_push($permissions, $data);
    }
  return $permissions;
}

function _group_by($array, $key) {
    $return = array();
    foreach($array as $val) {
        $return[$val[$key]][] = $val;
    }
    return $return;
}

function group_by_prop($list, $prop='parent'){
    $result = array();
    foreach($list as $li){
        if(!array_key_exists($li->$prop, $result))
            $result[$li->$prop] = array();
        $result[$li->$prop][] = $li;
    }
    
    return $result;
}

function group_per_column($list, $column=3){
    $result = array();
    
    $group = 0;
    foreach($list as $index => $item){
        if(!array_key_exists($group, $result))
            $result[$group] = array();
        $result[$group][$index] = $item;
        if(count($result[$group]) >= $column)
            $group++;
    }
    
    return $result;
}

function string_slug_format($str)
{
  if($str)
  {
    return Str::slug($str, '-');
  } 
}

function default_upload_sample_img_src(){
  return url('assets/admin/img/upload.png');
}

function default_upload_video_sample_img_src(){
  return url('assets/admin/img/upload-video.png');
}

function default_img_user(){
  return url('assets/admin/dist/img/icon-kamibijak.png');
}

function default_logo_kamibijak(){
  return url('assets/admin/dist/img/logo-kamibijak.png');
}

function get_image_url($img_path){
  if(!empty($img_path)){
    return url('http://asset.kamibijak.com/images/large/') . $img_path;
  }
  else{
    return '';
  } 
}

function get_permission_per_session(){
    $selected = array();
    $selected_userperm = DB::table('user_perms')->where('user', Session::get('kamibijak_admin'))->get();
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

function timeAgo($timestamp){
    $date_format = date("d M Y", strtotime($timestamp) );
    $datetime1=new DateTime("now");
    $datetime2=date_create($timestamp);
    $diff=date_diff($datetime1, $datetime2);
    $timemsg='';    
    // if($diff->y > 0){
    //     $timemsg = $diff->y .' year'. ($diff->y > 1?"'s":'');

    // }
    // else if($diff->m > 0){
    //  $timemsg = $diff->m . ' month'. ($diff->m > 1?"'s":'');
    // }
    // else if($diff->d > 0){
    //  $timemsg = $diff->d .' day'. ($diff->d > 1?"'s":'');
    // }
    if($diff->y > 0){
      $timemsg = $date_format;
    }
    else if($diff->m > 0){
     $timemsg = $date_format;
    }
    else if($diff->d > 0){
     $timemsg = $date_format;
    }
    else if($diff->h > 0){
     $timemsg = $diff->h .' hour'.($diff->h > 1 ? "'s":'');
    }
    else if($diff->i > 0){
     $timemsg = $diff->i .' minute'. ($diff->i > 1?"'s":'');
    }
    else if($diff->s > 0){
     $timemsg = $diff->s .' second'. ($diff->s > 1?"'s":'');
    }
    
    if($diff->y > 0){
    $timemsg = $timemsg;
    }
    elseif($diff->m > 0){
    $timemsg = $timemsg;
    }
    elseif($diff->d > 0){
    $timemsg = $timemsg;
    }
    else if($diff->h > 0){
      $timemsg = $timemsg.' ago';
    }
    else if($diff->i > 0){
      $timemsg = $timemsg.' ago';
    }
    else if($diff->s > 0){
      $timemsg = $timemsg.' ago';
    }
    // $arr = get_defined_vars();
    // dd($arr);
return $timemsg;
}

function get_thumnail_youtube(){
  return url('https://img.youtube.com/vi/Thumbnail/maxresdefault.jpg');
}

function highlight_word( $content, $word, $color ) {
    $replace = '<span style="background-color: ' . $color . ';">' . $word . '</span>'; // create replacement
    $content = str_replace( $word, $replace, $content ); // replace content
    return $content;
}

function highlight_words( $content, $words, $colors ) {
    $color_index = 0; // index of color (assuming it's an array)
    // loop through words
    foreach( $words as $word ) {
        $content = highlight_word( $content, ucwords($word), $colors[$color_index] ); // highlight word
        $color_index = ( $color_index + 1 ) % count( $colors ); // get next color index
        // $arr = get_defined_vars();
        //             dd($arr);
    }
    return $content;
}

function string_decode($str){
    $decode = html_entity_decode($str, ENT_QUOTES | ENT_IGNORE, "UTF-8");
    return $decode;
}

function crop_image($imgSrc) {

    //getting the image dimensions
    list($width, $height) = getimagesize($imgSrc);

    //saving the image into memory (for manipulation with GD Library)
    $myImage = imagecreatefromjpeg($imgSrc);

    // calculating the part of the image to use for thumbnail
    if ($width > $height) {
      $y = 0;
      $x = ($width - $height) / 2;
      $smallestSide = $height;
    } else {
      $x = 0;
      $y = ($height - $width) / 2;
      $smallestSide = $width;
    }

    // copying the part into thumbnail
    $thumbSize = 100;
    $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
    imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);

    //final output
    header('Content-type: image/jpeg');
    $return = imagejpeg($thumb);

    return $return;
}

function crop($image){
  $img = Image::make($image);
  $ratio = 16/9;
  if(intval($img->width()/$ratio > $img->height()))
  {
      $img->fit(intval($img->height() * $ratio),$img->height());
  } 
  else
  {
      $img->fit($img->width(), intval($img->width()/$ratio));
  }

  return $img;
}

function get_aspect_ratio($width, $height)
{
   $gcd = function($width, $height) use (&$gcd) {
       return ($width % $height) ? $gcd($height, $width % $height) : $height;
   };
   $g = $gcd($width, $height);
   return $width/$g . ':' . $height/$g;
}

function makeDirectory($path, $mode = 0777, $recursive = false, $force = false)
{
    if ($force)
    {
        return @mkdir($path, $mode, $recursive);
    }
    else
    {
        return mkdir($path, $mode, $recursive);
    }
}