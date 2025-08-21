jQuery(document).ready(function() {
	
	// Only show the #pmpromd_map_optin if the pmpromd_hide_directory is unchecked.
	if ( jQuery('#pmpromd_hide_directory').length ) {
		
		if ( jQuery('#pmpromd_hide_directory').is(':checked') ) {
			jQuery('#pmpromd_map_optin').closest('div').hide();
			jQuery('.pmpromd-map-address-field').closest('div').hide();
		}

		jQuery('#pmpromd_hide_directory').on('change', function() { 
			if ( jQuery(this).is(':checked') ) {
					jQuery('#pmpromd_map_optin').closest('div').hide();
					jQuery('.pmpromd-map-address-field').closest('div').hide();
			} else {
				jQuery('#pmpromd_map_optin').closest('div').show();
				if( jQuery('#pmpromd_map_optin').is(':checked') ) {
					jQuery('.pmpromd-map-address-field').closest('div').show();
				}
			}
		});
	}

    // Initially hide the address fields if the checkbox is not checked
    if (!jQuery('#pmpromd_map_optin').is(':checked')) {
		jQuery('.pmpromd-map-address-field').closest('div').hide();
    }

    // Toggle visibility when the checkbox state changes
    jQuery('#pmpromd_map_optin').on('change', function() {
        if (jQuery(this).is(':checked')) {
			jQuery('.pmpromd-map-address-field').closest('div').show();
        } else {
			jQuery('.pmpromd-map-address-field').closest('div').hide();
        }
    });
});
