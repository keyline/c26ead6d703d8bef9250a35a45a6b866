





	jQuery(document).ready(function($) {
			jQuery('.stellarnav').stellarNav({
				theme: 'light',
				breakpoint: 991,
				position: 'right',
				phoneBtn: '(780) 743-1904',
				//locationBtn: 'https://www.google.com/maps'
			});
			
});

// $(window).scroll(function () {
//             if ($(this).scrollTop() > 250) {
//                 $('.main-header').addClass("sticky");
//             }
//             else {
//                 $('.main-header').removeClass("sticky");
//             }
//         });




var cc = $('#testimonial');
cc.owlCarousel({
    loop:true,	
	margin:0,
    nav:false,
	dots:true,
	smartSpeed:3000,
	//mouseDrag:false,
    autoplay:true,
    //animateOut: 'slideOutUp',
    items: 1,
	//navText: [ '<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>' ],
	
});







