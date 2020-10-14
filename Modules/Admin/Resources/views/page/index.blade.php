@extends('admin::includes.default')
@section('title', 'Admin | Page')
@section('content')
@include('admin::pages_message.notify-msg-success')
<div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
        <h4>Pages</h4>
    </div>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
        <div class="pull-right">
          <!-- START ADD POP UP -->
          {{-- <a data-toggle="modal" data-target="#addDynamicPage" class="btn bg-navy btn-flat margin custom-event-page" type="button">Create New</a> --}}
          <!-- END ADD POP UP -->

          <a href="{{ route('admin.page_update', 0)}}" class="btn bg-navy btn-flat margin custom-event-page" type="button">Create New</a>
        </div>  
    </div>
    <!-- POP UP -->
    {{-- <div class="modal fade" id="addDynamicPage" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
      <div class="modal-dialog add-cat-dialog">
        <div class="ajax-overlay"></div>
        
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
            <br>
            <i class="icon-credit-card icon-7x"></i>
            <p class="no-margin top-title-page"></p>
          </div>
          <div class="modal-body">
            <div class="custom-model-row">
              <div class="row">
                <div class="col-md-6">
                  <div class="custom-input-group">
                    <div class="custom-input-label"><label for="inputPageTitle">Title</label></div>
                    <div class="custom-input-element">
                      <input oninput="inputTitlePage()" type="text" placeholder="Title" id="inputPageTitle" name="inputPageTitle" class="form-control">
                      <p id="alertName" class="text-red"><i class="icon fa fa-ban"></i> Title can't be empty</p>
                    </div>
                  </div>                  
                </div>
                <div class="col-md-6">
                  <div class="custom-input-group">
                    <div class="custom-input-label"><label for="inputPageSlug">Slug</label></div>
                    <div class="custom-input-element">
                      <input type="text" placeholder="Slug" id="inputPageSlug" name="inputPageSlug" class="form-control" readonly>
                      <p id="alertSlug" class="text-red"><i class="icon fa fa-ban"></i> Slug can't be empty</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="custom-input-group">
                <div class="custom-input-label"><label for="inputPageContent">Content</label></div>
                <div class="custom-input-element">
                  <textarea class="form-control" name="inputPageContent" id="inputPageContent" placeholder="Content"></textarea>
                </div>
              </div>
              <div class="custom-input-group">
                <div class="custom-input-label"><label for="inputPageSchema">Schema</label></div>
                <div class="custom-input-element"><input type="text" placeholder="Schema" id="inputPageSchema" name="inputPageSchema" class="form-control"></div>
              </div>
              <div class="custom-input-group">
                <div class="custom-input-label"><label for="inputPageMetaTitle">Meta Title</label></div>
                <div class="custom-input-element"><input type="text" placeholder="Meta Title" id="inputPageMetaTitle" name="inputPageMetaTitle" class="form-control">
                </div>
              </div>              
              <div class="custom-input-group">
                <div class="custom-input-label"><label for="inputPageMetaDescription">Meta Description</label></div>
                <div class="custom-input-element">
                  <textarea class="form-control" name="inputPageMetaDescription" id="inputPageMetaDescription" placeholder="Meta Description"></textarea>
                </div>
              </div>
              <div class="custom-input-group">
                <div class="custom-input-label"><label for="inputPageMetaKeywords">Meta Keywords</label></div>
                <div class="custom-input-element"><input type="text" placeholder="Meta Keywords" id="inputPageMetaKeywords" name="inputPageMetaKeywords" class="form-control">
                </div>
              </div>
            </div>     
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default attachtopost create-page">Create Page</button>
            <button type="button" class="btn btn-default attachtopost" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> --}}
    <!-- POP UP -->
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($page->count() > 0 )
                    @foreach($page as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('admin.page_update', $p->id)}}">{{ $p->title }}</a></td>
                        <td>
                          <p class="text-center">
                              <!-- START EDIT POP UP -->
                              {{-- <a href="#" class="edit-data color-black-blue" data-track_name="page_list" data-id="{{ $p->id }}"><i class="fa fa-edit"></i> </a> --}}
                              <!-- END EDIT POP UP -->
                              <a href="{{ route('admin.page_update', $p->id)}}" class="color-black-blue"><i class="fa fa-edit"></i> </a>
                              <a href="#" class="remove-selected-data-from-list color-black-blue" data-track_name="page_list" data-id="{{ $p->id }}"><i class="fa fa-trash-o"></i> </a>
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