// wow
new WOW().init();

// Aos
AOS.init();


$(window).on("load",function(){
  setTimeout(() => {
    $("#loader").slideUp(1000)
  }, 2900);
});


//-----
$('#owl-demo').owlCarousel({
  loop:true,
  margin:10,
  nav:false,
  responsiveClass:true,
  rtl:true,
  dots:false,
  autoplay:true,
  responsive:{
      0:{
          items:1,
          
      },
      500:{
        items:1,
     },
      600:{
          items:3,
      },
      1000:{
        items:4,
     },
      1200:{
          items:4,
      },

      1700:{
        items:4,
    }

  
  }
})

$(window).on("load", function () {

  var textWrappers = document.querySelector('.gomaa h2');
  textWrappers.innerHTML = textWrappers.textContent.replace(/\S/g, "<span class='text'>$&</span>");  

  anime({
    loop: true,
    targets: '.gomaa .text',
    translateY: -20,
    direction: 'alternate',
    loop: true,
    delay: function(el, i, l) {
      return i * 50;
    },
    endDelay: function(el, i, l) {
      return (l - i) * 50;
    }

  })

});



//input validation 
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();





//scorll
$('#scroll-1').click(function() {
    $('html, body').animate({
        scrollTop: $($(this).attr('href')).offset().top - 100
    }, 1000);
    return false;
  });
  


$("#times-ican").click(function() {
  $(this).toggleClass("active");
  $("#menu-div").toggleClass("active")

})

var $winl = $(window); // or $box parent container
var $boxl = $("#menu-div, #times-ican");
$winl.on("click.Bst", function(event) {
  if (
      $boxl.has(event.target).length === 0 && //checks if descendants of $box was clicked
      !$boxl.is(event.target) //checks if the $box itself was clicked
  ) {
      $("#menu-div").removeClass("active")
      $("#times-ican").removeClass("active")
  }
});





$(".circle_percent").each(function() {
  var $this = $(this),
  $dataV = $this.data("percent"),
  $dataDeg = $dataV * 3.6,
  $round = $this.find(".round_per");
$round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");	
$this.append('<div class="circle_inbox"><span class="percent_text"></span></div>');
$this.prop('Counter', 0).animate({Counter: $dataV},
{
  duration: 2000, 
  easing: 'swing', 
  step: function (now) {
          $this.find(".percent_text").text(Math.ceil(now)+"%");
      }
  });
if($dataV >= 51){
  $round.css("transform", "rotate(" + 360 + "deg)");
  setTimeout(function(){
    $this.addClass("percent_more");
  },1000);
  setTimeout(function(){
    $round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
  },1000);
} 
});






