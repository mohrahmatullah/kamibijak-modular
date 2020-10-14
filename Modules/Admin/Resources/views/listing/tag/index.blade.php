@extends('admin::includes.default')
@section('title', 'Admin | Listing | Tag')
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
                  <th>Created</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($tag->count() > 0 )
                    @foreach($tag as $p)
                    <tr>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->created }}</td>
                        <td>
                            <p class="text-center">
                                <!-- <a href="#"><i class="fa fa-eye-slash"></i> </a> -->
                                <a class="color-black-blue" href="#" class="edit-data" data-track_name="cat_list" data-id="{{ $p->id }}"><i class="fa fa-edit"></i> </a>
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
@endsection