@extends('admin::includes.default')
@section('title', 'Admin | Post')
@section('content')
@include('admin::pages_message.notify-msg-success')
<div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
        <h4>Banner</h4>
    </div>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
        <div class="pull-right">
          <!-- START POP UP -->
          {{-- <a data-toggle="modal" data-target="#addDynamicBanner" class="btn bg-navy btn-flat margin custom-event-banner" type="button">Add New Banner</a> --}}
          <!-- END POP UP -->
          <a href="{{ route('admin.banner_update', 0)}}" class="btn bg-navy btn-flat margin" type="button">Add New Banner</a>
        </div>  
    </div>
    {{-- <div class="modal fade" id="addDynamicBanner" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
      <div class="modal-dialog add-cat-dialog" style="width: 70%">
        <div class="ajax-overlay"></div>
        
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
            <br>
            <i class="icon-credit-card icon-7x"></i>
            <p class="no-margin top-title-banner"></p>
          </div>
          <div class="modal-body">
            <div class="custom-model-row">
              <div class="row">
                <div class="col-md-6">
                  <div class="custom-input-group">
                    <div class="custom-input-label"><label for="name">Name</label></div>
                    <div class="custom-input-element">
                      <input type="text" placeholder="Name" id="inputBannerName" name="name" class="form-control">
                        <p id="alertName" class="text-red"><i class="icon fa fa-ban"></i> Name can't be empty</p>
                    </div>
                  </div>
                  <div class="custom-input-group">
                    <div class="custom-input-label"><label for="timestart">Time Start</label></div>
                    <div class="custom-input-element"><input type="text" placeholder="Time Start" id="inputBannerTimestart" name="timestart" class="form-control timestart">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="custom-input-group">
                    <div class="custom-input-label"><label for="placement">Placement</label></div>
                    <div class="custom-input-element">
                      <input type="text" placeholder="Placement" id="inputBannerPlacement" name="placement" class="form-control">
                      <p id="alertPlacement" class="text-red"><i class="icon fa fa-ban"></i> Placement can't be empty</p>
                    </div>
                  </div>
                  <div class="custom-input-group">
                    <div class="custom-input-label"><label for="expired">Expired</label></div>
                    <div class="custom-input-element">
                      <input type="text" placeholder="Expired" id="inputBannerExpired" name="expired" class="form-control expired">
                    </div>
                  </div>
                </div>
              </div>
              <div class="custom-input-group">
                <div class="custom-input-label"><label for="media">Media</label></div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="uploadform dropzone no-margin dz-clickable cms-user-mediabanner-picture-uploader" id="cms_mediabanner_picture_uploader" name="cms_mediabanner_picture_uploader">
                        <div class="dz-default dz-message">
                          <span>Drop your cover picture here</span>
                        </div>
                      </div>
                      <input type="hidden" name="mediabanner" id="hf_cms_mediabanner_picture">
                    </div>
                    <div class="col-md-6">
                      <div class="text-center">
                        <div class="img-div-default-mediabanner"><img src="{{ default_upload_sample_img_src() }}" class="user-image" alt="" style="width: 46%;"/></div>
                      </div>
                      <div class="mediabanner-picture text-center" style="display:none;">
                          <div class="img-div-mediabanner"><img src="" class="user-image" alt="" style="width: 46%;"/></div><br>
                          <div class="btn-div-mediabanner"><button type="button" class="btn btn-danger remove-cms-mediabanner-picture">Remove image</button></div>
                      </div>
                    </div>
                  </div>
              </div>

              <div class="custom-input-group">
                <div class="custom-input-label"><label for="video">Video</label></div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="uploadform dropzone no-margin dz-clickable cms-user-videobanner-picture-uploader" id="cms_videobanner_picture_uploader" name="cms_videobanner_picture_uploader">
                        <div class="dz-default dz-message">
                          <span>Drop your cover picture here</span>
                        </div>
                      </div>
                      <input type="hidden" name="videobanner" id="hf_cms_videobanner_picture">
                    </div>
                    <div class="col-md-6">
                      <div class="text-center">
                        <div class="img-div-default-videobanner"><img src="{{ default_upload_video_sample_img_src() }}" class="user-image" alt="" style="width: 46%;"/></div>
                      </div>
                      <div class="videobanner-picture text-center" style="display:none;">
                          <div class="img-div-videobanner"><video src="" type="video/mp4" style="width: 46%;" controls></video></div><br>
                          <div class="btn-div-videobanner"><button type="button" class="btn btn-danger remove-cms-videobanner-picture">Remove image</button></div>
                      </div>
                    </div>
                  </div>
              </div>

              <div class="custom-input-group">
                <div class="custom-input-label"><label for="link">Url Caption</label></div>
                <div class="custom-input-element"><input type="text" placeholder="Link" id="inputBannerLink" name="link" class="form-control"></div>
              </div>

              <div class="custom-input-group">
                <div class="custom-input-label"><label for="website">Caption</label></div>
                <div class="custom-input-element"><input type="text" placeholder="Website" id="inputBannerWebsite" name="website" class="form-control"></div>
              </div>

              <div class="custom-input-group">
                <div class="custom-input-label"><label for="code">Code</label></div>
                <div class="custom-input-element">
                  <textarea class="form-control" name="code" id="inputBannerCode" placeholder="Code"></textarea>
                </div>
              </div>
            </div>     
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default attachtopost create-banner"></button>
            <button type="button" class="btn btn-default attachtopost" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> --}}

</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="bannerTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Time Start</th>
                  <th>Expired</th>
                  <th>Created</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($banner->count() > 0 )
                    @foreach($banner as $b)
                    <tr>
                        <td>{{ $b->name }}</td>
                        <td>{{ $b->timestart }}</td>
                        <td>{{ $b->expired }}</td>
                        <td>{{ $b->created }}</td>
                        <td>
                            <p class="text-center">
                                <!-- <a href="#"><i class="fa fa-eye-slash"></i> </a> -->
                                {{-- <a href="#" class="edit-data color-black-blue" data-track_name="banner_list" data-id="{{ $b->id }}"><i class="fa fa-edit"></i> </a> --}}
                                <a href="{{ route('admin.banner_update', $b->id)}}" class="color-black-blue"><i class="fa fa-edit"></i> </a>
                                <a href="#" class="remove-selected-data-from-list color-black-blue" data-track_name="banner_list" data-id="{{ $b->id }}"><i class="fa fa-trash-o"></i> </a>
                            </p>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td>Data tidak ada</td>
                </tr>
                @endif              
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </div>    
</div>

<div class="eb-overlay"></div>
<div class="eb-overlay-loader"></div>

<input type="hidden" name="hf_from_model" id="hf_from_model" value="">
<input type="hidden" name="hf_update_id" id="hf_update_id" value="">
@endsection