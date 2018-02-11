'use strict';

// Cache
var body = $('body');
var tranding = $('#tranding');
var Bathroom = $('#Bathroom');
var Deals = $('#Todays-Deals');
var Related = $('#Related');


// Slide in/out with fade animation function
jQuery.fn.slideFadeToggle  = function(speed, easing, callback) {
    return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
};
//
jQuery.fn.slideFadeIn  = function(speed, easing, callback) {
    return this.animate({opacity: 'show', height: 'show'}, speed, easing, callback);
};
jQuery.fn.slideFadeOut  = function(speed, easing, callback) {
    return this.animate({opacity: 'hide', height: 'hide'}, speed, easing, callback);
};

jQuery(document).ready(function () {  
    
    // Sliders
    // ---------------------------------------------------------------------------------------
    if ($().owlCarousel) {
       
        
        // tranding carousel
        if (tranding.length) {
            tranding.owlCarousel({
                autoplay: false,
                loop: true,
                margin:0,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 2},
                    768: {items: 3},
                    991: {items: 4},
                    1024: {items: 4},
                    1280: {items: 5}
                }
            });
        }
		
		// Bathroom carousel
        if (Bathroom.length) {
            Bathroom.owlCarousel({
                autoplay: false,
                loop: true,
                margin:0,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 2},
                    768: {items: 3},
                    991: {items: 4},
                    1024: {items: 4},
                    1280: {items: 5}
                }
            });
        }
		
		// Todays-Deals carousel
        if (Deals.length) {
            Deals.owlCarousel({
                autoplay: false,
                loop: true,
                margin:0,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 2},
                    768: {items: 3},
                    991: {items: 4},
                    1024: {items: 4},
                    1280: {items: 5}
                }
            });
        }
		
		// relater carousel
        if (Related.length) {
            Related.owlCarousel({
                autoplay: false,
                loop: true,
                margin:0,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 2},
                    768: {items: 3},
                    991: {items: 3},
                    1024: {items: 3},
                    1280: {items: 4}
                }
            });
        }
        
      
    }
    
    
});



