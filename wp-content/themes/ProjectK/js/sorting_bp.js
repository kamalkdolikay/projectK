/* SORTING */ 

jQuery.noConflict();

var $ = jQuery;

"use strict";
$(function(){

  var $container_blog = $('.masonry_ctn');



  $container_blog.isotope({
  itemSelector : '.ajax_post',
  layoutMode : 'masonry'
  });
    



	$('.masonry').find('img').load(function(){

		$container_blog.isotope('layout');
		


	}); 	
	
    $container_blog.isotope('layout');
});

