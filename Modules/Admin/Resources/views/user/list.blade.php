@extends('admin::includes.default')
@section('title', 'Admin | User')
@section('content')

@include('admin::pages_message.notify-msg-success')

<!-- Main Content -->
<div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
        <h4>Users</h4>
    </div>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
        <div class="pull-right">
          <a href="{{ route('admin.user_create') }}" class="btn bg-navy btn-flat margin">Create New</a>
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
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($user->count() > 0 )
                    @foreach($user as $u)
                    <tr>
                        <td>{{ $u->fullname }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <p class="text-center">
                                <!-- <a href="#"><i class="fa fa-eye-slash"></i> </a> -->
                                <a class="color-black-blue" href="{{ route('admin.user_update', $u->id) }}"><i class="fa fa-edit"></i> </a>
                                <a href="#" class="remove-selected-data-from-list color-black-blue" data-track_name="user_list" data-id="{{ $u->id }}"><i class="fa fa-trash-o"></i> </a>
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
<!-- /Main Content -->
@endsection