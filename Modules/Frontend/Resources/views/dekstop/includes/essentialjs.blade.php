<!-- Import Jquery 3.3.1 -->
    <script mtype="text/javascript" src="{{url('assets/frontend/js/jquery-3.3.1.min.js')}}"></script>

    <!-- Import Bootstrap JS -->
    <script type="text/javascript" src="{{url('assets/frontend/js/bootstrap/bootstrap.min.js')}}"></script>

    <!-- Import Owl Carousel JS -->
    <script type="text/javascript" src="{{url('assets/frontend/js/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Import WOW JS -->
    <script type="text/javascript" src="{{url('assets/frontend/js/wow/wow.min.js')}}"></script>

	<!-- Import Nprogress JS -->
	<script type="text/javascript" src="{{ url('assets/frontend/js/nprogress/nprogress.js') }}"></script>

	<!-- Import Fancybox JS -->
	<script type="text/javascript" src="{{ url('assets/frontend/js/fancybox/jquery.fancybox.min.js') }}"></script>

    <!-- Import Javascript -->
    <script type="text/javascript" src="{{url('assets/frontend/js/script.js')}}"></script>

    <script type="text/javascript">
    	/* Script JS Pagging More */
		$(document).ready(function(){
		  $(document).on('click', '#loadmore',function(event)
		  {
		    event.preventDefault();
		    var myurl = $(this).attr('href');
		    var page=$(this).attr('href').split('page=')[1];
		    getData(page);
		  });
		});

		function getData(page){
		  $.ajax(
		  {
		    url: '?page=' + page,
		    type: "get",
		    datatype: "html",
		    beforeSend: function () {
		      NProgress.start();
		    },
		    success: function (data) {
		      $("#load-more").remove();
		      $("#list-terkini-ajax").append(data);
		      NProgress.done();
		    }                       
		  })

		  .fail(function(jqXHR, ajaxOptions, thrownError)
		  {
		    alert('No response from server');
		  });
		}
		/* \Script JS Pagging More */
    </script>

   <!--  <script type="text/javascript">
	  var page = 1;
	  $(window).scroll(function() {
	      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
	          page++;
	          loadMoreData(page);
	      }
	  });
	  
	  function loadMoreData(page){
	    $.ajax(
	          {
	              url: '?page=' + page,
	              type: "get",
	              beforeSend: function()
	              {
	                  $('.infinite-scroll').show();
	              }
	          })
	          .done(function(data)
	          {
	              if(data.html == " "){
	                  $('.infinite-scroll').html("No more Any records found");
	                  return;
	              }
	              $('.infinite-scroll').hide();
	              $("#user-data").append(data.html);
	          })
	          .fail(function(jqXHR, ajaxOptions, thrownError)
	          {
	                console.log('server not responding...');
	          });
	  }
	</script> -->

	<script type="text/javascript">
		document.getElementById('vid-iklan').play();
		var video = document.getElementById("vid-iklan");
		var button = document.getElementById("btn-skip");
		var firstRun = true;
		var embed_url = $('#embed_url').val();
		video.addEventListener("timeupdate", function(){
		    if(this.currentTime >= 5 && firstRun) {
		        this.play();
		        firstRun = false;
		        button.style = "display: block;right: 0px;line-height: 30px;cursor: pointer;text-align: center;top: 0;border: 0 none;background: rgba(0,0,0,.3);color: #FFFFFF;position: absolute;z-index: 1;text-decoration: none;";
		        $('#linkto').show();
		        $('#next-iklan').hide();
		    }
		});

		// video.addEventListener('ended', function(e) {
	 //        $('#vid-iklan').hide();
		//     $('#id-video').attr('src', embed_url + '?autoplay=1&mute=1');
		//     $('#btn-skip').hide();
		// 	$('#linkto').hide();
	 //    });

	     video.onended = function(e) {
		      	$('#vid-iklan').hide();
			    $('#id-video').attr('src', embed_url + '?autoplay=1&mute=1');
			    $('#btn-skip').hide();
				$('#linkto').hide();
		 };

     //    video.addEventListener('ended',myHandler,false);
		   //  function myHandler(e) {
		   //      if(!e) { e = window.event; }
		   //          $('#vid-iklan').hide();
				 //    $('#id-video').attr('src', embed_url + '?autoplay=1&mute=1');
				 //    $('#btn-skip').hide();
					// $('#linkto').hide();
		   //  }

		function skip(){
		    button.style = "";
			video.play();
			video.pause();
			video.currentTime = video.duration;
			$('#vid-iklan').hide();
			$('#id-video').attr('src', embed_url + '?autoplay=1');
			$('#btn-skip').hide();
			$('#linkto').hide();
		}

		var timeleft = 5;
		var downloadTimer = setInterval(function(){
		  document.getElementById("countdown").innerHTML = timeleft;
		  timeleft -= 1;
		  if(timeleft <= 1){
		    clearInterval(downloadTimer);
		    $('#vid-iklan').hide();
		    $('#id-video').attr('src', embed_url + '?autoplay=1&mute=1');
		    $('#btn-skip').hide();
			$('#linkto').hide();
			$('#next-iklan').hide();
		    // document.getElementById("countdown").innerHTML = "Finished";
		  }
		}, 1000);
	</script>