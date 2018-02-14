;(function($, window, undefined) {

	"use strict";

	jQuery(document).ready(function ($) {
		
		// Portfolio Isotope Filter

		// init Isotope
		var portfolioGrid = $('#portfolio-grid');

		portfolioGrid.imagesLoaded(function(){
		    portfolioGrid.isotope({
			    itemSelector: '.item',
			    layoutMode: 'fitRows',
			    "masonry": { "columnWidth": ".portfolio-grid-sizer" }
			});
		});

      	// filter functions
		var filterFns = {
		    // show if number is greater than 50
		    numberGreaterThan50: function() {
		      var number = $(this).find('.number').text();
		      return parseInt( number, 10 ) > 50;
		    },
		    // show if name ends with -ium
		    ium: function() {
		      var name = $(this).find('.name').text();
		      return name.match( /ium$/ );
		    }
		};

      	// bind filter button click
      	$('#projects-filter').on( 'click', 'a', function() {
		    var filterValue = $( this ).attr('data-filter');
		    // use filterFn if matches value
		    filterValue = filterFns[ filterValue ] || filterValue;
		    portfolioGrid.isotope({ filter: filterValue });
		    return false;
		});

      	// change is-checked class on buttons
		$('#projects-filter').each( function( i, buttonGroup ) {
	    	var $buttonGroup = $( buttonGroup );
	    	$buttonGroup.on( 'click', 'a', function() {
	      		$buttonGroup.find('.active').removeClass('active');
	      		$( this ).addClass('active');
	    	});
	  	});		
		
		
		
		// init Isotope (2nd)
		var portfolioGrider = $('#portfolio-grid-2');

		portfolioGrider.imagesLoaded(function(){
		    portfolioGrider.isotope({
			    itemSelector: '.item',
			    layoutMode: 'fitRows',
			    "masonry": { "columnWidth": ".portfolio-grid-sizer" }
			});
		});

      	// filter functions
		var filterFns = {
		    // show if number is greater than 50
		    numberGreaterThan50: function() {
		      var number = $(this).find('.number').text();
		      return parseInt( number, 10 ) > 50;
		    },
		    // show if name ends with -ium
		    ium: function() {
		      var name = $(this).find('.name').text();
		      return name.match( /ium$/ );
		    }
		};

      	// bind filter button click
      	$('#projects-filter-2').on( 'click', 'a', function() {
		    var filterValue = $( this ).attr('data-filter');
		    // use filterFn if matches value
		    filterValue = filterFns[ filterValue ] || filterValue;
		    portfolioGrider.isotope({ filter: filterValue });
		    return false;
		});

      	// change is-checked class on buttons
		$('#projects-filter-2').each( function( i, buttonGroup ) {
	    	var $buttonGroup = $( buttonGroup );
	    	$buttonGroup.on( 'click', 'a', function() {
	      		$buttonGroup.find('.active').removeClass('active');
	      		$( this ).addClass('active');
	    	});
	  	});		
		
		
		


	});

})(jQuery, window);
