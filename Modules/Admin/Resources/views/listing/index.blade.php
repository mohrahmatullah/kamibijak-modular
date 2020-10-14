@extends('admin::includes.default')
@section('title', 'Admin | Listing')
@section('content')
<div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
        <h4>Listing</h4>
    </div>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
        <div class="pull-right">
          <a href="" class="btn bg-navy btn-flat margin">Add New Listing</a>
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
                  <th>Title</th>
                  <th>User</th>
                  <th>Created</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($listing->count() > 0 )
                    @foreach($listing as $l)
                <tr>
                  <td>{{ $l->listing_name }}</td>
                  <td>{{ $l->user }}</td>
                  <td>{{ $l->created }}</td>
                  <td>
                    <p class="text-center">
                        <!-- <a href="#"><i class="fa fa-eye-slash"></i> </a> -->
                        <a class="color-black-blue" href="#"><i class="fa fa-edit"></i> </a>
                        <a href="#" class="remove-selected-data-from-list color-black-blue" data-track_name="listing_tag_list" data-id="{{ $l->id }}"><i class="fa fa-trash-o"></i> </a>
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
@endsection