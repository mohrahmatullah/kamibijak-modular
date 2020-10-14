/*--- Write Javascript Here ---*/
new WOW().init();

// Hamburger Mobile Menu
var $hamburger = $("#btn-nav");
$hamburger.on("click", function(e) {
  $hamburger.toggleClass('is-active');
  $('.nav-m').toggleClass('active');
  $('.bg-nav').toggleClass('active');
});

var $clearMenuM = $(".clearMenuM");
$clearMenuM.on("click", function(e) {
  $hamburger.toggleClass("is-active");
  $('.nav-m').toggleClass("active");
  $('.bg-nav').toggleClass("active");
});

// Hamburger Mobile Menu
// var $hamburger = $(".hamburger");
// $hamburger.on("click", function(e) {
//   $hamburger.toggleClass("is-active");
// });

/*--- Scroll Top ---*/


$('#topBtn').click(function(){
  $('html, body').animate({scrollTop:0}, 'slow');
});

/*--- Run Modal on Load ---*/
function modalShow() {
  $('#modalsHome').modal('show')
}

window.onload = modalShow();

$(document).ready(function(){

  if (Modernizr.mq('(max-width: 767px)')) {
    $('.main').removeClass('');
  }
  
});

$('.high-c').owlCarousel({
  center: false,
  items: 1,
  nav: true,
  loop: false,
  margin: 15,
  slideBy: 3,
  navText: ["<img src='../../assets/frontend/img/next.svg' draggable='false' />","<img src='../../assets/frontend/img/next.svg' draggable='false' />"],
  responsive:{
    768:{
      items: 3
    }
  }
});

// var swiper = new Swiper('.high-c', {
//   slidesPerView: 2,
//   spaceBetween: 300,
//   freeMode: true,
//   navigation: {
//     nextEl: '.swip-next',
//     prevEl: '.swip-prev',
//   },
//   // breakpoints: {
//   //   1024: {
//   //     slidesPerView: 2,
//   //     spaceBetween: 15,
//   //   },
//   //   768: {
//   //     slidesPerView: 2,
//   //     spaceBetween: 15,
//   //   },
//   //   640: {
//   //     slidesPerView: 2,
//   //     spaceBetween: 15,
//   //   },
//   //   320: {
//   //     slidesPerView: 2,
//   //     spaceBetween: 15,
//   //   }
//   // },
// });

$('.src-btn-m').on("click", function(e) {
  $('.src-h-b').css('display', 'none');
  $('.src-h-a').css('opacity', 1);
});

/*Floating Code for Iframe Start*/
if (jQuery('iframe[src*="https://www.youtube.com/embed/"],iframe[src*="https://player.vimeo.com/"],iframe[src*="https://player.vimeo.com/"]').length > 0) {
  /*Wrap (all code inside div) all vedio code inside div*/
  jQuery('iframe[src*="https://www.youtube.com/embed/"],iframe[src*="https://player.vimeo.com/"]').wrap("<div class='iframe-parent-class'></div>");
  /*main code of each (particular) vedio*/
  jQuery('iframe[src*="https://www.youtube.com/embed/"],iframe[src*="https://player.vimeo.com/"]').each(function(index) {

      /*Floating js Start*/
      var windows = jQuery(window);
      var iframeWrap = jQuery(this).parent();
      var iframe = jQuery(this);
      var iframeHeight = iframe.outerHeight();
      var iframeElement = iframe.get(0);

      var close = false;

      if (close == false){
        windows.on('scroll', function() {
          var windowScrollTop = windows.scrollTop();
          var iframeBottom = iframeHeight + iframeWrap.offset().top;
          //alert(iframeBottom);
  
          if ((windowScrollTop > iframeBottom)) {
              iframeWrap.height(iframeHeight);
              iframe.addClass('stuck');
              // jQuery(".scrolldown").css({"display": "none"});
              $('.close-float-vid').css('display','block');
          } else {
              iframeWrap.height('auto');
              iframe.removeClass('stuck');
              $('.close-float-vid').css('display','none');
          }
  
        });
        /*Floating js End*/
      } else if (close == true ){
        windows.on('scroll', function() {
          return false;
        });
      }

      $('.close-float-vid').on("click", function(e) {
        iframe.removeClass('stuck');
        $(this).css('display','none');
        close = true;
      });
  });
}

/*Floating Code for Iframe End*/

// On Scroll Function
// window.onscroll = function() {myNavbar()};

// var navbar = document.getElementById("navheadExp");
// var sticky = navbar.offsetTop;

// function myNavbar() {
//   if (window.pageYOffset > sticky) {
//     navbar.classList.add("scrolled");
//     $('.explore-text').hide(100);
//     $('.head-category').show(100);
//   } else {
//     navbar.classList.remove("scrolled");
//     $('.explore-text').show(100);
//     $('.head-category').hide(100);
//   }
// };
