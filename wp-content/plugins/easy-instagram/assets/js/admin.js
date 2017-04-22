jQuery(document).ready(function() {
	jQuery('#ei-select-help').on('click', function() {
		jQuery('#ei-general-settings').hide();
		jQuery('#ei-help').show();

		jQuery('#ei-select-general-settings').removeClass('ei-nav-tab-active');
		jQuery('#ei-select-help').addClass('ei-nav-tab-active');
		return false;
	});

	jQuery('#ei-select-general-settings').on('click', function() {
		jQuery('#ei-general-settings').show();
		jQuery('#ei-help').hide();

		jQuery('#ei-select-help').removeClass('ei-nav-tab-active');
		jQuery('#ei-select-general-settings').addClass('ei-nav-tab-active');
		return false;
	}); 
});