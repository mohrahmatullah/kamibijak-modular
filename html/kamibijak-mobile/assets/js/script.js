/*--- Write Javascript Here ---*/
new WOW().init();

// Hamburger Mobile Menu
var $hamburger = $(".hamburger");
$hamburger.on("click", function(e) {
  $hamburger.toggleClass("is-active");
  $('#header-m').toggle();
});

/*--- Slick ---*/

$('.about-head-slider').slick({
  arrows: false,
  dots: false,
  infinite: true,
  speed: 100,
  autoplay: true,
  fade: true,
  cssEase: 'linear'
});

$('.slick-carousel').slick({
  centerMode: true,
  centerPadding: 0,
  slidesToShow: 5,
  //autoplay:true,
  arrows: true,
  infinite: true,
  prevArrow: $('.prevArrow'),
  nextArrow: $('.nextArrow'),
  responsive: [
    {
      breakpoint: 992,
      settings: {
        centerMode: true,
        centerPadding: 0,
        slidesToShow: 3,
        arrows: false,
        infinite: true,
        prevArrow: $('.prevArrow'),
        nextArrow: $('.nextArrow')
      }
    },
    {
      breakpoint: 768,
      settings: {
        centerMode: true,
        centerPadding: 0,
        slidesToShow: 3,
        arrows: false,
        infinite: true,
        prevArrow: $('.prevArrow'),
        nextArrow: $('.nextArrow')
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]

});

$('#shop-list').slick({
  centerMode: true,
  centerPadding: 0,
  slidesToShow: 3,
  autoplay:true,
  arrows: true,
  infinite: true,
  prevArrow: $('.prevArrow'),
  nextArrow: $('.nextArrow')

});

$('#shop-list-2').slick({
  centerMode: true,
  centerPadding: 0,
  slidesToShow: 3,
  autoplay:true,
  arrows: true,
  infinite: true,
  prevArrow: $('.prevArrowList2'),
  nextArrow: $('.nextArrowList2')

});

$('#shop-detail-list').slick({
  centerMode: true,
  centerPadding: 0,
  slidesToShow: 4,
  autoplay:true,
  arrows: true,
  infinite: true,
  prevArrow: $('.prevArrowList2'),
  nextArrow: $('.nextArrowList2')

});

$('.figure-slider').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  centerMode: true,
  arrows: true,
  autoplay: true,
  prevArrow: $('.prevArrowFigure'),
  nextArrow: $('.nextArrowFigure')
});

$('.news-carousel').slick({
  centerMode: true,
  centerPadding: 0,
  slidesToShow: 3,
  //autoplay:true,
  infinite: true,
  arrows: false,

});

/*--- /Slick ---*/

/*--- Scroll Top ---*/
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("topBtn").style.display = "block";
  } else {
    document.getElementById("topBtn").style.display = "none";
  }
}

/* When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}*/

$('#topBtn').click(function(){
  $('html, body').animate({scrollTop:0}, 'slow');
});

/*--- Run Modal on Load ---*/
function modalShow() {
  $('#modalsHome').modal('show')
}

window.onload = modalShow();