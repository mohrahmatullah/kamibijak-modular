@extends('admin::includes.default')
@section('title', 'Admin | Banner | Update')
@section('content')
<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	<div class="box box-warning">
		<div class="box-header">
		  <h3 class="box-title">{{ $title_form }} &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-xs" href="{{ route('admin.banner_list') }}">Banner List</a></h3>
		  <div class="box-tools pull-right">
		    <button class="btn bg-navy btn-flat" type="submit">Save</button>
		  </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
      <div class="custom-input-group {{ $errors->has('banner_name') ? 'has-error' : '' }}">
        <div class="custom-input-label"><label for="banner_name">Name</label></div>
        <div class="custom-input-element">
          <input type="text" placeholder="Name" name="banner_name" class="form-control" @if(!empty($banner)) value="{{ $banner->name}}" @else value="{{ old('banner_name') }}" @endif>
            @if(!empty($errors->first('banner_name')))
            <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('banner_name') }}</p>
            @endif
        </div>
      </div>      
      <div class="custom-input-group {{ $errors->has('banner_placement') ? 'has-error' : '' }}">
        <div class="custom-input-label"><label for="banner_placement">Placement</label></div>
        <div class="custom-input-element">
          <input type="text" placeholder="Placement" name="banner_placement"class="form-control" @if(!empty($banner)) value="{{ $banner->placement}}" @else value="{{ old('banner_placement') }}" @endif>
        @if(!empty($errors->first('banner_placement')))
        <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('banner_placement') }}</p>
        @endif
        </div>
      </div>
      <div class="custom-input-group">
        <div class="custom-input-label"><label for="banner_time_start">Time Start</label></div>
        <div class="custom-input-element">
          <input type="text" placeholder="Time Start" name="banner_time_start" class="form-control timestart" @if(!empty($banner)) value="{{ $banner->timestart}}" @else value="{{ old('banner_time_start') }}" @endif>
        </div>
      </div>       
      <div class="custom-input-group">
        <div class="custom-input-label"><label for="banner_expired">Expired</label></div>
        <div class="custom-input-element">
          <input type="text" placeholder="Expired" name="banner_expired" class="form-control expired" @if(!empty($banner)) value="{{ $banner->expired}}" @else value="{{ old('banner_expired') }}" @endif>
        </div>
      </div>      
      <div class="custom-input-group">
        <div class="custom-input-label"><label for="banner_caption">Caption</label></div>
        <div class="custom-input-element">
          <input type="text" placeholder="Caption" name="banner_caption" class="form-control" @if(!empty($banner)) value="{{ $banner->website}}" @else value="{{ old('banner_caption') }}" @endif>
        </div>
      </div>
      <div class="custom-input-group">
        <div class="custom-input-label"><label for="banner_name">URL</label></div>
        <div class="custom-input-element">
          <input type="text" placeholder="URL" name="banner_url" class="form-control" @if(!empty($banner)) value="{{ $banner->link}}" @else value="{{ old('banner_url') }}" @endif>
        </div>
      </div>
			<div class="custom-input-group">
				<div class="custom-input-label"><label for="banner_code">Code</label></div>
				<div class="custom-input-element">
				  <textarea class="form-control" name="banner_code" placeholder="Code">@if(!empty($banner)) {{ $banner->code}} @else {{ old('banner_code') }} @endif</textarea>
				</div>
			</div>              
		</div>
		<div class="col-md-4">
			<div class="form-group mx-4">
        <div class="row">
          <div class="col-md-12">
            <div class="custom-input-group">
              <div class="custom-input-label"><label for="banner_media">Media</label></div>
                <div class="row">
                  <div class="col-md-12">
                    @if(!empty($banner->media))
                    <input type="hidden" class="form-control" name="banner_media" id="banner_media" value="{{ $banner->cover }}">
                    <div class="uploadform dropzone no-margin dz-clickable upload-banner-media" id="banner_media_uploader" name="banner_media_uploader" style="display:none;">
                      <div class="dz-default dz-message">
                        <span>Drop your cover picture here</span>
                      </div>
                    </div>                        
                    <div class="banner-media-picture text-center">
                        <div class="img-div"><img src="{{ env('URL_ASSET').'images/banner/'.$banner->media }}" class="user-image" alt="" style="width: 50%;" /></div><br>
                        <div class="btn-div"><button type="button" class="btn btn-danger remove-banner-media">Remove image</button></div>
                    </div>
                    @else
                    <input type="hidden" class="form-control" name="banner_media" id="banner_media" value="{{ old('banner_media') }}">
                      @if(!empty(old('banner_media')))
                      <div class="banner-media-picture text-center">
                          <div class="img-div"><img src="{{ env('URL_ASSET').'images/banner/'.old('banner_media') }}" class="user-image" alt="" style="width: 50%;" /></div><br>
                          <div class="btn-div"><button type="button" class="btn btn-danger remove-banner-media">Remove image</button></div>
                      </div>
                      @else
                      <div class="uploadform dropzone no-margin dz-clickable upload-banner-media" id="banner_media_uploader" name="banner_media_uploader">
                        <div class="dz-default dz-message">
                          <span>Drop your cover picture here</span>
                        </div>
                      </div>                        
                      <div class="banner-media-picture text-center" style="display:none;">
                          <div class="img-div"><img src="" class="user-image" alt="" style="width: 46%;" /></div><br>
                          <div class="btn-div"><button type="button" class="btn btn-danger remove-banner-media">Remove image</button></div>
                      </div>
                      @endif                    
                    @endif
                  </div>
                </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="custom-input-group">
              <div class="custom-input-label"><label for="banner_video">Video</label></div>
                <div class="row">
                  <div class="col-md-12">
                    @if(!empty($banner->video))
                    <input type="hidden" class="form-control" name="banner_video" id="banner_video" value="{{ $banner->cover }}">
                    <div class="uploadform dropzone no-margin dz-clickable upload-banner-video" id="banner_video_uploader" name="banner_video_uploader" style="display:none;">
                      <div class="dz-default dz-message">
                        <span>Drop your cover picture here</span>
                      </div>
                    </div>                        
                    <div class="banner-video-picture text-center">
                        <div class="img-div">
                          <video src="{{ env('URL_ASSET').'video/banner/'.$banner->video }}" type="video/mp4" style="width: 50%;" controls></video>
                        </div><br>
                        <div class="btn-div"><button type="button" class="btn btn-danger remove-banner-video">Remove image</button></div>
                    </div>
                    @else
                    <input type="hidden" class="form-control" name="banner_video" id="banner_video" value="{{ old('banner_video') }}">
                      @if(!empty(old('banner_media')))
                      <div class="banner-video-picture text-center">
                          <div class="img-div">
                            <video src="{{ env('URL_ASSET').'video/banner/'.old('banner_video') }}" type="video/mp4" style="width: 50%;" controls></video>
                          </div><br>
                          <div class="btn-div"><button type="button" class="btn btn-danger remove-banner-video">Remove image</button></div>
                      </div>
                      @else
                      <div class="uploadform dropzone no-margin dz-clickable upload-banner-video" id="banner_video_uploader" name="banner_video_uploader">
                        <div class="dz-default dz-message">
                          <span>Drop your cover picture here</span>
                        </div>
                      </div>                        
                      <div class="banner-video-picture text-center" style="display:none;">
                          <div class="img-div">
                            <video src="" type="video/mp4" style="width: 50%;" controls></video>
                          </div><br>
                          <div class="btn-div"><button type="button" class="btn btn-danger remove-banner-video">Remove image</button></div>
                      </div>
                      @endif                    
                    @endif
                  </div>
                </div>
            </div>
          </div>

        </div>
      </div>
		</div>		
	</div>
</form>
@endsection