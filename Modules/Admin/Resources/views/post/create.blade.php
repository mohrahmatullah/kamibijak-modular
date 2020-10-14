@extends('admin::includes.default')
@section('title', 'Admin | Post | Create')
@section('content')

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
  
  <div class="box box-warning">
    <div class="box-header">
      <h3 class="box-title">Add New Post &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-xs" href="{{ route('admin.post_list') }}">Post List</a></h3>
      <div class="box-tools pull-right">
        <button class="btn bg-navy btn-flat" type="submit">Save</button>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-8">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">Title</h3>
        </div>
        <div class="box-body {{ $errors->has('post_title') ? 'has-error' : '' }}">
          <input oninput="inputTitlePost()" type="text" placeholder="Title" class="form-control" id="post_title" name="post_title" value="{{ old('post_title') }}">
          @if(!empty($errors->first('post_title')))
          <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('post_title') }}</p>
          @endif
        </div>
      </div>

      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">Slug</h3>
        </div>
        <div class="box-body">
          @if(in_array('update-post_slug', $permissions_per_session))
            <input type="text" placeholder="Slug" name="post_slug" id="post_slug" class="form-control" value="{{ old('post_slug') }}">
            @if(!empty($errors->first('post_slug')))
            <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('post_slug') }}</p>
            @endif
          @else
            <input type="text" placeholder="Slug" name="post_slug" id="post_slug" class="form-control" value="{{ old('post_slug') }}" readonly>
            @if(!empty($errors->first('post_slug')))
            <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('post_slug') }}</p>
            @endif
          @endif
        </div>
      </div>

      <div class="box box-solid" style="display: none;">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">Label</h3>
        </div>
        <div class="box-body">
          <input type="text" placeholder="Label" class="form-control" name="post_label">
        </div>
      </div>
      
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">Content</h3>
        </div>
        <div class="box-body">
          <textarea id="text_editor_post_content" name="post_content" rows="10" cols="80">{{ old('post_content') }}</textarea>
          @if(!empty($errors->first('post_content')))
          <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('post_content') }}</p>
          @endif
        </div>
      </div>
      
      <div class="box box-warning">
        <div class="box-body">
          <div class="tabbable tabs-left">
            <ul class="nav nav-tabs">
              <li class="active general"><a href="#a" data-toggle="tab"> Video</a></li>
              <li class="inventory"><a href="#b" data-toggle="tab"> Category</a></li>
              <li class="features"><a href="#c" data-toggle="tab"> Tag</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-general tab-pane active" id="a">
              	<div class="row">
                  <div class="col-md-12">
                    <div class="form-group mx-4 {{ $errors->has('post_embed_script') ? 'has-error' : '' }}">
                      <label for="post_embed_script">Embed Script</label>
                      <input type="text" id="yt_id" name="post_embed_script" placeholder="Embed Script" class="form-control" value="{{ old('post_embed_script') }}" />
                      @if(!empty($errors->first('post_embed_script')))
                      <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('post_embed_script') }}</p>
                      @endif
                    </div>                    
                    <!-- <div class="form-group mx-4">
                      <label for="post_thumbnail">Thumbnail</label>
                       <div class="thumbnail-picture text-center" style="display:none;">
                          <div class="img-div"><img src="" class="user-image" alt="" style="width: 30%;" /></div><br>
                          <div class="btn-div"><button type="button" class="btn btn-danger remove-cms-thumbnail-picture">Remove image</button></div>
                       </div>
                       <div class="no-thumbnail-picture text-center">
                          <div class="img-div"><img src="{{ default_upload_sample_img_src() }}" class="user-image" alt=""/></div><br>
                          <div class="btn-div"><button data-toggle="modal" data-target="#cmsUploadThumbnailPicture" type="button" class="btn btn-default btn-flat thumbnail-picture-uploader">Upload image</button></div>
                       </div>
                       <div class="modal fade" id="cmsUploadThumbnailPicture" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
                                <br>
                                <i class="icon-credit-card icon-7x"></i>
                                <p class="no-margin">You can upload 1 image</p>
                              </div>
                              <div class="modal-body">             
                                <div class="uploadform dropzone no-margin dz-clickable cms-user-thumbnail-picture-uploader" id="cms_thumbnail_picture_uploader" name="cms_thumbnail_picture_uploader">
                                  <div class="dz-default dz-message">
                                    <span>Drop your cover picture here</span>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default attachtopost" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                       </div> 
                       <input type="hidden" name="post_thumbnail" id="hf_cms_thumbnail_picture" value="">
                    </div> -->
                    <div class="form-group mx-4 {{ $errors->has('post_cover') ? 'has-error' : '' }}">
                      <label for="post_cover">Cover</label>
                      <div class="row">
                        <div class="col-md-12">                          
                          <input class="form-control" type="hidden" name="post_cover" id="hf_cms_cover_picture" value="{{ old('post_cover') }}">
                          @if(!empty(old('post_cover'))) 
                          <div style="display: none;" class="uploadform dropzone no-margin dz-clickable cms-user-cover-picture-uploader" id="cms_cover_picture_uploader" name="cms_cover_picture_uploader">
                            <div class="dz-default dz-message">
                              <span>Drop your cover picture here</span>
                            </div>
                          </div>                         
                          <div class="cover-picture text-center">
                            <div class="img-div"><img src="{{ get_image_url(old('post_cover')) }}" class="user-image" alt="" style="width: 50%;"/></div><br>
                            <div class="btn-div"><button type="button" class="btn btn-danger remove-cms-cover-picture">Remove image</button></div>
                          </div>
                          @else
                          <div class="uploadform dropzone no-margin dz-clickable cms-user-cover-picture-uploader" id="cms_cover_picture_uploader" name="cms_cover_picture_uploader">
                            <div class="dz-default dz-message">
                              <span>Drop your cover picture here</span>
                            </div>
                          </div>
                          <div class="cover-picture text-center" style="display:none;">
                            <div class="img-div"><img src="" class="user-image" alt="" style="width: 50%;"/></div><br>
                            <div class="btn-div"><button type="button" class="btn btn-danger remove-cms-cover-picture">Remove image</button></div>
                          </div>
                         @endif
                          @if(!empty($errors->first('post_cover')))
                          <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('post_cover') }}</p>
                          @endif
                        </div>
                        <!-- <div class="col-md-6">
                          <div class="cover-picture text-center" style="display:none;">
                            <div class="img-div"><img src="" class="user-image" alt="" style="width: 30%;"/></div><br>
                            <div class="btn-div"><button type="button" class="btn btn-danger remove-cms-cover-picture">Remove image</button></div>
                         </div>
                         <div class="no-cover-picture text-center">
                            <div class="img-div"><img src="{{ default_upload_sample_img_src() }}" class="user-image" alt=""/></div><br>
                         </div>
                        </div> -->
                      </div>


                        <!-- <input type="text" placeholder="Cover" name="post_cover" class="form-control"> -->
                       <!-- <div class="cover-picture text-center" style="display:none;">
                          <div class="img-div"><img src="" class="user-image" alt="" style="width: 30%;"/></div><br>
                          <div class="btn-div"><button type="button" class="btn btn-danger remove-cms-cover-picture">Remove image</button></div>
                       </div>
                       <div class="no-cover-picture text-center">
                          <div class="img-div"><img src="{{ default_upload_sample_img_src() }}" class="user-image" alt=""/></div><br>
                          <div class="btn-div"><button data-toggle="modal" data-target="#cmsUploadCoverPicture" type="button" class="btn btn-default btn-flat cover-picture-uploader">Upload image</button></div>
                       </div>
                       <div class="modal fade" id="cmsUploadCoverPicture" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
                                <br>
                                <i class="icon-credit-card icon-7x"></i>
                                <p class="no-margin">You can upload 1 image</p>
                              </div>
                              <div class="modal-body">             
                                <div class="uploadform dropzone no-margin dz-clickable cms-user-cover-picture-uploader" id="cms_cover_picture_uploader" name="cms_cover_picture_uploader">
                                  <div class="dz-default dz-message">
                                    <span>Drop your cover picture here</span>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default attachtopost" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                       </div> 
                       <input type="text" name="post_cover" id="hf_cms_cover_picture" value=""> -->
                    </div>

                    <div class="form-group mx-4" style="display: none;">
                      <label for="post_cover_label">Cover Label</label>
                        <input type="text" placeholder="Cover" name="post_cover_label" class="form-control">
                    </div>

                    <div class="form-group mx-4" style="display: none;">
                    	<label>
		                  <input type="checkbox" name="post_photo_only" class="flat-red" value="1">
		                  Photo Only
		                </label>
                    </div>
                 </div>
                </div>            
              </div>
              
              <div class="tab-stock tab-pane" id="b">
                <div class="row">
                  <div class="col-md-12">

                  	<div class="form-group mx-4" style="display: none;">
                      <label for="post_location">Location</label>
                        <input type="text" placeholder="Location" name="post_location" class="form-control">
                    </div>

                    <div class="form-group mx-4 {{ $errors->has('post_category') ? 'has-error' : '' }}">
                      <label for="post_category">Category</label>
                        <select name="post_category[]" id="post_category" multiple="multiple" data-placeholder="Please Select Category" class="form-control select2" style="width: 100%;">
		                    @if($category->count() > 0)
		                      @foreach($category as $p)
		                        <option value="{{ $p->id }}" @if(!empty(old('post_category'))) @if(in_array($p->id, old('post_category'))) selected @endif @endif> {!! $p->name !!} </option>
		                      @endforeach
		                    @endif
	                  	  </select>
                        @if(!empty($errors->first('post_category')))
                        <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('post_category') }}</p>
                        @endif
                    </div>

                  	<div class="form-group mx-4">
                      <label for="post_credit">Credit</label>
                      @if(Session::get('kamibijak_admin') == 160)
                        <select name="post_credit[]" id="post_credit" multiple="multiple" data-placeholder="Please Select Credit" class="form-control select2" style="width: 100%;">
                        @if($user->count() > 0)
                          @foreach($user as $u)
                            <option value="{{ $u->id }}" @if(in_array($u->id, $selected_user_by_created)) selected @endif> {!! $u->fullname !!} </option>
                          @endforeach
                        @endif
                        </select>
                      @else
                        <select name="post_credit[]" id="post_credit" multiple="multiple" data-placeholder="Please Select Credit" class="form-control select2" style="width: 100%;">
                        @if($user->count() > 0)
                          @foreach($user as $u)
                            <option value="{{ $u->id }}" @if(in_array($u->id, $selected_user_by_created)) selected @endif> {!! $u->fullname !!} </option>
                          @endforeach
                        @endif
                        </select>
                      @endif
                    </div>

                  </div>
                </div>    
              </div>
														
              <div class="tab-features tab-pane" id="c">
                <div class="row">
                  <div class="col-md-12">
                  	<div class="form-group mx-4" style="display: none;">
                      <label for="post_listing">Listing Name</label>
                        <select name="post_listing[]" class="form-control select2" multiple="multiple" data-placeholder="Please Select Listing"
                        style="width: 100%;">
                        @if($listing->count() > 0)
                          @foreach($listing as $l)
                          <option value="{{ $l->id }}">{{ $l->listing_name }}</option>
                          @endforeach
                        @endif
                       </select>
                    </div>
                    <div class="form-group mx-4" style="display: none;">
                      <label for="post_sources">Source</label>
                        <input type="text" placeholder="Source" name="post_sources" class="form-control">
                    </div>
                    <div class="form-group mx-4">
                      <label for="post_gallery">Gallery</label>
                        <select name="post_gallery" class="form-control select2" data-placeholder="Please Select Gallery"
                        style="width: 100%;">
                        <option value="0">Pilih Gallery</option>
                        @if($gallery->count() > 0)
                          @foreach($gallery as $g)
                          <option value="{{ $g->id }}">{{ $g->name }}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="form-group mx-4 {{ $errors->has('post_tag') ? 'has-error' : '' }}">
                      <label for="post_tag">Tag</label>
                      <div class="input-group input-group-sm">
                        <select name="post_tag[]" class="form-control select2" id="selectPostTag" multiple="multiple" data-placeholder="Please Select Tag"
                        style="width: 100%;">
                          @if($tag->count() > 0)
                            @foreach($tag as $t)
                            <option value="{{ $t->id }}" @if(!empty(old('post_tag'))) @if(in_array($t->id, old('post_tag'))) selected @endif @endif>{{ $t->name }}</option>
                            @endforeach
                          @endif
                        </select>
                            <span class="input-group-btn">
                              <!-- <button type="button" data-toggle="modal" data-target="#addDynamicTag" class="btn btn-info btn-flat custom-event-tags">Create Tag</button> -->
                              <button type="button" data-toggle="modal" data-target="#createTagsModal" class="btn btn-info btn-flat custom-create-tags">Create Tag</button>
                            </span>                        
                      </div>
                      @if(!empty($errors->first('post_tag')))
                      <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('post_tag') }}</p>
                      @endif
                    </div>
                    <div class="form-group mx-4" style="display: none;">
                      <label for="post_microsite">Microsite</label>
                        <select name="post_microsite" class="form-control select2" data-placeholder="Please Select Microsite"
                        style="width: 100%;">
                        @if($microsite->count() > 0)
                          @foreach($microsite as $m)
                          <option value="{{ $m->id }}">{{ $m->name }}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                    <!-- <div class="form-group mx-4">
                      <label for="post_status">Status</label>
  	                  <select name="post_status" class="form-control select2" style="width: 100%;">
  	                    <option value="1">Draft</option>
  	                    <option value="2">Editor</option>
  	                    <option value="3">Schedule</option>
  	                    <option value="4">Published</option>
  	                  </select>
                    </div> -->

                    <div class="form-group mx-4">    
                        <label for="post_status">Status</label>
                          <select class="select2 form-control" name="post_status" id="type" style="width: 100%;">
                                  <option value="1" @if(old('post_status') == 1 ) selected @endif>Draft</option>
                                  <option value="2" @if(old('post_status') == 2 ) selected @endif>Editor</option>
                                  <option value="3" @if(old('post_status') == 3 ) selected @endif>Schedule</option>
                                  <option value="4" @if(old('post_status') == 4 ) selected @endif>Published</option>
                          </select>                    
                    </div>
                    <div class="form-group mx-4">
                      <div id="row_dim">
                          <label for="post_published_schedule">Published Schedule</label>
                          <input type="text" name="post_published_schedule" class="form-control pull-right" id="datetimepicker12">
                      </div>
                      <!-- <div id="row_published">
                          <label for="post_date_published">Date Published</label>
                          <input type="text" name="post_date_published" class="form-control pull-right" id="datepublished">
                      </div> -->
                    </div>

                    <div class="form-group mx-4">
                      <label for="post_date_published">Date Published</label>
                      <input type="text" name="post_date_published" class="form-control pull-right" id="datepublished">
                    </div>

                    <div class="form-group mx-4">
                    	<div class="row">
                    		<div class="col-md-4 col-lg-4 col-xs-4">
                    			<label>
				                  <input type="checkbox" name="post_featured" class="flat-red"  value="1">
				                  Featured
				                </label>
                    		</div>
                    		 <div class="col-md-8 col-lg-8 col-xs-8 text-left">                    			
				                <label style="display: none;">
				                  <input type="checkbox" name="post_editor_pick" class="flat-red"  value="1">
				                  Editor Pick
				                </label>
                    		</div>                    		
                    	</div>	                	
                    </div>

                  </div>
                </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    
    <div class="col-md-4">

      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">Type Post</h3>
        </div>
        <div class="box-body">
          <select name="post_type" class="form-control select2" style="width: 100%;">            
            <option value="Video" @if(old('post_type') == 'Video' ) selected @endif>Video</option>
            <option value="Article" @if(old('post_type') == 'Article' ) selected @endif>Article</option>
          </select>
        </div>
      </div>

      <div class="box box-warning">
	        <div class="box-header with-border">
	          <i class="fa fa-text-width"></i>
	          <h3 class="box-title">Post SEO</h3>
	        </div>
	        <div class="box-body">
	              <div class="form-group mx-4">
	                <label for="post_schema">Schema</label>
                  <select name="post_schema" class="form-control select2" style="width: 100%;">
                    <option value="0" @if(old('post_schema') == 0 ) selected @endif>Schema</option>
                    <option value="CreativeWork" @if(old('post_schema') == 'CreativeWork' ) selected @endif>CreativeWork</option>
                    <option value="Article" @if(old('post_schema') == 'Article' ) selected @endif>Article</option>
                    <option value="Video" @if(old('post_schema') == 'Video' ) selected @endif>Video</option>
                    <option value="BlogPosting" @if(old('post_schema') == 'BlogPosting' ) selected @endif>BlogPosting</option>
                    <option value="TechArticle" @if(old('post_schema') == 'TechArticle' ) selected @endif>TechArticle</option>
                    <option value="Report" @if(old('post_schema') == 'Report' ) selected @endif>Report</option>
                    <option value="Review" @if(old('post_schema') == 'Review' ) selected @endif>Review</option>
                  </select>
	              </div>

	              <div class="form-group mx-4 {{ $errors->has('post_meta_title') ? 'has-error' : '' }}">
	                <label for="post_meta_title">Meta Title</label>                
	                  <input type="text" placeholder="Meta Title" name="post_meta_title" class="form-control" value="{{ old('post_meta_title') }}"> 
                    @if(!empty($errors->first('post_meta_title')))
                    <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('post_meta_title') }}</p>
                    @endif
	              </div>

	              <div class="form-group mx-4 {{ $errors->has('post_meta_description') ? 'has-error' : '' }}">
	                <label for="post_meta_description">Meta Description</label>
	                  <textarea name="post_meta_description" placeholder="Meta Description" class="form-control">{{ old('post_meta_description') }}</textarea>
                    @if(!empty($errors->first('post_meta_description')))
                    <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('post_meta_description') }}</p>
                    @endif
	              </div>

	              <div class="form-group mx-4 {{ $errors->has('post_meta_keywords') ? 'has-error' : '' }}">
	                <label for="post_meta_keywords">Meta Keywords</label>
	                  <input type="text" placeholder="Meta Keywords" name="post_meta_keywords" class="form-control" value="{{ old('post_meta_keywords') }}">
                    @if(!empty($errors->first('post_meta_keywords')))
                    <p class="text-red"><i class="icon fa fa-ban"></i> {{ $errors->first('post_meta_keywords') }}</p>
                    @endif
	              </div>

	              <div class="form-group mx-4" style="display: none;">
	                <label for="post_ganalytics_group">GAnalytics Group</label>
	                  <input type="text" placeholder="GAnalytics Group" name="post_ganalytics_group" class="form-control">                
	              </div>
	        </div>
      </div>
      
      <div class="box box-warning" style="display: none;">
	        <div class="box-header with-border">
	          <i class="fa fa-camera"></i>
	          <h3 class="box-title">Post Review</h3>
	        </div>
	        <div class="box-body">
	                <div class="form-group mx-4">
	                  <label for="post_score"> Score</label>
	                    <input type="text" placeholder="Score" name="post_score" class="form-control">
	                </div>

	                <div class="form-group mx-4">
	                  <label for="post_review_pros"> Reviews Pros</label>
	                  <textarea name="post_review_pros" placeholder="Reviews Pros" class="form-control"></textarea>
	                </div>

	                <div class="form-group mx-4">
	                  <label for="post_review_cons"> Reviews Cons</label>
	                  <textarea name="post_review_cons" placeholder="Reviews Cons" class="form-control"></textarea>
	                </div>

	                <div class="form-group mx-4">
	                  <label for="post_summary"> Summaary</label>
	                  <textarea name="post_summary" placeholder="Summary" class="form-control"></textarea>
	                </div>
	        </div>
      </div>

      <div class="box box-warning">
          <div class="box-header with-border">
            <i class="fa fa-camera-retro"></i>
            <h3 class="box-title">Review Embed</h3>
          </div>
          <div class="timeline-body" onload='javascript:(function(o){o.style.height=0.contentWindow.document.body.scrollHeight+"px";}(this));' style="height: 0;">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe id="myIframe" width="230" height="129" src="" frameborder="0" allowfullscreen></iframe>
            </div>
          </div>
      </div>

    </div>
      
  </div>
	<input type="hidden" name="hf_post_type" id="hf_post_type" value="add_post">
</form>
<!-- Pop Up Create Tag -->
{{-- <div class="modal fade" id="addDynamicTag" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
  <div class="modal-dialog add-cat-dialog">
    <div class="ajax-overlay"></div>
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
        <br>
        <i class="icon-credit-card icon-7x"></i>
        <p class="no-margin top-title-tag"><b>Create New Tag</b></p>
      </div>
      <div class="modal-body">
        <div class="custom-model-row">
          <div class="custom-input-group">
            <div class="custom-input-label"><label for="inputTagName">Name</label></div>
            <div class="custom-input-element">
              <input oninput="inputName()" type="text" placeholder="Name" id="inputTagName" name="inputTagName" class="form-control">
              <p id="alertName" class="text-red"><i class="icon fa fa-ban"></i> Name can't be empty</p>
            </div>
          </div>
          <div class="custom-input-group">
            <div class="custom-input-label"><label for="inputTagSlug">Slug</label></div>
            <div class="custom-input-element">
              <input type="text" placeholder="Slug" id="inputTagSlug" name="inputTagSlug" class="form-control" readonly>
              <p id="alertSlug" class="text-red"><i class="icon fa fa-ban"></i> Slug can't be empty</p>
            </div>
          </div>
          <div class="custom-input-group">
            <div class="custom-input-label"><label for="inputTagGroup">Group</label></div>
            <div class="custom-input-element"><input type="text" placeholder="Group" id="inputTagGroup" name="inputTagGroup" class="form-control">
            </div>
          </div>
          <div class="custom-input-group">
            <div class="custom-input-label"><label for="inputTagDescription">Description</label></div>
            <div class="custom-input-element">
              <textarea class="form-control" name="inputTagDescription" id="inputTagDescription" placeholder="Description"></textarea>
            </div>
          </div>
          <div class="custom-input-group">
            <div class="custom-input-label"><label for="inputTagOfficial">Official</label></div>
            <div class="custom-input-element">
              <select name="tag_official" id="tag_official" class="form-control select2" style="width: 100%;">
                <option value="0">No</option>
                <option value="1">Yes</option>
              </select>
            </div>
          </div>
          <div class="custom-input-group" style="display: none;">
            <div class="custom-input-label"><label for="inputTagSchema">Schema</label></div>
            <div class="custom-input-element"><input type="hidden" placeholder="Schema" id="inputTagSchema" name="inputTagSchema" class="form-control"></div>
          </div>
          <div class="custom-input-group" style="display: none;">
            <div class="custom-input-label"><label for="inputTagMetaTitle">Meta Title</label></div>
            <div class="custom-input-element"><input type="hidden" placeholder="Meta Title" id="inputTagMetaTitle" name="inputTagMetaTitle" class="form-control">
            </div>
          </div>              
          <div class="custom-input-group" style="display: none;">
            <div class="custom-input-label"><label for="inputTagMetaDescription">Meta Description</label></div>
            <div class="custom-input-element">
              <textarea class="form-control" name="inputTagMetaDescription" id="inputTagMetaDescription" placeholder="Meta Description"></textarea>
            </div>
          </div>
          <div class="custom-input-group" style="display: none;">
            <div class="custom-input-label"><label for="inputTagMetaKeywords">Meta Keywords</label></div>
            <div class="custom-input-element"><input type="text" placeholder="Meta Keywords" id="inputTagMetaKeywords" name="inputTagMetaKeywords" class="form-control">
            </div>
          </div>
        </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default attachtopost create-tag">Create Tag</button>
        <button type="button" class="btn btn-default attachtopost" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> --}}

<!-- Modal -->
<div class="modal fade" id="createTagsModal" tabindex="-1" role="dialog" aria-labelledby="createTagsModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title text-center" id="createTagsModalLabel">Create Tag</h4>
    </div>
    <form id="formSaveProductTag" method="POST" class="form-horizontal" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="custom-input-group">
            <div class="custom-input-label"><label for="inputTagName">Name</label></div>
            <div class="custom-input-element">
              <input oninput="inputName()" type="text" placeholder="Name" id="inputTagName" name="inputTagName" class="form-control">
              <p id="alertName" class="text-red"><i class="icon fa fa-ban"></i> Name can't be empty</p>
            </div>
        </div>
        <div class="custom-input-group">
          <div class="custom-input-label"><label for="inputTagSlug">Slug</label></div>
          <div class="custom-input-element">
            <input type="text" placeholder="Slug" id="inputTagSlug" name="inputTagSlug" class="form-control" readonly>
            <p id="alertSlug" class="text-red"><i class="icon fa fa-ban"></i> Slug can't be empty</p>
          </div>
        </div>
        <div class="custom-input-group">
          <div class="custom-input-label"><label for="inputTagGroup">Group</label></div>
          <div class="custom-input-element"><input type="text" placeholder="Group" id="inputTagGroup" name="inputTagGroup" class="form-control">
          </div>
        </div>
        <div class="custom-input-group">
          <div class="custom-input-label"><label for="inputTagDescription">Description</label></div>
          <div class="custom-input-element">
            <textarea class="form-control" name="inputTagDescription" id="inputTagDescription" placeholder="Description"></textarea>
          </div>
        </div>
        <div class="custom-input-group" style="display: none;">
          <div class="custom-input-label"><label for="inputTagOfficial">Official</label></div>
          <div class="custom-input-element">
            <select name="tag_official" id="tag_official" class="form-control select2" style="width: 100%;">
              <option value="0">No</option>
              <option value="1">Yes</option>
            </select>
          </div>
        </div>
        <div class="custom-input-group" style="display: none;">
          <div class="custom-input-label"><label for="inputTagSchema">Schema</label></div>
          <div class="custom-input-element"><input type="hidden" placeholder="Schema" id="inputTagSchema" name="inputTagSchema" class="form-control"></div>
        </div>
        <div class="custom-input-group" style="display: none;">
          <div class="custom-input-label"><label for="inputTagMetaTitle">Meta Title</label></div>
          <div class="custom-input-element"><input type="hidden" placeholder="Meta Title" id="inputTagMetaTitle" name="inputTagMetaTitle" class="form-control">
          </div>
        </div>              
        <div class="custom-input-group" style="display: none;">
          <div class="custom-input-label"><label for="inputTagMetaDescription">Meta Description</label></div>
          <div class="custom-input-element">
            <textarea class="form-control" name="inputTagMetaDescription" id="inputTagMetaDescription" placeholder="Meta Description"></textarea>
          </div>
        </div>
        <div class="custom-input-group" style="display: none;">
          <div class="custom-input-label"><label for="inputTagMetaKeywords">Meta Keywords</label></div>
          <div class="custom-input-element"><input type="text" placeholder="Meta Keywords" id="inputTagMetaKeywords" name="inputTagMetaKeywords" class="form-control">
          </div>
        </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create Tag</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- MOdal -->
<input type="hidden" name="hf_from_model" id="hf_from_model" value="">
<input type="hidden" name="hf_update_id" id="hf_update_id" value="">
<!-- \Pop Up Create Tag -->
@endsection