@extends('admin::includes.default')
@section('title', 'Admin | User | Update')
@section('content')

@include('admin::pages_message.form-submit')

<!-- Main Content -->
<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
  
  <div class="box box-warning">
    <div class="box-header">
      <h3 class="box-title">Update User &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-xs" href="{{ route('admin.user_list') }}">User List</a></h3>
      <div class="box-tools pull-right">
        <button class="btn bg-navy btn-flat" type="submit">Save</button>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-text-width"></i>
                  <h3 class="box-title">Username</h3>
                </div>
                <div class="box-body">
                  <input type="text" value="{{ $user->name }}" placeholder="Username" class="form-control" id="user_name" name="name">
                </div>
              </div>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-text-width"></i>
                  <h3 class="box-title">Fullname</h3>
                </div>
                <div class="box-body">
                  <input type="text" value="{{ $user->fullname }}" placeholder="Fullname" class="form-control" id="user_fullname" name="fullname">
                </div>
              </div>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-text-width"></i>
                  <h3 class="box-title">Email</h3>
                </div>
                <div class="box-body">
                  <input type="text" value="{{ $user->email }}" placeholder="Email" class="form-control" id="user_email" name="email">
                </div>
              </div> 
              <div class="box box-solid">
                <div class="box-body">
                  <div class="form-group mx-4">
                        <label>
                          <input type="checkbox" name="iscontributor" class="flat-red" value="1" @if($user->contributor == 1) checked @endif>
                          Is Contributor
                        </label>
                    </div>
                </div>
              </div>  
            </div>
            <div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-text-width"></i>
                  <h3 class="box-title">Password</h3>
                </div>
                <div class="box-body">
                  <input type="password" value="" placeholder="Password" class="form-control" name="password">
                </div>
              </div>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-text-width"></i>
                  <h3 class="box-title">Website</h3>
                </div>
                <div class="box-body">
                  <input type="text" value="{{ $user->website }}" placeholder="Website" class="form-control" id="user_website" name="website">
                </div>
              </div>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-text-width"></i>
                  <h3 class="box-title">Status</h3>
                </div>
                <div class="box-body">
                  <select name="status" class="form-control select2" style="width: 100%;">
                    <option value="1" @if($user->status == 1) selected @endif>Banned</option>
                    <option value="2" @if($user->status == 2) selected @endif>Unverified</option>
                    <option value="3" @if($user->status == 3) selected @endif>Verified</option>
                    <option value="4" @if($user->status == 4) selected @endif>Official</option>
                  </select>
                </div>
              </div>
            </div>
        </div>
        @if(in_array('update-user_permission', $permissions_per_session))      
        <div class="box box-warning">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>
              <h3 class="box-title">Permision</h3>
            </div>
            <div class="box-body">
              <div class="row">
                  <div class="col-md-12 text-right">
                      <div class="btn-group btn-group-xs" role="group">
                          <button type="button" class="btn btn-default" onclick="selectAll()" title="Select All"><i class="glyphicon glyphicon-check"></i> All</button>
                          <button type="button" class="btn btn-default" onclick="unselectAll()" title="Select None"><i class="glyphicon glyphicon-unchecked"></i> None</button>
                      </div>
                      <div class="btn-group btn-group-xs" role="group">
                          @php
                              $groups = [];
                              foreach($permissions as $perms){
                                  foreach($perms as $perm){
                                      $workers = $perm->worker;
                                      if(!$workers)
                                          continue;
                                      $workers = explode(' ', $workers);
                                      foreach($workers as $worker){
                                          if(!in_array($worker, $groups))
                                              $groups[] = $worker;
                                      }
                                  }
                              }
                              asort($groups);
                              foreach($groups as $group)
                                  echo '<button type="button" onclick="selectByClass(\'' . $group . '\')" class="btn btn-default" title="Select All ' . $group . '">' . $group . '</button>';
                          @endphp
                      </div>
                  </div>
              </div>
              @foreach(group_per_column($permissions, 3) as $index => $perms)
              <div class="row">
                  @foreach($perms as $group => $perm)
                  <div class="col-md-4">
                      <h4>
                          <div class="btn-group btn-group-xs" role="group">
                              <button class="btn btn-default btn-xs" type="button" onclick="selectParentSub(this)" title="Select All"><i class="glyphicon glyphicon-check"></i></button>
                              <button class="btn btn-default btn-xs" type="button" onclick="unselectParentSub(this)" title="Select None"><i class="glyphicon glyphicon-unchecked"></i></button>
                          </div>
                          {{ $group }}
                      </h4>
                      @foreach($perm as $per)
                          @php
                              $cls = '';
                              if($per->worker){
                                  $cls = explode(' ', $per->worker);
                                  $cls = array_map(function($e){ return 'prm-' . $e; }, $cls);
                                  $cls = ' ' . implode(' ', $cls);
                              }
                          @endphp
                      <div class="checkbox">
                        <label for="perm-{{ $per->name }}" title="{{ $per->description }}">
                          <input type="checkbox" class="prm-All{{ $cls }}" id="perm-{{ $per->name }}" name="perms[{{ $per->name }}]" value="{{ $per->name }}" @if(in_array($per->name, $selected_userperm)) checked @endif>
                          {{ $per->label }}
                        </label>
                      </div>
                      @endforeach
                  </div>
                  @endforeach
              </div>
              @endforeach 
            </div>
        </div>
        @endif
    </div>
    
    <div class="col-md-4">
      <div class="box box-warning">
            <div class="box-body">
                  <div class="form-group mx-4">
                    <label for="user_avatar">Avatar</label>
                       @if(!empty($user->avatar))
                       <div class="useravatar-picture text-center">
                          <div class="img-div"><img src="{{ get_image_url($user->avatar) }}" class="user-image" alt="" style="width: 100%;"/></div><br>
                          <div class="btn-div"><button type="button" class="btn btn-danger remove-cms-useravatar-picture">Remove image</button></div>
                       </div>
                       <div class="no-useravatar-picture text-center" style="display:none;">
                          <div class="img-div"><img src="{{ default_upload_sample_img_src() }}" class="user-image" alt=""/></div><br>
                          <div class="btn-div"><button data-toggle="modal" data-target="#cmsUploadUseravatarPicture" type="button" class="btn btn-default btn-flat useravatar-picture-uploader">Upload image</button></div>
                       </div>
                       @else
                       <div class="useravatar-picture text-center" style="display:none;">
                          <div class="img-div"><img src="" class="user-image" alt="" style="width: 100%;"/></div><br>
                          <div class="btn-div"><button type="button" class="btn btn-danger remove-cms-useravatar-picture">Remove image</button></div>
                       </div>
                       <div class="no-useravatar-picture text-center">
                          <div class="img-div"><img src="{{ default_upload_sample_img_src() }}" class="user-image" alt=""/></div><br>
                          <div class="btn-div"><button data-toggle="modal" data-target="#cmsUploadUseravatarPicture" type="button" class="btn btn-default btn-flat useravatar-picture-uploader">Upload image</button></div>
                       </div>
                       @endif
                       <div class="modal fade" id="cmsUploadUseravatarPicture" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
                                <br>
                                <i class="icon-credit-card icon-7x"></i>
                                <p class="no-margin">You can upload 1 image</p>
                              </div>
                              <div class="modal-body">             
                                <div class="uploadform dropzone no-margin dz-clickable cms-user-useravatar-picture-uploader" id="cms_useravatar_picture_uploader" name="cms_useravatar_picture_uploader">
                                  <div class="dz-default dz-message">
                                    <span>Drop your cover picture here</span>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default attachtopost" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                       </div> 
                       <input type="hidden" name="user_avatar" id="hf_cms_useravatar_picture" value="{{ $user->avatar }}">
                  </div>

                  <div class="form-group mx-4">
                    <label for="post_meta_title">Background</label> 
                       @if($user->background)
                       <div class="backgrounduser-picture text-center">
                          <div class="img-div"><img src="{{ get_image_url($user->background) }}" class="user-image" alt="" style="width: 100%;"/></div><br>
                          <div class="btn-div"><button type="button" class="btn btn-danger remove-cms-backgrounduser-picture">Remove image</button></div>
                       </div>
                       <div class="no-backgrounduser-picture text-center"  style="display:none;">
                          <div class="img-div"><img src="{{ default_upload_sample_img_src() }}" class="user-image" alt=""/></div><br>
                          <div class="btn-div"><button data-toggle="modal" data-target="#cmsUploadBackgrounduserPicture" type="button" class="btn btn-default btn-flat backgrounduser-picture-uploader">Upload image</button></div>
                       </div>
                       @else               
                       <div class="backgrounduser-picture text-center" style="display:none;">
                          <div class="img-div"><img src="" class="user-image" alt="" style="width: 100%;"/></div><br>
                          <div class="btn-div"><button type="button" class="btn btn-danger remove-cms-backgrounduser-picture">Remove image</button></div>
                       </div>
                       <div class="no-backgrounduser-picture text-center">
                          <div class="img-div"><img src="{{ default_upload_sample_img_src() }}" class="user-image" alt=""/></div><br>
                          <div class="btn-div"><button data-toggle="modal" data-target="#cmsUploadBackgrounduserPicture" type="button" class="btn btn-default btn-flat backgrounduser-picture-uploader">Upload image</button></div>
                       </div>
                       @endif
                       <div class="modal fade" id="cmsUploadBackgrounduserPicture" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
                                <br>
                                <i class="icon-credit-card icon-7x"></i>
                                <p class="no-margin">You can upload 1 image</p>
                              </div>
                              <div class="modal-body">             
                                <div class="uploadform dropzone no-margin dz-clickable cms-user-backgrounduser-picture-uploader" id="cms_backgrounduser_picture_uploader" name="cms_backgrounduser_picture_uploader">
                                  <div class="dz-default dz-message">
                                    <span>Drop your cover picture here</span>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default attachtopost" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                       </div> 
                       <input type="hidden" name="user_background" id="hf_cms_backgrounduser_picture" value="{{ $user->background }}">
                  </div>

                  <div class="form-group mx-4">
                    <label for="post_meta_description">About</label>
                      <textarea name="about" placeholder="About" class="form-control">{{ $user->about }}</textarea>
                  </div>
            </div>
      </div>
      
      <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Social Account</h3>
            </div>
            <div class="box-body">
                    <div class="form-group mx-4">
                      <label for="post_score"><i class="fa fa-facebook-square"></i> Facebook</label>
                        <input type="text" value="{{ $user->social_facebook }}" placeholder="Facebook" name="facebook" class="form-control">
                    </div>

                    <div class="form-group mx-4">
                      <label for="post_review_pros"><i class="fa fa-instagram"></i> Instagram</label>
                      <input type="text" value="{{ $user->social_instagram }}" placeholder="Score" name="instagram" class="form-control">
                    </div>

                    <div class="form-group mx-4">
                      <label for="post_review_cons"><i class="fa fa-linkedin"></i> Linkendln</label>
                      <input type="text" value="{{ $user->social_linkedin }}" placeholder="Linkendln" name="linkedin" class="form-control">
                    </div>

                    <div class="form-group mx-4">
                      <label for="post_summary"><i class="fa fa-pinterest-square"></i> Pinterest</label>
                      <input type="text" value="{{ $user->social_pinterest }}" placeholder="Pinterest" name="pinterest" class="form-control">
                    </div>

                    <div class="form-group mx-4">
                      <label for="post_summary"><i class="fa fa-google-plus-square"></i> Google+</label>
                      <input type="text" value="{{ $user->social_plus }}" placeholder="Google+" name="google" class="form-control">
                    </div>

                    <div class="form-group mx-4">
                      <label for="post_summary"><i class="fa  fa-twitter-square"></i> Twitter</label>
                      <input type="text" value="{{ $user->social_twitter }}" placeholder="Twitter" name="twitter" class="form-control">
                    </div>

                    <div class="form-group mx-4">
                      <label for="post_summary"><i class="fa fa-youtube-square"></i> Youtube</label>
                      <input type="text" value="{{ $user->social_youtube }}" placeholder="Youtube" name="youtube" class="form-control">
                    </div>
            </div>
      </div>

    </div>
      
  </div>
    <input type="hidden" name="hf_user_type" id="hf_user_type" value="update_user">
</form>
<!-- /Main Content -->
@endsection