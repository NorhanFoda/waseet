/** @format */

$(document).ready(function () {
  ScrollOut({
    targets: ".job,.card",
  });

  // prespective Anim --------------------------------------------------

  VanillaTilt.init(document.querySelector(".img"), {
    max: 25,
    speed: 200,
    glare: true,
    maxGlare: 0.5,
  });

  //It also supports NodeList
  VanillaTilt.init(document.querySelectorAll(".img"));

  VanillaTilt.init(document.querySelector(".pack"), {
    max: 35,
    speed: 500,
    glare: true,
    maxGlare: 0.5,
  });

  //It also supports NodeList
  VanillaTilt.init(document.querySelectorAll(".pack"));

  VanillaTilt.init(document.querySelector("img"), {
    max: 35,
    speed: 200,
    glare: true,
    maxGlare: 0.5,
  });

  //It also supports NodeList
  VanillaTilt.init(document.querySelectorAll("img"));

  // prespective Anim --------------------------------------------------

  // owl carousel ------------------------------------------------------
  $(".slider .owl-carousel").owlCarousel({
    loop: true,
    rtl:true,
    margin: 0,
    nav: false,
    dots: true,
    smartSpeed: 800,
    items: 1,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1,
      },
      1000: {
        items: 1,
      },
    },
  });
  // owl carousel ------------------------------------------------------

  // AOS ------------------------------------------------------

  AOS.init({
    offset: 200,
    duration: 1000,
  });

  // AOS ------------------------------------------------------

  // typed js -------------------------------------------------
  // $(document).ready(function () {
  //   var typed = new Typed(".typed", {
  //     strings: ["مرحبا بك فى موقع وسيط المعلم . . ! ^1500"],
  //     smartBackspace: true, // Default value
  //     typeSpeed: 50,
  //     backSpeed: 20,
  //     loop: true,
  //   });
  // });
  // typed js -------------------------------------------------

  // side bar menu
  $(".humburger img").on("click", function () {
    $(".menu").addClass("active");
  });


  $("#menu-close").on("click", function () {
    $(".menu").removeClass("active active2");
  });

  
$(function() {
  var $winm = $(window); // or $box parent container
  var $boxm = $(".menu, .humburger img,#login-choose");
  $winm.on("click.Bst", function(event) {
      if (
          $boxm.has(event.target).length === 0 && //checks if descendants of $box was clicked
          !$boxm.is(event.target) //checks if the $box itself was clicked
      ) {
        $(".menu").removeClass("active");


      }
  });
});


        $('.humburger img').hover(
				
               function () {
    $(".menu").addClass("active");
               }
				
            
            );
                    $('.menu').hover(
				
               function () {
    $(".menu").addClass("active2");
               }, 
				
               function () {
    $(".menu").removeClass("active active2");
               }
            );
//nav scroll
$(window).scroll(function() {
  var welcome_height = $(".welcome").outerHeight();
  var nav_height = $(".navBar").outerHeight();
 var header_height = welcome_height + nav_height;
  if ($(this).scrollTop() > header_height) {
      $(".navBar").addClass("scrolling");
  } else {
      $(".navBar").removeClass("scrolling");
  }
});


  // end side bar menu

  // start search
  $(".search img").click(function (e) {
    e.preventDefault();
    $(".search").toggleClass("active");
  });
  // end search
});

$(function() {
  var $wins = $(window); // or $box parent container
  var $boxs = $(".search");
  $wins.on("click.Bst", function(event) {
      if (
          $boxs.has(event.target).length === 0 && //checks if descendants of $box was clicked
          !$boxs.is(event.target) //checks if the $box itself was clicked
      ) {
        $(".search").removeClass("active");


      }
  });
});


