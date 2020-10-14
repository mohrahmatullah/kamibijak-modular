@extends('admin::includes.default')
@section('title', 'Admin | Setting')
@section('content')
<div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
        <h4>Site Params</h4>
    </div>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
        <div class="pull-right">
          <a data-toggle="modal" data-target="#addDynamicParam" class="btn bg-navy btn-flat margin custom-event-param" type="button">Create New</a>
        </div>  
    </div>
    <div class="modal fade" id="addDynamicParam" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
      <div class="modal-dialog add-cat-dialog">
        <div class="ajax-overlay"></div>
        
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
            <br>
            <i class="icon-credit-card icon-7x"></i>
            <p class="no-margin top-title-param"></p>
          </div>
          <div class="modal-body">
            <div class="custom-model-row">
              <div class="custom-input-group">
                <div class="custom-input-label"><label for="inputParamName">Name</label></div>
                <div class="custom-input-element">
                  <input type="text" placeholder="Name" id="inputParamName" name="inputParamName" class="form-control">
                  <p id="alertName" class="text-red"><i class="icon fa fa-ban"></i> Name can't be empty</p>
                </div>
              </div>
              <div class="custom-input-group">
                <div class="custom-input-label"><label for="inputParamValue">Value</label></div>
                <div class="custom-input-element"><input type="text" placeholder="Value" id="inputParamValue" name="inputParamValue" class="form-control">
                </div>
              </div>
            </div>     
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default attachtopost create-param">Create Site Param</button>
            <button type="button" class="btn btn-default attachtopost" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
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
                  <th>Name</th>
                  <th>Value</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($params->count() > 0 )
                    @foreach($params as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->value }}</td>
                        <td>
                          <p class="text-center">
                              <a href="#" class="edit-data color-black-blue" data-track_name="param_list" data-id="{{ $p->id }}"><i class="fa fa-edit"></i> </a>
                              <a href="#" class="remove-selected-data-from-list color-black-blue" data-track_name="param_list" data-id="{{ $p->id }}"><i class="fa fa-trash-o"></i> </a>
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