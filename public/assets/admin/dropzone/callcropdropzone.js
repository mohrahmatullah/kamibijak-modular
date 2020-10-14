//upload cover image
// if($('#cms_cover_picture_uploader').length>0)
// {
//   Dropzone.autoDiscover = false;
//   $("#cms_cover_picture_uploader").dropzone({ 
//     url: $('#hf_base_url').val() + "/upload/product-related-image",
//     paramName: "cover_picture", 
//     acceptedFiles:  "image/*", 
//     uploadMultiple:false, 
//     maxFiles:1, 
//     autoProcessQueue: true, 
//     parallelUploads: 100, 
//     addRemoveLinks: true, 
//     maxFilesize: 1,
//     dataType:  'json',
//     headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    
//     init: function() 
//     {
//       this.on("maxfilesexceeded", function(file){
//           swal("" , "maxfilesexceeded_msg");
//       });
//       this.on("error", function(file, message){
//         if (file.size > 1*1024*1024) 
//         {
//           swal("" , "File larger");
//           this.removeFile(file)
//            return false;
//         }
//         if(!file.type.match('image.*')) {
//           swal("" , "Image file validation");
//           this.removeFile(file)
//           return false;
//         }
//       });
      
//       this.on("success", function(file, responseText) 
//       {
//         if(responseText.status === 'success')
//         {
//           $('.cover-picture').find('img').attr('src', $('#hf_base_url').val() + '/assets/admin/uploads/'+ responseText.name);
//           $('.cover-picture').show();
//           $('.no-cover-picture').hide();
//           $('#cmsUploadCoverPicture').modal('hide');
//           $('#hf_cms_cover_picture').val( '/assets/admin/uploads/'+ responseText.name );
//           swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

//           this.removeAllFiles();
//         }
//       });
//     }
//   });
// }
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
     maxFilesize: 10,
     dataType:  'json',
	 headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },	
	 	transformFile: function(file, done) {
		  // Create Dropzone reference for use in confirm button click handler
		  var myCoper = this;
		  // Create the image editor overlay
		  var editor = document.createElement('div');
		  editor.style.position = 'fixed';
		  editor.style.left = 0;
		  editor.style.right = 0;
		  editor.style.top = 0;
		  editor.style.bottom = 0;
		  editor.style.zIndex = 9999;
		  editor.style.backgroundColor = '#000';
		  document.body.appendChild(editor);
		  // Create close button at the top left of the viewport
		  var buttonClose = document.createElement('button');
		  buttonClose.style.position = 'absolute';
		  buttonClose.style.left = '100px';
		  buttonClose.style.top = '10px';
		  buttonClose.style.zIndex = 9999;
		  buttonClose.textContent = 'Close';
		  buttonClose.setAttribute("class", "btn btn-default");
		  editor.appendChild(buttonClose);
		  buttonClose.addEventListener('click', function() {
		  	window.location.href = window.location.href;
		  });

		  // Create confirm button at the top left of the viewport
		  var buttonConfirm = document.createElement('button');
		  buttonConfirm.style.position = 'absolute';
		  buttonConfirm.style.left = '10px';
		  buttonConfirm.style.top = '10px';
		  buttonConfirm.style.zIndex = 9999;
		  buttonConfirm.textContent = 'Crop';
		  buttonConfirm.setAttribute("class", "btn btn-success");
		  editor.appendChild(buttonConfirm);
		  buttonConfirm.addEventListener('click', function() {
		    // Get the canvas with image data from Cropper.js
		    var canvas = cropper.getCroppedCanvas({
		      // width: 300,
		      // height: 250
		    });
		    // Turn the canvas into a Blob (file object without a name)
		    canvas.toBlob(function(blob) {
		      // Create a new Dropzone file thumbnail
		      myCoper.createThumbnail(
		        blob,
		        myCoper.options.thumbnailWidth,
		        myCoper.options.thumbnailHeight,
		        myCoper.options.thumbnailMethod,
		        false, 
		        function(dataURL) {
		          
		          // Update the Dropzone file thumbnail
		          myCoper.emit('thumbnail', file, dataURL);
		          // Return the file to Dropzone
		          done(blob);
		      });
		    });
		    // Remove the editor from the view
		    document.body.removeChild(editor);
		  });
		  // Create an image node for Cropper.js
		  var image = new Image();
		  image.src = URL.createObjectURL(file);
		  editor.appendChild(image);
		  
		  // Create Cropper.js
		  var cropper = new Cropper(image, { aspectRatio: 16 / 9,
		  	  crop(event) {
			    console.log(event.detail.width);
			    console.log(event.detail.height);

			    var textWidth = document.createElement('div');
					  textWidth.style.position = 'absolute';
					  textWidth.style.left = '10px';
					  textWidth.style.top = '60px';
					  textWidth.style.zIndex = 9999;
					  textWidth.setAttribute("class", "crop-text");
					  textWidth.textContent = event.detail.width.toFixed(0) + " X " + event.detail.height.toFixed(0);
					  editor.appendChild(textWidth);
			  }
		   });

		      this.on("maxfilesexceeded", function(file){
		          swal("" , "maxfilesexceeded_msg");
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
		          $('.cover-picture').find('img').attr('src', $('#base_url_image').val() + '/images/'+ responseText.name);
		          $('.cover-picture').show();
		          $('.no-cover-picture').hide();
		          $('#cmsUploadCoverPicture').modal('hide');
		          $('#hf_cms_cover_picture').val( 'images/'+ responseText.name );
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
  });
}

//upload thumbnail image
// if($('#cms_thumbnail_picture_uploader').length>0)
// {
//   Dropzone.autoDiscover = false;
//   $("#cms_thumbnail_picture_uploader").dropzone({ 
//     url: $('#hf_base_url').val() + "/upload/product-related-image",
//     paramName: "thumbnail_picture", 
//     acceptedFiles:  "image/*", 
//     uploadMultiple:false, 
//     maxFiles:1, 
//     autoProcessQueue: true, 
//     parallelUploads: 100, 
//     addRemoveLinks: true, 
//     maxFilesize: 1,
//     dataType:  'json',
//     headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    
//     init: function() 
//     {
//       this.on("maxfilesexceeded", function(file){
//           swal("" , "maxfilesexceeded_msg");
//       });
//       this.on("error", function(file, message){
//         if (file.size > 1*1024*1024) 
//         {
//           swal("" , "File larger");
//           this.removeFile(file)
//            return false;
//         }
//         if(!file.type.match('image.*')) {
//           swal("" , "Image file validation");
//           this.removeFile(file)
//           return false;
//         }
//       });
      
//       this.on("success", function(file, responseText) 
//       {
//         if(responseText.status === 'success')
//         {
//           $('.thumbnail-picture').find('img').attr('src', $('#hf_base_url').val() + '/assets/admin/uploads/'+ responseText.name);
//           $('.thumbnail-picture').show();
//           $('.no-thumbnail-picture').hide();
//           $('#cmsUploadThumbnailPicture').modal('hide');
//           $('#hf_cms_thumbnail_picture').val( '/assets/admin/uploads/'+ responseText.name );
//           swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

//           this.removeAllFiles();
//         }
//       });
//     }
//   });
// }

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
    transformFile: function(file, done) {
		  // Create Dropzone reference for use in confirm button click handler
		  var myThumbnail = this;
		  // Create the image editor overlay
		  var editor = document.createElement('div');
		  editor.style.position = 'fixed';
		  editor.style.left = 0;
		  editor.style.right = 0;
		  editor.style.top = 0;
		  editor.style.bottom = 0;
		  editor.style.zIndex = 9999;
		  editor.style.backgroundColor = '#000';
		  document.body.appendChild(editor);
		  // Create close button at the top left of the viewport
		  var buttonClose = document.createElement('button');
		  buttonClose.style.position = 'absolute';
		  buttonClose.style.left = '100px';
		  buttonClose.style.top = '10px';
		  buttonClose.style.zIndex = 9999;
		  buttonClose.textContent = 'Close';
		  buttonClose.setAttribute("class", "btn btn-default");
		  editor.appendChild(buttonClose);
		  buttonClose.addEventListener('click', function() {
		  	window.location.href = window.location.href;
		  });

		  // Create confirm button at the top left of the viewport
		  var buttonConfirm = document.createElement('button');
		  buttonConfirm.style.position = 'absolute';
		  buttonConfirm.style.left = '10px';
		  buttonConfirm.style.top = '10px';
		  buttonConfirm.style.zIndex = 9999;
		  buttonConfirm.textContent = 'Crop';
		  buttonConfirm.setAttribute("class", "btn btn-success");
		  editor.appendChild(buttonConfirm);
		  buttonConfirm.addEventListener('click', function() {
		    // Get the canvas with image data from Cropper.js
		    var canvas = cropper.getCroppedCanvas({
		      // width: 300,
		      // height: 250
		    });
		    // Turn the canvas into a Blob (file object without a name)
		    canvas.toBlob(function(blob) {
		      // Create a new Dropzone file thumbnail
		      myThumbnail.createThumbnail(
		        blob,
		        myThumbnail.options.thumbnailWidth,
		        myThumbnail.options.thumbnailHeight,
		        myThumbnail.options.thumbnailMethod,
		        false, 
		        function(dataURL) {
		          
		          // Update the Dropzone file thumbnail
		          myThumbnail.emit('thumbnail', file, dataURL);
		          // Return the file to Dropzone
		          done(blob);
		      });
		    });
		    // Remove the editor from the view
		    document.body.removeChild(editor);
		  });
		  // Create an image node for Cropper.js
		  var image = new Image();
		  image.src = URL.createObjectURL(file);
		  editor.appendChild(image);
		  
		  // Create Cropper.js
		  var cropper = new Cropper(image, { aspectRatio: 16 / 9,
			  	  crop(event) {
				    console.log(event.detail.width);
				    console.log(event.detail.height);

				    var textWidth = document.createElement('div');
					  textWidth.style.position = 'absolute';
					  textWidth.style.left = '10px';
					  textWidth.style.top = '60px';
					  textWidth.style.zIndex = 9999;
					  textWidth.setAttribute("class", "crop-text");
					  textWidth.textContent = event.detail.width.toFixed(0) + " X " + event.detail.height.toFixed(0);
					  editor.appendChild(textWidth);
				  }
			   });

		      this.on("maxfilesexceeded", function(file){
		          swal("" , "maxfilesexceeded_msg");
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
		          $('.thumbnail-picture').find('img').attr('src', $('#base_url_image').val() + '/images/'+ responseText.name);
		          $('.thumbnail-picture').show();
		          $('.no-thumbnail-picture').hide();
		          $('#cmsUploadThumbnailPicture').modal('hide');
		          $('#hf_cms_thumbnail_picture').val( 'images/'+ responseText.name );
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
    transformFile: function(file, done) {
		  // Create Dropzone reference for use in confirm button click handler
		  var mycovercat = this;
		  // Create the image editor overlay
		  var editor = document.createElement('div');
		  editor.style.position = 'fixed';
		  editor.style.left = 0;
		  editor.style.right = 0;
		  editor.style.top = 0;
		  editor.style.bottom = 0;
		  editor.style.zIndex = 9999;
		  editor.style.backgroundColor = '#000';
		  document.body.appendChild(editor);
		  // Create close button at the top left of the viewport
		  var buttonClose = document.createElement('button');
		  buttonClose.style.position = 'absolute';
		  buttonClose.style.left = '100px';
		  buttonClose.style.top = '10px';
		  buttonClose.style.zIndex = 9999;
		  buttonClose.textContent = 'Close';
		  buttonClose.setAttribute("class", "btn btn-default");
		  editor.appendChild(buttonClose);
		  buttonClose.addEventListener('click', function() {
		  	window.location.href = window.location.href;
		  });

		  // Create confirm button at the top left of the viewport
		  var buttonConfirm = document.createElement('button');
		  buttonConfirm.style.position = 'absolute';
		  buttonConfirm.style.left = '10px';
		  buttonConfirm.style.top = '10px';
		  buttonConfirm.style.zIndex = 9999;
		  buttonConfirm.textContent = 'Crop';
		  buttonConfirm.setAttribute("class", "btn btn-success");
		  editor.appendChild(buttonConfirm);
		  buttonConfirm.addEventListener('click', function() {
		    // Get the canvas with image data from Cropper.js
		    var canvas = cropper.getCroppedCanvas({
		      // width: 300,
		      // height: 250
		    });
		    // Turn the canvas into a Blob (file object without a name)
		    canvas.toBlob(function(blob) {
		      // Create a new Dropzone file thumbnail
		      mycovercat.createThumbnail(
		        blob,
		        mycovercat.options.thumbnailWidth,
		        mycovercat.options.thumbnailHeight,
		        mycovercat.options.thumbnailMethod,
		        false, 
		        function(dataURL) {
		          
		          // Update the Dropzone file thumbnail
		          mycovercat.emit('thumbnail', file, dataURL);
		          // Return the file to Dropzone
		          done(blob);
		      });
		    });
		    // Remove the editor from the view
		    document.body.removeChild(editor);
		  });
		  // Create an image node for Cropper.js
		  var image = new Image();
		  image.src = URL.createObjectURL(file);
		  editor.appendChild(image);
		  
		  // Create Cropper.js
		  var cropper = new Cropper(image, { aspectRatio: 16 / 9,
		  	  crop(event) {
			    console.log(event.detail.width);
			    console.log(event.detail.height);

			    var textWidth = document.createElement('div');
					  textWidth.style.position = 'absolute';
					  textWidth.style.left = '10px';
					  textWidth.style.top = '60px';
					  textWidth.style.zIndex = 9999;
					  textWidth.setAttribute("class", "crop-text");
					  textWidth.textContent = event.detail.width.toFixed(0) + " X " + event.detail.height.toFixed(0);
					  editor.appendChild(textWidth);
			  }
		   });

		      this.on("maxfilesexceeded", function(file){
		          swal("" , "maxfilesexceeded_msg");
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
		          $('.covercat-picture').find('img').attr('src', $('#base_url_image').val() + '/images/'+ responseText.name);
		          $('.covercat-picture').show();
		          $('.img-div-default').hide();
		          $('.no-covercat-picture').hide();
		          $('#cmsUploadCovercatPicture').modal('hide');
		          $('#hf_cms_covercat_picture').val( 'images/'+ responseText.name );
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
    transformFile: function(file, done) {
		  // Create Dropzone reference for use in confirm button click handler
		  var myavatarcat = this;
		  // Create the image editor overlay
		  var editor = document.createElement('div');
		  editor.style.position = 'fixed';
		  editor.style.left = 0;
		  editor.style.right = 0;
		  editor.style.top = 0;
		  editor.style.bottom = 0;
		  editor.style.zIndex = 9999;
		  editor.style.backgroundColor = '#000';
		  document.body.appendChild(editor);
		  // Create close button at the top left of the viewport
		  var buttonClose = document.createElement('button');
		  buttonClose.style.position = 'absolute';
		  buttonClose.style.left = '100px';
		  buttonClose.style.top = '10px';
		  buttonClose.style.zIndex = 9999;
		  buttonClose.textContent = 'Close';
		  buttonClose.setAttribute("class", "btn btn-default");
		  editor.appendChild(buttonClose);
		  buttonClose.addEventListener('click', function() {
		  	window.location.href = window.location.href;
		  });

		  // Create confirm button at the top left of the viewport
		  var buttonConfirm = document.createElement('button');
		  buttonConfirm.style.position = 'absolute';
		  buttonConfirm.style.left = '10px';
		  buttonConfirm.style.top = '10px';
		  buttonConfirm.style.zIndex = 9999;
		  buttonConfirm.textContent = 'Crop';
		  buttonConfirm.setAttribute("class", "btn btn-success");
		  editor.appendChild(buttonConfirm);
		  buttonConfirm.addEventListener('click', function() {
		    // Get the canvas with image data from Cropper.js
		    var canvas = cropper.getCroppedCanvas({
		      // width: 300,
		      // height: 250
		    });
		    // Turn the canvas into a Blob (file object without a name)
		    canvas.toBlob(function(blob) {
		      // Create a new Dropzone file thumbnail
		      myavatarcat.createThumbnail(
		        blob,
		        myavatarcat.options.thumbnailWidth,
		        myavatarcat.options.thumbnailHeight,
		        myavatarcat.options.thumbnailMethod,
		        false, 
		        function(dataURL) {
		          
		          // Update the Dropzone file thumbnail
		          myavatarcat.emit('thumbnail', file, dataURL);
		          // Return the file to Dropzone
		          done(blob);
		      });
		    });
		    // Remove the editor from the view
		    document.body.removeChild(editor);
		  });
		  // Create an image node for Cropper.js
		  var image = new Image();
		  image.src = URL.createObjectURL(file);
		  editor.appendChild(image);
		  
		  // Create Cropper.js
		  var cropper = new Cropper(image, { aspectRatio: 16 / 9,
		  	  crop(event) {
			    console.log(event.detail.width);
			    console.log(event.detail.height);

			    var textWidth = document.createElement('div');
					  textWidth.style.position = 'absolute';
					  textWidth.style.left = '10px';
					  textWidth.style.top = '60px';
					  textWidth.style.zIndex = 9999;
					  textWidth.setAttribute("class", "crop-text");
					  textWidth.textContent = event.detail.width.toFixed(0) + " X " + event.detail.height.toFixed(0);
					  editor.appendChild(textWidth);
			  }
		   });

		      this.on("maxfilesexceeded", function(file){
		          swal("" , "maxfilesexceeded_msg");
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
		          $('.avatarcat-picture').find('img').attr('src', $('#base_url_image').val() + '/images/'+ responseText.name);
		          $('.avatarcat-picture').show();
		          $('.img-div-default-avatarcat').hide();
		          $('.no-avatarcat-picture').hide();
		          $('#hf_cms_avatarcat_picture').val( 'images/'+ responseText.name );
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
    transformFile: function(file, done) {
		  // Create Dropzone reference for use in confirm button click handler
		  var myiconcat = this;
		  // Create the image editor overlay
		  var editor = document.createElement('div');
		  editor.style.position = 'fixed';
		  editor.style.left = 0;
		  editor.style.right = 0;
		  editor.style.top = 0;
		  editor.style.bottom = 0;
		  editor.style.zIndex = 9999;
		  editor.style.backgroundColor = '#000';
		  document.body.appendChild(editor);
		  // Create close button at the top left of the viewport
		  var buttonClose = document.createElement('button');
		  buttonClose.style.position = 'absolute';
		  buttonClose.style.left = '100px';
		  buttonClose.style.top = '10px';
		  buttonClose.style.zIndex = 9999;
		  buttonClose.textContent = 'Close';
		  buttonClose.setAttribute("class", "btn btn-default");
		  editor.appendChild(buttonClose);
		  buttonClose.addEventListener('click', function() {
		  	window.location.href = window.location.href;
		  });

		  // Create confirm button at the top left of the viewport
		  var buttonConfirm = document.createElement('button');
		  buttonConfirm.style.position = 'absolute';
		  buttonConfirm.style.left = '10px';
		  buttonConfirm.style.top = '10px';
		  buttonConfirm.style.zIndex = 9999;
		  buttonConfirm.textContent = 'Crop';
		  buttonConfirm.setAttribute("class", "btn btn-success");
		  editor.appendChild(buttonConfirm);
		  buttonConfirm.addEventListener('click', function() {
		    // Get the canvas with image data from Cropper.js
		    var canvas = cropper.getCroppedCanvas({
		      // width: 300,
		      // height: 250
		    });
		    // Turn the canvas into a Blob (file object without a name)
		    canvas.toBlob(function(blob) {
		      // Create a new Dropzone file thumbnail
		      myiconcat.createThumbnail(
		        blob,
		        myiconcat.options.thumbnailWidth,
		        myiconcat.options.thumbnailHeight,
		        myiconcat.options.thumbnailMethod,
		        false, 
		        function(dataURL) {
		          
		          // Update the Dropzone file thumbnail
		          myiconcat.emit('thumbnail', file, dataURL);
		          // Return the file to Dropzone
		          done(blob);
		      });
		    });
		    // Remove the editor from the view
		    document.body.removeChild(editor);
		  });
		  // Create an image node for Cropper.js
		  var image = new Image();
		  image.src = URL.createObjectURL(file);
		  editor.appendChild(image);
		  
		  // Create Cropper.js
		  var cropper = new Cropper(image, { aspectRatio: 16 / 9,
		  	  crop(event) {
			    console.log(event.detail.width);
			    console.log(event.detail.height);

			    var textWidth = document.createElement('div');
					  textWidth.style.position = 'absolute';
					  textWidth.style.left = '10px';
					  textWidth.style.top = '60px';
					  textWidth.style.zIndex = 9999;
					  textWidth.setAttribute("class", "crop-text");
					  textWidth.textContent = event.detail.width.toFixed(0) + " X " + event.detail.height.toFixed(0);
					  editor.appendChild(textWidth);
			  }
		   });

		      this.on("maxfilesexceeded", function(file){
		          swal("" , "maxfilesexceeded_msg");
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
		          $('.iconcat-picture').find('img').attr('src', $('#base_url_image').val() + '/images/'+ responseText.name);
		          $('.iconcat-picture').show();
		          $('.img-div-default-iconcat').hide();
		          $('.no-iconcat-picture').hide();
		          $('#hf_cms_iconcat_picture').val( 'images/'+ responseText.name );
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

if($('#cms_covergal_picture_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#cms_covergal_picture_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-related-image",
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
    transformFile: function(file, done) {
		  // Create Dropzone reference for use in confirm button click handler
		  var mycovercat = this;
		  // Create the image editor overlay
		  var editor = document.createElement('div');
		  editor.style.position = 'fixed';
		  editor.style.left = 0;
		  editor.style.right = 0;
		  editor.style.top = 0;
		  editor.style.bottom = 0;
		  editor.style.zIndex = 9999;
		  editor.style.backgroundColor = '#000';
		  document.body.appendChild(editor);
		  // Create close button at the top left of the viewport
		  var buttonClose = document.createElement('button');
		  buttonClose.style.position = 'absolute';
		  buttonClose.style.left = '100px';
		  buttonClose.style.top = '10px';
		  buttonClose.style.zIndex = 9999;
		  buttonClose.textContent = 'Close';
		  buttonClose.setAttribute("class", "btn btn-default");
		  editor.appendChild(buttonClose);
		  buttonClose.addEventListener('click', function() {
		  	window.location.href = window.location.href;
		  });

		  // Create confirm button at the top left of the viewport
		  var buttonConfirm = document.createElement('button');
		  buttonConfirm.style.position = 'absolute';
		  buttonConfirm.style.left = '10px';
		  buttonConfirm.style.top = '10px';
		  buttonConfirm.style.zIndex = 9999;
		  buttonConfirm.textContent = 'Crop';
		  buttonConfirm.setAttribute("class", "btn btn-success");
		  editor.appendChild(buttonConfirm);
		  buttonConfirm.addEventListener('click', function() {
		    // Get the canvas with image data from Cropper.js
		    var canvas = cropper.getCroppedCanvas({
		      // width: 300,
		      // height: 250
		    });
		    // Turn the canvas into a Blob (file object without a name)
		    canvas.toBlob(function(blob) {
		      // Create a new Dropzone file thumbnail
		      mycovercat.createThumbnail(
		        blob,
		        mycovercat.options.thumbnailWidth,
		        mycovercat.options.thumbnailHeight,
		        mycovercat.options.thumbnailMethod,
		        false, 
		        function(dataURL) {
		          
		          // Update the Dropzone file thumbnail
		          mycovercat.emit('thumbnail', file, dataURL);
		          // Return the file to Dropzone
		          done(blob);
		      });
		    });
		    // Remove the editor from the view
		    document.body.removeChild(editor);
		  });
		  // Create an image node for Cropper.js
		  var image = new Image();
		  image.src = URL.createObjectURL(file);
		  editor.appendChild(image);
		  
		  // Create Cropper.js
		  var cropper = new Cropper(image, { aspectRatio: 16 / 9,
		  	  crop(event) {
			    console.log(event.detail.width);
			    console.log(event.detail.height);

			    var textWidth = document.createElement('div');
					  textWidth.style.position = 'absolute';
					  textWidth.style.left = '10px';
					  textWidth.style.top = '60px';
					  textWidth.style.zIndex = 9999;
					  textWidth.setAttribute("class", "crop-text");
					  textWidth.textContent = event.detail.width.toFixed(0) + " X " + event.detail.height.toFixed(0);
					  editor.appendChild(textWidth);
			  }
		   });

		      this.on("maxfilesexceeded", function(file){
		          swal("" , "maxfilesexceeded_msg");
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
		          $('.covergal-picture').find('img').attr('src', $('#base_url_image').val() + '/images/'+ responseText.name);
		          $('.covergal-picture').show();
		          $('.img-div-default').hide();
		          $('.no-covergal-picture').hide();
		          $('#cmsUploadCovergalPicture').modal('hide');
		          $('#hf_cms_covergal_picture').val( 'images/'+ responseText.name );
		          swal("Ok!", "Gambar Anda berhasil diunggah!", "success")

		          this.removeAllFiles();
		        }
		      });
		}
  });
}

if($('.remove-cms-covergal-picture').length>0)
{
  $('.remove-cms-covergal-picture').on('click', function()
  {
    $('.no-covergal-picture').show();
    $('.covergal-picture').hide();
    $('#hf_cms_covergal_picture').val('');
    $('.img-div-default').show();
  });
}

//
if($('#cms_useravatar_picture_uploader').length>0)
{
  Dropzone.autoDiscover = false;
  $("#cms_useravatar_picture_uploader").dropzone({ 
    url: $('#hf_base_url').val() + "/upload/cms-related-image",
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
    transformFile: function(file, done) {
		  // Create Dropzone reference for use in confirm button click handler
		  var myUseravatar = this;
		  // Create the image editor overlay
		  var editor = document.createElement('div');
		  editor.style.position = 'fixed';
		  editor.style.left = 0;
		  editor.style.right = 0;
		  editor.style.top = 0;
		  editor.style.bottom = 0;
		  editor.style.zIndex = 9999;
		  editor.style.backgroundColor = '#000';
		  document.body.appendChild(editor);
		  // Create close button at the top left of the viewport
		  var buttonClose = document.createElement('button');
		  buttonClose.style.position = 'absolute';
		  buttonClose.style.left = '100px';
		  buttonClose.style.top = '10px';
		  buttonClose.style.zIndex = 9999;
		  buttonClose.textContent = 'Close';
		  buttonClose.setAttribute("class", "btn btn-default");
		  editor.appendChild(buttonClose);
		  buttonClose.addEventListener('click', function() {
		  	window.location.href = window.location.href;
		  });

		  // Create confirm button at the top left of the viewport
		  var buttonConfirm = document.createElement('button');
		  buttonConfirm.style.position = 'absolute';
		  buttonConfirm.style.left = '10px';
		  buttonConfirm.style.top = '10px';
		  buttonConfirm.style.zIndex = 9999;
		  buttonConfirm.textContent = 'Crop';
		  buttonConfirm.setAttribute("class", "btn btn-success");
		  editor.appendChild(buttonConfirm);
		  buttonConfirm.addEventListener('click', function() {
		    // Get the canvas with image data from Cropper.js
		    var canvas = cropper.getCroppedCanvas({
		      // width: 300,
		      // height: 250
		    });
		    // Turn the canvas into a Blob (file object without a name)
		    canvas.toBlob(function(blob) {
		      // Create a new Dropzone file thumbnail
		      myUseravatar.createThumbnail(
		        blob,
		        myUseravatar.options.thumbnailWidth,
		        myUseravatar.options.thumbnailHeight,
		        myUseravatar.options.thumbnailMethod,
		        false, 
		        function(dataURL) {
		          
		          // Update the Dropzone file thumbnail
		          myUseravatar.emit('thumbnail', file, dataURL);
		          // Return the file to Dropzone
		          done(blob);
		      });
		    });
		    // Remove the editor from the view
		    document.body.removeChild(editor);
		  });
		  // Create an image node for Cropper.js
		  var image = new Image();
		  image.src = URL.createObjectURL(file);
		  editor.appendChild(image);
		  
		  // Create Cropper.js
		  var cropper = new Cropper(image, { aspectRatio: 1 / 1,
		  	  crop(event) {
			    console.log(event.detail.width);
			    console.log(event.detail.height);

			    var textWidth = document.createElement('div');
					  textWidth.style.position = 'absolute';
					  textWidth.style.left = '10px';
					  textWidth.style.top = '60px';
					  textWidth.style.zIndex = 9999;
					  textWidth.setAttribute("class", "crop-text");
					  textWidth.textContent = event.detail.width.toFixed(0) + " X " + event.detail.height.toFixed(0);
					  editor.appendChild(textWidth);
			  }
		   });

		      this.on("maxfilesexceeded", function(file){
		          swal("" , "maxfilesexceeded_msg");
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
		          $('.useravatar-picture').find('img').attr('src', $('#base_url_image').val() + '/images/'+ responseText.name);
		          $('.useravatar-picture').show();
		          $('.no-useravatar-picture').hide();
		          $('#cmsUploadUseravatarPicture').modal('hide');
		          $('#hf_cms_useravatar_picture').val( 'images/'+ responseText.name );
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
    url: $('#hf_base_url').val() + "/upload/cms-related-image",
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
    transformFile: function(file, done) {
		  // Create Dropzone reference for use in confirm button click handler
		  var myBackgrounduser = this;
		  // Create the image editor overlay
		  var editor = document.createElement('div');
		  editor.style.position = 'fixed';
		  editor.style.left = 0;
		  editor.style.right = 0;
		  editor.style.top = 0;
		  editor.style.bottom = 0;
		  editor.style.zIndex = 9999;
		  editor.style.backgroundColor = '#000';
		  document.body.appendChild(editor);
		  // Create close button at the top left of the viewport
		  var buttonClose = document.createElement('button');
		  buttonClose.style.position = 'absolute';
		  buttonClose.style.left = '100px';
		  buttonClose.style.top = '10px';
		  buttonClose.style.zIndex = 9999;
		  buttonClose.textContent = 'Close';
		  buttonClose.setAttribute("class", "btn btn-default");
		  editor.appendChild(buttonClose);
		  buttonClose.addEventListener('click', function() {
		  	window.location.href = window.location.href;
		  });

		  // Create confirm button at the top left of the viewport
		  var buttonConfirm = document.createElement('button');
		  buttonConfirm.style.position = 'absolute';
		  buttonConfirm.style.left = '10px';
		  buttonConfirm.style.top = '10px';
		  buttonConfirm.style.zIndex = 9999;
		  buttonConfirm.textContent = 'Crop';
		  buttonConfirm.setAttribute("class", "btn btn-success");
		  editor.appendChild(buttonConfirm);
		  buttonConfirm.addEventListener('click', function() {
		    // Get the canvas with image data from Cropper.js
		    var canvas = cropper.getCroppedCanvas({
		      // width: 300,
		      // height: 250
		    });
		    // Turn the canvas into a Blob (file object without a name)
		    canvas.toBlob(function(blob) {
		      // Create a new Dropzone file thumbnail
		      myBackgrounduser.createThumbnail(
		        blob,
		        myBackgrounduser.options.thumbnailWidth,
		        myBackgrounduser.options.thumbnailHeight,
		        myBackgrounduser.options.thumbnailMethod,
		        false, 
		        function(dataURL) {
		          
		          // Update the Dropzone file thumbnail
		          myBackgrounduser.emit('thumbnail', file, dataURL);
		          // Return the file to Dropzone
		          done(blob);
		      });
		    });
		    // Remove the editor from the view
		    document.body.removeChild(editor);
		  });
		  // Create an image node for Cropper.js
		  var image = new Image();
		  image.src = URL.createObjectURL(file);
		  editor.appendChild(image);
		  
		  // Create Cropper.js
		  var cropper = new Cropper(image, { aspectRatio: 1 / 1,
		  	  crop(event) {
			    console.log(event.detail.width);
			    console.log(event.detail.height);

			    var textWidth = document.createElement('div');
					  textWidth.style.position = 'absolute';
					  textWidth.style.left = '10px';
					  textWidth.style.top = '60px';
					  textWidth.style.zIndex = 9999;
					  textWidth.setAttribute("class", "crop-text");
					  textWidth.textContent = event.detail.width.toFixed(0) + " X " + event.detail.height.toFixed(0);
					  editor.appendChild(textWidth);
			  }
		   });

		      this.on("maxfilesexceeded", function(file){
		          swal("" , "maxfilesexceeded_msg");
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
		          $('.backgrounduser-picture').find('img').attr('src', $('#base_url_image').val() + '/images/'+ responseText.name);
		          $('.backgrounduser-picture').show();
		          $('.no-backgrounduser-picture').hide();
		          $('#cmsUploadBackgrounduserPicture').modal('hide');
		          $('#hf_cms_backgrounduser_picture').val( 'images/'+ responseText.name );
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
    url: $('#hf_base_url').val() + "/upload/cms-related-image",
    paramName: "mediabanner_picture", 
    acceptedFiles:  "image/*,.mp4", 
    uploadMultiple:false, 
    maxFiles:1, 
    autoProcessQueue: true, 
    parallelUploads: 100, 
    addRemoveLinks: true, 
    maxFilesize: 10,
    dataType:  'json',
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
    // init: function(file, done){
    transformFile: function(file, done) {
		  // Create Dropzone reference for use in confirm button click handler
	          var mymediabanner = this;
			  // Create the image editor overlay
			  var editor = document.createElement('div');
			  editor.style.position = 'fixed';
			  editor.style.left = 0;
			  editor.style.right = 0;
			  editor.style.top = 0;
			  editor.style.bottom = 0;
			  editor.style.zIndex = 9999;
			  editor.style.backgroundColor = '#000';
			  document.body.appendChild(editor);
			  // Create close button at the top left of the viewport
			  var buttonClose = document.createElement('button');
			  buttonClose.style.position = 'absolute';
			  buttonClose.style.left = '100px';
			  buttonClose.style.top = '10px';
			  buttonClose.style.zIndex = 9999;
			  buttonClose.textContent = 'Close';
			  buttonClose.setAttribute("class", "btn btn-default");
			  editor.appendChild(buttonClose);
			  buttonClose.addEventListener('click', function() {
			  	window.location.href = window.location.href;
			  });

			  // Create confirm button at the top left of the viewport
			  var buttonConfirm = document.createElement('button');
			  buttonConfirm.style.position = 'absolute';
			  buttonConfirm.style.left = '10px';
			  buttonConfirm.style.top = '10px';
			  buttonConfirm.style.zIndex = 9999;
			  buttonConfirm.textContent = 'Crop';
			  buttonConfirm.setAttribute("class", "btn btn-success");
			  editor.appendChild(buttonConfirm);
			  buttonConfirm.addEventListener('click', function() {
			    // Get the canvas with image data from Cropper.js
			    var canvas = cropper.getCroppedCanvas({
			    	  // width: 160,
					  // height: 90,
					  // minWidth: 256,
					  // minHeight: 256,
					  // maxWidth: 4096,
					  // maxHeight: 4096,
					  // fillColor: '#fff',
					  // imageSmoothingEnabled: true,
					  // imageSmoothingQuality: 'high',
			    });
			    // Turn the canvas into a Blob (file object without a name)
			    canvas.toBlob(function(blob) {
			      // Create a new Dropzone file thumbnail
			      mymediabanner.createThumbnail(
			        blob,
			        mymediabanner.options.thumbnailWidth,
			        mymediabanner.options.thumbnailHeight,
			        mymediabanner.options.thumbnailMethod,
			        false, 
			        function(dataURL) {
			          
			          // Update the Dropzone file thumbnail
			          mymediabanner.emit('thumbnail', file, dataURL);
			          // Return the file to Dropzone
			          done(blob);
			      });
			    });
			    // Remove the editor from the view
			    document.body.removeChild(editor);
			  });
			  // Create an image node for Cropper.js
			  var image = new Image();
			  image.src = URL.createObjectURL(file);
			  editor.appendChild(image);
			  
			  // Create Cropper.js
			  var cropper = new Cropper(image, { aspectRatio: 16 / 9,
			  	  crop(event) {
				    console.log(event.detail.width);
				    console.log(event.detail.height);

				    var textWidth = document.createElement('div');
					  textWidth.style.position = 'absolute';
					  textWidth.style.left = '10px';
					  textWidth.style.top = '60px';
					  textWidth.style.zIndex = 9999;
					  textWidth.setAttribute("class", "crop-text");
					  textWidth.textContent = event.detail.width.toFixed(0) + " X " + event.detail.height.toFixed(0);
					  editor.appendChild(textWidth);

				  }
			   });

			      this.on("maxfilesexceeded", function(file){
			          swal("" , "maxfilesexceeded_msg");
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
			          $('.mediabanner-picture').find('img').attr('src', $('#base_url_image').val() + '/images/'+ responseText.name);
			          $('.mediabanner-picture').show();
			          $('.img-div-default-mediabanner').hide();
			          $('.no-mediabanner-picture').hide();
			          $('#hf_cms_mediabanner_picture').val( 'images/'+ responseText.name );
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
		          swal("" , "maxfilesexceeded_msg");
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