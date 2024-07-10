  $(document).ready(function () {

      // Helper function for add element box list in WOW
      WOW.prototype.addBox = function (element) {
        this.boxes.push(element);
      };

      // Init WOW.js and get instance
      var wow = new WOW();
      wow.init();

      // Attach scrollSpy to .wow elements for detect view exit events,
      // then reset elements and add again for animation
    //   $('.wow').on('scrollSpy:exit', function () {
    //     $(this).css({
    //       'visibility': 'hidden',
    //       'animation-name': 'none'
    //     }).removeClass('animated');
    //     wow.addBox(this);
    //   }).scrollSpy();

    });



      $('#banner-image').owlCarousel({
        loop:true,
        center: false,
        margin:50,
        nav:true,
        navText: ["<i class='fa fa-long-arrow-left' aria-hidden='true'></i>","<i class='fa fa-long-arrow-right' aria-hidden='true'></i>"],
        dots:false,
        autoplay:true,
        autoplayTimeout:6000,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })

      $('#banner-imageM').owlCarousel({
        loop:true,
        center: false,
        margin:50,
        nav:true,
        navText: ["<i class='fa fa-chevron-left' aria-hidden='true'></i>","<i class='fa fa-chevron-right' aria-hidden='true'></i>"],
        dots:false,
        autoplay:true,
        autoplayTimeout:6000,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })

$('#testimonial-slider').owlCarousel({
  loop: true,
  nav: false,
  margin: 10,
  dots:false,
  autoplay: false,
  navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  autoplayTimeout: 2500,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

$('#similar-products').owlCarousel({
	autoplay:false,
	autoplayTimeout:1000,
    loop:false,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})





$('#product-detail-slider').owlCarousel({
        loop:true,
        margin:20,
        // autoplay:true,
        // autoplayTimeout:3000,
        // autoplayHoverPause:true,
        responsiveClass:true,
        dots: true,
        nav: false,
        navText : ['<span class="fa fa-arrow-left" aria-hidden="true"></span>','<span class="fa fa-arrow-right" aria-hidden="true"></span>'],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
      });







$('#video-slide').owlCarousel({
        loop:true,
        margin:20,
         autoplay:true,
         autoplayTimeout:3000,
         autoplayHoverPause:false,
    animateIn: 'flipInX',
        responsiveClass:true,
        dots: false,
        nav: false,
        navText : ['<span class="fa fa-arrow-left" aria-hidden="true"></span>','<span class="fa fa-arrow-right" aria-hidden="true"></span>'],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
      });








  $(window).scroll(function(){
    if ($(window).scrollTop() >= 1) {
        $('.header-bottom').addClass('fixed-header');
    }
    else {
        $('.header-bottom').removeClass('fixed-header');
    }
  });
  
  
  
  $(".button").click(function() {
  if ( $(this).hasClass( "deactivate" ) ) {
    $(this).removeClass("deactivate")
  }
  if ( $(this).hasClass( "active" ) ) {
    $(this).addClass("deactivate")
  }
  $(this).toggleClass("animate");
  $(this).toggleClass("active");
  $(this).toggleClass("inactive");
});
  
  

$('#feature-slide').owlCarousel({
    loop:true,
    center: true,
    margin:50,
    nav:false,
    dots:false,
    smartSpeed: 1000,
    autoplay:false,
    autoplayTimeout:2000,
    autoplayHoverPause:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
})

$('#product-slide').owlCarousel({
    loop:true,
    margin:20,
    nav:false,
    dots:false,
    smartSpeed: 1000,
    autoplay:false,
    autoplayTimeout:2000,
    autoplayHoverPause:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:4
        },
        1000:{
            items:4
        }
    }
})


$('#product-slide2').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    dots:false,
    smartSpeed: 1000,
    autoplay:false,
    autoplayTimeout:2000,
    autoplayHoverPause:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})



$('#product-slide3').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})



$('#product-slide4').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    dots:false,
    smartSpeed: 1000,
    autoplay:false,
    autoplayTimeout:2000,
    autoplayHoverPause:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})



$('#product-slide5').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    dots:false,
    smartSpeed: 1000,
    autoplay:false,
    autoplayTimeout:2000,
    autoplayHoverPause:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})



$('#product-slide6').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    dots:false,
    smartSpeed: 1000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})



  $('#testimonials-slider').owlCarousel({
        items:1,
        loop:true,
        margin:10,
        nav: true,
        navText : ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
        // autoplay:true,
        // autoplayTimeout:2000,
        // autoplayHoverPause:false,
        dots: false,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,
            },
            1000:{
                items:1,
            },
        }
      });
        /*----------------------------
 Gallery
------------------------------ */
    "use strict";
      $("a.gallery").prettyPhoto({theme: 'dark_rounded', social_tools:false});













$('.icon-wishlist').on('click', function(){
  $(this).toggleClass('in-wishlist');
});











