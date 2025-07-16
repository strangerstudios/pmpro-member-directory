<?php

/**
 * Adds API Key field to advanced settings page
 * Note: The filter escapes during it's output and not needed within this function.
 * 
 * @since TBD
 * 
 * @param array $fields The existing fields on the PMPro Advanced Settings page.
 * @return array $fields The modified fields with the Google Maps API Key field added.
 */
function pmpromd_add_google_maps_api_key_setting( $fields ) {

	remove_filter( 'pmpro_custom_advanced_settings','pmpromm_advanced_settings_field', 20 );

	// Get the option for the API key and it's status. It will be filtered by the `option_{option_name}` filter.
	$api_key = get_option( 'pmpro_pmpromd_maps_api_key' );
	$key_status = get_option( 'pmpro_pmpromd_maps_api_key_status' );
	
	// If there's no API key, then we show a link to getting the API key or we get the response.
	if ( empty( $api_key ) ) {
		$description = '<a href="https://www.paidmembershipspro.com/add-ons/member-directory/#google-maps-api-key" target="_BLANK">' . esc_html__( 'Obtain Your Google Maps API Key', 'pmpro-member-directory' ).'</a>';
	} else {
		$description = '<code>' . esc_html__( 'API Key Status', 'pmpro-member-directory' ) . ': ' . esc_html( $key_status ) . '</code>';
	}

	$fields['pmpromd_maps_api_key'] = array(
		'field_name' => 'pmpromd_maps_api_key',
		'field_type' => 'text',
		'label' => __( 'Google Maps API Key', 'pmpro-member-directory' ),
		'description' => $description
	);
	
	return $fields;
}
add_filter( 'pmpro_custom_advanced_settings', 'pmpromd_add_google_maps_api_key_setting', 5 );

/**
 * Test the API key upon saving the PMPro Advanced Settings.
 * 
 * @since TBD
 *
 */
function pmpromd_test_maps_api() {

	// Only load this function if the PMPro Advanced Settings page is being loaded.
	if ( ! isset( $_REQUEST['page'] ) || $_REQUEST['page'] !== 'pmpro-advanced-settings' ) {
		return;
	}

	// Only load this if we have an API key in the request and the person is a manager.
	if ( ! empty( $_REQUEST['pmpromd_maps_api_key'] ) && current_user_can( 'manage_options' ) ) {

		$current_key = get_option( 'pmpro_pmpromd_maps_api_key' );
		$new_key = trim( sanitize_text_field( $_REQUEST['pmpromd_maps_api_key'] ) );
		$api_key_status = get_option( 'pmpro_pmpromd_maps_api_key_status' );

		//API key differs or the status is not OK, let's test the key.
		if ( $new_key !== $current_key || $api_key_status !== 'OK' ) {

			/**
			 * This is a sample address used to test if the API key entered works as expected. 
			 */
			$member_address = array(
				'street' 	=> '1313 Disneyland Drive',
				'city' 		=> 'Anaheim',
				'state' 	=> 'CA',
				'zip' 		=> '92802'
			);
			
			add_filter( 'pmpromd_maps_geocoding_api_key', 'pmpromd_use_api_key_on_save' );
			$geocoded_result = pmpromd_geocode_map_address( $member_address, false, true );

			if ( $geocoded_result->status == 'OK' ) {
				update_option( 'pmpro_pmpromd_maps_api_key_status', 'OK' );
			} else {
				$status = sanitize_text_field( $geocoded_result->status . ' ' . $geocoded_result->error_message );
				update_option( 'pmpro_pmpromd_maps_api_key_status', $status );
			}

		}

	}

}
add_action( 'admin_init', 'pmpromd_test_maps_api' );

/**
 * Sets the geocoding API key to the $_REQUEST value instead of a stored value. This is used when testing the API key.
 * 
 * @since TBD
 * 
 * @param  string $api_key The current API Key
 * @return string The API key found in the $_REQUEST var
 */
function pmpromd_use_api_key_on_save( $api_key ) {

	if ( ! empty( $_REQUEST['pmpromd_maps_api_key'] ) ) {
		$api_key = trim( sanitize_text_field( $_REQUEST['pmpromd_maps_api_key'] ) );

		// Try to delete the old options for now.
		// This should be deprecated later on.
		delete_option( 'pmpro_pmpromm_api_key' );
		delete_option( 'pmpro_pmpromm_api_key_status' );
	}

	return $api_key;
}

/**
 * Adds the API key status to site health
 * 
 * @since TBD
 *
 * @param array $fields The site health fields array.
 */
function pmpromd_maps_key_status_site_health( $fields ) {

	if ( ! isset( $fields['pmpro'] ) ) {
		return $fields;
	}

	$map_data = array( 'pmpromd_maps_api_key_status' => array(
		'label' => __( 'Membership Maps API Key Status', 'paid-memberships-pro' ),
		'value' => esc_html( get_option( 'pmpro_pmpromd_maps_api_key_status' ) ),
	) );

	$fields['pmpro']['fields'] = array_merge( $fields['pmpro']['fields'], $map_data );

	return $fields;

}
add_filter( 'debug_information', 'pmpromd_maps_key_status_site_health', 11, 1 );

/**
 * Backwards compatibility for get_option calls to get 'old' value for the API key as the default option.
 * 
 * @since TBD
 */
function pmpromd_default_maps_api_key_value( $default_value ) {
	$old_value = get_option( 'pmpro_pmpromm_api_key' );
	
	if ( $old_value ) {
		$default_value = $old_value;
	}

	return $default_value;
}
add_filter( 'default_option_pmpro_pmpromd_maps_api_key', 'pmpromd_default_maps_api_key_value' );
