@extends('admin::includes.default')
@section('title', 'Admin | Post')
@section('content')

@include('admin::pages_message.notify-msg-success')

<div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
        <h4>Post List</h4>
    </div>
    @if(in_array('create-post', $permissions_per_session))
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
        <div class="pull-right">
          <a href="{{ route('admin.post_create') }}" class="btn bg-navy btn-flat margin">Add New Post</a>
        </div>  
    </div>
    @endif
</div>
<div class="row">
    <div class="col-xs-12">
      <form action="{{ route('admin.post_list') }}" method="GET" autocomplete="off">
        <div class="row">
          {{-- <div class="form-group col-xs-4 col-sm-4 col-md-3 col-lg-3">
            <label for="qfilter">Find Posts</label>
            <input type="text" name="q" class="form-control" placeholder="Enter post title to search" value="{{ $qfilter }}" />
          </div> --}}

          <div class="form-group col-xs-4 col-sm-4 col-md-3 col-lg-3">
            <label for="sd">Start Date</label>
            <div id="start_date" class="input-group date date-picker">
              <input type="text" name="sd" class="form-control" title="Start Date" placeholder="Start Date" value="{{ isset($result['sd']) ? $result['sd'] : '' }}">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
              </span>
            </div>
          </div>

          <div class="form-group col-xs-4 col-sm-4 col-md-3 col-lg-3">
            <label for="ed">End Date</label>
            <div id="end_date" class="input-group date date-picker">
              <input type="text" name="ed" class="form-control" title="End Date" placeholder="End Date" value="{{ isset($result['ed']) ? $result['ed'] : '' }}">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
              </span>
            </div>
          </div>

          <!-- start featured -->
          {{-- <div class="form-group col-xs-4 col-sm-4 col-md-3 col-lg-3">
            <label for="ft">Featured</label>
            <div id="date" class="input-group ">
              <select class="selectpicker featuredSelect" name="ft" data-live-search="false">
                <option data-tokens="all" value="all" @if(isset($result['ft']) && $result['ft'] == 'all') selected='true' @endif>Semua</option>
                <option data-tokens="1" value="1" @if(isset($result['ft']) && $result['ft'] == 1) selected='true' @endif>Ya</option>
                <option data-tokens="0" value="0" @if(isset($result['ft']) && $result['ft'] == 0) selected='true' @endif>Tidak</option>
              </select>
            </div>

          </div> --}}
        </div>
        <div class="row">

          <div class="form-group col-xs-4 col-sm-4 col-md-3 col-lg-3">
            <label for="ct">Kanal</label>
            <div id="date" class="input-group ">
              <select class="selectpicker categorySelect" name="ct" data-live-search="false">
                <option data-tokens="all" value="all">Semua</option>
                @foreach($categories as $cat)
                  @php
                    $sel = '';
                    if(isset($result['ct']) && $cat->id == $result['ct'])
                      $sel = "selected='true'";
                  @endphp
                  <option data-tokens="{{ $cat->id }}" value="{{ $cat->id }}" {{ $sel }}>{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>

          </div>

          <div class="form-group col-xs-4 col-sm-4 col-md-3 col-lg-3">
            <label for="sts">Status</label>
            <div id="date" class="input-group ">
              <select class="selectpicker statusSelect" name="sts" data-live-search="false">
                <option data-tokens="all" value="all" @if(isset($result['sts']) && $result['sts'] == 'all') selected='true' @endif>Semua</option>
                <option data-tokens="1" value="1" @if(isset($result['sts']) && $result['sts'] == '1') selected='true' @endif>Draft</option>
                <option data-tokens="2" value="2" @if(isset($result['sts']) && $result['sts'] == '2') selected='true' @endif>Editor</option>
                <option data-tokens="3" value="3" @if(isset($result['sts']) && $result['sts'] == '3') selected='true' @endif>Schedule</option>
                <option data-tokens="4" value="4" @if(isset($result['sts']) && $result['sts'] == '4') selected='true' @endif>Published</option>
              </select>
            </div>

          </div>

          <div class="form-group col-xs-4 col-sm-4 col-md-3 col-lg-3">
            <label for="pub">Publisher</label>
            <div id="date" class="input-group ">
              <select class="selectpicker publisherSelect" name="pub" data-live-search="true">
                <option data-tokens="all" value="all">Semua</option>
                @foreach($publishers as $pb)
                  @php
                    $sel = '';
                    if(isset($result['pub']) && $pb->id == $result['pub'])
                      $sel = "selected='true'";
                  @endphp
                  <option data-tokens="{{ $pb->id }}" value="{{ $pb->id }}" {{ $sel }}>{{ $pb->fullname }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <!-- start button -->
          <div class="form-group col-xs-4 col-sm-4 col-md-3 col-lg-3">
            <label for="sbt">&nbsp;</label>
            <div class="input-group-btn">
              <button class="btn btn-primary" name="sbt" type="submit">Filter</button>
            </div>
            
          </div>
        </div>
      </form>

      {{--<div class="box">
        {{ var_dump($result) }}
      </div> --}}

      <strong>Total Posts: {{ $post->count() }}</strong> 
    </div>
    <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->            
          <div class="box-body table-responsive">
            <table id="postTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th width="25%">Title</th>
                <th>Publisher</th>
                <th>Kanal</th>
                <th>Status</th>
                {{--<th>Tag</th>--}}
                <th>Published</th>
                <th>Featured</th>
                <th style="display: none;">Editor Pick</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @if($post->count() > 0 )
                  @foreach($post as $p)
                      @php
                        $fullname = '';
                        if(isset($p->publisher)){
                          $fullname = \Modules\Admin\Entities\User::find($p->publisher)['fullname'];
                          //$fullname = DB::table('user')->where('id', $p->publisher)->first()->fullname;
                        }
                        $pc = \Modules\Admin\Entities\PostCategory::where('id', $p->post_category)->first();
                      @endphp
              <tr>
                <td>
                  <a href="{{ route('admin.post_update', $p->id) }}">{{ $p->title }}</a>
                </td>
                <td>{{ $fullname }}</td>
                <td>{{ $pc->name }}</td>
                @if($p->status == 1)
                <td>Draft</td>
                @elseif($p->status == 2)
                <td>Editor</td>
                @elseif($p->status == 3)
                <td>Schedule</td>
                @else
                <td>Published</td>
                @endif
                {{--<td></td>--}}
                <td>{{ $p->published }}</td>
                <td>
                  @if($p->featured == 1)   
                  <p class="text-center">                     
                    <a href="#" class="change-selected-data-from-list color-black-blue" data-track_name="featured_list_no" data-id="{{ $p->id }}">
                      <i class="fa fa-check-square"></i>
                    </a>
                  </p>
                  @else
                  <p class="text-center">
                    <a href="#" class="change-selected-data-from-list color-black-blue" data-track_name="featured_list_yes" data-id="{{ $p->id }}">
                      <i class="fa fa-square-o"></i>
                    </a>
                  </p>
                  @endif
                </td>
                <td style="display: none;">
                  @if($p->editor_pick == 1)   
                  <p class="text-center">                     
                    <a href="#" class="change-selected-data-from-list color-black-blue" data-track_name="editor_pick_list_no" data-id="{{ $p->id }}">
                      <i class="fa fa-check-square"></i>
                    </a>
                  </p>
                  @else
                  <p class="text-center">
                    <a href="#" class="change-selected-data-from-list color-black-blue" data-track_name="editor_pick_list_yes" data-id="{{ $p->id }}">
                      <i class="fa fa-square-o"></i>
                    </a>
                  </p>
                  @endif
                </td>
                <td>
                  <p class="text-center">
                      <a href="{{ route('preview', $p->id)}}" class="color-black-blue"><i class="fa fa-eye-slash"></i> </a>
                      @if(in_array('update-post', $permissions_per_session))
                      <a class="color-black-blue" href="{{ route('admin.post_update', $p->id) }}"><i class="fa fa-edit"></i> </a>
                      @endif
                      @if(in_array('delete-post', $permissions_per_session))
                      <a href="#" class="remove-selected-data-from-list color-black-blue" data-track_name="post_list" data-id="{{ $p->id }}"><i class="fa fa-trash-o"></i> </a>
                      @endif     
                      {{-- <a href="#" class="notif-to-apps color-black-blue" data-track_name="{{ $p->title }}" data-id="{{ $p->id }}"><i class="fa fa-bell"></i> </a> --}}                   
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
    <div class="col-xs-12">
      <div class="box-footer clearfix pull-right">{{-- $post->appends(Request::capture()->except('page'))->render() --}}</div>
    </div>    
</div>
@endsection