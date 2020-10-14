@extends('admin::includes.default')
@section('title', 'Admin | Home')
@section('content')
<!-- Small boxes (Stat box) -->
	  <div class="row">
	    <div class="col-lg-3 col-xs-6">
	      <!-- small box -->
	      <div class="small-box bg-aqua">
	        <div class="inner">
	          <h3>{{ $post_count }}</h3>

	          <p>Post</p>
	        </div>
	        <div class="icon">
	          <i class="fa fa-list"></i>
	        </div>
	        <a href="{{ route('admin.post_list') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div>
	    <!-- ./col -->
	    <div class="col-lg-3 col-xs-6">
	      <!-- small box -->
	      <div class="small-box bg-yellow">
	        <div class="inner">
	          <h3>{{ $user_count }}</h3>

	          <p>User</p>
	        </div>
	        <div class="icon">
	          <i class="fa fa-user"></i>
	        </div>
	        <a href="{{ route('admin.user_list') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div>
	    <!-- ./col -->
	    <div class="col-lg-3 col-xs-6">
	      <!-- small box -->
	      <div class="small-box bg-red">
	        <div class="inner">
	          <h3>{{ $banner_count }}</h3>

	          <p>Banner</p>
	        </div>
	        <div class="icon">
	          <i class="ion ion-pie-graph"></i>
	        </div>
	        <a href="{{ route('admin.banner_list') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div>
	    <!-- ./col -->
	  </div>
	  <!-- /.row -->
@endsection