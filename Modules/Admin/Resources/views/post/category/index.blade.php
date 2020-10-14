@extends('admin::includes.default')
@section('title', 'Admin | Category')
@section('content')
@include('admin::pages_message.notify-msg-success')
<div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
        <h4>Category List</h4>
    </div>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
        <div class="pull-right">
          <!-- START ADD POP UP -->
          {{-- <a data-toggle="modal" data-target="#addDynamicCategories" class="btn bg-navy btn-flat margin custom-event" type="button">Add New Category</a> --}}
          <!-- END ADD POP UP -->
          <a href="{{ route('admin.post_category_update', 0)}}" class="btn bg-navy btn-flat margin" type="button">Add New Category</a>
        </div>  
    </div>
    {{--
    <div class="modal fade" id="addDynamicCategories" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
      <div class="modal-dialog add-cat-dialog" style="width: 95%;">
        <div class="ajax-overlay"></div>
        
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
            <br>
            <i class="icon-credit-card icon-7x"></i>
            <p class="no-margin top-title"></p>
          </div>
          <div class="modal-body">
            <div class="custom-model-row row">
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-6">
                    <div class="custom-input-group">
                      <div class="custom-input-label"><label for="name">Name</label></div>
                      <div class="custom-input-element">
                        <input oninput="inputNameCat()" type="text" placeholder="Category Name" id="name" name="name" class="form-control">
                        <p id="alertName" class="text-red"><i class="icon fa fa-ban"></i> Name can't be empty</p>
                      </div>
                    </div>
                    <div class="custom-input-group">
                      <div class="custom-input-label"><label for="slug">Slug</label></div>
                      <div class="custom-input-element">
                        <input type="text" placeholder="Slug" id="slug" name="slug" class="form-control" readonly>
                        <p id="alertSlug" class="text-red"><i class="icon fa fa-ban"></i> Slug can't be empty</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-input-group">
                      <div class="form-group">
                        <label for="inputCatParent">Parent</label>
                        <select name="cat_parent" id="cat_parent" class="form-control select2" style="width: 100%;">
                          <option value="0">None</option>
                          @if($pc->count() > 0)
                            @foreach($pc as $p)
                              <option value="{{ $p->id }}"> {!! $p->name !!} </option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                    </div>
                    <div class="custom-input-group">
                      <div class="custom-input-label"><label for="color">Color</label></div>
                      <div class="input-group my-colorpicker2">
                        <input type="text" name="color" id="color" class="form-control">
                        <div class="input-group-addon">
                          <i></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="custom-input-group">
                  <div class="custom-input-label"><label for="description">Description</label></div>
                  <div class="custom-input-element">
                    <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                  </div>
                </div>

                <div class="custom-input-group">
                  <div class="custom-input-label"><label for="inputCatThumbnail">Cover</label></div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="uploadform dropzone no-margin dz-clickable cms-user-covercat-picture-uploader" id="cms_covercat_picture_uploader" name="cms_covercat_picture_uploader">
                          <div class="dz-default dz-message">
                            <span>Drop your cover picture here</span>
                          </div>
                        </div>
                        <input type="hidden" name="covercat" id="hf_cms_covercat_picture" value="">
                      </div>
                      <div class="col-md-6">
                        <div class="text-center">
                          <div class="img-div-default"><img src="{{ default_upload_sample_img_src() }}" class="user-image" alt="" style="width: 46%;"/></div>
                        </div>
                        <div class="covercat-picture text-center" style="display:none;">
                            <div class="img-div"><img src="" class="user-image" alt="" style="width: 46%;" /></div><br>
                            <div class="btn-div"><button type="button" class="btn btn-danger remove-cms-covercat-picture">Remove image</button></div>
                        </div>
                        <!-- <div class="no-covercat-picture text-center">
                            <div class="img-div"><img src="{{ default_upload_sample_img_src() }}" class="user-image" alt=""/></div><br>
                            <div class="btn-div"><button data-toggle="modal" data-target="#cmsUploadCovercatPicture" type="button" class="btn btn-default btn-flat covercat-picture-uploader">Upload image</button></div>
                        </div> -->
                      </div>
                    </div>
                </div>

                <div class="custom-input-group">
                  <div class="custom-input-label"><label for="inputCatThumbnail">Avatar</label></div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="uploadform dropzone no-margin dz-clickable cms-user-avatarcat-picture-uploader" id="cms_avatarcat_picture_uploader" name="cms_avatarcat_picture_uploader">
                          <div class="dz-default dz-message">
                            <span>Drop your cover picture here</span>
                          </div>
                        </div>
                        <input type="hidden" name="avatarcat" id="hf_cms_avatarcat_picture" value="">
                      </div>
                      <div class="col-md-6">
                        <div class="text-center">
                          <div class="img-div-default-avatarcat"><img src="{{ default_upload_sample_img_src() }}" class="user-image" alt="" style="width: 46%;"/></div>
                        </div>
                        <div class="avatarcat-picture text-center" style="display:none;">
                            <div class="img-div-avatarcat"><img src="" class="user-image" alt="" style="width: 46%;"/></div><br>
                            <div class="btn-div-avatarcat"><button type="button" class="btn btn-danger remove-cms-avatarcat-picture">Remove image</button></div>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="custom-input-group">
                  <div class="custom-input-label"><label for="inputCatThumbnail">Icon</label></div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="uploadform dropzone no-margin dz-clickable cms-user-iconcat-picture-uploader" id="cms_iconcat_picture_uploader" name="cms_iconcat_picture_uploader">
                          <div class="dz-default dz-message">
                            <span>Drop your cover picture here</span>
                          </div>
                        </div>
                        <input type="hidden" name="iconcat" id="hf_cms_iconcat_picture" value="">
                      </div>
                      <div class="col-md-6">
                        <div class="text-center">
                          <div class="img-div-default-iconcat"><img src="{{ default_upload_sample_img_src() }}" class="user-image" alt="" style="width: 46%;"/></div>
                        </div>
                        <div class="iconcat-picture text-center" style="display:none;">
                            <div class="img-div-iconcat"><img src="" class="user-image" alt="" style="width: 46%;"/></div><br>
                            <div class="btn-div-iconcat"><button type="button" class="btn btn-danger remove-cms-iconcat-picture">Remove image</button></div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="custom-input-group">
                  <div class="custom-input-label"><label for="schema">Schema</label></div>
                  <div class="custom-input-element">
                    <textarea class="form-control" name="schema" id="schema" placeholder="Schema"></textarea>
                  </div>
                </div>

                <div class="custom-input-group">
                  <div class="custom-input-label"><label for="metatitle">Meta Title</label></div>
                  <div class="custom-input-element">
                    <textarea class="form-control" name="metatitle" id="metatitle" placeholder="Meta Title"></textarea>
                  </div>
                </div>

                <div class="custom-input-group">
                  <div class="custom-input-label"><label for="metadescription">Meta Description</label></div>
                  <div class="custom-input-element">
                    <textarea class="form-control" name="metadescription" id="metadescription" placeholder="Meta Description"></textarea>
                  </div>
                </div>

                <div class="custom-input-group">
                  <div class="custom-input-label"><label for="metakeywords">Meta Keywords</label></div>
                  <div class="custom-input-element">
                    <textarea class="form-control" name="metakeywords" id="metakeywords" placeholder="Meta Keywords"></textarea>
                  </div>
                </div>
              </div>

            </div>     
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default attachtopost create-cat">Create Category</button>
            <button type="button" class="btn btn-default attachtopost" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    --}}
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="tbl_category" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Category Type</th>
                  <th>Total Post(s)</th>
                  <th>Sequence</th>
                  <th>Created</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($pc->count() > 0 )
                    @foreach($pc as $p)

                    <?php
                    $pcc = \Modules\Admin\Entities\PostCategoryChain::where('post_category', $p->id);
                    ?>

                    <tr>
                        <td>                          
                          <span>{{ $p->name }}</span>
                          @if($p->new == 1)
                          <span class="pull-right-container">
                            <small class="label pull-right bg-green">New</small>
                          </span>
                          @endif
                          @if($p->favorite == 1)
                          <span class="pull-right-container">
                            <small class="label pull-right bg-red">Fav</small>
                          </span>
                          @endif
                        </td>
                        @if($p->parent == 0)
                        <td>Parent Category</td>
                        @else
                        <td>Sub Category</td>
                        @endif
                        <td>
                          <a href="{{ env('URL_MIMIN') . 'post/list?ct=' .  $p->id }}">{{ $pcc->count() }}</a>
                        </td>
                        <td>{{ $p->section }}</td>
                        <td>{{ $p->created }}</td>
                        <td>
                            <p class="text-center">
                                <!-- <a href="#"><i class="fa fa-eye-slash"></i> </a> -->
                                {{-- <a href="#" class="edit-data color-black-blue" data-track_name="cat_list" data-id="{{ $p->id }}"><i class="fa fa-edit"></i> </a> --}}
                                <a href="{{ route('admin.post_category_update', $p->id)}}" class="color-black-blue"><i class="fa fa-edit"></i> </a>
                                <a href="#" class="remove-selected-data-from-list color-black-blue" data-track_name="cat_list" data-id="{{ $p->id }}"><i class="fa fa-trash-o"></i> </a>
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

<input type="hidden" name="hf_cat_post_for" id="hf_cat_post_for" value="product_cat">
@endsection