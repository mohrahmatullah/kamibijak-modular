var kamibijak = kamibijak || {};

kamibijak.pageLoad =
{
  elementLoad:function()
  {
    $('#addDynamicCategories').on('hidden.bs.modal', function () 
    {
      kamibijak.pageLoad.cat_popup_element_clear();
    });

    $('#addDynamicTag').on('hidden.bs.modal', function () 
    {
      kamibijak.pageLoad.tag_popup_element_clear();
    });

    $('#addDynamicBanner').on('hidden.bs.modal', function () 
    {
      kamibijak.pageLoad.banner_popup_element_clear();
    });

    $('#addDynamicPage').on('hidden.bs.modal', function () 
    {
      kamibijak.pageLoad.page_popup_element_clear();
    });

    $('#addDynamicParam').on('hidden.bs.modal', function () 
    {
      kamibijak.pageLoad.param_popup_element_clear();
    });
  },

  cat_popup_element_clear:function()
  {
    $('#name, #slug, #description, #color, #schema, #metatitle, #metadescription, #metakeywords').val('');
    
    $("#cat_parent option").each(function(){
      if($(this).attr('disabled'))
      {
        $(this).removeAttr('disabled');
      }
    });

    $('#cat_parent').select2();

    $('.img-div-default').show();
    $('.covercat-picture').hide();

    $('.img-div-default-avatarcat').show();
    $('.avatarcat-picture').hide();

    $('.img-div-default-iconcat').show();
    $('.iconcat-picture').hide();

    $('#cat_parent').select2('val', 0);
    $('#name').css({'border':'1px solid #d2d6de'});
    $('#slug').css({'border':'1px solid #d2d6de'});
  },

  tag_popup_element_clear:function()
  {
    $('#inputTagName, #inputTagSlug, #inputTagGroup, #inputTagDescription , #inputTagSchema, #inputTagMetaTitle , #inputTagMetaDescription, #inputTagMetaKeywords').val('');
    $('#tag_official').select2('val', 1);
    $('#inputTagName').css({'border':'1px solid #d2d6de'});
    $('#inputTagSlug').css({'border':'1px solid #d2d6de'});
  },

  banner_popup_element_clear:function()
  {
    $('#inputBannerName, #inputBannerPlacement, #inputBannerTimestart, #inputBannerExpired , #inputBannerLink , #inputBannerWebsite, #inputBannerCode').val('');

    $('.img-div-default-mediabanner').show();
    $('.mediabanner-picture').hide();

    $('.img-div-default-videobanner').show();
    $('.videobanner-picture').hide();

    $('#inputBannerName').css({'border':'1px solid #d2d6de'});
    $('#inputBannerPlacement').css({'border':'1px solid #d2d6de'});
  },

  page_popup_element_clear:function()
  {
    $('#inputPageTitle, #inputPageSlug, #inputPageContent , #inputPageSchema, #inputPageMetaTitle , #inputPageMetaDescription, #inputPageMetaKeywords').val('');
    CKEDITOR.instances.inputPageContent.setData();
    $('#inputPageTitle').css({'border':'1px solid #d2d6de'});
    $('#inputPageSlug').css({'border':'1px solid #d2d6de'});
  },

  param_popup_element_clear:function()
  {

    document.getElementById("inputParamName").readOnly = false;
    $('#inputParamName, #inputParamValue').val('');
  
    $('#inputParamName').css({'border':'1px solid #d2d6de'});
  }

};

kamibijak.event = 
{
  createCat:function()
  {
    if($('.create-cat').length>0)
    {
      $('.create-cat').click(function()
      {               
        if($('#name').val() == '' || $('#name').val() == null || $('#name').val().length == 0)
        {
          $('#name').css({'border':'2px solid #dc3232'});
          $('#alertName').show();
        }
        else if($('#name').val() != '' || $('#name').val() != null || $('#name').val().length != 0)
        {
          $('#name').css({'border':'2px solid #d2d6de'});
          $('#alertName').hide();
        }
        
        if($('#slug').val() == '' || $('#slug').val() == null || $('#slug').val().length == 0)
        {
          $('#slug').css({'border':'2px solid #dc3232'});
          $('#alertSlug').show();
        }
        else if($('#slug').val() != '' || $('#slug').val() != null || $('#slug').val().length != 0)
        {
          $('#slug').css({'border':'2px solid #d2d6de'});
          $('#alertSlug').hide();
        }
        
        if(($('#name').val() != '' && $('#slug').val() != '' && $('#name').val().length != 0 && $('#slug').val().length != 0 ) || ($('#name').val() != null && $('#slug').val() != null && $('#name').val().length != 0 && $('#slug').val().length != 0))
        {
          kamibijak.ajaxRequest.add_new_cat();
        }
      });
    }
  },

  createTag:function(){
    if($('.create-tag').length>0){
      $('.create-tag').click(function(){               
        if($('#inputTagName').val() == '' || $('#inputTagName').val() == null || $('#inputTagName').val().length == 0){
          $('#inputTagName').css({'border':'2px solid #dc3232'});
          $('#alertName').show();
        }
        else if($('#inputTagName').val() != '' || $('#inputTagName').val() != null || $('#inputTagName').val().length != 0){
          $('#inputTagName').css({'border':'2px solid #d2d6de'});
          $('#alertName').hide();
        }
        
        if($('#inputTagSlug').val() == '' || $('#inputTagSlug').val() == null || $('#inputTagSlug').val().length == 0)
        {
          $('#inputTagSlug').css({'border':'2px solid #dc3232'});
          $('#alertSlug').show();
        }
        else if($('#inputTagSlug').val() != '' || $('#inputTagSlug').val() != null || $('#inputTagSlug').val().length != 0)
        {
          $('#inputTagSlug').css({'border':'2px solid #d2d6de'});
          $('#alertSlug').hide();
        }
        
        if(($('#inputTagName').val() != '' && $('#inputTagSlug').val() != '' && $('#inputTagName').val().length != 0 && $('#inputTagSlug').val().length != 0 ) || ($('#inputTagName').val() != null && $('#inputTagSlug').val() != null && $('#inputTagName').val().length != 0 && $('#inputTagSlug').val().length != 0))
        {
          kamibijak.ajaxRequest.add_new_tag();
        }

      });
    }
  },

  createBanner:function(){
    if($('.create-banner').length>0){
      $('.create-banner').click(function(){               
        if($('#inputBannerName').val() == '' || $('#inputBannerName').val() == null || $('#inputBannerName').val().length == 0){
          $('#inputBannerName').css({'border':'2px solid #dc3232'});
          $('#alertName').show();
        }
        else if($('#inputBannerName').val() != '' || $('#inputBannerName').val() != null || $('#inputBannerName').val().length != 0){
          $('#inputBannerName').css({'border':'2px solid #d2d6de'});
          $('#alertName').hide();
        }

        if($('#inputBannerPlacement').val() == '' || $('#inputBannerPlacement').val() == null || $('#inputBannerPlacement').val().length == 0)
        {
          $('#inputBannerPlacement').css({'border':'2px solid #dc3232'});
          $('#alertPlacement').show();
        }
        else if($('#inputBannerPlacement').val() != '' || $('#inputBannerPlacement').val() != null || $('#inputBannerPlacement').val().length != 0)
        {
          $('#inputBannerPlacement').css({'border':'2px solid #d2d6de'});
          $('#alertPlacement').hide();
        }

        if(($('#inputBannerName').val() != '' && $('#inputBannerPlacement').val() != '' && $('#inputBannerName').val().length != 0 && $('#inputBannerPlacement').val().length != 0 ) || ($('#inputBannerName').val() != null && $('#inputBannerPlacement').val() != null && $('#inputBannerName').val().length != 0 && $('#inputBannerPlacement').val().length != 0))
        {
          kamibijak.ajaxRequest.add_new_banner();
        }

      });
    }
  },

  createPage:function(){
    if($('.create-page').length>0){
      $('.create-page').click(function(){               
        if($('#inputPageTitle').val() == '' || $('#inputPageTitle').val() == null || $('#inputPageTitle').val().length == 0){
          $('#inputPageTitle').css({'border':'2px solid #dc3232'});
          $('#alertName').show();
        }
        else if($('#inputPageTitle').val() != '' || $('#inputPageTitle').val() != null || $('#inputPageTitle').val().length != 0){
          $('#inputPageTitle').css({'border':'2px solid #d2d6de'});
          $('#alertName').hide();
        }
        
        if($('#inputPageSlug').val() == '' || $('#inputPageSlug').val() == null || $('#inputPageSlug').val().length == 0)
        {
          $('#inputPageSlug').css({'border':'2px solid #dc3232'});
          $('#alertSlug').show();
        }
        else if($('#inputPageSlug').val() != '' || $('#inputPageSlug').val() != null || $('#inputPageSlug').val().length != 0)
        {
          $('#inputPageSlug').css({'border':'2px solid #d2d6de'});
          $('#alertSlug').hide();
        }
        
        if(($('#inputPageTitle').val() != '' && $('#inputPageSlug').val() != '' && $('#inputPageTitle').val().length != 0 && $('#inputPageSlug').val().length != 0 ) || ($('#inputPageTitle').val() != null && $('#inputPageSlug').val() != null && $('#inputPageTitle').val().length != 0 && $('#inputPageSlug').val().length != 0))
        {
          kamibijak.ajaxRequest.add_new_page();
        }

      });
    }
  },

  createParam:function(){
    if($('.create-param').length>0){
      $('.create-param').click(function(){               
        if($('#inputParamName').val() == '' || $('#inputParamName').val() == null || $('#inputParamName').val().length == 0){
          $('#inputParamName').css({'border':'2px solid #dc3232'});
          $('#alertName').show();
        }
        else if($('#inputParamName').val() != '' || $('#inputParamName').val() != null || $('#inputParamName').val().length != 0){
          $('#inputParamName').css({'border':'2px solid #d2d6de'});
          $('#alertName').hide();
        }
        
        if(($('#inputParamName').val() != '' && $('#inputParamName').val().length != 0 ) || ($('#inputParamName').val() != null && $('#inputParamName').val().length != 0 ))
        {
          kamibijak.ajaxRequest.add_new_param();
        }

      });
    }
  },

  model_event:function()
  {
    if($('.custom-event').length>0)
    {
      $('.custom-event').click(function()
      {
        $('#hf_from_model').val('for_add');
        $('#hf_update_id').val('');
        $('#addDynamicCategories .top-title').html( '<b>Create New Category</b>' );
        $('#addDynamicCategories .create-cat').html( 'Create Category' );

        $('#alertName').hide();
        $('#alertSlug').hide();
      });
    }  
  },

  model_event_tag:function()
  {
    if($('.custom-event-tags').length>0)
    {
      $('.custom-event-tags').click(function()
      {
        $('#hf_from_model').val('for_add');
        $('#hf_update_id').val('');
        $('#addDynamicTag .top-title-tag').html( '<b>Create New Tag</b>' );
        $('#addDynamicTag .create-tag').html( 'Create Tag' );

        $('#alertName').hide();
        $('#alertSlug').hide();
      });
    }  
  },

  model_create_tag:function()
  {
    if($('.custom-create-tags').length>0)
    {
      $('.custom-create-tags').click(function()
      {
        $('#inputTagName').val('');
        $('#inputTagSlug').val('');
        $('#inputTagGroup').val('');
        $('#inputTagDescription').val('');
        
        $('#inputTagName').css({'border':'1px solid #ccc'});
        $('#inputTagSlug').css({'border':'1px solid #ccc'});


        $('#alertName').hide();
        $('#alertSlug').hide();
      });
    }  
  },

  model_event_banner:function()
  {
    if($('.custom-event-banner').length>0)
    {
      $('.custom-event-banner').click(function()
      {
        $('#hf_from_model').val('for_add');
        $('#hf_update_id').val('');
        $('#addDynamicBanner .top-title-banner').html( '<b>Create New Banner</b>' );
        $('#addDynamicBanner .create-banner').html( 'Create Banner' );

        $('#alertName').hide();
        $('#alertPlacement').hide();
      });
    }  
  },

  model_event_page:function()
  {
    if($('.custom-event-page').length>0)
    {
      $('.custom-event-page').click(function()
      {
        $('#hf_from_model').val('for_add');
        $('#hf_update_id').val('');
        $('#addDynamicPage .top-title-page').html( '<b>Create New Page</b>' );
        $('#addDynamicPage .create-page').html( 'Create Page' );

        $('#alertName').hide();
        $('#alertSlug').hide();
      });
    }  
  },

  model_event_param:function()
  {
    if($('.custom-event-param').length>0)
    {
      $('.custom-event-param').click(function()
      {
        $('#hf_from_model').val('for_add');
        $('#hf_update_id').val('');
        $('#addDynamicParam .top-title-param').html( '<b>Create New Param</b>' );
        $('#addDynamicParam .create-param').html( 'Create Param' );
        document.getElementById("inputParamName").readOnly = false;


        $('#alertName').hide();
      });
    }  
  },

  item_delete_from_list:function()
  {
   if($('.remove-selected-data-from-list').length>0)
   {
     $('.remove-selected-data-from-list').on("click", function(e)
     {
      e.preventDefault();
      var item_id = null;
      
      if (typeof $(this).data('item_id') !== 'undefined')
      {
        item_id = $(this).data('item_id');
      }

       kamibijak.warningMessage.deleteConfirmation( $(this).data('id'), item_id, $(this).data('track_name') );
     });
   }
  },

  item_change_from_list:function()
  {
   if($('.change-selected-data-from-list').length>0)
   {
     $('.change-selected-data-from-list').on("click", function(e)
     {
      e.preventDefault();
      var item_id = null;
      
      if (typeof $(this).data('item_id') !== 'undefined')
      {
        item_id = $(this).data('item_id');
      }

       kamibijak.warningMessage.changeConfirmation( $(this).data('id'), item_id, $(this).data('track_name') );
     });
   }
  },

  edit_panel_display:function()
  {
    if($('.edit-data').length>0)
    {
      $('.edit-data').click(function(e)
      {
        e.preventDefault();
        // $('#selected_variation_id').val($(this).data('id'));
        kamibijak.ajaxRequest.get_edit_data( $(this).data('id'), $(this).data('track_name') );
      });
    }
  },

  notification_apps:function()
  {
    if($('.notif-to-apps').length>0)
    {
      $('.notif-to-apps').click(function(e)
      {
        
        kamibijak.ajaxRequest.get_notif_data( $(this).data('id'), $(this).data('track_name') );
      });
    }
  }

};

kamibijak.ajaxRequest = 
{
  add_new_cat:function(){
    $('.ajax-overlay').show();
    var name         = '';
    var slug         = '';
    var parent       = 0;
    var cover       = '';
    var avatar       = '';
    var icon       = '';
    var description  = '';
    var color  = '';
    var schema       = '';
    var metatitle    = '';
    var metadescription = '';
    var metakeywords = '';
    var cat_for      = '';
    var dataObj      = {};
    
    if($('#name').val().length >0){
      name  =   $('#name').val();
    }
    
    if($('#slug').val().length>0){
      slug  =   $('#slug').val();
    }
    
    if($('#cat_parent :selected').val().length > 0 && $('#cat_parent :selected').val() > 0){
      parent =   $('#cat_parent :selected').val();
    }
    
    if($('#description').val().length>0){
      description    =   $('#description').val();
    }

    if($('#hf_cms_covercat_picture').val().length>0){
      cover  =   $('#hf_cms_covercat_picture').val();
    }

    if($('#hf_cms_avatarcat_picture').val().length>0){
      avatar  =   $('#hf_cms_avatarcat_picture').val();
    }

    if($('#hf_cms_iconcat_picture').val().length>0){
      icon  =   $('#hf_cms_iconcat_picture').val();
    }

    if($('#hf_cms_covergal_picture').val().length>0){
      cover  =   $('#hf_cms_covergal_picture').val();
    }
    
    if($('#color').val().length>0){
      color    =   $('#color').val();
    }
    
    if($('#schema').val().length>0){
      schema    =   $('#schema').val();
    }
    
    if($('#metatitle').val().length>0){
      metatitle    =   $('#metatitle').val();
    }
    
    if($('#metadescription').val().length>0){
      metadescription    =   $('#metadescription').val();
    }
    
    if($('#metakeywords').val().length>0){
      metakeywords    =   $('#metakeywords').val();
    }
    
    if($('#hf_cat_post_for').val().length>0){
      cat_for = $('#hf_cat_post_for').val();
    }
    
    dataObj.name          =   name;
    dataObj.slug          =   slug;
    dataObj.parent        =   parent;
    dataObj.description   =   description;
    dataObj.color   =   color;
    dataObj.cover   =   cover;
    dataObj.avatar   =   avatar;
    dataObj.icon   =   icon;
    dataObj.schema          =   schema;
    dataObj.metatitle          =   metatitle;
    dataObj.metadescription   =   metadescription;
    dataObj.metakeywords = metakeywords;
    dataObj.cat_for       =   cat_for;
    dataObj.click_source  =   $('#hf_from_model').val();
    dataObj.id            =   $('#hf_update_id').val();
    // console.log(dataObj);

    $.ajax({
          url: $('#hf_base_url').val() + '/ajax/add-cat',
          type: 'POST',
          cache: false,
          // contentType: 'application/json; charset=utf-8',
          dataType: 'json',
          data: {data:dataObj},
          // jsonpCallback: "onJSONPLoad",
          headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
          success: function(data){
            // console.log(json);
            if(data.error_no_entered == false){
              swal("" , "name and slug field are required");
            }
            else if(data.error_duplicate_slug == false){
              swal("" , "sorry, slug already exists");         
            }
            else if(data.success == true){      
              $('#addDynamicCategories').modal('hide');
              window.location.href = window.location.href;
              kamibijak.normalFunction.successMsg();
            }
            
            $('.ajax-overlay').hide();
          },
          error:function(){}
    });
  },

  add_new_tag:function(){
    $('.ajax-overlay').show();
    var name         = '';
    var slug         = '';
    var group         = '';
    var description  = '';
    var schema         = '';
    var metatitle         = '';
    var metadescription         = '';
    var metakeywords         = '';
    var dataObj      = {};
    
    if($('#inputTagName').val().length >0){
      name   =   $('#inputTagName').val();
    }

    if($('#inputTagSlug').val().length >0){
      slug   =   $('#inputTagSlug').val();
    }

    if($('#inputTagGroup').val().length >0){
      group   =   $('#inputTagGroup').val();
    }
   
    if($('#inputTagDescription').val().length>0){
      description    =   $('#inputTagDescription').val();
    }

    official           =   $('#tag_official :selected').val();

    if($('#inputTagSchema').val().length >0){
      schema   =   $('#inputTagSchema').val();
    }
    
    if($('#inputTagMetaTitle').val().length >0){
      metatitle   =   $('#inputTagMetaTitle').val();
    }

    if($('#inputTagMetaDescription').val().length >0){
      metadescription   =   $('#inputTagMetaDescription').val();
    }

    if($('#inputTagMetaKeywords').val().length >0){
      metakeywords   =   $('#inputTagMetaKeywords').val();
    }
    
    dataObj.name          =   name;
    dataObj.slug          =   slug;
    dataObj.group         =   group;
    dataObj.description   =   description;
    dataObj.official   =   official;
    dataObj.schema        =   schema;
    dataObj.metatitle     =   metatitle;
    dataObj.metadescription =   metadescription;
    dataObj.metakeywords  =   metakeywords;
    dataObj.click_source  =   $('#hf_from_model').val();
    dataObj.id            =   $('#hf_update_id').val();

    $.ajax({
          url: $('#hf_base_url').val() + '/ajax/add-tag',
          type: 'POST',
          cache: false,
          // contentType: 'application/json; charset=utf-8',
          datatype: 'json',
          data: {data:dataObj},
          headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
          success: function(data){
            if(data.error_no_entered == false){
              swal("" , "name and slug field are required");
            }
            else if(data.error_duplicate_slug == false){
              swal("" , "sorry, slug already exists");         
            }
            else if(data.success == true){      
              $('#addDynamicTag').modal('hide');
              window.location.href = window.location.href;
              kamibijak.normalFunction.successMsg();
            }
            $('.ajax-overlay').hide();
          },
          error:function(){}
    });
  },

  add_new_banner:function(){
    $('.ajax-overlay').show();
    var name         = '';
    var placement         = '';
    var timestart         = '';
    var expired  = '';
    var media  = '';
    var video  = '';
    var link         = '';
    var website         = '';
    var code         = '';
    var dataObj      = {};
    
    if($('#inputBannerName').val().length >0){
      name   =   $('#inputBannerName').val();
    }

    if($('#inputBannerPlacement').val().length >0){
      placement   =   $('#inputBannerPlacement').val();
    }

    if($('#inputBannerTimestart').val().length >0){
      timestart   =   $('#inputBannerTimestart').val();
    }

    if($('#hf_cms_mediabanner_picture').val().length >0){
      media   =   $('#hf_cms_mediabanner_picture').val();
    }

    if($('#hf_cms_videobanner_picture').val().length >0){
      video   =   $('#hf_cms_videobanner_picture').val();
    }

    if($('#inputBannerExpired').val().length >0){
      expired   =   $('#inputBannerExpired').val();
    }
    
    if($('#inputBannerLink').val().length >0){
      link   =   $('#inputBannerLink').val();
    }

    if($('#inputBannerWebsite').val().length >0){
      website   =   $('#inputBannerWebsite').val();
    }

    if($('#inputBannerCode').val().length >0){
      code   =   $('#inputBannerCode').val();
    }
    
    dataObj.name          =   name;
    dataObj.placement          =   placement;
    dataObj.timestart         =   timestart;
    dataObj.expired   =   expired;
    dataObj.media   =   media;
    dataObj.video   =   video;
    dataObj.link   =   link;
    dataObj.website   =   website;
    dataObj.code        =   code;
    dataObj.click_source  =   $('#hf_from_model').val();
    dataObj.id            =   $('#hf_update_id').val();

    $.ajax({
          url: $('#hf_base_url').val() + '/ajax/add-banner',
          type: 'POST',
          cache: false,
          // contentType: 'application/json; charset=utf-8',
          datatype: 'json',
          data: {data:dataObj},
          headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
          success: function(data){
            if(data.error_no_entered == false){
              swal("" , "name and slug field are required");
            }
            else if(data.error_duplicate_slug == false){
              swal("" , "sorry, slug already exists");         
            }
            else if(data.success == true){      
              $('#addDynamicBanner').modal('hide');
              kamibijak.normalFunction.successMsg();
              window.location.href = window.location.href;
            }
            $('.ajax-overlay').hide();
          },
          error:function(){}
    });
  },

  add_new_page:function(){
    $('.ajax-overlay').show();
    var title         = '';
    var slug         = '';
    var content  = '';
    var schema         = '';
    var metatitle         = '';
    var metadescription         = '';
    var metakeywords         = '';
    var dataObj      = {};
    
    if($('#inputPageTitle').val().length >0){
      title   =   $('#inputPageTitle').val();
    }

    if($('#inputPageSlug').val().length >0){
      slug   =   $('#inputPageSlug').val();
    }
   
    if(CKEDITOR.instances['inputPageContent'].getData().length>0){
      content    =   CKEDITOR.instances['inputPageContent'].getData()
    }

    if($('#inputPageSchema').val().length >0){
      schema   =   $('#inputPageSchema').val();
    }
    
    if($('#inputPageMetaTitle').val().length >0){
      metatitle   =   $('#inputPageMetaTitle').val();
    }

    if($('#inputPageMetaDescription').val().length >0){
      metadescription   =   $('#inputPageMetaDescription').val();
    }

    if($('#inputPageMetaKeywords').val().length >0){
      metakeywords   =   $('#inputPageMetaKeywords').val();
    }
    
    dataObj.title          =   title;
    dataObj.slug          =   slug;
    dataObj.content   =   content;
    dataObj.schema        =   schema;
    dataObj.metatitle     =   metatitle;
    dataObj.metadescription =   metadescription;
    dataObj.metakeywords  =   metakeywords;
    dataObj.click_source  =   $('#hf_from_model').val();
    dataObj.id            =   $('#hf_update_id').val();

    $.ajax({
          url: $('#hf_base_url').val() + '/ajax/add-page',
          type: 'POST',
          cache: false,
          // contentType: 'application/json; charset=utf-8',
          datatype: 'json',
          data: {data:dataObj},
          headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
          success: function(data){
            if(data.error_no_entered == false){
              swal("" , "name and slug field are required");
            }
            else if(data.error_duplicate_slug == false){
              swal("" , "sorry, slug already exists");         
            }
            else if(data.success == true){      
              $('#addDynamicPage').modal('hide');
              window.location.href = window.location.href;
              kamibijak.normalFunction.successMsg();
            }
            $('.ajax-overlay').hide();
          },
          error:function(){}
    });
  },

  add_new_param:function(){
    $('.ajax-overlay').show();
    var name         = '';
    var value         = '';
    var dataObj      = {};
    
    if($('#inputParamName').val().length >0){
      name   =   $('#inputParamName').val();
    }

    if($('#inputParamValue').val().length >0){
      value   =   $('#inputParamValue').val();
    }
    
    dataObj.name          =   name;
    dataObj.value          =   value;
    dataObj.click_source  =   $('#hf_from_model').val();
    dataObj.id            =   $('#hf_update_id').val();
    // console.log(dataObj);

    $.ajax({
          url: $('#hf_base_url').val() + '/ajax/add-param',
          type: 'POST',
          cache: false,
          // contentType: 'application/json; charset=utf-8',
          datatype: 'json',
          data: {data:dataObj},
          headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
          success: function(data){
            if(data.error_no_entered == false){
              swal("" , "name and slug field are required");
            }
            else if(data.error_duplicate_slug == false){
              swal("" , "sorry, slug already exists");         
            }
            else if(data.success == true){      
              $('#addDynamicParam').modal('hide');
              window.location.href = window.location.href;
              kamibijak.normalFunction.successMsg();
            }
            $('.ajax-overlay').hide();
          },
          error:function(){}
    });
  },

  get_edit_data:function(id, track){
    $('.eb-overlay').show();
    $('.eb-overlay-loader').show();
    var base_url_image = $('#base_url_image').val();
    // var get_roles;
    
    // if($('#hf_available_user_roles').length>0 && $('#hf_available_user_roles').val().length >0){
    //   get_roles = JSON.parse($('#hf_available_user_roles').val());
    // }
    
    var dataObj    = {};
    dataObj.id     =  id;
    dataObj.track  =  track;
    
    $.ajax({
          url: $('#hf_base_url').val() + '/ajax/edit-data',
          type: 'POST',
          cache: false,
          datatype: 'json',
          data: {data:dataObj},
          headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
          success: function(data){
            // console.log(data);
            if(data.success == true){
              if( track == 'cat_list' ){
                $('#name').val( data.name );
                $('#slug').val( data.slug );
                $('#hf_cms_covercat_picture').val( data.cover );
                $('#hf_cms_avatarcat_picture').val( data.avatar );
                $('#hf_cms_iconcat_picture').val( data.icon );
                $('#hf_cms_covergal_picture').val( data.covergal );

                if(data.cover)
                {
                  $('.covercat-picture').show();
                  $('.img-div img').attr('src', base_url_image + data.cover);
                  $('.btn-div').show();
                  $('.img-div').show();                  
                  $('.img-div-default').hide();
                }

                if(data.avatar)
                {
                  $('.avatarcat-picture').show();
                  $('.img-div-avatarcat img').attr('src', base_url_image + data.avatar);
                  $('.btn-div-avatarcat').show();
                  $('.img-div-avatarcat').show();
                  $('.img-div-default-avatarcat').hide();
                }

                if(data.icon)
                {
                  $('.iconcat-picture').show();
                  $('.img-div-iconcat img').attr('src', base_url_image + data.icon);
                  $('.btn-div-iconcat').show();
                  $('.img-div-iconcat').show();
                  $('.img-div-default-iconcat').hide();
                }

                if(data.covergal)
                {
                  $('.covergal-picture').show();
                  $('.img-div img').attr('src', base_url_image + data.covergal);
                  $('.btn-div').show();
                  $('.img-div').show();                  
                  $('.img-div-default').hide();
                }
                
                $("#cat_parent option").each(function(){
                  if($(this).attr('disabled'))
                  {
                    $(this).removeAttr('disabled');
                  }
                });
                
                $('#cat_parent').select2();
                
                $("#cat_parent option[value='"+ id +"']").attr('disabled','disabled');
                $('#cat_parent').select2('val', data.parent);
                $('#description').val( data.description ); 
                $('#hf_cms_covercat_picture').val( data.cover );               
                $('#color').val( data.color );
                $('#schema').val( data.schema );
                $('#metatitle').val( data.metatitle );
                $('#metadescription').val( data.metadescription );
                $('#metakeywords').val( data.metakeywords );
              
                $('#addDynamicCategories .top-title').html( "<b>Update Category</b>" );
                $('#addDynamicCategories .create-cat').html( "Update Category" );
                $('#hf_update_id').val( id );
                $('#hf_from_model').val('for_update');
                $('#addDynamicCategories').modal('show');
                $('#alertName').hide();
                $('#alertSlug').hide();
              }
              else if( track == 'tag_list' ){
                $('#inputTagName').val( data.name );
                $('#inputTagSlug').val( data.slug );
                $('#inputTagGroup').val( data.group );
                $('#inputTagDescription').val( data.description );
                $('#tag_official').select2('val', data.official);
                $('#inputTagSchema').val( data.schema );
                $('#inputTagMetaTitle').val( data.metatitle );
                $('#inputTagMetaDescription').val(data.metadescription);                
                $('#inputTagMetaKeywords').val( data.metakeywords );
                
                $('#addDynamicTag .top-title-tag').html( "<b>Update Post Tag</b>" );
                $('#addDynamicTag .create-tag').html( "Update Tag" );
                $('#hf_update_id').val( id );
                $('#hf_from_model').val('for_update');
                $('#addDynamicTag').modal('show');
                $('#alertName').hide();
                $('#alertSlug').hide();
                // console.log(data);
              }
              else if( track == 'banner_list' ){
                $('#inputBannerName').val( data.name );
                $('#inputBannerPlacement').val( data.placement );
                $('#inputBannerTimestart').val( data.timestart );
                $('#inputBannerExpired').val( data.expired );
                $('#inputBannerLink').val( data.link );
                $('#inputBannerWebsite').val( data.website );
                $('#inputBannerCode').val( data.code );
                $('#hf_cms_mediabanner_picture').val( data.media );
                $('#hf_cms_videobanner_picture').val( data.video );

                if(data.media)
                {
                  $('.mediabanner-picture').show();
                  $('.img-div-mediabanner img').attr('src', base_url_image + 'images/banner/' + data.media);
                  $('.btn-div-mediabanner').show();
                  $('.img-div-mediabanner').show();
                  $('.img-div-default-mediabanner').hide();
                }

                if(data.video)
                {
                  $('.videobanner-picture').show();
                  $('.img-div-videobanner video').attr('src', base_url_image + data.video);
                  $('.btn-div-videobanner').show();
                  $('.img-div-videobanner').show();
                  $('.img-div-default-videobanner').hide();
                }
                
                $('#addDynamicBanner .top-title-banner').html( "<b>Update Banner</b>" );
                $('#addDynamicBanner .create-banner').html( "Update Banner" );
                $('#hf_update_id').val( id );
                $('#hf_from_model').val('for_update');
                $('#addDynamicBanner').modal('show');
                $('#alertName').hide();
                $('#alertPlacement').hide();
                // console.log(data);
              }
              else if( track == 'page_list' ){
                $('#inputPageTitle').val( data.title );
                $('#inputPageSlug').val( data.slug );
                CKEDITOR.instances.inputPageContent.setData(data.content);
                $('#inputPageSchema').val( data.schema );
                $('#inputPageMetaTitle').val( data.metatitle );
                $('#inputPageMetaDescription').val(data.metadescription);                
                $('#inputPageMetaKeywords').val( data.metakeywords );
                
                $('#addDynamicPage .top-title-page').html( "<b>Update Post Page</b>" );
                $('#addDynamicPage .create-page').html( "Update Page" );
                $('#hf_update_id').val( id );
                $('#hf_from_model').val('for_update');
                $('#addDynamicPage').modal('show');
                $('#alertName').hide();
                $('#alertSlug').hide();
                // console.log(data);
              }

              else if( track == 'param_list' ){
                $('#inputParamName').attr('readonly','true');
                $('#inputParamName').val( data.name );
                $('#inputParamValue').val( data.value );
                
                $('#addDynamicParam .top-title-param').html( "<b>Update Site Param</b>" );
                $('#addDynamicParam .create-param').html( "Update Param" );
                $('#hf_update_id').val( id );
                $('#hf_from_model').val('for_update');
                $('#addDynamicParam').modal('show');
                $('#alertName').hide();
                // console.log(data);
              }
              
              $('.eb-overlay').hide();
              $('.eb-overlay-loader').hide();
            }
          },
          error:function(){}
    });
  },

  get_notif_data:function(id, title){
    var base_url_image = $('#base_url_image').val();
  
    var fcm_server_key = "AAAAmtdE8Mc:APA91bFxzDJLg41DtiUJDXKdpBKleSMG4wvsRABxtYcGVcZRPXU-Vcj1B6SWMIpzNcJ9EF_Y4bAu7UWvxSFsVw0mgVZATUhcW9P0VPo_IRZ0UjZs6iC752udeY0mfPNnrQlyoe-S3HxF";
    $.ajax({
          url: $('#hf_base_url').val() + '/ajax/notification-apps',
          type: 'GET',
          cache: false,
          dataType : 'html',
          data: {title:title,id_artikel:id},
          // data: JSON.stringify(
          //   {
          //     "notification":{
          //       "title":"Kambijak.com",  //ga usah
          //       "body": "Ini berita kami bijak",  //Ahmad Zulkarnain, Fotografer Difabel dengan Karya Luar Biasa
          //       "sound": "default",  
          //       "click_action": "FCM_PLUGIN_ACTIVITY",  
          //       "icon": "fcm_push_icon"   
          //     },
          //     "data":{
          //       "title":"value1",   //id_berita
          //       "title2": "value2" //Ahmad Zulkarnain, Fotografer Difabel dengan Karya Luar Biasa
          //     },
          //     "to":"/topics/all",  
          //     "priority":"high",  
          //     "restricted_package_name":""  
          //   }
          // )
          // headers: {'Content-Type': 'application/json', 'Authorization': 'key=' + fcm_server_key},
         
          success: function(data){
            console.log(data);
            swal("Good job!", "Your item has been successfully notified to the application", "success");
            window.location.href = window.location.href;
            // if(data.success == true){
            //   if( track == 'notif-to-app' ){
            //     $('#name').val( data.name );
            //     $('#slug').val( data.slug );
            //     $('#hf_cms_covercat_picture').val( data.cover );
            //     $('#hf_cms_avatarcat_picture').val( data.avatar );
            //     $('#hf_cms_iconcat_picture').val( data.icon );

            //     if(data.cover)
            //     {
            //       $('.covercat-picture').show();
            //       $('.img-div img').attr('src', base_url_image + data.cover);
            //       $('.btn-div').show();
            //       $('.img-div').show();                  
            //       $('.img-div-default').hide();
            //     }

            //     if(data.avatar)
            //     {
            //       $('.avatarcat-picture').show();
            //       $('.img-div-avatarcat img').attr('src', base_url_image + data.avatar);
            //       $('.btn-div-avatarcat').show();
            //       $('.img-div-avatarcat').show();
            //       $('.img-div-default-avatarcat').hide();
            //     }

            //     if(data.icon)
            //     {
            //       $('.iconcat-picture').show();
            //       $('.img-div-iconcat img').attr('src', base_url_image + data.icon);
            //       $('.btn-div-iconcat').show();
            //       $('.img-div-iconcat').show();
            //       $('.img-div-default-iconcat').hide();
            //     }
                
            //     $("#cat_parent option").each(function(){
            //       if($(this).attr('disabled'))
            //       {
            //         $(this).removeAttr('disabled');
            //       }
            //     });
                
            //     $('#cat_parent').select2();
                
            //     $("#cat_parent option[value='"+ id +"']").attr('disabled','disabled');
            //     $('#cat_parent').select2('val', data.parent);
            //     $('#description').val( data.description ); 
            //     $('#hf_cms_covercat_picture').val( data.cover );               
            //     $('#color').val( data.color );
            //     $('#schema').val( data.schema );
            //     $('#metatitle').val( data.metatitle );
            //     $('#metadescription').val( data.metadescription );
            //     $('#metakeywords').val( data.metakeywords );
              
            //     $('#addDynamicCategories .top-title').html( "<b>Update Category</b>" );
            //     $('#addDynamicCategories .create-cat').html( "Update Category" );
            //     $('#hf_update_id').val( id );
            //     $('#hf_from_model').val('for_update');
            //     $('#addDynamicCategories').modal('show');
            //     $('#alertName').hide();
            //     $('#alertSlug').hide();
            //   }
            // }
          },
          error:function(){}
    });
  }

};

kamibijak.normalFunction=
{
  successMsg:function()
  {
    swal("Good job!", "Your item has beed successfully saved", "success");
    window.location.href = window.location.href;
  }
};

kamibijak.warningMessage =
{
  deleteConfirmation:function( id, item_id, track )
  // deleteConfirmation:function( id, item_id, track, id_elev, author_id )
  {
    var dataObj       = {};
    dataObj.id        =  id;
    // dataObj.id_elev   =  id_elev;
    // dataObj.author_id =  author_id;
    dataObj.track     =  track;
    
    if( item_id != null)
    {
      dataObj.item_id     =  item_id;
    }
     
    swal({
      title: "Are You Sure",
      text:  "You want to delete this item",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes delete it",
      closeOnConfirm: false
    },
    function(isConfirm)
    {
      if(isConfirm)
      {
        $.ajax({
              url: $('#hf_base_url').val() + '/ajax/delete-item',
              type: 'POST',
              cache: false,
              datatype: 'json',
              data: {data:dataObj},
              headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
              success: function(data)
              {
                if(data.delete == true)
                {

                  swal("Deleted", "Your selected item deleted", "success");
                  
                  $( ".remove-selected-data-from-list").unbind( "click" );

                  // if(track == 'variation_data_list')
                  // {
                  //   $('#hf_variation_data').val(data.variation_json);
                  //   $('.variation-list').html('');
                  //   $('.variation-list').html( data.variation_new_html );
                  //   $("#variation_list").DataTable();

                  //   shopist.event.view_variation_by_id();
                  //   shopist.event.edit_panel_display();
                  //   shopist.event.item_delete_from_list();
                  //   shopist.event.item_disable_from_list();
                  //   shopist.event.permanen_item_delete_from_list();
                  //   shopist.event.item_restore_from_list();

                  //   swal(adminLocalizationString.good_job, adminLocalizationString.selected_item_successfully_deleted, "success");
                  // }
                  // else if(track == 'attr_data_list')
                  // {
                  //   $('.attr-list').html('');
                  //   $('.attr-list').html( data.attr_new_html );
                  //   $(".attr-list #attr_list").DataTable();
                    
                  //   $( ".add-new-attribute, .update-attribute").unbind( "click" );
                  //   $( ".edit-attribute-data").unbind( "click" );
                  //   $( ".remove-selected-data-from-list").unbind( "click" );
                  //   $( ".restore-selected-data-from-list").unbind( "click" );
                  //   $( ".permanen-remove-selected-data-from-list").unbind( "click" );
                  //   $( ".disable-selected-data-from-list").unbind( "click" );

                  //   shopist.event.edit_attribute_panel_display();
                  //   shopist.event.item_delete_from_list();
                  //   shopist.event.item_disable_from_list();
                  //   shopist.event.item_restore_from_list();
                  //   shopist.event.permanen_item_delete_from_list();
                  //   shopist.event.create_attribute();
                    
                  //   swal(adminLocalizationString.good_job, adminLocalizationString.selected_item_successfully_deleted, "success");
                  // }
                  // else
                  // {
                    window.location.href = window.location.href;
                  // }
                }
              },
              
              error:function(){}
        });
      }
    });
  },

  changeConfirmation:function( id, item_id, track )
  {
    var dataObj       = {};
    dataObj.id        =  id;
    dataObj.track     =  track;
    
    if( item_id != null)
    {
      dataObj.item_id     =  item_id;
    }
     
    swal({
      title: "Are You Sure",
      text:  "You want to change this post",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes change it",
      closeOnConfirm: false
    },
    function(isConfirm)
    {
      if(isConfirm)
      {
        $.ajax({
              url: $('#hf_base_url').val() + '/ajax/change-item',
              type: 'POST',
              cache: false,
              datatype: 'json',
              data: {data:dataObj},
              headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
              success: function(data)
              {
                if(data.change == true)
                {

                  swal("Changed", "Your selected post changed", "success");
                  
                  $( ".change-selected-data-from-list").unbind( "click" );
                    window.location.href = window.location.href;
                }
              },
              
              error:function(){}
        });
      }
    });
  }

};

$(document).ready(function()
{
  kamibijak.pageLoad.elementLoad();
  kamibijak.event.createCat();
  kamibijak.event.createTag();
  kamibijak.event.createBanner();
  kamibijak.event.createPage();
  kamibijak.event.createParam();
  kamibijak.event.model_event();
  kamibijak.event.model_event_tag();
  kamibijak.event.model_create_tag();
  kamibijak.event.model_event_page();
  kamibijak.event.model_event_param();
  kamibijak.event.model_event_banner();
  kamibijak.event.item_delete_from_list();
  kamibijak.event.item_change_from_list();
  kamibijak.event.edit_panel_display();
  kamibijak.event.notification_apps();
});

// console.log(kamibijak.event.item_delete_from_list());




