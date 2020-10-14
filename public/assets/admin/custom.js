$(function () {
    $('.timestart').datetimepicker({
        inline: true,
        sideBySide: true,
        format: 'YYYY-MM-DD HH:mm:ss'
    });
});

$(function () {
    $('.expired').datetimepicker({
        inline: true,
        sideBySide: true,
        format: 'YYYY-MM-DD HH:mm:ss'
    });
});

$(function () {
    $('#datetimepicker12').datetimepicker({
        inline: true,
        sideBySide: true,
        format: 'YYYY-MM-DD HH:mm:ss'
    });
});

$(function () {
    $('#datepublished').datetimepicker({
        inline: true,
        sideBySide: true,
        format: 'YYYY-MM-DD HH:mm:ss'
    });
});
//Date picker
$.fn.datepicker.defaults.format = 'yyyy-mm-dd';
$('#start_date').datepicker({
  autoclose: true
});
$('#end_date').datepicker({
  autoclose: true
});

//Published Schedule
$(function() {
    $('#row_dim').hide(); 
    $('#type').change(function(){
        if($('#type').val() == '3') {
            $('#row_dim').show();
            $('#row_published').hide(); 
        } else {
            $('#row_dim').hide(); 
        } 
    });
});

//Published Schedule
$(function() {
    $('#row_published').hide(); 
    $('#type').change(function(){
        if($('#type').val() == '4') {
            $('#row_published').show();
            $('#row_dim').hide(); 
        } else {
            $('#row_published').hide(); 
        } 
    });
});

$('#field-official').change(function(){
    var val = $(this).prop('checked');
    $('.official-only')[val?'show':'hide']();
}).change();

//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
  checkboxClass: 'icheckbox_flat-green',
  radioClass   : 'iradio_flat-green'
})

//Colorpicker
$(function () {
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()
})

/* Text Editor HTML*/
$(function () {
  CKEDITOR.replace('text_editor_post_content')
  $('.textarea').wysihtml5()
})

/* Text Editor HTML*/
$(function () {
  CKEDITOR.replace('inputPageContent')
  $('.textarea').wysihtml5()
})

/* Datatable */
$(function() {
  $('#postTable').DataTable({
    //dom: '<"top"lBfrtip>',
    dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>> <'row'<'col-sm-12'tr>> <'row'<'col-sm-5'i><'col-sm-7'p>>",
    "order": [[ 4, "desc" ]],
    buttons: [
      {
        extend: 'collection',
        text: 'Export',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      }
    ]
  });
  $('#tagTable').DataTable({
    "order": [[ 1, "desc" ]]
  });
  $('#bannerTable').DataTable({
    "order": [[ 3, "desc" ]]
  });
  $('#tbl_gallery').DataTable({
    "order": [[ 3, "desc" ]]
  });
  $('#tbl_category').DataTable({
    "order": [[ 3, "asc" ]]
  });
});


$(function () {
  $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })



/* Select 2*/
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })

/* Slugify*/
function inputTitlePost() {
    var title = $(document).find("#post_title").val();
    // console.log(title);
    $(document).find("#post_meta_title").val(title);
    $(document).find("#post_slug").val(slugify(title));
    // document.getElementById("productTitleGoogle").textContent = title;
    // document.getElementById("inputTagSlug").textContent = slugify(title);
    // document.getElementById("seo_url_format").val(title);
}

function inputName() {
    var title = $(document).find("#inputTagName").val();
    // console.log(title);
    $(document).find("#inputTagMetaTitle").val(title);
    $(document).find("#inputTagSlug").val(slugify(title));
    // document.getElementById("productTitleGoogle").textContent = title;
    // document.getElementById("inputTagSlug").textContent = slugify(title);
    // document.getElementById("seo_url_format").val(title);
}

function inputNameCat() {
    var title = $(document).find("#name").val();
    // console.log(title);
    $(document).find("#metatitle").val(title);
    $(document).find("#slug").val(slugify(title));
    // document.getElementById("productTitleGoogle").textContent = title;
    // document.getElementById("inputTagSlug").textContent = slugify(title);
    // document.getElementById("seo_url_format").val(title);
}

function inputTitlePage() {
    var title = $(document).find("#inputPageTitle").val();
    // console.log(title);
    $(document).find("#inputPageMetaTitle").val(title);
    $(document).find("#inputPageSlug").val(slugify(title));
    // document.getElementById("productTitleGoogle").textContent = title;
    // document.getElementById("inputTagSlug").textContent = slugify(title);
    // document.getElementById("seo_url_format").val(title);
}

function slugify(text)
{
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
}

$(document).ready(function(){
       $('#yt_id').on('input', function() {
          $("#myIframe").attr("src","https://www.youtube.com/embed/"+$('#yt_id').val()+"?rel=0&amp;showinfo=0");
       });
     });

// $(document).ready(function(){
//    $('#yt_id').on('input', function() {
//       $("#myIframe").attr("src",$('#yt_id').val()+"?rel=0&amp;showinfo=0");
//    });
//  });

/* Select & Unselect */
function selectParentSub(el){
    $(el).parent().parent().parent().find('input[type=checkbox]').prop('checked', true);
}
function unselectParentSub(el){
    $(el).parent().parent().parent().find('input[type=checkbox]').prop('checked', false);
}
function unselectAll(){
    $('.prm-All').prop('checked', false);
}
function selectAll(){
    $('.prm-All').prop('checked', true);
}
function selectByClass(cls){
    $('.prm-' + cls).prop('checked', true);
}

// filter publisher
$(document).ready(function(){
  $("#publisherInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".dropdown-menu li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$('.publisherSelect').selectpicker();
$('.categorySelect').selectpicker();
$('.statusSelect').selectpicker();

// var tablePost = document.getElementById('example1');
//   if(tablePost){
//     $('#example1').DataTable( {
//         "order": [[ 0, "asc" ]],
//     } );
//   }

$('#formSaveProductTag').on('submit', function (e) {

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

  e.preventDefault();

  var url = $('#hf_base_url').val() + '/ajax/save-ajax-tag';

  $.ajax({
    type: 'POST',
    url: url,
    data: $('#formSaveProductTag').serialize(),
    success: function (data) {
      // alert('form was submitted');

      if(data.error_no_entered == false){
        swal("" , "Sorry, name and slug can't be empty");
      }
      else if(data.duplicate_entry == false){
        swal("" , "Sorry, name and slug already exists");         
      }
      else if(data.success == true){
        $('#createTagsModal').modal('hide');
        $("#selectPostTag").load(location.href + " #selectPostTag>*","");
        swal("Good job!", "Your item has beed successfully saved", "success");
      }
      

      // var theSelect = document.getElementById('selectPostTag');
      // var lastValue = theSelect.options[theSelect.options.length - 1].value;

      // for (var i in people)
      // {
      //     var opt = "<option>" + people[i].inputTagName +"</option>";
      //     $('#selectPostTag').append(opt)
      // }

      // var theSelect = document.getElementById('selectPostTag');
      // var lastValue = theSelect.options[theSelect.options.length - 1].value;



      // $("#selectPostTag").append("<option value="+.lastValue.+">dzd</option>")

      // window.location = $("#selectPostTag select option:selected").val();
      // $("select option:last").prop("selected", "selected");
      // $('#selectPostTag :selected').select.options.length-1;
      // $('#selectPostTag').on("select2:selecting", function(e) { 
      //    console.log('test');
      // });
      // $('#selectPostTag').on("select2:select", function(e) { 
      //      console.log('test'); 
      // });
      // var theSelect = document.getElementById('selectPostTag');
      // var lastValue = theSelect.options[theSelect.options.length - 1].value;

      // $("#selectProductTag").value = data-1;
      // $("#selectProductTag").trigger('change');
      // var currID = $("#selectProductTag").val();

      // console.log(currID);
      // $("#selectProductTag").select2('val', data, true).trigger('change');
      // $("#selectProductTag").select2('data', {id: '123', text: 'res_data.primary_email'});
      // $('#formSaveProductTag').reset();
    }
  });   

});

$('document').ready(function()
{
    $('textarea').each(function(){
            $(this).val($(this).val().trim());
        }
    );
});