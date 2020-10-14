@extends('admin::includes.default')
@section('title', 'Admin | Page | Update')
@section('content')

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	<div class="box box-warning">
		<div class="box-header">
		  <h3 class="box-title">{{ $title_form }} &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-xs" href="{{ route('admin.page_list') }}">Page List</a></h3>
		  <div class="box-tools pull-right">
		    <button class="btn bg-navy btn-flat" type="submit">Save</button>
		  </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-6 {{ $errors->has('page_title') ? 'has-error' : '' }}">
				  <div class="custom-input-group">
				    <div class="custom-input-label"><label for="inputPageTitle">Title</label></div>
				    <div class="custom-input-element">
				      <input oninput="inputTitlePage()" type="text" placeholder="Title" id="inputPageTitle" name="page_title" class="form-control" @if(!empty($page)) value="{{ $page->title}}" @else value="{{ old('page_title') }}" @endif>
			          @if(!empty($errors->first('page_title')))
			          <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('page_title') }}</p>
			          @endif
				    </div>
				  </div>                  
				</div>
				<div class="col-md-6 {{ $errors->has('page_slug') ? 'has-error' : '' }}">
				  <div class="custom-input-group">
				    <div class="custom-input-label"><label for="inputPageSlug">Slug</label></div>
				    <div class="custom-input-element">
				      <input type="text" placeholder="Slug" name="page_slug" id="inputPageSlug" class="form-control" readonly @if(!empty($page)) value="{{ $page->slug}}" @else value="{{ old('page_slug') }}" @endif>
						@if(!empty($errors->first('page_slug')))
						<p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('page_slug') }}</p>
						@endif
				    </div>
				  </div>
				</div>
			</div>
			<div class="custom-input-group">
				<div class="custom-input-label"><label for="inputPageContent">Content</label></div>
				<div class="custom-input-element">
				  <textarea class="form-control" name="page_content" id="inputPageContent" placeholder="Content">@if(!empty($page)) {{ $page->content}} @else {{ old('page_content') }} @endif</textarea>
				</div>
			</div>              
		</div>
		<div class="col-md-4">
			<div class="custom-input-group">
				<div class="custom-input-label">
					<label for="page_schema">Schema</label>
				</div>
				<div class="custom-input-element">
					<input type="text" placeholder="Schema" name="page_schema" class="form-control" @if(!empty($page)) value="{{ $page->seo_schema}}" @else value="{{ old('page_schema') }}" @endif>
				</div>
			</div>
			<div class="custom-input-group">
				<div class="custom-input-label">
					<label for="page_meta_title">Meta Title</label>
				</div>
				<div class="custom-input-element">
					<input type="text" placeholder="Meta Title" id="inputPageMetaTitle" name="page_meta_title" class="form-control" @if(!empty($page)) value="{{ $page->seo_title}}" @else value="{{ old('page_meta_title') }}" @endif>
				</div>
			</div>              
			<div class="custom-input-group">
				<div class="custom-input-label">
					<label for="page_meta_description">Meta Description</label>
				</div>
				<div class="custom-input-element">
				  <textarea class="form-control" name="page_meta_description" placeholder="Meta Description">@if(!empty($page)) {{ $page->seo_description}} @else {{ old('page_meta_description') }} @endif</textarea>
				</div>
			</div>
			<div class="custom-input-group">
				<div class="custom-input-label">
					<label for="page_meta_keywords">Meta Keywords</label>
				</div>
				<div class="custom-input-element">
					<input type="text" placeholder="Meta Keywords" name="page_meta_keywords" class="form-control" @if(!empty($page)) value="{{ $page->seo_keywords}}" @else value="{{ old('page_meta_keywords') }}" @endif>
				</div>
			</div>
		</div>		
	</div>
</form>

@endsection