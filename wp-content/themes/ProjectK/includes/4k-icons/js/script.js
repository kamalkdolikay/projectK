jQuery(document).ready(function($) {
	"use strict";

	$('.fourk-icon').each(function() {
		var trigger = $(this).attr('data-hover-trigger');

		if ( typeof trigger === 'undefined' ) {
			return;
		}

		var $this = $(this);
		var $hoverable = $(this);

		if ( trigger === 'row' ) {
			$hoverable = $(this).parents('.wpb_row:eq(0)');
		} else if ( trigger === 'parent' ) {
			$hoverable = $(this).parent();
		} else if ( trigger === 'parent2' ) {
			$hoverable = $(this).parent().parent();
		} else if ( trigger === 'parent3' ) {
			$hoverable = $(this).parent().parent().parent();
		} else if ( trigger === 'parent4' ) {
			$hoverable = $(this).parent().parent().parent().parent();
		}

		try {
			$hoverable.hover(function() {
				$this.toggleClass('hovered');
				if ( $this.hasClass('hovered') ) {
					$this.attr('data-orig-background', $this.css('backgroundColor'));
					$this.css('backgroundColor', $this.attr('data-hover-background'));
				} else {
					$this.css('backgroundColor', $this.attr('data-orig-background'));
				}
			});
		} catch (err) {
		}
	});
});