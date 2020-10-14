@extends('admin::includes.default')
@section('title', 'Admin | Listing | Category')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Category Type</th>
                  <th>Created</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($category->count() > 0 )
                    @foreach($category as $p)
                    <tr>
                        <td>{{ $p->name }}</td>
                        @if($p->parent == 0)
                        <td>Parent Category</td>
                        @else
                        <td>Sub Category</td>
                        @endif
                        <td>{{ $p->created }}</td>
                        <td>
                            <p class="text-center">
                                <!-- <a href="#"><i class="fa fa-eye-slash"></i> </a> -->
                                <a href="#" class="edit-data color-black-blue" data-track_name="cat_list" data-id="{{ $p->id }}"><i class="fa fa-edit"></i> </a>
                                <a href="#" class="remove-selected-data-from-list color-black-blue" data-track_name="listing_cat_list" data-id="{{ $p->id }}"><i class="fa fa-trash-o"></i> </a>
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