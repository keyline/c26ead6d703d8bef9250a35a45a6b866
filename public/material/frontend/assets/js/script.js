
//navigation-part start

//navigation



//navigation-part end





//search




$(document).ready(function() {
    var brandSlider = $('#commodites-artist');
    brandSlider.owlCarousel({
    loop: true,
    margin: 20,
    dots: false,
    nav: true,
    autoplay: false,
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    navText: ["<i class='zmdi zmdi-arrow-left'></i>", "<i class='zmdi zmdi-arrow-right'></i>"],
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1.2,
        },
        750: {
            items: 2.2,
        },
        1000: {
            items: 2.2,
        }
    }
})
function brandSliderClasses() {
    brandSlider.each(function() {
        var total = $(this).find('.owl-item.active').length;
        $(this).find('.owl-item').removeClass('firstactiveitem');
        $(this).find('.owl-item').removeClass('lastactiveitem');
        $(this).find('.owl-item.active').each(function(index) {
            if (index === 0) {
                $(this).addClass('firstactiveitem')
            }
            if (index === total - 1 && total > 1) {
                $(this).addClass('lastactiveitem')
            }
        })
    })
}
brandSliderClasses();
brandSlider.on('translated.owl.carousel', function(event) {
    brandSliderClasses()
}); 

    $('#homefade-slider').owlCarousel({
        animateOut: 'fadeOut',
        items:1,
        loop: true,
        margin:30,
        autoplay: false,
        autoplayTimeout: 4000,
        stagePadding:30,
        smartSpeed:450,
        nav: true,
        dots: false,
        navText: ["<i class='zmdi zmdi-arrow-left'></i>", "<i class='zmdi zmdi-arrow-right'></i>"],
    });
	
	$("#home-feedbacks").owlCarousel({
        loop: true,
        margin: 20,
		dots: true,
		nav: false,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        navText: ["<i class='zmdi zmdi-arrow-left'></i>", "<i class='zmdi zmdi-arrow-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            750: {
                items: 2,
            },
            1000: {
                items: 2,
            },
            1200: {
                items: 2,
            }
        }
    });
	
	

    $("#home-successstories").owlCarousel({
        loop: true,
        margin: 20,
		dots: false,
		nav: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        navText: ["<i class='zmdi zmdi-arrow-left'></i>", "<i class='zmdi zmdi-arrow-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            750: {
                items: 3,
            },
            1000: {
                items: 4,
            },
            1200: {
                items: 6,
            }
        }
    });

    $("#sucess_board_listing").owlCarousel({
        animateOut: 'fadeOut',
        items:1,
        loop: true,
        margin:10,
        autoplay: false,
        autoplayTimeout: 4000,
        //stagePadding:30,
        smartSpeed:450,
        nav: true,
        dots: false,
        navText: ["<i class='zmdi zmdi-arrow-left'></i>", "<i class='zmdi zmdi-arrow-right'></i>"],
    });
    
	
	$("#blogdetails-recent").owlCarousel({
        loop: true,
        margin: 20,
		dots: false,
		nav: false,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        navText: ["<i class='zmdi zmdi-arrow-left'></i>", "<i class='zmdi zmdi-arrow-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            750: {
                items: 2,
            },
            1000: {
                items: 3,
            },
            1200: {
                items: 4,
            }
        }
    });
	
	$("#ourteam-carousel").owlCarousel({
        loop: true,
        margin: 20,
		dots: true,
		nav: false,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        navText: ["<i class='zmdi zmdi-arrow-left'></i>", "<i class='zmdi zmdi-arrow-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            750: {
                items: 2,
            },
            1000: {
                items: 3,
            },
            1200: {
                items: 4,
            }
        }
    });
	
	
	

    


    
  
   
 
});




$(document).ready(function() {
    //Horizontal Tab
    $('#parentHorizontalTab').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion
        width: 'auto', //auto or any width like 600px
        fit: true, // 100% fit in a container
        tabidentify: 'hor_1', // The tab groups identifier
        activate: function(event) { // Callback function if tab is switched
            var $tab = $(this);
            var $info = $('#nested-tabInfo');
            var $name = $('span', $info);
            $name.text($tab.text());
            $info.show();
        }
    });

    
    
});


//$(window).scroll(function() {    
//    var scroll = $(window).scrollTop();
//
//    if (scroll >= 400) {
//        $(".header").addClass("sticky-header");
//    } else {
//        $(".header").removeClass("sticky-header");
//    }
//});


// ============= Page right sticky form =================


function showProjectsbyCat( cat ){
  if ( cat == 'all'){
    $('#projects-hidden .project').each(function(){
       var owl   = $(".career-carousel");
       elem      = $(this).parent().html();

     
       owl.owlCarousel('add', elem).owlCarousel('update');
       $(this).parent().remove();
    });
  }else{
    $('#projects-hidden .project.'+ cat).each(function(){
       var owl   = $(".career-carousel");
       elem      = $(this).parent().html();

      owl.owlCarousel('add', elem).owlCarousel('update');
       $(this).parent().remove();
    });

    $('#projects-carousel .project:not(.project.'+ cat + ')').each(function(){
       var owl   = $(".career-carousel");
       targetPos = $(this).parent().index();
       elem      = $(this).parent();

       $( elem ).clone().appendTo( $('#projects-hidden') );
       owl.owlCarousel('remove', targetPos).owlCarousel('update');;
    });
  }
}

$(document).ready(function() {
  
    //Click event for filters
    $('#project-terms a').click(function(e){
        e.preventDefault();
        $('#project-terms a').removeClass('active');

        cat = $(this).attr('ID');
        $(this).addClass('active');
        showProjectsbyCat( cat );
        //alert('filtering'+ cat);
    });
  
   //Initialize owl carousel
	
	
    $("#projects-carousel").owlCarousel({
 		dots: true,
        margin:20,
    // Most important owl features
    	responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            750: {
                items: 3,
            },
            1000: {
                items: 3,
            },
            1200: {
                items: 4,
            }
        }
    }
  );
});


function inVisible(element) {
    //Checking if the element is
    //visible in the viewport
    var WindowTop = $(window).scrollTop();
    var WindowBottom = WindowTop + $(window).height();
    var ElementTop = element.offset().top;
    var ElementBottom = ElementTop + element.height();
    //animating the element if it is
    //visible in the viewport
    if ((ElementBottom <= WindowBottom) && ElementTop >= WindowTop)
        animate(element);
}

function animate(element) {
    //Animating the element if not animated before
    if (!element.hasClass('ms-animated')) {
        var maxval = element.data('max');
        var html = element.html();
        element.addClass("ms-animated");
        $({
            countNum: element.html()
        }).animate({
            countNum: maxval
        }, {
            //duration 5 seconds
            duration: 5000,
            easing: 'linear',
            step: function() {
                element.html(Math.floor(this.countNum) + html);
            },
            complete: function() {
                element.html(this.countNum + html);
            }
        });
    }
}
//When the document is ready
$(function() {
    //This is triggered when the
    //user scrolls the page
    $(window).scroll(function() {
        //Checking if each items to animate are
        //visible in the viewport
        $("h2[data-max]").each(function() {
            inVisible($(this));
        });
    })
});



$(document).ready(function() {
  // slick carousel
  $('.login_sidebar_testimorial').slick({
    dots: false,
    vertical: true,
	arrows: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    verticalSwiping: true,
    autoplay: true,
  	autoplaySpeed: 3000,
	  adaptiveHeight: true //add this line
  });
});



// surajit js

$('#timing-slider').owlCarousel({
    loop: true,
    nav: true,
    dots: false,
    navText: ["<i class='zmdi zmdi-arrow-left'></i>", "<i class='zmdi zmdi-arrow-right'></i>"],
    responsive: {
        0: {
            items: 3
        },
        600: {
            items: 4
        },
        800: {
            items: 5
        },
        1000: {
            items: 3
        },
        1400: {
            items: 4
        }
    }
});

$(document).ready(function(){
    $('.owl-item, .timing-box').click(function(){
        $(this).toggleClass('active').siblings().removeClass('active');
    });

    $('.time-picker-list li').click(function(){
        $(this).toggleClass('active').siblings().removeClass('active');
    });
});



