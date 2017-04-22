jQuery(document).ready(function($) {

	// Collapse sidebar
	$('body').addClass('folded');

	// Add hover event
	$('#adminmenu').hover(
		function() { $('body').removeClass('folded'); },
		function() {
			setTimeout(function() {
				$('body').addClass('folded');
			}, 1500);
		}
	);

	// Restore when leaving the page
});