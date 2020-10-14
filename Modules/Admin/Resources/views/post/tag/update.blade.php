@extends('admin::includes.default')
@section('title', 'Admin | UpdateTag')
@section('content')
<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	<div class="box box-warning">
		<div class="box-header">
		  <h3 class="box-title">{{ $title_form }} &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-xs" href="{{ route('admin.post_tag') }}">Tag List</a></h3>
		  <div class="box-tools pull-right">
		    <button class="btn bg-navy btn-flat" type="submit">Save</button>
		  </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<div class="custom-input-group {{ $errors->has('tag_name') ? 'has-error' : '' }}">
						<div class="custom-input-label"><label for="inputTagName">Name</label></div>
						<div class="custom-input-element">
						  <input oninput="inputName()" type="text" placeholder="Name" id="inputTagName" name="tag_name" class="form-control" @if(!empty($tag)) value="{{ $tag->name}}" @else value="{{ old('tag_name') }}" @endif>
						  @if(!empty($errors->first('tag_name')))
						  <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('tag_name') }}</p>
						  @endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="custom-input-group {{ $errors->has('tag_slug') ? 'has-error' : '' }}">
								<div class="custom-input-label"><label for="inputTagSlug">Slug</label></div>
								<div class="custom-input-element">
								  <input type="text" placeholder="Slug" name="tag_slug" id="inputTagSlug" class="form-control" readonly @if(!empty($tag)) value="{{ $tag->slug}}" @else value="{{ old('tag_slug') }}" @endif>
									@if(!empty($errors->first('tag_slug')))
									<p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('tag_slug') }}</p>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="custom-input-group">
								<div class="custom-input-label"><label for="tag_group">Group</label></div>
								<div class="custom-input-element">
								  <input type="text" placeholder="Group" name="tag_group" class="form-control" @if(!empty($tag)) value="{{ $tag->group}}" @else value="{{ old('tag_group') }}" @endif>
										@if(!empty($errors->first('tag_group')))
										<p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('tag_group') }}</p>
										@endif
								</div>
							</div>
						</div>
					</div>								  
					
					<div class="custom-input-group">
						<div class="custom-input-label">
							<label for="tag_description">Description</label>
						</div>
						<div class="custom-input-element">
							<textarea class="form-control" name="tag_description" placeholder="Description">@if(!empty($tag)) {{ $tag->description}} @else {{ old('tag_description') }} @endif</textarea>
						</div>
					</div>
					<div class="custom-input-group">
						<div class="custom-input-label"><label></label></div>
						<div class="custom-input-element">
							<label>
			                  <input type="checkbox" name="tag_official" id="field-official" value="1" @if(!empty($tag)) @if($tag->official == 1) checked @endif @else @if(old('tag_official')) checked @endif @endif>
			                  Official
			                </label>
						</div>
					</div>        
				</div>
				<div class="col-md-4">					
					<div class="custom-input-group official-only">
						<div class="custom-input-label">
							<label for="tag_schema">Label</label>
						</div>
						<div class="custom-input-element">
							<input type="text" placeholder="Label" name="tag_label" class="form-control" @if(!empty($tag)) value="{{ $tag->label}}" @else value="{{ old('tag_label') }}" @endif>
						</div>
					</div>
					<div class="custom-input-group official-only">
						<div class="custom-input-group">
			              <div class="custom-input-label"><label for="tag_image">Image</label></div>
			                <div class="row">
			                  <div class="col-md-12">
			                  	@if(!empty($tag->image))
			                  	<input type="hidden" class="form-control" name="tag_image" id="hf_cms_tag_image_picture" value="{{ $tag->image }}">
			                    <div class="uploadform dropzone no-margin dz-clickable upload-tag-image" id="tag_image_uploader" name="tag_image_uploader" style="display:none;">
			                      <div class="dz-default dz-message">
			                        <span>Drop your cover picture here</span>
			                      </div>
			                    </div>		                    
			                    <div class="tag-image-picture text-center">
			                        <div class="img-div"><img src="{{ env('URL_ASSET').'images/tag/'.$tag->image }}" class="user-image" alt="" style="width: 50%;" /></div><br>
			                        <div class="btn-div"><button type="button" class="btn btn-danger remove-tag-image">Remove image</button></div>
			                    </div>
			                  	@else
			                  	<input type="hidden" class="form-control" name="tag_image" id="hf_cms_tag_image_picture" value="{{ old('tag_image') }}">
			                    <div class="uploadform dropzone no-margin dz-clickable upload-tag-image" id="tag_image_uploader" name="tag_image_uploader">
			                      <div class="dz-default dz-message">
			                        <span>Drop your cover picture here</span>
			                      </div>
			                    </div>		                    
			                    <div class="tag-image-picture text-center" style="display:none;">
			                        <div class="img-div"><img src="" class="user-image" alt="" style="width: 46%;" /></div><br>
			                        <div class="btn-div"><button type="button" class="btn btn-danger remove-tag-image">Remove image</button></div>
			                    </div>
			                    @endif
			                  </div>
			                </div>
			            </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="box box-warning">
						<div class="box-header">
						    <div class="custom-input-group">
								<div class="custom-input-label">
									<label for="tag_schema">Schema</label>
								</div>
								<div class="custom-input-element">
									<input type="text" placeholder="Schema" name="tag_schema" class="form-control" @if(!empty($tag)) value="{{ $tag->seo_schema}}" @else value="{{ old('tag_schema') }}" @endif>
								</div>
							</div>
							<div class="custom-input-group">
								<div class="custom-input-label">
									<label for="tag_meta_title">Meta Title</label>
								</div>
								<div class="custom-input-element">
									<input type="text" placeholder="Meta Title" id="inputTagMetaTitle" name="tag_meta_title" class="form-control" @if(!empty($tag)) value="{{ $tag->seo_title}}" @else value="{{ old('tag_meta_title') }}" @endif>
								</div>
							</div>              
							<div class="custom-input-group">
								<div class="custom-input-label">
									<label for="tag_meta_description">Meta Description</label>
								</div>
								<div class="custom-input-element">
								  <textarea class="form-control" name="tag_meta_description" placeholder="Meta Description">@if(!empty($tag)) {{ $tag->seo_description}} @else {{ old('tag_meta_description') }} @endif</textarea>
								</div>
							</div>
							<div class="custom-input-group">
								<div class="custom-input-label">
									<label for="tag_meta_keywords">Meta Keywords</label>
								</div>
								<div class="custom-input-element">
									<input type="text" placeholder="Meta Keywords" name="tag_meta_keywords" class="form-control" @if(!empty($tag)) value="{{ $tag->seo_keywords}}" @else value="{{ old('tag_meta_keywords') }}" @endif>
								</div>
							</div>
						</div>
					</div>					
				</div>								
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="custom-input-group official-only">
						<div class="custom-input-label">
							<label for="tag_about">About</label>
						</div>
						<div class="custom-input-element">
							<textarea id="text_editor_post_content" name="tag_about" rows="10" cols="80">@if(!empty($tag)) {{ $tag->about}} @else {{ old('tag_about') }} @endif</textarea>
						</div>
					</div>
				</div>
			</div>		              
		</div>		
	</div>
</form>
@endsection