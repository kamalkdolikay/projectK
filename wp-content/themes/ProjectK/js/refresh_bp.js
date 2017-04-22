/** refresh **/
"use strict";
jQuery.noConflict();

var $ = jQuery;


function watchblog() {

$(".masonry_ctn").isotope({
  // options
  itemSelector : '.ajax_post',
  layoutMode : 'masonry'
});

}

setInterval(watchblog, 100);