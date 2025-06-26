<?php
/**
 * All map related functions to be used in this file.
 */

/**
 * Load the custom JS we need to show/hide fields as we need, and any other related JS scripts.
 * Note: This does not include the Google Maps API script, which is loaded in the `pmpromd_show_google_map` function and enqueued with map.js
 * 
 * @since TBD
 */
function pmpromd_enqueue_extra_map_scripts() {
	wp_enqueue_script( 'pmpro-directory-maps-extra-scripts', plugin_dir_url( dirname( __FILE__ ) ) . 'js/extras.js', array( 'jquery' ), PMPROMD_VERSION );
}
add_action( 'wp_enqueue_scripts', 'pmpromd_enqueue_extra_map_scripts' );

/**
 * A wrapper function to build and display a Google Map. This replaces the previous membership_map shortcode.
 *
 * @since TBD
 * 
 * @param array $attributes An array of attributes for the Google Map, often passed by a shortcode or block.
 * @param array $members An array of members to be displayed on the map. This is optional and can be used to filter the markers shown. (///TODO)
 * @return string $map_output The HTML output for the Google Map.
 */
function pmpromd_show_google_map( $attributes, $members ) {

	// Only show the map if the 'show_map' attribute is set to true.
	if ( $attributes['show_map'] === false ) {
		return;
	}

	// Make sure we have the Maps API key, if it's not set we shouldn't try to do anything.
	$maps_api_key = get_option( 'pmpro_pmpromd_maps_api_key' );
	if ( empty( $maps_api_key ) ) {
		return;
	}

	// Extract the array $attributes so we can use them directly without doing $attributes['key'] all the time.
	extract( $attributes );

	/**
	 * @deprecated TBD - use `pmpromd_map_id` instead.
	 */
	$map_id = sanitize_text_field( apply_filters_deprecated( 'pmpromm_map_id', array( '1' ), 'pmpromd_map_id', 'TBD' ) );

	/**
	 * A unique identifier for the map, should we want styling and some recipes rely on it.
	 * 
	 * @since TBD
	 * 
	 * @param string $map_id The ID of the map.
	 * @param array $attributes The attributes passed to the map.
	 */
	$map_id = apply_filters( 'pmpromd_map_id', $map_id, $attributes );

	/**
	 * @deprecated TBD - use `pmpromd_map_failed_to_load_notice` instead.
	 */
	$notice = apply_filters_deprecated(
		'pmpromm_default_map_notice',
		array( __( 'This map could not be loaded. Please ensure that you have entered your Google Maps API Key and that there are no JavaScript errors on the page.', 'pmpro-member-directory' ) ),
		'pmpromd_map_failed_to_load_notice',
		'TBD'
	);
	
	/**
	 * Adjust the notice that is displayed when the map fails to load.
	 * 
	 * @since TBD
	 * 
	 * @param string $notice The notice to display when the map fails to load.
	 * @param string $map_id The ID of the map that failed to load.
	 */
	$notice = apply_filters( 'pmpromd_map_failed_to_load_notice', $notice, $map_id );

	//Get the marker data
	$marker_data = pmpromd_generate_marker_data( $members, $attributes );

	/**
	 * Filter the map styles.
	 *
	 * @deprecated TBD - use `pmpromd_map_styles` instead.
	 *
  	 * @param string $styles JSON string of map styles
	 * @param string $map ID of the current map
	 */
	$map_styles = apply_filters_deprecated( 'pmpromm_map_styles', array( '', $map_id ), 'pmpromd_map_styles', 'TBD'  );

	/**
	 * Filter the style of the map.
	 * 
	 * @since TBD
	 * 
	 * @param string $map_styles JSON string of map styles.
	 * @param string $map_id The ID of the map.
	 */
	$map_styles = apply_filters( 'pmpromd_map_styles', $map_styles, $map_id );
	
	//Remove spaces and new lines from the styles
	$map_styles = trim( $map_styles );
	$map_styles = str_replace( " ", "", $map_styles );
	$map_styles = preg_replace( "/\n+/", "", $map_styles );
	$map_styles = preg_replace( "/\s+/", "", $map_styles );

	/**
	 * Add any additional query parameters to the Google Maps API request. Such as libraries etc.
	 * 
	 * @since TBD
	 * 
	 * @param array $query_params An array of query parameters to be added to the Google Maps API request.
	 */
	$query_params = apply_filters( 'pmpromd_maps_query_params', array( 
		'key' => $maps_api_key,
		'callback' => 'pmpromd_init_map', 
		'loading' => 'async', 
		'v' => '3', 
		'style' => $map_styles 
	) );

	// Let's work through the query parameters and clean/sanitize them.
	$query_params = array_map( 'sanitize_text_field', $query_params );

	wp_enqueue_script( 'pmpromd-google-maps', add_query_arg( $query_params, 'https://maps.googleapis.com/maps/api/js' ), array(), PMPRO_MEMBER_DIRECTORY_VERSION, array( 'strategy'  => 'async' ) );
	wp_register_script( 'pmpromd-google-maps-javascript', plugin_dir_url( dirname( __FILE__ ) ) . 'js/map.js', array( 'jquery' ), PMPRO_MEMBER_DIRECTORY_VERSION ); // This changes to `map.js`
		
	/**
	 * @deprecated TBD - use `pmpromd_default_map_start` instead.
	 */
	$default_start_location = apply_filters_deprecated( 'pmpromm_default_map_start', array( array( 'lat' => -34.397, 'lng' => 150.644 ), $map_id ), 'pmpromd_default_map_start', 'TBD' );
	
	/**
	 * @deprecated TBD - use `pmpromd_override_first_marker` instead.
	 */
	$override_first_marker_location = apply_filters_deprecated( 'pmpromm_override_first_marker', array( '__return_false', $map_id ), 'pmpromd_override_first_marker', 'TBD' );
		
	$pmpromd_map_attributes = array(
		/**
		 * Adjust the map starting point location. This gets overridden when there are markers on the map.
		 * 
		 * @since TBD
		 * 
		 * @param array $default_start_location An array containing the latitude and longitude of the default starting location.
		 * @param string $map_id The ID of the map.
		 */
		'default_start' => apply_filters( 'pmpromd_default_map_start', $default_start_location, $map_id ),
		
		/**
		 * Override the first marker location. This is useful when you want to show a specific location on the map first.
		 * 
		 * @since TBD
		 * 
		 * @param bool $override_first_marker_location Whether to override the first marker location.
		 * @param string $map_id The ID of the map.
		 */
		'override_first_marker_location' => apply_filters( 'pmpromd_override_first_marker', $override_first_marker_location, $map_id ),
		'infowindow_width' => $map_infowindow_width,
		'marker_data' => $marker_data,
		'zoom_level' => $map_zoom,
		'max_zoom' => $map_max_zoom,
		'infowindow_classes' => pmpro_get_element_class( 'pmpromd_infowindow' ),
		'map_styles' => $map_styles		
	);

	wp_localize_script( 'pmpromd-google-maps-javascript', 'pmpromd_vars', $pmpromd_map_attributes );
	wp_enqueue_script( 'pmpromd-google-maps-javascript' );

	return "<div id='pmpromd_map' class='pmpromd_map pmpromd_map_id_" . esc_attr( $map_id ) . "' style='height: " . esc_attr( $map_height ) . "px; width: " . esc_attr( $map_width ) . "%;'>" . esc_html( $notice ) . "</div>";
}

/**
 * Generate the marker data for the Google Maps.
 * 
 * @since TBD
 *
 * @param Object $members An array of members (WP_User or stdClass) to be displayed on the map.
 * @param array $marker_attributes An array of marker attributes.
 * @return array $marker_array An array of marker data to be used in the Google Maps and output.
 */
function pmpromd_generate_marker_data( $members, $marker_attributes ) {

	global $pmpro_pages;

	$show_avatar = filter_var( $marker_attributes['show_avatar'], FILTER_VALIDATE_BOOLEAN );
	$link = filter_var( $marker_attributes['link'], FILTER_VALIDATE_BOOLEAN );
	$show_email = filter_var( $marker_attributes['show_email'], FILTER_VALIDATE_BOOLEAN );
	$show_level = filter_var( $marker_attributes['show_level'], FILTER_VALIDATE_BOOLEAN );
	$show_startdate = filter_var( $marker_attributes['show_startdate'], FILTER_VALIDATE_BOOLEAN );

	$elements_array = ! empty( $marker_attributes['elements'] ) ? pmpromd_prepare_elements_array( $marker_attributes['elements'] ) : false;

	// Let's put all the marker data together to display on the map.
	$marker_array = array();
	if ( ! empty( $members ) ) {
		foreach( $members as $member ) {

			// Sometimes the $member data that is passed through isn't an object when on the profile page (for some reason - so skip it).
			// It should either be an object or a WP_User object.
			if ( ! is_object( $member ) ) {
				continue;
			}

			// The member array for the marker.
			$member_array = array();

			// Try to get the member's address.
			$member_address = isset( $member->maplocation ) ? maybe_unserialize( $member->maplocation ) : array();
			

			// Let's get the member's latitude and longitude values.
			$used_old_location = false;
			if ( empty( $member_address ) ) {
				if ( ! empty( $member->old_lat ) && ! empty( $member->old_lng ) ) {
					$used_old_location = true;
					$latitude = $member->old_lat;
					$longitude = $member->old_lng;
				} else {
					$member_address = pmpromd_get_member_address( $member->ID );
					$latitude = ! empty( $member_address['latitude'] ) ? $member_address['latitude'] : get_user_meta( $member->ID, 'pmpro_lat', true );
					$longitude = ! empty( $member_address['longitude'] ) ? $member_address['longitude'] : get_user_meta( $member->ID, 'pmpro_lng', true );
				}
			} else {
				$latitude = isset( $member_address['latitude'] ) ? $member_address['latitude'] : null;
				$longitude = isset( $member_address['longitude'] ) ? $member_address['longitude'] : null;
			}

			// Backwards compatibility for older members that are upgrading.
			if ( ! isset( $member_address['optin'] ) && $used_old_location ) {
				$member_address['optin'] = true;
			}

			// If the user has not opted in, we should not display their location on the map.
			if ( empty( $member_address['optin'] ) ) {
				continue;
			}

			$member_array['ID'] = $member->ID;
			$member = get_userdata( $member->ID );
			$profile_url = get_permalink( $pmpro_pages['profile'] );

			// Set the member marker meta location now using longitude and latitude values.
			$member_array['marker_meta'] = array(
				'lat' => $latitude,
				'lng' => $longitude
			);

			// We should get rid of the user levels now so that it doesn't affect future loop iterations.
			unset( $user_levels );
			
			// Generate the infowindow content for each marker.
			$marker_content = '';
			if ( ! empty( $elements_array ) ) {

				// Elements that should link to the member's profile page. Note: This does not link when on the profile page.
				$linked_elements = array( 'display_name' );
				foreach( $elements_array as $element ) {
					if ( strpos( $element[1], 'avatar|' ) !== false ) {
						$linked_elements[] = $element[1];
					}

					// Get the field value.
					$value = pmpromd_get_display_value( $element[1], $member );

					// If the value is empty, skip this element.
					if ( empty( $value ) ) {
						continue;
					}

					// Link any linkable elements to the member's profile page.
					if ( ! empty( $link ) && ! empty( $profile_url ) && in_array( $element[1], $linked_elements ) ) {
						$value = '<a href="' . esc_url( pmpromd_build_profile_url( $member, $profile_url ) ) . '">' . $value . '</a>';
					}
					
					// Get the display name and make it h2, then skip to the next element.
					if ( 'display_name' === $element[1] ) {
						$marker_content .= '<h2 class="' . esc_attr( pmpro_get_element_class( 'pmpro_font-large' ) ) . '">' . wp_kses( $value , pmpromd_allowed_html() ) . '</h2>';
						continue;
					}

					// Add marker content to the infowindow and escape/sanitize it.
					$marker_content .= '<p class="' . esc_attr( pmpro_get_element_class( 'pmpromd_' . $element['class'] ) ) . '"> ' . wp_kses( $element[0], pmpromd_allowed_html() ) . '<br>' . wp_kses( $value , pmpromd_allowed_html() ) . '</p>';
				}

				// Add the View Profile link at the end of the infowindow.
				if ( ! empty( $link ) && ! empty( $profile_url ) ) {
					$user_profile = pmpromd_build_profile_url( $member, $profile_url );
					$profile_content = '<p class="' . esc_attr( pmpro_get_element_class( 'pmpromd_profile' ) ) . '"><a href="' . esc_url( $user_profile ) . '">' . esc_html( apply_filters( 'pmpromm_view_profile_text', __( 'View Profile', 'pmpro-membership-maps' ) ) ) . '</a></p>';
					$marker_content .= $profile_content;			
				}
				
			}

			$member_array['marker_content'] = $marker_content;
			
			/**
			 * @deprecated TBD - use `pmpromd_single_marker_content` instead.
			 */
			$member_array['marker_content'] = apply_filters_deprecated( 'pmpromm_single_marker_content', array( $member_array['marker_content'], $member ), 'pmpromd_single_marker_content', 'TBD' );

			/**
			 *  Filter the infowindow HTML content for a single marker.
			 * 
			 * @since TBD
			 * 
			 * @param string $member_array['marker_content'] The HTML content for the marker's infowindow.
			 * @param WP_User $member The user object for the member.
			 */
			$member_array['marker_content'] = apply_filters( 'pmpromd_single_marker_content', $member_array['marker_content'], $member );

			$marker_array[] = $member_array;
		}
	}

	return $marker_array;

}

/**
 * Saves the user's pin location to user meta and include latitude and longitude.
 *
 * @since TBD
 * @param mixed  $user_id User ID but not required
 * @return void
 */
function pmpromd_save_marker_location_for_user( $user_id = false ) {

    // No user ID provided, lets get the current user
    if ( ! $user_id ) { 
		// Current user isn't logged in for some reason, bail
        $user_id = get_current_user_id();
        if ( ! $user_id ) {
            return;
        }
    }

	// Lets make sure the site has a Maps API key set to continue further.
	if ( ! get_option( 'pmpro_pmpromd_maps_api_key' ) ) {
		return;
	}

	// Let's see if the fields are set in the request and geocode the address passed in.
    if ( ! empty( $_REQUEST['pmpromd_street_name'] ) ) {
    
		// Create an array of the member's address. We will save this purely for reference purposes. We use the latitude and longitude values actually.
        $member_address = array(
            'street'    => ( ! empty( $_REQUEST['pmpromd_street_name'] ) ) ? sanitize_text_field( $_REQUEST['pmpromd_street_name'] ) : '',
            'city'      => ( ! empty( $_REQUEST['pmpromd_city'] ) ) ? sanitize_text_field( $_REQUEST['pmpromd_city'] ) : '',
            'state'     => ( ! empty( $_REQUEST['pmpromd_state'] ) ) ? sanitize_text_field( $_REQUEST['pmpromd_state'] ) : '',
            'zip'       => ( ! empty( $_REQUEST['pmpromd_zip'] ) ) ? sanitize_text_field( $_REQUEST['pmpromd_zip'] ) : '',
            'country'   => ( ! empty( $_REQUEST['pmpromd_country'] ) ) ? sanitize_text_field( $_REQUEST['pmpromd_country'] ) : ''
        );
		
		// Save the optin value to include in the request.
        if ( ! isset( $_REQUEST['pmpromd_map_optin'] ) ) {
            $member_address['optin'] = false;
        } else {
            $member_address['optin'] = true;
        }

		// Let's build the address array to geocode.
        $coordinates = pmpromd_geocode_map_address( $member_address );
 
        if ( is_array( $coordinates ) ) {
            if ( !empty( $coordinates['lat'] ) && !empty( $coordinates['lng'] ) ){
                $member_address['latitude'] = $coordinates['lat'];
                $member_address['longitude'] = $coordinates['lng'];

                //Only add to user meta if the address has been geocoded
                update_user_meta( $user_id, 'pmpromd_pin_location', $member_address );
            } else {
                //Cleanup pin location
				delete_user_meta( $user_id, 'pmpromd_pin_location' );
            }
        }

    } else {
        //Cleanup pin location
        delete_user_meta( $user_id, 'pmpromd_pin_location' );

    }
}

/**
 * Get the member's address from user meta and support backwards compatibility for older versions of membership maps.
 * Note: This function should be slightly refactored in the future to remove the backwards compatibility.
 * 
 * @since TBD
 * 
 * @param int|boolean $user_id The user ID to get the address for. If false, it will get the current user ID.
 * @return array|boolean $map_location The member's address in an array format, or false if no address is found.
 */
function pmpromd_get_member_address( $user_id = false ) {
	
	// No user ID provided, lets get the current user.
	if ( ! $user_id ) {
		$user_id = get_current_user_id();
	}

	// If we don't have a user ID, we should return false.
	if ( ! $user_id ) {
		return false;
	}

	// The pin_location should stay the same and store lat, lng.
	// Get the map location from user meta.
	$map_location = get_user_meta( $user_id, 'pmpromm_pin_location', true );
	if ( ! empty( $map_location ) ) {
		// Update the meta to the new one and then delete the old one.
		update_user_meta( $user_id, 'pmpromd_pin_location', $map_location );
		delete_user_meta( $user_id, 'pmpromm_pin_location' );
	} else {
		$map_location = get_user_meta( $user_id, 'pmpromd_pin_location', true );
	}

	return $map_location;
}

/**
 * Geocode the passed address for the marker locations. Get the longitude and latitude of an address using the Google Maps Geocoding API.
 *
 * @since TBD
 * 
 * @param array $addr_array An array of the address components to be geocoded. This should include street, city, state, zip, and country.
 * @param object $morder The Paid Memberships Pro order object, if available. This is optional and can be used to pass additional data.
 * @param boolean $return_body Should this return the raw response body from the Google Maps Geocoding API? This is useful for testing and debugging purposes. Default is false.
 * 
 * @return string $geocoded_data The geocoded data returned from the Google Maps Geocoding API (latitude and longitude).
 */
function pmpromd_geocode_map_address( $addr_array, $morder = false, $return_body = false ) {

	// Turn the address array into a string for geocoding.
	$address_string = implode( ", ", array_filter( $addr_array ) );

	/**
	 * Filter to adjust the geocoding API key. This is useful if you want to use a different API key for geocoding or test a key.
	 * 
	 * @deprecated TBD - use `pmpromd_maps_geocoding_api_key` instead.
	 */
	$map_api_key = apply_filters_deprecated( 'pmpromm_geocoding_api_key', array( get_option( 'pmpro_pmpromd_maps_api_key' ) ), 'TBD', 'pmpromd_maps_geocoding_api_key' );

	$remote_request = wp_remote_get( 'https://maps.googleapis.com/maps/api/geocode/json', 
		array( 'body' => array(
			'key' 		=> apply_filters( 'pmpromd_maps_geocoding_api_key', $map_api_key ),
			'address' 	=> $address_string
		) ) 
	);

	if ( ! is_wp_error( $remote_request ) ) {

		$request_body = wp_remote_retrieve_body( $remote_request );
		$request_body = json_decode( $request_body );

		// If we need to return the 'raw' response body, we can do that here. This is for testing.
		if ( $return_body ) {
			return $request_body;
		}

		// Let's get the returned data and return it if it's all okay.
		if ( ! empty( $request_body->status ) && $request_body->status == 'OK' ) {
			
			if ( ! empty( $request_body->results[0] ) ) {

				$lat = $request_body->results[0]->geometry->location->lat;
				$lng = $request_body->results[0]->geometry->location->lng;

				$geocoded_data = array( 'lat' => $lat, 'lng' => $lng );
			}

		} else {
			// pmpromm_report_geocode_api_error( $request_body );
			$geocoded_data = false;
		}

	}

	return $geocoded_data;

}

/**
 * Geocode map fields when saving/updating a user profile
 *
 * @since TBD
 * 
 * @param integer $user_id The user ID to geocode the address for.
 */
function pmpromd_geocode_map_address_for_user( $user_id ) {
	pmpromd_save_marker_location_for_user( $user_id );
}
add_action( 'pmpro_personal_options_update', 'pmpromd_geocode_map_address_for_user', 10, 1 );
add_action( 'personal_options_update', 'pmpromd_geocode_map_address_for_user', 10, 1 );
add_action( 'edit_user_profile_update', 'pmpromd_geocode_map_address_for_user', 10, 1 );

/**
 * Geocode the address fields after checkout and save the location data.
 * 
 * @since TBD
 *
 * @param integer $user_id The user ID to geocode the address for.
 * @param object $morder The Paid Memberships Pro order object, if available.
 */
function pmpromd_map_process_map_address_after_checkout( $user_id, $morder ){
	pmpromd_save_marker_location_for_user( $user_id );
}
add_action( 'pmpro_after_checkout', 'pmpromd_map_process_map_address_after_checkout', 10, 2 );
