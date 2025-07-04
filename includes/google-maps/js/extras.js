jQuery(document).ready(function() {
    // Initially hide the address fields if the checkbox is not checked
    if (!jQuery('#pmpromd_map_optin').is(':checked')) {
		jQuery('.pmpromd-map-address-field, .pmpromd-map-address-field').closest('div').hide();
    }

    // Toggle visibility when the checkbox state changes
    jQuery('#pmpromd_map_optin').on('change', function() {
        if (jQuery(this).is(':checked')) {
			jQuery('.pmpromd-map-address-field, .pmpromd-map-address-field').closest('div').show();
        } else {
			jQuery('.pmpromd-map-address-field, .pmpromd-map-address-field').closest('div').hide();
        }
    });
});