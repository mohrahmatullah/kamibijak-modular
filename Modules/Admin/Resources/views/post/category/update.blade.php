@extends('admin::includes.default')
@section('title', 'Admin | UpdateCategory')
@section('content')
<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	<div class="box box-warning">
		<div class="box-header">
		  <h3 class="box-title">{{ $title_form }} &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-xs" href="{{ route('admin.post_category') }}">Category List</a></h3>
		  <div class="box-tools pull-right">
		    <button class="btn bg-navy btn-flat" type="submit">Save</button>
		  </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<div class="custom-input-group {{ $errors->has('category_name') ? 'has-error' : '' }}">
						<div class="custom-input-label"><label for="category_name">Name</label></div>
						<div class="custom-input-element">
						  <input oninput="inputNameCat()" type="text" placeholder="Name" id="name" name="category_name" class="form-control" @if(!empty($category)) value="{{ $category->name}}" @else value="{{ old('category_name') }}" @endif>
						  @if(!empty($errors->first('category_name')))
						  <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('category_name') }}</p>
						  @endif
						</div>
					</div>				  
					<div class="custom-input-group">
						<div class="custom-input-label"><label for="category_parent">Parent</label></div>
						<div class="custom-input-element">
							<select class="selectpicker form-control" name="category_parent" data-live-search="false">
								<option data-tokens="0" value="0">None</option>
								@foreach($categories as $cat)
								  <option data-tokens="{{ $cat->id }}" value="{{ $cat->id }}">{{ $cat->name }}</option>
								@endforeach
							</select>

						</div>
					</div>                  
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6">
							<div class="custom-input-group {{ $errors->has('categroy_slug') ? 'has-error' : '' }}">
								<div class="custom-input-label"><label for="category_slug">Slug</label></div>
								<div class="custom-input-element">
								  <input type="text" placeholder="Slug" name="category_slug" id="slug" class="form-control" readonly @if(!empty($category)) value="{{ $category->slug}}" @else value="{{ old('category_slug') }}" @endif>
									@if(!empty($errors->first('category_slug')))
									<p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('category_slug') }}</p>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="custom-input-group {{ $errors->has('categroy_slug_mobile') ? 'has-error' : '' }}">
								<div class="custom-input-label"><label for="category_slug_mobile">Slug Mobile</label></div>
								<div class="custom-input-element">
								  <input type="text" placeholder="Slug" name="category_slug_mobile" class="form-control" @if(!empty($category)) value="{{ $category->slug_mobile}}" @else value="{{ old('category_slug_mobile') }}" @endif>
									@if(!empty($errors->first('category_slug_mobile')))
									<p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('category_slug_mobile') }}</p>
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="custom-input-group">
								<div class="custom-input-label"><label for="category_color">Color</label></div>
								<div class="input-group my-colorpicker2">
									<input type="text" placeholder="Color" name="category_color" id="color" class="form-control" @if(!empty($category)) value="{{ $category->color}}" @else value="{{ old('category_color') }}" @endif>
									<div class="input-group-addon">
									  <i></i>
									</div>
								</div>
								@if(!empty($errors->first('category_color')))
								<p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('category_color') }}</p>
								@endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="custom-input-group">
								<div class="custom-input-label"><label for="category_section">Section</label></div>
								<div class="custom-input-element">
								  <input type="number" placeholder="Section" name="category_section" class="form-control" @if(!empty($category)) value="{{ $category->section}}" @else value="{{ old('category_section') }}" @endif>
									@if(!empty($errors->first('category_section')))
									<p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('category_section') }}</p>
									@endif
								</div>
							</div>
						</div>
					</div>					
				</div>				
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="custom-input-group">
						<div class="custom-input-label">
							<label for="category_description">Description</label>
						</div>
						<div class="custom-input-element">
						  <textarea class="form-control" name="category_description" placeholder="Description">@if(!empty($category)) {{ $category->description}} @else {{ old('category_description') }} @endif</textarea>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6">
							<div class="custom-input-label"><label></label></div>
							<div class="custom-input-element">
								<label>
				                  <input type="checkbox" name="category_favorite" value="1" @if(!empty($category)) @if($category->favorite == 1) checked @endif @else @if(old('category_favorite')) checked @endif @endif>
				                  Favorite
				                </label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="custom-input-label"><label></label></div>
							<div class="custom-input-element">
								<label>
				                  <input type="checkbox" name="category_new" value="1" @if(!empty($category)) @if($category->new == 1) checked @endif @else @if(old('category_new')) checked @endif @endif>
				                  New
				                </label>
							</div>
						</div>
					</div>					
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="custom-input-group">
		              <div class="custom-input-label"><label for="category_cover">Cover</label></div>
		                <div class="row">
		                  <div class="col-md-12">
		                  	@if(!empty($category->cover))
		                  	<input type="hidden" class="form-control" name="category_cover" id="hf_cms_covercat_picture" value="{{ $category->cover }}">
		                    <div class="uploadform dropzone no-margin dz-clickable upload-category-cover" id="category_cover_uploader" name="category_cover_uploader" style="display:none;">
		                      <div class="dz-default dz-message">
		                        <span>Drop your cover picture here</span>
		                      </div>
		                    </div>		                    
		                    <div class="category-cover-picture text-center">
		                        <div class="img-div"><img src="{{ env('URL_ASSET').'images/category/'.$category->cover }}" class="user-image" alt="" style="width: 50%;" /></div><br>
		                        <div class="btn-div"><button type="button" class="btn btn-danger remove-category-cover">Remove image</button></div>
		                    </div>
		                  	@else
		                  	<input type="hidden" class="form-control" name="category_cover" id="hf_cms_covercat_picture" value="{{ old('category_cover') }}">
		                    <div class="uploadform dropzone no-margin dz-clickable upload-category-cover" id="category_cover_uploader" name="category_cover_uploader">
		                      <div class="dz-default dz-message">
		                        <span>Drop your cover picture here</span>
		                      </div>
		                    </div>		                    
		                    <div class="category-cover-picture text-center" style="display:none;">
		                        <div class="img-div"><img src="" class="user-image" alt="" style="width: 46%;" /></div><br>
		                        <div class="btn-div"><button type="button" class="btn btn-danger remove-category-cover">Remove image</button></div>
		                    </div>
		                    @endif
		                  </div>
		                </div>
		            </div>

		            <div class="custom-input-group">
		              <div class="custom-input-label"><label for="category_avatar">Avatar</label></div>
		                <div class="row">
		                  <div class="col-md-12">
		                  	@if(!empty($category->avatar))
		                  	<input type="hidden" class="form-control" name="category_avatar" id="hf_cms_avatarcat_picture" value="{{ $category->avatar }}">
		                    <div class="uploadform dropzone no-margin dz-clickable upload-category-avatar" id="category_avatar_uploader" name="category_avatar_uploader" style="display:none;">
		                      <div class="dz-default dz-message">
		                        <span>Drop your cover picture here</span>
		                      </div>
		                    </div>		                    
		                    <div class="category-avatar-picture text-center">
		                        <div class="img-div"><img src="{{ env('URL_ASSET').'images/category/'.$category->avatar }}" class="user-image" alt="" style="width: 50%;" /></div><br>
		                        <div class="btn-div"><button type="button" class="btn btn-danger remove-category-avatar">Remove image</button></div>
		                    </div>
		                  	@else
		                  	<input type="hidden" class="form-control" name="category_avatar" id="hf_cms_avatarcat_picture" value="{{ old('category_avatar') }}">
		                    <div class="uploadform dropzone no-margin dz-clickable upload-category-avatar" id="category_avatar_uploader" name="category_avatar_uploader">
		                      <div class="dz-default dz-message">
		                        <span>Drop your cover picture here</span>
		                      </div>
		                    </div>		                    
		                    <div class="category-avatar-picture text-center" style="display:none;">
		                        <div class="img-div"><img src="" class="user-image" alt="" style="width: 46%;" /></div><br>
		                        <div class="btn-div"><button type="button" class="btn btn-danger remove-category-avatar">Remove image</button></div>
		                    </div>
		                    @endif
		                  </div>
		                </div>
		            </div>

		            <div class="custom-input-group">
		              <div class="custom-input-label"><label for="category_icon">Icon</label></div>
		                <div class="row">
		                  <div class="col-md-12">
		                  	@if(!empty($category->icon))
		                  	<input type="hidden" class="form-control" name="category_icon" id="hf_cms_iconcat_picture" value="{{ $category->icon }}">
		                    <div class="uploadform dropzone no-margin dz-clickable upload-category-icon" id="category_icon_uploader" name="category_icon_uploader" style="display:none;">
		                      <div class="dz-default dz-message">
		                        <span>Drop your cover picture here</span>
		                      </div>
		                    </div>		                    
		                    <div class="category-icon-picture text-center">
		                        <div class="img-div"><img src="{{ env('URL_ASSET').'images/category/'.$category->icon }}" class="user-image" alt="" style="width: 50%;" /></div><br>
		                        <div class="btn-div"><button type="button" class="btn btn-danger remove-category-icon">Remove image</button></div>
		                    </div>
		                  	@else
		                  	<input type="hidden" class="form-control" name="category_icon" id="hf_cms_iconcat_picture" value="{{ old('category_icon') }}">
		                    <div class="uploadform dropzone no-margin dz-clickable upload-category-icon" id="category_icon_uploader" name="category_icon_uploader">
		                      <div class="dz-default dz-message">
		                        <span>Drop your cover picture here</span>
		                      </div>
		                    </div>		                    
		                    <div class="category-icon-picture text-center" style="display:none;">
		                        <div class="img-div"><img src="" class="user-image" alt="" style="width: 46%;" /></div><br>
		                        <div class="btn-div"><button type="button" class="btn btn-danger remove-category-icon">Remove image</button></div>
		                    </div>
		                    @endif
		                  </div>
		                </div>
		            </div>
				</div>
				<div class="col-md-6">
					<div class="custom-input-group">
						<div class="custom-input-label">
							<label for="category_schema">Schema</label>
						</div>
						<div class="custom-input-element">
							<input type="text" placeholder="Schema" name="category_schema" class="form-control" @if(!empty($category)) value="{{ $category->seo_schema}}" @else value="{{ old('category_schema') }}" @endif>
						</div>
					</div>
					<div class="custom-input-group">
						<div class="custom-input-label">
							<label for="category_meta_title">Meta Title</label>
						</div>
						<div class="custom-input-element">
							<input type="text" placeholder="Meta Title" id="inputcategoryMetaTitle" name="category_meta_title" class="form-control" @if(!empty($category)) value="{{ $category->seo_title}}" @else value="{{ old('category_meta_title') }}" @endif>
						</div>
					</div>              
					<div class="custom-input-group">
						<div class="custom-input-label">
							<label for="category_meta_description">Meta Description</label>
						</div>
						<div class="custom-input-element">
						  <textarea class="form-control" name="category_meta_description" placeholder="Meta Description">@if(!empty($category)) {{ $category->seo_description}} @else {{ old('category_meta_description') }} @endif</textarea>
						</div>
					</div>
					<div class="custom-input-group">
						<div class="custom-input-label">
							<label for="category_meta_keywords">Meta Keywords</label>
						</div>
						<div class="custom-input-element">
							<input type="text" placeholder="Meta Keywords" name="category_meta_keywords" class="form-control" @if(!empty($category)) value="{{ $category->seo_keywords}}" @else value="{{ old('category_meta_keywords') }}" @endif>
						</div>
					</div>
				</div>
			</div>	

		</div>		
	</div>
</form>
@endsection