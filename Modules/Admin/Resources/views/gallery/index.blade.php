@extends('admin::includes.default')
@section('title', 'Admin | Gallery')
@section('content')
@include('admin::pages_message.notify-msg-success')
<div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
        <h4>Gallery List</h4>
    </div>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
        <div class="pull-right">
          <a href="{{ route('admin.gallery_update', 0)}}" class="btn bg-navy btn-flat margin" type="button">Add New Cover</a>
        </div>  
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="tbl_gallery" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>cover</th>
                  <th>Name</th>
                  <th>Desciption</th>
                  <th>Created</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                @if($gallery->count() > 0 )
                    @php $a = 1; @endphp
                    @foreach($gallery as $g)
                    <tr>
                      <td>
                        <a data-fancybox="gallery{{ $a }}" href="{!! env('URL_ASSET') .'images/gallery/'. $g->cover !!}">
                          <img src="{{ env('URL_ASSET').'images/gallery/'.$g->cover }}" width="45" height="60">
                        </a>
                      </td>
                      <td> {{ $g->name }} </td>
                      <td> {{ $g->description }} </td>
                      <td> {{ $g->created }} </td>
                      <td>
                          <p class="text-center">
                              <a href="{{ route('admin.gallery_media', $g->id)}}" class="color-black-blue"><i class="fa fa-eye"></i> </a>
                              <a href="{{ route('admin.gallery_update', $g->id)}}" class="color-black-blue"><i class="fa fa-edit"></i> </a>
                              <a href="#" class="remove-selected-data-from-list color-black-blue" data-track_name="gallery_list" data-id="{{ $g->id }}"><i class="fa fa-trash-o"></i> </a>
                          </p>
                      </td>
                    </tr>
                    @php $a++; @endphp
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