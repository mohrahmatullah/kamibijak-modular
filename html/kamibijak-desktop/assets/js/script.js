/*--- Write Javascript Here ---*/
new WOW().init();

// Hamburger Mobile Menu
var $hamburger = $("#btn-nav");
$hamburger.on("click", function(e) {
  $hamburger.toggleClass('is-active');
  $('.nav-m').toggle();
  $('.bg-nav').toggle();
});

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

$('.bg-nav').on("click", function(e) {
  $('.nav-m').toggle();
  $('.bg-nav').toggle();
});


$('.high-c').owlCarousel({
  center:true,
  items:1,
  nav:true,
  loop:true,
  margin:15,
  stagePadding: 50,
  navText: ["<img src='./assets/img/next.svg' draggable='false' />","<img src='./assets/img/next.svg' draggable='false' />"],
  responsive:{
    768:{
      items:3
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

