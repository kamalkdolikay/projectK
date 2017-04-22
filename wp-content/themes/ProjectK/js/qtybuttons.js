jQuery(document).ready(function(){
jQuery(function() {


	"use strict";
    var action;
    jQuery(".quantity .qty-number").on("click",function () {
        var btn = jQuery(this);
        var input = btn.closest('.quantity').find('input[type="number"]');
        btn.closest('.quantity').find('input').prop("disabled", false);

    	if (btn.attr('data-type') == 'plus') {

                if ( input.attr('max') == undefined || parseInt(input.val()) < parseInt(input.attr('max')) ) {
                    input.val(parseInt(input.val())+1);
                }else{
                    btn.prop("disabled", true);
                }
           
    	} else {
                if ( input.attr('min') == undefined || parseInt(input.val()) > parseInt(input.attr('min')) ) {
                    input.val(parseInt(input.val())-1);
                }else{
                    btn.prop("disabled", true);
                }
           
    	}
    })
});
});