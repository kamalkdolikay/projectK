/* SORTING */ 

jQuery.noConflict();

var $ = jQuery;

"use strict";
$(function(){

  var $container_staff = $('.masonry_ctn');



  $container_staff.isotope({
  itemSelector : '.staff_post',
  layoutMode : 'masonry'
  });
    

  var $optionSets = $('#options .staffoptionset'),

	  $optionLinks = $optionSets.find('a');



  $optionLinks.click(function(){

	var $this = $(this);

	// don't proceed if already selected

	if ( $this.parent('li').hasClass('selected') ) {

	  return false;

	}

	var $optionSet = $this.parents('.staffoptionset');

	$optionSet.find('.selected').removeClass('selected');

	$optionSet.find('.fltr_before').removeClass('fltr_before');

	$optionSet.find('.fltr_after').removeClass('fltr_after');

	$this.parent('li').addClass('selected');

	$this.parent('li').next('li').addClass('fltr_after');

	$this.parent('li').prev('li').addClass('fltr_before');



	// make option object dynamically, i.e. { filter: '.my-filter-class' }

	var options = {},

		key = $optionSet.attr('data-option-key'),

		value = $this.attr('data-option-value');

	// parse 'false' as false boolean

	value = value === 'false' ? false : value;

	options[ key ] = value;

	if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {

	  // changes in layout modes need extra logic

	  changeLayoutMode( $this, options )

	} else {

	  // otherwise, apply new options

	  $container_staff.isotope(options);	  

	}	

	return false;	

  });

	$('.masonry').find('img').load(function(){

		$container_staff.isotope('layout');
		


	}); 	
	
    $container_staff.isotope('layout');
});

