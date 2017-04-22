/**





 * Prints out the inline javascript needed for the colorpicker and choosing





 * the tabs in the panel.





 */











jQuery(document).ready(function($) {









	// Color Picker





	$('.colorSelector').each(function(){





		var Othis = this; //cache a copy of the this variable for use inside nested function





		var initialColor = $(Othis).next('input').attr('value');





		$(this).ColorPicker({





		color: initialColor,





		onShow: function (colpkr) {





		$(colpkr).fadeIn(500);





		return false;





		},





		onHide: function (colpkr) {





		$(colpkr).fadeOut(500);





		return false;





		},





		onChange: function (hsb, hex, rgb) {





		$(Othis).children('div').css('backgroundColor', '#' + hex);





		$(Othis).next('input').attr('value','#' + hex);





	}





	});





	}); //end color picker







});