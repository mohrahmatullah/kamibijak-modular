@extends('admin::includes.default')
@section('title', 'Admin | UpdateGallery')
@section('content')
<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	<div class="box box-warning">
		<div class="box-header">
		  <h3 class="box-title">{{ $title_form }} &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-xs" href="{{ route('admin.post_gallery') }}">Gallery List</a></h3>
		  <h3 class="box-title"> &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-xs" href="{{ route('admin.gallery_media', $gallery_id) }}">Gallery Media List</a></h3>
		  <div class="box-tools pull-right">
		    <button class="btn bg-navy btn-flat" type="submit">Save</button>
		  </div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<div class="custom-input-group {{ $errors->has('gm_title') ? 'has-error' : '' }}">
						<div class="custom-input-label"><label for="gm_title">Title</label></div>
						<div class="custom-input-element">
						  <input oninput="inputNameGal()" type="text" placeholder="Title" id="gm_title" name="gm_title" class="form-control" @if(!empty($gallerymedia)) value="{{ $gallerymedia->title}}" @else value="{{ old('gm_title') }}" @endif>
						  @if(!empty($errors->first('gm_title')))
						  <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('gm_title') }}</p>
						  @endif
						  <input type="hidden" name="gm_gallery" value="{{ $gallery_id }}">
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="custom-input-group">
							<div class="custom-input-label"><label for="gm_media_label">Media Label</label></div>
								<div class="custom-input-element">
							  		<input type="text" placeholder="Media Label" id="gm_media_label" name="gm_media_label" class="form-control" @if(!empty($gallerymedia)) value="{{ $gallerymedia->media_label}}" @else value="{{ old('gm_media_label') }}" @endif>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="custom-input-group {{ $errors->has('gm_index') ? 'has-error' : '' }}">
							<div class="custom-input-label"><label for="gm_index">Index</label></div>
								<div class="custom-input-element">
							  		<input oninput="inputNameGal()" type="number" min="1" max="10" placeholder="Index" id="gm_index" name="gm_index" class="form-control" @if(!empty($gallerymedia)) value="{{ $gallerymedia->index}}" @else value="{{ old('gm_index') }}" @endif>
							  		@if(!empty($errors->first('gm_index')))
							  		<p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('gm_index') }}</p>
							 		 @endif
								</div>
							</div>
						</div>
					</div>
					
					
					<!-- tambah deskripsi			   -->
					<div class="custom-input-group">
						<div class="custom-input-label">
							<label for="gallery_description">Description</label>
						</div>
						<div class="custom-input-element">
						  <textarea class="form-control" name="gm_description" placeholder="Description">@if(!empty($gallerymedia)) {{ $gallerymedia->description}} @else {{ old('gm_description') }} @endif</textarea>
						</div>
					</div>
					<!-- end -->	

				</div>
				<div class="col-md-6">

					<!-- attach gambar -->
					<div class="custom-input-group">
		              <div class="custom-input-label"><label for="gm_media">Picture</label></div>
		                <div class="row">
		                  <div class="col-md-12"> 
		                  	<!-- kondisi update -->
		                  	@if(!empty($gallerymedia->media))
		                  	<input type="hidden" class="form-control" name="gm_media" id="hf_cms_covergal_picture" value="{{ $gallerymedia->media }}">

		                    <div class="uploadform dropzone no-margin dz-clickable upload-gallery-cover" id="gallery_cover_uploader" name="gallery_cover_uploader" style="display:none;">
		                      <div class="dz-default dz-message">
		                        <span>Drop your media picture here</span>
		                      </div>
		                    </div>	
			                      @if(!empty($errors->first('gm_media')))
								  <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('gm_media') }}</p>
								  @endif

		                    <div class="gallery-cover-picture text-center">
		                        <div class="img-div"><img src="{{ env('URL_ASSET').'images/gallery/'.$gallerymedia->media }}" class="user-image" alt="" style="width: 50%;" /></div><br>
		                        <div class="btn-div"><button type="button" class="btn btn-danger remove-gallery-cover">Remove image</button></div>
		                    </div>
		                    <!-- kondisi create -->
		                  	@else
		                  	<input type="hidden" class="form-control" name="gm_media" id="hf_cms_covergal_picture" value="{{ old('gm_media') }}">	                  		
			                    @if(!empty(old('gm_media')))
			                    <div class="gallery-cover-picture text-center">
			                        <div class="img-div"><img src="{{ env('URL_ASSET').'images/gallery/'.old('gm_media') }}" class="user-image" alt="" style="width: 50%;" /></div><br>
			                        <div class="btn-div"><button type="button" class="btn btn-danger remove-gallery-cover">Remove image</button></div>
			                    </div>
			                    @else
			                    <div class="uploadform dropzone no-margin dz-clickable upload-gallery-cover" id="gallery_cover_uploader" name="gallery_cover_uploader">
			                      <div class="dz-default dz-message">
			                        <span>Drop your cover picture here</span>
			                      </div>		                      
			                    </div>
			                    <div class="gallery-cover-picture text-center" style="display:none;">
			                        <div class="img-div"><img src="" class="user-image" alt="" style="width: 46%;" /></div><br>
			                        <div class="btn-div"><button type="button" class="btn btn-danger remove-gallery-cover">Remove image</button></div>
			                    </div>
			                    @endif
		                    @endif
		                      @if(!empty($errors->first('gm_media')))
							  <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('gm_media') }}</p>
							  @endif
		                  </div>
		                </div>
		            </div>
					<!-- end -->

				</div>				
			</div>
		</div>		
	</div>
</form>
@endsection