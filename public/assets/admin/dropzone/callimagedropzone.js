//upload cover image
if($('#cms_cover_picture_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#cms_cover_picture_uploader").dropzone({ 
  url: $('#hf_base_url').val() + "/upload/cms-related-image",
  paramName: "cover_picture",
  acceptedFiles:  "image/*", 
  uploadMultiple:false, 
  maxFiles:1, 
  autoProcessQueue: true, 
  parallelUploads: 100, 
  addRemoveLinks: true, 
  maxFilesize: 1,
  dataType:  'json',
  headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
    
    init: function() 
    {
      this.on("maxfilesexceeded", function(file){
          swal("" , "Image a maximum of 1 MB");
      });
      // this.on("error", function(file, message){
      //   if (file.size > 1*10240*10240) 
      //   {
      //     swal("" , "File larger");
      //     this.removeFile(file)
      //      return false;
      //   }
      //   if(!file.type.match('image.*')) {
      //     swal("" , "Image file validation");
      //     this.removeFile(file)
      //     return false;
      //   }
      // });

      this.on("error", function(file, message){
          swal("" , "Image tidak sesuai dengan aspect ratio");
          this.removeFile(file)
          return false;
      });
      
      this.on("success", function(file, responseText) 
      {
        if(responseText.status === 'success')
        {
          $('.cover-picture').find('img').attr('src', $('#base_url_image').val() + 'images/large/'+ responseText.name);
          $('.cover-picture').show();
          $('.no-cover-picture').hide();
          $('.cms-user-cover-picture-uploader').hide();
          $('#cmsUploadCoverPicture').modal('hide');
          $('#hf_cms_cover_picture').val( responseText.name );
          swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

          this.removeAllFiles();
        }
      });
    }
  });
}

if($('.remove-cms-cover-picture').length>0)
{
  $('.remove-cms-cover-picture').on('click', function()
  {
    $('.no-cover-picture').show();
    $('.cover-picture').hide();
    $('#hf_cms_cover_picture').val('');
    $('.cms-user-cover-picture-uploader').show();
  });
}

//upload thumbnail image
if($('#cms_thumbnail_picture_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#cms_thumbnail_picture_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-related-image",
    paramName: "thumbnail_picture", 
    acceptedFiles:  "image/*", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    
    init: function() 
    {
      this.on("maxfilesexceeded", function(file){
          swal("" , "Image is larger than 10MB");
      });
      this.on("error", function(file, message){
        if (file.size > 1*10240*10240) 
        {
          swal("" , "File larger");
          this.removeFile(file)
           return false;
        }
        if(!file.type.match('image.*')) {
          swal("" , "Image file validation");
          this.removeFile(file)
          return false;
        }
      });
      
      this.on("success", function(file, responseText) 
      {
        if(responseText.status === 'success')
        {
          $('.thumbnail-picture').find('img').attr('src', $('#base_url_image').val() + 'images/large/'+ responseText.name);
          $('.thumbnail-picture').show();
          $('.no-thumbnail-picture').hide();
          $('#cmsUploadThumbnailPicture').modal('hide');
          $('#hf_cms_thumbnail_picture').val( responseText.name );
          swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

          this.removeAllFiles();
        }
      });
    }
  });
}

if($('.remove-cms-thumbnail-picture').length>0)
{
  $('.remove-cms-thumbnail-picture').on('click', function()
  {
    $('.no-thumbnail-picture').show();
    $('.thumbnail-picture').hide();
    $('#hf_cms_thumbnail_picture').val('');
  });
}

if($('#cms_covercat_picture_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#cms_covercat_picture_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-related-image",
    paramName: "covercat_picture", 
    acceptedFiles:  "image/*", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function() {

          this.on("maxfilesexceeded", function(file){
              swal("" , "Image is larger than 10MB");
          });
          this.on("error", function(file, message){
            if (file.size > 1*10240*10240) 
            {
              swal("" , "File larger");
              this.removeFile(file)
               return false;
            }
            if(!file.type.match('image.*')) {
              swal("" , "Image file validation");
              this.removeFile(file)
              return false;
            }
          });
          
          this.on("success", function(file, responseText) 
          {
            if(responseText.status === 'success')
            {
              $('.covercat-picture').find('img').attr('src', $('#base_url_image').val() + 'images/large/'+ responseText.name);
              $('.covercat-picture').show();
              $('.img-div-default').hide();
              $('.no-covercat-picture').hide();
              $('#cmsUploadCovercatPicture').modal('hide');
              $('#hf_cms_covercat_picture').val( responseText.name );
              swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

              this.removeAllFiles();
            }
          });
    }
  });
}

if($('.remove-cms-covercat-picture').length>0)
{
  $('.remove-cms-covercat-picture').on('click', function()
  {
    $('.no-covercat-picture').show();
    $('.covercat-picture').hide();
    $('#hf_cms_covercat_picture').val('');
    $('.img-div-default').show();
  });
}

if($('#cms_avatarcat_picture_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#cms_avatarcat_picture_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-related-image",
    paramName: "avatarcat_picture", 
    acceptedFiles:  "image/*", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function() {

          this.on("maxfilesexceeded", function(file){
              swal("" , "Image is larger than 10MB");
          });
          this.on("error", function(file, message){
            if (file.size > 1*10240*10240) 
            {
              swal("" , "File larger");
              this.removeFile(file)
               return false;
            }
            if(!file.type.match('image.*')) {
              swal("" , "Image file validation");
              this.removeFile(file)
              return false;
            }
          });
          
          this.on("success", function(file, responseText) 
          {
            if(responseText.status === 'success')
            {
              $('.avatarcat-picture').find('img').attr('src', $('#base_url_image').val() + 'images/large/'+ responseText.name);
              $('.avatarcat-picture').show();
              $('.img-div-default-avatarcat').hide();
              $('.no-avatarcat-picture').hide();
              $('#hf_cms_avatarcat_picture').val( responseText.name );
              swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

              this.removeAllFiles();
            }
          });
    }
  });
}

if($('.remove-cms-avatarcat-picture').length>0)
{
  $('.remove-cms-avatarcat-picture').on('click', function()
  {
    $('.no-avatarcat-picture').show();
    $('.avatarcat-picture').hide();
    $('#hf_cms_avatarcat_picture').val('');
    $('.img-div-default-avatarcat').show();
  });
}

if($('#cms_iconcat_picture_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#cms_iconcat_picture_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-related-image",
    paramName: "iconcat_picture", 
    acceptedFiles:  "image/*", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function() {

          this.on("maxfilesexceeded", function(file){
              swal("" , "Image is larger than 10MB");
          });
          this.on("error", function(file, message){
            if (file.size > 1*10240*10240) 
            {
              swal("" , "File larger");
              this.removeFile(file)
               return false;
            }
            if(!file.type.match('image.*')) {
              swal("" , "Image file validation");
              this.removeFile(file)
              return false;
            }
          });
          
          this.on("success", function(file, responseText) 
          {
            if(responseText.status === 'success')
            {
              $('.iconcat-picture').find('img').attr('src', $('#base_url_image').val() + 'images/large/'+ responseText.name);
              $('.iconcat-picture').show();
              $('.img-div-default-iconcat').hide();
              $('.no-iconcat-picture').hide();
              $('#hf_cms_iconcat_picture').val( responseText.name );
              swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

              this.removeAllFiles();
            }
          });
    }
  });
}

if($('.remove-cms-iconcat-picture').length>0)
{
  $('.remove-cms-iconcat-picture').on('click', function()
  {
    $('.no-iconcat-picture').show();
    $('.iconcat-picture').hide();
    $('#hf_cms_iconcat_picture').val('');
    $('.img-div-default-iconcat').show();
  });
}
//
if($('#cms_useravatar_picture_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#cms_useravatar_picture_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-all-image",
    paramName: "useravatar_picture", 
    acceptedFiles:  "image/*", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function() {

          this.on("maxfilesexceeded", function(file){
              swal("" , "Image is larger than 10MB");
          });
          this.on("error", function(file, message){
            if (file.size > 1*10240*10240) 
            {
              swal("" , "File larger");
              this.removeFile(file)
               return false;
            }
            if(!file.type.match('image.*')) {
              swal("" , "Image file validation");
              this.removeFile(file)
              return false;
            }
          });
          
          this.on("success", function(file, responseText) 
          {
            if(responseText.status === 'success')
            {
              $('.useravatar-picture').find('img').attr('src', $('#base_url_image').val() + 'images/user/'+ responseText.name);
              $('.useravatar-picture').show();
              $('.no-useravatar-picture').hide();
              $('#cmsUploadUseravatarPicture').modal('hide');
              $('#hf_cms_useravatar_picture').val( responseText.name );
              swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

              this.removeAllFiles();
            }
          });
    }
  });
}

if($('.remove-cms-useravatar-picture').length>0)
{
  $('.remove-cms-useravatar-picture').on('click', function()
  {
    $('.no-useravatar-picture').show();
    $('.useravatar-picture').hide();
    $('#hf_cms_useravatar_picture').val('');
  });
}

if($('#cms_backgrounduser_picture_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#cms_backgrounduser_picture_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-all-image",
    paramName: "backgrounduser_picture", 
    acceptedFiles:  "image/*", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function() {

          this.on("maxfilesexceeded", function(file){
              swal("" , "Image is larger than 10MB");
          });
          this.on("error", function(file, message){
            if (file.size > 1*10240*10240) 
            {
              swal("" , "File larger");
              this.removeFile(file)
               return false;
            }
            if(!file.type.match('image.*')) {
              swal("" , "Image file validation");
              this.removeFile(file)
              return false;
            }
          });
          
          this.on("success", function(file, responseText) 
          {
            if(responseText.status === 'success')
            {
              $('.backgrounduser-picture').find('img').attr('src', $('#base_url_image').val() + 'images/user/'+ responseText.name);
              $('.backgrounduser-picture').show();
              $('.no-backgrounduser-picture').hide();
              $('#cmsUploadBackgrounduserPicture').modal('hide');
              $('#hf_cms_backgrounduser_picture').val( responseText.name );
              swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

              this.removeAllFiles();
            }
          });
    }
  });
}

if($('.remove-cms-backgrounduser-picture').length>0)
{
  $('.remove-cms-backgrounduser-picture').on('click', function()
  {
    $('.no-backgrounduser-picture').show();
    $('.backgrounduser-picture').hide();
    $('#hf_cms_backgrounduser_picture').val('');
  });
}

if($('#cms_mediabanner_picture_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#cms_mediabanner_picture_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-banner-image",
    paramName: "mediabanner_picture", 
    acceptedFiles:  "image/*", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function() {

            this.on("maxfilesexceeded", function(file){
                swal("" , "Image is larger than 10MB");
            });
            this.on("error", function(file, message){
              if (file.size > 1*10240*10240) 
              {
                swal("" , "File larger");
                this.removeFile(file)
                 return false;
              }
              if(!file.type.match('image.*')) {
                swal("" , "Image file validation");
                this.removeFile(file)
                return false;
              }
            });
            
            this.on("success", function(file, responseText) 
            {
              if(responseText.status === 'success')
              {
                $('.mediabanner-picture').find('img').attr('src', $('#base_url_image').val() + 'images/banner/'+ responseText.name);
                $('.mediabanner-picture').show();
                $('.img-div-default-mediabanner').hide();
                $('.no-mediabanner-picture').hide();
                $('#hf_cms_mediabanner_picture').val( responseText.name );
                swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

                this.removeAllFiles();
              }
            });
   
      
    }
  });
}

if($('.remove-cms-mediabanner-picture').length>0)
{
  $('.remove-cms-mediabanner-picture').on('click', function()
  {
    $('.no-mediabanner-picture').show();
    $('.mediabanner-picture').hide();
    $('#hf_cms_mediabanner_picture').val('');
    $('.img-div-default-mediabanner').show();
    $('#cms-user-mediabanner-picture-uploader').show();
  });
}

if($('#cms_videobanner_picture_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#cms_videobanner_picture_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-related-video",
    paramName: "videobanner_picture", 
    acceptedFiles:  ".mp4,.ogg", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function(file, done){
      
          this.on("maxfilesexceeded", function(file){
              swal("" , "Image is larger than 10MB");
          });
          this.on("error", function(file, message){
            if (file.size > 1*10240*10240) 
            {
              swal("" , "File larger");
              this.removeFile(file)
               return false;
            }
            if(!file.type.match('image.*')) {
              swal("" , "Image file validation");
              this.removeFile(file)
              return false;
            }
          });

            this.on("success", function(file, responseText) 
          {
            if(responseText.status === 'success')
            {
              $('.videobanner-picture').find('video').attr('src', $('#base_url_image').val() + '/video/'+ responseText.name);
              $('.videobanner-picture').show();
              $('.img-div-default-videobanner').hide();
              $('.no-videobanner-picture').hide();
              $('#hf_cms_videobanner_picture').val( 'video/'+ responseText.name );
              swal("Ok!", "Video Anda berhasil diunggah!", "success")

              this.removeAllFiles();
            }
          });
        
      
    }
  });
}

if($('.remove-cms-videobanner-picture').length>0)
{
  $('.remove-cms-videobanner-picture').on('click', function()
  {
    $('.no-videobanner-picture').show();
    $('.videobanner-picture').hide();
    $('#hf_cms_videobanner_picture').val('');
    $('.img-div-default-videobanner').show();
  });
}

if($('#category_cover_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#category_cover_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-all-image",
    paramName: "covercat_picture", 
    acceptedFiles:  "image/*", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function() {

          this.on("maxfilesexceeded", function(file){
              swal("" , "Image is larger than 10MB");
          });
          this.on("error", function(file, message){
            if (file.size > 1*10240*10240) 
            {
              swal("" , "File larger");
              this.removeFile(file)
               return false;
            }
            if(!file.type.match('image.*')) {
              swal("" , "Image file validation");
              this.removeFile(file)
              return false;
            }
          });
          
          this.on("success", function(file, responseText) 
          {
            if(responseText.status === 'success')
            {
              $('.category-cover-picture').find('img').attr('src', $('#base_url_image').val() + 'images/category/'+ responseText.name);
              $('.category-cover-picture').show();
              $('.upload-category-cover').hide();
              $('#hf_cms_covercat_picture').val( responseText.name );
              swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

              this.removeAllFiles();
            }
          });
    }
  });
}

if($('.remove-category-cover').length>0)
{
  $('.remove-category-cover').on('click', function()
  {
    $('.upload-category-cover').show();
    $('.category-cover-picture').hide();
    $('#hf_cms_covercat_picture').val('');
  });
}

if($('#category_avatar_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#category_avatar_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-all-image",
    paramName: "avatarcat_picture", 
    acceptedFiles:  "image/*", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function() {

          this.on("maxfilesexceeded", function(file){
              swal("" , "Image is larger than 10MB");
          });
          this.on("error", function(file, message){
            if (file.size > 1*10240*10240) 
            {
              swal("" , "File larger");
              this.removeFile(file)
               return false;
            }
            if(!file.type.match('image.*')) {
              swal("" , "Image file validation");
              this.removeFile(file)
              return false;
            }
          });
          
          this.on("success", function(file, responseText) 
          {
            if(responseText.status === 'success')
            {
              $('.category-avatar-picture').find('img').attr('src', $('#base_url_image').val() + 'images/category/'+ responseText.name);
              $('.category-avatar-picture').show();
              $('.upload-category-avatar').hide();
              $('#hf_cms_avatarcat_picture').val( responseText.name );
              swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

              this.removeAllFiles();
            }
          });
    }
  });
}

if($('.remove-category-avatar').length>0)
{
  $('.remove-category-avatar').on('click', function()
  {
    $('.upload-category-avatar').show();
    $('.category-avatar-picture').hide();
    $('#hf_cms_avatarcat_picture').val('');
  });
}

if($('#category_icon_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#category_icon_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-all-image",
    paramName: "iconcat_picture", 
    acceptedFiles:  "image/*", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function() {

          this.on("maxfilesexceeded", function(file){
              swal("" , "Image is larger than 10MB");
          });
          this.on("error", function(file, message){
            if (file.size > 1*10240*10240) 
            {
              swal("" , "File larger");
              this.removeFile(file)
               return false;
            }
            if(!file.type.match('image.*')) {
              swal("" , "Image file validation");
              this.removeFile(file)
              return false;
            }
          });
          
          this.on("success", function(file, responseText) 
          {
            if(responseText.status === 'success')
            {
              $('.category-icon-picture').find('img').attr('src', $('#base_url_image').val() + 'images/category/'+ responseText.name);
              $('.category-icon-picture').show();
              $('.upload-category-icon').hide();
              $('#hf_cms_iconcat_picture').val( responseText.name );
              swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

              this.removeAllFiles();
            }
          });
    }
  });
}

if($('.remove-category-icon').length>0)
{
  $('.remove-category-icon').on('click', function()
  {
    $('.upload-category-icon').show();
    $('.category-icon-picture').hide();
    $('#hf_cms_iconcat_picture').val('');
  });
}

if($('#gallery_cover_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#gallery_cover_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-all-image",
    paramName: "covergal_picture", 
    acceptedFiles:  "image/*", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function() {

          this.on("maxfilesexceeded", function(file){
              swal("" , "Image is larger than 10MB");
          });
          this.on("error", function(file, message){
            if (file.size > 1*10240*10240) 
            {
              swal("" , "File larger");
              this.removeFile(file)
               return false;
            }
            if(!file.type.match('image.*')) {
              swal("" , "Image file validation");
              this.removeFile(file)
              return false;
            }
          });
          
          this.on("success", function(file, responseText) 
          {
            if(responseText.status === 'success')
            {
              $('.gallery-cover-picture').find('img').attr('src', $('#base_url_image').val() + 'images/gallery/'+ responseText.name);
              $('.gallery-cover-picture').show();
              $('.upload-gallery-cover').hide();
              $('#hf_cms_covergal_picture').val( responseText.name );
              swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

              this.removeAllFiles();
            }
          });
    }
  });
}

if($('.remove-gallery-cover').length>0)
{
  $('.remove-gallery-cover').on('click', function()
  {
    $('.upload-gallery-cover').show();
    $('.gallery-cover-picture').hide();
    $('#hf_cms_covergal_picture').val('');
  });
}

if($('#banner_media_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#banner_media_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-banner-image",
    paramName: "mediabanner_picture", 
    acceptedFiles:  "image/*", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function() {

          this.on("maxfilesexceeded", function(file){
              swal("" , "Image is larger than 10MB");
          });
          this.on("error", function(file, message){
            if (file.size > 1*10240*10240) 
            {
              swal("" , "File larger");
              this.removeFile(file)
               return false;
            }
            if(!file.type.match('image.*')) {
              swal("" , "Image file validation");
              this.removeFile(file)
              return false;
            }
          });
          
          this.on("success", function(file, responseText) 
          {
            if(responseText.status === 'success')
            {
              $('.banner-media-picture').find('img').attr('src', $('#base_url_image').val() + 'images/banner/'+ responseText.name);
              $('.banner-media-picture').show();
              $('.upload-banner-media').hide();
              $('#banner_media').val( responseText.name );
              swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

              this.removeAllFiles();
            }
          });
    }
  });
}

if($('.remove-banner-media').length>0)
{
  $('.remove-banner-media').on('click', function()
  {
    $('.upload-banner-media').show();
    $('.banner-media-picture').hide();
    $('#banner_media').val('');
  });
}

if($('#banner_video_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#banner_video_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-related-video",
    paramName: "videobanner_picture", 
    acceptedFiles:  ".mp4,.ogg", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function() {

          this.on("maxfilesexceeded", function(file){
              swal("" , "Image is larger than 10MB");
          });
          this.on("error", function(file, message){
            if (file.size > 1*10240*10240) 
            {
              swal("" , "File larger");
              this.removeFile(file)
               return false;
            }
            if(!file.type.match('image.*')) {
              swal("" , "Image file validation");
              this.removeFile(file)
              return false;
            }
          });
          
          this.on("success", function(file, responseText) 
          {
            if(responseText.status === 'success')
            {
              $('.banner-video-picture').find('video').attr('src', $('#base_url_image').val() + '/video/banner/'+ responseText.name);
              $('.banner-video-picture').show();
              $('.upload-banner-video').hide();
              $('#banner_video').val( responseText.name );
              swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

              this.removeAllFiles();
            }
          });
    }
  });
}

if($('.remove-banner-video').length>0)
{
  $('.remove-banner-video').on('click', function()
  {
    $('.upload-banner-video').show();
    $('.banner-video-picture').hide();
    $('#banner_video').val('');
  });
}

if($('#tag_image_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#tag_image_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-all-image",
    paramName: "tag_image", 
    acceptedFiles:  "image/*", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    init: function() {

          this.on("maxfilesexceeded", function(file){
              swal("" , "Image is larger than 10MB");
          });
          this.on("error", function(file, message){
            if (file.size > 1*10240*10240) 
            {
              swal("" , "File larger");
              this.removeFile(file)
               return false;
            }
            if(!file.type.match('image.*')) {
              swal("" , "Image file validation");
              this.removeFile(file)
              return false;
            }
          });
          
          this.on("success", function(file, responseText) 
          {
            if(responseText.status === 'success')
            {
              $('.tag-image-picture').find('img').attr('src', $('#base_url_image').val() + 'images/tag/'+ responseText.name);
              $('.tag-image-picture').show();
              $('.upload-tag-image').hide();
              $('#hf_cms_tag_image_picture').val( responseText.name );
              swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

              this.removeAllFiles();
            }
          });
    }
  });
}

if($('.remove-tag-image').length>0)
{
  $('.remove-tag-image').on('click', function()
  {
    $('.upload-tag-image').show();
    $('.tag-image-picture').hide();
    $('#hf_cms_tag_image_picture').val('');
  });
}