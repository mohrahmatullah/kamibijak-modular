@extends('admin::includes.default')
@section('title', 'Admin | UpdateGallery')
@section('content')
<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	<div class="box box-warning">
		<div class="box-header">
		  <h3 class="box-title">{{ $title_form }} &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-xs" href="{{ route('admin.post_gallery') }}">Gallery List </a></h3>
		  <div class="box-tools pull-right">
		    <button class="btn bg-navy btn-flat" type="submit">Save</button>
		  </div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<div class="custom-input-group {{ $errors->has('gallery_name') ? 'has-error' : '' }}">
						<div class="custom-input-label"><label for="gallery_name">Name</label></div>
						<div class="custom-input-element">
						  <input oninput="inputNameGal()" type="text" placeholder="Name" id="gallery_name" name="gallery_name" class="form-control" @if(!empty($gallery)) value="{{ $gallery->name}}" @else value="{{ old('gallery_name') }}" @endif>
						  @if(!empty($errors->first('gallery_name')))
						  <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('gallery_name') }}</p>
						  @endif
						</div>
					</div>	

					<div class="custom-input-group">
						<div class="custom-input-label">
							<label for="gallery_group">Group</label>
						</div>
						<div class="custom-input-element">
							<input type="text" placeholder="Group" id="gallery_group" name="gallery_group" class="form-control" @if(!empty($gallery)) value="{{ $gallery->group}}" @else value="{{ old('gallery_group') }}" @endif>
						  	@if(!empty($errors->first('gallery_group')))
						  	<p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('gallery_group') }}</p>
						 	@endif
						</div>
					</div>

					<div class="custom-input-group">
						<div class="custom-input-label">
							<label for="gallery_keywords">Keywords</label>
						</div>
						<div class="custom-input-element">
							<input type="text" placeholder="Keywords" id="gallery_keywords" name="gallery_keywords" class="form-control" @if(!empty($gallery)) value="{{ $gallery->keywords}}" @else value="{{ old('gallery_keywords') }}" @endif>
						  	@if(!empty($errors->first('gallery_keywords')))
						  	<p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('gallery_keywords') }}</p>
						 	@endif
						</div>
					</div>

					<!-- tambah deskripsi			   -->
					<div class="custom-input-group">
						<div class="custom-input-label">
							<label for="gallery_description">Description</label>
						</div>
						<div class="custom-input-element">
						  <textarea class="form-control" name="gallery_description" placeholder="Description">@if(!empty($gallery)) {{ $gallery->description}} @else {{ old('gallery_description') }} @endif</textarea>
						</div>
					</div>
					<!-- end -->
				                
				</div>
				<div class="col-md-6">

					<div class="custom-input-group">
						<div class="custom-input-label">
							<label for="gallery_author">Author</label>
						</div>
						<div class="custom-input-element">
							<input type="text" placeholder="Author" id="gallery_author" name="gallery_author" class="form-control" @if(!empty($gallery)) value="{{ $gallery->author}}" @else value="{{ old('gallery_author') }}" @endif>
						  	@if(!empty($errors->first('gallery_author')))
						  	<p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('gallery_author') }}</p>
						  	@endif
						</div>
					</div>

					<!-- attach gambar -->
					<div class="custom-input-group">
		              <div class="custom-input-label"><label for="gallery_cover">Picture</label></div>
		                <div class="row">
		                  <div class="col-md-12"> 
		                  	<!-- kondisi update -->
		                  	@if(!empty($gallery->cover))
		                  	<input type="hidden" class="form-control" name="gallery_cover" id="hf_cms_covergal_picture" value="{{ $gallery->cover }}">

		                    <div class="uploadform dropzone no-margin dz-clickable upload-gallery-cover" id="gallery_cover_uploader" name="gallery_cover_uploader" style="display:none;">
		                      <div class="dz-default dz-message">
		                        <span>Drop your cover picture here</span>
		                      </div>
		                    </div>	
		                    @if(!empty($errors->first('gallery_cover')))
						  <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('gallery_cover') }}</p>
						  @endif	                    
		                    <div class="gallery-cover-picture text-center">
		                        <div class="img-div"><img src="{{ env('URL_ASSET').'images/gallery/'.$gallery->cover }}" class="user-image" alt="" style="width: 50%;" /></div><br>
		                        <div class="btn-div"><button type="button" class="btn btn-danger remove-gallery-cover">Remove image</button></div>
		                    </div>
		                    <!-- kondisi create -->
		                  	@else
		                  	<input type="hidden" class="form-control" name="gallery_cover" id="hf_cms_covergal_picture" value="{{ old('gallery_cover') }}">
		                  	
		                    <div class="uploadform dropzone no-margin dz-clickable upload-gallery-cover" id="gallery_cover_uploader" name="gallery_cover_uploader">
		                      <div class="dz-default dz-message">
		                        <span>Drop your cover picture here</span>
		                      </div>
		                      
		                    </div>	
		                    @if(!empty($errors->first('gallery_cover')))
						  <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('gallery_cover') }}</p>
						  @endif	                    
		                    <div class="gallery-cover-picture text-center" style="display:none;">
		                        <div class="img-div"><img src="" class="user-image" alt="" style="width: 46%;" /></div><br>
		                        <div class="btn-div"><button type="button" class="btn btn-danger remove-gallery-cover">Remove image</button></div>
		                    </div>
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