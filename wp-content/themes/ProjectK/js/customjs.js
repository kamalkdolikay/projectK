var j$ = jQuery;

j$.noConflict();

"use strict";
j$(document).ready(function(){
	
    j$('body').jpreLoader();

	var $window = j$(window);
    $window.unbind('scroll.parallaxSections').unbind('resize.parallaxSections');
    generate_fw_sections();
    generate_fwc_sections();
	fixwoowidget()
	j$(".post-attachement").fitVids();
	j$(".entry").fitVids();
	j$(".video_sc").fitVids();
	mobile_menu_position()
	
   
  

j$(window).load(function() {
	

  //////////////////////////////
 //*** Check Page Padding ***//	
//////////////////////////////
			
function vc_check() {

var fw_fd =	j$('#fw_c > .vc_row:first-child');
var fw_pt = j$('#fw_c > .vc_row:first-child').css('padding-top');
if( !j$("#fw_c > .vc_row:first-child").hasClass('full-width-content') && fw_pt == '0px' || fw_pt == '0' || fw_pt == '' ){
	fw_fd.css('padding-top','100px');
	
}

j$('li').next('br').remove();
j$('ul').next('br').remove();
j$('ul').prev('br').remove();

j$("p:empty").css('margin-bottom', '0');

j$(".wpb_row:empty").remove();
j$(".wpb_column:empty").remove();
j$(".wpb_wrapper:empty").remove();


j$('.vertical').each(function(){
	
var ul_height = j$(this).find('.tabs').height();

j$(this).find('.tab_content').css('min-height', ul_height );

})

}


setInterval(vc_check, 100);	



  //////////////////////////////
 //*** Section Wrapper fix***//	
//////////////////////////////



var wrapper = j$('.fw_section').parents('div[class^="wrapper"]');
var fw_c = j$('.fw_section').parents('div[id^="fw_c"]');
var section = j$('.fw_section').parents('div[class^="section"]');


wrapper.css('overflow','visible');
fw_c.css('padding','0');
section.css('overflow','hidden');





  //////////////////////////////
 //*** IE Style Limit Fix ***//	
//////////////////////////////




function isIE() {
    return (navigator.userAgent.toLowerCase().indexOf('msie ') != -1) || (!!navigator.userAgent.match(/Trident.*rv[:]*11\./));
}

j$(function() {
    if (isIE()) {
        //merging all the content in your generated styles
        var styles = j$("style").text();
        //getting rid of the many unneeded styles
        j$("style").remove();
        //Putting back all the styles into your document
        j$("head").append("<style>" + styles + "</style>");
    }
});


  /////////////////////////////////
 //*** FW section height fix ***//	
/////////////////////////////////


function fixHeight(){

	j$('.full-width-content').each(function(){
	if(j$(this).find('.vc_column_container').length > 1){
    var maxHeight = 0;
	j$(this).children('.vc_column_container').css('height','auto');
	j$('.full-width-content .vc_column_container').css('min-height','0');
    j$(this).children('.vc_column_container').each(function(){
       if (j$(this).outerHeight() > maxHeight) { maxHeight = j$(this).outerHeight(); j$(this).outerHeight(maxHeight);}else { j$(this).outerHeight(maxHeight); }
	});	
	j$(this).children('.vc_column_container').outerHeight(maxHeight);
	j$(this).find('#map_canvas').outerHeight(maxHeight);
	
	}
});

}


  /////////////////////////////////
 //*** Sub Menu height fix ***////	
/////////////////////////////////


function fixSubMenu(){

j$('nav > .sf-js-enabled > li:not(.rd_megamenu)').mouseover(function(){

var wapoMainWindowWidth = j$(window).width();
    // checks if third level menu exist         
    var subMenuExist = j$(this).find('.menu-item-has-children').length;            
    if( subMenuExist > 0){
        var subMenuWidth = j$(this).children('.sub-menu').width();
        var subMenuOffset = j$(this).children('.sub-menu').parent().offset().left + subMenuWidth;

        // if sub menu is off screen, give new position
        if((subMenuOffset + subMenuWidth) > wapoMainWindowWidth){                  
            var newSubMenuPosition = subMenuWidth ;
			 j$(this).addClass('left_side_menu');

        }else{
			 var newSubMenuPosition = subMenuWidth ;
           
			 j$(this).removeClass('left_side_menu');
		}
    }
 });
}

j$('.rd_megamenu a').on('mouseenter mouseleave', function () {

j$('.rd_megamenu ul').each(function(){
		if(j$(this).find('.mm_widget_area').length > 1){
	    	var maxHeight = 0;
			j$(this).children('.mm_widget_area').css('min-height','auto');
			j$('.mm_widget_area').css('min-height','0');
		    j$(this).children('.mm_widget_area').each(function(){
		    	if (j$(this).height() > maxHeight){ maxHeight = j$(this).height();}
				j$(this).css("min-height",maxHeight);
			})
			j$(this).children('.mm_widget_area').css("min-height",maxHeight);
		}
	
	});


});



j$(window).resize(function() {
    fixHeight();
	fixSubMenu();
	parallaxRowsBGCals();
	mobile_menu_position();
	fixwoowidget();
});
j$(document).ready(function(e) {
    fixHeight();
	fixSubMenu();
});



  /////////////////////////////////
 //***    Sticky Header    ***////	
/////////////////////////////////



j$(function() {
var sticky_navigation_offset_top = j$('.sticky_header').offset().top;
var sticky_navigation = function(){
	var scroll_top = j$(window).scrollTop();

	if (scroll_top > sticky_navigation_offset_top && j$('header').hasClass('fixed_header_left')) {
		var top_value = 0;
		if(j$('#wpadminbar').length >= 1) {
			var top_value = j$('#wpadminbar').outerHeight()+"px";
		}		
        j$('.mt_menu.sticky_header.menu_slide').css({ 'position': 'fixed', 'top':top_value, 'left':0, 'width':'100%'  });
		        
	}
	else if (scroll_top > sticky_navigation_offset_top && j$('#fixed_body_left').length < 1) {
		var top_value = 0;
		if(j$('#wpadminbar').length >= 1) {
			var top_value = j$('#wpadminbar').outerHeight()+"px";
		}
			
		j$('header').addClass('opaque_header');
		j$('header').addClass('shrinked_header'); 
        j$('.header_bottom_nav').addClass('opaque_header');			
		j$('header').addClass('shrinked_header'); 
        j$('header.sticky_header').css({ 'position': 'fixed', 'top':top_value, 'left':0, 'width':'100%',  "-moz-box-shadow": "0 2px 6px rgba(0,0,0,0.05) !important", "-webkit-box-shadow": "0 2px 6px rgba(0,0,0,0.05) !important", "box-shadow": "0 2px 6px rgba(0,0,0,0.05) !important"  });
        j$('.header_bottom_nav.sticky_header').css({ 'position': 'fixed', 'top':top_value, 'left':0, 'width':'100%'  });
        j$('.mt_menu.sticky_header.menu_slide').css({ 'position': 'fixed', 'top':top_value, 'left':0, 'width':'100%'  });
			if (j$(window).width() < 1020) { 
				j$("header.sticky_header").css("position", "relative");
				j$(".header_bottom_nav.sticky_header").css("position", "relative");
			}
	} else {
		j$('header').removeClass('opaque_header');				
		j$('header').removeClass('shrinked_header');			
		j$('.header_bottom_nav').removeClass('opaque_header');
        j$('header.sticky_header').css({'top':0,  'position': 'relative', "-moz-box-shadow": "0 2px 6px rgba(0,0,0,0.05) !important", "-webkit-box-shadow": "0 2px 6px rgba(0,0,0,0.05) !important", "box-shadow": "0 2px 6px rgba(0,0,0,0.05) !important" }); 
        j$('.header_bottom_nav.sticky_header').css({ 'position': 'relative', 'top':0 }); 
			if (j$(window).width() > 766) { 	
				j$('.mt_menu.sticky_header.menu_slide').css({ 'position': 'relative', 'top':top_value, 'left':0, 'width':'100%'  });
			}
	}   


};
     
sticky_navigation();

j$(window).scroll(function() {
	sticky_navigation();
});
	
 
});


if (j$(window).width() < 1020 && !j$('header').hasClass('fixed_header_left')) { 

j$("header").css("position", "relative");

}

  //////////////////////////
 //*** Opacity Scroll ***//	
//////////////////////////


j$(window).scroll(function () { 
           var st = j$(this).scrollTop();
        $('.opacity_scroll').each(function(index) {
            $(this).css({ 'opacity' : (1 - st/ $(this).offset().top) });
        })
});


  ///////////////////////
 //*** Parallax ef ***//	
///////////////////////




	function parallaxRowsBGSet(){
		j$('.rd_parallax_section').each(function(){
			 var bg = j$(this).css('background-image');
			 j$(this).find('.parallax_bg').css({'background-image': bg});
		});
	}


	function parallaxRowsBGCals(){
		j$('.rd_parallax_section').each(function(){
			 j$(this).find('.parallax_bg').css({'height': j$(this).outerHeight(true)*2.5, 'margin-top': '-' + (j$(this).outerHeight(true)*2.5)/2 + 'px' });
		});
	}


	// Create cross browser requestAnimationFrame method:
    window.requestAnimationFrame = window.requestAnimationFrame
     || window.mozRequestAnimationFrame
     || window.webkitRequestAnimationFrame
     || window.msRequestAnimationFrame
     || function(f){setTimeout(f, 1000/60)}


	var j$window = j$(window);
	var windowHeight = j$window.height();
	
	j$window.unbind('scroll.parallaxSections').unbind('resize.parallaxSections');
	j$window.unbind('resize.parallaxSectionsUpdateHeight');
	j$window.unbind('load.parallaxSectionsOffsetL');
	j$window.unbind('resize.parallaxSectionsOffsetR');

	j$window.on('resize.parallaxSectionsUpdateHeight',psUpdateWindowHeight);

	function psUpdateWindowHeight() {
		windowHeight = j$window.height();
	}

	function psUpdateOffset(j$this) {
		j$this.each(function(){
	  	    firstTop = j$this.offset().top;
		});
	}
	
	j$.fn.parallaxScroll = function(xpos, speedFactor, outerHeight) {
		var j$this = j$(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;
		
		//get the starting position of each element to have parallax applied to it		
		j$this.each(function(){
		    firstTop = j$this.offset().top;
		});
		
		
		j$window.on('resize.parallaxSectionsOffsetR',psUpdateOffset(j$this));
		j$window.on('load.parallaxSectionsOffsetL',psUpdateOffset(j$this));
	
		getHeight = function(jqo) {
			return jqo.outerHeight(true);
		};
		 
			
		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;
		
		// function to be called whenever the window is scrolled or resized

		var j$element, top, height, pos;

		function update(){

			pos = j$window.scrollTop();				
			
			j$this.each(function(){

				firstTop = j$this.offset().top;
				j$element = j$(this);
				top = j$element.offset().top;
				height = getHeight(j$element);

				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}

				var ua = window.navigator.userAgent;
		        var msie = ua.indexOf("MSIE ");

		        //for IE, Safari or any setup using the styled scrollbar default to animating the BG pos
		        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./) || navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
		        	j$this.find('.parallax_bg').css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px",0);
		        }
		       	//for Firefox/Chrome use a higher performing method
		        else  {
		        	j$this.find('.parallax_bg').transition({ 'y':  Math.round((firstTop - pos) * speedFactor) + "px"},0);


		        }              
				
			});
		}		

		 window.addEventListener('scroll', function(){ 
          requestAnimationFrame(update); 
        }, false)

		j$window.on('resize.parallaxSections',update);

		update();
	};
	
	
	j$('.rd_parallax_section .parallax_wrap').each(function(){
		var id = j$(this).attr('id');
	   $("#"+id+".parallax_wrap").parallaxScroll("50%",0.2);
	   parallaxRowsBGSet();
	   parallaxRowsBGCals();
	});
	
	



  ////////////////////////////
 //*** Sidebar category ***//
////////////////////////////


j$( ".cat-item" ).has( "ul" ).addClass("cat-got-children");

j$( ".children .cat-item" ).has( "ul" ).addClass("subcat-got-children");


var children = j$(".cat-item .children");

children.prev('a').click(function(event) {
	
	event.preventDefault();
	j$(this).next('.children').slideToggle();


}
)

j$('.cat-got-children a').click(function(event) {
	if(j$(this).parent('li').hasClass('cat-open')){
		j$(this).parent('li').removeClass('cat-open');
	}else{
		j$(this).parent('li').addClass('cat-open');
	}

 })  
 
j$('.subcat-got-children a').click(function(event) {
	if(j$(this).parent('li').hasClass('subcat-open')){
		j$(this).parent('li').removeClass('subcat-open');
	}else{
		j$(this).parent('li').addClass('subcat-open');
	}

 })   

j$('.subcat-got-children').click(function(event) { })
 
 
  ///////////////////////
 //*** Load TipTip ***//
///////////////////////


j$(".tagcloud a,.post-title h2 a,.star-rating,.show_review_form.button,.remove,.filter_param_desc,.comments-link,.zilla-likes,.product_list_widget li a").addClass("tiptip");
j$(".tiptip").tipTip({maxWidth: "auto", edgeOffset: 5});

});


  ////////////////////////////
 //*** Alert remove btn ***//
////////////////////////////



j$('.alert_del_btn').click(function () {
	
	
j$(this).parents('div[class^="alert"]').fadeOut(500);
	
});

j$('.woocommerce-error:before').click(function () {
	
	
j$(this).parents('.woocommerce-error').fadeOut(500);
	
});

function fixwoowidget(){

j$('.product_list_widget').each(function(){

var rightmargin = j$(this).width()-184;

j$(this).find('.star-rating').css('margin-right',rightmargin);

});

}

  ////////////////////////////////////////////////////////
 //*** To top effect / Same Page link scroll effect ***//
////////////////////////////////////////////////////////


j$(function() {
 j$('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = j$(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        j$('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});



var j$scrollTop = j$(window).scrollTop();

//starting bind
function toTopBind() {
	if( j$('#to_top').length > 0 && j$(window).width() > 1020) {
		
		if(j$scrollTop > 350){
			j$(window).on('scroll',hideToTop);
		}
		else {
			j$(window).on('scroll',showToTop);
		}
	}
}
toTopBind();

function showToTop(){
	
	if( j$scrollTop > 350 ){

		j$('#to_top').stop(true,true).animate({
			'bottom' : '30px'
		},350,'easeInOutCubic');	
		
		j$(window).off('scroll',showToTop);
		j$(window).on('scroll',hideToTop);
	}

}

function hideToTop(){
	
	if( j$scrollTop < 350 ){

		j$('#to_top').stop(true,true).animate({
			'bottom' : '-30px'
		},350,'easeInOutCubic');	
		
		j$(window).off('scroll',hideToTop);
		j$(window).on('scroll',showToTop);	
		
	}
}

//to top color
if( j$('#to_top').length > 0 ) {
	
	var j$windowHeight, j$pageHeight, j$footerHeight;
	
	function calcToTopColor(){
		j$scrollTop = j$(window).scrollTop();
		j$windowHeight = j$(window).height();
		j$pageHeight = j$('body').height();
		j$footerHeight = j$('#footer_bg').height();
		
		if( (j$scrollTop-35 + j$windowHeight) >= (j$pageHeight - j$footerHeight) && j$('#boxed').length == 0){
			j$('#to_top').addClass('filled');
		}
		
		else {
			j$('#to_top').removeClass('filled');
		}
	}
	
	j$(window).scroll(calcToTopColor);
	
	j$(window).resize(calcToTopColor);

}

//scroll up event
j$('body').on('click','#to_top, a[href="#top"]',function(){
	j$('body,html').stop().animate({
		scrollTop:0
	},800,'easeOutQuad')
	return false;
});


  /////////////////////////
 //*** Progress bar  ***//
/////////////////////////



      j$('.rd_pb_holder').waypoint(function () {
        j$(this).find('.progress_bar_sc').each(function (index) {
          var j$this = j$(this),
            bar = j$this.find('.pb_bg'),
            bar_stripe = j$this.find('.pb_stripe'),
            val = bar.data('percentage-value');

          setTimeout(function () {
            bar.css({"width":val + '%'});			
            bar_stripe.css({"width":val + '%'});
          }, index * 200);
        });
      }, { offset:'85%' });


  /////////////////////////
 //***   Pie Chart   ***//
/////////////////////////


 j$('.rd_pie_01').waypoint(function () {
		  

//======== CONFIGURATION WINDOW
//======== i made this configuration code here you can change value and experiment
var x = 260;//set the x - center here
var y = 200;//set the y - center here
var r = 154;//set the radius here
var linewidth=22;//set the line width here
var SET_PERCENTAGE = j$(this).children('.rd_pc_01').data('percentage-value');
var bar_color = j$(this).children('.rd_pc_01').data('bar-color');
var alt_color = j$(this).children('.rd_pc_01').data('bar-alt-color');

//======== 
var c = j$(this).children('.rd_pc_01').get(0);
var id =j$(this).attr('id');
var status = j$('#'+id +'.rd_pc_status');
var loaded = false;

window.onload = function() {

loaded = true;
}


var ROTATION = 0;
function setcanvas()
{
var ctx = c.getContext("2d");

ctx.translate(x,y);
ctx.rotate((Math.PI/180)*(-ROTATION));
ctx.translate(-x,-y);



ctx.clearRect(0,0,c.width,c.height);


}

function getPoint(c1,c2,radius,angle){
    return [c1+Math.cos(angle)*radius,c2+Math.sin(angle)*radius];
}

function setPercent(uplimit)
{
var ctx = c.getContext("2d");
ctx.beginPath();
ctx.translate(x,y);
ROTATION=270;
ctx.rotate((Math.PI/180)*ROTATION);
ctx.translate(-x,-y);
ctx.lineWidth = linewidth;//40
ctx.lineCap="round";
var my_gradient=ctx.createLinearGradient(-0,0,0,520);
my_gradient.addColorStop(0, bar_color);
my_gradient.addColorStop(1, alt_color);

ctx.strokeStyle=my_gradient;
ctx.arc(x,y,r,(Math.PI/180)*(uplimit),0);
ctx.globalAlpha=1;
ctx.stroke();



}

function callcanvas(degree)
{
setcanvas();
setPercent(360-degree);
}

var degree = parseInt((SET_PERCENTAGE*360)/100);
var start = 0;
var it = window.setInterval(function(){
callcanvas(start);
start++;
if(start == degree){start = degree;window.clearInterval(it);}
if(loaded) status.html( parseInt((start*100)/360)+'%');
},1);
j$(this).children('.rd_pc_01').removeClass('rd_pc_01');
	  
      }, { offset:'85%' });








 j$('.rd_pie_02').waypoint(function () {
		  

//======== CONFIGURATION WINDOW
//======== i made this configuration code here you can change value and experiment
var x = 260;//set the x - center here
var y = 200;//set the y - center here
var r = 194;//set the radius here
var linewidth=12;//set the line width here
var SET_PERCENTAGE = j$(this).children('.rd_pc_02').data('percentage-value');
var bar_color = j$(this).children('.rd_pc_02').data('bar-color');
var alt_color = j$(this).children('.rd_pc_02').data('bar-alt-color');
var track_color = j$(this).children('.rd_pc_02').data('track-color');
var p_color = j$(this).children('.rd_pc_02').data('percentage-color');
var bg_color = j$(this).children('.rd_pc_02').data('background-color');

//======== 
var c = j$(this).children('.rd_pc_02').get(0);
var id =j$(this).attr('id');
var status = j$('#'+id +'.rd_pc_status');
var loaded = false;

window.onload = function() {

loaded = true;
}


var ROTATION = 0;
function setcanvas()
{
var ctx = c.getContext("2d");

ctx.translate(x,y);
ctx.rotate((Math.PI/180)*(-ROTATION));
ctx.translate(-x,-y);



ctx.clearRect(0,0,c.width,c.height);






ctx.beginPath();
ctx.lineWidth = 170;
ctx.strokeStyle=bg_color;
ctx.arc(x,y,98+(linewidth/2),0,2*Math.PI);
ctx.stroke();
ctx.fillStyle = p_color;
ctx.fill();

}

function getPoint(c1,c2,radius,angle){
    return [c1+Math.cos(angle)*radius,c2+Math.sin(angle)*radius];
}

function setPercent(uplimit)
{
var ctx = c.getContext("2d");
ctx.beginPath();
ctx.translate(x,y);
ROTATION=270;
ctx.rotate((Math.PI/180)*ROTATION);
ctx.translate(-x,-y);
ctx.lineWidth = linewidth;//40
var my_gradient=ctx.createLinearGradient(-0,0,0,520);
my_gradient.addColorStop(0, bar_color);
my_gradient.addColorStop(1, alt_color);

ctx.strokeStyle=my_gradient;
ctx.arc(x,y,r,(Math.PI/180)*(uplimit),0);
ctx.globalAlpha=1;
ctx.stroke();




}

function callcanvas(degree)
{
setcanvas();
setPercent(360-degree);
}

var degree = parseInt((SET_PERCENTAGE*360)/100);
var start = 0;
var it = window.setInterval(function(){
callcanvas(start);
start++;
if(start == degree){start = degree;window.clearInterval(it);}
if(loaded) status.html( parseInt((start*100)/360)+'%');
},1);
j$(this).children('.rd_pc_02').removeClass('rd_pc_02');
	  
      }, { offset:'85%' });





      j$('.rd_pie_03').waypoint(function () {
		  

//======== CONFIGURATION WINDOW
//======== i made this configuration code here you can change value and experiment
var x = 260;//set the x - center here
var y = 200;//set the y - center here
var r = 190;//set the radius here
var linewidth=16;//set the line width here
var SET_PERCENTAGE = j$(this).children('.rd_pc_03').data('percentage-value');
var bar_color = j$(this).children('.rd_pc_03').data('bar-color');
var alt_color = j$(this).children('.rd_pc_03').data('bar-alt-color');
var track_color = j$(this).children('.rd_pc_03').data('track-color');
var p_color = j$(this).children('.rd_pc_03').data('percentage-color');
var bg_color = j$(this).children('.rd_pc_03').data('background-color');

//======== 
var c = j$(this).children('.rd_pc_03').get(0);
var id =j$(this).attr('id');
var status = j$('#'+id +'.rd_pc_status');
var loaded = false;

window.onload = function() {

loaded = true;
}


var ROTATION = 0;
function setcanvas()
{
var ctx = c.getContext("2d");

ctx.translate(x,y);
ctx.rotate((Math.PI/180)*(-ROTATION));
ctx.translate(-x,-y);



ctx.clearRect(0,0,c.width,c.height);


ctx.beginPath();
ctx.lineWidth = 16;
ctx.strokeStyle=track_color;
ctx.arc(x,y,r,0,2*Math.PI);
ctx.stroke();



ctx.beginPath();
ctx.lineWidth = 20;
ctx.strokeStyle=p_color;
ctx.arc(x,y,42+(linewidth/2),0,2*Math.PI);
ctx.stroke();
ctx.fillStyle = p_color;
ctx.fill();

ctx.beginPath();
ctx.lineWidth = 16;
ctx.strokeStyle=bg_color;
ctx.arc(x,y,178-(linewidth/2),0,2*Math.PI);
ctx.stroke();
}

function getPoint(c1,c2,radius,angle){
    return [c1+Math.cos(angle)*radius,c2+Math.sin(angle)*radius];
}

function setPercent(uplimit)
{
var ctx = c.getContext("2d");
ctx.beginPath();
ctx.translate(x,y);
ROTATION=270;
ctx.rotate((Math.PI/180)*ROTATION);
ctx.translate(-x,-y);
ctx.lineWidth = linewidth;//40
var my_gradient=ctx.createLinearGradient(-0,0,0,520);
my_gradient.addColorStop(0, bar_color);
my_gradient.addColorStop(1, alt_color);

ctx.strokeStyle=my_gradient;
ctx.arc(x,y,r,(Math.PI/180)*(uplimit),0);
ctx.globalAlpha=1;
ctx.stroke();




}

function callcanvas(degree)
{
setcanvas();
setPercent(360-degree);
}

var degree = parseInt((SET_PERCENTAGE*360)/100);
var start = 0;
var it = window.setInterval(function(){
callcanvas(start);
start++;
if(start == degree){start = degree;window.clearInterval(it);}
if(loaded) status.html( parseInt((start*100)/360)+'%');
},1);
j$(this).children('.rd_pc_03').removeClass('rd_pc_03');
	  
      }, { offset:'85%' });




 j$('.rd_pie_04').waypoint(function () {
		  

//======== CONFIGURATION WINDOW
//======== i made this configuration code here you can change value and experiment
var x = 170;//set the x - center here
var y = 100;//set the y - center here
var r = 84;//set the radius here
var SET_PERCENTAGE = j$(this).children('.rd_pc_04').data('percentage-value');
var bar_color = j$(this).children('.rd_pc_04').data('bar-color');
var alt_color = j$(this).children('.rd_pc_04').data('bar-alt-color');
var track_color = j$(this).children('.rd_pc_04').data('track-color');


//======== 
var c = j$(this).children('.rd_pc_04').get(0);
var id =j$(this).attr('id');
var status = j$('#'+id +'.rd_pc_status');
var loaded = false;

window.onload = function() {

loaded = true;
}


var ROTATION = 0;
function setcanvas()
{
var ctx = c.getContext("2d");

ctx.translate(x,y);
ctx.rotate((Math.PI/180)*(-ROTATION));
ctx.translate(-x,-y);

ctx.clearRect(0,0,c.width,c.height);
ctx.beginPath();
ctx.lineWidth = 4;
ctx.strokeStyle=track_color;
ctx.arc(x,y,r,0,2*Math.PI);
ctx.stroke();
}

function getPoint(c1,c2,radius,angle){
    return [c1+Math.cos(angle)*radius,c2+Math.sin(angle)*radius];
}

function setPercent(uplimit)
{
var ctx = c.getContext("2d");
ctx.beginPath();
ctx.translate(x,y);
ROTATION=270;
ctx.rotate((Math.PI/180)*ROTATION);
ctx.translate(-x,-y);
ctx.lineWidth = 4;

var my_gradient=ctx.createLinearGradient(-0,0,0,340);
my_gradient.addColorStop(0, bar_color);
my_gradient.addColorStop(1, alt_color);
ctx.strokeStyle=my_gradient;
ctx.arc(x,y,r,(Math.PI/180)*(uplimit),0);
ctx.stroke();


ctx.beginPath();
var a = getPoint(x,y,r,(Math.PI/180)*(uplimit))[0];
var b = getPoint(x,y,r,(Math.PI/180)*(uplimit))[1];
nr = 7;
ctx.arc(a,b,nr,0,2*Math.PI);
ctx.lineWidth = 4;
ctx.fillStyle = track_color;
ctx.fill();
ctx.fillStyle = bar_color;
ctx.stroke();

}

function callcanvas(degree)
{
setcanvas();
setPercent(360-degree);
}
var degree = parseInt((SET_PERCENTAGE*360)/100);
var start = 0;
var it = window.setInterval(function(){
callcanvas(start);
start++;
if(start == degree){start = degree;window.clearInterval(it);}
if(loaded) status.html( parseInt((start*100)/360)+'%');
},1);

j$(this).children('.rd_pc_04').removeClass('rd_pc_04');
	  
      }, { offset:'85%' });



      j$('.rd_pie_05').waypoint(function () {
		  

//======== CONFIGURATION WINDOW
//======== i made this configuration code here you can change value and experiment
var x = 260;//set the x - center here
var y = 200;//set the y - center here
var r = 160;//set the radius here
var linewidth=80;//set the line width here
var SET_PERCENTAGE = j$(this).children('.rd_pc_05').data('percentage-value');
var bar_color = j$(this).children('.rd_pc_05').data('bar-color');
var alt_color = j$(this).children('.rd_pc_05').data('bar-alt-color');
var track_color = j$(this).children('.rd_pc_05').data('track-color');
var ball_color = j$(this).children('.rd_pc_05').data('ball-color');

//======== 
var c = j$(this).children('.rd_pc_05').get(0);
var id =j$(this).attr('id');
var status = j$('#'+id +'.rd_pc_status');
var loaded = false;

var ctx = c.getContext("2d");
window.onload = function() {

loaded = true;
}


var ROTATION = 0;
function setcanvas()
{

ctx.translate(x,y);
ctx.rotate((Math.PI/180)*(-ROTATION));
ctx.translate(-x,-y);



ctx.clearRect(0,0,c.width,c.height);


ctx.beginPath();
ctx.lineWidth = 80;
ctx.strokeStyle=track_color;
ctx.arc(x,y,r,0,2*Math.PI);
ctx.stroke();



ctx.beginPath();
ctx.lineWidth = 4;
ctx.strokeStyle="black";
ctx.arc(x,y,r+(linewidth/2),0,2*Math.PI);
ctx.globalAlpha=0.02;
ctx.stroke();

ctx.beginPath();
ctx.lineWidth = 4;
ctx.strokeStyle="black";
ctx.arc(x,y,r-(linewidth/2),0,2*Math.PI);
ctx.stroke();
}

function getPoint(c1,c2,radius,angle){
    return [c1+Math.cos(angle)*radius,c2+Math.sin(angle)*radius];
}

function setPercent(uplimit)
{
ctx.beginPath();
ctx.translate(x,y);
ROTATION=270;
ctx.rotate((Math.PI/180)*ROTATION);
ctx.translate(-x,-y);
ctx.lineWidth = linewidth;//40
var my_gradient=ctx.createLinearGradient(-0,0,0,520);
my_gradient.addColorStop(0, bar_color);
my_gradient.addColorStop(1, alt_color);

ctx.strokeStyle=my_gradient;
ctx.arc(x,y,r,(Math.PI/180)*(uplimit),0);
ctx.globalAlpha=1;
ctx.stroke();


ctx.beginPath();
var a = getPoint(x,y,r,(Math.PI/180)*(uplimit))[0];
var b = getPoint(x,y,r,(Math.PI/180)*(uplimit))[1];
nr = linewidth/2;
ctx.lineWidth = 2;
ctx.strokeStyle=track_color;
ctx.arc(a,b,nr,0,2*Math.PI);
ctx.fillStyle=track_color;
ctx.fill();
ctx.stroke();

ctx.beginPath();
var a = getPoint(x,y,r,(Math.PI/180)*(uplimit))[0];
var b = getPoint(x,y,r,(Math.PI/180)*(uplimit))[1];
nr = linewidth/2-6;
ctx.lineWidth = 14;
ctx.strokeStyle=track_color;
ctx.arc(a,b,nr,0,2*Math.PI);
ctx.fillStyle= ball_color;
ctx.fill();
ctx.stroke();

}

function callcanvas(degree)
{
setcanvas();
setPercent(360-degree);
}

var degree = parseInt((SET_PERCENTAGE*360)/100);
var start = 0;
var it = window.setInterval(function(){
callcanvas(start);
start++;
if(start == degree){start = degree;window.clearInterval(it);}
if(loaded) status.html( parseInt((start*100)/360)+'%');
},1);
j$(this).children('.rd_pc_05').removeClass('rd_pc_05');
	  
      }, { offset:'85%' });


  /////////////////////////
 //*** Superfish box ***//	
/////////////////////////





	j$('header nav ul').superfish({
			 delay: 700,
			 speed: 'fast',
			 speedOut:      'fast',             
			 animation:   {opacity:'show'}
		}); 



	j$('.fixed_header_left nav ul').superfish({
			 delay: 700,
			 speed: 'fast',
			 speedOut:      'fast',             
			 animation:   {opacity:'show'}
		}); 



	j$('.header_bottom_nav nav ul').superfish({
			 delay: 700,
			 speed: 'fast',
			 speedOut:      'fast',             
			 animation:   {opacity:'show'}
		}); 







  /////////////////////////////////////
 //*** Create full width section ***//	
/////////////////////////////////////



function generate_fw_sections() {
	var j$fw_width;
	var j$width = j$(window).width();
	var j$padding_left = '40px';
	var j$padding_right = '40px';
	var j$margin_left = '-35px';

	if ( j$('#boxed_layout').hasClass('menu_slide')){
		j$fw_width = parseInt(j$('.menu_slide').width());

		if (j$width < 1200){
			var j$margin_left = '-30px';
			var j$padding_left = '30px';
			var j$padding_right = '30px';
			var j$fw_width = j$fw_width + 20;
		}

		if (j$width < 738){
			var j$margin_left = '-10px';
			var j$padding_left = '10px';
			var j$padding_right = '10px';
			var j$fw_width = j$fw_width + 40;
		}
		j$('.full-width-section').each(function(){
			j$(this).css({
				'margin-left': j$margin_left,
				'padding-left': j$padding_left,
				'padding-right': j$padding_right,
				'margin-right': '0px',
				'width': j$fw_width-80,
				'visibility': 'visible'
			});
				
		});
	}else if( j$('header').hasClass('fixed_header_left')){
		j$fw_width = ((j$('.menu_slide').width() - parseInt(j$('.section_wrapper').width())) / 2) + 1;

		j$('.full-width-section').each(function(){
			j$(this).css({
				'margin-left': -j$fw_width,
				'padding-left': j$fw_width,
				'padding-right': j$fw_width,
				'visibility': 'visible',
				'width': '100%',
				'margin-right': '0px'
			});
				
		});
	}
	 else {
		j$fw_width = ((j$(window).width() - parseInt(j$('.section_wrapper').width())) / 2) + 1;
		var j$width = j$(window).width();


		j$('.full-width-section').each(function(){
			j$(this).css({
				'margin-left': -j$fw_width,
				'padding-left': j$fw_width,
				'padding-right': j$fw_width,
				'visibility': 'visible',
				'width': '100%',
				'margin-right': '0px'
			});	
		});
	}
}



function generate_fwc_sections() {
	var j$fw_width;
	var j$width = j$(window).width();
	var j$padding_left = '0px';
	var j$padding_right = '0px';
	var j$margin_left = '-35px';

	if ( j$('#boxed_layout').hasClass('menu_slide')){
		j$fw_width = parseInt(j$('.menu_slide').width());

		if (j$width < 1200){
			var j$margin_left = '-30px';;
		}

		if (j$width < 738){
			var j$margin_left = '-10px';
		}

		j$('.full-width-content').each(function(){
			j$(this).css({
				'margin-left': j$margin_left,
				'padding-left': j$padding_left,
				'padding-right': j$padding_right,
				'margin-right': '0px',
				'width': j$fw_width,
				'visibility': 'visible'
			});	
		});
	}else if( j$('header').hasClass('fixed_header_left')){
		j$fw_width = ((j$('.menu_slide').width() - parseInt(j$('.section_wrapper').width())) / 2) + 1;
		j$width = j$('.menu_slide').width();

		j$('.full-width-content').each(function(){
			j$(this).css({
				'margin-left': -j$fw_width,
				'padding-left': 0,
				'padding-right': 0,
				'visibility': 'visible',
				'width': j$width,
				'margin-right': '0px'
			});
				
		});
	}
	  else {
		j$fw_width = ((j$(window).width() - parseInt(j$('.section_wrapper').width())) / 2) + 1;
		var j$width = j$(window).width();


		j$('.full-width-content').each(function(){
			j$(this).css({
				'margin-left': -j$fw_width,
				'padding-left': 0,
				'padding-right': 0,
				'visibility': 'visible',
				'width': j$width,
				'margin-right': '0px'
			});	
		});
	}
}

j$('.row_top_icon').each(function(){
	j$(this).parent('.vc_row-fluid').css('overflow','visible');
});
j$('.row_bottom_arrow').each(function(){
	j$(this).parent('.vc_row-fluid').css('overflow','visible');
});



  ///////////////////////
 //***Box list     ***//	
///////////////////////

j$('.rd_list_4').each(function() {
				var n = j$(this).children( "div" ).length;
				var width = 100/n;
				j$(this).children( "div" ).css("width", width+"%");
				j$(this).children( "div" ).addClass("rda_flipInY");				
			
			});


  ///////////////////////
 //***Count to     ***//	
///////////////////////

j$('.count_sc').each(function() {

				var countAsset = j$(this),
					countNumber = countAsset.find('.count_number'),
					countDivider = countAsset.find('.count_line').find('span'),
					countSubject = countAsset.find('.count_title');
				
					countNumber.countTo({
						onComplete: function () {
							countDivider.animate({
								'width': 50
							}, 400, 'easeOutCubic');
							countSubject.delay(100).animate({
								'opacity' : 1,
								'bottom' : '0px'
							}, 600, 'easeOutCubic');
						}
					});
				
			
			});








  //////////////////
 //*** Toggle ***//	
//////////////////




j$('.toggle-content').each(function() {

if(!j$(this).hasClass('default-open')){

j$(this).hide();

}

});

j$("div.toggle").click(function(){

if(j$(this).hasClass('active')){

j$(this).removeClass("active");

}else{

j$(this).addClass("active");

}

return false;

});

j$("div.toggle").click(function(){

j$(this).next(".toggle-content").slideToggle();

});




  ////////////////
 //*** Tabs ***//	
//////////////// 




j$('.tabs-wrapper').each(function() {
 var t = 1;
 
        j$(this).find('.tabli').each(function() {
            j$(this).find('a').attr('href', '#tab'+t);
            j$(this).parents('.tabs-wrapper').find('.tabs').append(this);
            t++;
        });
        /* GET ALL BODY */
        var t = 1;
        j$(this).find('.tab_content').each(function() {
			j$(this).attr('id', 'tab'+t);
            j$(this).parents('.tabs-wrapper').find('.tabs-container').append(this);
            t++;
        });
j$(this).find(".tab_content").hide(); //Hide all content

j$(this).find("ul.tabs li:first").addClass("active").show(); //Activate first tab

j$(this).find(".tab_content:first").show(); //Show first tab content

});

//On Click Event

j$("ul.tabs li").click(function(e) {

j$(this).parents('.tabs-wrapper').find("ul.tabs li").removeClass("active"); //Remove any "active" class

j$(this).addClass("active"); //Add "active" class to selected tab

j$(this).parents('.tabs-wrapper').find(".tab_content").hide(); //Hide all tab content

var activeTab = j$(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content

j$(this).parents('.tabs-wrapper').find(activeTab).fadeIn(); //Fade in the active ID content

e.preventDefault();

});

j$("ul.tabs li a").click(function(e) {

e.preventDefault();

});	






  /////////////////////////////
 //*** Change nav button ***//
/////////////////////////////      


var header_height = j$('#header_container').height();
if(!j$('header').hasClass('fixed_header_left')){
j$('#header_container').css('min-height', header_height);
}
if (j$(window).width() < 1020) { 
var mobilenav = 0;
j$("header nav ul,.header_bottom_nav nav ul").hide();
j$("#nav_button").show();
}

function mobile_menu_position() {


if(j$('header').hasClass('fixed_header_left')){
	if (j$(window).width() < 1035) {
		var top_value = 0;
		if(j$('#wpadminbar').length >= 1) {
			top_value = j$('#wpadminbar').outerHeight()+"px";
		}
		j$('.mt_menu.sticky_header.menu_slide').css({ 'position': 'fixed', 'top':top_value, 'left':0, 'width':'100%'  });
	}else {
		j$('.mt_menu.sticky_header.menu_slide').css({ 'position': 'relative', 'top':top_value, 'left':0, 'width':'100%'  });
	}
}
else {
	if (j$(window).width() < 768) {
		var top_value = 0;
		if(j$('#wpadminbar').length >= 1) {
			top_value = j$('#wpadminbar').outerHeight()+"px";
		}
		j$('.mt_menu.sticky_header.menu_slide').css({ 'position': 'fixed', 'top':top_value, 'left':0, 'width':'100%'  });
	}else {
		j$('.mt_menu.sticky_header.menu_slide').css({ 'position': 'relative', 'top':top_value, 'left':0, 'width':'100%'  });
	}
}

}



j$("<div id='nav_button' />").appendTo("header nav");
j$("<div id='nav_button' />").appendTo(".header_bottom_nav nav");


j$(window).resize(function() {
    generate_fw_sections();
	generate_fwc_sections();
	var m_height = j$("#sidebar").height();

	j$("#posts").css({
     minHeight: m_height
 	});


if (j$(window).width() > 1020) {

	j$("#mobile-menu").removeClass('mm_open');
	j$(".menu_slide").removeClass('slided_body');
	j$("header nav ul,.header_bottom_nav nav ul").show();
	j$("header nav ul a,.header_bottom_nav nav ul a").click(function(){
	j$("header nav ul,.header_bottom_nav nav ul").show();

})

}

if (j$(window).width() < 1020) { 
j$("header nav ul,.header_bottom_nav nav ul").hide();
j$("#nav_button").show();
}
});

j$(document).on("mousedown touchstart",function (e)
{
    var container = j$(".mm_open");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {

            j$("#mobile-menu").removeClass('mm_open');			
			j$(".menu_slide").removeClass('slided_body');

    }
});



    j$("#nav_button").click(function(e){ 
        if (j$("#mobile-menu").hasClass('mm_open')){

            j$("#mobile-menu").removeClass('mm_open');			
			j$(".menu_slide").removeClass('slided_body');

        } else {

            j$("#mobile-menu").addClass('mm_open');
			j$(".menu_slide").addClass('slided_body');
        }
		

    });
    j$("#close_mm").click(function(e){ 
 

            j$("#mobile-menu").removeClass('mm_open');			
			j$(".menu_slide").removeClass('slided_body');
 		

    });
	 j$("#nav_button_alt").click(function(e){ 
       if (j$("#mobile-menu").hasClass('mm_open')){

            j$("#mobile-menu").removeClass('mm_open');			
			j$(".menu_slide").removeClass('slided_body');

        } else {

            j$("#mobile-menu").addClass('mm_open');
			j$(".menu_slide").addClass('slided_body');
        }
		

    });
	    
		
		

j$('#mobile-menu .menu-item-has-children ').click(function(ev) {
    $(this).find('>ul').slideToggle();
	if($(this).hasClass('mobile-ul-open')){
		$(this).removeClass('mobile-ul-open');
	}else{
		$(this).addClass('mobile-ul-open');
		
	}
    ev.stopPropagation();

}
)
		

		
		
	
  ///////////////////////////////////
 //*** Portfolio filter effect ***//
///////////////////////////////////




j$(function() {




j$("#portfolio-filter li a").click(function(){

j$("#portfolio-filter li a").removeClass("active");

j$(this).addClass("active");

});

});









  ////////////////////////////
 //*** Load Flexsliders ***//
//////////////////////////// 





j$('.flexslider').flexslider({

animation: "slide",              //String: Select your animation type, "fade" or "slide"

slideDirection: "horizontal",

directionNav: true,

start: function(slider){ // init the height of the first item on start

var j$new_height = slider.slides.eq().height();     

slider.height(j$new_height);                                     

},          

before: function(slider){ // init the height of the next item before slide

var j$new_height = slider.slides.eq(slider.animatingTo).height();                

if(j$new_height != slider.height()){

slider.animate({ height: j$new_height  }, 400);

}

}          

});





  /////////////////////////////
 //*** Setup prettyPhoto ***//
/////////////////////////////




j$('.blog_post_single a').has('img').addClass('prettyPhoto');

j$('.blog_post_single a img').click(function () {  

var desc = j$(this).attr('title');  

j$('.blog_post_single a').has('img').attr('title', desc);  

});

j$("a[class^='prettyPhoto']").prettyPhoto({

opacity: 0.50,

theme: 'light_square',

show_title: false,

horizontal_padding: 20,

social_tools: false

});

j$("a[rel^='prettyPhoto']").prettyPhoto({

opacity: 0.50,

theme: 'light_square',

show_title: false,

horizontal_padding: 20,

social_tools: false

});

j$('#page_content a').has('img').addClass('prettyPhoto');

j$('#page_content a img').click(function () {  

var desc = j$(this).attr('title');  

j$('#page_content a').has('img').attr('title', desc);  

});

j$("a[class^='prettyPhoto']").prettyPhoto({

opacity: 0.50,

theme: 'light_square',

show_title: false,

horizontal_padding: 20,

social_tools: false

});


  /////////////////////////////
 //***  Footer Heading   ***//
/////////////////////////////


j$('.footer_type_3 .widget h2').each(function(){
    var me = j$(this);
    me.html( me.text().replace(/(^\w+|\s+\w+)/,'<strong>$1</strong>') );
  });
  
 

  /////////////////////////////
 //***  Module animation ***//
/////////////////////////////






(function(j$) {

  j$.fn.visible = function(partial) {
    
      var j$t            = j$(this),
          j$w            = j$(window),
          viewTop       = j$w.scrollTop(),
          viewBottom    = viewTop + j$w.height(),
          _top          = j$t.offset().top+100,
          _bottom       = _top + j$t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;
    
    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

  };
    
})(jQuery);

var win = j$(window);
var allMods = j$(".rda_opacity,.rda_toleft,.rda_toright,.rda_totop,.rda_tobottom,.rd_chart_black,.rd_chart_white,.rda_fadeIn,.rda_fadeInDown,.rda_fadeInUp,.rda_fadeInLeft,.rda_fadeInRight,.rda_bounceIn,.rda_bounceInDown,.rda_bounceInUp,.rda_bounceInLeft,.rda_bounceInRight,.rda_zoomIn,.rda_flipInX,.rda_flipInY,.rda_bounce,.rda_flash,.rda_shake,.rda_pulse,.rda_swing,.rda_rubberBand,.rda_wobble,.rda_tada");
var count = j$(".rd_count_to");


allMods.each(function(i, el) {
  var el = j$(el);
  if (el.visible(true)) {
    el.addClass("already-visible"); 
  } 
});


count.each(function(i, el) {
  var el = j$(el);
  if (el.visible(true)) {


				var countAsset = j$(this),
					countNumber = countAsset.find('.count_number'),
					countDivider = countAsset.find('.count_line').find('span'),
					countSubject = countAsset.find('.count_title');
				
					el.removeClass("rd_count_to");		
		el.addClass("rd_count_to_over");	
					countNumber.countTo({
						onComplete: function () {
							countDivider.animate({
								'width': 50
							}, 400, 'easeOutCubic');
							countSubject.delay(100).animate({
								'opacity' : 1,
								'bottom' : '0px'
							}, 600, 'easeOutCubic');
							
						}
						
					});
    
			
  } 
});


win.scroll(function(event) {
  
j$(".rda_opacity").each(function(i, el) {
	
    var el = j$(el);
    if (el.visible(true)) {
    
	setTimeout(function () {
        el.addClass('opacity_ani');
    }, 50 * i );
	}
	
  });
j$(".rda_toleft").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
      el.addClass("toleft_ani"); 
    } 
  });
j$(".rda_toright").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
      el.addClass("toright_ani"); 
    } 
  });
j$(".rda_totop").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('totop_ani');
    }, 50 * i );
	}
 });
j$(".rda_tobottom").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
      el.addClass("tobottom_ani"); 
    } 
  });
  
  
  
  

j$(".rda_fadeIn").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated fadeIn');
    }, 50 * i );
	}
 });  
j$(".rda_fadeInDown").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated fadeInDown');
    }, 50 * i );
	}
});  
j$(".rda_fadeInUp").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated fadeInUp');
    }, 50 * i );
	}
 });    
j$(".rda_fadeInLeft").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated fadeInLeft');
    }, 50 * i );
	}
 });    
j$(".rda_fadeInRight").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated fadeInRight');
    }, 50 * i );
	}
 });    
j$(".rda_bounceIn").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated bounceIn');
    }, 50 * i );
	}
 });    
j$(".rda_bounceInDown").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated bounceInDown');
    }, 50 * i );
	}
 });    
j$(".rda_bounceInUp").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated bounceInUp');
    }, 50 * i );
	}
 });    
j$(".rda_bounceInLeft").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated bounceInLeft');
    }, 50 * i );
	}
 });    
j$(".rda_bounceInRight").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated bounceInRight');
    }, 50 * i );
	}
 });  
j$(".rda_zoomIn").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated zoomIn');
    }, 50 * i );
	}
 });   
j$(".rda_flipInX").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated flipInX');
    }, 50 * i );
	}
 });   
j$(".rda_flipInY").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated flipInY');
    }, 50 * i );
	}
 }); 
   
j$(".rda_bounce").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated bounce');
    }, 50 * i );
	}
 });    
j$(".rda_flash").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated flash');
    }, 50 * i );
	}
 });    
j$(".rda_shake").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated shake');
    }, 50 * i );
	}
 });    
j$(".rda_pulse").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated pulse');
    }, 50 * i );
	}
 });    
j$(".rda_swing").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated swing');
    }, 50 * i );
	}
 });    
j$(".rda_rubberBand").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated rubberBand');
    }, 50 * i );
	}
 });    
j$(".rda_wobble").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated wobble');
    }, 50 * i );
	}
 });    
j$(".rda_tada").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {
   
	setTimeout(function () {
        el.addClass('animated tada');
    }, 50 * i );
	}
 });  
  
  
  
  
  
  
j$(".rd_count_to").each(function(i, el) {
    var el = j$(el);
    if (el.visible(true)) {


				var countAsset = j$(this),
					countNumber = countAsset.find('.count_number'),
					countDivider = countAsset.find('.count_line').find('span'),
					countSubject = countAsset.find('.count_title');
						el.removeClass("rd_count_to");		
		el.addClass("rd_count_to_over");	
					countNumber.countTo({
						onComplete: function () {
							countDivider.animate({
								'width': 50
							}, 400, 'easeOutCubic');
							countSubject.delay(100).animate({
								'opacity' : 1,
								'bottom' : '0px'
							}, 600, 'easeOutCubic');

						}
					});
    } 
  });
          
});


  //////////////////////////////////
 //*** Breadcrumbs child page ***//	
//////////////////////////////////

if(j$(".child_pages_ctn").children('li').length === 0 ){
	j$("#rd_child_pages").hide();
	
}


var childvisible = 0;            
var title_width = j$('.page_title_ctn h1').width()+80;
j$(document).on('click', function(e) {
	   if (childvisible !== 0 && j$('.rd_child_pages').hasClass('child_icon_close')) {
			    if (!(e.target.id=='rd_child_pages' || $(e.target).parents('#rd_child_pages').length>0)) {
        j$('.rd_child_pages').removeClass('child_icon_close');			
			childvisible = 0;
			j$(".child_pages_ctn").removeClass('pop_child_pages');
			j$('.rd_child_pages').addClass('child_closed');
	}

    }
});
	j$(".child_pages_ctn").css('width', title_width );
    j$(".rd_child_pages").click(function(e){ 
        //This stops the page scrolling to the top on a # link.
        if (childvisible == 0 && j$('.rd_child_pages').hasClass('child_closed')) {
			j$(".child_pages_ctn").css('width', title_width );
			j$('.rd_child_pages').removeClass('child_closed');			
			j$('.rd_child_pages').addClass('child_icon_close');
			j$(".child_pages_ctn").addClass('pop_child_pages');
			setTimeout(function(){
    j$('.child_pages_ctn').focus();
}, 1500);
			childvisible = 1; //Set search visible flag to visible.
        } else {
            //Search is currently showing. Slide it back up and hide it.
            j$('.rd_child_pages').removeClass('child_icon_close');			
			childvisible = 0;
			j$(".child_pages_ctn").removeClass('pop_child_pages');
			j$('.rd_child_pages').addClass('child_closed');
        }
		
    });





  ///////////////////////
 //*** Search form ***//	
///////////////////////


var searchvisible = 0;            
    j$("#searchtop").click(function(e){ 
        //This stops the page scrolling to the top on a # link.
        e.preventDefault();
        if (searchvisible == 0 && j$('#searchtop_img i').hasClass('fa-search')) {
			j$('#searchtop_img i').removeClass('fa-search');			
			j$('#searchtop_img i').addClass('fa-times');
            j$("#search-form").addClass('pop_search_form');
			setTimeout(function(){
    j$('#ssform').focus();
}, 500);
			searchvisible = 1; //Set search visible flag to visible.
        } else {
            //Search is currently showing. Slide it back up and hide it.
            j$('#searchtop_img i').removeClass('fa-times');			
			searchvisible = 0;
			j$("#search-form").removeClass('pop_search_form');
			j$('#searchtop_img i').addClass('fa-search');
        }
    });
j$( "#search-form" ).focusout(function() {
	setTimeout(function(){
	j$("#search-form").removeClass('pop_search_form');
	j$('#searchtop_img i').removeClass('fa-times');			
	j$('#searchtop_img i').addClass('fa-search');
	searchvisible = 0;
	}, 100);
  })




  ////////////////////////  
 //*** Woocommerce  ***//
////////////////////////

j$('.products').css('opacity','1');


});
