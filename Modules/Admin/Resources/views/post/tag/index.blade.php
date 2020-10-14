@extends('admin::includes.default')
@section('title', 'Admin | Tag')
@section('content')
@include('admin::pages_message.notify-msg-success')
<div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
        <h4>Tag List</h4>
    </div>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
        <div class="pull-right">
          <!-- START ADD POP UP -->
          {{-- <a data-toggle="modal" data-target="#addDynamicTag" class="btn bg-navy btn-flat margin custom-event-tags" type="button">Add New Tag</a> --}}
          <!-- END ADD POP UP -->
          <a href="{{ route('admin.post_tag_update', 0)}}" class="btn bg-navy btn-flat margin" type="button">Add New Tag</a>
        </div>  
    </div>
    {{-- <div class="modal fade" id="addDynamicTag" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
      <div class="modal-dialog add-cat-dialog">
        <div class="ajax-overlay"></div>
        
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
            <br>
            <i class="icon-credit-card icon-7x"></i>
            <p class="no-margin top-title-tag"></p>
          </div>
          <div class="modal-body">
            <div class="custom-model-row">
              <div class="row">
                <div class="col-md-6">
                  <div class="custom-input-group">
                    <div class="custom-input-label"><label for="inputTagName">Name</label></div>
                    <div class="custom-input-element">
                      <input oninput="inputName()" type="text" placeholder="Name" id="inputTagName" name="inputTagName" class="form-control">
                      <p id="alertName" class="text-red"><i class="icon fa fa-ban"></i> Name can't be empty</p>
                    </div>
                  </div>
                  <div class="custom-input-group">
                    <div class="custom-input-label"><label for="inputTagSlug">Slug</label></div>
                    <div class="custom-input-element">
                      <input type="text" placeholder="Slug" id="inputTagSlug" name="inputTagSlug" class="form-control" readonly>
                      <p id="alertSlug" class="text-red"><i class="icon fa fa-ban"></i> Slug can't be empty</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="custom-input-group">
                    <div class="custom-input-label"><label for="inputTagGroup">Group</label></div>
                    <div class="custom-input-element"><input type="text" placeholder="Group" id="inputTagGroup" name="inputTagGroup" class="form-control">
                    </div>
                  </div>
                  <div class="custom-input-group">
                    <div class="custom-input-label"><label for="inputTagOfficial">Official</label></div>
                    <div class="custom-input-element">
                      <select name="tag_official" id="tag_official" class="form-control select2" style="width: 100%;">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="custom-input-group">
                <div class="custom-input-label"><label for="inputTagDescription">Description</label></div>
                <div class="custom-input-element">
                  <textarea class="form-control" name="inputTagDescription" id="inputTagDescription" placeholder="Description"></textarea>
                </div>
              </div>
              <div class="custom-input-group">
                <div class="custom-input-label"><label for="inputTagSchema">Schema</label></div>
                <div class="custom-input-element"><input type="text" placeholder="Schema" id="inputTagSchema" name="inputTagSchema" class="form-control"></div>
              </div>
              <div class="custom-input-group">
                <div class="custom-input-label"><label for="inputTagMetaTitle">Meta Title</label></div>
                <div class="custom-input-element"><input type="text" placeholder="Meta Title" id="inputTagMetaTitle" name="inputTagMetaTitle" class="form-control">
                </div>
              </div>              
              <div class="custom-input-group">
                <div class="custom-input-label"><label for="inputTagMetaDescription">Meta Description</label></div>
                <div class="custom-input-element">
                  <textarea class="form-control" name="inputTagMetaDescription" id="inputTagMetaDescription" placeholder="Meta Description"></textarea>
                </div>
              </div>
              <div class="custom-input-group">
                <div class="custom-input-label"><label for="inputTagMetaKeywords">Meta Keywords</label></div>
                <div class="custom-input-element"><input type="text" placeholder="Meta Keywords" id="inputTagMetaKeywords" name="inputTagMetaKeywords" class="form-control">
                </div>
              </div>
            </div>     
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default attachtopost create-tag">Create Tag</button>
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
              <table id="tagTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Created</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($pt->count() > 0 )
                    @foreach($pt as $p)
                    <tr>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->created }}</td>
                        <td>
                            <p class="text-center">
                                <!-- <a href="#"><i class="fa fa-eye-slash"></i> </a> -->
                                <!-- START EDIT POP UP -->
                                {{-- <a href="#" class="edit-data color-black-blue" data-track_name="tag_list" data-id="{{ $p->id }}"><i class="fa fa-edit"></i> </a> --}} 
                                <!-- END EDIT POP UP -->
                                <a href="{{ route('admin.post_tag_update', $p->id)}}" class="color-black-blue"><i class="fa fa-edit"></i> </a>
                                <a href="#" class="remove-selected-data-from-list color-black-blue" data-track_name="tag_list" data-id="{{ $p->id }}"><i class="fa fa-trash-o"></i> </a>
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